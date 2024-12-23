@extends('admin.layouts.master')

@section('content')
    <div class="container variety_section">
        <h1>Edit Variety</h1>

        <!-- Form for editing the variety -->
        <form action="{{ route('admin.varieties.update', $variety->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This specifies that the form uses PUT method to update data -->

            <!-- Image input, showing existing image if available -->
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
                @if ($variety->image)
                    <img src="{{ asset('/uploads/varieties/' . $variety->image) }}" alt="Current Image" class="mt-2"
                        width="150">
                @endif
            </div>

            <!-- Title field -->
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $variety->title) }}"
                    required>
            </div>

            <!-- Breeder Name field -->
            <div class="form-group">
                <label for="breeder_name">Breeder Name</label>
                <input type="text" name="breeder_name" class="form-control"
                    value="{{ old('breeder_name', $variety->breeder_name) }}" required>
            </div>

            <!-- Crop dropdown with pre-selected crop -->
            <div class="form-group">
                <label for="crop_id">Crop</label>
                <select name="crop_id" class="form-control" required>
                    <option value="">Select Crops</option>
                    @foreach ($crops as $crop)
                        <option value="{{ $crop->id }}" {{ $crop->id == $variety->crop_id ? 'selected' : '' }}>
                            {{ $crop->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Color field -->
            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" name="color" class="form-control" value="{{ old('color', $variety->color) }}">
            </div>

            <!-- Weight field -->
            <div class="form-group">
                <label for="weight">Weight</label>
                <input type="text" name="weight" class="form-control" value="{{ old('weight', $variety->weight) }}">
            </div>

            <!-- Rate field -->
            <div class="form-group">
                <label for="rate">Rate</label>
                <input type="text" name="rate" class="form-control" value="{{ old('rate', $variety->rate) }}">
            </div>

            <!-- Showing Time field -->
            <div class="form-group">
                <label for="showing_time">Showing Time</label>
                <input type="text" name="showing_time" class="form-control"
                    value="{{ old('showing_time', $variety->showing_time) }}">
            </div>

            <!-- Yield field -->
            <div class="form-group">
                <label for="yield">Yield</label>
                <input type="text" name="yield" class="form-control" value="{{ old('yield', $variety->yield) }}">
            </div>

            <!-- Maturity field -->
            <div class="form-group">
                <label for="maturity">Maturity</label>
                <input type="text" name="maturity" class="form-control"
                    value="{{ old('maturity', $variety->maturity) }}">
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
    <style>
        .variety_section {
            padding: 40px;
            margin-top: 20px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
    </style>
@endsection
