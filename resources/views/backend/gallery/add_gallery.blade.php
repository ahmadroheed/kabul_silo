<!DOCTYPE html>
<html lang="en"> @extends('backend.layout.layout') @section('page_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Gallery</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="#">Gallery</a>
                </li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    @endsection @section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Gallery Details</h3>
                </div>
                <form id="galleryImageForm" action="{{ route('upload-gallery-image') }}" method="post"> 
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                        <label for="galleryType">Type</label>
                        <select class="form-control" name="type" id="galleryType" required>
                            <option value="">Select type of gallery</option>
                            <option value="1">Wheat Storage</option>
                            <option value="2">Production of Flour</option>
                            <option value="3">Production of All Kinds of Bread</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="galleryPhoto">Photo</label>
                        <input type="file" class="form-control" name="galleryPhoto[]" id="galleryPhoto" multiple required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" id="btnSaveGallery" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
    // AJAX request on form submission
    $("#btnSaveGallery").click(function() {
        // Create a FormData object to handle file uploads
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('type', $("#galleryType").val());

        // Append each selected file to the FormData object
        var files = $("#galleryPhoto")[0].files;
        for (var i = 0; i < files.length; i++) {
            formData.append('galleryphoto[]', files[i]);
        }

        $.ajax({
            url: "{{ route('store-gallery') }}",
            type: "POST",
            processData: false,  // Important for handling FormData
            contentType: false,  // Important for handling FormData
            data: formData,
            success: function(response) {
                toastr.success('Gallery created successfully.');
                window.location.href = "{{ route('view-gallery') }}";
            },
            error: function(xhr, status, error) {
                toastr.error(xhr.responseText);
            }
        });
    });
});

    </script>
@endsection