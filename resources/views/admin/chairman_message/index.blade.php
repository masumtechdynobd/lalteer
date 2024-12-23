@extends('admin.layouts.master')
{{-- @section('title', $title) --}}
@section('content')
    <div class="container" style="padding-top: 40px">
        <h1>Chairman Message</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.chairman_message.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $chairmanMessage->title ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="designation">Designation:</label>
                <input type="text" name="designation" id="designation" class="form-control"
                    value="{{ old('designation', $chairmanMessage->designation ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $chairmanMessage->description ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image:(324*324px)</label>
                <input type="file" name="image" id="image" class="form-control">
                @if (!empty($chairmanMessage->image_path))
                    <img src="{{ asset('/uploads/chairman_message/' . $chairmanMessage->image_path) }}" alt="Chairman Image"
                        width="150" class="mt-2">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
