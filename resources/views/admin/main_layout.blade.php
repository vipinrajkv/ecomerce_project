<!DOCTYPE html>
<html lang="en">

<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="{{ asset('js/style.js') }}"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	<link rel="stylesheet" href="{{ asset('css/custom_style.css') }}">
	{{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet"
		id="bootstrap-css"> --}}
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<style>
	
		.product-image {
			width: 50px;
			height: 65px;
		}
		</style>
</head>

<body>

	<!------ Include the above in your HEAD tag ---------->

	<nav class="navbar navbar-default navbar-static-top">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
					MENU
				</button>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
					data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">
					Administrator
				</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<form class="navbar-form navbar-left" method="GET" role="search">
					<div class="form-group">
						<input type="text" name="q" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="http://www.pingpong-labs.com" target="_blank">Visit Site</a></li>
					<li class="dropdown ">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							Account
							<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li class="divider"></li>
							<li><a href="{{ route('logout') }}"
								onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">Logout</a></li>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<div class="container-fluid main-container">
		<div class="col-md-2 sidebar">
			<div class="row">
				<!-- uncomment code for absolute positioning tweek see top comment in css -->
				<div class="absolute-wrapper"> </div>
				<!-- Menu -->
				<div class="side-menu">
					<nav class="navbar navbar-default" role="navigation">
						<!-- Main Menu -->
						<div class="side-menu-container">
							<ul class="nav navbar-nav">
								<li class="active"><a href="#"><span class="glyphicon glyphicon-dashboard"></span>
										Dashboard</a></li>
								{{-- <li><a href="#"><span class="glyphicon glyphicon-plane"></span> Active Link</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-cloud"></span> Link</a></li> --}}

								<!-- Dropdown-->
								<li class="panel panel-default" id="dropdown">
									<a data-toggle="collapse" href="#dropdown-lvl1">
										<span class="glyphicon glyphicon-align-justify"></span>Product Features<span
											class="caret"></span>
									</a>

									<!-- Dropdown level 1 -->
									<div id="dropdown-lvl1" class="panel-collapse collapse">
										<div class="panel-body">
											<ul class="nav navbar-nav">
												{{-- <li><a href="{{route('brand.list')}}">Brands</a></li> --}}
												<li><a href="{{route('product.list')}}"><span class="glyphicon  glyphicon-th-list"></span>Product</a></li>

												<!-- Dropdown level 2 -->
												<li class="panel panel-default" id="dropdown">
													<a data-toggle="collapse" href="#dropdown-lvl2">
														<span class="glyphicon glyphicon glyphicon-tasks"></span> Category <span
															class="caret"></span>
													</a>
													<div id="dropdown-lvl2" class="panel-collapse collapse">
														<div class="panel-body">
															<ul class="nav navbar-nav">
																<li><a href="{{route('category.list')}}"><span class="glyphicon glyphicon-list-alt"></span>Categories</a></li>
																<li><a href="{{route('subcategory.list')}}"><span class="glyphicon glyphicon-file"></span>Sub Categories</a></li>
															</ul>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</li>

								<li><a href="{{route('order.list')}}"><span class="glyphicon glyphicon-shopping-cart"></span> Orders</a></li>
								<li><a href="{{route('users.list')}}"><span class="glyphicon glyphicon glyphicon-user"></span> Users</a></li>
								<li><a href="{{route('roles.list')}}"><span class="glyphicon glyphicon glyphicon-user"></span> Roles</a></li>

							</ul>
						</div><!-- /.navbar-collapse -->
					</nav>

				</div>
			</div>
		</div>


        @yield('content') 

	</div>
	<footer class="pull-left footer">
		<p class="col-md-12">
			<hr class="divider">
			Copyright &COPY; 2015 <a href="http://www.pingpong-labs.com">Gravitano</a>
		</p>
	</footer>
	</div>

</html>