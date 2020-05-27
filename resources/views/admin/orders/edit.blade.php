@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="">
                    <div class="panel-heading">Տեսնել Պատվերը</div>
                    <div class="panel-body">
                        {!! BootForm::text('name', 'Անուն', $order->name, ['readonly' => true]) !!}
                        {!! BootForm::text('last_name', 'Ազգանուն', $order->last_name, ['readonly' => true]) !!}
                        {!! BootForm::text('email', 'Էլ․ Հասցե', $order->email, ['readonly' => true]) !!}
                        {!! BootForm::text('address', 'Հասցե', $order->address, ['readonly' => true]) !!}
                        {!! BootForm::text('phone', 'Հեռախոսահամար', $order->phone, ['readonly' => true]) !!}
                        {!! BootForm::text('price', 'Գին', $order->price . ' USD', ['readonly' => true]) !!}
                        {!! BootForm::text('date', 'Ամսաթիվ', $order->created_at, ['readonly']) !!}
                        {!! BootForm::open(['route' => ['admin.orders.update', $order->id], 'method' => 'POST']) !!}
                        {!! BootForm::textarea('message', 'Նամակ', $order->message, ['readonly']) !!}
                        @if($order->uploaded_image != '')
                            <div>
                                <img src="{{ asset('public/photos/preparation_orders/'.$order->uploaded_image) }}" alt="" style="max-width: 300px; max-height: 300px;">
                            </div>
                        @endif
                        
                        @if($order->sent)
                            {!! BootForm::checkbox('sent', 'Ուղարկված', $order->sent, ['checked']) !!}
                        @else
                            {!! BootForm::checkbox('sent', 'Ուղարկված', $order->sent) !!}
                        @endif
                        
                        {!! BootForm::submit('Փոփոխել') !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="">
                    <div class="panel-heading">Պատվերի պարունակություն</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <tbody>
                                @foreach($order->products()->get() as $product)
                                    <tr>
                                        <td>
                                            {{ $product->product()->first()->name }}
                                        </td>
                                        <td>
                                            {{ $product->product()->first()->price }} USD
                                        </td>
                                        <td>
                                            {{ $product->qty }}
                                        </td>
                                        <td>
                                            <a href="{{ route('product.show', $product->product()->first()->id) }}" target="_blank">Show</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
