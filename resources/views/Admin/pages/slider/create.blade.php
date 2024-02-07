@extends('Admin.layouts.admin')

@section('content')
    <h2>Add Slider Image</h2>

    <form action="{{ route('admin.slider.store') }}" method="POST" class="mt-3" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="image" class="form-label">Image URL:</label>
            <input type="file" name="image" class="form-control">
            @error("image")
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Add Image</button>
    </form>
@endsection
