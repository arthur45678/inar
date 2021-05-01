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

    <div class="main-info">
        @if(!empty($post->text_top) && isset($post->text_top))
            <div class="info-right silka">
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
            <div style="background-image:url({{ showImage($post->page_img_top) }})" class="main-justify back">
        @endif
        </div>
<!--Square menu items-->


                <div class="our-mission">
                    <div class="mission-containers">
                        @if(!empty($post->service_icon_symbol_1) && isset($post->service_icon_symbol_1))
                            <div>
                                <img src="{{ showImage($post->service_icon_symbol_1) }}" alt="{{ $post->service_name_1 }}" />
                                <div class="values">
                                    <div>{{ $post->service_name_1 }}</div>
                                    <div>{{ $post->service_price_1 }}</div>
                                </div>
                            </div>
                        @endif
                            @if(!empty($post->service_icon_symbol_2) && isset($post->service_icon_symbol_2))
                                <div class="mission_center">
                                    <img src="{{ showImage($post->service_icon_symbol_2) }}" alt="{{ $post->service_name_2 }}" />
                                    <div class="values">
                                        <div>{{ $post->service_name_2 }}</div>
                                        <div>{{ $post->service_price_2 }}</div>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($post->service_icon_symbol_3) && isset($post->service_icon_symbol_3))
                                <div>
                                    <img src="{{ showImage($post->service_icon_symbol_3) }}" alt="{{ $post->service_name_3 }}" />
                                    <div class="values">
                                        <div>{{ $post->service_name_3 }}</div>
                                        <div>{{ $post->service_price_3 }}</div>
                                    </div>
                                </div>
                            @endif
                    </div>
                    <div class="mission-containers">
                        @if(!empty($post->service_icon_symbol_4) && isset($post->service_icon_symbol_4))
                            <div>
                                <img src="{{ showImage($post->service_icon_symbol_4) }}" alt="{{ $post->service_name_4 }}" />
                                <div class="values">
                                    <div>{{ $post->service_name_4 }}</div>
                                    <div>{{ $post->service_price_4 }}</div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($post->service_icon_symbol_5) && isset($post->service_icon_symbol_5))
                            <div class="mission_center">
                                <img src="{{ showImage($post->service_icon_symbol_5) }}" alt="{{ $post->service_name_5 }}" />
                                <div class="values">
                                    <div>{{ $post->service_name_5 }}</div>
                                    <div>{{ $post->service_price_5 }}</div>
                                </div>
                            </div>
                        @endif

                            @if(!empty($post->service_icon_symbol_6) && isset($post->service_icon_symbol_6))
                                <div>
                                    <img src="{{ showImage($post->service_icon_symbol_6) }}" alt="{{ $post->service_name_6 }}" />
                                    <div class="values">
                                        <div>{{ $post->service_name_6 }}</div>
                                        <div>{{ $post->service_price_6 }}</div>
                                    </div>
                                </div>
                            @endif

                    </div>
                </div>
<!--End Square menu items-->
            @if(!empty($post->page_img_bottom) && isset($post->page_img_bottom))

                <div style="background-image:url({{ showImage($post->page_img_bottom) }})" class="main-justify back"></div>
            @endif

        <div class="info-left">
            <!-- <img src="{{ $assetPath }}/css/icons-images/mission-fon.svg" alt="fon" /> -->
            <div>{!! $post->text_middle !!}</div>
        </div>
            <!-- @if(!empty($post->page_img_middle) && isset($post->page_img_middle))
                <div style="background-image:url({{ showImage($post->page_img_middle) }})" class="main-justify back "></div>

            @endif -->



            @if(!empty($post->text_bottom) && isset($post->text_bottom))
                <div class="main-info-enviroment talent mr-auto no-center silka">
                    <div>{!! $post->text_bottom !!}</div>
                    <div>
                        @if($post->chartTextBottom)

                            @include('site.includes.showCharts',['chart' => $post->chartTextTop])
                        @endif
                    </div>
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
