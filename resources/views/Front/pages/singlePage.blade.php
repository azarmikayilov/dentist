@extends('Front.Layouts.front')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <div class="single-page">
        <div class="top">
            <p>{{__("Makaleler")}}</p>
{{--            @dd($image )--}}
            <h1>{{$blog->title}}</h1>
            {{--            @dd($image)--}}
            {{--            @dd($blog)--}}
            <img src="{{asset('storage/'.$image->image)}}" alt="...">
        </div>
        <div class="container">
{{--            <h2>{{$blog->title}}</h2>--}}
            <p>{!! $blog->description !!}</p>
        </div>


        <div class="others-section">
            <h1>{{__("Diğer Makelelerimiz")}}</h1>

            <div class="cols">
                @foreach($randomBlogs as $randomBlog)
                    {{--                    @dd($randomBlog)--}}

                    {{--                    diline gore duzelt--}}
                    {{--                    sekilerin enini duzelt--}}
                    <a href="{{$randomBlog->blog->slug}}">
                        <div class="col-1">
                            {{--                            @foreach($randomBlog->blog as $image)--}}
                            <img src="{{asset('storage/'.$randomBlog->blog->image)}}" alt="">
                            {{--                            @endforeach--}}
                            <p class="article-title">{{ $randomBlog->title }}</p>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/front/css/singlepage.css')}}">
@endpush
