@extends('layouts.main.master')
@section('title')
{{$title_page}} 
@endsection
@section('description')
{{$title_page}}
@endsection
@section('image')
{{url(''.$banners[0]->image)}}
@endsection
@section('css')
<link rel="preload" as="style"  href="{{asset('frontend/css/mew_blog.scss.css')}}" type="text/css">
<link href="{{asset('frontend/css/mew_blog.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
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
            <li >Tin tức</li>
         </ul>
      </div>
   </div>
   <section class="blog-layout" itemscope itemtype="http://schema.org/Blog">
      @foreach ($blogCate as $key=>$cate)
      @if ($cate->listBlog->count())
         @if ($key%2==0)
            <div class="container mt-3 mb-3 lastest-articles" id="{{$cate->slug}}">
               <div class="rounded p-3 bg-white">
                  <h1 class="blog-name font-weight-bold pb-3 pt-2 pt-lg-0" >{{languageName($cate->name)}}</h1>
                  <div class="row">
                     @if (isset($cate->listBlog[0]))
                     <div class="col-md-7 col-12">
                        <div class="position-relative modal-open rounded-10 mb-3 mb-md-0">
                           <picture class="position-relative w-100 m-0 be_opa modal-open ratio3by2 aspect large-article rounded-10 d-block">
                              <source media="(min-width: 1200px)" srcset="{{$cate->listBlog[0]->image}}">
                              <source media="(min-width: 992px)" srcset="{{$cate->listBlog[0]->image}}">
                              <source media="(max-width: 569px)" srcset="{{$cate->listBlog[0]->image}}">
                              <source media="(max-width: 480px)" srcset="{{$cate->listBlog[0]->image}}">
                              <img src="{{$cate->listBlog[0]->image}}" class=" d-block img img-cover position-absolute" alt="{{languageName($cate->listBlog[0]->title)}}">
                           </picture>
                           <div class="position-absolute large-article-info p-0 p-lg-4 p-md-3">
                              <h3 class="title_blo font-weight-bold mt-2 mt-md-0 mb-0 mb-md-3"><a class="line_2" href="{{route('detailBlog', ['slug'=>$cate->listBlog[0]->slug])}}" title="{{languageName($cate->listBlog[0]->title)}}">{{languageName($cate->listBlog[0]->title)}}</a></h3>
                              <span class="d-block d-md-none text-gray small mt-1 mb-1">{{date('d-m-Y', strtotime($cate->listBlog[0]->created_at))}}</span>
                              <span class="d-block">{{languageName($cate->listBlog[0]->description)}}</span>
                           </div>
                        </div>
                     </div>
                     @endif
                     <div class="col-12 col-md-5">
                        @foreach ($cate->listBlog as $key=>$blog)
                        @if ($key != 0)
                           <article class="blog-item-list clearfix mb-3 row">
                              <div class="col-4 col-lg-3 pr-0 pl-md-0">
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
                                 <div class="post-time small">{{date('d/m/Y', strtotime($blog->created_at))}}</div>
                                 <div class="sum line_2 h-auto text-justify">
                                    {{languageName($blog->description)}}
                                 </div>
                              </div>
                           </article>
                        @endif
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>
         @else
            <div class="container mt-3 mb-3 " id="{{$cate->slug}}">
               <div class="col-main rounded m_white_bg_module p-lg-3 pl-2 pr-2 pt-3 pb-3">
                  <h1 class="blog-name font-weight-bold pb-3 pt-2 pt-lg-0" >{{languageName($cate->name)}}</h1>
                  <article>
                     <div class="grid_article">
                        <div class="row">
                           @foreach ($cate->listBlog as $blog)
                              <div class="col-12 col-sm-6 col-md-6 col-lg-4 its">
                                 <div class="custom-article-item border mb-4 modal-open rounded-10">
                                    <a href="{{route('detailBlog', ['slug'=>$blog->slug])}}" title="{{languageName($blog->title)}}" class="effect-ming">
                                       <div class="position-relative w-100 m-0 be_opa modal-open ratio3by2 aspect ">
                                          <img src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1681267458186" data-src="{{$blog->image}}" class="lazy d-block img img-cover position-absolute" alt="{{languageName($blog->title)}}">
                                       </div>
                                    </a>
                                    <div class="custom-article-item_info">
                                       <div class="tags d-flex list-unstyled mb-1">
                                       </div>
                                       <h3 class="title_blo font-weight-bold mb-2"><a class="line_2" href="{{route('detailBlog', ['slug'=>$blog->slug])}}" title="{{languageName($blog->title)}}">{{languageName($blog->title)}}</a></h3>
                                       <span class="d-block text-gray small">{{date('d/m/Y', strtotime($blog->created_at))}}</span>
                                       <div class="sum line_1 line_2 h-auto text-justify">
                                          {{languageName($blog->description)}}
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           @endforeach
                        </div>
                     </div>
                  </article>
               </div>
            </div>
         @endif
      @endif
      @endforeach
   </section>
</div>
@endsection