@extends('auth.master')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 text-center">
                <div class="alert alert-success" role="alert">
                   {{ __('A fresh verification link has been sent to your email address.') }}
               </div>
                <h1 class="fw-bold">{{ __('Check your email for SSTRANGE account verification') }}</h1>

            </div>
            <div class="col-md-12 mt-5 text-center">
                <h5>{{ __('If you did not receive the email') }}</h5>
                <form class="d-inline mt-5" method="POST" action="{{ route('otp-resend') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <button type="submit"
                                class="btn btn-primary btn-block">{{ __('click here to request another') }}</button>
                        </div>
                    </div>
                </form>  
            </div>
        </div>



    </div>
@endsection
