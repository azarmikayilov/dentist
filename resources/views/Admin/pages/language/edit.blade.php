@extends('Admin.layouts.admin')

@section('content')
    <h2>Edit Language Item</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.language.edits',['language'=>$language->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group py-3">
                    <label>Short Name</label>
                    <input type="text" name="short_name" class="form-control" value="{{$language->lang}}" placeholder="Short Name...">
                    @error('short_name')
                    <span class="text-danger">{{ $message }} </span>
                    @enderror
                </div>

                <div class="form-group py-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" >
                    @error('image')
                    <span class="text-danger">{{ $message }} </span>
                    @enderror
                </div>

                <button class="btn btn-success">Edit</button>
            </form>
        </div>
    </div>

@endsection
