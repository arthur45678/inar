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
    <div class="main-info-enviroment">
        {{ __('page.into1') }}
        <div>
            <img src="{{asset('asset/site/css/icons-images/diagram-1.png')}}" alt="diagram" />
        </div>
        {{ __('page.into2') }}
    </div>



@endsection


@section('footer')
    @include('site.includes.footer')
@endsection
