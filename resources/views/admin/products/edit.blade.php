@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="">
                    <div class="panel-heading">Edit Product</div>
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
                        {!! BootForm::open(['route' => ['admin.products.update', $product->id], 'method' => 'POST']) !!}
                        {!! BootForm::text('name_hy', 'Անուն (Հայերեն)', @$product->translate('hy')->name, ['required' => true]) !!}
                        {!! BootForm::text('name_en', 'Անուն (Անգլերեն)', @$product->translate('en')->name) !!}
                        {!! BootForm::text('name_ru', 'Անուն (Ռուսերեն)', @$product->translate('ru')->name) !!}
                        <br>
                        {{--{!! BootForm::text('sku', 'SKU', @$product->sku, ['required' => true]) !!}--}}
                        {!! BootForm::number('price', 'Գին', @$product->price, ['required' => true]) !!}
                        {!! BootForm::number('qty', 'Քանակ', @$product->qty, ['required' => true]) !!}

                        <br>
                        <div class="form-group">
                            <label for="sel1">Ընտրել Կատեգորիան:</label>
                            <select class="form-control select-cat" name="category_id" id="sel1">
                                @foreach($categories as $category)
                                    @if($category->id == $product->category->id)
                                        <option selected value="{{ $category->id }}">{{ $category->getTranslation('hy')->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->getTranslation('hy')->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="{{ $product->category->id == 1 ? '' : 'hidden-select' }}">
                                <label for="sel2">Ընտրել Ենթակատեգորիան:</label>
                                <select class="form-control" name="sex" id="sel2" style="max-width: 400px;">
                                    <option value="male" {{ $product->sex === 'male' ? 'selected' : '' }}>Տղամարդու</option>
                                    <option value="female" {{ $product->sex === 'female' ? 'selected' : '' }}>Կանացի</option>
                                    <option value="wedding" {{ $product->sex === 'wedding' ? 'selected' : '' }}>Ամուսնական</option>
                                    <option value="oblige" {{ $product->sex === 'oblige' ? 'selected' : '' }}>Նշանադրության</option>
                                </select>
                            </div>
                            <label for="sel2">Ընտրել Տիպը:</label>
                            <select class="form-control" name="type" id="sel2" style="max-width: 400px;">
                                <option value="">Տիպ</option>
                                <option value="golden" {{ $product->type === 'golden' ? 'selected' : '' }}>Ոսկի</option>
                                <option value="silver" {{ $product->type === 'silver' ? 'selected' : '' }}>Արծաթ</option>
                            </select>
                            <label for="sel3">Ընտրել Կարատը:</label>
                            <select class="form-control" name="karat" id="sel3" style="max-width: 400px;">
                                <option value="">Կարատ</option>
                                <option value="333" {{ $product->karat == '333' ? 'selected' : '' }}>333-8K</option>
                                <option value="375" {{ $product->karat == '375' ? 'selected' : '' }}>375-9K</option>
                                <option value="416" {{ $product->karat == '416' ? 'selected' : '' }}>416-10K</option>
                                <option value="585" {{ $product->karat == '585' ? 'selected' : '' }}>585-14K</option>
                                <option value="750" {{ $product->karat == '750' ? 'selected' : '' }}>750-18K</option>
                                <option value="916" {{ $product->karat == '916' ? 'selected' : '' }}>916-21K</option>
                                <option value="958" {{ $product->karat == '958' ? 'selected' : '' }}>958-23K</option>
                            </select>
                            <label for="sel4">Ընտրել Գույնը:</label>
                            <select class="form-control" name="color" id="sel4" style="max-width: 400px;">
                                <option value="">Գույն</option>
                                <option value="yellow" {{ $product->color === 'yellow' ? 'selected' : '' }}>Դեղին</option>
                                <option value="red" {{ $product->color === 'red' ? 'selected' : '' }}>Կարմիր</option>
                                <option value="white" {{ $product->color === 'white' ? 'selected' : '' }}>Սպիտակ</option>
                            </select>
                        </div>

                        <br>

                        <div id="photo-main">
                            <h3>Գլխավոր նկար</h3>
                            <div class="input-group">
                            <span class="input-group-btn">
                              <a id="lfm-main" data-input="thumbnail-main" data-preview="holder-main" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose Main Picture
                              </a>
                            </span>
                                <input id="thumbnail-main" class="form-control" type="text" value="{{ $product->picture }}" name="picture">
                            </div>
                            <img id="holder-main" style="margin-top:15px;max-height:100px;">
                        </div>

                        <div id="photo">
                            <h3>Այլ նկարներ</h3>
                            @foreach($product->pictures as $pic)
                                @push('scripts')
                                    <script>
                                        $(document).ready(function () {
                                            $('#lfm-'+{{ $pic->id}}+'-old').filemanager('image', {prefix: route_prefix});
                                        });
                                    </script>
                                @endpush

                                <div class="input-group">
                              <span class="input-group-btn">
                                <a id="lfm-{{$pic->id}}-old" data-input="thumbnail-{{$pic->id}}-old" data-preview="holder-{{$pic->id}}-old" class="btn btn-primary">
                                  <i class="fa fa-picture-o"></i> Choose
                                </a>
                              </span>
                                    <input id="thumbnail-{{$pic->id}}-old" class="form-control" type="text" value="{{$pic->picture}}" name="filepath[]">
                                </div>
                                <img id="holder-{{$pic->id}}-old" style="margin-top:15px;max-height:100px;margin-bottom:25px;">
                            @endforeach
                        </div>

                        <button type="button" onclick="addPhotoInput()">Ավելացնել այլ նկար</button>

                        <br>
                        {!! BootForm::textarea('description_hy', 'Նկարագրություն (Հայերեն)', @$product->translate('hy')->description, ['class' => 'tm']) !!}
                        {!! BootForm::textarea('description_ru', 'Նկարագրություն (Ռուսերեն)', @$product->translate('ru')->description, ['class' => 'tm']) !!}
                        {!! BootForm::textarea('description_en', 'Նկարագրություն (Անգլերեն)', @$product->translate('en')->description, ['class' => 'tm']) !!}
                        {!! BootForm::submit('Edit'); !!}
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
            $('#photo').append('<div class="input-group"><span class="input-group-btn"><a id="lfm-'+iPhoto+'" data-input="thumbnail-'+ iPhoto + '" data-preview="holder-'+ iPhoto +'" class="btn btn-primary"><i class="fa fa-picture-o"></i> Choose</a></span><input id="thumbnail-' + iPhoto + '" class="form-control" type="text" value="" name="filepath[]"></div><img id="holder-'+iPhoto+'" style="margin-top:15px;max-height:100px;margin-bottom:25px;">');
            $('#lfm-'+iPhoto).filemanager('image', {prefix: route_prefix});
            iPhoto++;
        }
    </script>
@endpush
