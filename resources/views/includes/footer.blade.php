<footer>
    <div class="footer">
        <div class="flex-img">
            <div class="first-img"><img src="{{ $assetPath }}/css/icons-images/gerb.png" alt="" /></div>
            <div class="second-img"><img src="{{ $assetPath }}/css/icons-images/logo.svg" alt="" /></div>
        </div>
        <div class="flex-info">
            <div>
                <ul class="ul-top">
                    @if(isset($footerMenusTop) && $footerMenusTop->count() > 0)
                        @foreach($footerMenusTop as $item)
                            <li><a href="{{ $item->path }}">{{ $item->title }}</a></li>
                        @endforeach
                    @endif
                </ul>
                <ul class="ul-bottom">
                    @if(isset($footerMenusBottom) && $footerMenusBottom->count() > 0)
                        @foreach($footerMenusBottom as $item)
                            <li><a href="{{ $item->path }}">{{ $item->title }}</a></li>
                        @endforeach
                    @endif
                    <li>
                        <ul class="flex-icons">
                            <li><a href="#"><img src="{{ $assetPath }}/css/icons-images/linkedin.svg" alt="linkedin" /></a></li>
                            <li><a href="#"><img src="{{ $assetPath }}/css/icons-images/facebook.svg" alt="facebook" /></a></li>
                            <li><a href="#"><img src="{{ $assetPath }}/css/icons-images/instagram.svg" alt="instagram" /></a></li>
                            <li><a href="#"><img src="{{ $assetPath }}/css/icons-images/twitter.svg" alt="twitter" /></a></li>
                        </ul>
                    </li>
                    <li><button class="subscribe">subscribe</button></li>
                </ul>
            </div>
        </div>
    </div>            
</footer>