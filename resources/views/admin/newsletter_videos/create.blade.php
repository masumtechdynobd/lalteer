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
                        <h4 class="header-title">{{ __('dashboard.add') }}</h4>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route($route . '.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <!-- Form Start -->
                            <div class="form-group">
                                <label for="youtube_video_id">{{ __('video') }} <span>*</span></label>
                                <input type="text" class="form-control" name="youtube_video_id" id="youtube_video_id" required>

                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.thumbnail') }}
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
