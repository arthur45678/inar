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
        <div class="norut-anun post-anun">{{ __('news.title') }}</div>
        <img src="{{ $assetPath }}/css/icons-images/News-and-events-cover.jpg" alt="news" />
    </div>--}}
    <div class="page-link">
        <span class="first">{{__('news.news_and_events')}}</span>
        <span><a href="#">{{__('news.title')}}</a></span>
    </div>
    <div class="news-container">
        <div class="left-news">
            @if(isset($last))

                <div>
                    <p class="left-news-title">{{ $last->name }}</p>
                </div>

                <a href="{{ route('articles.show',$last->slug ) }}">
                    @if($last->img)

                        <img src="{{ showImage($last->img) }}" alt="router" /></a>
                    @endif

                <div class="left-news-txt">
                    {{ $last->desc }}
                </div>
                <div class="right">
                    <a href="{{ route('articles.show',$last->slug ) }}" class="read-more">
                        {{__('home.read_more')}}
                    </a>
                </div>
            @endif

        </div>
        <div class="right-news">
            <div class="pop">
                <span>{{__('news.latest_news')}}</span>
            </div>

            @if(isset($lastPost) && $lastPost->count() > 0 )
                {{--Show latest 2 posts--}}
            @for($i = 0; $i < count($lastPost); $i++)


                    <div class="right-news-img">
                        <div>{{ showDateWithMonthName($lastPost[$i]->created_at) }}</div>

                        @if(showImage($lastPost[$i]->img_mini))
                         <a href="{{ route('articles.show',$lastPost[$i]->slug ) }}">
                            <img src="{{ showImage($lastPost[$i]->img_mini) }}" alt="{{ $lastPost[$i]->name }}" />
                        </a>

                        @endif

                        <p class="right-news-title"><a href="{{ route('articles.show',$lastPost[$i]->slug ) }}">{{ $lastPost[$i]->name }}</a> </p>
                        <p class="right-news-txt">{{ Str::limit($lastPost[$i]->desc,200) }}</p>
                    </div>
            @endfor


            @endif


        </div>
    </div>



    <div class="news-container">
        <div class="right">
            <h3><a href="{{ route('articles.index') }}">{{ Lang::get('news.all_news') }}</a></h3>
        </div>

    </div>


@endsection


@section('footer')
    @include('site.includes.footer')

@endsection
@section('scripts')

@endsection
