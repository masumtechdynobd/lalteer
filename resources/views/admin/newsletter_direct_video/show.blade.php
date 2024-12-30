@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <!-- Include page breadcrumb -->
    @include('admin.inc.breadcrumb')
    <!-- end page title -->

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
                    @if (is_file(public_path($row->video)))  <!-- Check if the video file exists -->
                        <p><span class="text-highlight">{{ __('Video') }}:</span></p>
                        <video width="100%" height="auto" controls>
                            <source src="{{ asset($row->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <p>{{ __('dashboard.no_video_found') }}</p>  <!-- Message if no video is found -->
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

                    <!-- Details View End -->
                </div>
            </div>
        </div><!-- end col-->
    </div>
    <!-- end row-->

</div> <!-- container -->
<!-- End Content-->

@endsection
