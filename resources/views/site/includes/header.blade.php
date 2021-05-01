@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

        <a  hidden rel="alternate" id="lang{{ $localeCode }}" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
            {{ $properties['native'] }}
        </a>

@endforeach

<div class="preloader">
    <img src="{{asset('asset/site/css/icons-images/load.gif')}}" />
</div>

<!-- <header class= "parallax" data-rellax-speed="-5"> -->
<header>
    <div class="covid">
        <div class="updates-names">{{ settings()->group(App::getLocale())->get('top-header') }}</div>
        <div class="instruments">
            <div class="search-panel">
                <form method="get" action="{{ route('search.index') }}">
                    @csrf
                    <button type="submit"><i class="fas fa-search display"></i></button>
                    <input  name="search_text" class="display" />
                </form>
            </div>
            <div class="toggle-search">
                <img src="{{asset('asset/site/css/icons-images/search.svg')}}" alt="Enterprice-armenia" />
                <!-- <div class="iks-times display">&times;</div> -->
                <div class="iks-times display"></div>
            </div>
            <select onchange="document.getElementById('lang'+this.value).click()">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if($localeCode==app()->getLocale())
                <option value="{{ $localeCode }}" selected>{{ $properties['names'] }}</option>
                    @else
                <option value="{{ $localeCode }}">{{ $properties['names'] }}</option>
                    @endif
                @endforeach
            </select>

            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->
                        <a id="vxod" class="nav-link" href="{{ route('login') }}">{{ __('lang.headers.login') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->type == \App\Models\User::TYPE_INVESTOR)
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    My Profile
                                </a>
                            @endif

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>

        </div>
    </div>
    <div class="menu-content">
        <div class="aaa">
            <img src="{{asset('asset/site/css/icons-images/logo.svg')}}" alt="search-button" onclick="location.href='{{route('site.index')}}'" style="cursor:pointer" />
            <div class="menu-container">
                <div class="stellarnav" style="padding:0px">
                    <ul>
                        @foreach($menu_tree as $item)
                            @include('site.includes.menu_header_navigation', ['item' => $item, 'dropdownMenuLink_id' => 0, 'firstParentElement' => true])
                        @endforeach
                    </ul>
                </div>
                <a href="{{ route('how-to-reach-us.index') }}" class="how_to_reach_us">
                    {{__('lang.buttons.how_to_reach_us')}}
                </a>
            </div>
        </div>
    </div>
</header>
<div class="fff"></div>


