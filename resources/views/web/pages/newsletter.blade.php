@extends('web.layouts.master')
@section('content')
    {{-- Top Image Section --}}
    <div class="container-fluid"
        style="background: url('{{ asset('uploads/section/' . $section->image_path) }}'); position: relative; overflow: hidden; width: auto; height: 637px; background-position: center center; background-repeat: no-repeat; background-size: cover; padding: 140px 0 60px 0; transition: 0.5s;">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                Newsletter
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Newsletter</a></li>
            </ol>
        </div>
        <div class="bredcrumb-bottom-img-div">
            <img class="bredcrumb-bottom-img" src="{{ asset('/web/img/Group 49.png') }}" alt=""
                style="width: 100%;">
        </div>
    </div>

    <div class="container-fluid d-flex justify-content-center align-items-center" style="margin-top: 80px">
        <div class="text-center">
            <!-- Buttons to Toggle Content -->
            <p class="container d-inline-flex gap-4 justify-content-between newsletter-responsive-links-flex">
                <a class="bg-danger text-white py-2 rounded-2" style="padding-left: 120px; padding-right: 120px;"
                    href="?section=photos" id="showPhotos">Photos</a>
                <a class="btn btn-danger py-2" style="padding-left: 120px; padding-right: 120px;" href="?section=videos"
                    id="showVideos">Videos</a>
                <a class="btn btn-danger py-2" style="padding-left: 120px; padding-right: 120px;" href="?section=news"
                    id="showNews">News & Blogs</a>
            </p>

            <!-- Photos Section -->
            <div class="collapse {{ $section == 'photos' ? 'show' : '' }}" id="photos">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($photos as $photo)
                            <div class="col-md-3">
                                <img src="{{ asset($photo->photos_path) }}" alt="Image" class="img-thumbnail" style="width: 392px; height: 294px;"
                                    data-bs-toggle="modal" data-bs-target="#imageModal"
                                    data-bs-img="{{ asset($photo->photos_path) }}">
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination Links for Photos -->
                    <div class="d-flex justify-content-center">
                        {{ $photos->withQueryString()->links() }}
                    </div>
                </div>
            </div>

            <!-- Videos Section -->
            <div class="collapse {{ $section == 'videos' ? 'show' : '' }}" id="videos">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($directvideos as $video)
                            <div class="col-md-3 mb-3">
                                <video width="392" height="294" controls>
                                    <source src="{{ asset($video->video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination Links for Videos -->
                    <div class="d-flex justify-content-center">
                        {{ $directvideos->withQueryString()->links() }}
                    </div>
                </div>
            </div>

            <!-- News & Blogs Section -->
            <div class="collapse {{ $section == 'news' ? 'show' : '' }}" id="news">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-md-4 g-4 wow fadeInUp">
                        @foreach ($articles as $blog)
                            <div class="col">
                                <div class="card position-relative">
                                    <img src="{{ asset('/uploads/article/' . $blog->image_path) }}" class="img-fluid"
                                        alt="{{ $blog->title }}">
                                    <div class="px-3">
                                        <div
                                            class="news-hover-content position-absolute d-flex flex-column justify-content-center align-items-center text-white">
                                            <p class="news-hover-date-bg px-3">
                                                {{ \Carbon\Carbon::parse($blog->date)->format('d') }} <br>
                                                {{ \Carbon\Carbon::parse($blog->date)->format('M') }}
                                            </p>
                                            <p class="text-center"><i class="bi bi-camera me-2"></i>News</p>
                                            <h6 class="text-center text-white">{{ $blog->title }}</h6>
                                            <p class="text-center">
                                                {{ implode(' ', array_slice(explode(' ', strip_tags($blog->description)), 0, 10)) }}{{ strlen($blog->description) > 10 ? '...' : '' }}
                                            </p>
                                            <div class="py-3">
                                                <a href="{{ route('newsletterdetails', $blog->id) }}"
                                                    class="newsletter-bg-success-hover"><i
                                                        class="bi bi-arrow-right me-2 text-white p-2 rounded-pill"
                                                        style="background-color: #28a745;"></i>Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination Links for News & Blogs -->
                    <div class="d-flex justify-content-center">
                        {{ $articles->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- jQuery script to handle the content toggling -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add active class to the current section link based on URL
            const section = new URLSearchParams(window.location.search).get('section') || 'photos';
            $('#showPhotos, #showVideos, #showNews').removeClass('active');
            if (section === 'photos') {
                $('#showPhotos').addClass('active');
                $('#photos').collapse('show');
            } else if (section === 'videos') {
                $('#showVideos').addClass('active');
                $('#videos').collapse('show');
            } else if (section === 'news') {
                $('#showNews').addClass('active');
                $('#news').collapse('show');
            }

            // Toggle content sections based on button click
            $("#showPhotos").click(function() {
                window.location.search = '?section=photos'; // Change URL
            });

            $("#showVideos").click(function() {
                window.location.search = '?section=videos'; // Change URL
            });

            $("#showNews").click(function() {
                window.location.search = '?section=news'; // Change URL
            });
        });
    </script>
@endsection
