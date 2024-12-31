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
                        
                                <!-- Title Field -->
                                <div class="form-group">
                                    <label for="title">{{ __('dashboard.title') }} <span>*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" required>
                                    
                                    <div class="invalid-feedback">
                                        {{ __('dashboard.please_provide') }} {{ __('dashboard.title') }}
                                    </div>
                                </div>
                        
                                <!-- Description Field -->
                                <div class="form-group">
                                    <label for="description">{{ __('dashboard.description') }}</label>
                                    <textarea class="form-control summernote" name="description" id="description" rows="8">{{ old('description') }}</textarea>
    
                                    <div class="invalid-feedback">
                                        {{ __('dashboard.please_provide') }} {{ __('dashboard.description') }}
                                    </div>
                                </div>
                        
                                <!-- Image Field -->
                                <div class="form-group">
                                    <label for="image">{{ __('dashboard.thumbnail') }} <span>*</span>
                                        <span>{{ __('dashboard.image_size', ['height' => 392, 'width' => 294]) }}</span></label>
                                    <input type="file" class="form-control" name="photos_path" id="image" required>
                                    
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
