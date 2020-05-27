@extends('layouts.main')


@section('title', $data['product']->getTranslation()->name)


@push('meta')
    {!! $og->renderTags() !!}
@endpush


@section('content')

    @include('includes.layouts.breadcrumb')
    <div class="product-single">
        <div class="container">
            <div class="row">
                <div class="productImages col-lg-8 col-sm-9 col-xs-12">
                    <div class="productThumbs">
                        <ul class="thumbList">
                            <li data-thumb="{{ route('show.thumb', $data['product']->picture) }}"
                                class="active-thumb list-thumb">
                                <div class="thumb-image">
                                    <a class="thumb-link active-thumb" rel="group"
                                       href="{{ route('show.image', $data['product']->picture) }}">
                                        <img src="{{ route('show.thumb', $data['product']->picture) }}"
                                             class="thumb img-responsive single-pic">
                                    </a>
                                </div>
                            </li>
                            @foreach($data['productpics'] as $data['productpic'])
                                <li data-thumb="{{ route('show.thumb', $data['productpic']->picture) }}" class="list-thumb">
                                    <div class="thumb-image">
                                        <a class="thumb-link" rel="group"
                                           href="{{ route('show.image', $data['productpic']->picture) }}">
                                            <img src="{{ route('show.thumb', $data['productpic']->picture) }}"
                                                 class="thumb img-responsive single-pic">
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="productImage" id="productImage">
                        <img src="{{ route('show.image', $data['product']->picture) }}"
                             data-imagezoom="true" class="img-responsive single-pic"
                             id="main-pic">
                    </div>
                </div>
                <div class="productDescriptions col-lg-4 col-sm-12 col-xs-12">
                    <h1 class="productName">{{ $data['product']->getTranslation()->name }}</h1>
                    <div class="productPrice">
                        <span>${{ $data['product']->price }}</span>
                    </div>
                    <div class="productDesc">
                        {!! $data['product']->getTranslation()->description !!}
                    </div>
                    <div class="productButton">
                        <a href="{{ route('order.show', $data['product']->id) }}"><button>Preorder</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="relatedProducts">
        <h3>Related Products</h3>
        <div class="related">
            <div class="container">
                <div class="row space-between">
                    @foreach($data['latest'] as $item)
                        <div class="col-sm-4 col-md-3 col-xs-8 product">
                            <a href="{{ route('product.show', $item->id) }}"><img
                                        src="{{ route('show.thumb', $item->picture) }}" alt=""></a>
                            <a href="{{ route('product.show', $item->id) }}"><h2
                                        class="productTitle align-center">{{ $item->getTranslation()->name }}</h2></a>
                            <div class="productPrice align-center">
                                <span>from  </span><span>{{ $item->price }}$</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
