<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /*.dropdown {*/
            /*width: 135px;*/
        /*}*/
        .dropdown-menu > li > a {
            color: #3097D1;
        }
        .table tr th {
            width: auto;
        }
    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header col-md-2">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    {{ config('app.name', 'LusiJewelry') }}
                </a>
            </div>

            <div class="collapse navbar-collapse " id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <div class="col-md-9">
                    <ul class="nav navbar-nav">
                        @if(Auth::guard('admin')->check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Կատեգորիաներ <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('admin.categories') }}">
                                            Տեսնել
                                        </a>

                                        <a href="{{ route('admin.categories.create') }}">
                                            Ավելացնել
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Ապրանքներ <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('admin.products') }}">
                                            Տեսնել
                                        </a>

                                        <a href="{{ route('admin.products.create') }}">
                                            Ավելացնել
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Առկա Պատվերներ <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('admin.orders') }}">
                                            Տեսնել
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Նոր Պատվերներ <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('admin.preparation.orders') }}">
                                            Տեսնել
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- Right Side Of Navbar -->
                <div class="col-md-1">
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guard('admin')->check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('admin.logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script>
    $('.collapse').collapse()
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    var route_prefix = "{{ url(config('lfm.prefix')) }}";
</script>
<script type="text/javascript" src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script type="text/javascript">
        document.body.style.backgroundImage = "none";
        document.body.style.backgroundColor = "white";
</script>
<script>
    var editor_config = {
        path_absolute : "",
        selector: "textarea.tm",
        plugins: [
            "link image"
        ],
        relative_urls: false,
        height: 129,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + route_prefix + '?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };
    tinymce.init(editor_config);
</script>
<script src="{{ asset('js/admin.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
        $('#lfm').filemanager('image', {prefix: route_prefix});
        $('#lfm-main').filemanager('image', {prefix: route_prefix});
        $('#lfm-0').filemanager('image', {prefix: route_prefix});
    });
    function SetUrl(url, file_path){
        //set the value of the desired input to image url
        var target_input = $('#' + localStorage.getItem('target_input'));
        target_input.val(file_path);

        //set or change the preview image src
        var target_preview = $('#' + localStorage.getItem('target_preview'));
        target_preview.attr('src', url);
    }

</script>
@stack('scripts')
</body>
</html>
