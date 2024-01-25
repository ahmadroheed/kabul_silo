<!DOCTYPE html>
<html lang="en">
@extends('backend.layout.layout')
@section('page_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Biography</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Biography</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @if($isTableEmpty)
            <a href="#" class="btn btn-primary mb-3">Add Biography</a>
        @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Biography Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="biographyTable" class="table table-bordered table-hover">
                        <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>DR Text</th>
                            <th>PS Text</th>
                            <th>EN Text</th>
                            <th>Operations</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        @foreach($biographies as $biography)
                            <tr>
                                <td style="vertical-align: middle">{{ $biography->id }}</td>
                                <td style="vertical-align: middle">{{ $biography->name }}</td>
                                <td style="vertical-align: middle">
                                    <img src="{{ asset($biography->photo) }}" alt="Biography Photo"
                                         style="max-width: 100px; max-height: 100px;">
                                </td>
                                <td style="vertical-align: middle">{{ $biography->dr_text }}</td>
                                <td style="vertical-align: middle">{{ $biography->ps_text }}</td>
                                <td style="vertical-align: middle">{{ $biography->en_text }}</td>
                                <td style="vertical-align: middle">
                                    <button class="btn btn-info btn-sm"
                                            onclick="showBiographyDetails({{ $biography->id }})">
                                        <i class="fas fa-pen"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm"
                                            onclick="deleteBiography({{ $biography->id }})">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
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

    <!-- Modal for Biography Details -->
    <div class="modal fade" id="biographyDetailsModal" tabindex="-1" role="dialog"
         aria-labelledby="biographyDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="biographyDetailsModalLabel">Biography Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="biographyForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <!-- Add an image element to display the biography photo -->
                            <div class="form-group text-center">
                                <img id="biography_photos" src="" alt="Biography Photo"
                                     style="max-width: 100%; max-height: 200px;">
                            </div>
                            <div class="form-group">
                                <label for="biographyName">Name</label>
                                <input type="text" class="form-control" name="biographyName" id="biographyName"
                                       placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="dr_text">Dari Text</label>
                                <textarea class="form-control" name="dr_text" id="dr_text"
                                          placeholder="Enter Dari text"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="ps_text">Pashto Text</label>
                                <textarea class="form-control" name="ps_text" id="ps_text"
                                          placeholder="Enter Pashto text"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="en_text">English Text</label>
                                <textarea class="form-control" name="en_text" id="en_text"
                                          placeholder="Enter English text"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="biography_photos">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="biography_photos"
                                               name="biography_photos">
                                        <label class="custom-file-label" for="biography_photos">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="biographyID" name="biographyID">
                        </div>
                        <div class="card-footer">
                            <button type="button" id="btnUpdateBiography" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
function showBiographyDetails(biographyId) {
    $.ajax({
        url: "/get-biography-details/" + biographyId,
        type: "GET",
        success: function (biography) {
            // Populate the modal fields with biography details
            $("#biographyName").val(biography.name);
            
            // Initialize TinyMCE for textareas
            tinymce.init({
                selector: '#dr_text',
                apiKey: 'udd83ox8ggme12cqxl3djjr6kqoe2fesllbrd9xsrxk8t17p',
                setup: function (editor) {
                    editor.on('init', function () {
                        if (biography.dr_text) {
                            editor.setContent(biography.dr_text);
                        }
                    });
                }
            });

            tinymce.init({
                selector: '#ps_text',
                apiKey: 'udd83ox8ggme12cqxl3djjr6kqoe2fesllbrd9xsrxk8t17p',
                setup: function (editor) {
                    editor.on('init', function () {
                        if (biography.ps_text) {
                            editor.setContent(biography.ps_text);
                        }
                    });
                }
            });

            tinymce.init({
                selector: '#en_text',
                apiKey: 'udd83ox8ggme12cqxl3djjr6kqoe2fesllbrd9xsrxk8t17p',
                setup: function (editor) {
                    editor.on('init', function () {
                        if (biography.en_text) {
                            editor.setContent(biography.en_text);
                        }                    
                    });
                }
            });

            // Set the image source dynamically
            $("#biography_photos").attr("src", "{{ asset('uploads/') }}/" + biography.photo);

            // Display the modal
            $("#biographyDetailsModal").modal("show");
        },
        error: function (xhr, status, error) {
            toastr.error(xhr.responseText);
        }
    });
}
</script>
<script>
$(document).ready(function () {
    $("#btnUpdateBiography").click(function () {
        // Extract data from the form
        var formData = new FormData($("#biographyForm")[0]);

        // Get content from TinyMCE editors
        formData.append('dr_text', tinymce.get('dr_text').getContent());
        formData.append('ps_text', tinymce.get('ps_text').getContent());
        formData.append('en_text', tinymce.get('en_text').getContent());

        // Make an AJAX request for updating the biography
        $.ajax({
            url: "{{ route('update-biography', ['id' => $biography->id]) }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                toastr.success('Biography updated successfully.');
            },
            error: function (xhr, status, error) {
                toastr.error(xhr.responseText);
            }
        });
    });
});
    function deleteBiography(biographyId) {
        // Make an AJAX request to delete the biography
        if (confirm("Are you sure you want to delete this biography?")) {
            $.ajax({
                url: "/delete-biography/" + biographyId,
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    toastr.success('Biography deleted successfully.');
                    // Optionally, you can remove the table row from the UI
                },
                error: function (xhr, status, error) {
                    toastr.error(xhr.responseText);
                }
            });
        }
    }
</script>


