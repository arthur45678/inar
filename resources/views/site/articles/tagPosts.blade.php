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
        <div class="norut-anun"><a href="{{ route('tagPosts',[$tag->slug]) }}">{{ $tag->name }}</a> </div>
        @if(isset($tag->page_img))
            <img src="{{ showImage($tag->page_img) }}" alt="{{ $tag->name }}" />
        @endif
    </div>
    @foreach($posts as $post)
        <div class="post">
            <p>{{ presentDate($post->created_at) }}</p>
            <h1><a href="{{ route('articles.show',$post->slug ) }}">{{ $post->name }}</a></h1>
            @if(isset($post->img))
                <img src="{{ showImage($post->img) }}" alt="" />
            @endif
            {{ Str::limit($post->desc, 200 )}}
        </div>

    @endforeach

    {{ $posts->links() }}

@endsection


@section('footer')
    @include('site.includes.footer')

@endsection
@section('scripts')

@endsection
