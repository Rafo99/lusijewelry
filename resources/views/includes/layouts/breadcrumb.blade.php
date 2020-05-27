<div class="productsBanner">
    <div class="container-fluid">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">@lang('navigation.home')</a>&nbsp;&nbsp;</li>
                @if(isset($data['category']))
                    <li>/  <a href="{{ route('golden.show', $data['category']->id) }}">{{ $data['category']->getTranslation()->name }}&nbsp;&nbsp;</a></li>
                @endif
                @if(isset($data['product']))
                    <li>/  <a href="{{ route('product.show', $data['product']->id) }}">{{ $data['product']->getTranslation()->name }}&nbsp;&nbsp;</a></li>
                @endif
            </ol>
        </div>
    </div>
</div>
