{{-- resources/views/Admin/pages/sponsors/edit.blade.php --}}

@extends('Admin.layouts.admin')

@section('content')
    <h2>Edit Sponsor</h2>

    {{-- Düzenleme Formu --}}
    <form action="{{ route('admin.sponsor.update', ['sponsor' => $sponsor->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Update Sponsor</button>
    </form>
@endsection
