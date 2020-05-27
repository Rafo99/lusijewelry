@extends('layouts.main')

@section('title')
    {{ isset($data['title']) ? $data['title'] : 'Unknown Page' }}
@endsection

@section('content')

    @include('includes.layouts.breadcrumb')
    <div class="productsList">
        <div class="container-fluid">
            <div class="row">
                <div class="filter-tab">
                    <a class="close-filter-tab" style="display: none; position: absolute; top: 10px; right: 10px"><i class="fa fa-times" style="font-size: 20px"></i></a>
                    <div class="filterTitle ">
                        <h3 class="smallTitle vertical-center">Filters</h3>
                        <a class="clearFilters vertical-center" href="{{ request()->url() }}">Reset all</a>
                    </div>
                    <div class="filterColor mgt20">
                        <h4 class="capsTitle">Metal Color</h4>
                        <div class="filterColorButtons">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="#" data-filter="metal" data-value="none-gold" data-name=""
                                       class="metalIcon filter active">
                                        <span class="icon none-gold"></span>All
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="#" data-filter="metal" data-value="red-gold" data-name="red"
                                       class="metalIcon filter ">
                                        <span class="icon red-gold"></span>Red Gold
                                    </a>
                                    <input type="text" class="hidden">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="#" data-filter="metal" data-value="yellow-gold" data-name="yellow"
                                       class="metalIcon filter ">
                                        <span class="icon yellow-gold"></span>Yellow Gold
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="#" data-filter="metal" data-value="white-gold" data-name="white"
                                       class="metalIcon filter ">
                                        <span class="icon white-gold"></span>White Gold
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filterSelects">
                        <div class="col-sm-6 filterGender mgt20">
                            <div class="row column-style">
                                <h4 class="capsTitle">Gender</h4>
                                <div class="filterButtons">
                                    <select name="" id="selectGender" class="small wide">
                                        <option value="" selected>Choose Gender</option>
                                        <option value="male" {{ request('sex') == 'male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="female" {{ request('sex') == 'female' ? 'selected' : '' }}>
                                            Female
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 filterCarat mgt20">
                            <div class="row column-style">
                                <h4 class="capsTitle">Metal Carat</h4>
                                <div class="filterButtons">
                                    <select name="" id="selectCarat" class="small wide">
                                        <option value="" selected>Choose Karat</option>
                                        <option value="333" {{ request('carat') == '333' ? 'selected' : '' }}>333-8K
                                        </option>
                                        <option value="375" {{ request('carat') == '375' ? 'selected' : '' }}>375-9K
                                        </option>
                                        <option value="416" {{ request('carat') == '416' ? 'selected' : '' }}>
                                            416-10K
                                        </option>
                                        <option value="585" {{ request('carat') == '585' ? 'selected' : '' }}>
                                            585-14K
                                        </option>
                                        <option value="750" {{ request('carat') == '750' ? 'selected' : '' }}>
                                            750-18K
                                        </option>
                                        <option value="916" {{ request('carat') == '916' ? 'selected' : '' }}>
                                            916-21K
                                        </option>
                                        <option value="958" {{ request('carat') == '958' ? 'selected' : '' }}>
                                            958-23K
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filterPrice mgt20">
                        <h4 class="capsTitle">Price</h4>
                        <div class="filterSlider" id="priceSlider" data-min="570.0000000000"
                             data-max="11070.0000000000">
                            <div class="ui-slider-range ui-corner-all ui-widget-header"
                                 style="left: 0; width: 100%;"></div>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"
                                  style="left: 0;"></span>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"
                                  style="left: 100%;"></span>
                        </div>
                        <div class="sliderInputs">
                            <input name="minPrice" id="min_price" class="sliderInput min text"
                                   value="{{ request('from') ?? $data['minPrice'] }}$"
                                   data-min="{{ $data['minPrice'] }}" data-value="{{ request('from') ?? $data['minPrice'] }}" type="text"
                                   oninput="validity.valid||(value='0');">
                            <input name="maxPrice" id="max_price" class="sliderInput max text rightText"
                                   value="{{ request('to') ?? $data['maxPrice'] }}$"
                                   data-max="{{ $data['maxPrice'] }}" data-value="{{ request('to') ?? $data['maxPrice'] }}" type="text"
                                   oninput="validity.valid||(value=20000);">
                        </div>
                    </div>
                    <form action="" method="GET" class="hidden" id="filterForm">
                        <input type="text" name="color" id="metalColor" class="hidden getFilter" value="{{ request('color') }}">
                        <input type="text" name="carat" id="metalCarat" class="hidden getFilter" value="{{ request('carat') }}">
                        <input type="text" name="sex" id="metalSex" class="hidden getFilter" value="{{ request('sex') }}">
                        <input type="text" name="sort" id="sortItems" class="hidden getFilter" value="{{ request('sort') }}">
                        <input type="text" name="from" id="metalPriceFrom" class="hidden getFilter priceInput"
                               value="{{ request('from') }}">
                        <input type="text" name="to" id="metalPriceTo" class="hidden getFilter priceInput"
                               value="{{ request('to') }}">
                    </form>
                </div>
                <div class="products">
                    <div class="ajaxContainer">
                        <div id="products">
                            <div class="productResultsTools">
                                <div class="totalCount">
                                    <a class="filter-button" style="display: none"><i class="fa fa-bars"></i> &nbsp;Filter</a>
                                    <span>{{ $data['products']->total() }} items found</span>
                                    <div class="sortBy">
                                        <select name="" id="selectSort" class="small wide">
                                            <option value="1" {{ request('sort') == 1 ? 'selected' : '' }} selected>A-Z</option>
                                            <option value="2" {{ request('sort') == 2 ? 'selected' : '' }}>Z-A</option>
                                            <option value="3" {{ request('sort') == 3 ? 'selected' : '' }}>-+</option>
                                            <option value="4" {{ request('sex') == 4 ? 'selected' : '' }}>+-</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="products-block">
                                <div class="row">
                                    @foreach($data['products'] as $product)
                                        <div class="col-sm-4 product">
                                            <a href="{{ route('product.show', $product->id) }}"><img src="{{ route('show.thumb', $product->picture) }}" alt=""></a>
                                            <a href="{{ route('product.show', $product->id) }}"><h2 class="productTitle align-center">{{ $product->getTranslation()->name }}</h2></a>
                                            <div class="productDescription">
                                                <p class="description align-center">Description</p>
                                            </div>
                                            <div class="productPrice align-center">
                                                <span>from </span><span>{{ $product->price }}$</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="productsPagination">
                            {{ $data['products']->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')

@endpush