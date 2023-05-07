@extends('layouts.main.master')
@section('title')
{{$title}}
@endsection
@section('description')
Danh sách {{$title}}
@endsection
@section('image')
{{url(''.$setting->logo)}}
@endsection
@section('js')
<script>
   var swiperBannerC = new Swiper('.banner_collection', {
   spaceBetween: 10,
   loop: true,
   speed:1000,
   autoplay: {
   delay: 5000,
   disableOnInteraction: true,
   },
   navigation: {
      nextEl: '.mbc_next',
      prevEl: '.mbc_prev',
   },
   breakpoints: {
   0: {
   slidesPerView: 2
   },
   576: {
   slidesPerView: 2
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
   $('.view_mores').on('click', 'a', function() {
	if( $(this).hasClass('one') ){
		$(this).addClass('d-none');
		$('.view_mores .two').removeClass('d-none');
	} else {
		$(this).addClass('d-none');
		$('.view_mores .one').removeClass('d-none');
	}
	$('.content_coll').toggleClass('active');
	$('.bg_cl').toggleClass('d-none');
   });
</script>
<script>
   $('.filter-item').click(function() {
      var price = $(this).find('input[name=price]').val();
      var brand = $(this).find('input[name=brand]').val();
      var sortby = $(this).find('input[name=sortBy]').val();
      var url = $('#menu-product-filter').data('url');
      var cate = $('#menu-product-filter .data-cate').data('cate');
      var type = $('#menu-product-filter .data-type').data('type');
      var combo = $('#menu-product-filter .data-combo').data('combo');
      var suggest = $('#menu-product-filter .data-suggest').data('suggest');
      console.log(price,brand,sortby,url,cate,type,combo);
      $.ajax({
         type: 'post',
         url: url,
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         data : {
            sortby : sortby,
            price : price,
            cate : cate,
            type : type,
            brand : brand,
            combo : combo,
            suggest : suggest,
         },
         success :function(data) {
            $('.category-products').html(data.html);
         }
      })
   })
</script>
@endsection
@section('css')
<link rel="preload" as="style"  href="{{asset('frontend/css/collection_style.scss.css')}}" type="text/css">
<link href="{{asset('frontend/css/collection_style.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
<link rel="preload" as="style"  href="{{asset('frontend/css/fonts.css')}}" type="text/css">
<link href="{{asset('frontend/css/fonts.css')}}" rel="stylesheet" type="text/css" media="all" />
@endsection
@section('content')
<div class="contentWarp ">
   <div class="opacity_filter"></div>
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
            <li > {{$title}}</li>
         </ul>
      </div>
   </div>
   <section class="collection-layout mt-3 mb-3">
      <div class="container">
         <div class="rounded p-2 p-md-3 bg-white">
            <div class="banner_collection mb-3 swiper-container position-relative">
               <div class="swiper-wrapper">
                  @foreach ($bannerSmall as $banner)
                  <div class="swiper-slide text-center effect-ming">
                     <a href="{{$banner->link}}" class="rounded modal-open position-relative w-100 m-0 ratio1by6 d-block aspect sitdown" title="{{$banner->title}}">
                     <img src="{{$banner->image}}" alt="{{$banner->title}}" class="d-block img img-cover position-absolute" />
                     </a>
                  </div>
                  @endforeach
               </div>
               <div class="swiper-button-prev mbc_prev d-none d-md-flex"></div>
               <div class="swiper-button-next mbc_next d-none d-md-flex"></div>
            </div>
            @if (isset($types))
               <div class="aside-content d-none d-lg-block bg-main rounded-10 mb-3">
                  <ul class="nav navbar-pills p-2">
                     @foreach ($types as $type)
                     <li class="nav-item position-relative {{ url()->current() == route('allListProType', ['cate'=>$type->cate_slug, 'type'=>$type->slug]) ? 'active' : '' }}">
                        <a title="Android" class="nav-link font-weight-bold text-white" href="{{route('allListProType', ['cate'=>$type->cate_slug, 'type'=>$type->slug])}}">{{languageName($type->name)}}</a>
                     </li>
                     @endforeach
                  </ul>
               </div>
            @endif
            <div class="row" id="menu-product-filter" data-url="{{route('filterProduct')}}">
               @if (isset($cate_id))
               <li class="d-none data-cate" data-cate="{{$cate_id}}"></li>
               @endif
               @if (isset($type_id))
               <li class="d-none data-type" data-cate="{{$type_id}}"></li>
               @endif
               @if (isset($combo_id))
               <li class="d-none data-combo" data-combo="{{$combo_id}}"></li>
               @endif
               @if (isset($suggest_id))
               <li class="d-none data-suggest" data-suggest="{{$suggest_id}}"></li>
               @endif
               <div class="col-12 col-lg-9 order-lg-2 pt-3 pt-lg-0">
                  <div class="sortPagiBar pb-2 border-bottom">
                     <ul class="aside-content filter-vendor list-unstyled mb-0 d-flex align-items-baseline gap-10">
                        <li>
                           <span class="h6 title-head m-0 pt-2 pb-2 font-weight-bold">Sắp xếp theo: </span>
                        </li>
                        <li class="filter-item filter-item--check-box">
                           <label class="d-flex align-items-baseline pt-1 pb-1 m-0">
                           <input type="radio" class="d-none sortby-default" name="sortBy" value="default">
                           <span class="fa2 px-2 py-1 rounded border">Mặc định</span> 
                           </label>
                        </li>
                        <li class="filter-item filter-item--check-box">
                           <label class="d-flex align-items-baseline pt-1 pb-1 m-0">
                           <input type="radio" class="d-none sortby-price-asc" name="sortBy" value="price-asc">
                           <span class="fa2 px-2 py-1 rounded border">Giá tăng dần</span> 
                           </label>
                        </li>
                        <li class="filter-item filter-item--check-box">
                           <label class="d-flex align-items-baseline pt-1 pb-1 m-0">
                           <input type="radio" class="d-none sortby-price-desc" name="sortBy" value="price-desc">
                           <span class="fa2 px-2 py-1 rounded border">Giá giảm dần</span> 
                           </label>
                        </li>
                        <li class="filter-item filter-item--check-box">
                           <label class="d-flex align-items-baseline pt-1 pb-1 m-0">
                           <input type="radio" class="d-none sortby-created-asc" name="sortBy" value="created-asc">
                           <span class="fa2 px-2 py-1 rounded border">Mới nhất </span> 
                           </label>
                        </li>
                     </ul>
                  </div>
                  <div class="collection">
                     <div class="category-products position-relative mt-3 mb-3">
                        <div class="row slider-items">
                           @foreach ($list as $product)
                           <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 product-grid-item-lm mb-3 ">
                              @include('layouts.product.item', ['product'=>$product])
                           </div>
                           @endforeach
                        </div>
                        <ul class="pagination d-flex justify-content-center clearfix mt-4 mb-4">
                           {{$list->links()}}
                        </ul>
                     </div>
                  </div>
                  @if (isset($content))
                  <div class="category-gallery pb-3 pt-3">
                     <div class="content_coll position-relative rte">
                        {!!$content!!}
                        <div class="bg_cl position-absolute w-100"></div>
                     </div>
                     <div class="view_mores text-center mb-2">
                        <a href="javascript:;" class="one pt-2 pb-2 pl-4 pr-4 modal-open position-relative btn rounded-10 box_shadow font-weight-bold" title="Xem tất cả">Xem tất cả <img class="m_more" src="{{asset('frontend/images/sortdown.png')}}" alt="Xem tất cả"></a>
                        <a href="javascript:;" class="two pt-2 pb-2 pl-4 pr-4 modal-open position-relative btn rounded-10 box_shadow font-weight-bold d-none" title="Thu gọn">Thu gọn <img class="m_less" src="{{asset('frontend/images/sortdown.png')}}" alt="Thu gọn"></a>
                     </div>
                  </div>
                  @endif
               </div>
               <div class="col-12 col-lg-3 order-lg-1">
                  <div class="sidebar sidebar_mobi m-0 p-2 p-lg-0 mt-lg-1 d-flex flex-column">
                     <div class="heading d-none">
                        <div class="h2 title-head font-weight-bold big text-uppercase mt-2 mb-0">
                           Bộ lọc sản phẩm
                        </div>
                        <p class="font-italic pt-2 pb-2 mb-0">Giúp lọc nhanh sản phẩm bạn tìm kiếm</p>
                     </div>
                     <div class="aside-filter mb-3 modal-open w-100 pr-0 pr-md-2 order-lg-3 clearfix">
                        <div class="filter-container row">
                           <aside class="aside-item filter-vendor mb-3 col-12 col-sm-4 col-lg-12">
                              <div class="h2 title-head m-0 pt-2 pb-2 font-weight-bold">Thương hiệu</div>
                              <div class="aside-content filter-group">
                                 <ul class="filter-vendor filter-grid list-unstyled m-0">
                                    @foreach ($brands as $key=>$item)
                                    <li class="filter-item filter-item--check-box  ">
                                       <label class="d-flex align-items-baseline m-0 apple" data-filter="apple" for="filter-{{$key}}">
                                       <input type="radio" id="filter-{{$key}}" class="d-none" name="brand" value="{{$item->id}}" >
                                       <span class="fa2 px-2 py-1 rounded border">{{$item->name}}</span>
                                       </label>
                                    </li>
                                    @endforeach
                                 </ul>
                              </div>
                           </aside>
                           <aside class="aside-item filter-tag-style-3 tag-filtster mb-3 col-12 col-sm-4 col-lg-12">
                              <div class="h2 title-head m-0 pt-2 pb-2 font-weight-bold">Lọc theo giá</div>
                              <div class="aside-content filter-group">
                                 <ul class="d-flex flex-wrap gap_8 list-unstyled m-0">
                                    <li class="filter-item filter-item--check-box">
                                       <label class="d-flex align-items-baseline m-0" for="2trieu">
                                       <input type="radio" id="2trieu" name="price" class="d-none" value="2" >
                                       <span class="fa2 px-2 py-1 rounded border">Dưới 2 triệu</span>
                                       </label>
                                    </li>
                                    <li class="filter-item filter-item--check-box">
                                       <label class="d-flex align-items-baseline m-0" for="2-5trieu">
                                       <input type="radio" id="2-5trieu" name="price" class="d-none" value="2-5" >
                                       <span class="fa2 px-2 py-1 rounded border">Từ 2 - 5 triệu</span>
                                       </label>
                                    </li>
                                    <li class="filter-item filter-item--check-box">
                                       <label class="d-flex align-items-baseline m-0" for="5-10trieu">
                                       <input type="radio" id="5-10trieu" name="price" class="d-none" value="5-10" >
                                       <span class="fa2 px-2 py-1 rounded border">Từ 5 - 10 triệu</span>
                                       </label>
                                    </li>
                                    <li class="filter-item filter-item--check-box">
                                       <label class="d-flex align-items-baseline m-0" for="10-20trieu">
                                       <input type="radio" id="10-20trieu" name="price" class="d-none" value="10-20" >
                                       <span class="fa2 px-2 py-1 rounded border">Từ 10 - 20 triệu</span>
                                       </label>
                                    </li>
                                    <li class="filter-item filter-item--check-box">
                                       <label class="d-flex align-items-baseline m-0" for="20-35trieu">
                                       <input type="radio" id="20-35trieu" name="price" class="d-none" value="20-35" >
                                       <span class="fa2 px-2 py-1 rounded border">Từ 20 - 35 triệu</span>
                                       </label>
                                    </li>
                                    <li class="filter-item filter-item--check-box">
                                       <label class="d-flex align-items-baseline m-0" for="35-50trieu">
                                       <input type="radio" id="35-50trieu" name="price" class="d-none" value="35-50" >
                                       <span class="fa2 px-2 py-1 rounded border">Từ 35 - 50 triệu</span>
                                       </label>
                                    </li>
                                    <li class="filter-item filter-item--check-box">
                                       <label class="d-flex align-items-baseline m-0" for="50-80trieu">
                                       <input type="radio" id="50-80trieu" name="price" class="d-none" value="50-80" >
                                       <span class="fa2 px-2 py-1 rounded border">Từ 50 - 80 triệu</span>
                                       </label>
                                    </li>
                                    <li class="filter-item filter-item--check-box">
                                       <label class="d-flex align-items-baseline m-0" for="80trieu">
                                       <input type="radio" id="80trieu" name="price" class="d-none" value="80" >
                                       <span class="fa2 px-2 py-1 rounded border">Trên 80 triệu</span>
                                       </label>
                                    </li>
                                 </ul>
                              </div>
                           </aside>
                        </div>
                     </div>
                     <div class="filter-container__selected-filter position-relative d-none order-lg-2 rounded-10 p-2 mb-3">
                        <div class="filter-container__selected-filter-header d-flex clearfix pt-1 pb-1">
                           <b class="filter-container__selected-filter-header-title text-white position-relative">Lọc theo:</b>
                        </div>
                        <ul class="filter-container__selected-filter-list pl-0 m-0 list-unstyled d-block w-100 position-relative clearfix"></ul>
                     </div>
                     <div class="aside-item mb-2 pt-2 order-3 d-none d-lg-block ">
                        <a class="h2 title-head font-weight-bold big text-uppercase d-inline-block mb-2 px-3 py-2 box_shadow position-relative" href="{{route('allListBlog')}}" title="Tin tức">
                        Tin tức
                        </a>
                        <div class="list-blogs">
                           @foreach ($homeBlog as $blog)
                           <article class="d-flex blog-item blog-item-list clearfix border-bottom pt-2 pb-2">
                              <div class="img_art thumb_img_blog_list">
                                 <a href="{{route('detailBlog',['slug'=>$blog->slug])}}" title="{{languageName($blog->title)}}" class="effect-ming">
                                    <div class="position-relative w-100 m-0 be_opa modal-open ratio3by2 has-edge aspect rounded">
                                       <img src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1681267458186" data-src="{{$blog->image}}" class="lazy d-block img img-cover position-absolute" alt="{{languageName($blog->title)}}">
                                    </div>
                                 </a>
                              </div>
                              <h3 class="blog-item-name pl-3 m-0 position-relative">
                                 <a class="line_3" href="{{route('detailBlog',['slug'=>$blog->slug])}}" title="{{languageName($blog->title)}}">{{languageName($blog->title)}}</a>
                              </h3>
                           </article>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
@endsection