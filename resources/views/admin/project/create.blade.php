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
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="">Select Status</option>

                                <option value="ongoing">Ongoing</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Title two(Sub title)</label>
                            <input type="text" class="form-control" name="title2" id="title2"
                                value="{{ old('title2') }}" required>
                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.title2') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('dashboard.description') }} <span>*</span></label>
                            <textarea class="form-control summernote" name="description" id="description" rows="8" required>{{ old('description') }}</textarea>
                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.description') }}
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="image">{{ __('dashboard.photo') }} [450px*275px] <span>*</span></label>
                            <input type="file" class="form-control" name="image" id="image" required>
                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.photo') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description2">Additional Description</label>
                            <textarea class="form-control" name="description2" id="description2" rows="5">{{ old('description2') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="multiple_images">Upload Images[max:4]</label>
                            <input type="file" class="form-control" name="multiple_images[]" id="multiple_images"
                                multiple>
                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.upload_images') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">Project Aim Photo[802px*635px]</label>
                            <input type="file" class="form-control" name="projects_aim_photo"
                                id="projects_aim_photo">
                            <div class="invalid-feedback">
                                {{ __('dashboard.please_provide') }} {{ __('dashboard.photo') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">Aim Title</label>
                            <input type="text" class="form-control" name="projects_aim_title" id="projects_aim_title"
                                value="{{ old('projects_aim_title') }}">

                        </div>
                        <div class="form-group">
                            <label for="description2">Objectives[separated by coma(,)]</label>
                            <textarea class="form-control" name="objectives" id="objectives" rows="5">{{ old('objectives') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description2">Partnership</label>
                            <textarea class="form-control" name="partnership" id="partnership" rows="5">{{ old('partnership') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description2">Key info</label>
                            <textarea class="form-control" name="key_info" id="key_info" rows="5">{{ old('partnership') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description2">Key highlight</label>
                            <textarea class="form-control" name="key_highlight" id="key_highlight" rows="5">{{ old('key_highlight') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="key_achievement">Key Achievement</label>
                            <textarea class="form-control" name="key_achievement" id="key_achievement" rows="5">{{ old('key_achievement') }}</textarea>
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
