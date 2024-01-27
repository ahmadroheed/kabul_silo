@extends('backend.layout.layout')
@section('page_header')
    <!-- ... (same as in the biography section) ... -->
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Add Information Button -->
            <a href="#" class="btn btn-primary mb-3" onclick="showAddInformationModal()">Add Information</a>
            <!-- Information Table -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Information Details</h3>
                </div>
                <div class="card-body">
                <table id="informationTable" class="table table-bordered table-hover">
    <thead class="text-center">
        <tr>
            <th>#</th>
            <th>Type</th>
            <th>DR Text</th>
            <th>PS Text</th>
            <th>EN Text</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @if($informationList->isEmpty())
            <tr>
                <td colspan="6">No information data found</td>
            </tr>
        @else
            @foreach($informationList as $information)
                <tr>
                    <td style="vertical-align: middle">{{ $information->id }}</td>
                    <td style="vertical-align: middle">{{ $information->type }}</td>
                    <td style="vertical-align: middle">{{ $information->dr_text }}</td>
                    <td style="vertical-align: middle">{{ $information->ps_text }}</td>
                    <td style="vertical-align: middle">{{ $information->en_text }}</td>
                    <td style="vertical-align: middle">
                        <button class="btn btn-info btn-sm" onclick="showInformationDetails({{ $information->id }})">
                            <i class="fas fa-pen"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deleteInformation({{ $information->id }})">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

                </div>
            </div>
        </div>
    </div>

<!-- Modal for Information Details -->
<div class="modal fade" id="informationDetailsModal" tabindex="-1" role="dialog"
     aria-labelledby="informationDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="informationDetailsModalLabel">Information Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="informationForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <!-- Add an image element to display the information photo (if any) -->
                        <div class="form-group text-center">
                            <!-- You can add an image tag for the photo here if needed -->
                        </div>
                        <!-- Input field for Information Name -->
                        <div class="form-group">
                        <label for="InformationType">Type</label>
                        <select class="form-control" name="InformationType" id="InformationType" placeholder="Enter Information Type">
                            <option value="" selected>Please Select Information  Type</option>
                            <option value="1">History</option>
                            <option value="2">Structure</option>
                            <option value="3">Activities</option>
                        </select>
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
                        <input type="hidden" id="informationID" name="informationID">
                    </div>
                    <div class="card-footer">
                        <button type="button" id="btnUpdateInformation" name="btnUpdateInformation"
                                class="btn btn-primary">Save
                        </button>
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

<!-- Initialize Toastr -->
<script>
    toastr.options = {
        "closeButton": true,
        "positionClass": "toast-top-right",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "progressBar": true,
        "rtl": true  // If you are using RTL language
    }
</script>

    <!-- ... (same script structure as biography) ... -->
    <script>
    $(document).ready(function () {
        tinymce.init({
            selector: '#dr_text, #ps_text, #en_text',
            apiKey: 'lkssoiuj1x9rkmmfdxy2sok462d7zj6nas8b9eqz770r6sg7'
            // Add other TinyMCE options if needed
        });
    });
        function showAddInformationModal() {
            tinymce.get('dr_text').setContent('');
            tinymce.get('ps_text').setContent('');
            tinymce.get('en_text').setContent('');
            // Additional code for information modal if needed
            $("#informationDetailsModal").modal("show");
        }

        function showInformationDetails(informationId) {
            $.ajax({
                url: "/get-information-details/" + informationId,
                type: "GET",
                success: function (information) {
                    tinymce.get('dr_text').setContent(information.InformationType || '');
                    tinymce.get('dr_text').setContent(information.dr_text || '');
                    tinymce.get('ps_text').setContent(information.ps_text || '');
                    tinymce.get('en_text').setContent(information.en_text || '');
                    // Additional code for information modal if needed
                    $("#informationDetailsModal").modal("show");
                },
                error: function (xhr, status, error) {
                    toastr.error(xhr.responseText);
                }
            });
        }

        function deleteInformation(informationId) {
            if (confirm("Are you sure you want to delete this information?")) {
                $.ajax({
                    url: "/delete-information/" + informationId,
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        toastr.success('Information deleted successfully.');
                        window.location.href = "{{ route('view-information') }}";
                    },
                    error: function (xhr, status, error) {
                        toastr.error(xhr.responseText);
                    }
                });
            }
        }
        $(document).ready(function () {
        $("#btnUpdateInformation").click(function () {
            var formData = new FormData($("#informationForm")[0]);
            formData.append('dr_text', tinymce.get('dr_text').getContent());
            formData.append('ps_text', tinymce.get('ps_text').getContent());
            formData.append('en_text', tinymce.get('en_text').getContent());
            var informationId = "{{ $information->id ?? -1 }}";
        $.ajax({
            url: '/update-information/' + informationId,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                toastr.success(response.message);
                window.location.href = "{{ route('view-information') }}";
            },
            error: function (xhr, status, error) {
                toastr.error(xhr.responseText);
            }
        });
    });
});
    </script>
@endsection
