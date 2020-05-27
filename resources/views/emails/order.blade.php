@component('mail::message')

    <h1>Նոր Պատվեր!</h1>

    <ul style="listing-style:none;">
        <li>Անուն: {{ $order->name }}</li>
        <li>Ազգանուն: {{ $order->last_name }}</li>
        <li>Հեռախոսահամար: {{ $order->phone }}</li>
        <li>Ընդհանուր: {{ $total }} AMD</li>
    </ul>


    <h3>Ապրանքներ</h3>
    <?php if (is_array($order->products)){ ?>
    <ul>
        @foreach($order->products as $product)
            <li>
                Ապրանքի Անուն: <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a><br>
                Ապրանքի SKU: {{ $product->sku }} <br>
                Ապրանքի Քանակ: {{ $product->qty }} <br>
                Ապրանքի Գին: {{ $product->price }} <br>
            </li>
        @endforeach
    </ul>
    <?php } ?>

    Հարգանքներով՝<br>
    {{ config('app.name') }}


@endcomponent