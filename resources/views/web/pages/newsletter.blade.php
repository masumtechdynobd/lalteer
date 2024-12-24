@extends('web.layouts.master')
@section('content')
    {{-- Top Image Section --}}
    <div class="container-fluid bg-breadcrumb-newsletter">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                Newsletter
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Newsletter</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid d-flex justify-content-center align-items-center" style="margin-top: 80px">
        <div class="text-center">
            <!-- Buttons to Toggle Content -->
            <p class="container d-inline-flex gap-4 justify-content-between">
                <a class="bg-danger text-white py-2 rounded-2" style="padding-left: 120px; padding-right: 120px;"
                    href="#" id="showPhotos">Photos</a>
                <a class="btn btn-danger py-2" style="padding-left: 120px; padding-right: 120px;" href="#"
                    id="showVideos">Videos</a>
                <a class="btn btn-danger py-2" style="padding-left: 120px; padding-right: 120px;" href="#"
                    id="showNews">News & Blogs</a>
            </p>

            <!-- Photos Section -->
            <div class="collapse show" id="photos">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($photos as $photo)
                            <div class="col-md-3">
                                <img src="{{ asset($photo->photos_path) }}" alt="Image" class="img-thumbnail"
                                    data-bs-toggle="modal" data-bs-target="#imageModal"
                                    data-bs-img="{{ asset($photo->photos_path) }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Videos Section -->
            <div class="collapse" id="videos">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($videos as $video)
                            <div class="col-md-3 mb-3">
                                <iframe width="392" height="294"
                                    src="https://www.youtube.com/embed/{{ $video->youtube_video_id }}" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <!-- News & Blogs Section -->
            <div class="collapse" id="news">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery script to handle the content toggling -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initially, show photos and hide others
            $("#showPhotos").click(function() {
                $('#photos').collapse('show');
                $('#videos').collapse('hide');
                $('#news').collapse('hide');
            });

            $("#showVideos").click(function() {
                $('#videos').collapse('show');
                $('#photos').collapse('hide');
                $('#news').collapse('hide');
            });

            $("#showNews").click(function() {
                $('#news').collapse('show');
                $('#photos').collapse('hide');
                $('#videos').collapse('hide');
            });
        });
    </script>
@endsection
