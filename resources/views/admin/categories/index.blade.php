@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="">
                    <div class="panel-heading">Կատեգորիաներ</div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Անուն</th>
                                <th>Փոփոխել</th>
                                <th>Ջնջել</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($categories as $category)
                                        <tr class="categories">
                                            <td>{{ $category->id }}</td>
                                            <td><a type="button" class="btn" data-toggle="collapse" data-target=".{{ $category->id }}"> {{ $category->getTranslation('hy')->name }} <span class="caret"></span></a></td>
                                            <td><a href="{{ route('admin.categories.edit', $category->id) }}">Փոփոխել</a></td>
                                            <td>
                                                {{ Form::open(['route' => ['admin.categories.destroy', $category->id], 'method' => 'delete']) }}
                                                {{ Form::submit('Ջնջել') }}
                                                {{ Form::close() }}
                                            </td>
                                        </tr>
                                        @if($category->has('children'))
                                            @foreach($category->children as $child)
                                                <tr class="collapse out {{ $category->id }}">
                                                    <td class="ta-right">{{ $child->id }}</td>
                                                    <td>{{ $child->getTranslation('hy')->name }}</td>
                                                    <td><a href="{{ route('admin.categories.edit', $child->id) }}">Փոփոխել</a></td>
                                                    <td>
                                                        {{ Form::open(['route' => ['admin.categories.destroy', $child->id], 'method' => 'delete']) }}
                                                        {{ Form::submit('Ջնջել') }}
                                                        {{ Form::close() }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
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
