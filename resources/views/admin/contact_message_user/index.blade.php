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
                                        <th>{{ __('dashboard.email') }}</th>
                                        <th>{{ __('dashboard.phone') }}</th>
                                        <th>{{ __('dashboard.subject') }}</th>
                                        <th>{{ __('dashboard.message') }}</th>
                                        <th>{{ __('dashboard.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->phone }}</td>
                                            <td>{{ $row->subject->subject_name }}</td>
                                            <!-- Assuming `subject` is the related model -->
                                            <td>{{ $row->message }}</td>
                                            <td>
                                                <!-- View Modal Trigger -->
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#showModal-{{ $row->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                                <!-- Show Modal Content -->
                                                <div id="showModal-{{ $row->id }}" class="modal fade" tabindex="-1"
                                                    role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">
                                                                    {{ __('dashboard.view') }} {{ $title }}</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Details View Start -->
                                                                <h4><span
                                                                        class="text-highlight">{{ __('dashboard.subject') }}:</span>
                                                                    {{ $row->subject->subject_name }}</h4>
                                                                <p><span
                                                                        class="text-highlight">{{ __('dashboard.name') }}:</span>
                                                                    {{ $row->name }}</p>
                                                                <p><span
                                                                        class="text-highlight">{{ __('dashboard.email') }}:</span>
                                                                    {{ $row->email }}</p>
                                                                @if (isset($row->phone))
                                                                    <p><span
                                                                            class="text-highlight">{{ __('dashboard.phone') }}:</span>
                                                                        {{ $row->phone }}</p>
                                                                @endif
                                                                <hr />
                                                                <p><span
                                                                        class="text-highlight">{{ __('dashboard.message') }}:</span>
                                                                    {!! strip_tags($row->message, '<p><a><b><i><u><strong><br><ul><ol><li><del><ins><sup><sub><pre>') !!}</p>
                                                                <hr />
                                                                <!-- Details View End -->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light"
                                                                    data-dismiss="modal">{{ __('dashboard.close') }}</button>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->

                                                <!-- Delete Modal Trigger -->
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteModal-{{ $row->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>

                                                <!-- Delete Modal Content -->
                                                <div id="deleteModal-{{ $row->id }}" class="modal fade" tabindex="-1"
                                                    role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">
                                                                    {{ __('dashboard.delete_confirmation') }}</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>{{ __('dashboard.are_you_sure_delete') }}
                                                                    {{ $row->name }}?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <!-- Delete Form -->
                                                                <form action="{{ route($route . '.destroy', $row->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-light"
                                                                        data-dismiss="modal">{{ __('dashboard.cancel') }}</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">{{ __('dashboard.delete') }}</button>
                                                                </form>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
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
