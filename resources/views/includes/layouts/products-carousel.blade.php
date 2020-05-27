<div class="top-populars">
    <div class="container">
        <div class="row">
            <h2 class="marg0a">Most Popular Jewelries</h2>
            <div class="owl-carousel">
                @foreach($boosted as $product)
                    <div class="top-product">
                        <a href="{{ route('product.show', $product->id) }}"><img src="{{ route('show.thumb', $product->picture) }}"
                                                                                 alt=""></a>
                        <a href="{{ route('product.show', $product->id) }}"><h2
                                    class="productTitle align-center">{{ $product->getTranslation()->name }}</h2></a>
                        <div class="productDescription">
                            <p class="description align-center">Description</p>
                        </div>
                        <div class="productPrice align-center">
                            <img src="{{ asset('demo/tag.png') }}" alt="" style="width: 24px; display: inline-block; margin: 0 5px"><span>from </span><span>{{ $product->price }}$</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>