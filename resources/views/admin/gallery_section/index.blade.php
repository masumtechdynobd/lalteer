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
                                        <th>{{ __('dashboard.name') }}</th>
                                        <th>{{ __('dashboard.photo') }}</th>
                                        <th>{{ __('Gallery') }}</th>
                                        <th>{{ __('Video') }}</th>
                                        <th>{{ __('dashboard.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->title }}</td>
                                            <td>
                                                @if (is_file(public_path($row->image)))
                                                    <img src="{{ asset($row->image) }}" alt="Gallery Image" width="50">
                                                @else
                                                    <span>{{ __('dashboard.no_image') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($row->multiple_images)
                                                    @foreach (json_decode($row->multiple_images) as $image)
                                                        <img src="{{ asset($image) }}" alt="Gallery Image" width="50">
                                                    @endforeach
                                                @else
                                                    <span>{{ __('dashboard.no_images') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($row->multiple_videos)
                                                    @foreach (json_decode($row->multiple_videos) as $video)
                                                        <video width="50" controls>
                                                            <source src="{{ asset($video) }}" type="video/mp4">
                                                        </video>
                                                    @endforeach
                                                @else
                                                    <span>{{ __('dashboard.no_videos') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route($route . '.show', [$row->id]) }}"
                                                    class="btn btn-success btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="{{ route($route . '.edit', [$row->id]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="far fa-edit"></i>
                                                </a>

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
