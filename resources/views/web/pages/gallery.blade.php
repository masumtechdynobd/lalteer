@extends('web.layouts.master')
@section('content')
    {{-- Top Image Section --}}
    <div class="container-fluid bg-breadcrumb-rd">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                GALLERY
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Gallery</a></li>
            </ol>
        </div>
    </div>

    {{-- Gallery Section --}}
    <div class="container-fluid" style="margin-top: 80px;">
        <div class="row">
            @foreach ($rows as $row)
                <div
                    class="col-md-6 card-gallery-hover-content position-relative d-flex flex-column align-items-center justify-content-center">
                    <a href="{{ route('gallerydetails', ['id' => $row->id]) }}">
                        <!-- Image -->
                        <img src="{{ asset($row->image) }}" class="img-fluid card-gallery-image" alt="..."
                            style="width: 799px; height: 532px; object-fit: cover;">

                        <!-- Hidden Content (will show on hover) -->
                        <div
                            class="gallery-hover-content position-absolute d-flex flex-column justify-content-center align-items-center text-white">
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
