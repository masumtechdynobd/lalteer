    <!-- Add modal content -->
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" novalidate action="{{ route($route . '.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">{{ __('dashboard.add') }} {{ $title }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Start -->
                        <div class="form-group">
                            <label for="title">{{ __('dashboard.name') }} <span>*</span></label>
                            <input type="text" class="form-control" name="title" id="title"
                                value="{{ old('title') }}" required>

                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.name') }}
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="description">{{ __('dashboard.description') }} <span>*</span></label>
                            <textarea class="form-control summernote" name="description" id="description" rows="8">{{ old('description') }}</textarea>

                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.description') }}
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label for="image">{{ __('dashboard.photo') }}
                            </label>
                            <input type="file" class="form-control" name="image" id="image" required>

                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.photo') }}
                            </div>
                        </div> --}}
                        <!-- Form End -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-dismiss="modal">{{ __('dashboard.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('dashboard.save') }}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
