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
                        <h4 class="header-title">{{ __('dashboard.add') }} {{ $title }}</h4>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route($route . '.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <!-- Form Start -->
                            <div class="form-group">
                                <label for="title">{{ __('dashboard.title') }} <span>*</span></label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ old('title') }}" required>

                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.title') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date">{{ __('dashboard.date') }} <span>*</span></label>
                                <input type="date" class="form-control" name="date" id="date"
                                    value="{{ old('date') }}">

                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.date') }}
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="category">{{ __('dashboard.category') }} <span>*</span></label>
                                <select class="form-control" name="category" id="category" required>
                                    <option value="">{{ __('dashboard.select') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if (old('category') == $category->id) selected @endif>{{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.category') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="board_of_directory"
                                        name="board_of_directory" {{ old('board_of_directory') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="board_of_directory">Add Home Page</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('dashboard.description') }} <span>*</span></label>
                                <textarea class="form-control textMediaEditor" name="description" id="description" rows="8" required>{{ old('description') }}</textarea>

                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.description') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image">{{ __('dashboard.thumbnail') }} <span>*</span>
                                    <span>{{ __('dashboard.image_size', ['height' => 420, 'width' => 448]) }}</span></label>
                                <input type="file" class="form-control" name="image" id="image" required>

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
