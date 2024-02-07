@extends('Admin.layouts.admin')

@section('content')
    <h2>Edit Slider Image</h2>

    <form action="{{ route('admin.slider.update', ['slider' => $slider->id]) }}" method="POST" class="mt-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="image" class="form-label">Image URL:</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Image</button>
    </form>
@endsection
