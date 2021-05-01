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
    <div class="general-container">
        @if(!empty($post->page_img) && isset($post->page_img))
            <div class="norut-anun post-anun">{{ $post->name }}</div>
            <img src="{{ showImage($post->page_img) }}" alt="{{ $post->name }}" />
        @else
            <div class="norut-anun post-anun-no-image">{{ $post->name }}</div>
        @endif
    </div>
    @php
        $urlfull = url()->current();
        $pat = explode('/', $urlfull);
        $url = end($pat);
    @endphp
    @if($url=="network-of-representatives")
        @if(app()->getLocale()=='hy')
            <iframe width="100%" height="700px" scrolling="no" src="{{ url()->to('/') }}/map/1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        @elseif(app()->getLocale()=='en')
            <iframe width="100%" height="700px" scrolling="no" src="{{ url()->to('/') }}/map/2" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        @elseif(app()->getLocale()=='ru')
            <iframe width="100%" height="700px" scrolling="no" src="{{ url()->to('/') }}/map/3" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        @endif
    @endif


    <div class="post silka">

        @if(isset($post->img))
            <img src="{{ showImage($post->img) }}" alt="" />
        @endif

        {!! $post->text !!}

        <div>
            @if($post->chartTextTop)

                @include('site.includes.showCharts',['chart' => $post->chartTextTop])
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
