<div class="mew_product_2 pb-2 pl-2 pr-2 pt-0 position-relative">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-6 col-lg-3 col-xl-2 mt-3">
                @include('layouts.product.item', ['product'=>$product])
            </div>
        @endforeach
    </div>
    <a class="view_mores box_shadow rounded-10 modal-open d-block py-2 px-3 mt-3 text-center font-weight-bold" href="{{route('suggestProduct', ['slug'=>$suggest->slug])}}" title="Xem tất cả">
        Xem tất cả
    </a>
</div>
