@extends('site.layouts.default')
@section('title', $page['title'][$lang])
@section('content')
    <section>
        <div class="owl-carousel owl theme" id="main__carousel">
            @foreach($page['data']['slider'] as $slider)
                <div>
                    <div class="main__search__block" style="background-image: url('{{$slider['url']}}')"></div>
                </div>
            @endforeach
        </div>
        <div class="container">
            <div class="search__block">
                <div class="search__block__title">
                    <h1>{{$page['data']['header']['title'][$lang]}}</h1>
                    @if(isset($page['data']['header']['desc'][$lang]))
                        <p>{{$page['data']['header']['desc'][$lang]}}</p>
                    @endif
                </div>
                <div class="search__block__form">
                    @include('site.page.elements.search')
                </div>
                <div class="search__block__text">
                    <p>@lang('content.enter_your_query_in_the_correct_search')</p>
                </div>
            </div>
        </div>
    </section>
    <section class="main__categories__block">
        <div class="container">
            <div class="row">
                @if(isset($page['data']))
                    @if($page['data']['links'] && count($page['data']['links']) > 0)

                        @foreach($page['data']['links'] as $link)
                            <div class="col-sm-{{12/count($page['data']['links'])}} col-xs-12 categories__block">
                                <div class="categories__block__icon"><i class="{{$link['icon'][$lang]}}"></i></div>
                                <div class="categories__block__text">
                                    <h3>{{$link['title'][$lang]}}</h3>
                                    <p>{{$link['desc'][$lang]}}</p>
                                    <a href="{{$link['url'][$lang]}}" type="button">@lang('content.continue')</a>
                                </div>
                            </div>
                        @endforeach

                    @endif
                @endif
            </div>
        </div>
    </section>
    @if(isset($faqs) && $faqs['total'] > 0)
        <section class="faq__block">
            <div class="container">
                <h3>{{$page['data']['faq']['title'][$lang]}}</h3>
                @if(isset($page['data']['faq']['desc'][$lang]))
                    <div class="text-center"><p>{{$page['data']['faq']['desc'][$lang]}}</p></div>
                @endif
                <div class="row">
                    <div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2">
                        @foreach($faqs['data'] as $i=>$faq)
                            @if($i % 2 === 0)
                                <div class="home__faq__block">
                                    <p>
                                        <a class=" btn-primary faq__btn faq__closed" data-toggle="collapse" href="#faq{{$i}}" role="button">
                                            <button type="button" class="faq__icon">
                                                <i class="fas fa-plus"></i>
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            {{$faq['question'][$lang]}}
                                        </a>
                                    </p>
                                    <div class="collapse multi-collapse" id="faq{{$i}}">
                                        <div class="card card-body faq__toggle__body">{!! $faq['answer'][$lang] !!}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2">
                        @foreach($faqs['data'] as $i=>$faq)
                            @if($i % 2 !== 0)
                                <div class="home__faq__block">
                                    <p>
                                        <a class="tn-primary faq__btn faq__closed" data-toggle="collapse" href="#faq{{$i}}" role="button">
                                            <button type="button" class="faq__icon">
                                                <i class="fas fa-plus"></i>
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            {{$faq['question'][$lang]}}
                                        </a>
                                    </p>
                                    <div class="collapse multi-collapse" id="faq{{$i}}">
                                        <div class="card card-body faq__toggle__body">{!! $faq['answer'][$lang] !!}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if(isset($news) && $news['total'] > 0)
        <section class="latest__news__block">
            <div class="latest__news__text">
                <h3>{{$page['data']['news']['title'][$lang]}}</h3>
                <p>{{$page['data']['news']['desc'][$lang]}}</p>
            </div>
            <div class="container">
                <div class="row latest__news__row">
                    @if(isset($news['data']) && count($news['data']) > 0 )
                        @foreach($news['data'] as $new)
                            <div class="col-lg-3 col-md-4 col-sm-6 latest__news__single">
                                <a href="{{url('news/'.$new['id'])}}">
                                    <div class="latest__news__image"
                                         style="background-image: url('{{$new['image']}}')"></div>
                                </a>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12 latest__news__info">
                                        <div class="news__piblic__date"><a><i
                                                    class="far fa-clock"></i>&nbsp;{{getNewsDate($new['date'])}} </a>
                                        </div>
                                        <div class="news__category"><a
                                                href="{{url('news?category_id='.$new['category']['id'])}}">{{$new['category']['title'][$lang]}}</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12 latest__news__title">
                                        <h3><a href="{{url('news/'.$new['id'])}}">{{$new['title'][$lang]}}</a></h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @endif                </div>
            </div>
        </section>
    @endif
@endsection
