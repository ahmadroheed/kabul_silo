@extends('backend.layout.layout')

@section('page_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Gallery</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Gallery</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('create-gallery') }}" class="btn btn-primary mb-3">Add Gallery</a>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gallery Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="overflow-x: auto;">
                    <table id="galleryTable" class="table table-bordered table-hover">
                        <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Photos</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        @foreach($galleryList as $gallery)
                            <tr>
                                <td style="vertical-align: middle">{{ $gallery->id }}</td>
                                <td style="vertical-align: middle">{{ $gallery->type }}</td>
                                <td style="vertical-align: middle">
                                    <img src="{{ asset($gallery->photo) }}" alt="gallery Image"
                                    style="max-width: 100px; max-height: 100px;">
                                </td>
                                <td style="vertical-align: middle">
                                    <a href="javascript:void(0);" class="btn btn-info btn-sm" onclick="showEditGallaryModal({{ $gallery->id }})">
                                        <i class="fas fa-pen"></i> Edit
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="openDeleteModal({{ $gallery->id }})">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
<!-- Add this modal at the end of your view file, after the main content -->
<div class="modal fade" id="EditGalleryModal" tabindex="-1" role="dialog" aria-labelledby="EditGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditGalleryModalLabel">Edit Gallery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editGalleryForm" enctype="multipart/form-data">
                    <div class="form-group text-center">
                        <img id="GalleryImage" src="" alt="Gallery Image"
                             style="max-width: 100%; max-height: 200px;">
                    </div>
                    <!-- Type Dropdown -->
                    <div class="form-group">
                        <label for="galleryType">Type</label>
                        <select class="form-control" name="type" id="galleryType" required>
                            <option value="1">Wheat Storage</option>
                            <option value="2">Production of Flour</option>
                            <option value="3">Production of All Kinds of Bread</option>
                        </select>
                    </div>
                    <!-- Photo File Input -->
                    <div class="form-group">
                        <label for="editGalleryPhoto">Photo</label>
                        <input type="file" class="form-control-file" id="editGalleryPhoto" name="editGalleryPhoto">
                    </div>
                    <!-- Hidden Field for Gallery ID -->
                    <input type="hidden" id="GalleryId" name="GalleryId" value="{{ $gallery->id }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">Edit</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script>
    function showEditGallaryModal(galleryId) {
    $.ajax({
        url: "/get-gallery-details/" + galleryId,
        type: "GET",
        success: function (gallery) {
            // Populate modal fields with gallery details
            $("#galleryType").val(gallery.type);
            $("#GalleryId").val(gallery.id);
            var photoPath = gallery.photo.replace(/["']/g, "");  // Remove double or single quotes
            $("#GalleryImage").attr("src", photoPath);
            // Corrected modal ID: change from "editGalleryModal" to "EditGalleryModal"
            $("#EditGalleryModal").modal("show");
        },
        error: function (xhr, status, error) {
            toastr.error(xhr.responseText);
        }
    });
}
$(document).ready(function () {
    var galleryId = $("#GalleryId").val();
    // You may need to adjust the form data based on your requirements
    var formData = new FormData($("#editGalleryForm")[0]);

    $.ajax({
        url: "/update-gallery/" + galleryId,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            toastr.success(response.message);
            window.location.href = "{{ route('view-gallery') }}";
        },
        error: function (xhr, status, error) {
            toastr.error(xhr.responseText);
        }
    });
});
</script>
<script>
    function openDeleteModal(galleryId) {
        $('#deleteGalleryModal').modal('show');
    }
</script>
@endsection
