@php
    $currentLocale = session()->get('locale');
    if ($currentLocale === null) {
        $currentLocale = 'tr';
    }
@endphp

<div class="header">
    <ul class="container1" style="padding-left: 0">
        <div class="image">
            <a href="{{route('front.index')}}"><img src="{{asset('storage/'. $settings->top_logo)}}" alt="logo"></a>
        </div>
        <div>


            <ul class="navbar">
                @foreach($categories as $category)
                    <li>
                        <a href="#">
                            @if($category->translations->isNotEmpty() && $categoryTranslation = $category->translations->first())
                                <a href="#"><span>{{ $category->translations->first()->name }}</span></a>
                            @endif
                        </a>
                        <ul>
                            @foreach($category->blogs as $blog)
                                <li>
                                    @if($blog->translations->isNotEmpty() && $translation = $blog->translations->first())
                                        <a href="{{ route('front.singleBlog', ['blog' => $blog->slug]) }}">{{ $translation->title }}</a>
                                    @else
                                        <a href="{{ route('front.singleBlog', ['blog' => $blog->slug]) }}">{{ $blog->slug }}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
                <li>
                    <a href="{{ route('front.about') }}"><span>{{ __("Hakkımızda") }}</span></a>
                    <ul>
                        @foreach($abouts as $about)
                            {{--                                @dd($about)--}}
                            @foreach($about->translations as $last)

                                <li>
                                    <a href="{{ $about->slug }}">{{ $last->title }}</a>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{ route('front.contact') }}"><span>{{ __("İletişim") }}</span></a>
                </li>

                @foreach($languageIcon as $language)
                    <a href="{{ route('locale.set', $language->lang) }}"
                       class="lang {{ $currentLocale === $language->lang ? 'd-none' : '' }}">
                        <img src="{{ asset('storage/'. $language->image) }}" alt="{{ $language->lang }}"
                             id="{{ $language->lang }}">
                    </a>
                @endforeach
            </ul>
            <a href="#" class="toggle-btn"><i class="fa-solid fa-bars"  style="font-size: 16px"></i></a>
            <a href="#" id="search-icon"><i class="fa-solid fa-magnifying-glass" style="font-size: 16px"></i></a>
            <div id="search-box">
                <form action="{{route('front.search')}}" method="GET">
                    <input type="text" name="query" placeholder="Ara...">
                    <button id="close-search" type="button">&times;</button>
                </form>
            </div>


            <div class="mobile-men active"
                 style="background-image: url({{asset('assets/front/images/breadcrumb-background.webp')}})">

                <div class="mobile-menu-close" onclick="toggleMobileMenu()">
                    <i class="fas fa-times"></i>
                </div>
                <div class="language">
                    @foreach($languageIcon as $language)
                        <a href="{{ route('locale.set', $language->lang) }}"
                           class="lang {{ $currentLocale === $language->lang ? 'd-none' : '' }}">
                            <img src="{{ asset('storage/'. $language->image) }}" alt="{{ $language->lang }}"
                                 id="{{ $language->lang }}">
                        </a>
                    @endforeach
                </div>
                <div class="men-dro">
                    <ul>
                        @foreach($categories as $category)
                            <li>
                                <a href="#">
                                    @if($category->translations->isNotEmpty() && $categoryTranslation = $category->translations->first())
                                        <span>{{ $category->translations->first()->name }}</span>
                                    @endif
                                </a>
                                <i class="fa-solid fa-plus"></i>
                                <i class="fa-solid fa-minus" style="display: none;"></i>
                                <ul class="drop-menu" style="display: none;"> <!-- Set initial display to none -->
                                    @foreach($category->blogs as $blog)
                                        <li style="list-style: none">
                                            @if($blog->translations->isNotEmpty() && $translation = $blog->translations->first())
                                                <a href="{{ route('front.singleBlog', ['blog' => $blog->slug]) }}">{{ $translation->title }}</a>
                                            @else
                                                <a href="{{ route('front.singleBlog', ['blog' => $blog->slug]) }}">{{ $blog->slug }}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ route('front.about') }}">{{ __("Hakkımızda") }}</a>
                            <i class="fa-solid fa-plus"></i>
                            <i class="fa-solid fa-minus" style="display: none;"></i>
                            <ul class="drop-menu" style="display: none;">
                                @foreach($abouts as $about)
                                    @foreach($about->translations as $last)
                                        <li><a href="{{ $about->slug }}">{{ $last->title }}</a></li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('front.contact') }}">{{ __("İletişim") }}</a>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
    </ul>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>


    $(document).ready(function () {
        $(".fa-plus").click(function () {
            var $subMenu = $(this).siblings('.drop-menu');
            $subMenu.slideToggle('fast');
            $(this).toggle();
            $(this).siblings('.fa-minus').toggle();
        });

        $(".fa-minus").click(function () {
            var $subMenu = $(this).siblings('.drop-menu');
            $subMenu.slideToggle('fast');
            $(this).toggle();
            $(this).siblings('.fa-plus').toggle();
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#search-icon").click(function (e) {
            e.preventDefault();
            $("#search-box").slideDown();
        });

        $("#close-search").click(function (e) {
            e.preventDefault();
            $("#search-box").slideUp();
        });
    });


    function toggleMobileMenu() {
        $(".mobile-men").toggleClass("active");
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toggleBtn = document.querySelector('.toggle-btn');
        var navbar = document.querySelector('.mobile-men');

        toggleBtn.addEventListener('click', function () {
            navbar.style.display='block';
            navbar.classList.toggle('active');
            console.log('click')
        });
    });
</script>
