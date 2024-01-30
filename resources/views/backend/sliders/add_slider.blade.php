@extends('backend.layout.layout')
@section('page_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Slider</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Slider</a></li>
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
                <h3 class="card-title">Slider Details</h3>
            </div>
            <form id="sliderForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
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
                        <input type="text" class="form-control" name="sliderText" id="sliderText" placeholder="Enter slider text">
                    </div>
                    <div class="form-group">
                        <label for="sliderTitle">Text</label>
                        <input type="text" class="form-control" name="sliderTitle" id="sliderTitle" placeholder="Enter slider title">
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
                </div>
                <div class="card-footer">
                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script>
   $(document).ready(function () {
       // AJAX request on form submission
       $("#btnSave").click(function () {
           $.ajax({
               url: "{{ route('save-slider') }}", // Use your Laravel route
               type: "POST",
               data: new FormData($("#sliderForm")[0]),
               contentType: false,
               processData: false,
               success: function (response) {
                   toastr.success('slider created successfully.');
                   window.location.href = "{{ route('view-sliders') }}";

               },
               error: function (xhr, status, error) {
                   toastr.error(xhr.responseText);
               }
           });
       });
   });
</script>

@endsection
