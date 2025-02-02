@extends('admin.layouts.master')
@section('title', $title)
@section('content')

    <div class="container-fluid">

        @include('admin.inc.breadcrumb')



        <div class="row">
            <div class="col-12">
                <!-- Add modal button -->
                <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#addModal">{{ __('dashboard.add_new') }}</button>
                <!-- Include Add modal -->
                @include($view . '.create')

                <a href="{{ route($route . '.index') }}" class="btn btn-info">{{ __('dashboard.refresh') }}</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">{{ $title }} {{ __('dashboard.list') }}</h4>
                    </div>
                    <div class="card-body">

                        <!-- Data Table Start -->
                        <div class="table-responsive">
                            <table id="basic-datatable"
                                class="table table-striped table-hover table-dark nowrap full-width">
                                <thead>
                                    <tr>
                                        <th>{{ __('dashboard.no') }}</th>
                                        <th>{{ __('dashboard.photo') }}</th>
                                        <th>{{ __('dashboard.name') }}</th>
                                        <th>Gallery</th>
                                        <th>{{ __('dashboard.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                @if (is_file('uploads/' . $path . '/' . $row->image_path))
                                                    <img src="{{ asset('uploads/' . $path . '/' . $row->image_path) }}"
                                                        class="img-fluid" alt="Photo">
                                                @endif
                                            </td>
                                            <td>{!! str_limit(strip_tags($row->title), 50, ' ...') !!}</td>
                                            @php
                                                $images = json_decode($row->multiple_images);
                                            @endphp
                                            @if ($images)
                                                <td>
                                                    @foreach ($images as $image)
                                                        <img width="40"
                                                            src="{{ asset('uploads/' . $path . '/' . $image) }}"
                                                            alt="Image" />
                                                    @endforeach
                                                </td>
                                            @endif

                                            <td>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#showModal-{{ $row->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <!-- Include Show modal -->
                                                @include($view . '.show')

                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#editModal-{{ $row->id }}">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                                <!-- Include Edit modal -->
                                                @include($view . '.edit')

                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteModal-{{ $row->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <!-- Include Delete modal -->
                                                @include('admin.inc.delete')
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Data Table End -->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->


    </div> <!-- container -->
    <!-- End Content-->

@endsection
