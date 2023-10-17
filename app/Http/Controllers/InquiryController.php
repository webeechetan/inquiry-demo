<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\User;
use App\Notifications\InquiryL1DetailsUpdated;
use Illuminate\Http\Request;
use App\Notifications\NewInquiryAssigned;
use App\Notifications\NewInquiry;
use App\Notifications\UpdateInquiryDesc;
use Svg\Tag\Rect;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $users_id = $request->users;
        // adding filter for lead status

        $inquiries = Inquiry::with('handledBy','logs');

        if($request->has('new-lead')){
            $inquiries = $inquiries->orWhere('lead_status', '=', 'New Lead');
        }

        if($request->has('awol')){
            $inquiries = $inquiries->orWhere('lead_status', '=', 'AWOL');
        }

        if($request->has('converted')){
            $inquiries = $inquiries->orWhere('lead_status', '=', 'Converted');
        }

        if($request->has('oppurtunity')){
            $inquiries = $inquiries->orWhere('lead_status', '=', 'Opportunity');
        }

        if($request->has('qualified-lead')){
            $inquiries = $inquiries->orWhere('lead_status', '=', 'Qualified Lead');
        }

        if($request->has('dont-want')){
            $inquiries = $inquiries->orWhere('lead_status', '=', "Don't Want");
        }

        if($request->has('lost')){
            $inquiries = $inquiries->orWhere('lead_status', '=', "Lost");
        }

        if($request->has('users')){
            $inquiries = $inquiries->whereIn('handled_by', $users_id);
        }

        $inquiries = $inquiries->groupBy('inquiries.email');

        $inquiries = $inquiries->orderBy('created_at','desc')->get();
        $users = User::all();
        
        // $inquiries = Inquiry::with('handledBy','logs')->orderBy('created_at','desc')->get();
        return view('admin.inquiry.index', compact('inquiries','users','users_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view("admin.inquiry.create", compact('users'));
    }

    public function save(Request $request){
        $request->validate([
            'budget' => 'required',
            'requirements' => 'required',
            'company_name' => 'required',
            'lead_source' => 'required',
            'handled_by' => 'required',
        ]);

        $inquiry = new Inquiry();
        $inquiry->first_name = $request->first_name;
        $inquiry->last_name = $request->last_name;
        $inquiry->email = $request->email;
        $inquiry->phone = $request->phone;
        $inquiry->company_name = $request->company_name;
        $inquiry->requirements = $request->requirements;
        $inquiry->budget = $request->budget;
        $inquiry->handled_by = $request->handled_by;
        $inquiry->lead_source = $request->lead_source;
        $inquiry->lead_status = 'New Lead';

        try {
            if($inquiry->save()){
                $user = User::find($request->handled_by);
                $user->notify(new NewInquiry($inquiry));
                $this->alert('Success','Inquiry created successfully','success');
                return redirect()->route('inquiries.index');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inquiry = new Inquiry();
        $inquiry->first_name = $request->First_Name;
        $inquiry->last_name = $request->Last_Name;
        $inquiry->email = $request->Email;
        $inquiry->phone = $request->Phone;
        $inquiry->company_name = $request->Account_Name;
        $inquiry->requirements = $request->Description;
        $inquiry->budget = $request->CONTACTCF1;
        $inquiry->captcha = $request->enterdigest;
        $inquiry->handled_by = 1;
        $inquiry->lead_source = 'Bigin';
        $inquiry->lead_status = 'New Lead';

        try {
            if($inquiry->save()){
                $user = User::find(1);
                $user->notify(new NewInquiry($inquiry));
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()])
            ->header('Access-Control-Allow-Origin', env('ORIGIN_URL'))
            ->header('Access-Control-Allow-Methods', 'POST')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Accept');
        }

        return response()->json(['success' => 'true'])
        ->header('Access-Control-Allow-Origin', env('ORIGIN_URL'))
        ->header('Access-Control-Allow-Methods', 'POST')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Accept');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Inquiry $inquiry)
    {
        $inquiry = Inquiry::with('handledBy','logs')->find($inquiry->id);
        return response()->json(['inquiry' => $inquiry,'success' => 'true']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Inquiry $inquiry)
    {
        $users = User::all();
        return view('admin.inquiry.edit', compact('inquiry','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user_id = $request->user_id;
        $inquiry_id = $request->inquiryId;
        $inquiry = Inquiry::find($inquiry_id);
        $inquiry->handled_by = $user_id;
        try {
            if($inquiry->save()){
                $user = User::find($user_id);
                $user->notify(new NewInquiryAssigned($inquiry));
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
        return response()->json(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquiry $inquiry)
    {
        try {
            $inquiry->delete();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
        $this->alert('Success','Inquiry deleted successfully','success');
        return redirect()->route('inquiries.index');
    }

    public function updateStatus(Request $request)
    {
        $inquiry_id = $request->inquiryId;
        $inquiry = Inquiry::find($inquiry_id);
        $inquiry->lead_status = $request->lead_status;
        try {
            $inquiry->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
        return response()->json(['success' => 'true']);
    }

    public function updateL1(Request $request)
    {
        $inquiry_id = $request->inquiryId;
        $inquiry = Inquiry::find($inquiry_id);
        $inquiry->L1 = $request->L1;
       
        try {
            $inquiry->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
        return response()->json(['success' => 'true']);
    }

    public function saveL1Minutes(Request $request){
        $inquiry_id = $request->inquiryId;
        $inquiry = Inquiry::find($inquiry_id);
        $inquiry->L1_minutes = $request->l1_minutes;
        try {
            $inquiry->save();
            $user = User::find($inquiry->handled_by);
            $user->notify(new InquiryL1DetailsUpdated($inquiry));
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
        return response()->json(['success' => 'true']);
    }

    public function updateBriefStatus(Request $request){
        $inquiry_id = $request->inquiryId;
        $inquiry = Inquiry::find($inquiry_id);
        $inquiry->brief = $request->brief;
        try {
            $inquiry->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
        return response()->json(['success' => 'true']);
    }

   

    // saveBreafDetails

    public function saveBreafDetails(Request $request){
        $inquiry_id = $request->inquiryId;
        $inquiry = Inquiry::find($inquiry_id);
        $inquiry->brief_details = $request->brief_details;
        try {
            $inquiry->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
        return response()->json(['success' => 'true']);
    }

    public function updateInquiry(Request $request){
        $inquiry_id = $request->inquiryId;
        $inquiry = Inquiry::find($inquiry_id);

         echo($inquiry);
       
        $inquiry->first_name = $request->first_name;
        $inquiry->last_name = $request->last_name;
        $inquiry->email = $request->email;
        $inquiry->phone = $request->phone;
        $inquiry->company_name = $request->company_name;
        $inquiry->requirements = $request->requirements;
        $inquiry->budget = $request->budget;
        $inquiry->handled_by = $request->handled_by;
        $inquiry->lead_source = $request->lead_source;


        $inquiry->commercial = $request->commercial;
        $inquiry->L1 = $request->L1;
        $inquiry->brief = $request->brief;
        $inquiry->lead_status = $request->status;
        $inquiry->first_contacted = $request->first_contacted;
        $inquiry->last_contacted = $request->last_contacted;
        $inquiry->last_client_contacted = $request->last_client_contacted;
       
        echo($request->budget);
        echo "<br>";
        echo($request->first_contacted);
        echo "<br>";
        echo($request->last_contacted);
        echo "<br>";
        echo($request->last_client_contacted);

        
        try {
            $inquiry->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
        $this->alert('Success','Inquiry updated successfully','success');
        return redirect()->route('inquiries.index');
    }

    // updateFirstContacted 

    public function updateFirstContacted(Request $request){
        $inquiry_id = $request->inquiryId;
        $inquiry = Inquiry::find($inquiry_id);
        $inquiry->first_contacted = $request->first_contacted;
        try {
            $inquiry->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
        return response()->json(['success' => 'true']);
    }

    // updateLastClientContacted

    public function updateLastClientContacted(Request $request){
        $inquiry_id = $request->inquiryId;
        $inquiry = Inquiry::find($inquiry_id);
        $inquiry->last_client_contacted = $request->last_client_contacted;
        try {
            $inquiry->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
        return response()->json(['success' => 'true']);
    }

    // updateLastContacted

    public function updateLastContacted(Request $request){
        $inquiry_id = $request->inquiryId;
        $inquiry = Inquiry::find($inquiry_id);
        $inquiry->last_contacted = $request->last_contacted;
        try {
            $inquiry->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
        return response()->json(['success' => 'true']);
    }

    // update commercial

    public function updateCommercial(Request $request){
        $inquiry_id = $request->inquiryId;
        $inquiry = Inquiry::find($inquiry_id);
        $inquiry->commercial = $request->commercial;
        try {
            $inquiry->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
        return response()->json(['success' => 'true']);
    }

    public function viewActions(Inquiry $inquiry){
        $inquiry = Inquiry::with('logs')->find($inquiry->id);
        return view('admin.inquiry.logs', compact('inquiry'));
    }

    public function search(Request $request){
        $search = $request->search;
        if(str_contains($search, 'custom:')){
            $search_string = str_replace('custom:', '', $search);
            $search_array = $this->parseSearchString($search_string);
            $inquiries = Inquiry::with('handledBy','logs')->where($search_array)->orderBy('created_at','desc')->get();
            return response()->json(['inquiries' => $inquiries,'success' => 'true']);
        }
        $inquiries = Inquiry::with('handledBy','logs')->where('first_name', 'LIKE', "%{$search}%")
        ->orWhere('last_name', 'LIKE', "%{$search}%")
        ->orWhere('email', 'LIKE', "%{$search}%")
        ->orWhere('phone', 'LIKE', "%{$search}%")
        ->orWhere('company_name', 'LIKE', "%{$search}%")
        ->orWhere('requirements', 'LIKE', "%{$search}%")
        ->orWhere('budget', 'LIKE', "%{$search}%")
        ->orWhere('lead_source', 'LIKE', "%{$search}%")
        ->orWhere('lead_status', 'LIKE', "%{$search}%")
        ->orWhere('commercial', 'LIKE', "%{$search}%")
        ->orWhere('L1', 'LIKE', "%{$search}%")
        ->orWhere('brief', 'LIKE', "%{$search}%")
        ->orWhere('last_contacted', 'LIKE', "%{$search}%")
        ->orWhere('last_client_contacted', 'LIKE', "%{$search}%")
        ->orWhere('first_contacted', 'LIKE', "%{$search}%")
        ->orWhere('L1_minutes', 'LIKE', "%{$search}%")
        ->orWhere('brief_details', 'LIKE', "%{$search}%")
        ->orWhere('handled_by', 'LIKE', "%{$search}%")
        ->orderBy('created_at','desc')->get();
        return response()->json(['inquiries' => $inquiries,'success' => 'true']);
    }

    function parseSearchString($searchString) {
        $searchArray = [];
    
        $pairs = explode(',', $searchString);
    
        foreach ($pairs as $pair) {
            list($attribute, $value) = explode(':', $pair, 2);
            $attribute = trim($attribute);
            $value = trim($value);
            $searchArray[$attribute] = $value;
        }
        return $searchArray;
    }
}
