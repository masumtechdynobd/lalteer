@extends('web.layouts.master')

@section('content')
    {{-- Top Image Section --}}
    <div class="container-fluid"
        style="background: url('{{ asset('uploads/section/' . $section->image_path) }}'); position: relative; overflow: hidden; width: auto; height: 637px; background-position: center center; background-repeat: no-repeat; background-size: cover; padding: 140px 0 60px 0; transition: 0.5s;">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                Newsletter
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('newsletterdetails', $article->id) }}">Newsletter</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
            </ol>
        </div>
        <div class="bredcrumb-bottom-img-div">
            <img class="bredcrumb-bottom-img" src="{{ asset('/web/img/bredcrumb-footer-new.png') }}" alt=""
                style="width: 100%;">
        </div>
    </div>

    {{-- Article Details Section --}}
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12 text-center" style="margin-top: 150px;">
                <img src="{{ asset('/uploads/article/' . $article->image_path) }}" alt="{{ $article->title }}"
                    class="img-fluid mb-4">
            </div>
            <div class="col-md-12">
                <h1 class="mb-4 text-center">{{ $article->title }}</h1>
                <div>{!! $article->description !!}</div>
            </div>
        </div>
    </div>
@endsection
