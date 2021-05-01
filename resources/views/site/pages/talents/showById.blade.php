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
            @if(isset($post->page_img))
                <img src="{{ showImage($post->page_img) }}" alt="{{ $post->name }}" class="zoom" />

            @endif
        </div>
        <div class="right-container">
            <div class="page-name">{{ $post->name }}</div>
            @if(isset($post->page_img_mini))
                <img src="{{ showImage($post->page_img_mini) }}" alt="{{ $post->name }}" />

            @endif
        </div>
    </div>

    <div class="page-link-enviroment">

        <span class="first">{{ $post->getTranslation('name',$lang) }}</span>
    </div>

    <div class="main-info">
        @if($post->hasTranslation('text_top',$lang))
            <div class="info-right">

                @php
                    $text = highlightTerms($post->getTranslation('text_top',$lang),$searchedText);
                @endphp
                <div>{!! $text !!}</div>
                <img src="{{ $assetPath }}/css/icons-images/mission-fon.svg" alt="fon" />
            </div>

        @endif

        @if(isset($post->page_img_middle) && !empty($post->page_img_middle))
            <div style="background-image: url({{ showImage($post->page_img_middle) }})" class="main-justify back back-4"></div>
        @endif
            @if($post->hasTranslation('text_middle',$lang))
            <div class="info-left">
                <img src="{{ $assetPath }}/css/icons-images/mission-fon.svg" alt="fon" />

                @php
                    $text = highlightTerms($post->getTranslation('text_middle',$lang),$searchedText);
                @endphp
                <div>{!! $text !!}</div>
            </div>
        @endif
            <div>
                @if($post->chartTextTop)
                    @include('site.includes.showCharts',['chart' => $post->chartTextTop])
                @endif
            </div>
    </div>
    @if($post->hasTranslation('text_bottom',$lang))

        <div class="main-info-enviroment talent">

            @php
                $text = highlightTerms($post->getTranslation('text_bottom',$lang),$searchedText);
            @endphp
            <div>{!! $text !!}</div>
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
