@extends('admin.layouts.master')
@section('title', $title)
@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- Start page title -->
        <!-- Include page breadcrumb -->
        @include('admin.inc.breadcrumb')
        <!-- End page title -->

        <div class="row">
            <div class="col-12">
                <a href="{{ route($route . '.index') }}" class="btn btn-info">{{ __('dashboard.back') }}</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">{{ __('dashboard.view') }} {{ $title }}</h4>
                    </div>
                    <div class="card-body">

                        <!-- Video Display -->
                        @if ($row->video && is_file(public_path($row->video)))
                            <!-- Check if the video file exists -->
                            <p><span class="text-highlight">{{ __('Video') }}:</span></p>
                            <video width="100%" height="auto" controls>
                                <source src="{{ asset($row->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <p>{{ __('dashboard.no_video_found') }}</p> <!-- Message if no video is found -->
                        @endif

                        <hr />

                        <!-- Status Display -->
                        <p><span class="text-highlight">{{ __('dashboard.status') }}:</span>
                            @if ($row->status == 1)
                                <span class="badge badge-success badge-pill">{{ __('dashboard.active') }}</span>
                            @else
                                <span class="badge badge-danger badge-pill">{{ __('dashboard.inactive') }}</span>
                            @endif
                        </p>

                        <!-- Image Display -->
                        @if ($row->image && is_file(public_path($row->image)))
                            <p><span class="text-highlight">{{ __('dashboard.photo') }}:</span></p>
                            <img src="{{ asset($row->image) }}" alt="{{ __('dashboard.photo') }}" class="img-fluid" />
                        @else
                            <p>{{ __('dashboard.no_image_found') }}</p>
                        @endif

                        <hr />

                        <!-- Multiple Images Display -->
                        @if ($row->multiple_images)
                            <p><span class="text-highlight">{{ __('dashboard.images') }}:</span></p>
                            <div class="row">
                                @foreach (json_decode($row->multiple_images) as $image)
                                    @if (is_file(public_path($image)))
                                        <div class="col-3">
                                            <img src="{{ asset($image) }}" alt="{{ __('dashboard.image') }}"
                                                class="img-fluid mb-2" />
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p>{{ __('dashboard.no_images_found') }}</p>
                        @endif

                        <hr />

                        <!-- Multiple Videos Display -->
                        @if ($row->multiple_videos)
                            <p><span class="text-highlight">{{ __('dashboard.videos') }}:</span></p>
                            <div class="row">
                                @foreach (json_decode($row->multiple_videos) as $video)
                                    @if (is_file(public_path($video)))
                                        <div class="col-3">
                                            <video width="100%" controls class="mb-2">
                                                <source src="{{ asset($video) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p>{{ __('dashboard.no_videos_found') }}</p>
                        @endif

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->
    <!-- End Content-->

@endsection
