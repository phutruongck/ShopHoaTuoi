<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Shop bán Hoa || @yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/lib/components-font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand:400,700">
    <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('admin/css/ready.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/demo.css') }}">
    @yield('stylesheets')
</head>
<body>
    <div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="{{ route('admin.home') }}" class="logo">
                    Bảng quản trị
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<form class="navbar-left navbar-form nav-search mr-md-3" action="">
						<div class="input-group">
							<input type="text" placeholder="Tìm kiếm..." class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">
									<i class="la la-search search-icon"></i>
								</span>
							</div>
						</div>
                    </form>
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-envelope"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="{{ asset('admin/img/user.svg') }}" alt="user-img" width="36" class="img-circle"><span>{{ Auth::user()->name }}</span></span> </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <div class="user-box">
                                        <div class="u-img"><img src="{{ asset('admin/img/user.svg') }}" alt="user"></div>
                                        <div class="u-text">
                                            <h4>{{ Auth::user()->name }}</h4>
                                            <p class="text-muted">{{ Auth::user()->email }}</p><a href="{{ route('info-payment') }}" class="btn btn-rounded btn-danger btn-sm">Thông tin cá nhân</a>
                                        </div>
                                    </div>
                                </li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="sidebar">
            <div class="scrollbar-inner sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="{{ asset('admin/img/user.svg') }}">
                    </div>
                    <div class="info">
                        <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                {{ Auth::user()->name }}
                                <span class="user-level">Người quản trị</span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item @yield('dashboard')">
                        <a href="{{ route('admin.home') }}">
                            <i class="la la-dashboard"></i>
                            <p>Tổng quan</p>
                        </a>
                    </li>
                    <li class="nav-item @yield('users')">
                        <a href="/admin/users">
                            <i class="la la-table"></i>
                            <p>Người dùng</p>
                        </a>
                    </li>
                    <li class="nav-item @yield('products')">
                        <a href="/admin/products">
                            <i class="la la-keyboard-o"></i>
                            <p>Sản phẩm</p>
                        </a>
                    </li>
                    <li class="nav-item @yield('productCategories')">
                        <a href="/admin/product-categories">
                            <i class="la la-keyboard-o"></i>
                            <p>Loại sản phẩm</p>
                        </a>
                    </li>
                    <li class="nav-item @yield('orders')">
                        <a href="/admin/orders">
                            <i class="la la-bell"></i>
                            <p>Đơn hàng</p>
                        </a>
                    </li>
                    <li class="nav-item @yield('customers')">
                        <a href="/admin/customers">
                            <i class="la la-font"></i>
                            <p>Khách hàng</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @yield('content')
    </div>
    <script src="{{ asset('admin/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugin/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugin/jquery-mapael/maps/world_countries.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/ready.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin/js/demo.js') }}"></script>
    <script src="{{ asset('js/function.js') }}"></script>
    @yield('scripts')
</body>
</html>
