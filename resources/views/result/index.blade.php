@extends('layouts.template')
@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}">
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
@endsection
@section('info-page')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
            {{ str_replace('-', ' ', Request::path()) }}</li>
    </ol>
    <h5 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h5>
@endsection
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid px-3 mt-2  flex-grow-1 container-p-y">
            <!-- DataTable with Buttons -->
            <div class="card" id="card-block">
                <div class="card-datatable pt-0">
                    <div class="table-responsive">
                        <table class="table table-striped nowrap" style="width:100%" id="table-data">
                            <thead>
                                <tr>
                                    <th class="align-middle">No</th>
                                    <th class="align-middle">Filename / Directory Name</th>
                                    <th class="align-middle">Result</th>
                                    <th class="align-middle">Similarity Measurement</th>
                                    <th class="align-middle">Generated Code</th>
                                    <th class="align-middle">Expired</th>
                                    <th class="align-middle">Actions</th> 
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                

                <!-- Modal -->
                <div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Delete Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <p>Are you sure want to delete this data?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form id="delete-form">
                                    <input id="delete-id" class="d-none" value="" />
                                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" type="button" data-bs-dismiss="modal">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
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
    <script src="{{ asset('./assets/dashboard/datatables-fixedheader-bs5/fixedheader.bootstrap5.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-fixedcolumns/datatables.fixedcolumns.js') }}"></script>
    <!-- Row Group JS -->
    <script src="{{ asset('./assets/dashboard/datatables-rowgroup/datatables.rowgroup.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-rowgroup-bs5/rowgroup.bootstrap5.js') }}"></script>
@endsection
@section('custom-javascript')
    <script type="text/javascript">
        // Helper function to decode HTML entities
        function decodeHTMLEntities(text) {
            const textarea = document.createElement("textarea");
            textarea.innerHTML = text;
            return textarea.value;
        }

        //Updated function to format generated code
        function formatGeneratedCode(generatedCode) {
            console.log("Raw generatedCode data:", generatedCode);

            let codeData;

            try {
                // Decode HTML entities if generatedCode is a string
                if (typeof generatedCode === "string") {
                    generatedCode = decodeHTMLEntities(generatedCode);
                    codeData = JSON.parse(generatedCode);
                } else {
                    codeData = generatedCode; // Assume it's already an object or array
                }
            } catch (error) {
                console.error("Error parsing generatedCode:", error);
                return "<p>Error displaying code.</p>";
            }

            if (!Array.isArray(codeData)) {
                return "<p>No recommendation code available</p>";
            }

            let formattedCode = "";
            codeData.forEach(function(item, index) {
                formattedCode += `
                    <div class="mb-3">
                        <strong>Question ${index + 1}:</strong><br>
                        <pre>${item.code}</pre>
                    </div>
                `;
            });

            return formattedCode;
        }



        $(document).ready(function() {
            
            $('#table-data').DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ env('URL_API') }}/api/v1/form/datatable",
                    "type": "GET",
                    'beforeSend': function(request) {
                        request.setRequestHeader("Authorization", "Bearer {{ $token }}");
                    },
                },
                "columns": [
                    {
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        title: 'No',
                        className: 'text-center'
                    }, 
                    {
                        data: null,
                        render: function(data, type, row) {
                            if (row.filename) {
                                // Define the download URL based on the row's filename
                                const downloadUrl = `{{ env('URL_API') }}/api/v1/download/` + row.filename;
                                return `<a href="#" class="download-link text-decoration-none text-black" data-filename="${row.filename}" data-url="${downloadUrl}">${row.filename}</a>`;
                            } else if (row.dir_file_path) {
                                return row.dir_file_path;
                            } else {
                                return 'No file available';
                            }
                        },
                        title: 'Zip Filename / Directory Name',
                    },
                    {   
                        data: null,
                        render: function(data, type, row) {
                            var result = row.result ? row.result : row.dir_file_path;
                            var apiBaseUrl = "{{ env('URL_API') }}";
                            
                            // Check if result path contains 'storage'
                            if (result.includes('storage')) {
                                // Assume it's under storage and construct the URL
                                return '<a class="btn btn-primary w-100" href="' + apiBaseUrl + '/' + result + '" target="_blank">' + row.filename + ' result' + '</a>';
                            }
                        },
                        title: 'Result' 
                    },
                    {
                        data: 'generated_code',
                        render: function(data, type, row, meta) {
                            if (data && data.length > 0) {
                                // Create a unique modal ID for each row
                                const modalId = `codeModal_${meta.row}`;

                                // Render the button that opens the modal
                                return `
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#${modalId}">
                                        View Generated Recommendation Code
                                    </button>

                                    <!-- Modal Structure -->
                                    <div class="modal fade" id="${modalId}" tabindex="-1" aria-labelledby="${modalId}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="${modalId}Label">Generated Code for ${row.filename || "Unnamed File"}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ${formatGeneratedCode(data)}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            } else {
                                return 'No reccomendation code available';
                            }
                        },
                        title: 'Generated code'
                    },
                    {
                        data: 'similarity_measurement',
                        title: 'Similarity Measurement'  
                    },
                    {
                        data: 'expired',
                        title: 'Expired',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        },
                    },
                    {
                        data: 'guid',
                        title: "Actions",
                        render: function(data, type, row, meta) {
                            return '<button data-bs-toggle="modal" data-bs-target="#modalDelete" data-guid="' +
                                row.guid +
                                '" class="btn btn-sm btn-icon item-edit open-delete-dialog"><i class="fa-solid fa-trash"></i></button>';
                        },
                        orderable: false,
                        searchable: false,
                        title: 'Action',
                        className: 'text-center'
                    },
                ],
                "language": {
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "Showing 0 to 0 of 0 entries",
                    "lengthMenu": "Show _MENU_ entries",
                    "loadingRecords": "Loading...",
                    "processing": "Processing...",
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "first": "<i class='fa-solid fa-angle-double-left'></i>",
                        "last": "<i class='fa-solid fa-angle-double-right'></i>",
                        "next": "<i class='fa-solid fa-angle-right'></i>",
                        "previous": "<i class='fa-solid fa-angle-left'></i>"
                    },
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                },
                dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                buttons: [
                    // Add other buttons here if needed
                ],
                displayLength: 10,
                lengthMenu: [10, 25, 50, 75],
                scrollX: true,
                width: "100%",
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function(e) {
                                return "Details of " + (e.data().filename ? e.data().filename : e.data().dir_file_path);
                            }
                        }),
                        type: "column",
                        renderer: function(e, t, a) {
                            a = $.map(a, function(e, t) {
                                return "" !== e.title ? '<tr data-dt-row="' + e.rowIndex +
                                    '" data-dt-column="' + e.columnIndex + '"><td >' + e.title +
                                    ":</td> <td >" + e.data + "</td></tr>" : "";
                            }).join("");
                            return !!a && $('<table class="table"/><tbody />').append(a);
                        }
                    },
                    selector: 'td:not(:first-child)'
                }
            });$('.head-label').html('<h4>Submission Similarity Result</h4>');



            $(document).on("click", ".open-delete-dialog", function() {
                var guid = $(this).data('guid');
                $("#delete-id").val(guid);
            });

            $('#delete-form').on('submit', function(e) {
                e.preventDefault();

                var guid = $('#delete-id').val();
                console.log(guid);

                $.ajax({
                    type: "DELETE",
                    url: "{{ env('URL_API') }}/api/v1/form/" + guid,
                    data: {

                    },
                    beforeSend: function(request) {
                        request.setRequestHeader("Authorization",
                            "Bearer {{ $token }}");

                        $("#card-block").block({
                            message: '<div class="spinner-border text-primary" role="status"></div>',
                            timeout: 1e3,
                            css: {
                                backgroundColor: "transparent",
                                border: "0"
                            },
                            overlayCSS: {
                                backgroundColor: "#fff",
                                opacity: .8
                            }
                        });
                    },
                    success: function(result) {
                        $.unblockUI();
                        toastr.options.closeButton = true;
                        toastr.options.timeOut = 1000;
                        toastr.options.onHidden = function() {
                            window.location.href = "{{ route('result') }}";
                        }
                        toastr.success(
                            "Success delete data", "Success"
                        );
                    },
                    error: function(xhr, status, error) {
                        $.unblockUI();
                        var jsonResponse = JSON.parse(xhr.responseText);

                        toastr.options.closeButton = true;
                        toastr.error(
                            jsonResponse['message'],
                            "Error",
                        );
                    }
                });
            });

            $(document).on('click', '.copy-text', function() {
                var textToCopy = $(this).data('text');
                
                // Create a temporary input element
                var $tempInput = $('<input>');
                $('body').append($tempInput);
                
                // Set the value of the input to the text we want to copy
                $tempInput.val(textToCopy).select();
                
                // Copy the text inside the input
                document.execCommand('copy');
                
                // Remove the temporary input
                $tempInput.remove();
                
                // Optionally provide feedback to the user using toastr
                toastr.success('Copied:\n' + textToCopy);
            });

            $(document).on('click', '.download-link', function(event) {
                event.preventDefault();
                const filename = $(this).data('filename');
                const downloadUrl = $(this).data('url');

                $.ajax({
                    type: "GET",
                    url: downloadUrl,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    beforeSend: function(request) {
                        request.setRequestHeader("Authorization", "Bearer {{ $token }}");

                        $("#card-block").block({
                            message: '<div class="spinner-border text-primary" role="status"></div>',
                            timeout: 1e3,
                            css: {
                                backgroundColor: "transparent",
                                border: "0"
                            },
                            overlayCSS: {
                                backgroundColor: "#fff",
                                opacity: .8
                            }
                        });
                    },
                    success: function(data, status, xhr) {
                        $.unblockUI();

                        var blob = new Blob([data], { type: xhr.getResponseHeader('Content-Type') });
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = filename;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);

                        toastr.options.closeButton = true;
                        toastr.options.timeOut = 1000;
                        toastr.success("Success download data", "Success");
                    },
                    error: function(xhr, status, error) {
                        $.unblockUI();
                        var jsonResponse = JSON.parse(xhr.responseText);

                        toastr.options.closeButton = true;
                        toastr.error(jsonResponse['message'], "Error");
                    }
                });
            });

        });
    </script>
@endsection
