
@extends('Admin.layouts.admin')

@section('content')
    <h2>Settings</h2>
    @if($rowCount < 1)
    <a href="{{ route('admin.settings.create') }}" class="btn btn-success mb-3">Add New Setting</a>
    @else
        <button class="btn btn-danger disabled mb-3">If there are less than 1 link address, you can add a new one</button>
    @endif


    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th>Top Logo</th>
            <th>Bottom Logo</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
{{--        @foreach($settings as $setting)--}}
            <tr>
                <td style="width: 150px"><img src="{{ asset('storage/'.$settings->top_logo) }}"></td>
                <td style="width: 150px"><img src="{{ asset('storage/'.$settings->bottom_logo) }}"></td>
                <td>{{ $settings->address }}</td>
                <td>{{ $settings->phone }}</td>
                <td>
                    <a href="{{ route('admin.settings.edit', $settings->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.settings.destroy', ['setting' => $settings->id]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
{{--        @endforeach--}}
        </tbody>
    </table>
@endsection
