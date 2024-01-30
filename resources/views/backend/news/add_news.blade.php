<!DOCTYPE html>
<html lang="en">
@extends('backend.layout.layout')
@section('page_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">News</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">News</a></li>
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
                    <h3 class="card-title">News Details</h3>
                </div>
                <form id="newsForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="newsTitle">Title (Dari)</label>
                            <input type="text" class="form-control" name="newsTitleDari" id="newsTitleDari" placeholder="Enter news title in Dari" required>
                        </div>
                        <div class="form-group">
                            <label for="newsText">Text (Dari)</label>
                            <textarea class="form-control" name="newsTextDari" id="newsTextDari" placeholder="Enter news text in Dari" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="newsTitlePashto">Title (Pashto)</label>
                            <input type="text" class="form-control" name="newsTitlePashto" id="newsTitlePashto" placeholder="Enter news title in Pashto">
                        </div>
                        <div class="form-group">
                            <label for="newsTextPashto">Text (Pashto)</label>
                            <textarea class="form-control" name="newsTextPashto" id="newsTextPashto" placeholder="Enter news text in Pashto"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="newsTitleEnglish">Title (English)</label>
                            <input type="text" class="form-control" name="newsTitleEnglish" id="newsTitleEnglish" placeholder="Enter news title in English">
                        </div>
                        <div class="form-group">
                            <label for="newsTextEnglish">Text (English)</label>
                            <textarea class="form-control" name="newsTextEnglish" id="newsTextEnglish" placeholder="Enter news text in English"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="newsPhoto">Photo</label>
                            <input type="file" class="form-control" name="newsPhoto" id="newsPhoto" required>
                        </div>
                        <div class="form-group">
                            <label for="newsPersianDate">Persian Date</label>
                            <input type="text" class="form-control" name="persian_date" id="newsPersianDate" placeholder="Enter Persian date like yyyy/mm/dd format" required>
                        </div>
                        <div class="form-group">
                            <label for="newsGregorianDate">Gregorian Date</label>
                            <input type="date" class="form-control" name="gregorian_date" id="newsGregorianDate" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" id="btnSaveNews" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/lkssoiuj1x9rkmmfdxy2sok462d7zj6nas8b9eqz770r6sg7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<!-- Include Toastr CSS and JS files from CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    $(document).ready(function () {
        tinymce.init({
            selector: '#newsTextDari, #newsTextPashto,#newsTextEnglish',
            apiKey: 'lkssoiuj1x9rkmmfdxy2sok462d7zj6nas8b9eqz770r6sg7'
            // Add other TinyMCE options if needed
        });
    });
</script>
<script>
    $(document).ready(function () {
        // AJAX request on form submission
        $("#btnSaveNews").click(function () {
            var formData = new FormData($("#newsForm")[0]);
            formData.append('newsTextDari', tinymce.get('newsTextDari').getContent());
            formData.append('newsTextPashto', tinymce.get('newsTextPashto').getContent());
            formData.append('newsTextEnglish', tinymce.get('newsTextEnglish').getContent());

            $.ajax({
                url: "{{ route('save-news') }}", // Use your Laravel route
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    toastr.success('News created successfully.');
                    window.location.href = "{{ route('view-news') }}";
                },
                error: function (xhr, status, error) {
                    toastr.error(xhr.responseText);
                }
            });
        });
    });
</script>
