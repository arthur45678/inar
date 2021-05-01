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
            @if(!empty($post->page_img) && isset($post->page_img))
                <img src="{{ showImage($post->page_img) }}" alt="{{ $post->name }}" class="zoom" />

            @endif
        </div>
        <div class="right-container">
            <div class="page-name">{{ $post->getTranslation('name',$lang) }}</div>
            @if(!empty($post->page_img_mini) && isset($post->page_img_mini))
                <img src="{{ showImage($post->page_img_mini) }}" alt="{{ $post->getTranslation('name',$lang) }}" />

            @endif
        </div>
    </div>
    <div class="page-link">
        <span class="first">{{ $post->getTranslation('name',$lang) }}</span>

    </div>

    <div class="main-info">
        @if(!empty($post->hasTranslation('text_top',$lang)))
            <div class="info-right">
                <div>{!! $post->getTranslation('text_top',$lang) !!}</div>
                <img src="{{ $assetPath }}/css/icons-images/mission-fon.svg" alt="fon" />
            </div>
        @endif
        @if(!empty($post->page_img_top) && isset($post->page_img_top))
                <div style="background-image:url({{ showImage($post->page_img_top) }})" class="main-justify back"></div>
        @endif

            @if($post->hasTranslation('text_middle',$lang))
            <div class="info-left">
                <img src="{{ $assetPath }}/css/icons-images/mission-fon.svg" alt="fon" />
                @php
                    $text = highlightTerms($post->getTranslation('text_middle',$lang),$searchedText);
                @endphp
                {!! $text !!}

            </div>
            @endif
            @if(isset($post->page_img_middle))
                <div style="background-image:url({{ showImage($post->page_img_middle) }})" class="main-justify back "></div>
            @endif

            @if($post->hasTranslation('text_bottom',$lang))

                <div class="info-right">
                    @php
                        $text = highlightTerms($post->getTranslation('text_bottom',$lang),$searchedText);
                    @endphp
                    <div>{!! $text !!}</div>
                    <img src="{{ $assetPath }}/css/icons-images/mission-fon.svg" alt="fon" />
                </div>

            @endif

            @if(!empty($post->page_img_bottom) && isset($post->page_img_bottom))
                <div style="background-image:url({{ showImage($post->page_img_bottom) }})" class="main-justify back">
            @endif

         </div>
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
