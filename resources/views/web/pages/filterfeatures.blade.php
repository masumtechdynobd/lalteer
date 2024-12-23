@extends('web.layouts.master')
@section('content')
    {{-- top image section --}}
    <div class="container-fluid bg-breadcrumb-rd">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                Features
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Features</a></li>
            </ol>
        </div>
    </div>


    {{-- detasils section --}}
    <div class="container-fluid ">
        <div class="text-center crops-margin mb-3">
            <h2>Explore This Features</h2>
        </div>

        <div>
            <img src="img/service-2-shape-2 1.png" alt="" class="img-fluid img-right-small">
        </div>
        <div class="row">
            @forelse ($crops as $crop)
                <div class="col-md-3">
                    <a href="{{ route('cropsdetailspage', $crop->slug) }}">
                        <div class="card crops-card-bg border-0 position-relative card-hover">
                            <img src="{{ asset('/uploads/service/' . $crop->image_path) }}" class="card-img-top p-2"
                                alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center text-danger">{{ $crop->title }}</h5>
                                <p class="card-text mb-4">{{ strip_tags($crop->short_desc) }}</p>
                            </div>
                            <!-- Circle positioned at the bottom and centered -->
                            <div
                                class="circle-bg position-absolute bottom-0 start-50 translate-middle-x d-flex justify-content-center align-items-center">
                                <i class="bi bi-arrow-up-left"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
            @endforelse
        </div>
    @endsection
