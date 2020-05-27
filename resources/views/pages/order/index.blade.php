@extends('layouts.main')



@section('content')

    <div class="ckeckout">
        <div class="container">
            <div class="ckeckout-top">
                <div class="cart-items gradient-border">
                    <h3>@lang('order.total') {{ $total }} USD</h3>
                    <div class="in-check OrderNow">
                        {!! Form::open(['route' => 'order', 'method' => 'POST', 'class' => 'order']) !!}
                        <br>
                        {!! Form::text('name', null, ['id' => 'name', 'class' => 'effect-16', 'required' => '1', 'placeholder' => trans('order.name')]) !!}
                        <br>
                        {!! Form::text('lastName', null, ['id' => 'lastName', 'class' => 'effect-16',  'required' => 'name', 'placeholder' => trans('order.last_name')]) !!}
                        <br>
                        {!! Form::text('phone', null, ['id' => 'phone', 'class' => 'effect-16',  'required' => '1', 'placeholder' => trans('order.phone')]) !!}
                        <br>
                        {!! Form::hidden('type', 1) !!}
                        {!! Form::submit(trans('order.order'), ['class' => 'knopka']) !!}
                    </div>
                </div>
                @if (session('message'))
                    <div class="alert alert-success orderAlert">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@if($total < 1)
    @section('content')
        <div class="ckeckout">
            <div class="container">
                <div class="ckeck-top heading">
                    <h2>@lang('order.order_now')</h2>
                </div>
                <div class="ckeckout-top">
                    <div class="cart-items" style="text-align: center">
                        <h3>Please Buy Something</h3>
                    </div>
                </div>
            </div>
        </div>

    @overwrite
@endif