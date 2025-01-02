<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/icon.png') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css
" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  

    @yield('addCss')
</head>

<body class="hold-transition login-page" >
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Memastikan konten berada di tengah vertikal */
            z-index: 1; /* Pastikan konten tetap di bawah modal */
        }

        /* Pastikan Swal tetap di atas konten */
        .swal2-container {
            z-index: 1050 !important; /* Memastikan Swal di atas konten */
        }

        .swal2-popup {
            z-index: 1060 !important; /* Memastikan popup Swal di atas modal */
        }
    </style>
    <div class="container">


        @yield('content')
    </div>
    <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js
    "></script>
    <!-- /.login-box -->
    @stack('scripts')
    @yield('library')
   
</body>

</html>
