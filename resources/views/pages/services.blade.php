@extends('layouts.main')

@section('title')
    @lang('navigation.services')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 jewellery">
                <div class="col-md-6 first-line">
                    <a href="{{ route('services.show', 1) }}">
                        <div class="first-line-content content" id="engraving"
                             onmouseover="document.getElementById('engraving').style.opacity = 1"
                             onmouseout="document.getElementById('engraving').style.opacity = 0.5"></div>
                        <div class="content-text" onmouseover="document.getElementById('engraving').style.opacity = 1"
                             onmouseout="document.getElementById('engraving').style.opacity = 0.5">
                            <h2>@lang('navigation.engraving')</h2>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 first-line">
                    <a href="{{ route('services.show', 2) }}">
                        <div class="first-line-content content" id="resizing"
                             onmouseover="document.getElementById('resizing').style.opacity = 1"
                             onmouseout="document.getElementById('resizing').style.opacity = 0.5"></div>
                        <div class="content-text" onmouseover="document.getElementById('resizing').style.opacity = 1"
                             onmouseout="document.getElementById('pendants').style.opacity = 0.5">
                            <h2>@lang('navigation.resizing')</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 jewellery">
                <div class="col-md-6 second-line">
                    <a href="{{ route('services.show', 3) }}">
                        <div class="second-line-content content" id="polishing"
                             onmouseover="document.getElementById('polishing').style.opacity = 1"
                             onmouseout="document.getElementById('polishing').style.opacity = 0.5"></div>
                        <div class="content-text" onmouseover="document.getElementById('polishing').style.opacity = 1"
                             onmouseout="document.getElementById('polishing').style.opacity = 0.5">
                            <h2>@lang('navigation.polishing')</h2>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 second-line">
                    <a href="{{ route('services.show', 4) }}">
                        <div class="second-line-content content" id="shining"
                             onmouseover="document.getElementById('shining').style.opacity = 1"
                             onmouseout="document.getElementById('shining').style.opacity = 0.5"></div>
                        <div class="content-text" onmouseover="document.getElementById('crosses').style.opacity = 1"
                             onmouseout="document.getElementById('shining').style.opacity = 0.5">
                            <h2>@lang('navigation.shining')</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection