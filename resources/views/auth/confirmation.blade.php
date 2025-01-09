@extends('auth.master')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 text-center">
                <h1 class="display-4">{{ __('Harap Tunggu') }}</h1>
                <p class="lead">{{ __('Admin sedang memverifikasi akun Anda.') }}</p>
                <p>{{ __('Silakan cek email Anda untuk informasi lebih lanjut atau tunggu pemberitahuan lebih lanjut dari admin.') }}</p>
                <a href="{{ route('login') }}" class="btn btn-primary mt-3">{{ __('Kembali ke Halaman Login') }}</a>
            </div>
        </div>



    </div>
@endsection
