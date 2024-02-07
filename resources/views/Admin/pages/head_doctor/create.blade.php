@extends('Admin.layouts.admin')

@section('content')
    <h2>Add  Item</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.doctor.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            @foreach(config('app.languages') as $lang)
                                <li class="nav-item">
                                    <a class="nav-link {{$loop->first ? 'active show' : ''}} @error("$lang.title") text-danger @enderror"
                                       id="custom-tabs-one-home-tab" data-bs-toggle="pill" href="#tab-{{$lang}}"
                                       role="tab"
                                       aria-controls="custom-tabs-one-home" aria-selected="true">{{$lang}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            @foreach(config('app.languages') as $index => $language)

                                <div class="tab-pane fade {{$loop->first ? 'active show' : ''}}" id="tab-{{$language}}"
                                     role="tabpanel"
                                     aria-labelledby="custom-tabs-one-home-tab">

                                    <div class="form-group my-2">
                                        <label for="summernote">Description</label>
                                        <textarea  name="{{$language}}[description]" id="summernote" class="form-control blog">{{old($language.'.description')}}</textarea>
                                        {{--                                        <div id="summernote{{$index}}_editor">{!! old($lang.'.description') !!}</div>--}}
                                        @error("$language.description")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <button class="btn btn-success my-3">Save</button>
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
