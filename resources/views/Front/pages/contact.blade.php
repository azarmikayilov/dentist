@extends('Front.Layouts.front')

@section('content')
    <div class="contact">
        <div class="subheader">
            <div class="container1">
                <div class="columnOne">
                    <h1>{{__("İletişim")}}</h1>
                    <ul>
                        <li><a href="{{route('front.index')}}">{{__("Anasayfa")}}</a></li>
                        <span><i class="fa-solid fa-angle-right"></i></span>
                        <li><a href="">{{__("İletişim")}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="section1">
            <div class="row1">
                <form action="{{ route('contact.store') }}" method="post">
                    @csrf
                    <div class="flex">
                        <input type="text" name="firstname" placeholder="{{__("Ad ve Soyad")}}">
                        @error("firstname")
                        <span class="text-danger">{{$message}}</span>
                        @enderror

                        <input type="text" name="phone" placeholder="{{__("Telefon")}}">
                        @error("phone")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <input type="email" name="email" placeholder="{{__("E-posta")}}">
                    @error("email")
                    <span class="text-danger">{{$message}}</span>
                    @enderror

                    <input type="text" name="title" placeholder="{{__("Konu")}}">
                    @error("email")
                    <span class="text-danger">{{$message}}</span>
                    @enderror

                    <textarea cols="40" rows="5" name="message" placeholder="{{__("Mesajınız")}}"></textarea>
                    @error("email")
                    <span class="text-danger">{{$message}}</span>
                    @enderror

                    <label for="is_checked">
                        <input type="checkbox" name="is_checked">
                        <a href="#" id="checkbox">{{__("KVKK")}}</a> {{__("'yı okudum, kabul ediyorum")}}
                    </label>
                    @error("email")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <button>{{__("Gönder")}}</button>
                </form>

                {{--                <div class="errMessage">--}}
                {{--                    Bir veya daha fazla alanda hata bulundu. Lütfen kontrol edin ve tekrar deneyin.--}}
                {{--                </div>--}}
            </div>
            <div class="row2">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d16491.755351405183!2d49.86224668359764!3d40.38313033265291!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1saz!2saz!4v1705053966399!5m2!1saz!2saz"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="section2">
            <div class="row1">
                <h3>{{__("İletişim Bilgileri")}}</h3>
                <p><strong>{{__("Adres")}}:</strong> {{$settings->address}}</p>
                <p><strong>{{__("Telefon")}}:</strong> <a href="">{{$settings->phone}}</a></p>
                <p><strong>{{__("Mail")}}:</strong> <a href="">{{$settings->email}}</a></p>
                {{--                <p><strong>İnstagram:</strong> <a href="">@doktornarin</a></p>--}}
            </div>
            <span>

            <div class="row2">

                <h3>{{__("Çalışma Saatleri")}}</h3>
                <p><strong>{{__("Pazartesi – Cumartesi")}}:</strong> 08.30 – 19.00<br>
                    <strong>{{__("Pazar")}}:</strong> {{__("Kapalı")}}
                </p>
            </div>
                </span>
        </div>


    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/front/css/contact.css')}}">
@endpush
