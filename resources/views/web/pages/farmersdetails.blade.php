@extends('web.layouts.master')
@section('content')
    {{-- top image section --}}
    <div class="container-fluid bg-breadcrumb-rd">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                Farmer`s Success Story
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Farmer</a></li>
                <li class="breadcrumb-item"><a href="#">Success Stories</a></li>
            </ol>
        </div>
    </div>

    {{-- research and development area --}}
    <div class="container-fluid" style="margin-top: 70px">
        <div class="row">
            <div class="col-md-6">
                <div class="rd-details-research-fourimg">
                    <div class="row d-flex flex-column">
                        @php
                            $images = json_decode(@$data->multiple_images, true); // Decode the JSON string to an array
                        @endphp
                        @if (!empty($images) && is_array($images))
                            @forelse ($images as $index=>$image)
                                @if ($index == 0 || $index == 1)
                                    <div class="col-md-6 d-flex flex-row">
                                        @if ($index == 0)
                                            <img src="{{ asset('/uploads/farmer/' . $image) }}" alt=""
                                                class="img-fluid rd-details-research-img1"
                                                style="width: 294px; height: 357px">
                                        @elseif ($index == 1)
                                            <img src="{{ asset('/uploads/farmer/' . $image) }}" alt=""
                                                class="img-fluid rd-details-research-img2"
                                                style="width: 361px; height: 241px">
                                        @endif
                                    </div>
                                @endif
                                @if ($index == 2 || $index == 3)
                                    <div class="col-md-6 d-flex flex-row">
                                        @if ($index == 2)
                                            <img src="{{ asset('/uploads/farmer/' . $image) }}" alt=""
                                                class="img-fluid rd-details-research-img3"
                                                style="width: 297px; height: 215px">
                                        @elseif ($index == 3)
                                            <img src="{{ asset('/uploads/farmer/' . $image) }}" alt=""
                                                class="img-fluid rd-details-research-img4"
                                                style="width: 438px; height: 292px">
                                        @endif
                                    </div>
                                @endif
                            @empty
                            @endforelse
                        @endif
                    </div>
                </div>
                <div class="rd-details-research-bg">
                    <img src="{{ asset('/web/img/Ellipse 4.png') }}" alt="" class="img-fluid"
                        style="width: 500px; height: 465px;">
                </div>
            </div>
            <div class="col-md-6 rd-details-research-textcontent">
                <div class="">
                    <div class="d-flex flex-column">
                        <div class="d-flex farmers-details-custom-gap">
                            <div>
                                <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                            </div>
                            <div>
                                <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div>
                            <h2 class="text-success mb-3 ms-5">FARMER'S SUCCESS STORY</h2>
                        </div>
                    </div>
                </div>
                <p>{{ strip_tags(@$data->description2) }}</p>
            </div>
        </div>
    </div>

    {{-- ESTABLISHMENT OF SALINE R&D CENTER AT RAMPAL, BAGERHAT --}}
    <div class="container-fluid" style="margin-top: 100px">
        <div class="row px-4 align-items-stretch equal-height">
            <!-- First Column -->
            <div class="col-md-6 about-org-content d-flex">
                <div class="w-100">
                    <div class="wow fadeInLeft">
                        <div class="d-flex flex-column">
                            <div>
                                <h2 class="">{{ @$data->title2 }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="wow fadeInLeft">
                        <div>
                            <p>{{ strip_tags(@$data->description) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Column -->
            <div class="col-md-6 wow fadeInRight d-flex justify-content-center align-items-center">
                <img src="{{ asset('uploads/farmer/' . @$data->image_path) }}" alt="" class="img-fluid"
                    style="width: 803px; height: 635px; border-radius: 30px;" />
            </div>
        </div>

    </div>
@endsection