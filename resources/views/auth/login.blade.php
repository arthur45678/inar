
@extends('layouts.site')

@section('styles')

    <link rel="stylesheet" href="{{asset('asset/login/login.css')}}"/>
@endsection


@section('header')
    <?php
    $rows = \App\Models\Menu::getMenus(\Illuminate\Support\Facades\App::getLocale());
    $menu_tree = \App\Models\Menu::buildTreeForSelectMultiLevel($rows); ?>
    @include('site.includes.header')
@endsection

@section('content')

    <div class="login-container">


            <form method="POST" action="{{ route('login') }}">
                @csrf
            <h1>{{ __('lang.log-blank.login') }}</h1>
            <label for="email" class="log">{{ __('lang.log-blank.email') }}</label>
            <input placeholder="{{ __('lang.log-blank.placeholder') }}"  id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
            @error('email')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="parol">

                <label for="passwords" class="pass">{{ __('lang.log-blank.parol') }}</label>
                @if (Route::has('password.request'))
                    <span><a  href="{{ route('password.request') }}">
                        {{ __('lang.log-blank.forgot') }}
                    </a>
                    </span>
                @endif
            </div>
            <input type="password" placeholder="{{ __('lang.log-blank.placeholder_parol') }}" id="passwords" class="@error('password') is-invalid @enderror"
                   name="password" required autocomplete="current-password"/>
            @error('password')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
             </span>
            @enderror
            <div class="check">
                <div>

                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label for="remember">
                        {{ __('lang.log-blank.remember') }}
                    </label>
                </div>
                <button>{{ __('lang.log-blank.button') }}</button>
            </div>
            </form>


    </div>



@endsection


@section('footer')
    @include('site.includes.footer')
@endsection

