
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
        <span class="first sev">{{ __('aboutUs.title')}}</span>
        <span class="b-sev"><a href="#" class="sev"></a></span>
    </div>
    <div class="general-container">
        @if(settings()->group('Our_Board_of_Trustees')->has('page_img'))
            <img src="{{ showImage(settings()->group('Our_Board_of_Trustees')->get('page_img')) }}" alt="news" />
        @endif
    </div>
    <div class="page-link">
        <span class="first sev">{{ __('aboutUs.Our-Board-of-Trustees')}}</span>
        <span class="b-sev"><a href="#" class="sev">{{ __('aboutUs.our_team')}}</a></span>
    </div>
    <div class="about-us-content">
        @foreach($post as $item)
            <div>
                @if(!empty($item->img) && isset($item->img))
                    <div class="about-nkar">
                        <img src="{{ showAvatar($item->img) }}" alt="">
                    </div>
                @else
                    <div class="about-nkar">
                        <img src="{{ $assetPath }}/css/icons-images/white.jpg" alt="">
                    </div>
                @endif
                <div class="about-info">
                    <p class="about-fio">{{$item->f_name}} {{$item->l_name}}</p>
                    <span class="about-line"></span>
                    <p class="ucase">{{$item->position}}</p>
                    <p class="about-txt-shrift">{{$item->short_desc}}</p>
                </div>
            </div>
        @endforeach
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
