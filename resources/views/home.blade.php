@extends('layouts.template')

@section('content')
    <style>
        *{
            overflow: hidden;
        }
        .animated-text {
            display: none; /* Mulai dengan teks disembunyikan */
            font-weight: bold;
            transition: opacity 1s ease-in-out; /* Animasi pergantian */
            font-size: 2.5em; /* Ukuran font */
        }

        .animated-text.active {
            display: block; /* Tampilkan teks aktif */
            opacity: 1;
        }

        .additional-text {
            font-size: 1.25em; /* Ukuran font untuk teks tambahan */
            font-weight: normal; /* Tidak perlu tebal */
            margin-top: 10px; /* Jarak atas */
            position: relative; /* Diperlukan untuk animasi */
            overflow: hidden; /* Sembunyikan bagian yang keluar */
            height: 1.25em; /* Sesuaikan dengan tinggi teks */
        }

        .text-item {
            position: absolute; /* Supaya bisa bergerak di atas */
            width: 100%; /* Agar teks mengisi lebar div */
            transition: transform 0.5s ease; /* Animasi untuk naik */
            opacity: 0; /* Mulai dengan transparan */
            font-size:1.25em
        }

        .text-item.active {
            opacity: 1; /* Teks yang aktif terlihat */
            transform: translateY(0); /* Teks aktif di tempatnya */
        }

        .text-item.out {
            opacity: 0; /* Teks keluar menjadi transparan */
            transform: translateY(-100%); /* Teks bergerak ke atas */
        }
    </style>
    <!-- Main content -->
    <div class="content" id="contenta">
        <div class="container-fluid w-100">
            <div class="row d-flex justify-content-center align-items-center" style="min-height: 95vh">
                <div class="col-md-6">

                    <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="{{ asset('images/carousel1.jpeg') }}" alt="Logo" class=" d-block w-100 rounded-3">
                          </div>
                          <div class="carousel-item">
                                <img src="{{ asset('images/carousel2.jpeg') }}" alt="Logo" class=" d-block w-100 rounded-3">
                          </div>
                          <div class="carousel-item">
                                <img src="{{ asset('images/carousel3.jpeg') }}" alt="Logo" class=" d-block w-100 rounded-3">
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <h1 class="animated-text">Boost Creativity, Eliminate Copying</h1>
                        <h1 class="animated-text">Redefining Code Integrity</h1>
                        <h1 class="animated-text">Innovate, Don't Imitate</h1>
                        <h1 class="animated-text">Say Goodbye to Code Copying Forever</h1>
                    </div>
                    <div class="d-flex w-100">
                        <p style="font-size:1.25em" class="me-2">A Smarter Way to</p>
                        <div>
                            <div class="text-item active">Empowering Future Coders</div>
                            <div class="text-item">Integrity in Every Line</div>
                            <div class="text-item">Transforming Ideas into Reality</div>
                            <div class="text-item">Code Smart, Code Fair</div>
                            <div class="text-item">Enhancing the Coding Ecosystem</div>
                        </div>
                    </div>
                    <p>Ready to analyze submissions for similarity? Click the button below to start.</p>
                    <a href="{{ route('form') }}" class="btn btn-primary w-50 mb-3">Start SSTRANGE</a>
                    <p>Curious for more details? <a href="{{ route('about') }}">Click Here!</a></p>
                </div>      
            </div>
        </div>
    </div>
    <!-- /.content -->

@endsection

@section('vendor-javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>
@endsection

@section('custom-javascript')
<script>
    VANTA.NET({
        el: "#contenta",
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 200.00,
        minWidth: 200.00,
        scale: 1.00,
        scaleMobile: 1.00,
        color: 0xb36e6e,
        backgroundColor: 0xf4f6f9,
        points: 15.00,
        maxDistance: 20.00,
        spacing:25.00
    })
    $(document).ready(function() {
        let index = 0;
        const texts = $('.animated-text');
        const totalTexts = texts.length;
        let textIndex = 0;
        const additionalTexts = $('.text-item');
        const totalAdditionalTexts = additionalTexts.length;

        texts.eq(index).addClass('active');
        additionalTexts.eq(textIndex).addClass('active');
        setInterval(function() {
            texts.eq(index).removeClass('active'); 
            additionalTexts.eq(textIndex).addClass('out');
            index = (index + 1) % totalTexts;
            textIndex = (textIndex + 1) % totalAdditionalTexts; 
            texts.eq(index).addClass('active');
            additionalTexts.eq(textIndex).removeClass('out').addClass('active');
        }, 3000); 

    });
</script>
@endsection
