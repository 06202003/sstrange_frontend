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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.css" integrity="sha512-uf06llspW44/LZpHzHT6qBOIVODjWtv4MxCricRxkzvopAlSWnTf6hpZTFxuuZcuNE9CBQhqE0Seu1CoRk84nQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
    <style>
        #table-data {
            font-size: 12px;
        }

        .align-middle{
            font-size: 12px;
        }

        #table-data td {
            font-size: 12px;
        }

        .dataTables_paginate {
            text-align: center;
            margin-top: 10px;
        }

        .dataTables_paginate .paginate_button {
            font-size: 12px;
            text-align: center;
        }

        .dataTables_paginate .paginate_button:hover {
         
            color: white;
        }

        .dataTables_paginate .paginate_button.disabled {
            background-color: #f8f9fa;
            color: #6c757d;
            cursor: not-allowed;
        }
    </style>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.js" integrity="sha512-8RnEqURPUc5aqFEN04aQEiPlSAdE0jlFS/9iGgUyNtwFnSKCXhmB6ZTNl7LnDtDWKabJIASzXrzD0K+LYexU9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/python/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/clike/clike.min.js"></script>
@endsection
@section('custom-javascript')
    <script type="text/javascript">
        console.log('{{ $token }}')
        // Helper function to decode HTML entities
        function decodeHTMLEntities(text) {
            const textarea = document.createElement("textarea");
            textarea.innerHTML = text;
            return textarea.value;
        }

        //Updated function to format generated code
        // function formatGeneratedCode(generatedCode) {
        //     console.log("Raw generatedCode data:", generatedCode);

        //     let codeData;

        //     try {
        //         // Decode HTML entities if generatedCode is a string
        //         if (typeof generatedCode === "string") {
        //             generatedCode = decodeHTMLEntities(generatedCode);
        //             codeData = JSON.parse(generatedCode);
        //         } else {
        //             codeData = generatedCode; // Assume it's already an object or array
        //         }
        //     } catch (error) {
        //         console.error("Error parsing generatedCode:", error);
        //         return "<p>Error displaying code.</p>";
        //     }

        //     if (!Array.isArray(codeData)) {
        //         return "<p>No recommendation code available</p>";
        //     }

        //     let formattedCode = "";
        //     codeData.forEach(function(item, index) {
        //         formattedCode += `
        //             <div class="mb-3">
        //                 <strong>Question ${index + 1}:</strong><br>
        //                 <pre>${item.code}</pre>
        //             </div>
        //         `;
        //     });

        //     return formattedCode;
        // }

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

            // Check if codeData is an array and filter out any duplicates
            if (!Array.isArray(codeData)) {
                return "<p>No recommendation code available</p>";
            }

            // Optional: Remove duplicates (if applicable) based on code content
            const uniqueCodeData = codeData.filter((item, index, self) =>
                index === self.findIndex((t) => t.code === item.code)
            );

            let formattedCode = "";
            uniqueCodeData.forEach(function(item, index) {
                const uniqueEditorId = `codeMirrorEditor_${index}`;

                formattedCode += `
                    <div class="mb-3">
                        <strong>Question ${index + 1}:</strong><br>
                        <textarea id="${uniqueEditorId}" class="form-control" rows="10">${item.code}</textarea>
                    </div>
                `;

            });

            return formattedCode;
        }


        // Add a global event listener to handle saving data when modal is closed
        document.addEventListener('click', function(event) {
            if (event.target.matches('[data-save-trigger]')) {
                // Get the closest modal to the clicked element
                const modal = event.target.closest('.modal');
                const textareas = modal.querySelectorAll('textarea');
                const updatedData = Array.from(textareas).map(textarea => ({
                    code: textarea.value
                }));

                // JSON.stringify the updated data to be sent in the AJAX request
                const generatedCodeStoring = JSON.stringify(updatedData);

                // Retrieve the guid from the associated button that triggered the modal
                const triggerButton = document.querySelector(`[data-bs-target="#${modal.id}"]`);
                const guid = triggerButton ? triggerButton.getAttribute('data-guid') : null;


                // Proceed with your AJAX request if guid is found
                if (guid) {
                    $.ajax({
                        type: "POST",
                        url: "{{ env('URL_API') }}/api/v1/updateform",
                        contentType: "application/json",
                        data: JSON.stringify({
                            guid: guid,
                            generated_code: generatedCodeStoring
                        }),
                        beforeSend: function(request) {
                            request.setRequestHeader("Authorization", "Bearer {{ $token }}");
                        },
                        success: function(response) {
                            toastr.options.closeButton = true;
                            toastr.options.timeOut = 1000;
                            toastr.options.onHidden = function() {
                                var url = "{{ route('result') }}";
                                window.location.href = url;
                            };
                            toastr.success("Data updated successfully", "Success");
                        },
                        error: function(xhr) {
                            toastr.error("Error updating data", "Error");
                        }
                    });
                } else {
                    console.error('No GUID found for this modal.');
                }
            }
        });



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
                        className: 'text-center',
                        responsivePriority: 1, // Prioritaskan kolom ini di tampilan desktop
                        render: function(data, type, row) {
                            if (type === 'display') {
                                return data;  // Menampilkan nomor urut di desktop
                            } else {
                                // Menampilkan nama tugas yang bisa diklik pada tampilan mobile
                                return `<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#codeModal_${row.guid}" class="text-decoration-none text-black">${row.filename}</a>`;
                            }
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            if (row.filename) {
                                return `<p class="text-decoration-none text-black" >${row.filename}</p>`;
                            } else if (row.dir_file_path) {
                                return row.dir_file_path;
                            } else {
                                return 'No file available';
                            }
                        },
                        title: 'Assessment Name',
                    },
                    {   
                        data: null,
                        render: function(data, type, row) {
                            var result = row.result ? row.result : row.dir_file_path;
                            var apiBaseUrl = "{{ env('URL_API') }}";
                            
                            // Check if result path contains 'storage'
                            if (result && typeof result === 'string' && result.includes('storage')) {
                                // Jika valid, bangun URL dan return elemen HTML
                                return '<a class="btn btn-primary w-100" style="font-size:12px;" href="' + apiBaseUrl + '/' + result + '" target="_blank">' + 'Observe' + '</a>';
                            } else {
                                // Return nilai default jika result tidak valid
                                return '<span class="text-muted">No Reports Available</span>';
                            }
                        },
                        title: 'Reports' 
                    },
                    {
                        data: 'generated_code',
                        render: function(data, type, row, meta) {
                            if (data && data.length > 0) {
                                // Create a unique modal ID for each row
                                const modalId = `codeModal_${meta.row}`;
                                const guid = row.guid;
                                // Render the button that opens the modal
                                return `
                                    <button type="button" class="btn btn-primary w-100" style="font-size:12px;" data-bs-toggle="modal" data-bs-target="#${modalId}" data-guid="${guid}">
                                        View Generated Code
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
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-save-trigger="true">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            } else {
                                return 'No recomendation code available';
                            }
                        },
                        title: 'Generated code'
                    },
                    {
                        data: 'similarity_measurement',
                        title: 'Similarity Measurement',
                        render: function(data, type, row) {
                            const similarityMapping = {
                                'minhash': 'MinHash',
                                'super-bit': 'Super-Bit',
                                'jaccard': 'Jaccard',
                                'cosine': 'Cosine',
                                'rkrgst': 'RKR-GST',
                                'sensitive minhash': 'Sensitive MinHash',
                                'sensitive super-bit': 'Sensitive Super-Bit',
                                'sensitive jaccard': 'Sensitive Jaccard',
                                'sensitive cosine': 'Sensitive Cosine',
                                'sensitive rkrgst': 'Sensitive RKR-GST'
                            };
                            
                            // Return formatted value or fallback to raw data
                            return similarityMapping[data] || data || '-';
                        }
                    },
                    {
                        data: 'expired',
                        title: 'Expired',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        },
                    },
                    // {
                    //     data: 'guid',
                    //     title: "Actions",
                    //     render: function(data, type, row, meta) {
                    //         return '<button data-bs-toggle="modal" data-bs-target="#modalDelete" data-guid="' +
                    //             row.guid +
                    //             '" class="btn btn-sm btn-icon item-edit open-delete-dialog"><i class="fa-solid fa-trash"></i></button>';
                    //     },
                    //     orderable: false,
                    //     searchable: false,
                    //     title: 'Action',
                    //     className: 'text-center'
                    // },
                    {
                        data: 'guid',
                        title: "Actions",
                        render: function(data, type, row, meta) {
                            var result = row.result;
                            var directoryPath = result && typeof result === 'string' ? result.substring(0, result.lastIndexOf('/')) : '';

                            return `
                                <button data-bs-toggle="modal" data-bs-target="#modalDelete" data-guid="${row.guid}" 
                                    class="btn btn-sm btn-icon item-edit open-delete-dialog" title="Delete">
                                    <i class="fa-solid fa-trash fa-xl" style="color:red;"></i>
                                </button>
                                <button data-guid="${row.guid}" class="btn btn-sm btn-icon btn-download" title="Download ZIP">
                                    <i class="fa-solid fa-download fa-xl"></i>
                                </button>
                            `;
                        },
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
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
                displayLength: 5,
                lengthMenu: [5, 10, 15, 25],
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
                                return "" !== e.title ? `<tr data-dt-row="${e.rowIndex}" data-dt-column="${e.columnIndex}"><td>${e.title}:</td><td>${e.data}</td></tr>` : "";
                            }).join("");
                            return !!a && $('<table class="table"/><tbody />').append(a);
                        }
                    },
                    selector: 'td:not(:first-child)'
                }
            });$('.head-label').html('<h4>Similarity Reports</h4>');

            $(document).on('click', '.btn-download', function() {
                var guid = $(this).data('guid');
                
                // Kirim request ke backend untuk mengunduh file ZIP berdasarkan GUID
                $.ajax({
                    url: '{{ env('URL_API') }}/api/v1/form/download-directory', // Ganti dengan endpoint API Anda
                    type: 'POST',
                    data: { guid: guid },  // Kirim GUID ke backend
                    beforeSend: function(request) {
                        request.setRequestHeader("Authorization", "Bearer {{ $token }}");
                    },
                    success: function(response) {
                        // Jika backend mengembalikan URL file ZIP, lakukan download
                        var zipFileUrl = response.zipFileUrl;
                        if (zipFileUrl) {
                            // Buat elemen anchor untuk melakukan download otomatis
                            var a = document.createElement('a');
                            a.href = zipFileUrl;
                            a.download = ''; // Nama file dapat diatur sesuai keinginan
                            document.body.appendChild(a);
                            a.click();
                            document.body.removeChild(a);
                        } else {
                            alert("File tidak ditemukan atau gagal untuk diunduh.");
                        }
                    },
                    error: function() {
                        alert("Terjadi kesalahan saat mencoba mengunduh file.");
                    }
                });
            });



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
