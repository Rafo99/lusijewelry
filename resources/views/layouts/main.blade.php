<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title', trans('navigation.home')) | Lusi Jewelry</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content=""/>
    <meta name="lang" content="{{ LaravelLocalization::getCurrentLocale() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('meta')
    <link rel="icon" type="image/ico" href="{{ asset('demo/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    @stack('links')
</head>

<body>

@include('includes.layouts.header')

@yield('slider', '')

@yield('content', '')

@include('includes.layouts.footer')

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/init.js') }}"></script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5e86128f35bcbb0c9aad1d2f/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
@stack('scripts')
</body>
</html>
