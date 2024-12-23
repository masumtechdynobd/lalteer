@extends('admin.layouts.master')
@section('content')
    <div class="container">
        <div class="variety_section">
            <h1>Varieties List</h1>
            <a href="{{ route('admin.varieties.create') }}" class="btn btn-primary">Create Variety</a>

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Breeder Name</th>
                        <th>Crop</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($varieties as $variety)
                        <tr>
                            <td><img src="{{ asset('/uploads/varieties/' . $variety->image) }}" width="100">
                            </td>
                            <td>{{ $variety->title }}</td>
                            <td>{{ $variety->breeder_name }}</td>
                            <td>{{ getCropName($variety->crop_id) }}</td>
                            <td>
                                <a href="{{ route('admin.varieties.edit', $variety) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.varieties.destroy', $variety) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <style>
        .variety_section {
            padding: 40px;
            margin-top: 20px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
    </style>
@endsection
