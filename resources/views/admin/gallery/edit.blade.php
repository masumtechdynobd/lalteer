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
                    <form class="needs-validation" novalidate action="{{ route($route . '.update', [$row->id]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- This makes the form submit as a PUT request -->

                        <div class="card-body">
                            <!-- Form Start -->
                            <div class="form-group">
                                <label for="text">{{ __('Text') }} <span>*</span></label>
                                <input type="text" class="form-control" name="text" id="text"
                                    value="{{ old('text', $row->text) }}" required>

                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.text') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photos_path">{{ __('dashboard.thumbnail') }} <span>*</span>
                                    <span>{{ __('dashboard.image_size', ['height' => 799, 'width' => 532]) }}</span></label>
                                <input type="file" class="form-control" name="photos_path" id="photos_path">

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
