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
                    <form class="needs-validation" novalidate action="{{ route($route . '.update', $row->id) }}"
                      method="post" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="card-body">

                          <!-- Form Start -->

                          <div class="form-group">
                              <label for="image">{{ __('dashboard.thumbnail') }}
                                  <span>{{ __('dashboard.image_size', ['height' => 420, 'width' => 448]) }}</span></label>
                              <input type="file" class="form-control" name="photos_path" id="image">

                              <div class="invalid-feedback">
                                  {{ __('dashboard.please_provide') }} {{ __('dashboard.thumbnail') }}
                              </div>
                          </div>

                          

                          <div class="form-group">
                              <label for="status">{{ __('dashboard.select_status') }}</label>
                              <select class="wide" name="status" id="status" data-plugin="customselect">
                                  <option value="1" @if ($row->status == 1) selected @endif>
                                      {{ __('dashboard.active') }}</option>
                                  <option value="0" @if ($row->status == 0) selected @endif>
                                      {{ __('dashboard.inactive') }}</option>
                              </select>
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
