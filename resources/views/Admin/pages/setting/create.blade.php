@extends('Admin.layouts.admin')

@section('content')
    <h2>Add Setting</h2>

    <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="top_logo">Top Logo:</label>
            <input type="file" name="top_logo" class="form-control">
            @error("top_logo")
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="bottom_logo">Bottom Logo:</label>
            <input type="file" name="bottom_logo" class="form-control">
            @error("bottom_logo")
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" class="form-control">
            @error("address")
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" class="form-control">
            @error("phone")
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control">
            @error("email")
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Setting</button>
    </form>
@endsection
