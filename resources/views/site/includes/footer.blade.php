<footer>
    <div class="footer">
        <div class="flex-img">

        </div>
        <div class="flex-info">
            <div>
                <ul class="ul-top">
                    @if(isset($footerMenusTop) && $footerMenusTop->count() > 0)
                        @foreach($footerMenusTop as $item)

                            <li><a  target="_blank" href="{{ $item->path }}">{{ $item->title }}</a></li>
                        @endforeach
                    @endif

                </ul>
                <ul class="ul-bottom">
                    @if(isset($footerMenusBottom) && $footerMenusBottom->count() > 0)
                        @foreach($footerMenusBottom as $item)

                            <li><a target="_blank" href="{{ $item->path }}">{{ $item->title }}</a></li>
                        @endforeach
                    @endif
                    <li>
                        <ul class="flex-icons">
                            @if(settings()->group('social_links')->get('linkedin_link'))

                                <li><a target="_blank" href="{{ settings()->group('social_links')->get('linkedin_link') }}"><img src="{{asset('asset/site/css/icons-images/linkedin.svg')}}" alt="linkedin" /></a></li>

                            @endif
                                @if(settings()->group('social_links')->get('facebook_link'))
                                    <li><a target="_blank"  href="{{ settings()->group('social_links')->get('facebook_link') }}"><img src="{{asset('asset/site/css/icons-images/facebook.svg')}}" alt="facebook" /></a></li>

                                @endif
                                <!-- @if(settings()->group('social_links')->get('instagram_link'))
                                    <li><a href="{{ settings()->group('social_links')->get('instagram_link') }}"><img src="{{asset('asset/site/css/icons-images/instagram.svg')}}" alt="instagram" /></a></li>

                                @endif -->
                                @if(settings()->group('social_links')->get('twitter_link'))
                                    <li><a target="_blank"  href="{{ settings()->group('social_links')->get('twitter_link') }}"><img src="{{asset('asset/site/css/icons-images/twitter.svg')}}" alt="twitter" /></a></li>

                                @endif
                        </ul>
                    </li>
                    <li><button class="subscribe sub-knopka">{{__('lang.buttons.subscribe')}}</button></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="webex-logo">
        <div class="webex">
            <a href="https://web-ex.tech">
                <img src="{{asset('asset/site/css/icons-images/new_logo_grey.webp')}}" />
                <span class="kes">ebEx</span><span class="myus-kes">Tech</span>
                <div class="website">Website Excellence Technologies</div>
            </a>
        </div>
    </div>

    <div class="subscribe-block">
        <div class="block-block">
            <div class="close">
                <div>&times;</div>
            </div>
            <div>{{ settings()->group(App::getLocale())->get('subscriber_modal_description') }}</div>
                <input class="email_sub" type="text" />
                <button class="subscribe btn_sub">{{__('lang.buttons.subscribe')}}</button>
            <span class="subscribe_error sub_message" style="display: none">{{ __('validation.subscribe_error') }}</span>
            <span class="subscribe_success sub_message" style="display: none">{{ __('validation.subscribe_success') }}</span>
            <span class="subscribe_message sub_message" style="display: none">{{ __('validation.subscribe_message') }}</span>
        </div>
    </div>
</footer>
<!--Start of Tawk.to Script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">


</script>
