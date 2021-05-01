{{--Category.html template--}}
@extends('layouts.site')

@section('styles')


@endsection

@section('header')
    @include('site.includes.header')
@endsection

@section('content')
    @include('site.includes.info-box')


   {{-- <div class="general-container">
        @if(settings()->group('investmentBrochure_Page_Image')->has('page_img'))
            <div class="eji-vernagir">{{ __('aboutUs.title') }}</div>
            <img src="{{ showForAdminPageImage(settings()->group('broshyur_Page_Image')->get('page_img')) }}" alt="">
        @endif
        <img src="{{ $assetPath }}/css/icons-images/News-and-events-cover.jpg" alt="news" />
    </div>--}}

    <div class="page-link">
        <span class="first sev">{{ Lang::get('brochures.info') }}</span>
        <span class="b-sev"><a href="#" class="sev">{{ __('lang.brochure.title') }}</a></span>
    </div>

    <div class="brochure-container">
        @foreach($posts as $post)
        <div class="item">
            <div class="discover">
                <div class="discover_img">
                    @if(isset($post->img))
                        <img src="{{ showImage($post->img) }}" alt="" />
                    @endif
                </div>
                <div class="discover_info">
                    <div>
                        <h2>{{ $post->name }}</h2>
                        <p>{{ Str::limit($post->desc,300) }}</p>
                        <div class="btns">
                            <a target="_blank" href="{{ route('site.showPdf',['pdfFileName' => $post->file]) }}" class="button">{{ __('brochures.View_Brochure') }}</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


    </div>

    <nav class="paginate">{{ $posts->links() }}</nav>

@endsection


@section('footer')
    @include('site.includes.footer')

@endsection
@section('scripts')

@endsection
