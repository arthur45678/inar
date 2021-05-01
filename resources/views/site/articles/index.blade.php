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
        <div class="norut-anun">{{ __('news.title') }}</div>
{{--
        @if(settings()->group('Articles_Page_Image')->has('page_img'))
            <img src="{{ showImage(settings()->group('Articles_Page_Image')->get('page_img')) }}" alt="news" />
        @endif--}}
    </div>
    @foreach($posts as $post)
        <div class="post">
            <p>{{ presentDate($post->created_at) }}</p>
            <h1><a href="{{ route('articles.show',$post->slug ) }}">{{ $post->name }}</a></h1>

            @if(isset($post->img) && !empty($post->img))
                <img src="{{ showImage($post->img) }}" alt="{{ $post->name }}" />
            @endif
            <p>{{ Str::limit($post->desc, 200 )}}</p>
        </div>

    @endforeach

    <nav class="paginate">{{ $posts->links() }}</nav>
@endsection


@section('footer')
    @include('site.includes.footer')

@endsection
@section('scripts')

@endsection
