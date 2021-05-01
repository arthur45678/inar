<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title',config('app.name'))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ $assetPath }}/css/app.css">
    <link rel="stylesheet" href="{{ $assetPath }}/css/custom.css">
    @yield('styles')
    <style>.but:hover{background:#eeaa17!important;}</style>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DLBXLRDM20"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-DLBXLRDM20');
    </script>
</head>
<body>
<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <h3><a href="{{ route('site.index') }}">{{ env('app_name') }}</a></h3>

            </form>

            <!-- Language sweetcher -->
            <div class="btn-group">
                <ul>
                    <ul class="dropdown-menu">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" class="dropdown-item" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </ul>

            <div class="btn but dropdown-toggle text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ARM

            </div>
            </div>
            <!-- End Language sweetcher -->
            <ul class="navbar-nav navbar-right">
                <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-right">
                        <div class="dropdown-header">Messages
                            <div class="float-right">
                                <a href="{{ route('account.messages.sendManagerMessage') }}">Send message manager</a>
                            </div>
                        </div>
                        <div class="dropdown-list-content dropdown-list-message">
                            <a href="#" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-avatar">
                                    <img alt="image" src="{{ showAvatar(Auth::user()->img) }}" class="rounded-circle">
                                    <div class="is-online"></div>
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>Kusnaedi</b>
                                    <p>Hello, Bro!</p>
                                    <div class="time">10 Hours Ago</div>
                                </div>
                            </a>

                        </div>
                        <div class="dropdown-footer text-center">
                            <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else


                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->f_name . ' '.Auth::user()->l_name }}</div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('account.profiles.edit', [auth()->user()->id]) }}" class="dropdown-item has-icon">
                            <i class="fas fa-cog"></i> Settings
                        </a>


                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </nav>


        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                @include('account.includes.info-box')
                @yield('content')

            </section>
        </div>
        <footer class="main-footer">
            <div class="footer-left">
            </div>
            <div class="footer-right">
                2.3.0
            </div>
        </footer>
    </div>
</div>
<script src="{{ $assetPath }}/js/manifest.js"></script>
<script src="{{ $assetPath }}/js/vendor.js"></script>
<script src="{{ $assetPath }}/js/app.js"></script>

@yield('scripts')
</body>
</html>
