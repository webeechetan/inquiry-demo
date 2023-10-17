@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">Create User</h5> <a href="{{ route('users.index') }}"><small class="float-end btn btn-primary btn-sm">View Users</small></a>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
              <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="basic-default-name" placeholder="John Doe">
                @error('name')
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

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-phone">Password</label>
              <div class="col-sm-10">
                <input type="password" name="password" id="basic-default-phone" class="form-control phone-mask" placeholder="*****" aria-label="658 799 8941" aria-describedby="basic-default-phone">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-message">Designation</label>
              <div class="col-sm-10">
                <input type="text" name="designation" id="basic-default-designation" class="form-control phone-mask" placeholder="Manager" >
                @error('designation')
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