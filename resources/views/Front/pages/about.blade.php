@extends('Front.Layouts.front')

@section('content')
    <div class="all">
        <div class="navall">
            <div class="subhover">
                <h1 class="title">{{__('Hakkımızda')}}</h1>
                <a href="{{route('front.index')}}"
                   style="font-size: 20px; color: white; margin-right:20px;text-decoration: none">{{__('Anasayfa')}}</a>
                <span style="font-size: 20px;margin-right:15px ">></span>
                <span style="font-size: 20px">{{__('Hakkımızda')}}</span>
            </div>
        </div>
        <div class="wraparrall">

            <swiper-container class="mySwiper" navigation="true" pagination="true" keyboard="true" mousewheel="true" css-mode="true">
                @foreach($doctorImages as $doctorImage)
                    <swiper-slide><img src="{{asset('storage/'.$doctorImage->image)}}" alt=""></swiper-slide>
                @endforeach
            </swiper-container>

            <div>
{{--                @dd($aboutUs->first()->translations->first()->description)--}}
                {!! $aboutUs->first()->translations->first()->description !!}
            </div>
        </div>
    </div>
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/front/css/about.css')}}">
@endpush
@push('script')
    <link rel="stylesheet" href="{{asset('assets/front/js/about.js')}}">
@endpush
