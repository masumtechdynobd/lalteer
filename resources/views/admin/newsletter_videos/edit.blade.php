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
                        <h4 class="header-title">{{ __('dashboard.edit') }}</h4>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route($route . '.update', $row->id) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Include the PUT method -->
                        <div class="card-body">

                            <!-- Display Existing Video -->
                            @if ($row->file_path)
                                <div class="form-group">
                                    <label>{{ __('dashboard.current_video') }}</label>
                                    <div>
                                        <video controls width="100%">
                                            <source src="{{ asset($row->file_path) }}" type="video/mp4">
                                            {{ __('dashboard.video_not_supported') }}
                                        </video>
                                    </div>
                                </div>
                            @endif

                            <!-- Form Start -->
                            <div class="form-group">
                                <label for="video">{{ __('dashboard.video') }} <span>*</span></label>
                                <input type="file" class="form-control" name="video" id="video"
                                    accept="video/mp4,video/*">

                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.video') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title">{{ __('dashboard.title') }} <span>*</span></label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ old('title', $row->title) }}" required>

                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.title') }}
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('dashboard.save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->
    <!-- End Content-->

@endsection
