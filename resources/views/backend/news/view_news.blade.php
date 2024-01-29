@extends('backend.layout.layout')

@section('page_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">News</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">News</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{route('view-add-news')}}" class="btn btn-primary mb-3">Add News</a>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">News Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="overflow-x: auto;">
                    <table id="newsTable" class="table table-bordered table-hover">
                        <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Title(Dari)</th>
                            <th>Text(Dari)</th>
                            <th>Title(Pashto)</th>
                            <th>Text(Pashto)</th>
                            <th>Title(English)</th>
                            <th>Text(English)</th>
                            <th>Photo</th>
                            <th>Persian Date</th>
                            <th>Gregorian Date</th>
                            <th>Last Person Commented</th>
                            <th>Comments Amount</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        @foreach($newsList as $news)
                            <tr>
                                <td style="vertical-align: middle">{{ $news->id }}</td>
                                <td style="vertical-align: middle">{{ $news->dr_title }}</td>
                                <td style="vertical-align: middle">{{ $news->dr_text }}</td>
                                <td style="vertical-align: middle">{{ $news->ps_title }}</td>
                                <td style="vertical-align: middle">{{ $news->ps_text }}</td>
                                <td style="vertical-align: middle">{{ $news->en_title }}</td>
                                <td style="vertical-align: middle">{{ $news->en_text }}</td>
                                <td style="vertical-align: middle">
                                    <img src="{{ asset('uploads/news/' . $news->photo) }}" alt="News Image"
                                         style="max-width: 100px; max-height: 100px;">
                                </td>
                                <td style="vertical-align: middle">{{ $news->persian_date }}</td>
                                <td style="vertical-align: middle">{{ $news->gregorian_date }}</td>
                                <td style="vertical-align: middle">{{ $news->last_person_commented }}</td>
                                <td style="vertical-align: middle">{{ $news->comments_amount }}</td>
                                <td style="vertical-align: middle">
                                    <button class="btn btn-info btn-sm"
                                            onclick="showNewsDetails({{ $news->id }})">
                                        <i class="fas fa-pen"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm"
                                            onclick="deleteNews({{ $news->id }})">
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

    <!-- Modal for News Details -->
    <div class="modal fade" id="newsDetailsModal" tabindex="-1" role="dialog"
         aria-labelledby="newsDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newsDetailsModalLabel">News Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="newsForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <!-- Add an image element to display the news image -->
                            <div class="form-group text-center">
                                <img id="newsImage" src="" alt="News Image"
                                     style="max-width: 100%; max-height: 200px;">
                            </div>
                            <input type="hidden" id="NewsID" name="NewsID">
                            <div class="form-group">
                                <label for="newsTitle">Title(Dari)</label>
                                <input type="text" class="form-control" name="newsTitleDari" id="newsTitleDari"
                                       placeholder="Enter news dari title">
                            </div>
                            <div class="form-group">
                                <label for="newsText">Text(Dari)</label>
                                <textarea class="form-control" name="newsTextDari" id="newsTextDari"
                                          placeholder="Enter news dari text"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="newsTitle">Title(Pashto)</label>
                                <input type="text" class="form-control" name="newsTitlePashto" id="newsTitlePashto"
                                       placeholder="Enter news pashto title">
                            </div>
                            <div class="form-group">
                                <label for="newsText">Text(Pashto)</label>
                                <textarea class="form-control" name="newsTextPashto" id="newsTextPashto"
                                          placeholder="Enter news pashto text"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="newsTitle">Title(English)</label>
                                <input type="text" class="form-control" name="newsTitleEnglish" id="newsTitleEnglish"
                                       placeholder="Enter news english title">
                            </div>
                            <div class="form-group">
                                <label for="newsText">Text(English)</label>
                                <textarea class="form-control" name="newsTextEnglish" id="newsTextEnglish"
                                          placeholder="Enter news english text"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="newsFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="newsFile" name="newsFile">
                                        <label class="custom-file-label" for="newsFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
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
                            <button type="button" id="btnUpdateNews" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/lkssoiuj1x9rkmmfdxy2sok462d7zj6nas8b9eqz770r6sg7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<!-- Include Toastr CSS and JS files from CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    $(document).ready(function () {
        tinymce.init({
            selector: '#newsTitleDari, #newsTextDari, #newsTitlePashto,#newsTextPashto,#newsTitleEnglish,#newsTextEnglish',
            apiKey: 'lkssoiuj1x9rkmmfdxy2sok462d7zj6nas8b9eqz770r6sg7'
            // Add other TinyMCE options if needed
        });
    });
</script>
<script>
function showNewsDetails(newsId) {
    $.ajax({
            url: "/get-news-details/" + newsId, // Adjust the route based on your setup
            type: "GET",
            success: function (news) {
                // Populate the modal fields with news details
                tinymce.get('newsTitleDari').setContent(news.dr_title || '');
                tinymce.get('newsTextDari').setContent(news.dr_text || '');
                tinymce.get('newsTitlePashto').setContent(news.ps_title || '');
                tinymce.get('newsTextPashto').setContent(news.ps_text || '');
                tinymce.get('newsTitleEnglish').setContent(news.en_title || '');
                tinymce.get('newsTextEnglish').setContent(news.en_text || '');
                $("#newsPersianDate").val(news.persian_date);
                $("#newsGregorianDate").val(news.gregorian_date);
                $("#NewsID").val(news.id);
                // Set the image source dynamically
                $("#newsImage").attr("src", "{{ asset('uploads/news/') }}/" + news.photo);

                // Display the modal
                $("#newsDetailsModal").modal("show");
            },
            error: function (xhr, status, error) {
                toastr.error(xhr.responseText);
            }
        });
    }
</script>
<script>
    $(document).ready(function () {
        $("#btnUpdateNews").click(function () {
            var formData = new FormData($("#newsForm")[0]);
            formData.append('newsTitleDari', tinymce.get('newsTitleDari').getContent());
            formData.append('newsTextDari', tinymce.get('newsTextDari').getContent());
            formData.append('newsTitlePashto', tinymce.get('newsTitlePashto').getContent());
            formData.append('newsTextPashto', tinymce.get('newsTextPashto').getContent());
            formData.append('newsTitleEnglish', tinymce.get('newsTitleEnglish').getContent());
            formData.append('newsTextEnglish', tinymce.get('newsTextEnglish').getContent());
            var newsId = $('#NewsID').val();
            $.ajax({
                url: '/update-news/' + newsId,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    toastr.success(response.message);
                    window.location.href = "{{ route('view-news') }}";
                },
                error: function (xhr, status, error) {
                    toastr.error(xhr.responseText);
                }
            });
        });
    });
    function deleteNews(newsId) {
            if (confirm("Are you sure you want to delete this news?")) {
                $.ajax({
                    url: "/delete-news/" + newsId,
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        toastr.success('news deleted successfully.');
                        window.location.href = "{{ route('view-news') }}";
                    },
                    error: function (xhr, status, error) {
                        toastr.error(xhr.responseText);
                    }
                });
            }
        }
</script>
@endsection
