@extends('web.layouts.master')
@section('content')
    {{-- top image section --}}
    <div class="container-fluid"
        style="background: url('{{ asset('uploads/section/' . $section->image_path) }}'); position: relative; overflow: hidden; width: auto; height: 637px; background-position: center center; background-repeat: no-repeat; background-size: cover; padding: 140px 0 60px 0; transition: 0.5s;">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                Variety Details Page
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Crops</a></li>
            </ol>
        </div>
        <div class="bredcrumb-bottom-img-div">
            <img class="bredcrumb-bottom-img" src="{{ asset('/web/img/Group 49.png') }}" alt=""
                style="width: 100%;">
        </div>
    </div>

    {{-- pumpkins seed --}}
    <div class="container-fluid organization-top-margin">
        <div class="row px-4 g-4 align-items-stretch">
            <!-- Text Content Column -->
            <div class="col-md-6 d-flex flex-column wow fadeInLeft">
                <div class="pumpkins-text-section h-100 justify-content-center align-content-center px-4">
                    <div class="text-center">
                        <div class="d-flex pumpkins-seed-custom-gap justify-content-center">
                            <div>
                                <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                            </div>
                            <div>
                                <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                        <h2 class="text-success mb-4">{{ $crops->title }}</h2>
                    </div>
                    <p class="mb-4">
                        {{ strip_tags($crops->description) }}
                    </p>
                </div>
            </div>

            <!-- Image Column -->
            <div class="col-md-6 d-flex justify-content-center align-items-center wow fadeInRight">
                <img src="{{ asset('/uploads/service/' . $crops->image_path) }}" alt="" class="img-fluid"
                    style="width: 805px; height: 521px">
            </div>
        </div>
    </div>

    {{-- benefits of pumpkins seed --}}
    <div class="container-fluid organization-top-margin">
        <div class="row px-4 g-4 align-items-stretch">
            <!-- Image Column -->
            <div class="col-md-6 d-flex justify-content-center align-items-center wow fadeInLeft">
                <img src="{{ asset('/uploads/service/' . $crops->image_path2) }}" alt="" class="img-fluid"
                    style="width: 798px; height: 561px">
            </div>

            <!-- Text Content Column -->
            <div class="col-md-6 d-flex flex-column wow fadeInRight">
                <div class="pumpkins-text-section h-100 justify-content-center align-content-center px-4">
                    <div class="text-center">
                        <div class="d-flex benefits-pumpkins-seed-custom-gap justify-content-center">
                            <div>
                                <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                            </div>
                            <div>
                                <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                        <h2 class="text-success mb-4">{{ $crops->title2 }}</h2>
                    </div>
                    <p class="mb-4">
                        {{ strip_tags($crops->description2) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Varieties Of pumpkins seed --}}
    {{-- <div class="container-fluid">
        <div class="text-center wow fadeInUp" style="margin-top: 60px">
            <div class="d-flex varities-pumpkins-custom-gap justify-content-center">
                <div>
                    <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                </div>
                <div>
                    <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                </div>
            </div>
            <h2 class="text-success" style="margin-bottom: 30px">VARIETIES OF
                {{ strtoupper(getCategoryName($crops->category_id)) }}
                SEED</h2>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            @if (count($varieties) > 0)
                @forelse ($varieties as $varity)
                    <div class="col wow fadeInLeft">
                        <div class="card p-3">
                            <div class="row g-0">
                                <div class="col-md-6 bg-light pumpkins-sm-row-content text-center">
                                    <img src="{{ asset('/uploads/varieties/' . $varity->image) }}"
                                        class="img-fluid rounded-start" alt="..." style="width: 400px; height: 305px">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $varity->title }}</h5>
                                        <span style="color: #333">{{ getCropName($varity->crop_id) }}</span>
                                        <p class="card-text">Breeder: {{ $varity->breeder_name }}</p>

                                        <table class="pumpkins-table">
                                            <tr>
                                                <td>Color :</td>
                                                <td>{{ $varity->color }}</td>
                                            </tr>
                                            <tr>
                                                <td>Weight (kg) :</td>
                                                <td>{{ $varity->weight }}</td>
                                            </tr>
                                            <tr>
                                                <td>Rate/Dec. (g) : </td>
                                                <td>{{ $varity->rate }}</td>
                                            </tr>
                                            <tr>
                                                <td>Sowing time : </td>
                                                <td>{{ $varity->showing_time }}</td>
                                            </tr>
                                            <tr>
                                                <td>Yield/Acre (MT) :</td>
                                                <td>{{ $varity->yield }}</td>
                                            </tr>
                                            <tr>
                                                <td>Maturity (Days) :</td>
                                                <td> {{ $varity->maturity }}</td>
                                            </tr>
                                        </table>
                                        <hr>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            @endif

        </div>
    </div> --}}

    {{-- Frequently Asked Questions --}}
    <div>
        <div class="container-fluid">
            <div class="text-center" style="margin-top: 60px">
                <div class="d-flex faq-custom-gap justify-content-center">
                    <div>
                        <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                    </div>
                    <div>
                        <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <h2 class="text-success" style="margin-bottom: 30px">Frequently Asked Questions</h2>
            </div>
        </div>
        <div class="container-fluid faq-bg px-4">
            <div>
                <div class="row">
                    <div class="col-md-8 py-4">
                        <div class="accordion" id="accordionExample">
                            @foreach ($faqs as $index => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $index }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $index }}">
                                            {{ $index + 1 }} - {{ $faq->title }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}"
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            {!! $faq->description !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-4 p-3 d-flex justify-content-end position-relative full-faq-img">
                        <!-- First Image -->
                        <img src="{{ asset('/web/img/faq11.png') }}" alt="" class="img-fluid"
                            style="width: 508px; height: 498px;">

                        <!-- Second Image -->
                        <div class="second-faq-qs-img position-absolute" style="top: 50px; right: 0;">
                            <img src="{{ asset('/web/img/faq-shape-2 1.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- other crops --}}
    <div class="container-fluid ">
        <div class="text-center crops-margin mb-3">
            <div>
                <div class="d-flex justify-content-center align-items-center other-crops-cropsdetails-custom-gap">
                    <div>
                        <img src="web/img/loader 2.png" alt="" class="img-fluid">
                    </div>
                    <div>
                        <img src="web/img/loader 2.png" alt="" class="img-fluid">
                    </div>
                </div>
                <h3 class="text-success fw-bold" style="margin-bottom: 45px">OTHER CROPS</h3>
            </div>
        </div>

        <div>
            <img src="img/service-2-shape-2 1.png" alt="" class="img-fluid img-right-small">
        </div>

        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- First Slide -->
                <div class="carousel-item active">
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        <!-- Card 1 -->
                        @foreach ($services as $index => $service)
                            @if ($index < 8)
                                <div class="col">
                                    <a href="{{ route('cropsdetailspage', $service->slug) }}">
                                        <div class="card crops-card-bg border-0 position-relative card-hover">
                                            <img src="{{ asset('/uploads/service/' . $service->image_path) }}"
                                                class="card-img-top p-2" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title text-center text-danger">{{ $service->title }}</h5>
                                                <p class="card-text mb-4">
                                                <p class="card-text mb-4">{{ strip_tags($service->short_desc) }}</p>
                                                </p>
                                            </div>
                                            <!-- Circle positioned at the bottom and centered -->
                                            <div
                                                class="circle-bg position-absolute bottom-0 start-50 translate-middle-x d-flex justify-content-center align-items-center">
                                                <i class="bi bi-arrow-up-left"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>


                <!-- Second Slide -->
                <div class="carousel-item">
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        <!-- Card 1 (same structure as first slide) -->
                        @foreach ($services as $index => $service)
                            @if ($index > 8)
                                <div class="col">
                                    <a href="{{ route('cropsdetailspage', $service->slug) }}">
                                        <div class="card crops-card-bg border-0 position-relative card-hover">
                                            <img src="{{ asset('/uploads/service/' . $service->image_path) }}"
                                                class="card-img-top p-2" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title text-center text-danger">{{ $service->title }}</h5>
                                                <p class="card-text mb-4">{{ strip_tags($service->short_desc) }}</p>
                                            </div>
                                            <!-- Circle positioned at the bottom and centered -->
                                            <div
                                                class="circle-bg position-absolute bottom-0 start-50 translate-middle-x d-flex justify-content-center align-items-center">
                                                <i class="bi bi-arrow-up-left"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach


                    </div>
                </div>

            </div>

            <!-- Carousel Controls -->
            <div class="carousel-controls">
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>

        <div class="see-all-btn">
            <a href="" class="btn buynow-btn rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">SEE ALL</a>
        </div>

    </div>
@endsection
