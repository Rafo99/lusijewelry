@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="">
                    <div class="panel-heading">Products</div>
                    @if(session('message'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{{ session('message') }}</li>
                            </ul>
                        </div>
                    @endif
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Նկար</th>
                                <th>Անվանում</th>
                                <th>Կատեգորիա</th>
                                <th>SKU</th>
                                <th>Փոփոխել</th>
                                <th>Ջնջել</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><a target='_blank'
                                           href="{{ route('product.show', $product->id) }}">{{ $product->id }}</a></td>
                                    <td><img src="{{ route('show.thumb', $product->picture) }}"
                                             style="width:40px; height: 40px;"></td>
                                    <td>{{ $product->getTranslation('hy')->name }}</td>
                                    <td>{{ $product->category->getTranslation('hy')->name }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>
                                        {{ Form::open(['route' => ['admin.products.edit', $product->id], 'method' => 'get']) }}
                                        {{ Form::submit('Փոփոխել') }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                        {{ Form::open(['route' => ['admin.products.destroy', $product->id], 'method' => 'delete']) }}
                                        {{ Form::submit('Ջնջել', ['onclick' => 'return confirm("Are you sure?")']) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
