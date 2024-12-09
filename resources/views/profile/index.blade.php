@extends('layouts.template')
@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
@endsection
{{-- @section('info-page')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
            User/Profile</li>
    </ol>
    <h5 class="font-weight-bolder mb-0 text-capitalize">User/Profile</h5>
@endsection --}}
@section('content')

    <div class="container-fluid fixed-plugin px-3 mt-2 flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-start" id="card-block">
            <div class="col-md-12">
                <div class="card">  
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <form id="formupdateuser"  enctype="multipart/form-data">
                            <div class="">
                                <input type="text" class="form-control" id="guid" placeholder="Input Id" required
                                    value="{{ $data['data']['guid'] }}" hidden />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Input Name" required
                                    value="{{ $data['data']['name'] }}" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" required
                                    value="{{ $data['data']['email'] }}" readonly />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Phone Number</label>
                                <input type="phone-number" class="form-control" id="phone-number" placeholder="phone-number"
                                    required value="{{ $data['data']['phone_number'] }}" />
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            @if (!isset($data['data']['google_id']))
                                <a href="{{ route('google-sync') }}" class="btn btn-danger btn-block"><i
                                        class="fab fa-google mr-2"></i>Sync Google</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
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
@endsection
@section('custom-javascript')
    <script type="text/javascript">
    $(document).ready(function() {
        $('#formupdateuser').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            console.log(formData);
            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }

            $.ajax({
                type: "PUT",
                url: "{{ env('URL_API') }}/api/v1/updateuser", 
                data: formData,
                contentType: false,
                processData: false,
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
                    success: function(result) {
                        $.unblockUI();
                        toastr.options.closeButton = true;
                        toastr.options.timeOut = 1000;
                        toastr.options.onHidden = function() {
                            window.location.href = "{{ route('user-profile') }}";
                        }
                        toastr.success(
                            "Success update data", "Success"
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
