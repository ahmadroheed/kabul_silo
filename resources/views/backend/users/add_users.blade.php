@extends('backend.layout.layout')
@section('page_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Users</a></li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">User Details</h3>
                </div>
                <form id="userForm">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" id="btnSaveUser" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function () {
            // AJAX request on form submission
            $("#btnSaveUser").click(function () {
                $.ajax({
                    url: "{{ route('save-user') }}", // Use your Laravel route
                    type: "POST",
                    data: new FormData($("#userForm")[0]),
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        toastr.success('User created successfully.');
                        window.location.href = "{{ route('view-users') }}";
                    },
                    error: function (xhr, status, error) {
                        toastr.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
