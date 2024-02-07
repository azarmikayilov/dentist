@extends('Admin.layouts.admin')

@section('content')
    <h2>Sponsor Images</h2>

    <a href="{{ route('admin.sponsor.create') }}" class="btn btn-success">Add Sponsor</a>

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
        @foreach($sponsors as $sponsor)
            <tr>
                <td>{{ $sponsor->id }}</td>
                <td><img src="{{ asset('storage/'.$sponsor->image) }}" alt="Sponsor Image" width="100"></td>
                <td>
                    <a href="{{ route('admin.sponsor.edit', ['sponsor' => $sponsor->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.sponsor.destroy', ['sponsor' => $sponsor->id]) }}" method="POST" class="d-inline">
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
