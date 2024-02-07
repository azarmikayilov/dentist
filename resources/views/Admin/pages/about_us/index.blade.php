{{-- resources/views/Admin/pages/quotes/index.blade.php --}}

@extends('Admin.layouts.admin')

@section('content')
    <h2>About Us</h2>
    @if($rowCount < 3)
        <a href="{{ route('admin.about-us.create') }}" class="btn btn-success">Add About Menu</a>
    @else
        <button class="btn btn-danger disabled">If there are less than 3 quote items, you can add a new one</button>
    @endif

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Desc</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($aboutus as $about)
            <tr>
                <td>{{ $about->id }}</td>
                @foreach($about->translations as $translation)
                        <td>{{ Str::limit($translation->description, 100) }}</td>
                @endforeach
                <td>
                    <a href="{{ route('admin.about-us.edit', ['aboutus' => $about->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.about-us.delete', ['aboutus' => $about->id]) }}" method="POST" class="d-inline">
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
