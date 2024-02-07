@extends('Admin.layouts.admin')

@section('content')
    <h2>Tv Program Videos</h2>

    <a href="{{ route('admin.tv-program.create') }}" class="btn btn-success">Add Video</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>TITLE</th>
            <th>URL</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($shows as $show)
            <tr>
                <td>{{ $show->id }}</td>
                <td>{{ $show->title }}</td>
                <td>{{ $show->url }}</td>
                <td>

                    <a href="{{ route('admin.tv-program.edit', ['tv_program' => $show->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.tv-program.destroy', ['tv_program' => $show->id]) }}" method="POST" class="d-inline">
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
