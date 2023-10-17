<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\DomPDF\Facade\Pdf;

class Inquiry extends Model
{
    use HasFactory;

    public function handledBy()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    public function pdf()
    {
        $pdf = Pdf::loadView('emails.new-inquiry', ['inquiry' => $this]);
        return $pdf->output();
    }

    public function logs()
    {
        return $this->hasMany(InquiryLog::class);
    }
}
