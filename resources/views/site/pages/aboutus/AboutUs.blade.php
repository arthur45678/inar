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
        <div class="eji-vernagir">{{ $title }}</div>
        @if(settings()->group('About_Us_Page_Image')->has('page_img'))
            <img src="{{ showImage(settings()->group('About_Us_Page_Image')->get('page_img')) }}" alt="news" />
        @endif
    </div>

    <div class="page-link">
        <span class="first sev">{{ __('aboutUs.about_us')}}</span>
        <span class="b-sev"><a href="#" class="sev">{{ __('aboutUs.our_team')}}</a></span>
    </div>

    @foreach($departments as $department)

        <div class="about-us-our-team">
            <h3 class="about-title">{{ $department->name }}</h3>

            @foreach($department->teams as $item)

                <div>
                    @if(!empty($item->img) && isset($item->img))
                        <div class="about-nkar">
                            <img src="{{ showAvatar($item->img) }}" alt="">
                        </div>
                    @else
                    <div class="about-nkar">
                            <img src="{{ $assetPath }}/css/icons-images/white.jpg" alt="">
                        </div>
                    @endif

                    <div class="about-info">
                        <p class="about-fio">{{ $item->f_name }}&nbsp;{{ $item->l_name }}</p>
                        <p class="about-txt-shrift">{{ $item->position }}</p>
                        <span class="about-line"></span>
                        <div class="about-icon-info">
                            <div class="about-center">
                            </div>
                            <table>
                                @if(!empty($item->email) && isset($item->email))
                                    <tr><td><img src="{{ $assetPath }}/css/icons-images/mail-icon.png"  style="width:35px" /></td><td style="font-size:12px">{{ $item->email }}</td></tr>
                                @endif
                                @if(!empty($item->phone) && isset($item->phone))
                                        <tr><td><img src="{{ $assetPath }}/css/icons-images/phone-icon.png"  style="width:35px" /></td><td style="font-size:12px">+{{ $item->phone }}</td></tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
    <div class="share">
        <div class="addthis_inline_share_toolbox_cs1s"></div>
    </div>



@endsection


@section('footer')
    @include('site.includes.footer')

@endsection
@section('scripts')

@endsection
