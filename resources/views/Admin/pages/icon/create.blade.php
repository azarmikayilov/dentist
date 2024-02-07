
@extends('Admin.layouts.admin')

@section('content')
    <h2>Add Icon</h2>

    <form action="{{ route('admin.icon.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="url">Social URL:</label>
            <input type="text" name="url" class="form-control">
            @error("url")
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="url">Icon image:</label>
            <input type="file" name="image" class="form-control">
            @error("image")
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Add</button>
    </form>
@endsection
