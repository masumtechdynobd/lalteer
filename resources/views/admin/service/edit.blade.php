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
                        @method('PUT')
                        <div class="card-body">

                            <!-- Form Start -->
                            <div class="form-group">
                                <label for="title">{{ __('dashboard.title') }} <span>*</span></label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ $row->title }}" required>

                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.title') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="feature_id">Features Category</label>
                                <select name="feature_id" class="form-control" required>
                                    <option value="">Select Features</option>
                                    @foreach ($features as $feature)
                                        <option @if ($feature->id == $row->feature_id) selected @endif
                                            value="{{ $feature->id }}">{{ $feature->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category_id">Crops Category</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">Crops Category</option>
                                    @foreach ($categories as $category)
                                        <option @if ($category->id == $row->category_id) selected @endif
                                            value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="short_desc">{{ __('dashboard.short_desc') }} <span>*</span></label>
                                <textarea class="form-control summernote" name="short_desc" id="short_desc" rows="4" required>{{ $row->short_desc }}</textarea>

                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.short_desc') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('dashboard.description') }} <span>*</span></label>
                                <textarea class="form-control textMediaEditor" name="description" id="description" rows="8" required>{{ $row->description }}</textarea>

                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.description') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image">{{ __('dashboard.thumbnail') }}
                                    <span>{{ __('dashboard.image_size', ['height' => 500, 'width' => 800]) }}</span></label>
                                <input type="file" class="form-control" name="image" id="image">
                                <img class="mt-2" src="{{ asset('/uploads/service/' . $row->image_path) }}"
                                    width="80px" alt="">

                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.thumbnail') }}
                                </div>
                            </div>

                            {{-- <div class="form-group">
                                <label for="status">{{ __('dashboard.select_status') }}</label>
                                <select class="wide" name="status" id="status" data-plugin="customselect">
                                    <option value="1" @if ($row->status == 1) selected @endif>
                                        {{ __('dashboard.active') }}</option>
                                    <option value="0" @if ($row->status == 0) selected @endif>
                                        {{ __('dashboard.inactive') }}</option>
                                </select>
                            </div> --}}
                            {{-- new field --}}
                            <div class="form-group">
                                <label for="title2">Second Title</label>
                                <input type="text" class="form-control" name="title2" id="title2"
                                    value="{{ $row->title2 }}">

                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.title2') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description2">Second Description</label>
                                <textarea class="form-control textMediaEditor" name="description2" id="description2" rows="6">{{ $row->description2 }}</textarea>

                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.description2') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image2">Second Image
                                    <span>{{ __('dashboard.image_size', ['height' => 500, 'width' => 800]) }}</span></label>
                                <input type="file" class="form-control" name="image2" id="image2">
                                <img class="mt-2" src="{{ asset('/uploads/service/' . $row->image_path2) }}"
                                    width="80px" alt="">
                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.thumbnail2') }}
                                </div>
                            </div>
                            <!-- Form End -->

                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('dashboard.update') }}</button>
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
