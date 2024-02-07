@extends('admin.layouts.admin')

@section('content')
    <h2>Add Blog Post</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            @foreach(config('app.languages') as $lang)
                                <li class="nav-item">
                                    <a class="nav-link {{$loop->first ? 'active show' : ''}} @error("$lang.title") text-danger @enderror"
                                       id="custom-tabs-one-home-tab-{{$lang}}" data-bs-toggle="pill" href="#tab-{{$lang}}" role="tab"
                                       aria-controls="custom-tabs-one-home" aria-selected="true">{{$lang}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @php
                        $categoryTranslation = [];
                           foreach ($categoriesBlogEdit as $category){
                            $categoryTranslation[] = $category->translations
                                ->where('language.lang', 'tr')->first();
                            }
//                                    dd($categoryTranslation);
//                                    $categoryTranslation->category_id  bu ile $blog->category_id = dise bunu yazacam
//                                       echo '<pre>';
//                                       print_r($categoryTranslation);
                    @endphp
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            @foreach(config('app.languages') as $lang)
                                <div class="tab-pane fade {{$loop->first ? 'active show' : ''}}" id="tab-{{$lang}}"
                                     role="tabpanel" aria-labelledby="custom-tabs-one-home-tab-{{$lang}}">
                                    <div class="form-group">
                                        <label for="{{$lang}}-title">Title</label>
                                        <input type="text" name="{{$lang}}[title]" class="form-control" id="{{$lang}}-title" value="{{ old("$lang". 'title') }}">
                                        @error("$lang.title")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="{{$lang}}-description">Description</label>
                                        <textarea name="{{$lang}}[description]" class="form-control blog" id="summernote" rows="4">{{old('summernote')}}</textarea>
                                        @error("$lang.description")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>


                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="form-group py-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="{{$lang}}-category_id">Category</label>
{{--                    @dd($categoryTranslation)--}}
                    <select name="category_id" class="form-control">
                        @foreach($categoryTranslation as $category)
                            <option value="{{ $category->category_id }}">{{ $category->name }}</option>
{{--                            @dd($category->name)--}}
                        @endforeach
                    </select>
                </div>


                <button class="btn btn-success">Save</button>
            </form>
        </div>
    </div>

    <!-- Include Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Include Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#summernote.blog').summernote({
                placeholder: 'Enter description here...',
                height: 200,
            });
        });
    </script>
@endsection
