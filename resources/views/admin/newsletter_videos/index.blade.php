@extends('admin.layouts.master')
@section('title', __('dashboard.newsletter_videos'))
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <!-- Include page breadcrumb -->
        @include('admin.inc.breadcrumb', ['pageTitle' => __('dashboard.newsletter_videos')])
        <!-- end page title -->

        <div class="row mb-3">
            <div class="col-12">
                <a href="{{ route('admin.newsletter_videos.create') }}"
                    class="btn btn-primary">{{ __('dashboard.add_new') }}</a>

                <a href="{{ url()->current() }}" class="btn btn-info">{{ __('dashboard.refresh') }}</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">{{ __('dashboard.list') }}</h4>
                    </div>
                    <div class="card-body">

                        <!-- Data Table Start -->
                        <div class="table-responsive">
                            <table id="basic-datatable" class="table table-striped table-hover nowrap">
                                <thead>
                                    <tr>
                                        <th>{{ __('dashboard.no') }}</th>
                                        <th>{{ __('dashboard.video') }}</th>
                                        <th>{{ __('dashboard.status') }}</th>
                                        <th>{{ __('dashboard.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $index => $video)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if ($video->file_path)
                                                    <!-- Display uploaded video -->
                                                    <video width="200" height="120" controls>
                                                        <source src="{{ asset($video->file_path) }}" type="video/mp4">
                                                        {{ __('dashboard.video_not_supported') }}
                                                    </video>
                                                @elseif ($video->youtube_video_id)
                                                    <!-- Embed YouTube video -->
                                                    <iframe width="200" height="120"
                                                        src="https://www.youtube.com/embed/{{ $video->youtube_video_id }}"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen>
                                                    </iframe>
                                                @else
                                                    <span>{{ __('dashboard.no_video_available') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($video->status == 1)
                                                    <span
                                                        class="badge badge-success badge-pill">{{ __('dashboard.active') }}</span>
                                                @else
                                                    <span
                                                        class="badge badge-danger badge-pill">{{ __('dashboard.inactive') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Action buttons (e.g. edit, delete) -->
                                                <a href="{{ route($route . '.edit', [$video->id]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteModal-{{ $video->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <!-- Include Delete modal -->
                                                @include('admin.inc.delete', ['row' => $video])
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Data Table End -->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->
    <!-- End Content-->
@endsection
