@extends('Front.Layouts.front')

@section('content')
    {{--    @dd($blogs)--}}


    <div class="all">
        <div class="under-nav">
            <div class="content">
                <div class="top-title">
                    {{__("Makaleler")}}
                </div>
                <div class="bottom-title">
                    <div class="bottom-left"><a href="{{route('front.index')}}">{{__("Anasayfa")}}</a></div>
                    <div class="icon"> ></div>
                    <div class="bottom-right"><a href="">{{__("Makaleler")}}</a></div>
                </div>
            </div>
        </div>
        <div class="container-article">
            <div class="all-article">
                @foreach($blogs as $blog)
                    @if($blogTranslation = $blog->translations->where('language.lang', $lang)->first())
                        <div class="card" style="width: 18rem;">
                            <img style="" src="{{asset('storage/' . $blog->image)}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h3 class="card-title">{{$blogTranslation->title}}</h3>
                                <p class="card-text"><span>{!! Str::limit(strip_tags($blogTranslation->description, 200)) !!}</span></p>
                                <a href="{{$blog->slug}}" class="btn btn-primary">{{__("Devamını Oku")}}</a>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>

@endsection
{{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"--}}
{{--      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/front/css/articles.css')}}">
@endpush
