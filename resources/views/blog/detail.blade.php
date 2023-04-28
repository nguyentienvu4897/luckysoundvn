@extends('layouts.main.master')
@section('title')
{{languageName($blog_detail->title)}}
@endsection
@section('description')
{{languageName($blog_detail->description)}}
@endsection
@section('image')
{{url(''.$blog_detail->image)}}
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
			<li>
				<a href="{{route('allListBlog')}}" title="Tin tức"><span>Tin tức</span></a>	
				<span class="slash-divider ml-2 mr-2">/</span>
			</li>
			<li >{{languageName($blog_detail->title)}}</li>
		</ul>
	</div>
	</div>
	<section class="col2-right-layout" itemscope  itemtype="http://schema.org/Article">
	<div class="main container blogs">
		<div class="col-main art_container mt-3 mb-3">
			<div class="rounded p-3 bg-white">
				<div class="row">
				<article class="blog_entry clearfix order-md-2 col-12 col-md-12 col-lg-8 col-xl-9">
					<h1 class="article-name font-weight-bold mt-1">{{languageName($blog_detail->title)}}</h1>
					<div class="entry-date">
						<p class="day mb-0 mb-lg-3 pt-1">
							Đăng bởi: <b>Luckysoundvn - {{date('d/m/Y', strtotime($blog_detail->created_at))}}</b>
						</p>
					</div>
					<div class="js-toc table-of-contents w-100 position-relative p-2 rounded mb-3">{{languageName($blog_detail->description)}}</div>
					<div class="entry-content text-justify rte ">
						{!!languageName($blog_detail->content)!!}
					</div>
					<div class="tag-product clearfix mt-2 pt-2 border-top ">		
					</div>
					<div class="main blogs">
						<h3 class="widget-title title mb-3">
							<a href="/24h-cong-nghe" title="Bài viết liên quan: ">
							Bài viết liên quan: 
							</a>
						</h3>
						<div class="widget-content latest-blog swiper-container position-relative">
							<div class="swiper-wrapper">
								@foreach ($news as $blog)
									<div class="swiper-slide">
										<article class="blog-item-list clearfix mb-3 row">
											<div class="col-4 col-lg-3 pr-0 ">
												<a href="{{route('detailBlog', ['slug'=>$blog->slug])}}" class=" d-block modal-open thumb_img_blog_list thumb rounded" title="{{languageName($blog->title)}}"> 
												<span class="modal-open position-relative d-block w-100 m-0 ratio3by2 has-edge aspect zoom">
												<img src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1681267458186" data-src="{{$blog->image}}" decoding="async" alt="{{languageName($blog->title)}}" class="lazy d-block img img-cover position-absolute">
												</span>
												</a>
											</div>
											<div class="blogs-rights col-8 col-lg-9">
												<h3 class="blog-item-name font-weight-bold mb-1 title_blo">
												<a class="line_1" href="{{route('detailBlog', ['slug'=>$blog->slug])}}" title="{{languageName($blog->title)}}">{{languageName($blog->title)}}</a>
												</h3>
												<div class="sum line_2 h-auto text-justify">
													{{languageName($blog->description)}}
												</div>
											</div>
										</article>
									</div>
								@endforeach
							</div>
							<div class="swiper-button-prev mew_latest_blog_prev"></div>
							<div class="swiper-button-next mew_latest_blog_next"></div>
						</div>
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