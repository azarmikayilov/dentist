
@extends('Admin.layouts.admin')

@section('content')
    <h2>Edit YouTube Video</h2>

    <form action="{{ route('admin.icon.update', ['item' => $item->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="url">Social URL:</label>
            <input type="text" name="url" class="form-control" value="{{ $item->url }}" required>
        </div>
        <div class="form-group">
            <label for="url">Icon image:</label>
            <input type="file" name="image" class="form-control">
            <img src="{{ $item->image }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
