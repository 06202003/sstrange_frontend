<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ url('user/profile') }}" class="d-block text-decoration-none">{{ $name }}</a>
        </div>
    </div>
    <style>
        .nav-link {
            display: flex;
            align-items: center; /* Untuk menyelaraskan ikon dan teks di tengah */
        }

        .nav-icon {
            margin-right: 10px; /* Memberikan jarak antara ikon dan teks */
        }
        .nav-link.active {
            background: linear-gradient(to right, #8cbf37, #27a4b3); /* Gradien dari biru (primary) ke #27a4b3 */
            color: white; /* Warna teks putih */
        }
    </style>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/dashboard') }}" class="nav-link text-decoration-none {{ Request::is('dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gauge"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ url('/form') }}" class="nav-link text-decoration-none {{ Request::is('form') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-contract"></i>
                    <p>{{ __('Submission Form') }}</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ url('/result') }}" class="nav-link text-decoration-none {{ Request::is('result') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>{{ __('Similarity Result') }}</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ url('/codegen') }}" class="nav-link text-decoration-none {{ Request::is('codegen') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-code"></i>
                    <p>{{ __('Code Generator') }}</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ url('/about') }}" class="nav-link text-decoration-none {{ Request::is('about') ? 'active' : '' }}">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>{{ __('About us') }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a id="logoutsecond" class="nav-link text-decoration-none {{ Request::is('logout') ? 'active' : '' }}">
                    <i class="nav-icon  fas fa-sign-out-alt"></i>
                    {{ __('Log Out') }}
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
<script type="module">
    $(document).ready(function() {

        $("#logoutsecond").click(function(e) {
            e.preventDefault();

            var token = "{{ $token }}";

            $.ajax({
                type: "POST",
                url: "{{ env('URL_API') }}/api/v1/auth/logout",
                headers: {
                    'Authorization': 'Bearer ' + token,
                },
                data: {
                    _token: "{{ csrf_token() }}",
                },
                beforeSend: function() {

                },
                success: function(result) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('session.clear') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(result) {
                            window.location = "/login";
                        },
                    });

                },
                error: function(xhr, status, error) {
                    var jsonResponse = JSON.parse(xhr.responseText);
                    alert(jsonResponse['message']);
                }
            });
        });
    });
</script>
