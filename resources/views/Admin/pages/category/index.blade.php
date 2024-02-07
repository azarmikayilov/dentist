@extends('Admin.layouts.admin')

@section('content')
    <h2>Categories</h2>

    <a href="{{ route('admin.category.create') }}" class="btn btn-success">Add Category</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>

{{--                @dd($category)--}}
                <td>{{ $category->id }}</td>
                @foreach($category->translations as $translation)
                        <td>{{ $translation->name }}</td>
                @endforeach
                <td>
                    <a href="{{ route('admin.category.edit', ['category' => $category->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.category.destroy', ['category' => $category->id]) }}" method="POST" class="d-inline">
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
