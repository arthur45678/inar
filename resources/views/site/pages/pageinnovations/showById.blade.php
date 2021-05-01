{{--Category.html template--}}
@extends('layouts.site')

@section('styles')

@endsection

@section('header')
    @include('site.includes.header')
@endsection

@section('content')
    @include('site.includes.info-box')

    @if($post->name)
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
    @endif
    <div class="main-info">
        @if($post->hasTranslation('text_top',$lang))

            <div class="info-right">
                <div>
                    @php
                        $text = highlightTerms($post->getTranslation('text_top',$lang),$searchedText);
                    @endphp
                    <div>{!! $text !!}</div>
                </div>
                <img src="{{ $assetPath }}/css/icons-images/mission-fon.svg" alt="fon" />
            </div>
        @endif
        <div class="silka">
            @if(isset($post->img))
                <img src="{{ showImage($post->img) }}" alt="" />

            @endif
            <div>
                @if($post->chartTextTop)

                    @include('site.includes.showCharts',['chart' => $post->chartTextTop])
                @endif
            </div>

            <div class="main-justify-elem pad">
                <div>
                    <div class="first-main">
                        @if($post->hasTranslation('text_middle_left',$lang))
                            @php
                                $text = highlightTerms($post->getTranslation('text_middle_left',$lang),$searchedText);
                            @endphp
                            <div>{!! $text !!}</div>
                        @endif

                    </div>
                    <div class="last-main">
                        @if($post->hasTranslation('text_middle_right',$lang))
                            @php
                                $text = highlightTerms($post->getTranslation('text_middle_right',$lang),$searchedText);
                            @endphp
                            <div>{!! $text !!}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                @if($post->chartTextMiddleLeft)
                    @include('site.includes.showCharts',['chart' => $post->chartTextMiddleLeft])
                @endif
            </div>
            <div>
                @if($post->chartTextMiddleRight)
                    @include('site.includes.showCharts',['chart' => $post->chartTextMiddleRight])
                @endif
            </div>

            @if($post->hasTranslation('text_bottom',$lang))
                <div class="info-left">
                    <img src="{{ $assetPath }}/css/icons-images/mission-fon.svg" alt="fon" />
                    @php
                        $text = highlightTerms($post->getTranslation('text_bottom',$lang),$searchedText);
                    @endphp
                    <div>{!! $text !!}</div>
                </div>
            @endif

            <div>
                @if($post->chartTextBottom)
                    @include('site.includes.showCharts',['chart' => $post->chartTextBottom])
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

