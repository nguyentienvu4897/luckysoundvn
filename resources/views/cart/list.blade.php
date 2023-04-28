@extends('layouts.main.master')
@section('title')
Giỏ hàng của bạn
@endsection
@section('description')
@endsection
@section('image')
{{url(''.$banners[0]->image)}}
@endsection
@section('css')
<link rel="preload" as="style"  href="{{asset('frontend/css/cart_style.scss.css')}}" type="text/css">
<link href="{{asset('frontend/css/cart_style.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
@endsection
@section('js')
<script>
   function btnMinus(e) {
      var id = e;
      var result = document.getElementById('qty'+id); var qtypro = result.value; if( !isNaN( qtypro ) && qtypro > 1 ) result.value--;
      var quantity = result.value;
      var url = $('.data-update-cart').data('url');
      $.ajax({
         type:'post',
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         url:url,
         data: {id:id, quantity:quantity},
         success: function(data) {
            $('.js-cart-content').html(data.html);
         }
      })
   }
   function btnPlus(e) {
      var id = e;
      var result = document.getElementById('qty'+id); var qtypro = result.value; if( !isNaN( qtypro )) result.value++;
      var quantity = result.value;
      var url = $('.data-update-cart').data('url');
      $.ajax({
         type:'post',
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         url:url,
         data: {id:id, quantity:quantity},
         success: function(data) {
            $('.js-cart-content').html(data.html);
         }
      })
   }
   function removeItemCart(e) {
      var id = e
      var url = $('.js-remove-item-cart').data('url');
      $.ajax({
         type: 'get',
         url:url,
         data: {id:id},
         success: function(data) {
            $('.js-cart-content').html(data.html1);
            $('.btn-cart-indicator').html(data.html2);
         }
      })
   }
   function removeAllCart(url) {
      var url = url;
      $.ajax({
         type: 'get',
         url:url,
         success: function(data) {
            $('.js-cart-content').html(data.html1);
            $('.btn-cart-indicator').html(data.html2);
         }
      })
   }
</script>
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
            <li>Giỏ hàng</li>
         </ul>
      </div>
   </div>
   <section class="cart-layout mt-3 mb-3">
      <div class="container" style="min-height: 350px">
         <div class="rounded p-2 p-md-3 bg-white">
            <h1 class="cart-name font-weight-bold text-uppercase pb-2 pt-2 mb-2">
               Giỏ hàng
            </h1>
            <div class="js-cart-content">
               @if (count($cartcontent) > 0)
                  <div class="row js-cart data-update-cart" data-url="{{route('updateCart')}}">
                     <div class="basket cart__basket col-md-8">
                        @php
                           $totalPrice = 0;
                        @endphp
                        @foreach ($cartcontent as $item)
                        @php
                           $discountPrice = $item['price'] - $item['price'] * $item['discount'] / 100;
                           $totalPrice += $discountPrice * $item['quantity'];
                           $preserve = json_decode($item['preserve']);
                        @endphp
                           <div class="ux-card mb-4">
                              <div class="d-flex cart__basket__item product rounded mb-4 position-relative clearfix">
                                 <img src="{{$item['image']}}" class="js-img position-absolute" alt="{{languageName($item['name'])}}">
                                 <div class="col-12 d-flex p-0">
                                    <p class="item-title clearfix mb-2">
                                       <a href="#" title="{{languageName($item['name'])}}" class="js-titlte font-weight-bold">{{languageName($item['name'])}}</a>
                                       @if (isset($item['type']))
                                       <span class="js-variant-titlte d-block">{{$item['type']}}</span>
                                       @endif
                                    </p>
                                    <span class="js-price price font-weight-bold ml-auto text-right clearfix">{{number_format($discountPrice,0,'','.')}}&nbsp;₫</span>
                                 </div>
                                 <div class="js-number-input number-input d-inline-flex rounded">
                                    <button class="position-relative m-0 border-0 step-down-qty js-step-qty" onclick="btnMinus({{$item['id']}})"></button>
                                    <input class="js-quantity text-center" readonly="" min="1" id="qty{{$item['id']}}" name="quantity" value="{{$item['quantity']}}" size="2" type="number">
                                    <button class="position-relative m-0 border-0 step-up-qty js-step-qty plus" onclick="btnPlus({{$item['id']}})"></button>
                                 </div>
                                 <button class="btn btn-outline-danger remove ml-auto js-remove-item-cart" data-url="{{route('removeCart')}}" onclick="removeItemCart({{$item['id']}})" title="Xoá">Xoá</button>
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
                        @endforeach
                     </div>
                     <div class="summary cart__summary col-md-4">
                        <dl class="total mb-4 p-3 d-flex align-items-center clearfix flex-wrap justify-content-end rounded">
                           <dt class="text-uppercase font-weight-bold roun">Tổng tiền</dt>
                           <dd class="cart__summary_total font-weight-bold ml-auto mb-0">{{number_format($totalPrice,0,'','.')}}&nbsp;₫</dd>
                        </dl>
                        <a class="btn btn-block btn-checkout btn-danger rounded mb-3 text-uppercase font-weight-bold pt-3 pb-3" href="{{route('checkout')}}" role="button">Thanh toán</a>
                        <hr>
                        <a class="btn btn-block btn-clearcart js-clearcart btn-dark rounded w-100 font-weight-bold mb-4 remove-item-cart" href="javascript:;" onclick="removeAllCart('{{route('removeCartAll')}}')" role="button" title="Xoá tất cả">Xoá tất cả</a>
                     </div>
                  </div>
               @else
                  <div class="row cart__empty">
                     <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">Không có sản phẩm nào. Quay lại <a href="{{route('home')}}" class="alert-link">cửa hàng</a> để tiếp tục mua sắm.</div>
                     </div>
                  </div>
               @endif
            </div>
         </div>
      </div>
   </section>
</div>
@endsection