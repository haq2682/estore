<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7"><![endif]-->
<!--[if IE 8]><html class="ie ie8"><![endif]-->
<!--[if IE 9]><html class="ie ie9"><![endif]-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="favicon.png" rel="icon">
    <meta name="author" content="Nghia Minh Luong">
    <meta name="keywords" content="Default Description">
    <meta name="description" content="Default keyword">
    <title>Sky - Homepage</title>
    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Archivo+Narrow:300,400,700%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/ps-icon/style.css')}}">
    <!-- CSS Library-->
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/owl-carousel/assets/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/slick/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/Magnific-Popup/dist/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/revolution/css/settings.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/revolution/css/layers.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/revolution/css/navigation.css')}}">
    <!-- Custom-->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--[if lt IE 9]><script src="{{asset('js/html5shiv.js')}}"></script><script src="{{asset('js/respond.min.js')}}"></script><![endif]-->
</head>
<!--[if IE 7]><body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 8]><body class="ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 9]><body class="ie9 lt-ie10"><![endif]-->
<body>
<div class="header--sidebar"></div>
<header class="header">
    <nav class="navigation">
        <div class="container-fluid">
            <div class="navigation__column left">
                <div class="header__logo"><a class="ps-logo" href="index.html"><img src="images/logo.png" alt=""></a></div>
            </div>
            <div class="navigation__column center">
                <ul class="main-menu menu">
                    <li class="menu-item"><a href="{{route('index')}}">Home</a>
                    </li>
                    @php
                        use App\Models\Category;
                        $categories = Category::all();
                    @endphp
                    <li id="category-header" class="menu-item menu-item-has-children dropdown"><a>Categories</a>
                        <ul class="sub-menu">
                            @foreach($categories as $category)
                                <li class="menu-item"><a href="{{route('products.show', $category->id)}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="menu-item"><a href="{{route('contact')}}">Contact Us</a></li>
                    @if(Auth::check())
                        @if(auth()->user()->userHasRole('seller'))
                            <li class="menu-item"><a href="{{route('seller.dashboard')}}">Seller Dashboard</a></li>
                        @endif
                    @endif
                    @if(Auth::check())
                        <li class="menu-item"><a href="{{route('products.track')}}">Track</a></li>
                        <li class="menu-item"><a href="{{route('user.profile')}}">My Account</a></li>
                        <li class="menu-item"><a href="/logout">Logout</a></li>
                    @else
                        <li class="menu-item"><a href="/login">Login</a></li>
                        <li class="menu-item"><a href="/register">Register</a></li>
                    @endif
                </ul>
            </div>
            <div class="navigation__column right">
                <form class="ps-search--header" action="{{route('products.search')}}" method="get">
                    @csrf
                    <input class="form-control" name="search" type="text" placeholder="Search Product…">
                    <button type="submit"><i class="ps-icon-search"></i></button>
                </form>
                @php
                    use App\Models\Cart;
                        if(Auth::user()) {
                            $carts = Cart::where('user_id', '=', auth()->user()->id)->get();
                        }
                @endphp
                @if(Auth::user())
                    @if($carts)
                    <div class="ps-cart"><a class="ps-cart__toggle" href="{{route('user.cart')}}"><span><i>{{count($carts)}}</i></span><i class="ps-icon-shopping-cart"></i></a>
                        <div class="ps-cart__listing">
                            <div class="ps-cart__content" style="max-height: 480px; overflow: hidden;">
                                @if(count($carts)>0)
                                    @foreach($carts as $cart)
                                        <div class="ps-cart-item"><a class="ps-cart-item__close" href="#"></a>
                                            <div class="ps-cart-item__thumbnail"><a href="{{route('products.details', $cart->product->id)}}"></a><img src="/{{$cart->product->product_image1}}" alt=""></div>
                                            <div class="ps-cart-item__content"><a class="ps-cart-item__title" href="{{route('products.details', $cart->product->id)}}">{{$cart->product->name}}</a>
                                                <p><span>Quantity:<i>{{$cart->quantity}}</i></span><span>Total:<i>${{$cart->subtotal}}</i></span></p>
                                            </div>
                                        </div>
                                    @endforeach
                            </div>
                            <div class="ps-cart__total">
                                @if(count($carts) > 5)<p>And {{count($carts) - 5}} more items</p>@endif
                                <p>Item Total:<span>${{$carts->sum('subtotal')}}</span></p>
                            </div>
                            <div class="ps-cart__footer"><a class="ps-btn" href="{{route('user.cart')}}">View Cart<i class="ps-icon-arrow-left"></i></a></div>
                            @else
                                <h6 style="color: white; text-align: center; padding-bottom: 2rem;">You don't have anything in your cart.</h6>
                            @endif
                        </div>
                    </div>
                    @endif
                @endif
                <div class="menu-toggle"><span></span></div>
            </div>
        </div>
    </nav>
</header>
<div class="header-services">
    <div class="ps-services owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with Sky Store</p>
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with Sky Store</p>
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with Sky Store</p>
    </div>
</div>
<main class="ps-main">
            @yield('content')
    <div class="ps-footer bg--cover">
        <div class="ps-footer__content">
            <div class="ps-container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                        <aside class="ps-widget--footer ps-widget--info">
                            <header><a class="ps-logo" href="index.html"><img src="images/logo-white.png" alt=""></a>
                                <h3 class="ps-widget__title">Address Office 1</h3>
                            </header>
                            <footer>
                                <p><strong>460 West 34th Street, 15th floor, New York</strong></p>
                                <p>Email: <a href='mailto:support@store.com'>support@store.com</a></p>
                                <p>Phone: +323 32434 5334</p>
                                <p>Fax: ++323 32434 5333</p>
                            </footer>
                        </aside>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                        <aside class="ps-widget--footer ps-widget--info second">
                            <header>
                                <h3 class="ps-widget__title">Address Office 2</h3>
                            </header>
                            <footer>
                                <p><strong>PO Box 16122 Collins  Victoria 3000 Australia</strong></p>
                                <p>Email: <a href='mailto:support@store.com'>support@store.com</a></p>
                                <p>Phone: +323 32434 5334</p>
                                <p>Fax: ++323 32434 5333</p>
                            </footer>
                        </aside>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                        <aside class="ps-widget--footer ps-widget--link">
                            <header>
                                <h3 class="ps-widget__title">Get Help</h3>
                            </header>
                            <footer>
                                <ul class="ps-list--line">
                                    <li><a href="{{route('products.track')}}">Order Status</a></li>
                                    <li><a href="{{route('shipping')}}">Shipping and Delivery</a></li>
                                    <li><a href="{{route('returns')}}">Returns</a></li>
                                    <li><a href="{{route('faq')}}">Frequently Asked Questions</a></li>
                                    <li><a href="{{route('policies')}}">Policies</a></li>
                                    <li><a href="{{route('contact')}}">Contact Us</a></li>
                                </ul>
                            </footer>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-footer__copyright">
            <div class="ps-container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                        <p>&copy; <a href="#">SKYTHEMES</a>, Inc. All rights Resevered. Design by <a href="#"> Alena Studio</a></p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                        <ul class="ps-social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- JS Library-->
<script type="text/javascript" src="{{asset('plugins/jquery/dist/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/owl-carousel/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/gmap3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/imagesloaded.pkgd.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/isotope.pkgd.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/jquery.matchHeight-min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/slick/slick/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/elevatezoom/jquery.elevatezoom.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx39JFH5nhxze1ZydH-Kl8xXM3OK4fvcg&amp;region=GB"></script><script type="text/javascript" src="{{asset('plugins/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
<!-- Custom scripts-->
<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
</body>
</html>
