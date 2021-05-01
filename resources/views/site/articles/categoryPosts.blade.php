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
        @if(isset($category->page_img))
        <div class="norut-anun post-anun"><a href="{{ route('categoryPosts', [$category->slug]) }}">{{ $category->name }}</a></div>
        <img src="{{ showImage($category->page_img) }}" alt="{{ $category->name }}" />
        @else
            <div class="norut-anun post-anun-no-image">
                <a href="{{ route('categoryPosts', [$category->slug]) }}">{{ $category->name }}</a>
            </div>
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
