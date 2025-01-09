<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <style>
        .pnavi{
            font-size: 15px;
        }
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
                <a href="{{ url('/manipulation') }}" class="nav-link text-decoration-none {{ Request::is('manipulation') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gauge"></i>
                    <p class="pnavi">{{ __('Dashboard') }}</p>
                </a>
            </li>
            
           
        </li>

            <li class="nav-item">
                <a id="logoutsecond" class="nav-link pnavi text-decoration-none {{ Request::is('logout') ? 'active' : '' }}">
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
