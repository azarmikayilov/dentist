<!-- resources/views/Admin/pages/slider/index.blade.php -->
@extends('Admin.layouts.admin')

@section('title', 'Slider Images')

@section('content')
    <h2>Head Doctor </h2>
    <a href="{{ route('admin.doctor.create') }}" class="btn btn-success mb-3">Add </a>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($HeadDoctors as $HeadDoctor)
{{--            @dd($about)--}}
            <tr>
                {{--                @dd($blog)--}}

                <td>{{ $HeadDoctor->id }}</td>
                @foreach($HeadDoctor->translations as $item )
                    <td>{!! Str::limit(strip_tags($item->description),70)  !!}</td>
                @endforeach

                <td>
                    <a href="{{ route('admin.doctor.edit', ['doctor' => $HeadDoctor->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.doctor.destroy', ['doctor' => $HeadDoctor->id]) }}" method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
