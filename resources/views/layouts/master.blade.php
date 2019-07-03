<!DOCTYPE html>
<html lang="en-US" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Shop hoa tươi | @yield('title')</title>

        <link href="{{ asset('assets/lib/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Volkhov:400i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href="{{ asset('assets/lib/animate.css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/lib/components-font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/lib/et-line-font/et-line-font.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/lib/flexslider/flexslider.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/lib/owl.carousel/dist/assets/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/lib/magnific-popup/dist/magnific-popup.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/lib/simple-text-rotator/simpletextrotator.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/shophoa.css') }}" rel="stylesheet">
        @yield('stylesheets')
    </head>
    <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
        <main>
            <div class="page-loader">
                <div class="loader">Đang tải...</div>
            </div>
            <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="{{ route('client.home') }}">SHOP bán hoa tươi</a>
                    </div>
                    <div class="collapse navbar-collapse" id="custom-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="{{ route('client.home') }}">Trang chủ</a>
                            </li>
                            <li class="dropdown" id="loaihoa">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown">LOẠI HOA</a>
                                <ul class="dropdown-menu">
                                </ul>
                            </li>
                            @if(!Auth::check())
                            <li>
                                <a href="{{ route('login') }}">Đăng nhập</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}">Đăng ký</a>
                            </li>
                            @else
                            <li class="dropdown" id="user">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('info-payment') }}">Thông tin thanh toán</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('order') }}">Đơn hàng đã đặt</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('change-password') }}">Đổi mật khẩu</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" id="submit_logout">Đăng xuất</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="/admin/home">Bảng quản trị</a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i>&nbsp;<span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            @yield('content')
            <hr class="divider-w">
            <div class="module-small bg-dark">
                <div class="container">
                    <div class="row">
                    <div class="col-sm-3">
                        <div class="widget">
                        <h5 class="widget-title font-alt">Về SHOP</h5>
                        <p>.</p>
                        <p>Phone: +1 234 567 89 10</p>Fax: +1 234 567 89 10
                        <p>Email:<a href="#">somecompany@example.com</a></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="widget">
                        <h5 class="widget-title font-alt">Recent Comments</h5>
                        <ul class="icon-list">
                            <li>Maria on <a href="#">Designer Desk Essentials</a></li>
                            <li>John on <a href="#">Realistic Business Card Mockup</a></li>
                            <li>Andy on <a href="#">Eco bag Mockup</a></li>
                            <li>Jack on <a href="#">Bottle Mockup</a></li>
                            <li>Mark on <a href="#">Our trip to the Alps</a></li>
                        </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="widget">
                        <h5 class="widget-title font-alt">Blog Categories</h5>
                        <ul class="icon-list">
                            <li><a href="#">Photography - 7</a></li>
                            <li><a href="#">Web Design - 3</a></li>
                            <li><a href="#">Illustration - 12</a></li>
                            <li><a href="#">Marketing - 1</a></li>
                            <li><a href="#">Wordpress - 16</a></li>
                        </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="widget">
                        <h5 class="widget-title font-alt">Popular Posts</h5>
                        <ul class="widget-posts">
                            <li class="clearfix">
                            <div class="widget-posts-image"><a href="#"><img src="assets/images/rp-1.jpg" alt="Post Thumbnail"/></a></div>
                            <div class="widget-posts-body">
                                <div class="widget-posts-title"><a href="#">Designer Desk Essentials</a></div>
                                <div class="widget-posts-meta">23 january</div>
                            </div>
                            </li>
                            <li class="clearfix">
                            <div class="widget-posts-image"><a href="#"><img src="assets/images/rp-2.jpg" alt="Post Thumbnail"/></a></div>
                            <div class="widget-posts-body">
                                <div class="widget-posts-title"><a href="#">Realistic Business Card Mockup</a></div>
                                <div class="widget-posts-meta">15 February</div>
                            </div>
                            </li>
                        </ul>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <hr class="divider-d">
            <footer class="footer bg-dark">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="copyright font-alt">&copy; 2019&nbsp;<a href="{{ route('client.home') }}">Shop Hoa Tươi</a>, All Rights Reserved</p>
                        </div>
                        <div class="col-sm-6">
                            <div class="footer-social-links"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
        </main>
        <script src="{{ asset('assets/lib/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('assets/lib/wow/dist/wow.js') }}"></script>
        <script src="{{ asset('assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js') }}"></script>
        <script src="{{ asset('assets/lib/isotope/dist/isotope.pkgd.js') }}"></script>
        <script src="{{ asset('assets/lib/imagesloaded/imagesloaded.pkgd.js') }}"></script>
        <script src="{{ asset('assets/lib/flexslider/jquery.flexslider.js') }}"></script>
        <script src="{{ asset('assets/lib/owl.carousel/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/lib/smoothscroll.js') }}"></script>
        <script src="{{ asset('assets/lib/magnific-popup/dist/jquery.magnific-popup.js') }}"></script>
        <script src="{{ asset('assets/lib/simple-text-rotator/jquery.simple-text-rotator.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script src="{{ asset('js/function.js') }}"></script>
        @yield('scripts')
    </body>
</html>
