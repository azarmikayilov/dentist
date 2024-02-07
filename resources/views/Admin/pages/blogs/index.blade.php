@extends('Admin.layouts.admin')

@section('content')
    <h2>Blog Posts</h2>
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-success mb-3">Add Blog Post</a>

    <table class="table mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($blogs as $blog)
{{--            @dd($blog)--}}
{{--            @dd($blog->id)--}}



            <tr>
                <td>{{ $blog->id }}</td>
                <td><img src="{{ asset('storage/'. $blog->image) }}" alt="Blog Post Image" width="100"></td>
                <td>{{ $blog->translations->first()->title }}</td>
                <td>{{ Str::limit($blog->translations->first()->description ?? '', 40)}}</td>
                <td>
                    <a href="{{ route('admin.blogs.edit', ['blog' => $blog->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.blogs.destroy', ['blog' => $blog->id]) }}" method="POST" class="d-inline">
{{--                                    @dd($blog->id)--}}

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
