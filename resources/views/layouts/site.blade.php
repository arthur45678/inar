<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <link rel="icon" type="image/x-icon" href="{{ $assetPath }}/css/icons-images/logo.svg" />
    <link rel="stylesheet" href="{{asset('asset/site/css/fonts/font-awesome/css/all.min.css')}}" />

    <link rel="stylesheet" href="{{ $assetPath }}/css/second-pages.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="@yield('meta_keywords','some default keywords')">
    <meta name="description" content="@yield('meta_description','default description')">
    <link rel="canonical" href="{{url()->current()}}"/>
    <link rel="stylesheet" href="{{asset('asset/site/css/header-footer.css')}}" />
    <link rel="stylesheet" href="{{asset('asset/site/css/stellarnav.min.css')}}">
    <title>@yield('title',config('app.name'))</title>

    @if(App::getLocale() == 'ru')
        <style>
            body,body *,*{
                font-family: sans-serif!important;
            }
        </style>
    @endif

    <link rel="stylesheet" href="{{asset('asset/site/css/index.css')}}">
    @yield('styles')

<!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/600038fcc31c9117cb6e9121/1es0dt6st';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

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
@yield('header')


@yield('content')

<!--    -->
<!--Footer-->
<!--    -->
@yield('footer')

<script src="{{asset('asset/site/js-plugins/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('asset/site/js-plugins/stellarnav.min.js')}}"></script>
<script src="{{asset('asset/site/js-plugins/my-code.js')}}"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->

@yield('scripts')
</body>
</html>

