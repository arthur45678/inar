{{--Category.html template--}}
@extends('layouts.site')

@section('title')
    {{--{{ $title }}--}}

@endsection

@section('meta_keywords',getAppNameLocale())
@section('meta_description', getAppNameLocale())

@section('styles')


@endsection

@section('header')
    @include('site.includes.header')
@endsection

@section('content')
    @include('site.includes.info-box')

    <div class="buisness">
            <div class="left-container">
                    <img src="{{ showImage($post->page_img) }}" alt="{{ $post->name }}" class="zoom" />
                    <!-- <div class="left-nkar-container" style="background:url({{ showImage($post->page_img) }})"></div> -->
            </div>
            <div class="right-container">
                <div class="page-name">{{ $post->name }}</div>
                    <img src="{{ showImage($post->page_img_mini) }}" alt="{{ $post->name }}" />
                </div>
            </div>
        <div class="page-link">
            <span class="first sev"></span>
            <span class="b-sev"><a href="#" class="sev">{{ $post->name }}</a></span>
        </div>


    <div class="main-info silka">
        @if(isset($post->text_top) && !empty($post->text_top))
            <div class="info-right">
                <div>{!! $post->text_top !!}</div>
                <img src="{{ $assetPath }}/css/icons-images/mission-fon.svg" alt="fon" />
            </div>

        @endif

        @if(isset($post->page_img_middle) && !empty($post->page_img_middle))
            <div style="background-image: url({{ showImage($post->page_img_middle) }})" class="main-justify back back-4"></div>
        @endif

        @if(isset($post->text_middle) && !empty($post->text_middle))
            <div class="info-left">
                <img src="{{ $assetPath }}/css/icons-images/mission-fon.svg" alt="fon" />
                <div>{!! $post->text_middle !!}</div>
            </div>
        @endif
        <div>
            @if($post->chartTextTop)
                @include('site.includes.showCharts',['chart' => $post->chartTextTop])
            @endif
        </div>
    </div>

    @if(isset($post->text_bottom) && !empty($post->text_bottom))
        <div class="main-info-enviroment talent">
            {!! $post->text_bottom !!}
        </div>
    @endif

    <div class="share">
        <div class="addthis_inline_share_toolbox_cs1s"></div>
    </div>

@endsection


@section('footer')
    @include('site.includes.footer')

@endsection
@section('scripts')

@endsection
