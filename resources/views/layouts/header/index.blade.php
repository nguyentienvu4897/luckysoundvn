<div class="menubar w-100 text-right d-flex d-lg-none position-fixed align-items-center scroll_down ">
<a href="{{route('home')}}" title="{{$setting->company}}" class="mr-auto ml-3">
<img alt="{{$setting->company}}" src="{{$setting->logo_mobile}}" class="img-fluid mb_logo">
</a> 
</div>
<div class="bg_head position-fixed w-100 scroll_down "></div>
<div class="col-left position-fixed d-flex flex-column pt-2 pb-2">
<div class="container position-relative">
<div class="row align-items-center">
      <div class="col-12 col-lg-2 d-none d-lg-block">
            <a href="{{route('home')}}" title="{{$setting->company}}" class="logo">
            <img alt="{{$setting->company}}" src="{{$setting->logo}}" class="img-fluid">
            </a> 
      </div>
      <div class="col-12 col-lg-10">
            <div class="d-lg-flex align-items-center position-static pr-menu">
            <div class="mr-2 mr-xl-3 level0 position-relative cls">
            <a href="{{route('lienHe')}}" title="Hệ thống cửa hàng" class="align-items-center d-flex head_svg p-1 pl-xl-2 pr-xl-2 rounded-10">
            <small>Hệ thống cửa hàng
            <b class="d-block">({{count($chiNhanh)}} chi nhánh)</b>
            </small>
            </a>
            </div>
            <div class="search-block mr-3">
            <form action="{{route('search_result')}}" method="post" class="js-search-form left-search position-relative mt-4 mt-lg-0 pt-2 pb-2 pt-lg-1 pb-lg-1">
                  @csrf
                  <input type="text" id="js-search-form" placeholder="Từ khoá..." value="" maxlength="70" name="keyword" class="rounded form-control pl-2 pl-lg-3 pr-5" autocomplete="off" required>
                  <input type="submit" class="border-0 position-absolute p-0">
            </form>
            </div>
            <div class="blog-block">
            <div class="blog_head text-center d-flex align-items-center">
                  <a class="pl-2 pl-xl-3 pr-2 pr-xl-3 d-inline-block position-relative" href="{{route('aboutUs')}}" title="Giới thiệu">Giới thiệu <br></a>
                  <a class="pl-2 pl-xl-3 pr-2 pr-xl-3 d-inline-block position-relative" href="{{route('allListBlog')}}" title="Tin Tức">Tin Tức <br></a>
            </div>
            </div>
            <div class="info-block mr-3 ml-3">
            <a href="tel:{{$setting->phone1}}" title="{{$setting->phone1}}" class="align-items-center d-flex">
                  <span class="play0 d-none d-xl-block">
                        <svg width="32" height="32">
                        <use href="#svg-phone" />
                        </svg>
                  </span>
                  <b><small>Gọi mua hàng</small> <br>{{$setting->phone1}}</b>
            </a>
            </div>
            <div class="navigation-bottom mt-auto mt-lg-0">
            <div class="b_use d-none d-lg-flex align-items-stretch">
                  <a class="p-1 btn-cart position-relative d-inline-flex head_svg justify-content-center align-items-center rounded-10" title="Giỏ hàng" href="{{route('listCart')}}">
                        <span class="b_ico_Cart text-center d-flex justify-content-center align-items-center position-relative">
                        <svg width="20" height="20" >
                        <use href="#svg-cart" />
                        </svg>
                        @if (count($cartcontent) > 0)
                        <span class="btn-cart-indicator position-absolute font-weight-bold text-center text-white">{{count($cartcontent)}}</span>
                        @else
                        <span class="btn-cart-indicator position-absolute d-none font-weight-bold text-center text-white"></span>
                        @endif
                        </span>
                        <small class="d-none d-xl-block ml-lg-1">Giỏ hàng</small>
                  </a>
            </div>
            </div>
            </div>
      </div>
</div>
</div>
</div>
<div class="navigation-block mr-lg-auto d-none d-lg-block">
<div class="container">
      <ul id="menu_pc" class="p-0 m-0 list-unstyled position-relative d-lg-flex">
            @foreach ($categoryhome as $cate)
            <li class="level0 position-relative cls pt-1 pt-lg-2 pb-lg-2 pb-1 ">
                  <a href="{{route('allListProCate', ['cate'=>$cate->slug])}}" title="{{languageName($cate->name)}}" class="font-weight-bold d-block pt-1 pb-1 pl-lg-3 pr-4 js-checkMenu position-relative ">
                  {{languageName($cate->name)}}
                  @if (count($cate->typeCate) > 0)
                        <i class="down_icon align-items-center justify-content-center position-absolute d-none d-lg-block mg"></i>
                  @endif
                  </a>
                  @if (count($cate->typeCate) > 0)
                        <i class="js-submenu down_icon d-flex align-items-center justify-content-center position-absolute d-lg-none"></i>
                        <ul class="lv1 list-group p-0 list-unstyled rounded">
                              @foreach ($cate->typeCate as $type)
                                    <li class="no level1 pr-lg-2  pl-2 position-relative cls">
                                    <a href="{{route('allListProType', ['cate'=>$type->cate_slug, 'type'=>$type->slug])}}" class="pt-1 pb-1 pr-4 position-relative  js-checkMenu" title="{{languageName($type->name)}}">
                                    {{languageName($type->name)}}
                                    </a>
                                    </li>
                              @endforeach
                        </ul>
                  @endif
            </li>
            @endforeach
      </ul>
</div>
</div>
<div class="col-left position-fixed d-flex flex-column pt-lg-2 pb-lg-2 pt-0 pb-0 d-lg-none" id="col-left-mew">
<div class="align-items-center menu_mobile h-100 position-relative">
<ul id="menu-mew" class="p-0 m-0 list-unstyled d-lg-flex justify-content-lg-end">
      @foreach ($categoryhome as $cate)
      @if (count($cate->typeCate) > 0)
      <li class="level0 d-block w-100 position-static">
            <a title="{{languageName($cate->name)}}" class="position-relative d-flex js-submenu flex-column justify-content-center align-items-center text-center p-2">
            <img class="lazy d-block pb-2 m-auto" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{$cate->avatar}}" alt="{{languageName($cate->name)}}">
            <span class="line_1 line_2">{{languageName($cate->name)}}</span>
            </a>
            <ul class="lv1 p-0 list-unstyled position-absolute m_chill m-0">
            <li class="level1 main position-sticky bg-white">
            <a href="{{route('allListProCate', ['cate'=>$cate->slug])}}" class="font-weight-bold d-flex pt-2 pb-2 border-bottom align-items-center w-100 justify-content-center text-main" title="Chi tiết danh mục">
            Chi tiết danh mục
            </a>
            </li>
            @foreach ($cate->typeCate as $type)
                  <li class="level1 position-relative">
                  <a href="{{route('allListProType', ['cate'=>$type->cate_slug, 'type'=>$type->slug])}}" class="font-weight-bold d-flex pt-2 pb-2 border-bottom mr-2 ml-2 align-items-center" title="{{languageName($type->name)}}">
                  {{languageName($type->name)}}
                  </a>
                  <ul class="lv2 d-flex list-unstyled flex-column pl-0">
                  </ul>
                  </li>
            @endforeach
            </ul>
      </li>
      @else
      <li class="level0 d-block w-100 position-static">
            <a href="{{route('allListProCate', ['cate'=>$cate->slug])}}" title="{{languageName($cate->name)}}" class="position-relative d-flex flex-column justify-content-center align-items-center text-center p-2">
            <img class="lazy d-block pb-2 m-auto" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{$cate->avatar}}" alt="{{languageName($cate->name)}}">
            <span class="line_1 line_2">{{languageName($cate->name)}}</span>
            </a>
      </li>
      @endif
      @endforeach
</ul>
</div>
</div>