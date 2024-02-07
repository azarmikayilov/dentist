<!DOCTYPE html>
<html lang="en">

@include('Front.partials.head')
<body>
@include('Front.partials.navbar')
@yield('content')

@include('Front.partials.footer')

@include('Front.partials.bottom')
<div class="sosialMedia">
{{--    @dd($socialIcons)--}}
    <ul style="padding-left: 0;">
        @foreach($socialIcons as $socialIcon)
            <li><a href="{{$socialIcon->url}}"><img src="{{asset('storage/'. $socialIcon->image)}}" alt=""></a></li>
        @endforeach
    </ul>
</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{asset('assets/front/js/mainJs.js')}}"></script>
</body>
</html>

