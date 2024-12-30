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
                            <label for="title">{{ __('dashboard.title') }} <span>*</span></label>
                            <input type="text" class="form-control" name="title" id="title"
                                value="{{ old('title') }}" required>
                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.title') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">{{ __('Single Photo') }} {{ __('size:799x532') }} <span>*</span></label>
                            <input type="file" class="form-control" name="image" id="image" required>
                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.photo') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="multiple_images">{{ __('Upload Images') }}
                                ({{ __('multiple') }}) {{ __('size:392x294') }}</label>
                            <input type="file" class="form-control" name="multiple_images[]" id="multiple_images"
                                multiple>
                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.upload_images') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="multiple_videos">{{ __('Upload Videos') }}
                                ({{ __('multiple') }}) {{ __('size:392x294') }}</label>
                            <input type="file" class="form-control" name="multiple_videos[]" id="multiple_videos"
                                multiple>
                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.upload_videos') }}
                            </div>
                        </div>
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
    </div>
