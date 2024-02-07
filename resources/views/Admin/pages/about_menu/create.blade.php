@extends('Admin.layouts.admin')
@section('content')
    <h2>Add Menu</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-primary card-tabs p-2">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs p-2" id="custom-tabs-one-tab" role="tablist">
                            @foreach(config('app.languages') as $lang)
                                <li class="nav-item">
                                    <a class="nav-link {{$loop->first ? 'active show' : ''}} @error("$lang.title") text-danger @enderror"
                                       id="custom-tabs-one-home-tab-{{$lang}}" data-bs-toggle="pill" href="#tab-{{$lang}}" role="tab"
                                       aria-controls="custom-tabs-one-home" aria-selected="true">{{$lang}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            @foreach(config('app.languages') as $index => $lang)
                                <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}" id="tab-{{ $lang }}" role="tabpanel"
                                     aria-labelledby="custom-tabs-one-{{ $lang }}-tab">
                                    <div class="form-group">
                                        <label for="{{$lang}}-title">Title</label>
                                        <input type="text" name="{{$lang}}[title]" class="form-control" id="{{$lang}}-title" value="{{ old($lang.'title') }}">
                                        @error("$lang.title")
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <button class="btn btn-success mt-3">Save</button>
            </form>
        </div>
    </div>

    <!-- Include Summernote JS or any other dependencies if needed -->

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
                height: 200,
                // Add other Summernote options as needed
            });
            @endforeach
        });
    </script>
@endsection
