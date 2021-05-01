{{--Category.html template--}}
@extends('layouts.site')

@section('title')
    {{--{{ $title }}--}}

@endsection

@section('meta_keywords',getAppNameLocale())
@section('meta_description', getAppNameLocale())

@section('styles')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endsection

@section('header')
    @include('site.includes.header')
@endsection

@section('content')
    @include('site.includes.info-box')

    <!-- <div class="buisness">

    </div> -->

    <div class="main-info">
        <div class="card-header"><b>{{ $searchResults->count() }}  {{ request('query') }}</b></div>

        <div style="text-align: center;margin:50px 0px" class="card-body">

            @if(isset($searchResults))
                @if ($searchResults-> isEmpty())
                    <h2>{{ __('search.two') }}</h2>
                @else
                    <h2>There are {{ $searchResults->count() }} results for the term <b></b></h2>
                    <hr />

                    @foreach($searchResults->groupByType() as $type => $modelSearchResults)

                    @switch($type)
                            @case('posts')
                            @foreach($modelSearchResults as $searchResult)
                                @php

                                    $title;
                                    $langCode =  \App\Models\Search::detectSearchResultLanguage($searchResult, $search_text);
                                @endphp
                                @php $title = $searchResult->searchable->getTranslation('name',$langCode) @endphp

                                @php $text = $searchResult->searchable->getTranslation('text',$langCode) @endphp
                                <ul>

                                    @if(isset($title) && !empty($title))
                                        <li>
                                            <form method="get" action="{{ route($searchResult->url) }}">
                                                <input type="hidden" name="id" value="{{ $searchResult->searchable->id }}">
                                                <input type="hidden" name="lang" value="{{ $langCode }}">
                                                <input type="hidden" name="searchedText" value="{{ $search_text }}">
                                                <button  type="submit" class="search_result">
                                                    <strong>{{ $title }}</strong>&nbsp;{{ \App\Models\Search::searchResultShortText($text) }}
                                                </button>

                                            </form>
                                        </li>

                                    @endif

                                </ul>
                            @endforeach
                            @break

                            @default
                            @foreach($modelSearchResults as $searchResult)
                                @php
                                    $title;
                                    $langCode =  \App\Models\Search::detectSearchResultLanguage($searchResult, $search_text);
                                @endphp
                                @php $title = $searchResult->searchable->getTranslation('name',$langCode) @endphp
                                @php $text = $searchResult->searchable->getTranslation('text_top',$langCode) @endphp
                                <ul>
                                    @if(isset($title) && !empty($title))
                                    <li>
                                        <form method="get" action="{{ route($searchResult->url) }}">
                                            <input type="hidden" name="id" value="{{ $searchResult->searchable->id }}">
                                            <input type="hidden" name="lang" value="{{ $langCode }}">
                                            <input type="hidden" name="searchedText" value="{{ $search_text }}">
                                            <button  type="submit" class="search_result">
                                                <strong>{{ $title }}</strong>&nbsp;{{ \App\Models\Search::searchResultShortText($text) }}
                                            </button>

                                        </form>
                                    </li>
                                    @endif
                                </ul>
                            @endforeach
                            @break
                    @endswitch


                    @endforeach
                @endif
            @endif

        </div>
    </div>



@endsection


@section('footer')
    @include('site.includes.footer')

@endsection
@section('scripts')
