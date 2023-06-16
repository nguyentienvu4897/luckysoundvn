<!DOCTYPE html>
<html class="thankyou-page">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Lucky Sound - Cảm ơn" />
    <title>Lucky Sound - Cảm ơn</title>
    <script>
        (function () {
            function asyncLoad() {
                var urls = [] || [];
                for (var i = 0; i < urls.length; i++) {
                    var s = document.createElement('script');
                    s.type = 'text/javascript';
                    s.async = true;
                    s.src = urls[i];
                    var x = document.getElementsByTagName('script')[0];
                    x.parentNode.insertBefore(s, x);
                }
            };
            window.attachEvent ? window.attachEvent('onload', asyncLoad) : window.addEventListener('load', asyncLoad, false);
        })();
    </script>
    <link rel="shortcut icon" href="{{url(''.$setting->favicon)}}" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/checkout.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Begin checkout custom css -->
    <style>
    </style>
    <!-- End checkout custom css -->
    <script src="{{ asset('frontend/js/checkout.vendor.min.js') }}"></script>
    <script src="{{ asset('frontend/js/checkout.min.js') }}"></script>
    <script>
        var count = 0;
        window.addEventListener('load', function() {
            count++;
            if (count === 2) {
                window.location.href = '/';
            }
        });
        window.onload = function()
        {
            setTimeout(() => {
                window.location.href = '/';
            }, 12000);  
        };
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-SSKZWHE7DJ"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-SSKZWHE7DJ');
    </script>
</head>
<body data-no-turbolink>
    <header class="banner">
        <div class="wrap">
            <div class="logo logo--left">
            <a href="{{route('home')}}">
            <img class="logo__image  logo__image--small " alt="Lucky Sound" src="{{$setting->logo}}" />
            </a>
            </div>
        </div>
    </header>
    <div class="content">
        <form>
            <div class="wrap wrap--mobile-fluid">
            <main class="main main--nosidebar">
                <header class="main__header">
                    <div class="logo logo--left">
                        <a href="{{route('home')}}">
                        <img class="logo__image  logo__image--small " alt="Lucky Sound" src="{{$setting->logo}}" />
                        </a>
                    </div>
                </header>
                <div class="main__content">
                    <article class="row">
                        <div class="col col--primary">
                        <section class="section section--icon-heading">
                            <div class="section__icon unprintable">
                                <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
                                    <g fill="none" stroke="#8EC343" stroke-width="2">
                                    <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                    <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="thankyou-message-container">
                                <h2 class="section__title">Cảm ơn bạn đã đặt hàng</h2>
                                <p class="section__text">
                                    Một email xác nhận đã được gửi tới {{$query->cus_email}}. <br/>
                                    Xin vui lòng kiểm tra email của bạn
                                </p>
                            </div>
                        </section>
                        </div>
                        <div class="col col--secondary">
                        <aside class="order-summary order-summary--bordered order-summary--is-collapsed" id="order-summary">
                            <div class="order-summary__header">
                                <div class="order-summary__title">
                                    Đơn hàng #{{$query->code_bill}}
                                    <span class="unprintable">({{count($cart)}})</span>
                                </div>
                                <div class="order-summary__action hide-on-desktop unprintable">
                                    <a data-toggle="#order-summary" data-toggle-class="order-summary--is-collapsed" class="expandable">
                                    Xem chi tiết
                                    </a>
                                </div>
                            </div>
                            <div class="order-summary__sections">
                                <div class="order-summary__section order-summary__section--product-list order-summary__section--is-scrollable order-summary--collapse-element">
                                    <table class="product-table">
                                    <tbody>
                                        @foreach ($cart as $item)
                                            @php
                                            $discountPrice = $item['price']-$item['price']*($item['discount']/100);
                                            @endphp
                                            <tr class="product">
                                                <td class="product__image">
                                                    <div class="product-thumbnail">
                                                    <div class="product-thumbnail__wrapper">
                                                        <img src="{{$item['image']}}" alt="" class="product-thumbnail__image" />
                                                    </div>
                                                    <span class="product-thumbnail__quantity unprintable">1</span>
                                                    </div>
                                                </td>
                                                <th class="product__description">
                                                    <span class="product__description__name">{{languageName($item['name'])}}</span>
                                                </th>
                                                <td class="product__quantity printable-only">
                                                    x {{$item['quantity']}}
                                                </td>
                                                <td class="product__price">
                                                    {{number_format($discountPrice,0,'','.')}}₫
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                </div>
                                <div class="order-summary__section">
                                    <table class="total-line-table">
                                    <tbody class="total-line-table__tbody">
                                        <tr class="total-line payment-due">
                                            <th class="total-line__name">
                                                <span class="payment-due__label-total">Tổng cộng</span>
                                            </th>
                                            <td class="total-line__price">
                                                <span class="payment-due__price">{{number_format($query->total_money, 0, '', '.')}}₫</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </aside>
                        </div>
                        <div class="col col--primary">
                        <section class="section">
                            <div class="section__content section__content--bordered">
                                <div class="row">
                                    <div class="col col--md-two">
                                    <h2>Thông tin mua hàng</h2>
                                    <p>{{$query->cus_name}}</p>
                                    <p>{{$query->cus_email}}</p>
                                    <p>{{$query->cus_phone}}</p>
                                    </div>
                                    <div class="col col--md-two">
                                    <h2>Địa chỉ nhận hàng</h2>
                                    <p>{{$query->cus_name}}</p>
                                    <p>{{$query->cus_address}}</p>
                                    <p>{{$query->cus_phone}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col--md-two">
                                    <h2>Phương thức thanh toán</h2>
                                    <p>Thanh toán khi giao hàng (COD)</p>
                                    </div>
                                    <div class="col col--md-two">
                                    <h2>Phương thức vận chuyển</h2>
                                    <p>Giao hàng tận nơi</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="section unprintable">
                            <div class="field__input-btn-wrapper field__input-btn-wrapper--floating">
                                <a href="{{route('home')}}" class="btn btn--large">Tiếp tục mua hàng</a>
                            </div>
                        </section>
                        </div>
                    </article>
                </div>
            </main>
            </div>
        </form>
    </div>
</body>
</html>