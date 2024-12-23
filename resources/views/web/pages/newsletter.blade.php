@extends('web.layouts.master')
@section('content')
    {{-- top image section --}}
    <div class="container-fluid bg-breadcrumb-newsletter">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                Newsletter
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Newsletter</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid d-flex justify-content-center align-items-center" style="margin-top: 80px">
        <div class="text-center">
            <!-- Buttons to toggle content -->
            <p class="container d-inline-flex gap-4 justify-content-between">
                <a class="bg-danger text-white py-2 rounded-2" style="padding-left: 120px; padding-right: 120px;" href="#" id="showPhotos">Photos</a>
                <a class="btn btn-danger py-2" style="padding-left: 120px; padding-right: 120px; href="#" id="showVideos">Videos</a>
                <a class="btn btn-danger py-2" style="padding-left: 120px; padding-right: 120px; href="#" id="showNews">News & Blogs</a>
            </p>

            <!-- image -->
            <div class="collapse show" id="photos">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Image 1 -->
                        
                        <div class="col-md-3">
                            <img src="{{ asset('/web/img/newsletter-photo1.png') }}" alt="Image 1" class="img-thumbnail"
                                data-bs-toggle="modal" data-bs-target="#imageModal"
                                data-bs-img="{{ asset('/web/img/newsletter-photo1.png') }}">
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- The image will be displayed here -->
                                    <img src="" id="modalImage" class="img-fluid" alt="Modal Image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bootstrap 5 Scripts -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

                <script>
                    // Set the image in the modal when an image is clicked
                    const modalImage = document.getElementById('modalImage');

                    const images = document.querySelectorAll('.img-thumbnail');
                    images.forEach(image => {
                        image.addEventListener('click', function() {
                            const imgSrc = this.getAttribute('data-bs-img');
                            modalImage.src = imgSrc; // Set the src of the modal image to the clicked image's src
                        });
                    });
                </script>

            </div>

            {{-- videos --}}
            <div class="collapse" id="videos">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Image 1 -->
                        <div class="col-md-3">
                            <img src="{{ asset('/web/img/newsletter-photo1.png') }}" alt="videos 1" class="videos-thumbnail"
                                data-bs-toggle="modal" data-bs-target="#videosModal"
                                data-bs-img="{{ asset('/web/img/newsletter-photo1.png') }}">
                        </div>
                        <!-- Image 2 -->
                        <div class="col-md-3">
                            <img src="{{ asset('/web/img/newsletter-photo1.png') }}" alt="videos 2"
                                class="videos-thumbnail" data-bs-toggle="modal" data-bs-target="#videosModal"
                                data-bs-img="{{ asset('/web/img/newsletter-photo1.png') }}">
                        </div>
                        <!-- Image 3 -->
                        <div class="col-md-3">
                            <img src="{{ asset('/web/img/newsletter-photo1.png') }}" alt="videos 3"
                                class="videos-thumbnail" data-bs-toggle="modal" data-bs-target="#videosModal"
                                data-bs-img="{{ asset('/web/img/newsletter-photo1.png') }}">
                        </div>
                        <!-- Image 4 -->
                        <div class="col-md-3">
                            <img src="{{ asset('/web/img/newsletter-photo1.png') }}" alt="videos 4"
                                class="videos-thumbnail" data-bs-toggle="modal" data-bs-target="#videosModal"
                                data-bs-img="{{ asset('/web/img/newsletter-photo1.png') }}">
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="videosModal" tabindex="-1" aria-labelledby="videosModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- The image will be displayed here -->
                                    <img src="" id="videosImage" class="img-fluid" alt="videos Image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    // Set the image in the modal when an image is clicked
                    const modalVideos = document.getElementById('modalVideos');

                    const images = document.querySelectorAll('.videos-thumbnail');
                    images.forEach(image => {
                        image.addEventListener('click', function() {
                            const videoSrc = this.getAttribute('data-bs-img');
                            modalVideos.src = videoSrc; // Set the src of the modal image to the clicked image's src
                        });
                    });
                </script>
            </div>

            <div class="collapse" id="news">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-md-4 g-4 wow fadeInUp">
                        @foreach ($articles as $blog)
                            <!-- Card 1 -->
                            <div class="col">
                                <div class="card position-relative">
                                    <!-- Card Image -->
                                    <img src="{{ asset('/uploads/article/' . $blog->image_path) }}" class="img-fluid"
                                        alt="...">

                                    <!-- Hidden Content (will show on hover) -->
                                    <div class="px-3">
                                        <div
                                            class="news-hover-content position-absolute  d-flex flex-column justify-content-center align-items-center text-white">
                                            <p class="news-hover-date-bg px-3">
                                                {{ \Carbon\Carbon::parse($blog->date)->format('d') }} <br>
                                                {{ \Carbon\Carbon::parse($blog->date)->format('M') }}</p>
                                            <p class="text-center"><i class="bi bi-camera me-2"></i>News</p>
                                            <h6 class="text-center text-white">{{ $blog->title }}
                                            </h6>
                                            <p class="text-center">
                                                {{ implode(' ', array_slice(explode(' ', strip_tags($blog->description)), 0, 10)) }}{{ strlen($blog->description) > 10 ? '...' : '' }}
                                            </p>

                                            {{-- <div class="text-center py-4">
                                                <a href="#" class="text-white text-center custom-hover-button">
                                                    <i
                                                        class="bi bi-arrow-right news-read-bg-success rounded-pill p-1 me-2"></i>
                                                    Read More
                                                </a>
                                            </div> --}}
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
