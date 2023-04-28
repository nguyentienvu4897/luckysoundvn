@extends('layouts.main.master')
@section('title')
{{$setting->company}}
@endsection
@section('description')
{{$setting->webname}}
@endsection
@section('image')
{{url(''.$banners[0]->image)}}
@endsection
@section('css')
<link rel="preload" as="style"  href="{{asset('frontend/css/mew_style_index.scss.css')}}" type="text/css">
<link href="{{asset('frontend/css/mew_style_index.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
@endsection
@section('js')
@endsection
@section('content')
<div class="contentWarp ">
   <section class="mew_mobile_slide mb-4">
      <div class="mew_slide_main swiper-container">
         <div class="swiper-wrapper">
            @foreach ($banners as $banner)
            <div class="swiper-slide">
               <a class="d-none d-md-block w-100 h-100" href="{{$banner->link}}" title="{{$banner->title}}">
                     <picture class="position-relative w-100 m-0 ratio1by4 d-block aspect">
                     <source media="(min-width: 1200px)" srcset="{{$banner->image}}" loading="lazy">
                     <source media="(min-width: 992px)" srcset="{{$banner->image}}" loading="lazy">
                     <source media="(max-width: 569px)" srcset="{{$banner->image}}" loading="lazy">
                     <source media="(max-width: 480px)" srcset="{{$banner->image}}" loading="lazy">
                     <img class="d-block img img-cover position-absolute" src="{{$banner->image}}" alt="{{$banner->title}}" loading="lazy"/>
                     </picture>
               </a>
            </div>
            @endforeach
         </div>
      </div>
      <div class="container">
            <div class="mew_slide swiper-container position-relative">
            <div class="swiper-wrapper">
               @foreach ($bannerSmall as $item)
                  <div class="swiper-slide text-center">
                     <a class="d-block w-100 h-100 rounded-10 modal-open" href="{{$item->link}}" title="{{$item->title}}">
                           <picture class="position-relative w-100 m-0 ratio1by3 d-block aspect">
                           <source media="(min-width: 1200px)" srcset="{{$item->image}}" loading="lazy">
                           <source media="(min-width: 992px)" srcset="{{$item->image}}" loading="lazy">
                           <source media="(max-width: 569px)" srcset="{{$item->image}}" loading="lazy">
                           <source media="(max-width: 480px)" srcset="{{$item->image}}" loading="lazy">
                           <img class="d-block img img-cover position-absolute" src="{{$item->image}}" loading="lazy" alt="{{$item->title}}"/>
                           </picture>
                     </a>
                  </div>
               @endforeach
            </div>
            <div class="swiper-button-prev msl_prev"></div>
            <div class="swiper-button-next msl_next"></div>
            </div>
      </div>
   </section>
   <script rel="dns-prefetch">
      var swiperHomeSliderMain = new Swiper('.mew_slide_main', {
            spaceBetween: 10,
            loop: true,
            speed:1000,
            autoplay: {
               delay: 4000,
               disableOnInteraction: true,
            },
            breakpoints: {
               0: {
                  slidesPerView: 1,
                  effect: 'fade'
               },
               576: {
                  slidesPerView: 1,
                  effect: 'fade'
               },
               768: {
                  slidesPerView: 1
               },
               992: {
                  slidesPerView: 1
               },
               1200: {
                  slidesPerView: 1
               }
            }
      });
      var swiperHomeSlider = new Swiper('.mew_slide', {
            spaceBetween: 10,
            navigation: {
               nextEl: '.msl_next',
               prevEl: '.msl_prev',
            },
            loop: true,
            speed:1000,
            autoplay: {
               delay: 6000,
               disableOnInteraction: true,
            },
            breakpoints: {
               0: {
                  slidesPerView: 1,
                  effect: 'fade'
               },
               576: {
                  slidesPerView: 1,
                  effect: 'fade'
               },
               768: {
                  slidesPerView: 2
               },
               992: {
                  slidesPerView: 2
               },
               1200: {
                  slidesPerView: 2
               }
            }
      });
   </script>
   <section class="product_poli_wrap mt-3 mb-3">
      <div class="container">
            <div class="product_poli m-0">
            <div class="row">
               <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                  <div class="item d-flex align-items-center p-2 p-xl-3 bg-white rounded-10 modal-open h-100 ">
                        <div class="mr-2 mr-sm-3">
                        <img src="{{asset('frontend/images/img_poli_1.png')}}" alt="Bảo hành chính hãng" decoding="async">
                        </div>
                        <div class="media-body"> 
                        Bảo hành chính hãng
                        </div>
                  </div>
               </div>
               <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                  <div class="item d-flex align-items-center p-2 p-xl-3 bg-white rounded-10 modal-open h-100 ">
                        <div class="mr-2 mr-sm-3">
                        <img src="{{asset('frontend/images/img_poli_2.png')}}" alt="Chất lượng cam kết" decoding="async">
                        </div>
                        <div class="media-body"> 
                        Chất lượng cam kết
                        </div>
                  </div>
               </div>
               <div class="col-6 col-lg-3 ">
                  <div class="item d-flex align-items-center p-2 p-xl-3 bg-white rounded-10 modal-open h-100 ">
                        <div class="mr-2 mr-sm-3">
                        <img src="{{asset('frontend/images/img_poli_3.png')}}" alt="Dịch vụ vượt trội" decoding="async">
                        </div>
                        <div class="media-body"> 
                        Dịch vụ vượt trội
                        </div>
                  </div>
               </div>
               <div class="col-6 col-lg-3 ">
                  <div class="item d-flex align-items-center p-2 p-xl-3 bg-white rounded-10 modal-open h-100 ">
                        <div class="mr-2 mr-sm-3">
                        <img src="{{asset('frontend/images/img_poli_4.png')}}" alt="Giao hàng nhanh chóng" decoding="async">
                        </div>
                        <div class="media-body"> 
                        Giao hàng nhanh chóng
                        </div>
                  </div>
               </div>
            </div>
            </div>
      </div>
   </section>
   <section id="mew_cate_1" class="mew_cate_1 mt-3 mt-lg-4 mb-3 mt-lg-4">
      <div class="container">
            <div class="b_mew_cate rounded bg-white p-2 p-xl-3">
            <h3 class="title text-uppercase font-weight-bold position-relative pb-3 m-0">
               Danh mục nổi bật
            </h3>
            <div class="d-flex b_item flex-unset flex-md-wrap mobi_cate">
               @foreach ($typeCateHome as $cate)
                  <a href="{{route('allListProType', ['cate'=>$cate->cate_slug, 'type'=>$cate->slug])}}" title="{{languageName($cate->name)}}" class="item_cate d-flex align-items-center flex-column position-relative pt-2 rounded-10">
                     <div class="b_img modal-open">
                           <span class="position-relative w-100 m-0 ratio1by1 has-edge aspect d-block bg_fade">
                           <img class="d-block img img-cover position-absolute " alt="{{languageName($cate->name)}}" src="{{$cate->avatar}}" decoding="async">
                           </span>
                     </div>
                     <span class="tit pl-3 pr-3 mt-2 mb-2 text-center line_1 line_2">{{languageName($cate->name)}}</span>
                  </a>
               @endforeach
            </div>
            </div>
      </div>
   </section>
   <section id="flash_sale" class="m_product mt-3 mt-lg-4 mb-3 mt-lg-4" style="--cl_tit_fl: #ffd641;--bg_fl_1: #d70018;--bg_fl_2: #ff8a97;">
      <div class="container">
            <div class="rounded bg-flash modal-open p-2">
            <div class="time_box row align-items-center">
               <div class=" col-12 col-lg-9 mb-2 mb-lg-0">
                  <div class="row align-items-center">
                        <div class="col-12 col-lg-4">
                        <h2 class="title text-uppercase font-weight-bold position-relative p-2 m-0 text-center text-lg-left cl_tit_fl">
                           <a class="position-relative" href="{{route('flashSale')}}" title="FLASH SALE">
                           <img alt="FLASH SALE" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/flash.gif?1676652384879"> 
                           FLASH SALE
                           </a>
                        </h2>
                        </div>
                        <div class="col-12 col-lg-8">
                        </div>
                  </div>
               </div>
               <div class="ml-auto col-12 col-lg-3 text-center text-lg-right">
                  <div id="clock" data-end='{{$setting->fax}}' class="countdown-time-wrapper text-uppercase font-weight-bold position-relative pr-lg-2 mt-0 mb-0 mb-lg-1">
                        <div class="countdown-item rod position-relative text-white rounded d-inline-flex align-items-baseline justify-content-center modal-open">
                        <div class="countdown-time countdown-date mr-1 day position-relative">00</div>
                        <div class="countdown-text position-relative">ngày</div>
                        </div>
                        <div class="countdown-item rods text-white rounded d-inline-flex align-items-baseline justify-content-center modal-open position-relative">
                        <div class="countdown-time position-relative hour">00</div>
                        </div>
                        <div class="countdown-item rods text-white rounded d-inline-flex align-items-baseline justify-content-center modal-open position-relative">
                        <div class="countdown-time position-relative minute">00</div>
                        </div>
                        <div class="countdown-item rods text-white rounded d-inline-flex align-items-baseline justify-content-center modal-open position-relative">
                        <div class="countdown-time position-relative second">00</div>
                        </div>
                  </div>
                  <script>
                        function dateIsValid(t){return t instanceof Date&&!isNaN(t)}function dateDiff(t){let e=(t-(new Date).getTime())/1e3,n={};if(e<=0)return n;const a={day:86400,hour:3600,minute:60,second:1};return Object.keys(a).forEach(function(t){n[t]=String(Math.floor(e/a[t])).padStart(2,"0"),e-=n[t]*a[t]}),n}
                        
                        var countdown = setInterval(function () {
                           const clock = document.getElementById('clock');
                           const countDate = new Date(clock.dataset.end).getTime();
                           if (typeof(clock) == 'undefined' || clock == null){
                              console.log("Id đếm ngược không tồn tại!");
                              return false;
                           }
                           if(dateIsValid(countDate)){
                              console.log("Thời gian đếm ngược không hợp lệ!");
                              clock.classList.addClass('d-none');
                              return false;
                           }
                        
                           let now = new Date().getTime();
                           let diff = dateDiff(countDate);
                           
                           if (!Object.keys(diff).length){
                              console.log("Đếm ngược đã kết thúc!");
                              clock.classList.add('d-none');
                              clearInterval(countdown);
                              return false; 
                           }
                           clock.querySelector('.day').innerText = diff.day;
                           clock.querySelector('.hour').innerText = diff.hour;
                           clock.querySelector('.minute').innerText = diff.minute;
                           clock.querySelector('.second').innerText = diff.second;
                        }, 1000);
                  </script>
               </div>
            </div>
            @if (count($flashSale) > 0)
               <div class="row">
                  <div class=" col-12">
                     <div class="b_product">
                           <div class="mew_flash swiper-container p-2 position-relative">
                           <div class="swiper-wrapper">
                              @foreach ($flashSale as $product)
                                 <div class="swiper-slide">
                                    @include('layouts.product.item', ['product'=>$product])
                                 </div>
                              @endforeach
                           </div>
                           <div class="swiper-button-prev mf_prev"></div>
                           <div class="swiper-button-next mf_next"></div>
                           </div>
                     </div>
                  </div>
               </div>
            @endif
            </div>
      </div>
   </section>
   <script rel="dns-prefetch">
      var mew_text_fade = new Swiper('.mew_text_fade', {
            loop: true,
            speed:800,
            autoplay: {
               delay: 3000,
               disableOnInteraction: true,
            },
            slidesPerView: 1,
            effect: 'fade'
      });
      
      var swiperProductSaleSlider = new Swiper('.mew_flash', {
            spaceBetween: 18,
            loop: false,
            speed: 1000,
            autoplay: false,
            slidesPerColumnFill: 'row',
            slidesPerColumn: 2,
            navigation: {
               nextEl: '.mf_next',
               prevEl: '.mf_prev',
            },
            breakpoints: {
               320: {
                  slidesPerView: 2
               },
               768: {
                  slidesPerView: 3
               },
               992: {
                  slidesPerView: 3
               },
               1200: {
                  slidesPerView: 5
               }
            }
      });
   </script>
   <section id="product_2" class="m_product mt-3 mt-lg-4 mb-3 mt-lg-4">
      <div class="container">
            <div class="rounded bg-white p-2 js-tab-product">
            <div class="tab_link d-flex p-2 gap_8">
               @foreach ($promotion as $key=>$item)
               @if ($key==0)
                  <a class="border rounded-10 font-weight-bold js-tab-title active px-3 py-2 d-flex align-items-center gap_8" href="javascript:void(0);" data-tab="{{$item->id}}" data-url="{{route('ajaxTab')}}" title="{{$item->name}}">
                  <img class="lazy" decoding="async" src="{{$item->image}}"  data-src="{{$item->image}}" alt="{{$item->name}}">
                  {{$item->name}}
                  </a>
               @else
                  <a class="border rounded-10 font-weight-bold js-tab-title px-3 py-2 d-flex align-items-center gap_8" href="javascript:void(0);" data-tab="{{$item->id}}" data-url="{{route('ajaxTab')}}" title="{{$item->name}}">
                  <img class="lazy" decoding="async" src="{{$item->image}}"  data-src="{{$item->image}}" alt="{{$item->name}}">
                  {{$item->name}}
                  </a>
               @endif
               @endforeach
            </div>
            <div class="b_product position-relative">
               <div class="js-tab-content tab-item-1 d-block loaded">
                  @foreach ($promotion as $key=>$item)
                  @if ($key == 0)
                     <div class="mew_product_2 pb-2 pl-2 pr-2 pt-0 position-relative">
                           <div class="row">
                              @foreach ($item->products as $product)
                                 <div class="col-6 col-lg-3 col-xl-2 mt-3">
                                    @include('layouts.product.item', ['product'=>$product])
                                 </div>
                              @endforeach
                           </div>
                           <a class="view_mores box_shadow rounded-10 modal-open d-block py-2 px-3 mt-3 text-center font-weight-bold" href="{{route('suggestProduct', ['slug'=>$item->slug])}}" title="Xem tất cả">
                              Xem tất cả
                           </a>
                     </div>
                  @endif
                  @endforeach
               </div>
            </div>
            </div>
      </div>
   </section>
   <section id="mew_cate_2" class="mew_cate_2 mt-3 mt-lg-4 mb-3 mb-lg-4" style="--cl_tit_trending: #333;--bg_trending_1: #ffecd2;--bg_trending_2: #fcb69f;">
      <div class="container">
            <div class="mew_bts_cate rounded p-3">
            <h3 class="title text-uppercase font-weight-bold position-relative pb-3 m-0 cl_tit_trending">
               Combo sản phẩm
            </h3>
            <div class="m_trending m-0 combo-slide swiper-container position-relative">
               <div class="swiper-wrapper">
                  @foreach ($comboPro as $combo)
                     <div class="swiper-slide">
                           <a href="{{route('allProductCombo', ['slug'=>$combo->slug])}}" title="{{$combo->name}}" class="item_cate d-flex align-items-center flex-column position-relative bg-white rounded-10 p-3 h-100">
                           <div class="b_img d-flex align-items-center justify-content-space-between w-100">
                              <div class="item modal-open position-relative">
                                 <div class="position-relative w-100 m-0 ratio1by1 has-edge aspect">
                                       <img class="lazy d-block img img-cover position-absolute" alt="{{$combo->name}}" src="{{$combo->image}}" data-src="{{$combo->image}}">
                                 </div>
                              </div>
                           </div>
                           <div class="b_inf mt-2 w-100 pr-5 position-relative">
                              <p class="tit m-0 font-weight-bold">
                                 {{$combo->name}}
                              </p>
                              <svg width="24" height="24" class="position-absolute rounded-circle">
                                 <use href="#svg-right" />
                              </svg>
                           </div>
                           </a>
                     </div>
                  @endforeach
               </div>
            </div>
            </div>
            <script>
               var swiperHomeSliderMain = new Swiper('.combo-slide', {
                  spaceBetween: 10,
                  loop: true,
                  speed:1000,
                  autoplay: {
                     delay: 4000,
                     disableOnInteraction: true,
                  },
                  breakpoints: {
                     0: {
                        slidesPerView: 2,
                        effect: 'fade'
                     },
                     576: {
                        slidesPerView: 2,
                        effect: 'fade'
                     },
                     768: {
                        slidesPerView: 2
                     },
                     992: {
                        slidesPerView: 3
                     },
                     1200: {
                        slidesPerView: 4
                     }
                  }
               });
            </script>
      </div>
   </section>
   @foreach ($cateHome as $key=>$cate)
      @if ($key%2==0)
         <section id="product_3" class="m_product mt-3 mt-lg-4 mb-3 mt-lg-4">
            <div class="container">
                  <div class="rounded bg-white p-2">
                  <div class="head_box p-2 d-flex align-items-md-center justify-content-between flex-column flex-md-row">
                     <h2 class="title text-uppercase font-weight-bold position-relative m-0">
                        <a class="position-relative" href="{{route('allListProCate', ['cate'=>$cate->slug])}}" title="{{$cate->home_title}}">
                        {{$cate->home_title}}
                        </a>
                     </h2>
                     <div class="list_link_pr d-flex pt-2 pb-2">
                        @foreach ($cate->typeCate as $type)
                           <a class="border rounded-10 font-weight-bold js-tab-title" href="{{route('allListProType',['cate'=>$type->cate_slug, 'type'=>$type->slug])}}" data-tab="galaxy-ford" data-alias={{route('allListProType',['cate'=>$type->cate_slug, 'type'=>$type->slug])}} title="{{languageName($type->name)}}">
                                 <div>
                                 </div>
                                 {{languageName($type->name)}}
                           </a>
                        @endforeach
                     </div>
                  </div>
                  <div class="row align-items-lg-center">
                     <div class="col-xl-9 col-lg-8 col-12 pl-lg-0 order-lg-2 ">
                        <div class="mew_product_3 swiper-container p-2 position-relative">
                              <div class="swiper-wrapper">
                                 @foreach ($cate->products as $product)
                                    <div class="swiper-slide">
                                       @include('layouts.product.item', ['product'=>$product])
                                    </div>
                                 @endforeach
                              </div>
                              <div class="swiper-button-prev mf_prev"></div>
                              <div class="swiper-button-next mf_next"></div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-lg-4 col-12 order-lg-1">
                        <div class="b_product p-2 pr-lg-0 d-flex flex-lg-column">
                              <a href="{{$cate->path_1}}" title="{{languageName($cate->name)}}" class="rounded modal-open position-relative w-100 w-mb-50 ratio1by1 has-edge aspect d-block sitdown">
                              <img class="d-block img img-cover position-absolute lazy" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{$cate->banner_1}}" alt="{{languageName($cate->name)}}">
                              </a>
                              <a href="{{$cate->path_2}}" title="{{languageName($cate->name)}}" class="rounded modal-open position-relative w-100 w-mb-50 ratio1by1 has-edge aspect d-block sitdown">
                              <img class="d-block img img-cover position-absolute lazy" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{$cate->banner_2}}" alt="{{languageName($cate->name)}}">
                              </a>
                        </div>
                     </div>
                  </div>
                  </div>
            </div>
         </section>
         <script rel="dns-prefetch">
            var swiperProduct3Slider = new Swiper('.mew_product_3', {
                  spaceBetween: 15,
                  loop: false,
                  speed: 1000,
                  autoplay: false,
                  navigation: {
                     nextEl: '.mf_next',
                     prevEl: '.mf_prev',
                  },
                  breakpoints: {
                     320: {
                        slidesPerView: 2,
                     },
                     768: {
                        slidesPerView: 2
                     },
                     992: {
                        slidesPerView: 3,
                        slidesPerColumnFill: 'row',
                        slidesPerColumn: 2
                     },
                     1200: {
                        slidesPerView: 4,
                        slidesPerColumnFill: 'row',
                        slidesPerColumn: 2
                     }
                  }
            });
         </script>
      @else
         <section id="product_4" class="m_product mt-3 mt-lg-4 mb-3 mt-lg-4">
            <div class="container">
                  <div class="rounded bg-white p-2">
                  <div class="head_box p-2 d-flex align-items-md-center justify-content-between flex-column flex-md-row">
                     <h2 class="title text-uppercase font-weight-bold position-relative m-0">
                        <a class="position-relative" href="{{route('allListProCate', ['cate'=>$cate->slug])}}" title="{{$cate->home_title}}">
                        {{$cate->home_title}}
                        </a>
                     </h2>
                     <div class="list_link_pr d-flex pt-2 pb-2">
                        @foreach ($cate->typeCate as $type)
                           <a class="border rounded-10 font-weight-bold" href="{{route('allListProType',['cate'=>$type->cate_slug, 'type'=>$type->slug])}}" title="{{languageName($type->name)}}">{{languageName($type->name)}}</a>
                        @endforeach
                     </div>
                  </div>
                  <div class="row align-items-lg-center">
                     <div class="col-xl-9 col-lg-8 col-12 pr-lg-0">
                        <div class="mew_product_4 swiper-container p-2 position-relative">
                              <div class="swiper-wrapper">
                                 @foreach ($cate->products as $product)
                                 <div class="swiper-slide">
                                    @include('layouts.product.item', ['product'=>$product])
                                 </div>
                                 @endforeach
                              </div>
                              <div class="swiper-button-prev mf_prev"></div>
                              <div class="swiper-button-next mf_next"></div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-lg-4 col-12">
                        <div class="b_product p-2 pr-lg-0 d-flex flex-lg-column">
                              <a href="{{$cate->path_1}}" title="{{languageName($cate->name)}}" class="rounded modal-open position-relative w-100 w-mb-50 ratio1by1 has-edge aspect d-block sitdown">
                              <img class="d-block img img-cover position-absolute lazy" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{$cate->banner_1}}" alt="{{languageName($cate->name)}}">
                              </a>
                              <a href="{{$cate->path_2}}" title="{{languageName($cate->name)}}" class="rounded modal-open position-relative w-100 w-mb-50 ratio1by1 has-edge aspect d-block sitdown">
                              <img class="d-block img img-cover position-absolute lazy" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{$cate->banner_2}}" alt="{{languageName($cate->name)}}">
                              </a>
                        </div>
                     </div>
                  </div>
                  </div>
            </div>
         </section>
         <script rel="dns-prefetch">
            var swiperProduct4Slider = new Swiper('.mew_product_4', {
                  spaceBetween: 15,
                  loop: false,
                  speed: 1000,
                  autoplay: false,
                  navigation: {
                     nextEl: '.mf_next',
                     prevEl: '.mf_prev',
                  },
                  breakpoints: {
                     320: {
                        slidesPerView: 2
                     },
                     768: {
                        slidesPerView: 2
                     },
                     992: {
                        slidesPerView: 3,
                        slidesPerColumnFill: 'row',
                        slidesPerColumn: 2
                     },
                     1200: {
                        slidesPerView: 4,
                        slidesPerColumnFill: 'row',
                        slidesPerColumn: 2
                     }
                  }
            });
         </script>
      @endif
   @endforeach
   <section id="product_5" class="m_product mt-3 mt-lg-4 mb-3 mt-lg-4">
      <div class="container">
            <div class="rounded bg-white p-2">
            <div class="b_product p-2">
               <a href="{{$bannerAds->name}}" title="{{$bannerAds->name}}" class="rounded modal-open position-relative w-100 ratio1by12 has-edge aspect d-block sitdown">
               <img class="d-block img img-cover position-absolute lazy" src="{{$bannerAds->image}}" data-src="{{$bannerAds->image}}" alt="banner-quang-cao">
               </a>
            </div>
            </div>
      </div>
   </section>
   <section id="video" class="m_blog mt-3 mt-lg-4 mb-3 mb-lg-4">
      <div class="container">
            <div class="rounded bg-white p-3">
            <h2 class="title text-uppercase font-weight-bold position-relative pb-2 pb-lg-3 m-0">
               <a class="position-relative" href="mew-reviews" title="Cùng Mew review">Cùng Lucky Sound review</a>
            </h2>
            <div class="b_product">
               <div class="mew_video swiper-container position-relative">
                  <div class="swiper-wrapper">
                     @foreach ($videos as $video)
                        <div class="swiper-slide">
                        <div class="item_grid mb-3">
                           <div class="img_thm position-relative bor-10 modal-open">
                              <a href="javascript:;" data-video="{{$video->link}}" class="effect-ming open_video" title="{{$video->name}}">
                                    <div class="position-relative w-100 m-0 be_opa modal-open ratio3by2 has-edge aspect">
                                    <img src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{$video->image}}" class="d-block img img-cover position-absolute lazy" alt="{{$video->name}}">
                                    <div class="position-absolute w-100 h-100 video_open lazy_bg" data-video="{{$video->link}}" data-background="url({{asset('frontend/images/play-button.png')}})"></div>
                                    </div>
                              </a>
                           </div>
                           <h3 class="title_blo font-weight-bold mt-2"><a class="line_2" href="{{route('reviewCus', ['slug'=>$video->slug])}}" title="{{$video->name}}">{{$video->name}}</a></h3>
                        </div>
                        </div>
                     @endforeach
                  </div>
                  <div class="swiper-button-prev mv_prev"></div>
                  <div class="swiper-button-next mv_next"></div>
               </div>
               <div class="popup_video position-fixed w-100 h-100 justify-content-center align-items-center d-flex">
                  <div class="position-relative max-100">
                        <a href="javascript:;" class="close_video position-absolute d-flex m_white_bg_module justify-content-center align-items-center" title="Đóng"><img alt="Đóng" class="lazy" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{asset('frontend/images/close.png')}}"></a>
                        <div class="b_video p-2 p-md-3 m_white_bg_module rounded m-auto"></div>
                  </div>
               </div>
            </div>
            </div>
      </div>
   </section>
   <script rel="dns-prefetch">
      var swiperVideoSlider = new Swiper('.mew_video', {
            spaceBetween: 15,
            loop: false,
            speed: 1000,
            autoplay: false,
            navigation: {
               nextEl: '.mv_next',
               prevEl: '.mv_prev',
            },
            breakpoints: {
               375: {
                  slidesPerView: 1.2
               },
               768: {
                  slidesPerView: 2.3
               },
               992: {
                  slidesPerView: 3
               },
               1200: {
                  slidesPerView: 4
               }
            }
      });
   </script>
   <section id="m_blog" class="m_blog mt-3 mt-lg-4 mb-3 mb-lg-4">
      <div class="container">
            <div class="rounded bg-white p-3">
            <div class="b_blog row">
               @foreach ($homeCateBlog as $cate)
                  <div class="col-12 col-md-6">
                     <h2 class="title text-uppercase font-weight-bold position-relative pb-2 pb-lg-3 m-0">
                        <a class="position-relative" href="{{route('allListBlog'). '?type=#'. $cate->slug}}" title="{{languageName($cate->name)}}">
                        {{languageName($cate->name)}}
                        </a>
                     </h2>
                     @foreach ($cate->listBlog as $key=>$blog)
                        <article class="blog-item-list clearfix mb-3 row">
                              <div class="col-4 col-lg-3 pr-0 ">
                              <a href="{{route('detailBlog', ['slug'=>$blog->slug])}}" class=" d-block modal-open thumb_img_blog_list thumb rounded" title="{{languageName($blog->title)}}"> 
                              <span class="modal-open position-relative d-block w-100 m-0 ratio3by2 has-edge aspect zoom">
                              <img src="{{$blog->image}}" data-src="{{$blog->image}}" decoding="async" alt="{{languageName($blog->title)}}" class="lazy d-block img img-cover position-absolute">
                              </span>
                              </a>
                              </div>
                              <div class="blogs-rights col-8 col-lg-9">
                              <h3 class="blog-item-name font-weight-bold mb-1 title_blo">
                                 <a class="line_1" href="{{route('detailBlog', ['slug'=>$blog->slug])}}" title="{{languageName($blog->title)}}">{{languageName($blog->title)}}</a>
                              </h3>
                              <div class="post-time small">{{date('d/m/Y', strtotime($blog->created_at))}}</div>
                              <div class="sum line_2 h-auto text-justify">
                                 {{languageName($blog->description)}}
                              </div>
                              </div>
                        </article>
                     @endforeach
                     <div class="d-block mt-auto text-center">
                           <a href="{{route('allListBlog'). '?type=#'. $cate->slug}}" title="Xem thêm" class="view_mores box_shadow rounded-10 modal-open d-block py-2 px-3 mt-3 text-center font-weight-bold">Xem thêm</a>
                     </div>
                  </div>
               @endforeach
            </div>
            </div>
      </div>
   </section>
</div>
@endsection