<!-- resources/views/backend/users/view.blade.php -->

@extends('backend.layout.layout')

@section('page_header')
    <!-- ... (unchanged code) ... -->
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">User List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <button data-id="{{ $user->id }}" class="btn btn-primary btn-sm btnEditUser" data-toggle="modal" data-target="#editUserModal">Edit</button>
                                        <button data-id="{{ $user->id }}" class="btn btn-danger btn-sm" onclick="deleteUser({{ $user->id }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
    <form id="editUserForm">
        @csrf
        @method('PUT')
        <!-- Username Field -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="{{ $user->username }}" required>
        </div>

        <!-- Email Field -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="{{ $user->email }}" required>
        </div>

        <!-- Password Field -->
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter new password">
        </div>

        <!-- Confirm Password Field -->
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm new password">
        </div>

        <!-- Hidden field for user ID -->
        <input type="hidden" name="user_id" value="{{ $user->id }}">
    </form>
</div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnUpdateUser" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function () {
            // Add event listener for edit buttons
$(".btnEditUser").click(function () {
    var userId = $(this).data('id');
    
    // Perform AJAX request to fetch user data
    $.ajax({
        url: "{{ route('get-user-details', ['id' => ':id']) }}".replace(':id', userId),
        type: "GET",
        success: function (userData) {
            // Check if the response is a JSON object (assuming it is)
            if (typeof userData === 'object') {
                // Populate the modal form fields with user data
                $('#username').val(userData.username);
                $('#email').val(userData.email);
                $('#editUserModal').modal('show');
            } else {
                toastr.error('Error fetching user details.');
            }
        },
        error: function (xhr, status, error) {
            toastr.error(xhr.responseText);
        }
    });
});
// AJAX request on form submission
$("#btnUpdateUser").click(function () {
    var formData = $("#editUserForm").serialize();
    $.ajax({
        url: "{{ route('update-user', ['id' => $user->id]) }}",
        type: "POST",
        data: formData,
        success: function (response) {
            toastr.success('User updated successfully.');
            $('#editUserModal').modal('hide');
            window.location.href = "{{ route('view-users') }}";
        },
        error: function (xhr, status, error) {
            toastr.error(xhr.responseText);
        }
    });
});
        });
        function deleteUser(userId) {
            if (confirm("Are you sure you want to delete this photo?")) {
                $.ajax({
                    url: "/delete-user/" + userId,
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        toastr.success('user deleted successfully.');
                        window.location.href = "{{ route('view-users') }}";
                    },
                    error: function (xhr, status, error) {
                        toastr.error(xhr.responseText);
                    }
                });
            }
        }
    </script>
@endsection
