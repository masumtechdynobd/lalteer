    <!-- Edit modal content -->
    <div id="editModal-{{ $row->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" novalidate action="{{ route($route . '.update', $row->id) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">{{ __('dashboard.edit') }} {{ $title }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Start -->
                        <div class="form-group">
                            <label for="title">Title <span>*</span></label>
                            <input type="text" class="form-control" name="title" id="title"
                                value="{{ $row->title }}" required>

                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.name') }}
                            </div>
                        </div>

                        {{-- <div class="form-group">
                        <label for="designation">{{ __('dashboard.designation') }} <span>*</span></label>
                        <input type="text" class="form-control" name="designation" id="designation" value="{{ $row->designation }}" required>

                        <div class="invalid-feedback">
                          {{ __('dashboard.please_provide') }} {{ __('dashboard.designation') }}
                        </div>
                    </div> --}}

                        {{-- <div class="form-group">
                        <label for="organization">{{ __('dashboard.organization') }}</label>
                        <input type="text" class="form-control" name="organization" id="organization" value="{{ $row->organization }}">

                        <div class="invalid-feedback">
                          {{ __('dashboard.please_provide') }} {{ __('dashboard.organization') }}
                        </div>
                    </div> --}}

                        <div class="form-group">
                            <label for="description">Total<span>*</span></label>
                            <textarea class="form-control summernote" name="description" id="description" rows="8" required>{!! $row->description !!}</textarea>

                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.description') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">{{ __('dashboard.photo') }}(50*50px) </label>
                            <input type="file" class="form-control" name="image" id="image">

                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.photo') }}
                            </div>
                        </div>


                        <!-- Form End -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-dismiss="modal">{{ __('dashboard.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('dashboard.update') }}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
