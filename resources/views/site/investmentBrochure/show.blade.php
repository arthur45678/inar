{{--Category.html template--}}
@extends('layouts.site')

@section('styles')


@endsection

@section('header')
    @include('site.includes.header')
@endsection

@section('content')
    @include('site.includes.info-box')


    @if($post->categories()->first())
        <div class="top-container">
            <div class="news-anun"><a href="{{ route('categoryPosts',[$post->categories()->first()->slug]) }}">{{ $post->categories()->first()->name }}</a></div>
            @if(isset($post->categories()->first()->page_img))
                <img src="{{ showImage($post->categories()->first()->page_img) }}" alt="{{ $post->categories()->first()->name }}" />
            @endif
        </div>
    @endif

    <div class="post">
        <h1>{{ $post->name }}</h1>
        @if(isset($post->img))
            <img src="{{ showImage($post->img) }}" alt="" />
        @endif

       {!! $post->text !!}

        <div>
            @if($post->chartTextTop)

                @include('site.includes.showCharts',['chart' => $post->chartTextTop])
            @endif
        </div>

        @if($post->tags()->count() > 0)
            <p>Tags</p>
            @foreach($post->tags()->get() as $tag)
                <a href="{{ route('tagPosts',[$tag->slug]) }}">#{{ $tag->name }}</a>
            @endforeach
        @else

        @endif


    </div>

@endsection


@section('footer')
    @include('site.includes.footer')

@endsection
@section('scripts')

@endsection
