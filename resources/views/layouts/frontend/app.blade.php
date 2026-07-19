<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} | @yield('page_title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="@yield('keywords')" name="keywords">
    <meta content="@yield('description')" name="description">
    <meta content="@yield('title')" property="og:title">
    <meta content="@yield('image')" property="og:image">
    <meta content="@yield('description')" property="og:description">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flux/4.0.4/Flux.js"
        integrity="sha512-9VaVYvlIqSu0zj8t8gvDynheLemPfmMjkqiCBKpRG/ik54/Mstp4PJ6G1r1IzJdNvUfrp/YCxSAK56UiXtv/yQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .text-primary {
            color: #123456 !important;
        }

        .text-secondary {
            color: #654321 !important;
        }
    </style>
    @livewireStyles
    @fluxAppearance
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <livewire:top-bar />
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <livewire:nav-bar />
    <!-- Navbar & Hero End -->

    {{-- slot for main content --}}
    <main>
        @yield('content')
    </main>

    <!-- Copyright Start -->
    <livewire:copyright />
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>
    @livewireScripts
    @fluxScripts
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.on('cartUpdated', function(data) {
                Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                }).fire({
                    icon: "success",
                    title: data.message
                });
            });
        });
    </script>
</body>

</html>
