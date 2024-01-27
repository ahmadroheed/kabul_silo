@extends('backend.layout.layout')
@section('page_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Slider</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Slider</a></li>
            <li class="breadcrumb-item active">View</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('content')
<div class="row">
<div class="col-12">
<a href="{{ route('add-sliders') }}" class="btn btn-primary mb-3">Add Slider</a>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sliders Details</h3>
                <a href="" class=""></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="sliderTable" class="table table-bordered table-hover">
                  <thead class="text-center">
                  <tr>
                    <th>#</th>
                    <th>Language</th>
                    <th>title</th>
                    <th>text</th>
                    <th>Image</th>
                    <th>Operations</th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                  @foreach($sliders as $slider)
                  <tr>
                    <td style="vertical-align: middle">{{$slider->id}}</td>
                    <td style="vertical-align: middle">{{$slider->language}}</td>
                    <td style="vertical-align: middle">{{$slider->title}}</td>
                    <td style="vertical-align: middle">{{$slider->text}}</td>
                    <td style="vertical-align: middle">
                        <img src="{{ asset('uploads/' . $slider->photo) }}" alt="Slider Image" style="max-width: 100px; max-height: 100px;">
                    </td>
                    <td style="vertical-align: middle">
                    <button class="btn btn-info btn-sm" onclick="showSliderDetails({{ $slider->id }})">
                            <i class="fas fa-pen"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deleteSlider({{ $slider->id }})">
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
<!-- Modal for Slider Details -->
<div class="modal fade" id="sliderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="sliderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sliderDetailsModalLabel">Slider Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="sliderForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <!-- Add an image element to display the slider image -->
                        <div class="form-group text-center">
                            <img id="sliderImage" src="" alt="Slider Image" style="max-width: 100%; max-height: 200px;">
                        </div>
                        <div class="form-group">
                        <label for="sliderLanguage">Language</label>
                        <select class="form-control" name="sliderLanguage" id="sliderLanguage" placeholder="Enter email">
                            <option value="" selected>Please Select Language</option>
                            <option value="dari">Dari</option>
                            <option value="pashto">Pashto</option>
                            <option value="english">English</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="sliderTitle">Title</label>
                            <input type="text" class="form-control" name="sliderTitle" id="sliderTitle" placeholder="Enter slider title">
                        </div>
                        <div class="form-group">
                            <label for="sliderText">Text</label>
                            <input type="text" class="form-control" name="sliderText" id="sliderText" placeholder="Enter slider text">
                        </div>
                        <div class="form-group">
                        <label for="sliderFile">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="sliderFile" name="sliderFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                        <input type="hidden" id="sliderID" name="sliderID">
                    </div>
                    <div class="card-footer">
                        <button type="button" id="btnUpdate" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script>
function showSliderDetails(sliderId) {
    $.ajax({
        url: "/get-slider-details/" + sliderId,
        type: "GET",
        success: function (slider) {
            // Populate the modal fields with slider details
            $("#sliderLanguage").val(slider.language);
            $("#sliderTitle").val(slider.title);
            $("#sliderText").val(slider.text);
            $("#sliderID").val(slider.id);
            // Set the image source dynamically
            $("#sliderImage").attr("src", "{{ asset('uploads/') }}/" + slider.photo);
            // Display the modal
            $("#sliderDetailsModal").modal("show");
        },
        error: function (xhr, status, error) {
            //toastr.error(xhr.responseText);
            console.log(xhr.responseText);
        }
    });
}

    function deleteSlider(sliderId) {
        // Make an AJAX request to delete the slider
        if (confirm("Are you sure you want to delete this slider?")) {
            $.ajax({
                url: "/delete-slider/" + sliderId, // Create a route for this in your web.php file
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    toastr.success('Slider deleted successfully.');
                    window.location.href = "{{ route('view-sliders') }}";
                    // Optionally, you can remove the table row from the UI
                },
                error: function (xhr, status, error) {
                    toastr.error(xhr.responseText);
                }
            });
        }
    }
</script>
<script>
    $(document).ready(function () {
        $("#btnUpdate").click(function () {
            // Extract data from the form
            var formData = new FormData($("#sliderForm")[0]);

            // Make an AJAX request for updating the slider
            $.ajax({
                url: "/update-slider/" + $("#sliderID").val(), // Add a route for updating slider
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    toastr.success('Slider updated successfully.');
                    window.location.href = "{{ route('view-sliders') }}";
                },
                error: function (xhr, status, error) {
                    toastr.error(xhr.responseText);
                }
            });
        });
    });
</script>


