    @extends('Admin.layouts.admin')

    @section('title', 'Doctor Images')

    @section('content')
        <h2>Doctor Images</h2>

        <a href="{{ route('admin.d_image.create') }}" class="btn btn-success">Add Image</a>

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
            @foreach($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->id }}</td>
                    <td><img src="{{ asset('storage/'.$doctor->image) }}" alt="Doctor Image" width="100"></td>
                    <td>
                        <a href="{{ route('admin.d_image.edit', ['image' => $doctor->id]) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.d_image.destroy', ['image' => $doctor->id]) }}" method="POST" class="d-inline">
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
