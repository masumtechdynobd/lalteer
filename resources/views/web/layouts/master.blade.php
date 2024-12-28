<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>lalteer</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{ asset('/web/lib/animate/animate.min.css') }}" />
    <link href="{{ asset('/web/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/web/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('/web/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('/web/css/style.css?v2') }}" rel="stylesheet">
    <link href="{{ asset('/web/css/masum.css') }}" rel="stylesheet">
    <link href="{{ asset('/web/css/masumnew.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('/web/css/slick.css') }}">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" />

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('/web/js/turn.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/web/js/turn.js') }}"></script>

    <style>
        .mt-5 {
            margin-top: -8rem !important;
        }

        .carousel-control-prev,
        .carousel-control-next {
            position: relative !important;
            display: inline-block;
            top: -30px;
            color: #fff;
            background-color: var(--bs-primary);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            transition: 0.3s ease;
            width: 35px;
            height: 35px;
            line-height: 35px;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background-color: var(--bs-dark);
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            font-size: 14px;
            width: 10px;
            height: 10px;
        }

        .vertical-line {
            position: absolute;
            top: 5%;
            right: 0;
            height: 90%;
            width: 2px;
            background-color: #1a1919;
        }


        .carousel-container {
            position: relative;
            z-index: 10;
        }

        .my-5 {
            margin-top: -6rem !important;
        }


        /* about */
        .about-color {
            background-color: #F3F7FF;
        }
    </style>
</head>

@include('web.layouts.header')
<!-- Content Start -->
@yield('content')
<!-- Content End -->


<!-- Footer Start -->
<div class="container-fluid footer wow fadeIn mt-4" data-wow-delay="0.2s">
    <div class="image-container footer-logo">
        <img src="{{ asset('/uploads/setting/' . $setting->logo_path) }}" alt="Logo" class="img-fluid"
            style="width: 244px; height: 192px; filter: brightness(1.2) contrast(1.1);">
    </div>

    <div class="py-2 px-4 border-start-0 border-end-0">
        <div class="row g-5 py-5">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 class="text-white mb-4">COMPANY</h4>
                    <a href="{{ route('aboutus') }}">ABOUT US</a>
                    <a href="{{ route('projects') }}">PROJECTS</a>
                    <a href="{{ route('researchanddevelopment') }}">RESERACH CENTER</a>
                    <a href="{{ route('gallery') }}">GALLRY</a>
                    <a href="#">OUR CROPS</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 class="text-white mb-4">LINKS</h4>
                    <a href="#">CAREER</a>
                    <a href="#">BUY NOW</a>
                    <a href="{{ route('contactus') }}">CONTACT US</a>
                    <a href="#">Certificate </a>
                    <div>
                        @php
                            $images = json_decode($setting->certification_multiple_images, true); // Decode the JSON string to an array
                        @endphp
                        @if (!empty($images) && is_array($images))
                            @forelse ($images as $index=>$image)
                                <img src="{{ asset('/uploads/certifications/' . $image) }}" alt=""
                                    class="img-fluid">
                            @empty
                            @endforelse
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 class="text-white mb-4">Contact US</h4>
                    <div class="d-flex align-items-center">
                        <i class="fa fa-phone-alt text-white me-3"></i>
                        <p class="text-white mb-0">{{ $setting->phone_one }}</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-envelope text-white me-3"></i>
                        <p class="text-white mb-0">{{ $setting->email_one }}</p>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-map-marker-alt text-white me-3"></i>
                        <p class="text-white mb-0">{{ $setting->contact_address }}</p>
                    </div>
                    <h5 class="text-white mb-2">FOLLOW US</h5>
                    <div class="d-flex">
                        <a class="btn btn-light btn-sm-square rounded-circle me-3" href="{{ $social->facebook }}"><i
                                class="fab fa-facebook-f text-dark"></i></a>
                        <a class="btn btn-light btn-sm-square rounded-circle me-3" href="{{ $social->twitter }}"><i
                                class="fab fa-twitter text-dark"></i></a>
                        <a class="btn btn-light btn-sm-square rounded-circle me-3" href="{{ $social->instagram }}"><i
                                class="fab fa-instagram text-dark"></i></a>
                        <a class="btn btn-light btn-sm-square rounded-circle me-0" href="{{ $social->linkedin }}"><i
                                class="fab fa-linkedin-in text-dark"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 class="text-white mb-4">Newsletter</h4>
                    <span class="mb-3">Subscribe to our email newsletter to receive useful articles and special
                        offers.</span>


                    <form action="{{ route('subscribe.store') }}" method="POST"
                        class="subscribe-container position-relative">
                        @csrf
                        <input type="email" name="email"
                            class="rounded-pill border-0 px-2 subscribe-input text-white"
                            placeholder="Ex. mah@gamil.com" required>
                        <button type="submit" class="btn btn-danger subscribe-btn position-absolute">
                            Subscribe Now <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </form>



                </div>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <span class="">Copyright©2024 LAL TEER SEEDS LTD. All rights reserved. Design and Developed by
                Techdyno BD Ltd.</span>
        </div>
    </div>
</div>
<!-- Footer End -->




<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/web/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('/web/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('/web/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('/web/lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('/web/lib/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('/web/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/web/js/main_new.js') }}"></script>

<script src="{{ asset('/web/js/slick.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#slick1').slick({
            rows: 2, // Number of rows in the slider
            dots: false, // Disable dots
            arrows: true, // Enable arrows
            infinite: true, // Infinite loop
            speed: 300, // Slide transition speed
            slidesToShow: 4, // Number of slides visible
            slidesToScroll: 4, // Number of slides to scroll at once
            prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>'
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const videos = document.querySelectorAll('video[data-lazy="true"]');

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const video = entry.target;
                    const src = video.getAttribute('data-src');
                    if (src) {
                        video.setAttribute('src', src); // Set the video source
                        video.removeAttribute('data-src'); // Remove data-src
                    }
                    observer.unobserve(video); // Stop observing the video
                }
            });
        }, {
            rootMargin: '0px',
            threshold: 0.5 // Video should be 50% in view before loading
        });

        videos.forEach(video => {
            observer.observe(video);
        });
    });
</script>

<!-- Template Javascript -->
<script src="{{ asset('/web/js/main_new.js') }}"></script>
</body>

</html>
