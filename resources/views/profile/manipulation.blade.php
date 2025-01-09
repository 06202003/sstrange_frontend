@extends('layouts.templateadmin')
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
                                    <th class="align-middle">Name</th>
                                    <th class="align-middle">Email</th>
                                    <th class="align-middle">Phone Number</th>
                                    <th class="align-middle">Role</th>
                                    <th class="align-middle">Email Verification</th>
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

        $(document).ready(function() {
            $('#table-data').DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ env('URL_API') }}/api/v1/user/datatable",
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
                                return `<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#codeModal_${row.guid}" class="text-decoration-none text-black">${row.name}</a>`;
                            }
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            if (row.name) {
                                return `<p class="text-decoration-none text-black" >${row.name}</p>`;
                            } else {
                                return 'No name available';
                            }
                        },
                        title: 'Name',
                    },
                    {   
                        data: null,
                        render: function(data, type, row) {
                            if (row.email) {
                                return `<p class="text-decoration-none text-black" >${row.email}</p>`;
                            } else {
                                return 'No email available';
                            }
                        },
                        title: 'Email',
                    },
                    {   
                        data: null,
                        render: function(data, type, row) {
                            if (row.phone_number) {
                                return `<p class="text-decoration-none text-black" >${row.phone_number}</p>`;
                            } else {
                                return 'No email available';
                            }
                        },
                        title: 'Phone Number',
                    },
                    {   
                        data: null,
                        render: function(data, type, row) {
                            if (row.role) {
                                return `<p class="text-decoration-none text-black" >${row.role}</p>`;
                            } else {
                                return 'No email available';
                            }
                        },
                        title: 'Role',
                    },
                    {   
                        data: null,
                        render: function(data, type, row) {
                            if (row.email_verified_at) {
                                var date = new Date(row.email_verified_at); // Convert string to Date object
                                var formattedDate = date.toLocaleDateString('id-ID'); // Format tanggal dalam format Indonesia
                                return `<p class="text-decoration-none text-black">Verified at ${formattedDate}</p>`;
                            } else {
                                // Tombol untuk update email_verified_at
                                return `
                                    <button class="btn btn-success btn-sm verify-user-btn w-100" 
                                            data-guid="${row.guid}">
                                        Verify
                                    </button>`;
                            }
                        },
                        title: 'Email Verification',
                    },
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
            });$('.head-label').html('<h4>Lecturer User Data</h4>');

            $(document).on('click', '.verify-user-btn', function() {
                var userId = $(this).data('guid'); // Ambil ID pengguna dari atribut data-id

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to verify this user's email.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, verify it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // AJAX request untuk update email_verified_at
                        $.ajax({
                            type: "POST",
                            url: "{{ env('URL_API') }}/api/v1/user/verification", // Sesuaikan endpoint API
                            data: {
                                id: userId
                            },
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
                            success: function(response) {
                                $.unblockUI();
                                toastr.options.closeButton = true;
                                toastr.options.timeOut = 1000;
                                toastr.options.onHidden = function() {
                                    window.location.href = "{{ route('manipulation') }}";
                                }
                                toastr.success(
                                    "Success update data", "Success"
                                );
                                // Refresh tabel setelah update
                                // $('#table-data').DataTable().ajax.reload(null, false);
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong while verifying the user.',
                                    'error'
                                );
                            }
                        });
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
                    url: "{{ env('URL_API') }}/api/v1/user/" + guid,
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

        });
    </script>
@endsection
