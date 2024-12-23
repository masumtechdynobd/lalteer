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
                        >
                        @csrf
                        <div class="card-body">

                            <!-- Form Start -->
                            <div class="form-group">
                                <label for="subject_name">{{ __('Subject Name') }} <span>*</span></label>
                                <input type="text" class="form-control" name="subject_name" id="subject_name" required>
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
