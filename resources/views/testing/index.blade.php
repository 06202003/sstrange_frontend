@extends('layouts.template')
@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@section('info-page')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
            {{ str_replace('-', ' ', Request::path()) }}</li>
    </ol>
    <h5 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h5>
@endsection
@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid px-3 mt-2 flex-grow-1 container-p-y">
        <!-- Upload PDF Form -->
        <div class="card" id="card-block">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Add PDF</h4>
            </div>
            <div class="card-body">
                <form id="upload-form" enctype="multipart/form-data">
                    <div class="row mt-2 mb-3">
                        <div class="col-md-12 mt-1" style="margin-bottom:4rem">
                            <label for="pdf" class="form-label">PDF</label>
                            <input class="form-control w-100" type="file" id="pdf" name="pdf" accept="application/pdf">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mt-1">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Display Parsed Text -->
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="mb-0">Parsed PDF Text</h4>
            </div>
            <div class="card-body">
                <form id="parsed-form">
                    <div class="row mt-2">
                        <div class="col-md-12 mt-1">
                            <textarea id="pdf-text" class="form-control" rows="10" placeholder="Parsed text will appear here..."></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mt-1">
                            <button type="submit" class="btn btn-success w-100">Save Parsed Text</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <h2>Questions</h2>
        <div id="questions-list"></div>
    </div>
</main>
@endsection
@section('vendor-javascript')
    <script src="{{ asset('./assets/dashboard/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-checkboxes-jquery/datatables.checkboxes.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-buttons/datatables-buttons.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-buttons/buttons.html5.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-buttons/buttons.print.js') }}"></script>
    <!-- Row Group JS -->
    <script src="{{ asset('./assets/dashboard/datatables-rowgroup/datatables.rowgroup.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-rowgroup-bs5/rowgroup.bootstrap5.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endsection
@section('custom-javascript')
<script type="text/javascript">
 $(document).ready(function() {
        $('#upload-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "{{ env('URL_API') }}/api/v1/testing",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(request) {
                    request.setRequestHeader("Authorization", "Bearer {{ $token }}");
                    $("#card-block").block({
                        message: '<div class="spinner-border text-primary" role="status"></div>',
                        css: {
                            backgroundColor: "transparent",
                            border: "0"
                        },
                        overlayCSS: {
                            backgroundColor: "#fff",
                            opacity: 0.8
                        }
                    });
                },
                success: function(result) {
                    $('#questions-list').empty();
                    var questionsText = '';

                    result.questions.forEach(function(question) {
                        questionsText += 'Question ' + question.number + ': ' + question.question + '\n\n';
                    });

                    $('#pdf-text').val(questionsText);
                    toastr.success("PDF processed successfully", "Success");
                },
                error: function(xhr) {
                    $.unblockUI();
                    toastr.error(xhr.responseJSON.message, "Error");
                },
                complete: function() {
                    $.unblockUI();
                }
            });
        });
    });
    

</script>
@endsection
