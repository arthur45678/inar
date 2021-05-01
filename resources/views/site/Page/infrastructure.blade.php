{{--Category.html template--}}
@extends('layouts.site')

@section('styles')
    <link rel="stylesheet" href="{{asset('asset/site/css/second-pages.css')}}" />
@endsection
@section('scripts')
    <script src="{{asset('asset/site/js-plugins/zoom.js')}}"></script>
@endsection

@section('header')
    @include('site.includes.header')
@endsection

@section('content')
    @include('site.includes.info-box')
    @include('site.includes.page.picture')
    <div class="main-info">
        <div class="info-right">
            <div>{{ __('page.into3') }}
            </div>
            <img src="{{asset('asset/site/css/icons-images/mission-fon.svg')}}" alt="fon" />
        </div>
        <div class="main-justify back back-1">
        </div>
        <div class="info-left">
            <img src="{{asset('asset/site/css/icons-images/mission-fon.svg"')}}" alt="fon" />
            <div>{{ __('page.into4') }}
            </div>
        </div>
        <div class="main-justify back back-2"></div>
    </div>
@endsection


@section('footer')
    @include('site.includes.footer')
@endsection
