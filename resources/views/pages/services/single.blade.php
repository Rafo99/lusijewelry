@extends('layouts.main')

@section('title')
    {{ $service->getTranslation()->name }}
@endsection


@section('content')

    <div class="container service">
        <div class="row">
            <h2>{{ $service->getTranslation()->name }}</h2>
        </div>
        <div class="row">
            <div class="col-sm-6 service-content">
                <p> {{ $service->getTranslation()->description }} </p>
            </div>
        </div>

    </div>

@endsection