<!DOCTYPE html>
<html lang="en">
@extends('backend.layout.layout')
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

@section('page_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Gallery</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Gallery</a></li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Gallery Details</h3>
                </div>
                <form id="galleryImageForm" action="{{ route('upload-gallery-image') }}" class="dropzone">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="galleryType">Type</label>
                            <select class="form-control" name="type" id="galleryType" required>
                                <option value="1">Wheat Storage</option>
                                <option value="2">Production of Flour</option>
                                <option value="3">Production of All Kinds of Bread</option>
                            </select>
                        </div>
                    </div>
                    <!-- Add a separate div for Dropzone if needed -->
                    <div id="galleryDropzone" class="dropzone"></div>
                    <div class="card-footer">
                        <button type="button" id="btnSaveGallery" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    Dropzone.options.galleryImageForm = {
        paramName: 'image', // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        acceptedFiles: 'image/*',
        success: function (file, response) {
            toastr.success(response.message);
            // You may handle the response, update the UI, etc.
        },
        error: function (file, response) {
            toastr.error(response.error);
        }
    };

    $(document).ready(function () {
        // AJAX request on form submission
        $("#btnSaveGallery").click(function () {
            $.ajax({
                url: "{{ route('store-gallery') }}", // Use your Laravel route
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    type: $("#galleryType").val(),
                    // Add other form fields if needed
                },
                success: function (response) {
                    toastr.success('Gallery created successfully.');
                    window.location.href = "{{ route('view-gallery') }}";
                },
                error: function (xhr, status, error) {
                    toastr.error(xhr.responseText);
                }
            });
        });
    });
</script>
