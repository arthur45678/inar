{{--Category.html template--}}
@extends('layouts.site')

@section('styles')
@endsection

@section('header')
    @include('site.includes.header')
@endsection

@section('content')
    @include('site.includes.info-box')

    <div class="general-container">
        <div class="norut-anun">{{ __('galleries.images.title') }}</div>
        @if(settings()->group('Galeries_Page_Image')->get('page_img'))
            <img src="{{ showImage(settings()->group('Galeries_Page_Image')->get('page_img')) }}" alt="news" />
        @endif
    </div>

    <div class="about-us-content">
        @foreach($posts as $post)
            <div>
                <div class="about-nkar">
                    <a href="{{ route('galleries.show',$post->slug) }}">
                        @if(isset($post->images()->first()->name))
                            <img src="{{ showImage($post->images()->first()->name) }}" alt="">
                        @endif
                    </a>
                </div>
                <div class="about-info">
                    <p class="about-fio"><a href="{{ route('galleries.show',$post->slug) }}">{{ $post->name }}</a></p>
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
