
@php
      $img = json_decode($product->images);
      $origin = json_decode($product->origin);
      $discountPrice = $product->price - $product->price * $product->discount /100;
@endphp

<div class="product-item position-relative p-2 rounded bg-white h-100 box_shadow">
   @if ($product->discount > 0)
      <div class="sale-label sale-top-right position-absolute font-weight-bold">Giảm
            {{$product->discount}}%
      </div>
   @endif
   <a href="{{route('detailProduct', ['cate'=>$product->cate_slug, 'slug'=>$product->slug])}}" class="thumb d-block modal-open position-relative" title="{{languageName($product->name)}}">
         <div class="position-relative w-100 m-0 ratio1by1 has-edge aspect zoom">
         <img src="{{$img[0]}}" data-src="{{$img[0]}}" decoding="async" class="d-block img img-cover position-absolute lazy" alt="{{languageName($product->name)}}">
         </div>
         <span class="label_tag position-absolute d-inline-block pr-2 text-white d-flex align-items-center gap_5 rounded-10">
            @if (isset($product->hang_muc))
            <img width="20" height="20" alt="label_con_2" src="{{$product->hang_muc}}" class="mr-1" style="width: 100%;">
            @endif
         </span>
   </a>
   <div class="item-info mt-1 position-relative">
         <h3 class="item-title font-weight-bold">
         <a class="line_1" href="{{route('detailProduct', ['cate'=>$product->cate_slug, 'slug'=>$product->slug])}}" title="{{languageName($product->name)}}">
         {{languageName($product->name)}}
         </a>
         </h3>
         @if ($product->price > 0 && $product->discount > 0)
            <div class="item-price">
            <span class="special-price font-weight-bold">{{number_format($discountPrice, 0,'','.')}}₫</span>
            <del class="old-price"> {{number_format($product->price, 0,'','.')}}₫</del>
            </div>
         @elseif ($product->price > 0 && $product->discount == 0)
            <div class="item-price">
            <span class="special-price font-weight-bold">{{number_format($product->price, 0,'','.')}}₫</span>
            </div>
         @else
            <div class="item-price">
            <span class="special-price font-weight-bold">Liên hệ</span>
            </div>
         @endif
         @if ($product->price > 0)
            <form class="product-item_form position-absolute d-none d-md-block">
               <input type="hidden" name="variantId" value="{{$product->id}}">
               <button class="btn p-1 js-addToCart d-flex justify-content-center align-items-center rounded-circle play0 add_to_cart" data-url="{{route('addToCart')}}" title="Thêm vào giỏ" type="button">
                  <svg width="24" height="24">
                     <use href="#svg-cart"></use>
                  </svg>
               </button>
            </form>
         @endif
   </div>
</div>

