<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

Route::get('/fake-user',function(){
    $user = \App\Models\User::factory()->has(\App\Models\Inquiry::factory()->count(5))->count(3)->create();
});

// Route::get('/fake-inquiry',function(){
//     $inquiry = \App\Models\Inquiry::factory()->count(20)->create();
//     return $inquiry;
// });


Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');


/*--------------------------------- Auth Routes ---------------------------------*/

Route::get('/', [AuthController::class, 'index'])->name('login.view')->middleware('guest');
Route::get('/admin/login', [AuthController::class, 'index'])->name('login.view')->middleware('guest');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login')->middleware('guest');


Route::group(['middleware' => 'auth','prefix'=>'/admin'], function () {

    Route::get('/dashboard/{fromDate?}/{toDate?}/{filters?}', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    /*--------------------------------- Inquiry Routes ---------------------------------*/

    Route::get('/inquiries/create', [InquiryController::class, 'create'])->name('inquiries.create');
    Route::get('/inquiries/{filters?}', [InquiryController::class, 'index'])->name('inquiries.index');
    Route::post('/inquiries/save', [InquiryController::class, 'save'])->name('inquiries.save');
    Route::post('/inquiries/update', [InquiryController::class, 'update'])->name('inquiries.update');
    Route::get('/inquiries/edit/{inquiry?}', [InquiryController::class, 'edit'])->name('inquiries.edit');
    Route::post('/inquiries/updateInquiry', [InquiryController::class, 'updateInquiry'])->name('inquiries.update-inquiry');
    Route::delete('/inquiries/destroy/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');
    Route::post('/inquiries/updateStatus', [InquiryController::class, 'updateStatus'])->name('inquiries.update-status');
    Route::post('/inquiries/updateL1', [InquiryController::class, 'updateL1'])->name('inquiries.update-l1');
    Route::post('/inquiries/save_l1_minutes', [InquiryController::class, 'saveL1Minutes'])->name('inquiries.save-l1-minutes');
    Route::post('/inquiries/updateBriefStatus', [InquiryController::class, 'updateBriefStatus'])->name('inquiries.update-brief-status');
    Route::post('/inquiries/saveBreafDetails', [InquiryController::class, 'saveBreafDetails'])->name('inquiries.save-brief-details');
    Route::post('/inquiries/updateFirstContacted', [InquiryController::class, 'updateFirstContacted'])->name('inquiries.update-first-contacted');
    Route::post('/inquiries/updateLastClientContacted', [InquiryController::class, 'updateLastClientContacted'])->name('inquiries.update-last-client-contacted');
    Route::post('/inquiries/updateLastContacted', [InquiryController::class, 'updateLastContacted'])->name('inquiries.update-last-contacted');
    Route::post('/inquiries/updateCommercial', [InquiryController::class, 'updateCommercial'])->name('inquiries.update-commercial');
    Route::post('/inquiries/search', [InquiryController::class, 'search'])->name('inquiries.search');
    Route::get('/inquiries/view/{inquiry?}', [InquiryController::class, 'show'])->name('inquiries.view');

    Route::get('/inquiries/view-actions/{inquiry}', [InquiryController::class, 'viewActions'])->name('inquiries.view-actions');

    /*--------------------------------- User Routes ---------------------------------*/

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');

});

// incoming slack webhook 

Route::post('/incoming_slack_request',function(Request $request){
    // log incoming request
    Log::info($request->all());
});

Route::get('/email-template', function(Request $request){
    return view('emails.email-template');
});