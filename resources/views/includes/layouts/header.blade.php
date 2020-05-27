<header>
    <div class="first-line">
        <div class="container-fluid">
            <div class="row">
                <div class="banner"></div>
                <div class="hidden-banner"></div>
                <div class="marg0a">
                    <div id="preHeaderBannerText" class="white centreText uppercase bold lPad20 rPad20">
                        @if (session('message'))
                            <span class="arrow textArrow smallArrow right">
                                {{ session('message') }}
                            </span>>
                        @else
                            <span class="arrow textArrow smallArrow right">learn about our online virtual consultations - find out more</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="second-line">
        <div class="container flex-end">
            <div class="col-sm-8 ">
                <div class="links-banner flex-start">
                    <a href="{{ route('contact') }}" class="banner-link">@lang('navigation.contact')</a>
                    <a href="{{ route('about') }}" class="banner-link">@lang('navigation.about')</a>
                    <a href="{{ route('location') }}" class="banner-link">@lang('navigation.location')</a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="links-banner flex-end">
                    {{--                    <a href="{{ route('cart.index') }}" class="banner-link">( {{ $total }} USD )</a>--}}
                    <div class="banner-link language pointer">
                        {{--                        <a data-toggle="dropdown"--}}
                        {{--                           class="dropdown-toggle">{{ LaravelLocalization::getCurrentLocaleName() }}</a>--}}
                        {{--                        <ul class="dropdown-menu">--}}
                        {{--                            @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)--}}
                        {{--                                <li>--}}
                        {{--                                    <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"--}}
                        {{--                                       hreflang="{{ $localeCode }}">{{ $localeCode }}</a>--}}
                        {{--                                </li>--}}
                        {{--                            @endforeach--}}
                        {{--                        </ul>--}}
                        @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
                            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                               hreflang="{{ $localeCode }}">
                                <img src="{{ asset('language_flags/'.$localeCode.'.png') }}" alt="" class="flags">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-menu">
        <div class="container space-between vertical-center">
            <a href="{{ route('home') }}" class="logo"><h1>Lusi Jewelry</h1></a>
            <nav>
                <ul class="menu-ul">
                    <li class="menu-item">
                        <a class="arrow textArrow medArrow down">@lang('navigation.gold') </a>
                        <ul class="menu dropdownMenu level1 whiteBG leftText hidden clearFix"
                            style="display: none;">
                            <li class="menuCol col-7">
                                <ul>
                                    @foreach($categories as $category)
                                        <li class="level1 "><a href="{{ route('golden.show', $category->id) }}">{{ $category->getTranslation()->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="menuCol col-5">
                                <ul>
                                    <li class="level1 children menuCol5 grey">
                                        <a>Special Jewelries</a>
                                        <ul class="menu level2">
                                            <li class="level2">
                                                <a href="{{ route('engagementRings.show') }}">@lang('navigation.wedding')</a>
                                            </li>
                                            <li class="level2 ">
                                                <a href="{{ route('gifts.show') }}">@lang('navigation.gifts')</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a class="arrow textArrow medArrow down">@lang('navigation.services')<span class="caret"></span></a>
                        <ul class="menu dropdownMenu level1 whiteBG leftText hidden clearFix"
                            style="display: none; width: unset">
                            <li class="menuCol col-12">
                                <ul>
                                    @foreach($services as $service)
                                        <li class="level1 " style="font-size: 18px"><a href="{{ route('services.show', $service->id) }}">{{ $service->getTranslation()->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>
{{--                    <li><a href="{{ route('order.show') }}">@lang('navigation.order')</a></li>--}}
                </ul>
            </nav>
        </div>
    </div>
{{--        <div class="menu-column">--}}
{{--            <div class="container-fluid">--}}
{{--                <div class="row">--}}
{{--                    <div class="menu-row">--}}
{{--                        <ul class="menu">--}}
{{--                            <li>--}}
{{--                                <a href="#">@lang('navigation.gold')<span class="caret"></span></a>--}}
{{--                                <ul>--}}
{{--                                    <li><a href="{{ route('golden.show', 1) }}">@lang('navigation.rings')<span--}}
{{--                                                    class="right-caret"></span></a>--}}
{{--                                        <ul>--}}
{{--                                            <li><a href="{{ route('rings', 'male') }}">@lang('navigation.male')</a></li>--}}
{{--                                            <li><a href="{{ route('rings', 'female') }}">@lang('navigation.female')</a></li>--}}
{{--                                            <li><a href="{{ route('rings', 'wedding') }}">@lang('navigation.wedding')</a>--}}
{{--                                            </li>--}}
{{--                                            <li><a href="{{ route('rings', 'oblige') }}">@lang('navigation.oblige')</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li><a href="{{ route('golden.show', 2) }}">@lang('navigation.pendants')</a></li>--}}
{{--                                    <li><a href="{{ route('golden.show', 3) }}">@lang('navigation.chains')</a></li>--}}
{{--                                    <li><a href="{{ route('golden.show', 4) }}">@lang('navigation.earings')</a></li>--}}
{{--                                    <li><a href="{{ route('golden.show', 5) }}">@lang('navigation.crosses')</a></li>--}}
{{--                                    <li><a href="{{ route('golden.show', 6) }}">@lang('navigation.bracelets')</a></li>--}}
{{--                                    <li><a href="{{ route('golden.show', 7) }}">@lang('navigation.watches')</a></li>--}}
{{--                                    <li><a href="{{ route('golden.show', 8) }}">@lang('navigation.necklaces')</a></li>--}}
{{--                                    <li><a href="{{ route('golden.show', 9) }}">@lang('navigation.complects')</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li><a href="{{ route('silver') }}">@lang('navigation.silver')</a></li>--}}
{{--                            <li><a href="{{ route('services') }}">@lang('navigation.services')<span--}}
{{--                                            class="caret"></span></a>--}}
{{--                                <ul>--}}
{{--                                    <li><a href="{{ route('services.show', 1) }}">@lang('navigation.engraving')</a></li>--}}
{{--                                    <li><a href="{{ route('services.show', 2) }}">@lang('navigation.resizing')</a></li>--}}
{{--                                    <li><a href="{{ route('services.show', 3) }}">@lang('navigation.polishing')</a></li>--}}
{{--                                    <li><a href="{{ route('services.show', 4) }}">@lang('navigation.shining')</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li><a href="{{ route('preparation.order') }}">@lang('navigation.order')</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
</header>