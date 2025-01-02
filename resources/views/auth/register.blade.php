@extends('auth.master')

@section('content')

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('images/logo.png') }}" style="width:100%;height:auto">
            </div>
            <div class="col-md-6 rounded-5">
                <div class="card" style="border-radius: 20px">
                    <div class="card-body">
                        <h3 class="login-box-msg">{{ __('Register') }}</h3>

                        <div class="input-group mb-3">
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}"
                                required autocomplete="name" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('name')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}"
                                required autocomplete="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" name="phone_number" id="phone_number"
                                class="form-control @error('phone_number') is-invalid @enderror"
                                placeholder="{{ __('Phone Number') }}" required autocomplete="phone_number">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('phone_number')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}"
                                required autocomplete="new-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
                        
                            
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" id="register"
                                    class="btn btn-primary btn-block">{{ __('Register') }}</button>
                            </div>
                        </div>

                        <hr>
                        <p class="mb-0">
                            Already have an account? <a href="{{ route('login') }}">{{ __('Sign in') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('library')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#register").click(function(e) {
                e.preventDefault();

                // Ambil data input
                var name = $("#name").val();
                var email = $("#email").val();
                var password = $("#password").val();
                var password_confirmation= $("#password_confirmation").val();
                var phone_number = $("#phone_number").val();
                console.log(password_confirmation)

                // Regex untuk mengecek domain dan format email
                var validDomainRegex = /@(maranatha\.ac\.id|it\.maranatha\.edu)$/; // Valid domain check
                var studentDomainRegex = /@student\.it\.maranatha\.edu$/; // Cek untuk student.it.maranatha.edu
                var validUsernameRegex = /^[^\d].*$/;  // Username tidak boleh dimulai dengan angka

                // Cek apakah email termasuk domain student.it.maranatha.edu (blokir student email)
                if (studentDomainRegex.test(email)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Access Restricted',
                        text: 'You are a student, only lecturers can access this system.',
                    });
                    return; // Stop form submission
                }


                // Cek apakah email memiliki domain yang valid (maranatha.ac.id atau it.maranatha.edu)
                if (!validDomainRegex.test(email)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Email Domain',
                        text: 'Email must belong to maranatha.ac.id or it.maranatha.edu.',
                    });
                    return; // Stop form submission
                }

        
                // Cek apakah username email (sebelum @) dimulai dengan angka
                var username = email.split('@')[0]; // Ambil bagian username (sebelum @)
                if (/^\d/.test(username) && /@maranatha\.ac\.id$/.test(email)) {
                    // Cek jika username dimulai dengan angka dan domain adalah maranatha.ac.id
                    Swal.fire({
                        icon: 'error',
                        title: 'Access Restricted',
                        text: 'You are a student, only lecturers can access this system.',
                    });
                    return; // Stop form submission
                }

                // Jika email valid, lanjutkan ke pengiriman data
                $.ajax({
                    type: "POST",
                    url: "{{ env('URL_API') }}/api/v1/auth/register",
                    data: {
                        name: name,
                        email: email,
                        phone_number: phone_number,
                        password: password,
                        password_confirmation: password_confirmation,
                    },
                    beforeSend: function() {
                        // Anda bisa menambahkan animasi loading di sini
                        // $('#loading-sign-in').removeClass("d-none");
                        // $('#btn-sign-in').addClass("d-none");
                    },
                    success: function(resultLogin) {
                        // Jika registrasi berhasil, lakukan langkah selanjutnya
                        $.ajax({
                            type: "POST",
                            url: "{{ route('session.register') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                guid: resultLogin['data']['guid'],
                            },
                            success: function(result) {
                                // Redirect ke halaman verifikasi setelah pendaftaran sukses
                                window.location = "/choose-verify";
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        // Menampilkan error jika registrasi gagal
                        var response = JSON.parse(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                });
            });
        });


    </script>
    <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js
    "></script>
@endsection
