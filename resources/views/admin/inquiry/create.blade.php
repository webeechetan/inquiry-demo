@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">Create Inquiry</h5> <a href="{{ route('inquiries.index') }}"><small class="float-end btn btn-primary btn-sm">View Inquiries</small></a>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('inquiries.save') }}">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">First Name</label>
              <div class="col-sm-10">
                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="John">
                @error('first_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Last Name</label>
                <div class="col-sm-10">
                  <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Deo">
                  @error('last_name')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
            </div>
            
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
              <div class="col-sm-10">
                <div class="input-group input-group-merge">
                  <input type="text" name="email" id="basic-default-email" class="form-control" placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-default-email2">
                  
                </div>
                <div class="form-text"> You can use letters, numbers &amp; periods </div>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>

            {{-- Phone --}}

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="phone">Phone</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <input type="text" name="phone" id="phonel" class="form-control">
                    
                  </div>
                  <div class="form-text"> You can only use numbers </div>
                  @error('phone')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              {{-- Company Name --}}

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="company_name">Company Name (<b class="text-danger">*</b>)</label>
                    <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                        <input type="text" name="company_name" id="company_name" class="form-control">
                    </div>
                    @error('company_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                </div>

                {{-- Requirements --}}

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="requirements">Requirements (<b class="text-danger">*</b>)</label>
                    <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                        <textarea name="requirements" id="requirements" class="form-control"></textarea>
                    </div>
                    @error('requirements')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                </div>

                {{-- Budget --}}

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="budget">Budget (<b class="text-danger">*</b>)</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <select name="budget" id="budget" class="form-control">
                                <option value="">-Select-</option>
                                <option value="One-Time Project (Not Monthly)">One-Time Project (Not Monthly)</option>
                                <option value="INR 50000 to INR 1 Lakh Per Month">INR 50000 to INR 1 Lakh Per Month</option>
                                <option value="INR 1 Lac to INR 2 Lacs Per Month">INR 1 Lac to INR 2 Lacs Per Month</option>
                                <option value="INR 2 Lacs to INR 5 Lacs Per Month">INR 2 Lacs to INR 5 Lacs Per Month</option>
                                <option value="Above INR 5 lacs per month">Above INR 5 lacs per month</option>
                            </select>
                        </div>
                        @error('budget')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
    
                {{-- Handled_by --}}

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="handled_by">Handled By (<b class="text-danger">*</b>)</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <select name="handled_by" id="handled_by" class="form-control">
                                <option value="">-Select-</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        @error('handled_by')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Lead source --}}

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="lead_source">Lead Source (<b class="text-danger">*</b>)</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <select name="lead_source" id="lead_source" class="form-control">
                                <option value="">-Select-</option>
                                <option value="Website">Website</option>
                                <option value="Referral">Referral</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        @error('lead_source')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


            <div class="row justify-content-end">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection