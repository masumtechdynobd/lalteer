@extends('web.layouts.master')
@section('content')
    {{-- top image section --}}
    <div class="container-fluid bg-breadcrumb-rd">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                Research and Development
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">R & D</a></li>
            </ol>
        </div>
    </div>
    @php
        $count = 1;
    @endphp
    @foreach ($data as $item)
        @if ($count % 2 == 1)
            {{-- R & D at lal teer seed limited --}}
            <div class="container-fluid organization-top-margin">
                <div class="row px-4">

                    <div class="col-md-7 about-org-content">
                        <div>
                            <div class="wow fadeInUp">
                                <div class="d-flex flex-column">
                                    <div class="d-flex rd-custom-gap">
                                        <div>
                                            <img src="{{ asset('/web/img/loader 2.png') }}" alt=""
                                                class="img-fluid">
                                        </div>
                                        <div>
                                            <img src="{{ asset('/web/img/loader 2.png') }}" alt=""
                                                class="img-fluid">
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-success mb-3 ms-5 about-org-content-h">{{ $item->title }}
                                        </h3>
                                    </div>
                                </div>
                                <h2 class="mb-4 custom-letter-spacing" style="font-weight: normal;">
                                    {{ $item->title2 }}
                                </h2>
                            </div>
                            <div class="wow fadeInLeft">
                                <p class="mb-4">
                                    {{ \Illuminate\Support\Str::words(strip_tags($item->description), 170) }}
                                </p>

                                <a href="{{ route('researchanddevelopmentdetailspage', $item->slug) }}"
                                    class="btn buynow-btn rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">READ
                                    MORE</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 wow fadeInRight d-flex justify-content-center align-items-center">
                        <img src="{{ asset('/web/img/rd1.png') }}" alt="" class="img-fluid"
                            style="width: 733px; height: 464px; border-radius: 30px;" />
                    </div>
                </div>
            </div>
        @else
            {{-- ESTABLISMENT OF R&D FARM AT MODHUPUR, TANGAIL --}}
            <div class="container-fluid organization-top-margin">
                <div class="row px-4">

                    <div class="col-md-5 wow fadeInLeft d-flex justify-content-center align-items-center">
                        <img src="{{ asset('uploads/research/' . $item->image_path) }}" alt="" class="img-fluid"
                            style="width: 733px; height: 464px; border-radius: 30px;" />
                    </div>

                    <div class="col-md-7 about-org-content">
                        <div>
                            <div class="wow fadeInRight">
                                <div class="d-flex flex-column">
                                    <div class="d-flex rd-establisment-custom-gap">
                                        <div>
                                            <img src="{{ asset('/web/img/loader 2.png') }}" alt=""
                                                class="img-fluid">
                                        </div>
                                        <div>
                                            <img src="{{ asset('/web/img/loader 2.png') }}" alt=""
                                                class="img-fluid">
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-success mb-3 ms-5">{{ $item->title }}</h3>
                                    </div>
                                </div>
                                <h2 class="mb-4 custom-letter-spacing" style="font-weight: normal;">
                                    {{ $item->title2 }}
                                </h2>
                            </div>
                            <div class="wow fadeInRight">
                                <p class="mb-4 text-justify">
                                    {{ \Illuminate\Support\Str::words(strip_tags($item->description), 180) }}
                                </p>

                                <a href="{{ route('researchanddevelopmentdetailspage', $item->slug) }}"
                                    class="btn buynow-btn rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">READ
                                    MORE</a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        @endif
        @php
            $count++;
        @endphp
    @endforeach
@endsection
