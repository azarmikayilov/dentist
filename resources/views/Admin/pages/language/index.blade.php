
@extends('Admin.layouts.admin')

@section('content')


    <h2>Languages</h2>

    <a href="{{ route('admin.language.create') }}" class="btn btn-success">Add Language Item</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Short Name</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($languages as $language)
            <tr>
                <td>{{ $language->id }}</td>
                <td>{{ $language->lang }}</td>
                <td><img src="{{ url('storage/' . $language->image) }}" alt="Language Image" width="100"></td>
                <td>
                    <a href="{{ route('admin.language.edit', ['language' => $language->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.language.destroy', ['language' => $language->id]) }}" method="POST" class="d-inline">
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
