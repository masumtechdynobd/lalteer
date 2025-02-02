@extends('web.layouts.master')
@section('content')
    {{-- top image section --}}
    <div class="container-fluid"
        style="background: url('{{ asset('uploads/section/' . $section->image_path) }}'); position: relative; overflow: hidden; width: auto; height: 637px; background-position: center center; background-repeat: no-repeat; background-size: cover; padding: 140px 0 60px 0; transition: 0.5s;">
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
        <div class="bredcrumb-bottom-img-div">
            <img class="bredcrumb-bottom-img" src="{{ asset('/web/img/bredcrumb-footer-new.png') }}" alt=""
                style="width: 100%;">
        </div>
    </div>

    {{-- success stories section --}}
    <div class="container-fluid" style="margin-top: 80px">
        <div class="row h-100 g-2">
            @foreach ($data as $item)
                <div class="col-md-6 pe-3 wow fadeInLeft">
                    <div class="row">
                        <div class="col-md-6 h-100">
                            <div>
                                <img src="{{ asset('uploads/farmer/' . $item->image_path) }}" alt=""
                                    class="img-fluid" style="width: 392px; height: 275px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p style="text-align: justify !important;">
                                {{ \Illuminate\Support\Str::words(strip_tags($item->description2), 35) }}</p>
                            <a href="{{ route('farmersdetails', $item->slug) }}"
                                class="btn buynow-btn farmers-btn-read-more rounded-pill my-lg-0 flex-shrink-0">READ
                                MORE</a>
                        </div>
                        <div class="bg-success py-4 success-story-rounded-pill-end">
                            <h5 class="text-white">{{ \Illuminate\Support\Str::limit($item->title, 35) }}</h5>
                        </div>
                        <hr style="border: 2px solid #026431; margin-left: 12px !important; width: 97%;">
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
