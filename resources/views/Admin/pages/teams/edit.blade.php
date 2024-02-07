@extends('admin.layouts.admin')

@section('content')
    <h2>Edit Team Member</h2>
    <div class="card my-4">
        <div class="card-body">
            <form action="{{route('admin.teams.update')}}" method="POST" enctype="multipart/form-data">
                {{--                {{ isset($model) ? route($routeName.'.update', $model->id) : route($routeName.'.store') }}--}}
                @csrf
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            @foreach(config('app.languages') as $lang)
                                <li class="nav-item">
                                    <a class="nav-link {{$loop->first ? 'active show' : ''}} @error("$lang.title") text-danger @enderror"
                                       id="custom-tabs-one-home-tab" data-bs-toggle="pill" href="#tab-{{$lang}}" role="tab"
                                       aria-controls="custom-tabs-one-home" aria-selected="true">{{$lang}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            @foreach(config('app.languages') as $lang)
                                <div class="tab-pane fade {{$loop->first ? 'active show' : ''}}" id="tab-{{$lang}}"
                                     role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    <div class="form-group">
                                        <label for="{{$lang}}-title">Position</label>

                                        @php
                                            // Dil için ilgili çeviriyi bul
                                            $positionTranslation = $team->translations
                                                ->where('language.lang', $lang)->first();
                                        @endphp

                                        <input type="text" placeholder="Başlıq" name="{{$lang}}[title]"
                                               value="{{ $positionTranslation ? $positionTranslation->position : '' }}"
                                               class="form-control" id="{{$lang}}-title">

                                        @error("$lang.title")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="form-group py-2">
                    <label>Ad, Soyad</label>
                    <input name="firstName" class="form-control" type="text" value="{{$team->title}}"/>
                    <input name="team_id" class="form-control" type="hidden" value="{{$team->id}}"/>
                    @error('blogs_type_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group py-3">
                    <label>Image</label>
                    @isset($model)
                        <br>
                        <img width="200" src="{{ asset('storage/'.$model->image) }}">
                    @endisset
                    <input type="file" name="image" class="form-control">
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
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
            // Initialize Bootstrap Tabs
            var tabs = new bootstrap.Tab(document.querySelector('#custom-tabs-one-home-tab'));
            tabs.show();

            // Initialize Summernote Editor
            @foreach(config('app.languages') as $index => $lang)
            new Summernote($('#summernote{{$index}}'), {
                placeholder: 'desc{{$lang}}',
                height: 500,
                // Add other Summernote options as needed
            });
            @endforeach
        });
    </script>
@endsection
