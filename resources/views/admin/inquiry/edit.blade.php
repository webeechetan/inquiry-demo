@extends('admin.layouts.app')
@section('content')
<div class="row">
  <div class="col-xxl">
    <div class="card mb-3">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Update Inquiry</h5> 
        <a href="{{ route('inquiries.index') }}"><small class="float-end btn btn-primary btn-sm">View Inquiries</small></a>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-body">
        <form method="POST" action="{{ route('inquiries.update-inquiry') }}">
          @csrf
          <!-- Hidden Buttons -->
          <input type="hidden" name="inquiryId" value="{{ $inquiry->id }}" id="">
          <!-- Hidden Buttons End -->

          <div class="row">

            <div class="col-md-3 mb-4">
              <!-- First Name -->
              <label class="col-form-label" for="basic-default-first-name">First Name</label>
              <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="{{ $inquiry->first_name }}">
              @error('first_name')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-md-3 mb-4">
              <!-- last Name -->
              <label class="col-form-label" for="basic-default-last-name">Last Name</label>
              <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="{{ $inquiry->last_name }}" >
              @error('last_name')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-md-3 mb-4">
              <!-- Email -->
              <label class="col-form-label" for="basic-default-email">Email</label>
              <input type="text" name="email" id="basic-default-email" class="form-control" placeholder="john.doe" value="{{ $inquiry->email }}">
              @error('email')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-md-3 mb-4">
              <!-- Phone -->
              <label class="col-form-label" for="phone">Phone</label>
              <input type="text" name="phone" id="phonel" class="form-control" value="{{ $inquiry->phone }}" >
              @error('phone')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-md-3 mb-4">
              <!-- Company Name -->
              <label class="col-form-label" for="company_name">Company Name</label>
              <input type="text" name="company_name" id="company_name" class="form-control" value="{{ $inquiry->company_name }}" >
              @error('company_name')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-md-3 mb-4">
              <!-- Requirements -->
              <label class="col-form-label" for="requirements">Requirements</label>
              <textarea name="requirements" id="requirements" class="form-control" >{{ $inquiry->requirements }}</textarea>
              @error('requirements')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            
            <div class="col-md-3 mb-4">
              <!-- Budget -->
              <label class="col-form-label" for="budget">Budget</label>
              <select name="budget" id="budget" class="form-control">
                <option value="{{ $inquiry->budget }}" selected>{{ $inquiry->budget }}</option>
                <option value="One-Time Project (Not Monthly)">One-Time Project (Not Monthly)</option>
                <option value="INR 50000 to INR 1 Lakh Per Month">INR 50000 to INR 1 Lakh Per Month</option>
                <option value="INR 1 Lac to INR 2 Lacs Per Month">INR 1 Lac to INR 2 Lacs Per Month</option>
                <option value="INR 2 Lacs to INR 5 Lacs Per Month">INR 2 Lacs to INR 5 Lacs Per Month</option>
                <option value="Above INR 5 lacs per month">Above INR 5 lacs per month</option>
              </select>
             
                        
              @error('budget')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-md-3 mb-4">
              <!-- Handled By -->
              <label class="col-form-label" for="handled_by">Handled By</label>
              <select name="handled_by" id="handled_by" class="form-control">
                @if($inquiry->handledBy)
                  <option value="{{ $inquiry->handledBy->id }}" selected>{{ $inquiry->handledBy->name }}</option>
                @endif
                @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }} </option>
                @endforeach
              </select>
              @error('handled_by')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-md-3 mb-4">
              <!-- Lead Source -->
              <label class="col-form-label" for="lead_source">Lead Source</label>
              <select name="lead_source" id="lead_source" class="form-control">
                <option value="Website"{{ $inquiry->lead_source == 'Website' ? ' selected' : '' }}>Website</option>
                <option value="Referral"{{ $inquiry->lead_source == 'Referral' ? ' selected' : '' }}>Referral</option>
                <option value="Others"{{ $inquiry->lead_source == 'Others' ? ' selected' : '' }}>Others</option>
              </select>
              
              @error('lead_source')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-md-3 mb-4">
              <!-- Commercial Sent -->
              <label class="col-form-label" for="lead_source">Commercial Sent</label>
              <select name="commercial" id="commercial" class="form-control commercial">
                <option value="1" data-inquiryId="{{ $inquiry->id }}" {{ $inquiry->commercial == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" data-inquiryId="{{ $inquiry->id }}" {{ $inquiry->commercial == 0 ? 'selected' : '' }}>No</option>
              </select>
              @error('commercial')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-md-3 mb-4">
              <!-- L1 -->
              <label class="col-form-label" for="L1">L1</label>
              
              <select name="L1" id="L1" class="form-control">
                  @if($inquiry->L1 == 'Done')
                      <option value="Done" data-inquiryId="{{ $inquiry->id }}" selected>Done</option>
                      <option value="Not Done" data-inquiryId="{{ $inquiry->id }}">Not Done</option>
                      <option value="Didnt Pick" data-inquiryId="{{ $inquiry->id }}">Didn't Pick</option>
                  @elseif($inquiry->L1 == 'Not Done')
                      <option value="Done" data-inquiryId="{{ $inquiry->id }}">Done</option>
                      <option value="Not Done" data-inquiryId="{{ $inquiry->id }}" selected>Not Done</option>
                      <option value="Didnt Pick" data-inquiryId="{{ $inquiry->id }}">Didn't Pick</option>
                  @elseif($inquiry->L1 == "Didnt Pick")
                      <option value="Done" data-inquiryId="{{ $inquiry->id }}">Done</option>
                      <option value="Not Done" data-inquiryId="{{ $inquiry->id }}">Not Done</option>
                      <option value="Didnt Pick" data-inquiryId="{{ $inquiry->id }}" selected>Didn't Pick</option>
                  @else
                      <!-- Add an option for when L1 is not set or empty -->
                      <option value="Not Done" data-inquiryId="{{ $inquiry->id }}">Not Done</option>
                  
                      <option value="Didnt Pick" data-inquiryId="{{ $inquiry->id }}">Didn't Pick</option>
                      <option value="Done" data-inquiryId="{{ $inquiry->id }}">Done</option>
                  @endif
              </select>

              @error('L1')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-md-3 mb-4">
              <!-- Brief -->
              <label class="col-form-label" for="brief">Brief</label>
              <select name="brief" id="brief" class="form-control brief">
                @if($inquiry->brief=='Done')
                <option value="Done" data-inquiryId="{{ $inquiry->id }}" selected>Done</option>
                <option value="Not Done" data-inquiryId="{{ $inquiry->id }}">Not Done</option>
                @else
                <option value="Not Done" data-inquiryId="{{ $inquiry->id }}" selected>Not Done</option>
                <option value="Done" data-inquiryId="{{ $inquiry->id }}">Done</option>
                @endif
              </select>
              @error('brief')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>


            <div class="col-md-3 mb-4">
              <!-- Handled By -->
              <label class="col-form-label" for="status">status</label>
                  @php
                  $leads = ['New Lead', 'Opportunity', 'Qualified Lead', 'AWOL', 'Converted',"Don't Want", 'Lost'];
                  $bg_color = '';
                  if($inquiry->lead_status == 'New Lead') {
                      $bg_color = 'text-warning';
                  } elseif($inquiry->lead_status == 'Opportunity') {
                      $bg_color = 'text-success';
                  } elseif($inquiry->lead_status == 'Qualified Lead') {
                      $bg_color = 'text-info';
                  } elseif($inquiry->lead_status == 'AWOL') {
                      $bg_color = 'text-danger';
                  } elseif($inquiry->lead_status == 'Converted') {
                      $bg_color = 'text-success';
                  } elseif($inquiry->lead_status == "Don't Want") {
                      $bg_color = 'text-danger';
                  } elseif($inquiry->lead_status == "Lost") {
                      $bg_color = 'text-danger';
                  }
                  @endphp
                  <select name="status" id="status" class="form-control {{ $bg_color }}">
                    @foreach($leads as $lead)
                        <option value="{{ $lead }}" {{ $inquiry->lead_status == $lead ? 'selected' : '' }}>{{ $lead }}</option>
                    @endforeach
                  </select>
                  @error('lead_status')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>

          


            <div class="col-md-3 mb-4">
              <!-- Last Contacted -->
              <label class="col-form-label" for="basic-default-name">First Contacted</label>
              <input type="date" name="first_contacted" class="form-control" id="first_contacted" placeholder="John" value="{{ $inquiry->first_contacted ? Carbon\Carbon::parse($inquiry->first_contacted)->format('Y-m-d') : '' }}">
              @error('first_contacted')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>


            <div class="col-md-3 mb-4">
              <!-- Last Contacted -->
              <label class="col-form-label" for="basic-default-name">Last Contacted</label>
              <input type="date" name="last_contacted" class="form-control" id="last_contacted" placeholder="John" value="{{ $inquiry->last_contacted ? Carbon\Carbon::parse($inquiry->last_contacted)->format('Y-m-d') : '' }}">
              @error('last_contacted')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="col-md-3 mb-4">
              <!-- Last Client Contacted -->
              <label class="col-form-label" for="basic-default-name">Last Client Contacted</label>
              <input type="date" name="last_client_contacted" class="form-control" id="last_client_contacted" placeholder="John" value="{{ $inquiry->last_client_contacted ? Carbon\Carbon::parse($inquiry->last_client_contacted)->format('Y-m-d') : '' }}">
              @error('last_client_contacted')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <!-- Row End -->
          </div>
          <div class="row">
            <div class="col-12 text-end">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection