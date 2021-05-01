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
                <img src="{{ showImage($post->page_img_mini) }}" alt="{{ $post->name }}" />

            @endif
        </div>
    </div>


{{--    <div class="page-link-enviroment biznes">--}}
{{--        <span class="first">{{ $post->getTranslation('name',$lang) }}</span>--}}
{{--    </div>--}}
    <div class="page-link">
        <span class="first sev">{{ __('armenia.title') }}</span>
        <span class="b-sev"><a href="#" class="sev">{{ $post->name }}</a></span>
    </div>

    <div class="main-info-enviroment">


        @if($post->hasTranslation('text_top',$lang))
            @php
                $text = highlightTerms($post->getTranslation('text_top',$lang),$searchedText);


            @endphp


            <div>{!! $text !!}</div>
        @endif
        <div>

            @if($post->chartTextTop)

                @include('site.includes.showCharts',['chart' => $post->chartTextTop])
            @endif
        </div>



            @if($post->hasTranslation('text_bottom',$lang) )
                @php
                    $text = highlightTerms($post->getTranslation('text_bottom',$lang),$searchedText);
                @endphp
                <div>{!! $text !!}</div>

            @endif

            {{--<div>--}}
                {{--@if($post->chartTextBottom)--}}

                    {{--@include('site.includes.showCharts',['chart' => $post->chartTextBottom])--}}
                {{--@endif--}}
            {{--</div>--}}
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
