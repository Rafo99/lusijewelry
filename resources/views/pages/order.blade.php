@extends('layouts.main')

@section('title')
    @lang('navigation.order')
@endsection

@section('content')

    <div class="container order-page" style="margin-bottom: 50px">
        <div style="text-align: center;font-size: 3.5em; margin-bottom: 30px" class="ordering-page">
            <p>{{trans('order.order')}}</p>
        </div>
        <div class="row">
            <div class="col-md-7" style="padding: 0 5%;">
                <div class="productImages col-xs-12">
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
            </div>
            <div class="col-md-5">

                <div class="ckeckout">
                    @if (session('message'))
                        <div class="alert alert-success orderAlert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="cart-items gradient-border">
                        <div class="in-check OrderNow" style="text-align: center">
                            {!! Form::open(['route' => ['order.make', $data['product']->id], 'method' => 'POST', 'class' => 'order', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => '1', 'placeholder' => trans('order.name')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => trans('order.last_name')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('address', null, ['class' => 'form-control', 'required' => '1', 'placeholder' => trans('order.country_address')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('email_phone', null, ['class' => 'form-control', 'required' => '1', 'placeholder' => trans('order.email').' / '.trans('order.phone')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::textarea('message', null, ['class' => 'form-control', 'required' => '0', 'cols' => '10', 'rows' => '5',  'placeholder' => trans('order.message')]) !!}
                            </div>
                            <div class="productButton">
                                <button type="submit">@lang('order.order')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
