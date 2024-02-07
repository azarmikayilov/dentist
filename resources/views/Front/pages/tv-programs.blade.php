@extends('Front.Layouts.front')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')
    <div class="all">
        <div class="under-nav">
            <div class="content">
                <div class="top-title">
                    {{ __("TV Programları") }}
                </div>
                <div class="bottom-title">
                    <div class="bottom-left"><a href="{{route('front.index')}}">{{ __("Anasayfa") }}</a></div>
                    <div class="icon"> ></div>
                    <div class="bottom-right"><a href="">{{ __("TV Programları") }}</a></div>
                </div>
            </div>
        </div>

        <div class="container-article">
            <div class="all-article">
                @foreach($tvPrograms as $tvProgram)
                    {{--@dd($tvPrograms)--}}
                    <div class="card" style="max-width: 18rem; padding: 0 10px">
                        {{--                            {{$tvProgram->url}}--}}


                        <iframe max-width="18rem" height="315"
                                src="{!! html_entity_decode($tvProgram->url) !!}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        <div class="video-title">
                            <b> {{$tvProgram->title}}</b>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/front/css/articles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/tvPrograms.css')}}">
@endpush
