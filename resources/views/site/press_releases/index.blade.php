{{-- press-releases.html --}}
@extends('layouts.site')

@section('styles')
<style>
    [src$='no_image.jpg'] {
        width: 500px;
    }
</style>
@endsection

@section('header')
    @include('site.includes.header')
@endsection

@section('content')
    @include('site.includes.info-box')

   {{-- <div class="general-container">
        <div class="norut-anun post-anun">{{__('news.press_releases.title')}}</div>
        @if(settings()->group('Pres-Release_Page_Image')->has('page_img') && settings()->group('Pres-Release_Page_Image')->get('page_img'))
            <img src="{{ showImage(settings()->group('Pres-Release_Page_Image')->get('page_img')) }}" alt="news" />
        @endif
    </div>--}}
    <div class="page-link">
        <span class="first sev">{{__('news.news_and_events')}}</span>
        <span class="b-sev"><a href="#" class="sev">{{__('news.press_releases.title')}}</a></span>
    </div>

    <div class="press-container">
        @forelse ($mosPopularPosts as $item)
            <div class="press-item">
                {{-- @if(showImage($item->img_mini)) --}}
                @if(isset($item->img_mini) && !empty($item->img_mini))
                    <div class="press-image">
                        <a href="{{ route('articles.show',$item->slug ) }}">
                            <img src="{{ showImage($item->img_mini) }}" alt="{{ $item->name }}">
                        </a>
                    </div>
                @endif
                <div class="press-content" style="padding: 3vw 20px;">
                    <a href="{{ route('articles.show',$item->slug ) }}" style="font-size: 2vw">{{$item->name}}</a>
                    <p>
                        {{ Str::limit($item->desc,200) }}
                    </p>
                </div>
            </div>
        @empty
        @endforelse
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
