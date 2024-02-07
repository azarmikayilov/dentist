@extends('Admin.layouts.admin')

@section('content')
    <h2>Icons</h2>
    @if($rowCount < 4)
        <a href="{{ route('admin.icon.create') }}" class="btn btn-success mb-3">Add New Icon</a>
    @else
        <button class="btn btn-danger disabled mb-3">If there are less than 4 item, you can add a new one</button>
    @endif

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th>Icon</th>
            <th>URL</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($item as $ite)
            <tr >
                <td><img src="{{ asset('storage/'.$ite->image) }}" style="max-width: 100px;"></td>
                <td class="d-flex align-items-center">{{ $ite->url }}</td>
                <td>
                    <a href="{{ route('admin.icon.edit', ['item' => $ite->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.icon.destroy', ['item' => $ite->id]) }}" method="POST" class="d-inline">
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
