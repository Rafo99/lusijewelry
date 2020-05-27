@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="">
                    <div class="panel-heading">Ավելացնել Ապրանք</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="panel-body">
                        {!! BootForm::open(['route' => 'admin.products.store', 'method' => 'PUT']) !!}
                        {!! BootForm::text('name_hy', 'Անուն (Հայերեն)', old('name_hy'), ['required' => true]) !!}
                        {!! BootForm::text('name_en', 'Անուն (Անգլերեն)', old('name_en')) !!}
                        {!! BootForm::text('name_ru', 'Անուն (Ռուսերեն)', old('name_ru')) !!}
                        <br>
                        {{--{!! BootForm::text('sku', 'SKU', old('sku'), ['required' => true]) !!}--}}
                        {!! BootForm::number('price', 'Գին', old('price'), ['required' => true]) !!}
                        {!! BootForm::number('qty', 'Քանակ', 1, ['checked']) !!}
                        <br>
                        <div class="form-group">
                            <label for="sel1">Ընտրել Կատեգորիան:</label>
                            <select class="form-control select-cat" name="category_id" id="sel1">
                                <option value="Without Category"></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->getTranslation('hy')->name }}</option>
                                @endforeach
                            </select>
                            <div class="hidden-select">
                                <label for="sel2">Ընտրել Ենթակատեգորիան:</label>
                                <select class="form-control" name="sex" id="sel2" style="max-width: 400px;">
                                    <option value="male">Տղամարդու</option>
                                    <option value="female">Կանացի</option>
                                    <option value="wedding">Ամուսնական</option>
                                    <option value="oblige">Նշանադրության</option>
                                </select>
                            </div>
                            <label for="sel2">Ընտրել Տիպը:</label>
                            <select class="form-control" name="type" id="sel2" style="max-width: 400px;">
                                <option value="">Տիպ</option>
                                <option value="golden">Ոսկի</option>
                                <option value="silver">Արծաթ</option>
                            </select>
                            <label for="sel3">Ընտրել Կարատը:</label>
                            <select class="form-control" name="karat" id="sel3" style="max-width: 400px;">
                                <option value="" selected>Կարատ</option>
                                <option value="333">333-8K</option>
                                <option value="375">375-9K</option>
                                <option value="416">416-10K</option>
                                <option value="585">585-14K</option>
                                <option value="750">750-18K</option>
                                <option value="916">916-21K</option>
                                <option value="958">958-23K</option>
                            </select>
                            <label for="sel4">Ընտրել Գույնը:</label>
                            <select class="form-control" name="color" id="sel4" style="max-width: 400px;">
                                <option value="" selected>Գույն</option>
                                <option value="yellow">Դեղին</option>
                                <option value="red">Կարմիր</option>
                                <option value="white">Սպիտակ</option>
                            </select>
                        </div>

                        <br>

                        <div id="photo-main">
                            <h3>Գլխավոր նկար</h3>
                            <div class="input-group">
                            <span class="input-group-btn">
                              <a id="lfm-main" data-input="thumbnail-main" data-preview="holder-main"
                                 class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Ընտրել գլխավոր նկարը
                              </a>
                            </span>
                                <input id="thumbnail-main" class="form-control" type="text" value="" name="picture">
                            </div>
                            <img id="holder-main" style="margin-top:15px;max-height:100px;">
                        </div>

                        <div id="photo">
                            <h3>Այլ նկարներ</h3>
                            <div class="input-group">
                            <span class="input-group-btn">
                              <a id="lfm-0" data-input="thumbnail-0" data-preview="holder-0" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Ընտրել
                              </a>
                            </span>
                                <input id="thumbnail-0" class="form-control" type="text" value="" name="filepath[]">
                            </div>
                            <img id="holder-0" style="margin-top:15px;max-height:100px;margin-bottom:25px;">
                        </div>

                        <button type="button" onclick="addPhotoInput()">Ավելացնել այլ նկար</button>

                        <br>
                        {!! BootForm::textarea('description_hy', 'Նկարագրություն (Հայերեն)', old('description_hy'), ['class' => 'tm']) !!}
                        {!! BootForm::textarea('description_ru', 'Նկարագրություն (Ռուսերեն)', old('description_ru'), ['class' => 'tm']) !!}
                        {!! BootForm::textarea('description_en', 'Նկարագրություն (Անգլերեն)', old('description_en'), ['class' => 'tm']) !!}
                        {!! BootForm::submit('Create'); !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var iPhoto = 1;

        function addPhotoInput() {
            $('#photo').append('<div class="input-group"><span class="input-group-btn"><a id="lfm-' + iPhoto + '" data-input="thumbnail-' + iPhoto + '" data-preview="holder-' + iPhoto + '" class="btn btn-primary"><i class="fa fa-picture-o"></i> Choose</a></span><input id="thumbnail-' + iPhoto + '" class="form-control" type="text" value="" name="filepath[]"></div><img id="holder-' + iPhoto + '" style="margin-top:15px;max-height:100px;margin-bottom:25px;">');
            $('#lfm-' + iPhoto).filemanager('image', {prefix: route_prefix});
            iPhoto++;
        }
    </script>
@endpush
