@extends('web.layouts.master')
@section('content')
    {{-- Top Image Section --}}
    <div class="container-fluid"
        style="background: url('{{ asset('uploads/section/' . $section->image_path) }}'); position: relative; overflow: hidden; width: auto; height: 637px; background-position: center center; background-repeat: no-repeat; background-size: cover; padding: 140px 0 60px 0; transition: 0.5s;">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                Gallery
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Gallery</a></li>
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
            <p class="container d-inline-flex gap-5 d-flex justify-content-center newsletter-responsive-links-flex">
                <a class="bg-danger text-white py-2 rounded-2" style="padding-left: 120px; padding-right: 120px;"
                    href="#" id="showPhotos">Photos</a>
                <a class="btn btn-danger py-2" style="padding-left: 120px; padding-right: 120px;" href="#"
                    id="showVideos">Videos</a>
            </p>

            <!-- Photos Section -->
            <div class="collapse show" id="photos">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($photos as $photo)
                            <div class="col-md-3">
                                <img src="{{ asset($photo) }}" alt="Image" class="img-thumbnail" data-bs-toggle="modal"
                                    data-bs-target="#imageModal" data-bs-img="{{ asset($photo) }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Videos Section -->
            <div class="collapse" id="videos">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($directvideos as $video)
                            <div class="col-md-3 mb-3">
                                <video width="392" height="294" controls>
                                    <source src="{{ asset($video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
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
