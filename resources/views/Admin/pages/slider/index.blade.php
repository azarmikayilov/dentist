<!-- resources/views/Admin/pages/slider/index.blade.php -->
@extends('Admin.layouts.admin')

@section('title', 'Slider Images')

@section('content')
    <h2>Slider Images</h2>

    <a href="{{ route('admin.slider.create') }}" class="btn btn-success">Add Image</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sliders as $slider)
            <tr>
                <td>{{ $slider->id }}</td>
                <td><img src="{{ asset('storage/'.$slider->image) }}" alt="Slider Image" width="100"></td>
                <td>
                    <a href="{{ route('admin.slider.edit', ['slider' => $slider->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.slider.destroy', ['slider' => $slider->id]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
