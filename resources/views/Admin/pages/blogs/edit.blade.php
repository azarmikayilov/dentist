@extends('admin.layouts.admin')

@section('content')
    <h2>Edit Blog Post</h2>
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif


    @php
        $categoryTranslation =[];
           foreach ($categoriesBlogEdit as $category){
//               dd($category->translations);
            $categoryTranslation[] = $category->translations
                ->where('language.lang', 'tr')->first();
            }
//                                    dd($categoryTranslation);
//                                    $categoryTranslation->category_id  bu ile $blog->category_id = dise bunu yazacam
//                                       echo '<pre>';
//                                       print_r($categoryTranslation);
    @endphp


    <form action="{{ route('admin.blogs.update', ['blog' => $blog->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
{{--        <input type="hidden" name="blog_id" id="{{$blog_id}}">--}}
        <input type="hidden" name="blog_id" id="blog_id" value="{{ $blog->id }}">

        <div class="card-body">

            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                @foreach(config('app.languages') as $lang)
                    @php
                        $langId = \App\Models\Language::where('lang', $lang)->first()->id;
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link {{$loop->first ? 'active' : ''}}" id="custom-tabs-one-home-tab-{{$lang}}" data-bs-toggle="pill" href="#tab-{{$lang}}" role="tab" aria-controls="custom-tabs-one-home" aria-selected="{{$loop->first ? 'true' : 'false'}}">{{$lang}}</a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content" id="custom-tabs-one-tabContent">
                @foreach(config('app.languages') as $lang)
                    @php
                        $langId = \App\Models\Language::where('lang', $lang)->first()->id;
                    @endphp
                    <div class="tab-pane fade {{$loop->first ? 'show active' : ''}}" id="tab-{{$lang}}" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab-{{$lang}}">
                        <div class="form-group">
                            <label for="{{$lang}}-title">Title</label>
                            <input type="text" name="{{$lang}}[title]" class="form-control" id="{{$lang}}-title" value="{{ old($lang.'.title', $blog->translations->where('language_id', $langId)->first()->title ?? '') }}">
                            @error("$lang.title")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="{{$lang}}-description">Description</label>
                            <textarea name="{{$lang}}[description]" class="form-control blog" id="summernote" rows="4">{{ old($lang.'.description', $blog->translations->where('language_id', $langId)->first()->description ?? '') }}</textarea>
                            @error("$lang.description")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
                {{-- Add any error handling for image if needed --}}
            </div>


            <div class="form-group my-3">
                <label for="categorySelect">Category</label>
                {{--                            @dd($categoryTranslation)--}}
                {{--                        @dd($categoryTranslation)--}}
                <select name="category" class="form-control" id="categorySelect">
                    @foreach($categoryTranslation as $item)

                        <option value="{{$item->category_id ?? ''}}"
                            {{$item->category_id == $blog->category_id ? 'selected' : ''}}>{{ $item->name ?? '' }}</option>
                    @endforeach
                </select>
                @error('category')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </div>



    </form>

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
