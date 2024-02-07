
@extends('Admin.layouts.admin')

@section('content')
    <h2>Add YouTube Video</h2>

    <form action="{{ route('admin.youtube.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="url">YouTube URL:</label>
            <input type="text" name="url" class="form-control">
            @error("url")
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Add Video</button>
    </form>
@endsection
