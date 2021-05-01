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
            <div>{{ __('page.into17') }}
            </div>
            <img src="{{asset('asset/site/css/icons-images/mission-fon.svg')}}" alt="fon" />
        </div>
        <div class="main-justify back back-4"></div>
        <div class="info-left">
            <img src="{{asset('asset/site/css/icons-images/mission-fon.svg')}}" alt="fon" />
            <div>{{ __('page.into17') }}
            </div>
        </div>
    </div>
    <div class="main-info-enviroment talent">
        <img src="{{asset('asset/site/css/icons-images/chart-1.png')}}" alt="chart-1" class="width-max" />
    </div>
    <div class="main-info-enviroment talent">
        {{ __('page.into18') }}
    </div>
@endsection


@section('footer')
    @include('site.includes.footer')
@endsection
