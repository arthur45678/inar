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
            <div>{{ __('page.into9') }}
            </div>
            <img src="{{asset('asset/site/css/icons-images/mission-fon.svg')}}" alt="fon" />
        </div>
    </div>
    <div class="our-mission">
        <div class="mission-containers">
            <div>
                <img src="{{asset('asset/site/css/icons-images/mining.png')}}" alt="Mining" />
                <div class="values">
                    <div>{{ __('page.into10_1') }}</div>
                    <div>{{ __('page.into10_2') }}</div>
                </div>
            </div>
            <div class="mission_center">
                <img src="{{asset('asset/site/css/icons-images/tel_com.png')}}" alt="Telecommunication" />
                <div class="values">
                    <div>{{ __('page.into11_1') }}</div>
                    <div>{{ __('page.into11_2') }}</div>
                </div>
            </div>
            <div>
                <img src="{{asset('asset/site/css/icons-images/construction.png')}}" alt="Construction" />
                <div class="values">
                    <div>{{ __('page.into12_1') }}</div>
                    <div>{{ __('page.into12_2') }}</div>
                </div>
            </div>
        </div>
        <div class="mission-containers">
            <div>
                <img src="{{asset('asset/site/css/icons-images/industry.png')}}" alt="Industry" />
                <div class="values">
                    <div>{{ __('page.into13_1') }}</div>
                    <div>{{ __('page.into13_2') }}</div>
                </div>
            </div>
            <div class="mission_center">
                <img src="{{asset('asset/site/css/icons-images/agriculture.png')}}" alt="Agriculture" />
                <div class="values">
                    <div>{{ __('page.into14_1') }}</div>
                    <div>{{ __('page.into14_2') }}</div>
                </div>
            </div>
            <div>
                <img src="{{asset('asset/site/css/icons-images/service.png')}}" alt="Services" />
                <div class="values">
                    <div>{{ __('page.into15_1') }}</div>
                    <div>{{ __('page.into15_2') }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-justify back back-5"></div>

    <div class="main-info-enviroment talent mr-auto">
        <div>{{ __('page.into16') }}</div>
    </div>
@endsection


@section('footer')
    @include('site.includes.footer')
@endsection
