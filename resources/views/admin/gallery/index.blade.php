@extends('admin.layouts.master')
{{-- @section('title', $title) --}}
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <!-- Include page breadcrumb -->
        {{-- @include('admin.inc.breadcrumb') --}}
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">{{ __('dashboard.add_new') }}</a>

                <a href="" class="btn btn-info">{{ __('dashboard.refresh') }}</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title"> {{ __('dashboard.list') }}</h4>
                    </div>
                    <div class="card-body">

                        <!-- Data Table Start -->
                        <div class="table-responsive">
                            <table id="basic-datatable"
                                class="table table-striped table-hover table-dark nowrap full-width">
                                <thead>
                                    <tr>
                                        <th>{{ __('dashboard.no') }}</th>
                                        <th>{{ __('Text') }}</th>
                                        <th>{{ __('Thumbnail') }}</th>
                                        <th>{{ __('dashboard.status') }}</th>
                                        <th>{{ __('dashboard.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td> <!-- Serial number -->
                                            <td>{{ $row->text }}</td>
                                            <!-- Replace 'text' with the column name storing text -->
                                            <td>
                                                <img src="{{ asset($row->photos_path) }}" class="img-fluid"
                                                    alt="Newsletter Photo">
                                            </td>
                                            <td>
                                                @if ($row->status === 1)
                                                    <!-- Assuming status is 1 for active -->
                                                    <span class="badge bg-success">{{ __('dashboard.active') }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ __('dashboard.inactive') }}</span>
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
