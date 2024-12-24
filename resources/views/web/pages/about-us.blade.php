@extends('web.layouts.master')
@section('content')
    {{-- top image section --}}
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                About Us
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">About</a></li>
                <li class="breadcrumb-item active text-primary">About Us</li>
            </ol>
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
                    <p class="mb-4">
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
                <div class="red-bg-boardofdirectory">
                </div>
                <div class="px-4 combined-row-boardofdirectory">
                    <div class="row g-4 mt-4">
                        @foreach ($members as $index => $member)
                            @if ($index <= 2)
                                <div class="col-md-4 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="text-center position-relative">
                                        <div class="board-dicrescotry-sm-text rounded-3 position-relative mx-auto">
                                            <!-- Image positioned at the top -->
                                            <div
                                                class="aboutus-image-container position-absolute top-0 start-50 translate-middle">
                                                <img src="{{ asset('/uploads/member/' . $member->image_path) }}"
                                                    class="img-fluid rounded-circle border-white" alt=""
                                                    style="width: 323px; height: auto; border: 5px solid white; object-fit: cover;" />
                                            </div>

                                            <!-- Text content centered at the bottom -->
                                            <div
                                                class="text-content d-flex flex-column justify-content-center align-items-center h-100 py-4">
                                                <h6 class="text-white">{{ $member->title }}</h6>
                                                <h5 class="mb-0 text-white">{{ designationName($member->designation_id) }}
                                                </h5>
                                                <p class="mb-0 text-white">
                                                    {{ \Illuminate\Support\Str::words(strip_tags($member->description), 20) }}

                                                </p>
                                                <div class="py-3">
                                                    <a href=""
                                                        class="btn buynow-btn rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">READ
                                                        MORE</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    

                    <div class="row g-4 second-row-boardofdirectory">
                        @foreach ($members as $index => $member)
                            @if ($index > 2)
                                <div class="col-md-4 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="text-center position-relative">
                                        <div class="board-dicrescotry-sm-text rounded-3 position-relative mx-auto">
                                            <!-- Image positioned at the top -->
                                            <div
                                                class="aboutus-image-container position-absolute top-0 start-50 translate-middle">
                                                <img src="{{ asset('/uploads/member/' . $member->image_path) }}"
                                                    class="img-fluid rounded-circle border-white" alt=""
                                                    style="width: 323px; height: auto; border: 5px solid white; object-fit: cover;" />
                                            </div>

                                            <!-- Text content centered at the bottom -->
                                            <div
                                                class="text-content d-flex flex-column justify-content-center align-items-center h-100 py-4">
                                                <h6 class="text-white">{{ $member->title }}</h6>
                                                <h5 class="mb-0 text-white">{{ designationName($member->designation_id) }}
                                                </h5>
                                                <p class="mb-0 text-white">
                                                    {{ \Illuminate\Support\Str::words(strip_tags($member->description), 20) }}
                                                </p>
                                                <div class="py-3">
                                                    <a href=""
                                                        class="btn buynow-btn rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">READ
                                                        MORE</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

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
                <h2 class="text-success mb-4">OUR MISSION & VISION</h2>
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
@endsection
