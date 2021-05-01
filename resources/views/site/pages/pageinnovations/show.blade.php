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
{{--    <div class="page-link">--}}
{{--        <span class="first">{{ $post->name }}</span>--}}
{{--    </div>--}}
    <div class="page-link">
        <span class="first sev">{{ $afterTitle }}</span>
        <span class="b-sev"><a href="#" class="sev">{{ $post->name }}</a></span>
    </div>

    <div class="main-info">
        @if(!empty($post->text_top) && isset($post->text_top))
        <div class="info-right">
           <div>
           {!! $post->text_top !!}
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
                    @if(!empty($post->text_middle_left) && isset($post->text_middle_left))
                        {!! $post->text_middle_left !!}
                    @endif

                </div>
                <div class="last-main">
                    @if(!empty($post->text_middle_right) && isset($post->text_middle_right))
                        {!! $post->text_middle_right !!}
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



        @if(!empty($post->text_bottom) && isset($post->text_bottom))
        <div class="info-left">
            <img src="{{ $assetPath }}/css/icons-images/mission-fon.svg" alt="fon" />
            {!! $post->text_bottom !!}
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

