@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="">
                    <div class="panel-heading">Ավելացնել Կատեգորիա</div>
                    <div class="panel-body">
                        {!! BootForm::open(['route' => 'admin.categories.store', 'method' => 'PUT']) !!}

                        <div class="form-group">
                            <label for="sel1">Կատեգորիան, որին պատկանելու է նոր կատեգորիան (Եթե անհրաժեշտ է)</label>
                            <select class="form-control" name="category_id" id="sel1">
                                    <option selected value=""></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->getTranslation('hy')->name }}</option>
                                @endforeach
                            </select>
                        </div><br>

                        {!! BootForm::text('name_hy', 'Անուն (Հայերեն)', old('name_hy'), ['required' => true]) !!}
                        {!! BootForm::text('name_en', 'Անուն (Անգլերեն)', old('name_en'), ['required' => true]) !!}
                        {!! BootForm::text('name_ru', 'Անուն (Ռուսերեն)', old('name_ru'), ['required' => true]) !!}
                        {!! BootForm::submit('Ավելացնել'); !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
