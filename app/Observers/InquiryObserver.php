<?php

namespace App\Observers;
use App\Models\Inquiry;
use App\Models\InquiryLog;
use App\Notifications\InquiryUpdated;

class InquiryObserver
{
    /**
     * Handle the Inquiry "created" event.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return void
     */
    public function created(Inquiry $inquiry)
    {
        $InquiryLog = new InquiryLog();
        $InquiryLog->inquiry_id = $inquiry->id;
        $log = 'Inquiry created by : '. $inquiry->lead_source;
        if($inquiry->handled_by != '1'){
            $log = auth()->user()->name . ' created inquiry and assigned to ' . $inquiry->handledBy->name;
        }
        $InquiryLog->log = $log;
        $InquiryLog->save();
        
    }

    /**
     * Handle the Inquiry "updated" event.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return void
     */
    public function updated(Inquiry $inquiry)
    {
        $InquiryLog = new InquiryLog();
        $InquiryLog->inquiry_id = $inquiry->id;
        $changedAttributes = $inquiry->getDirty();
        $log = auth()->user()->name . ' updated inquiry: ';
        foreach ($changedAttributes as $key => $value) {
            $log .= $key . ' changed from ' . $inquiry->getOriginal($key) . ' to ' . $value . ', ';
        }
        $InquiryLog->log = $log;
        $InquiryLog->save(); 
        if($inquiry->handledBy){
            $inquiry->handledBy->notify(new InquiryUpdated($inquiry,$log));
        }

    }

    /**
     * Handle the Inquiry "deleted" event.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return void
     */
    public function deleted(Inquiry $inquiry)
    {
        //
    }

    /**
     * Handle the Inquiry "restored" event.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return void
     */
    public function restored(Inquiry $inquiry)
    {
        //
    }

    /**
     * Handle the Inquiry "force deleted" event.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return void
     */
    public function forceDeleted(Inquiry $inquiry)
    {
        //
    }
}
