{{--Category.html template--}}
@extends('layouts.site')

@section('styles')
    <style>
        .page-link {
            position: relative!important;
            display: block!important;
            margin: 0 auto!important;
            margin-top: 40px!important;
            padding: 25px 0px!important;
            background-color: none!important;
            border: none!important;
        }
        .page-link:hover {
            background-color: #fff!important;
        }
        .sev:hover{
            text-decoration: none;
        }
    </style>
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
            <div class="page-name seri">{{ $post->name }}</div>
            @if(!empty($post->page_img_mini) && isset($post->page_img_mini))
                <img src="{{ showImage($post->page_img_mini) }}" alt="{{ $post->name }}" />

            @endif
        </div>
    </div>
    @if($parent_par==null)
        <div class="page-link">
            <span class="first sev">{{ $parent->title }}</span>
            <span class="b-sev"><a class="sev">{{ $post->name }}</a></span>
        </div>
    @else
        <div class="page-link">
            <span class="first sev">{{ $parent_par->title }}</span>
            <span class="b-sev"><a class="sev">{{ $parent->title }}</a></span>
            <span class="b-sev b-save-3"><a class="sev">{{ $post->name }}</a></span>
        </div>
    @endif
{{--    <div class="page-link-enviroment">--}}
{{--        <span class="first">{{ $post->name }}</span>--}}
{{--    </div>--}}


    <div class="main-info silka">
        @if(!empty($post->text_top) && isset($post->text_top))
            <div class="info-right">
                <div>{!! $post->text_top !!}</div>
                <img src="{{ $assetPath }}/css/icons-images/mission-fon.svg" alt="fon" />
            </div>
        @endif
            <div>

                @if($post->chartTextTop)

                    @include('site.includes.showCharts',['chart' => $post->chartTextTop])
                @endif
            </div>
        @if(!empty($post->page_img_top) && isset($post->page_img_top))
                <div style="background-image:url({{ showImage($post->page_img_top) }})" class="main-justify cover back-1"></div>
        @endif

        @if(!empty($post->text_middle) && isset($post->text_middle))
        <div class="info-left">
            <img src="{{ $assetPath }}/css/icons-images/mission-fon.svg" alt="fon" />
            <div>{!! $post->text_middle !!}</div>
        </div>
        @endif

            @if(!empty($post->page_img_middle) && isset($post->page_img_middle))
                <div style="background-image:url({{ showImage($post->page_img_middle) }})" class="main-justify cover back-1 "></div>
            @endif
                <div>
                    @if($post->chartTextMiddle)

                        @include('site.includes.showCharts',['chart' => $post->chartTextMiddle])
                    @endif
                </div>

            @if(!empty($post->text_bottom) && isset($post->text_bottom))
                <div class="info-right">
                    <div>{!! $post->text_bottom !!}</div>
                    <img src="{{ $assetPath }}/css/icons-images/mission-fon.svg" alt="fon" />
                </div>
            @endif
                <div>
                    @if($post->chartTextBottom)

                        @include('site.includes.showCharts',['chart' => $post->chartTextBottom])
                    @endif
                </div>
            @if(!empty($post->page_img_bottom) && isset($post->page_img_bottom))
                <div style="background-image:url({{ showImage($post->page_img_bottom) }})" class="main-justify cover back-1">
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
