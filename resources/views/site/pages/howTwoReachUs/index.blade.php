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
        <div class="norut-anun post-anun-no-image">{{ Lang::get('howTwoReachUs.title') }}</div>

    </div>

    <div class="post silka">
        <div class="post silka">
            {!! settings()->group(App::getLocale())->get('address') !!}
        </div>
    </div>
    <br><br>

    <div class="post silka">
        <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Investment%20Promotion%20and%20Foreign%20Relations%20Department&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://yt2.org/de/youtube-to-mp3-ALeKk00qEW0sxByTDSpzaRvl8WxdMAeMytQ1611842368056QMMlSYKLwAsWUsAfLipqwCA2ahUKEwiikKDe5L7uAhVFCuwKHUuFBoYQ8tMDegUAQCSAQCYAQCqAQdnd3Mtd2l6">convertidor mp3</a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div></div>

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
