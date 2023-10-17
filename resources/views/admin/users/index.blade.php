@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Users</h5> <small class="float-end btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addNewUserModal">Create New</small>
            </div>
            <div class="card-body">
                <table class="table table-hover mb-0" id="usersTable">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->designation }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item edit_user" href="#" data-bs-toggle="modal" data-bs-target="#editUserModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-designation="{{ $user->designation }}">Edit</a></li>
                                        <li><a class="dropdown-item" href="{{ route('users.destroy',$user->id) }}">Delete</a></li>
                                    </ul>
                                </div>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- add new user modal --}}

<div class="modal fade" id="addNewUserModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="new_user_form">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nameSmall" class="form-label">Name</label>
                            <input type="text" required id="name" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="col-md-6">
                            <label for="nameSmall" class="form-label">Email</label>
                            <input type="text" required id="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="col-md-6">
                            <label for="nameSmall" class="form-label">Password</label>
                            <input type="password" required id="password" name="password" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="col-md-6">
                            <label for="nameSmall" class="form-label">Designation</label>
                            <input type="text" required id="designation" name="designation" class="form-control" placeholder="Enter designation">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit_btn">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- edit user modal--}}
<div class="modal fade" id="editUserModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="edit_user_form">
                @csrf
                <input type="hidden" name="" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nameSmall" class="form-label">Name</label>
                            <input type="text" required id="edit_name" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="col-md-6">
                            <label for="nameSmall" class="form-label">Email</label>
                            <input type="text" required id="edit_email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="col-md-6">
                            <label for="nameSmall" class="form-label">Designation</label>
                            <input type="text" required id="edit_designation" name="designation" class="form-control" placeholder="Enter designation">
                        </div>

                        <div class="col-md-6">
                            <label for="nameSmall" class="form-label">Password</label>
                            <input type="password" autocomplete=""  id="edit_password" name="edit_password" class="form-control" placeholder="Enter Password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update_btn">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        let table = $('#usersTable').DataTable({
            responsive: true,
            "dom": '<"top"f>rt<"bottom"lip><"clear">',
            language: { search: '<i class="bx bx-search"></i>', searchPlaceholder: "Search...",},
        });

        $('#new_user_form').on('submit', function(e) {
            e.preventDefault();
            $('.submit_btn').prop('disabled', true);
            let name = $('#name').val();
            let email = $('#email').val();
            let password = $('#password').val();
            let designation = $('#designation').val();
            let _token = $('input[name=_token]').val();

            $.ajax({
                url: "{{ route('users.store') }}",
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    password: password,
                    designation: designation,
                    _token: _token
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                        $('#usersTable tbody').prepend('<tr><td>' + name + '</td><td>' + email + '</td><td>' + designation + '</td></tr>');
                        $('#new_user_form')[0].reset();
                        $('#addNewUserModal').modal('hide');
                        toast('Success', 'User Created Successfully', 'success');
                        $('.submit_btn').prop('disabled', false);
                    }
                },
                error: function(response) {
                    $('.submit_btn').prop('disabled', false);
                    toast('Error', 'Something Went Wrong', 'error');
                }
            });
        });

        // edit user 

        $(".edit_user").click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let designation = $(this).data('designation');
           
            $('#id').val(id);
            $('#edit_name').val(name);
            $('#edit_email').val(email);
            $('#edit_designation').val(designation);
        });

        $('#edit_user_form').on('submit', function(e) {
            e.preventDefault();

           
            $('.update_btn').prop('disabled', true);
            let id = $('#id').val();
            let name = $('#edit_name').val();
            let email = $('#edit_email').val();
            let designation = $('#edit_designation').val();
            let edit_password = $('#edit_password').val();
            let _token = $('input[name=_token]').val();

            $.ajax({
                url: "{{ route('users.update') }}",
                type: "POST",
                data: {
                    id: id,
                    name: name,
                    email: email,
                    edit_password: edit_password,
                    designation: designation,
                    _token: _token
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                        $('#usersTable tbody').prepend('<tr><td>' + name + '</td><td>' + email + '</td><td>' + designation + '</td></tr>');
                        $('#edit_user_form')[0].reset();
                        $('#editUserModal').modal('hide');
                        toast('Success', 'User Updated Successfully', 'success');
                        $('.update_btn').prop('disabled', false);
                    }
                },
                error: function(response) {
                    $('.update_btn').prop('disabled', false);
                    toast('Error', 'Something Went Wrong', 'error');
                }
            });
        });
    });
</script>
@endsection