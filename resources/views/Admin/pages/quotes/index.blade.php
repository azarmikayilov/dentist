{{-- resources/views/Admin/pages/quotes/index.blade.php --}}

@extends('Admin.layouts.admin')

@section('content')
    <h2>Quotes</h2>
    @if($rowCount < 3)
        <a href="{{ route('admin.quotes.create') }}" class="btn btn-success">Add Quote</a>
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
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($quotes as $quote)
            <tr>
                <td>{{ $quote->id }}</td>
                @foreach($quote->translations as $translation)
                        <td>{{ $translation->title }}</td>
                        <td>{{ $translation->description }}</td>
                @endforeach
                <td><img src="{{ asset('storage/'.$quote->image) }}" alt="Quote Image" width="100"></td>
                <td>
                    <a href="{{ route('admin.quotes.edit', ['quote' => $quote->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.quotes.delete', ['quote' => $quote->id]) }}" method="POST" class="d-inline">
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
