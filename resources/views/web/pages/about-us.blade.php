@extends('web.layouts.master')
@section('content')
    <style>
        .board-row>.col-md-4:nth-child(n+4) {
            margin-top: 150px;
        }
    </style>

    {{-- top image section --}}
    <div class="container-fluid"
        style="background: url('{{ asset('uploads/section/' . $section->image_path) }}'); position: relative; overflow: hidden; width: auto; height: 596px; background-position: center center; background-repeat: no-repeat; background-size: cover; padding: 140px 0 60px 0; transition: 0.5s;">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                About Us
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">About</a></li>
                <li class="breadcrumb-item active text-primary">About Us</li>
            </ol>
        </div>
        <div class="bredcrumb-bottom-img-div">
            <img class="bredcrumb-bottom-img" src="{{ asset('/web/img/bredcrumb-footer-new.png') }}" alt=""
                style="width: 100%;">
        </div>
    </div>


    <!-- about our organization -->
    <div class="container-fluid organization-top-margin">
        <div class="row">
            <div class="col-md-6 wow fadeInLeft d-flex justify-content-center align-items-center">
                <img src="{{ asset('/web/img/About-1.png') }}" alt="" class="img-fluid"
                    style="width: 733px; height: 464px" />
            </div>
            <div class="col-md-6 about-org-content wow fadeInRight">
                <div>
                    <div class="d-flex about-organization-custom-gap">
                        <div>
                            <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                        </div>
                        <div>
                            <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                    <h4 class="text-success mb-3 ms-5">ABOUT OUR ORGANAIZATION</h4>
                    <h4 class="mb-4 custom-letter-spacing">
                        {{ $about->title }}
                    </h4>
                    <p class="mb-4" style="text-align: justify !important;">
                        {{ strip_tags($about->description) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- board of directory -->
    <div class="container-fluid team pb-2 boardofdirectory-margin-top">
        <div class="pb-5">

            <div class="mt-4">
                <div class="d-flex justify-content-center align-items-center about-boardofdirectory-custom-gap">
                    <div>
                        <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                    </div>
                    <div>
                        <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <h2 class="text-center text-success">BOARD OF DIRECTORY</h2>
            </div>

            <div class="total-boarddirectory-content">
                <div class="red-bg-boardofdirectory"></div>
                <div class="px-4 combined-row-boardofdirectory">
                    <div class="row g-4 mt-4 board-row">
                        @foreach ($members as $member)
                            <div class="col-md-4 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                                <div class="text-center position-relative">
                                    <div class="board-dicrescotry-sm-text rounded-3 position-relative mx-auto">
                                        <!-- Image positioned at the top -->
                                        <div class="aboutus-image-container position-absolute top-0 start-50 translate-middle">
                                            <img src="{{ asset('/uploads/member/' . $member->image_path) }}"
                                                class="img-fluid rounded-circle border-white" alt=""
                                                style="width: 323px; height: auto; border: 5px solid white; object-fit: cover;" />
                                        </div>
                    
                                        <!-- Text content centered at the bottom -->
                                        <div class="text-content-sec d-flex flex-column justify-content-center align-items-center h-100 py-4">
                                            <h6 class="text-white">{{ $member->title }}</h6>
                                            <h5 class="mb-0 text-white">{{ designationName($member->designation_id) }}</h5>
                    
                                            <!-- Short Description -->
                                            <p class="mb-0 text-white short-text">
                                                {!! \Illuminate\Support\Str::words(strip_tags($member->description, '<b><i><u><br>'), 20) !!}
                                            </p>
                    
                                            <!-- Read More Button -->
                                            <div class="py-3">
                                                <button
                                                    class="btn buynow-btn rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0 read-more-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#memberModal"
                                                    data-id="{{ $member->id }}"
                                                    data-title="{{ $member->title }}"
                                                    data-designation="{{ designationName($member->designation_id) }}"
                                                    data-image="{{ asset('/uploads/member/' . $member->image_path) }}"
                                                    data-description="{{ $member->description }}">
                                                    READ MORE
                                                </button>
                                            </div>
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="memberModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="memberImage" src="" class="img-fluid rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;" alt="Member Image">
                    </div>
                    <p id="memberDescription"></p>
                </div>
            </div>
        </div>
    </div>



    <!-- our mission and vission -->
    <div class="container-fluid">
        <div class="mission-bg-color">
            <div class="text-center">
                <div class="d-flex justify-content-center align-items-center mission-custom-gap">
                    <div>
                        <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                    </div>
                    <div>
                        <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <h2 class="text-success mb-4 ms-5">OUR MISSION & VISION</h2>
                <img src="{{ asset('/web/img/vision 1.png') }}" alt="" class="img-fluid mb-4">
                <h1 class="mb-4" style="color: #4D4C4C;">{{ $about->mission_title }}</h1>
                {{ strip_tags($about->mission_desc) }}
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="mb-4">
            <div class="our-mission-bg text-white d-flex flex-column justify-content-center align-items-center">
                <div class="py-4 text-center">
                    <div class="d-flex justify-content-center align-items-center vission-custom-gap">
                        <div>
                            <img src="{{ asset('/web/img/loader 1.png') }}" alt="" class="img-fluid">
                        </div>
                        <div>
                            <img src="{{ asset('/web/img/loader 1.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                    <h2 class="text-center text-white">OUR MISSION</h2>
                </div>

                <div class="row row-cols-1 row-cols-md-5 g-4">
                    @forelse ($missions as $mission)
                        <div class="col text-center">
                            <div>
                                <span><img src="{{ asset('/uploads/mission_content/' . $mission->image_path) }}"
                                        alt=""></span>
                                <div class="card-body">
                                    <h5 class="card-title text-white mb-2">{{ $mission->title }}</h5>
                                    <p class="card-text">{{ strip_tags($mission->description) }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>

        </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const memberModal = document.getElementById("memberModal");
        
            memberModal.addEventListener("show.bs.modal", function (event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const title = button.getAttribute("data-title");
                const designation = button.getAttribute("data-designation");
                const image = button.getAttribute("data-image");
                const description = button.getAttribute("data-description");
        
                // Update the modal content
                memberModal.querySelector(".modal-title").textContent = `${title} - ${designation}`;
                memberModal.querySelector("#memberImage").src = image;
                memberModal.querySelector("#memberDescription").innerHTML = description;
            });
        });
    </script>
@endsection
