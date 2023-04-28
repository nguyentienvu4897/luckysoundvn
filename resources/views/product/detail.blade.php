@extends('layouts.main.master')
@section('title')
{{languageName($product->name)}}
@endsection
@section('description')
{{ strip_tags(languageName($product->description)) }}
@endsection
@section('image')
@php
$imgs = json_decode($product->images);
$discountPrice = $product->price - $product->price * $product->discount /100;
$preserve = json_decode($product->preserve);
@endphp
{{url(''.$imgs[0])}}
@endsection
@section('css')
<link rel="preload" as="style"  href="{{asset('frontend/css/swatch_style.scss.css')}}" type="text/css">
<link rel="preload" as="style"  href="{{asset('frontend/css/product_style.scss.css')}}" type="text/css">
<link href="{{asset('frontend/css/swatch_style.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
<link href="{{asset('frontend/css/product_style.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
@endsection
@section('js')
<script src="{{asset('frontend/js/mew_product.js')}}" defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@endsection
@section('content')
<div class="contentWarp ">
   <div class="breadcrumbs bg-white">
      <div class="container position-relative">
         <ul class="breadcrumb align-items-center m-0 pl-0 pr-0 small pt-2 pb-2 bg-white">
            <li class="home">
               <a href="{{route('home')}}" title="Trang chủ">
                  <svg width="12" height="10.633">
                     <use href="#svg-home" />
                  </svg>
                  Trang chủ
               </a>
               <span class="slash-divider ml-2 mr-2">/</span>
            </li>
            <li>
               <a href="{{route('allListProCate', ['cate'=>$product->cate_slug])}}" title="{{languageName($product->cate->name)}}">{{languageName($product->cate->name)}}</a>						
               <span class="slash-divider ml-2 mr-2">/</span>
            </li>
            <li ><span>{{languageName($product->name)}}</span>
            <li>
         </ul>
      </div>
   </div>
   <div itemscope itemtype="http://schema.org/Product">
      <div class="container mt-3 mb-3">
         <div class="rounded p-2 p-md-3 bg-white">
            <section class="product-layout product-layout2 ">
               <div class="row">
                  <div class="col-12 h_pr mb-3">
                     <h1 class="product-name font-weight-bold mb-2 d-inline-flex mr-3">{{languageName($product->name)}}</h1>
                  </div>
                  <div class="product-layout_col-left col-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 mb-3">
                     <div class="product-main-slide swiper-container mb-3">
                        <div class="swiper-wrapper">
                           @foreach ($imgs as $img)
                              <div class="swiper-slide ">
                                 <picture class="position-relative d-block aspect ratio1by1 modal-open rounded">
                                    <source media="(min-width: 1200px)" srcset="{{$img}}">
                                    <source media="(min-width: 575px)" srcset="{{$img}}">
                                    <img src="{{$img}}" alt="{{languageName($product->name)}}" class="d-block m-auto img position-absolute img-contain gradient-load" data-zoom-image="{{$img}}"/>
                                 </picture>
                              </div>
                           @endforeach
                           <div class="swiper-button-prev mew_product_main-slide_prev"></div>
                           <div class="swiper-button-next mew_product_main-slide_next"></div>
                        </div>
                     </div>
                     <div class="product-thumb-slide swiper-container ">
                        <div class="swiper-wrapper">
                           @foreach ($imgs as $img)
                              <div class="swiper-slide m_thumb_pl border rounded modal-open crp ">
                                 <div class="position-relative w-100 m-0 ratio1by1 aspect">
                                    <img src="{{$img}}" data-img="{{$img}}" alt="{{languageName($product->name)}}" class="d-block img position-absolute w-100 h-100">
                                 </div>
                              </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
                  <div class="product-layout_col-right col-12 col-sm-12 col-md-7 col-lg-7 col-xl-5 product-warp">
                     @if ($product->price > 0 && $product->discount > 0)
                        <div class="product-price font-weight-bold pt-2 pb-2 pl-3 pr-3 rounded mb-2">
                           <span class="special-price m-0">{{number_format($discountPrice, 0,'','.')}}₫</span>
                           <del class="old-price ml-2">{{number_format($product->price, 0,'','.')}}₫</del>
                        </div>
                     @elseif($product->price > 0 && $product->discount == 0)
                        <div class="product-price font-weight-bold pt-2 pb-2 pl-3 pr-3 rounded mb-2">
                           <span class="special-price m-0">{{number_format($product->price, 0,'','.')}}₫</span>
                        </div>
                     @else
                        <div class="product-price font-weight-bold pt-2 pb-2 pl-3 pr-3 rounded mb-2">
                           <span class="special-price m-0">Liên hệ</span>
                        </div>
                     @endif
                     <div class="list_pr_tag mb-2">
                        <div class="b_pr d-flex flex-wrap gap_8">
                           @if ($product->species)
                              <div class="item ">
                                 <a href="javascript:;" title="40mm" class="d-block rounded text-center small font-weight-bold px-3 py-2 h-100">
                                    <p class="tit_pr m-0">
                                       Đơn vị tính
                                    </p>
                                    <p class="price_pr m-0">
                                       {{$product->species}}
                                    </p>
                                 </a>
                              </div>
                           @endif
                           @if ($product->thickness)
                              <div class="item">
                                 <a href="javascript:;" title="44mm" class="d-block rounded text-center small font-weight-bold px-3 py-2 h-100">
                                    <p class="tit_pr m-0">
                                       Thời gian bảo hành
                                    </p>
                                    <p class="price_pr m-0">
                                       {{$product->thickness}} 
                                    </p>
                                 </a>
                              </div>
                           @endif
                        </div>
                     </div>
                     <form enctype="multipart/form-data">
                        <div id="o_sw_buy" class="mobile_open_box_swatch">
                           <div class="d-flex align-items-start flex-column">
                              <div class="product-control w-100">
                                 @if (json_decode($product->origin)[0]->title != '')
                                    <div class="header font-weight-bold mb-2">Phân loại</div>
                                    <div class="d-sm-flex align-items-center swatch-color mb-2 swatch clearfix flex-wrap" data-option-index="0" data-value="">
                                       @foreach (json_decode($product->origin) as $key=>$item)
                                       @if ($key == 0)
                                          <div data-value="{{$item->title}}" class="swatch-element color position-relative mb-2 mr-2 float-left ">
                                             <input id="swatch-0-den" class="position-absolute w-100 m-0" type="radio" name="option-type" value="{{$item->title}}" checked/>
                                             <div class="border rounded p-1 d-flex align-items-center dlabel">
                                                @if ($item->image != "")
                                                <label title="{{$item->title}}" for="swatch-0-den" class="sw-color-den m-0 bg_cl_none" style="background-image: url({{$item->image}});background-size: contain;background-repeat:no-repeat;background-position:center;background-color: #fff;"></label>
                                                @endif
                                                <small class="pl-1 pr-1 font-weight-bold">{{$item->title}}</small>
                                             </div>
                                             <div class="product-variation__tick position-absolute">
                                                <svg enable-background="new 0 0 12 12" class="icon-tick-bold">
                                                   <use href="#svg-tick" />
                                                </svg>
                                             </div>
                                          </div>
                                       @else
                                          <div data-value="{{$item->title}}" class="swatch-element color position-relative mb-2 mr-2 float-left ">
                                             <input id="swatch-0-trang" class="position-absolute w-100 m-0" type="radio" name="option-type" value="{{$item->title}}"/>
                                             <div class="border rounded p-1 d-flex align-items-center dlabel">
                                                @if ($item->image != "")
                                                <label title="{{$item->title}}" for="swatch-0-trang" class="sw-color-trang m-0 bg_cl_none" style="background-image: url({{$item->image}});background-size: contain;background-repeat:no-repeat;background-position:center;background-color: #fff;"></label>
                                                @endif
                                                <small class="pl-1 pr-1 font-weight-bold">{{$item->title}}</small>
                                             </div>
                                             <div class="product-variation__tick position-absolute">
                                                <svg enable-background="new 0 0 12 12" class="icon-tick-bold">
                                                   <use href="#svg-tick" />
                                                </svg>
                                             </div>
                                          </div>
                                       @endif
                                       @endforeach
                                    </div>
                                 @endif
                                 @if ($product->price > 0)
                                    <div class="product-quantity d-sm-flex align-items-center clearfix">
                                       <header class="font-weight-bold mb-2" style="min-width: 100px;">Số lượng </header>
                                       <div class="custom-btn-number form-inline border-0">
                                          <button class="mr-2 mb-2 border rounded bg-white justify-content-center align-items-center d-flex" onClick="var result = document.getElementById('qtym'); var qtypro = result.value; if( !isNaN( qtypro ) &amp;&amp; qtypro &gt; 1 ) result.value--;return false;" type="button">
                                             <svg width="12" height="12">
                                                <use href="#svg-minus" />
                                             </svg>
                                          </button>
                                          <button class="mr-2 mb-2 border rounded bg-white justify-content-center align-items-center d-flex" onClick="var result = document.getElementById('qtym'); var qtypro = result.value; if( !isNaN( qtypro )) result.value++;return false;" type="button">
                                             <svg width="14" height="14">
                                                <use href="#svg-plus" />
                                             </svg>
                                          </button>
                                          <input type="number"  name="quantity" min="1" value="1" class="form-control prd_quantity border rounded mb-2" id="qtym">
                                       </div>
                                    </div>
                                 @endif
                              </div>
                           </div>
                           <div class="pt-2 pb-2 mb-2 d-flex gap_8 mxs_100">
                           <input type="hidden" name="variantId" value="{{$product->id}}">
                              @if ($product->price > 0)
                                 <button type="button" class=" btn d-flex w-100 justify-content-center flex-column align-items-center rounded pt-2 pb-2 product-action_buynow sitdown modal-open position-relative buy-now" data-redirect="{{route('checkout')}}" data-url="{{route('addToCart')}}">
                                    <span class="text-uppercase font-weight-bold">Mua ngay</span>
                                    <small>(Giao tận nơi hoặc lấy tại cửa hàng)</small>
                                 </button>
                                 <button type="button" class=" mb-2 mb-lg-0 btn d-flex justify-content-center flex-column align-items-center rounded p-2 product-action_buy js-addToCart modal-open font-weight-bold position-relative add_to_cart" data-url="{{route('addToCart')}}">
                                    <svg width="20" height="20">
                                       <use href="#svg-shopping-cart" />
                                    </svg>
                                    <small class="ml-2 mr-2 button__text">Thêm vào giỏ</small>
                                 </button>
                              @else
                                 <button type="button" class=" btn d-flex w-100 justify-content-center flex-column align-items-center rounded pt-2 pb-2 product-action_buynow sitdown modal-open position-relative" onclick="window.localtion.href = 'tel:{{$setting->phone1}}'">
                                    <span class="text-uppercase font-weight-bold">Liên hệ ngay cho chúng tôi</span>
                                    <small>(Giao tận nơi hoặc lấy tại cửa hàng)</small>
                                 </button>
                              @endif
                           </div>
                        </div>
                        <div class="product-summary small mb-3">
                           {!!languageName($product->description)!!}
                        </div>
                     </form>
                  </div>
                  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 product-warp">
                     <div class="linehot_pro alert alert-warning mb-3 d-flex align-items-center rounded-10">
                        <img class="mr-3 lazy" alt="1900 123 321" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1681267458186" data-src="{{asset('frontend/images/customer-service.png')}}">
                        <div class="b_cont font-weight-bold">
                           <span class="d-block">
                           Gọi ngay <a href="tel:{{$setting->phone1}}" title="{{$setting->phone1}}">{{$setting->phone1}}</a> để được tư vấn tốt nhất!
                           </span> 
                        </div>
                     </div>
                     <div class="product-info position-relative mb-3 p-2 border rounded-10">
                        <span class="in_1">
                        Tình trạng:
                        <span class="inventory_quantity">{{$product->status == 1 ? 'Còn hàng' : ''}}</span>
                        </span>
                        <div class="in_1">
                           Thương hiệu: <span id="vendor">{{$product->brand->name}}</span>
                        </div>
                        <div class="in_1">Loại: <span id="type">{{languageName($product->typecate->name)}}</span></div>
                     </div>
                     @if ($preserve[0]->detail != '')
                     <div class="m_giftbox mb-3">
                        <fieldset class="free-gifts p-3 pb-4 pb-md-3 rounded position-relative">
                           <legend class="d-inline-block pl-3 pr-3 mb-0">
                              <img alt="Code Ưu Đãi" src="{{asset('frontend/images/gift.gif')}}"> Ưu Đãi Khi Mua Hàng
                           </legend>
                           <div class="row">
                              @foreach ($preserve as $item)
                                 <div class="col-12 col-md-6 col-lg-6 col-xl-12">
                                    <div class="item line_b pb-2 ">
                                       <span class="mb-2 d-block"><small style="font-weight:bold;">{{$item->detail}}</small>
                                       </span>
                                    </div>
                                 </div>
                              @endforeach
                              <div class="position-absolute vmore_c w-100 d-md-none">
                                 <a href="javascript:;" class="d-block v_more_coupon text-center font-weight-bold">
                                 <span class="t1">Xem thêm mã ưu đãi</span>
                                 <span class="t1 d-none">Thu gọn</span>
                                 </a>
                              </div>
                           </div>
                        </fieldset>
                     </div>
                     @endif
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4 col-lg-3 col-12 order-lg-2 mb-3">
                     <div class="p-2 box_shadow rounded-10 modal-open spec-tables">
                        <h3 class="special-content_title font-weight-bold d-block w-100 p-2 mb-2">Thông số kỹ thuật</h3>
                        <div class="border rounded-10 small modal-open">
                           <div class="special-content">
                              <table border="1" cellpadding="1" cellspacing="1">
                                 <tbody>
                                    @foreach (json_decode($product->size) as $item)
                                       <tr>
                                          <td style="font-weight:bold;">{{$item->title}}</td>
                                          <td>{{$item->detail}}</td>
                                       </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <a href="javascript:;" title="Xem chi tiết cấu hình" class="view_table box_shadow rounded-10 modal-open d-block p-2 small mb-2 mt-3 text-center font-weight-bold" data-bs-toggle="modal" data-bs-target="#specModal">Xem chi tiết cấu hình</a>
                     </div>
                  </div>
                  <div class="col-md-8 col-lg-9 col-12 order-lg-1">
                     <div class="p-2 box_shadow rounded-10 modal-open pl-lg-3 pr-lg-3 mb-3">
                        <h3 class="special-content_title font-weight-bold d-block w-100 pt-2 pb-2 mb-0">Thông tin chi tiết</h3>
                        <div class="product-content pt-2 pb-2 mewcontent">
                           <div class="content_coll position-relative rte">
                              {!!languageName($product->content)!!}
                              <div class="bg_cl position-absolute w-100"></div>
                           </div>
                           <div class="view_mores text-center mb-2">
                              <a href="javascript:;" class="one pt-2 pb-2 pl-4 pr-4 modal-open position-relative btn rounded-10 box_shadow font-weight-bold" title="Xem tất cả">Xem tất cả <img class="m_more" src="{{asset('frontend/images/sortdown.png')}}" alt="Xem tất cả"></a>
                              <a href="javascript:;" class="two pt-2 pb-2 pl-4 pr-4 modal-open position-relative btn rounded-10 box_shadow font-weight-bold d-none" title="Thu gọn">Thu gọn <img class="m_less" src="{{asset('frontend/images/sortdown.png')}}" alt="Thu gọn"></a>
                           </div>
                        </div>
                     </div>
                     @if ($productlq->count())
                     <div class="m_product p-2 box_shadow rounded-10 modal-open pl-lg-3 pr-lg-3">
                        <h3 class="special-content_title pb-2 pt-2 font-weight-bold position-relative mb-1">
                           <a class="position-relative" href="#" title="Sản phẩm liên quan">Sản phẩm liên quan</a>
                           <span class="swiper-button-prev mre_prev"></span>
                           <span class="swiper-button-next mre_next"></span>
                        </h3>
                        <div class="b_product p-1 swiper-container position-relative relate">
                           <div class="swiper-wrapper">
                              @foreach ($productlq as $product)
                              @php
                                 $imgs = json_decode($product->images);
                                 $discountPrice = $product->price - $product->price * $product->discount /100;
                              @endphp
                                 <div class="swiper-slide">
                                    <div class="product-item position-relative p-2 border rounded h-100">
                                       <div class="row">
                                          <div class="col-4 pr-0">
                                             @if ($product->discount > 0)
                                                <div class="sale-label sale-top-right position-absolute"><span class="font-weight-bold">-
                                                   {{$product->discount}}% 
                                                   </span>
                                                </div>
                                             @endif
                                             <a href="{{route('detailProduct', ['cate'=>$product->cate_slug, 'slug'=>$product->slug])}}" class="thumb d-block modal-open" title="{{languageName($product->name)}}">
                                                <div class="position-relative w-100 m-0 ratio1by1 has-edge aspect zoom">
                                                   <img src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1681267458186" data-src="{{$imgs[0]}}" decoding="async" class="d-block img img-cover position-absolute lazy" alt="{{languageName($product->name)}}">
                                                </div>
                                             </a>
                                          </div>
                                          <div class="item-info col-7 small">
                                             <h3 class="item-title font-weight-bold">
                                                <a class="d-block modal-open" href="{{route('detailProduct', ['cate'=>$product->cate_slug, 'slug'=>$product->slug])}}" title="{{languageName($product->name)}}">
                                                {{languageName($product->name)}} 
                                                </a>
                                             </h3>
                                             @if ($product->price > 0 && $product->discount > 0)
                                                <div class="item-price mb-1">
                                                   <span class="special-price font-weight-bold">{{number_format($discountPrice, 0,'','.')}}₫</span>
                                                   <del class="old-price"> {{number_format($product->price, 0,'','.')}}₫</del>
                                                </div>
                                             @elseif($product->price > 0 && $product->discount == 0)
                                                <div class="item-price mb-1">
                                                   <span class="special-price font-weight-bold">{{number_format($product->price, 0,'','.')}}₫</span>
                                                </div>
                                             @else
                                                <div class="item-price mb-1">
                                                   <span class="special-price font-weight-bold">Liên hệ</span>
                                                </div>
                                             @endif
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              @endforeach
                           </div>
                        </div>
                     </div>
                     <script>
                        window.addEventListener('DOMContentLoaded', (event) => {
                           var swiperRelateProduct = new Swiper('.b_product', {
                              spaceBetween: 10,
                              loop: false,
                              speed: 1000,
                              navigation: {
                                 nextEl: '.mre_next',
                                 prevEl: '.mre_prev',
                              },
                              slidesPerColumnFill: 'row',
                              slidesPerColumn: 2,
                              breakpoints: {
                                 320: {
                                    slidesPerView: 1
                                 },
                                 576: {
                                    slidesPerView: 1
                                 },
                                 768: {
                                    slidesPerView: 1
                                 },
                                 992: {
                                    slidesPerView: 2
                                 },
                                 1200: {
                                    slidesPerView: 3
                                 }
                              }
                           });
                        });
                     </script>
                     @endif
                  </div>
               </div>
            </section>
         </div>
      </div>
   </div>
   <div class="modal fade" id="specModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
         <div class="modal-content modal-open rounded-10">
            <div class="modal-header">
               <h5 class="modal-title fw-bold">Thông số kỹ thuật</h5>
               <button type="button" class="btn btn-close rounded-10" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body max-height-popup"></div>
         </div>
      </div>
   </div>
</div>
@endsection