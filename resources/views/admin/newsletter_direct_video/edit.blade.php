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
                        <h4 class="header-title">{{ __('dashboard.edit') }} {{ $title }}</h4>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route($route . '.update', $row->id) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Include PUT method to update -->
                        <div class="card-body">

                            <!-- Form Start -->
                            <div class="form-group">
                                <label for="video">{{ __('Video') }} <span>*</span></label>
                                <input type="file" class="form-control" name="video" id="video"
                                    accept="video/mp4,video/x-m4v,video/*">
                                <small class="form-text text-muted">{{ __('dashboard.leave_blank_if_no_change') }}</small>

                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.video') }}
                                </div>
                            </div>

                            @if ($row->video)
                                <div class="form-group">
                                    <label for="current_video">{{ __('dashboard.current_video') }}</label>
                                    <video width="100%" height="auto" controls>
                                        <source src="{{ asset($row->video) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endif

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
