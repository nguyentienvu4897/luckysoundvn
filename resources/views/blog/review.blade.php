@extends('layouts.main.master')
@section('title')
{{$review->name}}
@endsection
@section('description')
@endsection
@section('image')
{{url(''.$review->image)}}
@endsection
@section('css')
<link rel="preload" as="style"  href="{{asset('frontend/css/mew_blog.scss.css')}}" type="text/css">
<link href="{{asset('frontend/css/mew_blog.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
<link rel="preload" as="style"  href="{{asset('frontend/css/mew_article.scss.css')}}" type="text/css">
<link href="{{asset('frontend/css/mew_article.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
@endsection
@section('js')
<script src="{{asset('frontend/js/mew_article.js')}}" defer></script>
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
			<li >{{$review->name}}</li>
		</ul>
	</div>
	</div>
	<section class="col2-right-layout" itemscope  itemtype="http://schema.org/Article">
	<div class="main container blogs">
		<div class="col-main art_container mt-3 mb-3">
			<div class="rounded p-3 bg-white">
				<div class="row">
				<article class="blog_entry clearfix order-md-2 col-12 col-md-12 col-lg-8 col-xl-9">
					<h1 class="article-name font-weight-bold mt-1">{{$review->name}}</h1>
					<div class="entry-date">
						<p class="day mb-0 mb-lg-3 pt-1">
							Đăng bởi: <b>Luckysoundvn - {{date('d/m/Y', strtotime($review->created_at))}}</b>
						</p>
					</div>
					<div class="entry-content text-justify rte ">
						{!!$review->content!!}
					</div>
					<div class="tag-product clearfix mt-2 pt-2 border-top ">		
					</div>
					<div class="main blogs">
                        <section id="video" class="m_blog mt-lg-4 mb-lg-4">
                                <div class="rounded bg-white">
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
					</div>
				</article>
				<div class="col-xl-3 col-lg-4 col-md-12 d-none d-lg-block ba_sidebar order-3 order-lg-1">
					<div class="position-sticky top_20px">
						<div class="aside-content blog-list">
							<h3 class="align-items-center article-name d-flex font-weight-bold pt-2 pt-lg-0 mb-3 pb-3 border-bottom">
							<img class="lazy mr-2" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1681267458186" data-src="{{asset('frontend/images/hot_ico.png')}}" alt="Chủ đề"> 
							Chủ đề
							</h3>
							<ul class="b_item mb-0 p-0">
								@foreach ($blogCate as $cate)
									<li class="d-flex align-items-center position-relative mb-2">
										<div class="image mr-2 rounded modal-open">
											<a href="{{route('allListBlog') . '?type=#'. $cate->slug}}" title="{{languageName($cate->name)}}">
											<img src="{{$cate->avatar}}" alt="{{languageName($cate->name)}}" />
											</a>
										</div>
										<div class=text>
											<h4 class="font-weight-bold"><a href="{{route('allListBlog') .'?type=#'. $cate->slug}}" title="{{languageName($cate->name)}}">{{languageName($cate->name)}}</a></h4>
											<span class="d-block">{{$cate->listBlog->count()}} bài tin</span>
										</div>
									</li>
								@endforeach
							</ul>
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