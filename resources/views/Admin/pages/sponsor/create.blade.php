{{-- resources/views/Admin/pages/sponsors/create.blade.php --}}

@extends('Admin.layouts.admin')

@section('content')
    <h2>Add Sponsor</h2>

    {{-- Oluşturma Formu --}}
    <form action="{{ route('admin.sponsor.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" id="image" name="image">
            @error("image")
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Add Sponsor</button>
    </form>
@endsection
