<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $fromDate = $request->from_date;
        $toDate = $request->to_date;
        $filters = $request->filters;

        if($fromDate && $toDate){
            $enquiries = Inquiry::with('handledBy')
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->groupBy('email')
            ->get();
            $users = User::with(['inquiries' => function($query) use ($fromDate, $toDate){
                $query->whereBetween('created_at', [$fromDate, $toDate]);
            }])
            ->where('role', '!=', 'admin')
            ->get();
        }else{
            $enquiries = Inquiry::groupBy('email')->with('handledBy')->get();
            $users = User::with('inquiries')->where('role', '!=', 'admin')->get();
        }
        
        $chartDataForInquiry = $this->getInquiryDataForChart();
        $inquiryCountBySource = $this->inquiryCountBySource();
        $inquiryCountByLeadStatus = $this->inquiryCountByLeadStatus($fromDate, $toDate);
        return view('admin.dashboard', compact('enquiries', 'users','chartDataForInquiry','inquiryCountBySource','inquiryCountByLeadStatus'));
    }

    public function getInquiryDataForChart(){
        $months = [];
        $all_lead_count = [];
        $awol_counts = [];
        $converted_counts = [];
        $new_lead_counts = [];
        $qualified_lead_counts = [];


        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M');
        }

        foreach ($months as $month) {
            $inquiriesData = Inquiry::selectRaw('count(*) as count, lead_status')
                ->whereMonth('created_at', date('m', strtotime($month)))
                ->whereYear('created_at', date('Y', strtotime($month)))
                ->groupBy('lead_status','email')
                ->orderBy('lead_status')
                ->get()
                ->toArray();

            $awol_count = 0;
            $converted_count = 0;
            $new_lead_count = 0;
            $qualified_lead_count = 0;
            $all_lead_count[] = count($inquiriesData);

            foreach ($inquiriesData as $entry) {
                if ($entry['lead_status'] == 'AWOL') {
                    $awol_count = $entry['count'];
                } else if ($entry['lead_status'] == 'Converted') {
                    $converted_count = $entry['count'];
                } else if ($entry['lead_status'] == 'New Lead') {
                    $new_lead_count = $entry['count'];
                } else if ($entry['lead_status'] == 'Qualified Lead') {
                    $qualified_lead_count = $entry['count'];
                }
            }

            $awol_counts[] = $awol_count;
            $converted_counts[] = $converted_count;
            $new_lead_counts[] = $new_lead_count;
            $qualified_lead_counts[] = $qualified_lead_count;

        }

        return [
            'months' => $months,
            'awol_counts' => $awol_counts,
            'converted_counts' => $converted_counts,
            'new_lead_counts' => $new_lead_counts,
            'qualified_lead_counts' => $qualified_lead_counts,
            'all_lead_count' => $all_lead_count,
        ];
    }



    public function inquiryCountBySource()
    {
        $inquiriesData = Inquiry::selectRaw('count(*) as count, lead_source')
            ->groupBy('lead_source')
            ->orderBy('lead_source')
            ->get()
            ->toArray();

        $sources = [];
        $counts = [];

        foreach ($inquiriesData as $entry) {
            $sources[] = $entry['lead_source'];
            $counts[] = $entry['count'];
        }

        return [
            'lead_source' => $sources,
            'counts' => $counts,
        ];
    }

    public function inquiryCountByLeadStatus($fromDate = null, $toDate = null){
        if($fromDate && $toDate){
            $inquiriesData = Inquiry::selectRaw('COUNT(DISTINCT email) as count, lead_status')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->groupBy('lead_status','email')
                ->orderBy('lead_status')
                ->get()
                ->toArray();
        }else{
            $inquiriesData = Inquiry::selectRaw('COUNT(DISTINCT email) as count, lead_status')
                ->groupBy('lead_status')
                ->orderBy('lead_status')
                ->get()
                ->toArray();
        }

        $lead_status = [];
        $counts = [];

        foreach ($inquiriesData as $entry) {
            $lead_status[] = $entry['lead_status'];
            $counts[] = $entry['count'];
        }

        return [
            'lead_status' => $lead_status,
            'counts' => $counts,
        ];
    }

}
