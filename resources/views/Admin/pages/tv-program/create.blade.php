@extends('Admin.layouts.admin')

@section('content')
    <h2>Add Tv Program Video</h2>

    <form action="{{ route('admin.tv-program.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="url">Tv Program URL:</label>
            <input type="text" name="url" class="form-control">
            @error("url")
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Tv Program Title:</label>
            <input type="text" name="title" class="form-control">
            @error("title")
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Add Video</button>
    </form>
@endsection
