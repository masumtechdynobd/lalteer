@extends('web.layouts.master')
@section('content')
    {{-- Top Image Section --}}
    <div class="container-fluid"
        style="background: url('{{ asset('uploads/section/' . $section->image_path) }}'); position: relative; overflow: hidden; width: auto; height: 637px; background-position: center center; background-repeat: no-repeat; background-size: cover; padding: 140px 0 60px 0; transition: 0.5s;">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                GALLERY
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Gallery</a></li>
            </ol>
        </div>
        <div class="bredcrumb-bottom-img-div">
            <img class="bredcrumb-bottom-img" src="{{ asset('/web/img/Group 49.png') }}" alt=""
                style="width: 100%;">
        </div>
    </div>

    {{-- Gallery Section --}}
    <div class="container-fluid" style="margin-top: 80px;">
        <div class="row">
            @foreach ($rows as $row)
                <div
                    class="col-md-6 col-lg-4 card-gallery-hover-content position-relative d-flex flex-column align-items-center justify-content-center">
                    <a href="{{ route('gallerydetails', ['id' => $row->id]) }}">
                        <!-- Image -->
                        <img src="{{ asset($row->image) }}" class="img-fluid card-gallery-image" alt="{{ $row->title }}"
                            style="width: 100%; height: auto; object-fit: cover;">

                        <!-- Hidden Content (will show on hover) -->
                        <div class="gallery-hover-content position-absolute d-flex flex-column justify-content-center align-items-center"
                            style="color: white;">
                            <h2 class="text-center text-white">{{ $row->title }}</h2>
                        </div>

                        <!-- Bottom Text (hidden when hovered) -->
                        <h4 class="gallry-bottom-text text-center">{{ $row->title }}</h4>
                    </a>
                </div>
            @endforeach
        </div>


        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $rows->links() }}
        </div>
    </div>
@endsection
