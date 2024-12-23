@extends('admin.layouts.master')
@section('content')
    <div class="container variety_section">
        <h1>Create Variety</h1>
        <form action="{{ route('admin.varieties.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="breeder_name">Breeder Name</label>
                <input type="text" name="breeder_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="crop_id">Crop</label>
                <select name="crop_id" class="form-control" required>
                    <option value="">Select Crops</option>
                    @foreach ($crops as $crop)
                        <option value="{{ $crop->id }}">{{ $crop->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" name="color" class="form-control">
            </div>

            <div class="form-group">
                <label for="weight">Weight</label>
                <input type="text" name="weight" class="form-control">
            </div>

            <div class="form-group">
                <label for="rate">Rate</label>
                <input type="text" name="rate" class="form-control">
            </div>

            <div class="form-group">
                <label for="showing_time">Showing Time</label>
                <input type="text" name="showing_time" class="form-control">
            </div>

            <div class="form-group">
                <label for="yield">Yield</label>
                <input type="text" name="yield" class="form-control">
            </div>

            <div class="form-group">
                <label for="maturity">Maturity</label>
                <input type="text" name="maturity" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Create
                <style>
                    .variety_section {
                        padding: 40px;
                        margin-top: 20px;
                        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
                    }
                </style>
            @endsection
