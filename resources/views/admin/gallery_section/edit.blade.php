@extends('admin.layouts.master')
@section('title', $title)
@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- Start page title -->
        <!-- Include page breadcrumb -->
        @include('admin.inc.breadcrumb')
        <!-- End page title -->

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
                                    value="{{ old('title', $row->title) }}" required>
                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.title') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image">{{ __('Single Photo') }} {{ __('size:799x532') }} <span>*</span></label>
                                <input type="file" class="form-control" name="image" id="image">
                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.photo') }}
                                </div>
                                @if ($row->image && is_file(public_path($row->image)))
                                    <img src="{{ asset($row->image) }}" alt="Current Image" width="100" class="mt-2">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="multiple_images">{{ __('Upload Images') }}
                                    ({{ __('multiple') }}) {{ __('size:392x294') }}</label>
                                <input type="file" class="form-control" name="multiple_images[]" id="multiple_images"
                                    multiple>
                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.upload_images') }}
                                </div>
                                @if ($row->multiple_images)
                                    <div class="mt-2">
                                        @foreach (json_decode($row->multiple_images) as $image)
                                            <img src="{{ asset($image) }}" alt="Image" width="50" class="mr-2">
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="multiple_videos">{{ __('Upload Videos') }}
                                    ({{ __('multiple') }}) {{ __('size:392x294') }}</label>
                                <input type="file" class="form-control" name="multiple_videos[]" id="multiple_videos"
                                    multiple>
                                <div class="invalid-feedback">
                                    {{ __('dashboard.please_provide') }} {{ __('dashboard.upload_videos') }}
                                </div>
                                @if ($row->multiple_videos)
                                    <div class="mt-2">
                                        @foreach (json_decode($row->multiple_videos) as $video)
                                            <video width="50" controls class="mr-2">
                                                <source src="{{ asset($video) }}" type="video/mp4">
                                            </video>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="status">{{ __('dashboard.status') }}</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ $row->status == 1 ? 'selected' : '' }}>
                                        {{ __('dashboard.active') }}</option>
                                    <option value="0" {{ $row->status == 0 ? 'selected' : '' }}>
                                        {{ __('dashboard.inactive') }}</option>
                                </select>
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
