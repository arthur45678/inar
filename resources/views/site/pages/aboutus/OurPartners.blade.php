{{--Category.html template--}}
@extends('layouts.site')

@section('styles')


@endsection

@section('header')
    @include('site.includes.header')
@endsection

@section('content')
    @include('site.includes.info-box')

    <div class="general-container">
        <div class="eji-vernagir">{{ $title }}</div>
        @if(settings()->group('About_Us_Page_Image')->has('page_img'))
            <img src="{{ showImage(settings()->group('About_Us_Page_Image')->get('page_img')) }}" alt="news" />
        @endif
    </div>

    <div class="page-link">
        <span class="first sev">{{ __('aboutUs.title') }}</span>
        <span class="b-sev"><a href="#" class="sev">{{ __('aboutUs.our_partners') }}</a></span>
    </div>


    <div class="share">
        <div class="addthis_inline_share_toolbox_cs1s"></div>
    </div>

@endsection


@section('footer')
    @include('site.includes.footer')

@endsection
@section('scripts')

@endsection
