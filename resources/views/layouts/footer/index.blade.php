<footer class="bg-white pt-5">
   <div class="foo_mid mb-4">
      <div class="container">
            <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 footer-left">
               <a href="{{route('home')}}" title="{{$setting->company}}" class="logo_foo d-block mb-2">
               <img alt="Logo {{$setting->company}}" class="lazy" src="{{$setting->logo_footer}}" data-src="{{$setting->logo_footer}}">
               </a>
               <address class="vcard mb-4">
                  <p class="adr"><b>HỘ KINH DOANH LUCKY SOUND</b></p>
                  <p class="adr"><b>Trụ sở chính:  </b>{{$setting->address1}}</p>
                  <p><b>MST: </b>8647839090-001</p>
                  <p><b>Email: </b><a href="mailto:{{$setting->email}}" title="{{$setting->email}}">{{$setting->email}}</a></p>
                  <p><b>Số điện thoại: </b><a href="tel:{{$setting->phone1}}" title="{{$setting->phone1}}">{{$setting->phone1}}</a></p>
                  <p style="font-size: 15px;"><b>Giấy chứng nhận Đăng ký Kinh doanh số 0108044530 do Sở kế hoạch và Đầu tư Thành phố Hà Nội cấp ngày 27/10/2022</b></p>
               </address>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6 col-xs-12 footer-left">
               <div class="row">
                  <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                     <h3 class="footer-title mb-2 position-relative font-weight-bold">Chăm sóc khách hàng</h3>
                     <ul class="links">
                        <li><b>Hotline:</b> <a href="tel:0961932222" title="tel">096 193 2222 </a> (8h - 22h)</li>
                        <li><b>Kinh doanh:</b> <a href="tel:0866958331" title="tel">0866 958 331 </a> (8h - 22h)</li>
                        <li><b>Kỹ thuật:</b> <a href="tel:0966357594" title="tel">0966 357 594 </a> (8h - 22h)</li>
                        <li><b>Khiếu nại - CSKH:</b> <a href="https://zalo.me/{{$setting->phone2}}" title="zalo" style="color:rgb(46, 129, 202);">Chat qua Zalo </a> (24/7)</li>
                     </ul>
                  </div>
                  <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                     <h3 class="footer-title mb-2 position-relative font-weight-bold">Chính sách hỗ trợ</h3>
                     <ul class="links">
                        @foreach ($helpCus as $item)
                        <li><a href="{{route('helpCus', ['slug'=>$item->slug])}}" title="{{$item->title}}">{{$item->title}}</a></li>
                        @endforeach
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12 footer-left">
               <h3 class="footer-title mb-2 position-relative font-weight-bold">Kết nối với chúng tôi</h3>
               <div class="social position-relative pb-2">
                  <a href="{{$setting->facebook}}" target="_blank" class="position-relative iso sitdown modal-open d-inline-block facebook mr-1" title="Facebook">
                  <img class="lazy" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{asset('frontend/images/facebook.png')}}" alt="facebook" width=32 height=32>
                  </a>
                  <a href="{{$setting->iframe_map}}" target="_blank" class="position-relative iso sitdown modal-open d-inline-block twitter mr-1" title="Tiktok">
                  <img class="lazy" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{asset('frontend/images/tiktok.png')}}" alt="Tiktok" width=32 height=32>
                  </a>
                  <a href="{{$setting->footer_content}}" target="_blank" class="position-relative iso sitdown modal-open d-inline-block youtube mr-1" title="Youtube">
                  <img class="lazy" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{asset('frontend/images/youtube.png')}}" alt="youtube" width=32 height=32>
                  </a>
                  <a href="{{$setting->fbPixel}}" target="_blank" class="position-relative iso sitdown modal-open d-inline-block instagram mr-1" title="Tiki">
                     <img class="lazy" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{asset('frontend/images/tiki.png')}}" alt="tiki" width=32 height=32>
                     </a>
                  <a href="{{$setting->google}}" target="_blank" class="position-relative iso sitdown modal-open d-inline-block shopee mr-1" title="Shopee">
                  <img class="lazy" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{asset('frontend/images/shopee.png')}}" alt="Shopee" width=32 height=32>
                  </a>
                  <a href="{{$setting->GA}}" target="_blank" class="position-relative iso sitdown modal-open d-inline-block lazada mr-1" title="Lazada">
                  <img class="lazy" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{asset('frontend/images/lazada.jpg')}}" alt="Lazada" width=32 height=32>
                  </a>
               </div>
               <p class="mb-3 position-relative">Phương thức thanh toán</p>
               <div class="footer-column-1">
                  <div class="payment-accept">
                        <img class="first lazy" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{asset('frontend/images/payment-1.png')}}" alt="payment-1">
                        <img class="lazy" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{asset('frontend/images/payment-2.png')}}" alt="payment-2">
                        <img class="lazy" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{asset('frontend/images/payment-3.png')}}" alt="payment-3">
                        <img class="lazy" src="//bizweb.dktcdn.net/100/459/533/themes/868331/assets/placeholder_1x1.png?1676652384879" data-src="{{asset('frontend/images/payment-4.png')}}" alt="payment-4">
                  </div>
               </div>
            </div>
            </div>
      </div>
   </div>
</footer>
