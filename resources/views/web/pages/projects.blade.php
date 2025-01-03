@extends('web.layouts.master')
@section('content')
    {{-- top image section --}}
    <div class="container-fluid" style="background: url('{{ asset('uploads/section/' . $section->image_path) }}'); position: relative; overflow: hidden; width: auto; height: 637px; background-position: center center; background-repeat: no-repeat; background-size: cover; padding: 140px 0 60px 0; transition: 0.5s;">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                {{ $title }}
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('projects') }}">Projects</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid" style="margin-top: 80px">
        <div class="row g-2">
            @foreach ($data as $item)
                <div class="col-md-6 pe-3 wow fadeInLeft">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <img src="{{ asset('uploads/project/' . $item->image_path) }}" alt=""
                                    class="img-fluid" style="width: 450px; height: auto;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>{{ \Illuminate\Support\Str::words(strip_tags($item->description2), 60) }}</p>
                            <a href="{{ route('projectsdetails', $item->slug) }}"
                                class="btn buynow-btn rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">READ
                                MORE</a>
                        </div>
                        <div class="bg-success py-4 success-story-rounded-pill-end"
                            style="margin-left: 12px; width: 600px;">
                            <h5 class="text-white">{{ $item->title }}</h5>
                        </div>
                        <hr style="border: 2px solid #026431; margin-left: 12px !important;">
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Pagination -->
        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            <div class="pagination-wrapper">
                {{ $data->links() }}
            </div>
        </div>



    </div>
@endsection
