<div class="row slider-items">
    @foreach ($products as $product)
    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 product-grid-item-lm mb-3 ">
    @include('layouts.product.item', ['product'=>$product])
    </div>
    @endforeach
</div>
<ul class="pagination d-flex justify-content-center clearfix mt-4 mb-4">
    {{-- {{$products->links()}} --}}
</ul>