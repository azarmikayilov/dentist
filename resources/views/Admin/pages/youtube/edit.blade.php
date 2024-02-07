
@extends('Admin.layouts.admin')

@section('content')
    <h2>Edit YouTube Video</h2>

    <form action="{{ route('admin.youtube.update', ['youtube' => $youtube->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="url">YouTube URL:</label>
            <input type="text" name="url" class="form-control" value="{{ $youtube->url }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Video</button>
    </form>
@endsection
