@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="">
                    <div class="panel-heading">Պատվերներ</div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Անուն</th>
                                <th>Ազգանուն</th>
                                <th>Էլ․ Հասցե</th>
                                <th>Հեռախոսահամար</th>
                                <th>Գին</th>
                                <th>+</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr @if(!$order->sent) class="danger" @endif>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->last_name }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td><a href="{{ route('admin.orders.edit', $order->id) }}">Տեսնել</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if (session('message'))
                            <br>
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
