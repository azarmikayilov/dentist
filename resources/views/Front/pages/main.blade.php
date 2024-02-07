@extends('Front.Layouts.front')

@section('content')
    <style>
        .Myswiper-container {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;

            max-width: 1920px;
            max-height: 500px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .swiper-slide img {
                width: 100%;
                max-height: 316px;
            }

            .swiper-button-next {
                margin-top: 40px;
            }

            .swiper-button-prev {
                margin-top: 40px;

            }


        }

        .swiper-pagination-bullet-active {
            background-color: purple !important;
        }


        .swiper-button-next {
            margin-right: 50px;
            /*margin: auto 0;*/
        }

        .swiper-button-prev {
            margin-left: 50px;
            /*margin: auto 0;*/

        }
    </style>

    <div class="swiper-container my1Swiper">
        <div class="swiper-wrapper">
            @foreach($blogForSlider as $blogForSlide)
                @if($blogForSlide->image)
                    <div class="swiper-slide"><img src="{{asset('storage/'.$blogForSlide->image)}}" alt=""></div>
                @endif
            @endforeach
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>


    <div class="section1">
        <h1>{{__("Estetik Diş Hekimliği")}}</h1>
        <div class="row">
            @foreach ($quotesTranslations as $quotesTranslation)
                @if ($quotesTranslation->quote)
                    <div class="col">
                        <img style="max-width: 100px; max-height: 100px"
                             src="{{ asset('storage/'.$quotesTranslation->quote->image) }}" alt="">
                        <p class="title">{{ $quotesTranslation->title }}</p>
                        <p>{{ $quotesTranslation->description }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="containerSponsor">
        <div class="swiper mySwiper my">
            <div class="swiper-wrapper">
                @foreach($sponsors as $sponsor)
                    <div class="swiper-slide">
                        <div class="ust-padding" style="">
                            {{--                            width: 323px; height: 152px; object-fit: contain--}}
                            <div class="for-padding">
                                <img style="height: 70px;" src="{{asset('storage/' . $sponsor->image)}}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>



            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <div class="youtube">
        <iframe width="918" height="450" src="{{$youtube->url}}"
                title="Dentnis İmplantoloji ve Estetik Diş Kliniği" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
    </div>

    <div class="ekibimiz-container">
        <h1>{{__("Ekibimiz")}}</h1>
        <div class="swiper-2 mySwiper my2">
            <div class="swiper-wrapper salam ">
                @foreach($teams as $team)
                    <div class="swiper-slide mz">
                        <div class="top-section">
                            <img style="object-fit: cover; max-width: 300px; max-height: 300px"
                                 src="{{asset('storage/' . $team->image)}}">
                        </div>
                        <div class="bottom-section">
                            <h3 class="doctor-name">{{$team->title}}</h3>
                            <div class="ekibimiz-line"></div>
                            {{--                                @dd($team)--}}
                            @foreach($team->translations as $item)
                                <h5 class="doctor-position">{{$item->position}}</h5>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <div class="section2">
        <h2>{{__("Estetik Diş Hekimliği")}}</h2>
        <div class="container1">
            @foreach($blogs as $blog)
                <div class="image-container">
                    <a href="{{$blog->slug}}">
                        <img src="{{asset('storage/'. $blog->image)}}" alt="Image"
                             style="width: 100%; height: 100%; object-fit: cover">
                        <div class="image-overlay"></div>
                        @if($blogTranslation = $blog->translations->where('language.lang', $locale)->first())
                            <div class="image-title">{{$blogTranslation->title}}</div>
                        @endif
                        <div class="underline"></div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="articles">
        <h2>{{__("Makaleler")}}</h2>
        <div class="container1">
            @foreach($blogs->take(3) as $blog)
                <div class="col">
                    <div class="image">
                        <img style="object-fit: cover" src="{{asset('storage/'. $blog->image)}}" alt="">
                    </div>
                    <div class="content">
                        @foreach($blogTranslation = $blog->translations->where('language.lang', $locale) as $blogTitleDesc)
                            <h2>{{$blogTitleDesc->title}}</h2>
                            <p>{!! Str::limit(strip_tags($blogTitleDesc->description), 100) !!}</p>
                        @endforeach
                        <a href="{{$blog->slug}}">{{__("Devamını oku")}}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".my1Swiper", {
            effect: "fade", // Set the fade effect
            loop: true,
            fadeEffect: {
                crossFade: true
            },
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 3000, // Set the autoplay delay to 3 seconds
                disableOnInteraction: false,
            },
            speed: 1000, // Set the speed of the fade transition (in milliseconds)
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
@endsection
