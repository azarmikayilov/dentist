@extends('Admin.layouts.admin')

@section('content')
    <h2>Edit Tv Program Video</h2>
    <form action="{{ route('admin.tv-program.update', ['tv_program' => $tv_program->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="url">YouTube URL:</label>
            <input type="text" name="url" class="form-control" value="{{ $tv_program->url }}" required>
            @error("url")
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="url">Video Title:</label>
            <input type="text" name="title" class="form-control" value="{{ $tv_program->title }}" required>
            @error("title")
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Video</button>
    </form>
@endsection
