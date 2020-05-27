@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="">
                    <div class="panel-heading">Փոփոխել Կարտեգորիան</div>
                    <div class="panel-body">
                        {!! BootForm::open(['route' => ['admin.categories.update', $category->id], 'method' => 'POST']) !!}
                        {!! BootForm::text('name_hy', 'Անուն (Հայերեն)', @$category->translate('hy')->name, ['required' => true]) !!}
                        {!! BootForm::text('name_en', 'Անուն (Անգլերեն)', @$category->translate('en')->name, ['required' => true]) !!}
                        {!! BootForm::text('name_ru', 'Անուն (Ռուսերեն)', @$category->translate('ru')->name, ['required' => true]) !!}
                        {!! BootForm::submit('Փոփոխել'); !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
