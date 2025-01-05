<!-- Edit modal content -->
<div id="editModal-{{ $row->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="needs-validation" novalidate action="{{ route($route . '.update', $row->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">{{ __('dashboard.edit') }} {{ $title }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <!-- Form Start -->
                    <div class="form-group">
                        <label for="title">{{ __('dashboard.name') }} <span>*</span></label>
                        <input type="text" class="form-control" name="title" id="title"
                            value="{{ $row->title }}" required>
                        <div class="invalid-feedback">
                            {{ __('dashboard.please_provide') }} {{ __('dashboard.name') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="ongoing" {{ $row->status === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ $row->status === 'completed' ? 'selected' : '' }}>Completed
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Title two(Sub title)</label>
                        <input type="text" class="form-control" name="title2" id="title2"
                            value="{{ $row->title2 }}">
                        <div class="invalid-feedback">
                            {{ __('dashboard.please_provide') }} {{ __('dashboard.name') }}
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">{{ __('dashboard.description') }} <span>*</span></label>
                        <textarea class="form-control summernote" name="description" id="description" rows="8" required>{!! $row->description !!}</textarea>
                        <div class="invalid-feedback">
                            {{ __('dashboard.please_provide') }} {{ __('dashboard.description') }}
                        </div>
                    </div>

                    <!-- New description2 -->
                    <div class="form-group">
                        <label for="description2">Additional Description</label>
                        <textarea class="form-control" name="description2" id="description2" rows="4">{{ $row->description2 }}</textarea>
                    </div>

                    <!-- Single Image (Photo) -->
                    <div class="form-group">
                        <label for="image">{{ __('dashboard.photo') }}[450px*275px] </label>
                        <input type="file" class="form-control" name="image" id="image">

                        <div class="invalid-feedback">
                            {{ __('dashboard.please_provide') }} {{ __('dashboard.photo') }}
                        </div>
                    </div>

                    <!-- Multiple Images -->
                    <div class="form-group">
                        <label for="multiple_images">Multiple Image</label>
                        <input type="file" class="form-control" name="multiple_images[]" id="multiple_images"
                            multiple>

                        <div class="invalid-feedback">
                            {{ __('dashboard.please_provide') }} {{ __('dashboard.photo') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image">Project Aim Photo[802px*635px]</label>
                        <input type="file" class="form-control" name="projects_aim_photo" id="projects_aim_photo">
                        <div class="invalid-feedback">
                            {{ __('dashboard.please_provide') }} {{ __('dashboard.photo') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Aim Title</label>
                        <input type="text" class="form-control" name="projects_aim_title" id="projects_aim_title"
                            value="{{ $row->projects_aim_title }}">

                    </div>
                    <div class="form-group">
                        <label for="description2">Objectives[separated by coma(,)]</label>
                        <textarea class="form-control" name="objectives" id="objectives" rows="5">{{ $row->objectives }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description2">Partnership</label>
                        <textarea class="form-control" name="partnership" id="partnership" rows="5">{{ $row->partnership }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description2">Key info</label>
                        <textarea class="form-control" name="key_info" id="key_info" rows="5">{{ $row->key_info }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description2">Key highlight</label>
                        <textarea class="form-control" name="key_highlight" id="key_highlight" rows="5">{{ $row->key_highlight }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="key_achievement">Key Achievement</label>
                        <textarea class="form-control" name="key_achievement" id="key_achievement" rows="5">{{ $row->key_achievement }}</textarea>
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
</div>

<script>
    function removeImage(button) {
        const hiddenInput = button.parentElement.querySelector('input[type="hidden"]');
        button.parentElement.remove();
        hiddenInput.disabled = true; // Mark the image for deletion
    }
</script>
