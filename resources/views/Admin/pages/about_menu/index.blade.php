{{-- resources/views/Admin/pages/quotes/index.blade.php --}}

@extends('Admin.layouts.admin')

@section('content')
    <h2>About Menu</h2>
    @if($rowCount < 3)
        <a href="{{ route('admin.menu.create') }}" class="btn btn-success">Add About Menu</a>
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
            <th>Slug</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->id }}</td>
                @foreach($menu->translations as $translation)
                    @if($translation->language->lang === $lang)
                        <td>{{ $translation->title }}</td>
                    @endif

                        <td>{{ $menu->slug }}</td>
                @endforeach
                <td>
                    <a href="{{ route('admin.menu.edit', ['menu' => $menu->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.menu.delete', ['menu' => $menu->id]) }}" method="POST" class="d-inline">
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
