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
            <div>{{ __('page.into5') }}
            </div>
            <img src="{{asset('asset/site/css/icons-images/mission-fon.svg')}}" alt="fon" />
        </div>
        <div class="main-justify-elem">
            <div>
                <div class="first-main">
                    <ul>
                        <li>{{ __('page.into6_1') }}</li>
                        <li>{{ __('page.into6_2') }}</li>
                        <li>{{ __('page.into6_3') }}</li>
                    </ul>
                </div>
                <div class="last-main">
                    <ul>
                        <li>{{ __('page.into6_4') }}</li>
                        <li>{{ __('page.into6_5') }}</li>
                        <li>{{ __('page.into6_6') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="info-left">
            <img src="{{asset('asset/site/css/icons-images/mission-fon.svg')}}" alt="fon" />
            <div>{{ __('page.into5') }}
            </div>
        </div>
    </div>

@endsection


@section('footer')
    @include('site.includes.footer')
@endsection
