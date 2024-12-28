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
                        method="POST">
                        @csrf
                        @method('PUT') <!-- Include the method override for PUT -->

                        <div class="form-group">
                            <label for="subject_name">{{ __('Subject Name') }} <span>*</span></label>
                            <input type="text" class="form-control" name="subject_name" id="subject_name"
                                value="{{ old('subject_name', $row->subject_name) }}" required>
                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.subject_name') }}
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('dashboard.save') }}</button>
                        </div>
                    </form>

                </div>
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->
    <!-- End Content-->

@endsection
