<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link href="{{ asset('css/adminStyle.css') }}" rel="stylesheet" />
<link href="{{ asset('js/adminStyle.js') }}" rel="stylesheet" />
<!------ Include the above in your HEAD tag ---------->

<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
			MENU
			</button>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
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
							<li class="dropdown-header">SETTINGS</li>
							<li class=""><a href="#">Other Link</a></li>
							<li class=""><a href="#">Other Link</a></li>
							<li class=""><a href="#">Other Link</a></li>
							<li class="divider"></li>
							<li><a href="#">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>  	<div class="container-fluid main-container">
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
					<li class="active"><a href="#"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-plane"></span> Active Link</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-cloud"></span> Link</a></li>

					<!-- Dropdown-->
					<li class="panel panel-default" id="dropdown">
						<a data-toggle="collapse" href="#dropdown-lvl1">
							<span class="glyphicon glyphicon-user"></span> Sub Level <span class="caret"></span>
						</a>

						<!-- Dropdown level 1 -->
						<div id="dropdown-lvl1" class="panel-collapse collapse">
							<div class="panel-body">
								<ul class="nav navbar-nav">
									<li><a href="#">Link</a></li>
									<li><a href="#">Link</a></li>
									<li><a href="#">Link</a></li>

									<!-- Dropdown level 2 -->
									<li class="panel panel-default" id="dropdown">
										<a data-toggle="collapse" href="#dropdown-lvl2">
											<span class="glyphicon glyphicon-off"></span> Sub Level <span class="caret"></span>
										</a>
										<div id="dropdown-lvl2" class="panel-collapse collapse">
											<div class="panel-body">
												<ul class="nav navbar-nav">
													<li><a href="#">Link</a></li>
													<li><a href="#">Link</a></li>
													<li><a href="#">Link</a></li>
												</ul>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</li>

					<li><a href="#"><span class="glyphicon glyphicon-signal"></span> Link</a></li>

				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>

	</div>
</div>  		</div>
  		<div class="col-md-10 content">
  			  <div class="panel panel-default">
	<div class="panel-heading">
		Dashboard
	</div>
	<div class="panel-body">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</div>
</div>
  		</div>
		  {{-- <div class="container"> --}}
		  {{-- <div class="row"> --}}
			  <div class=" col-md-10">
				  <div class="panell">
					  
					  <div class="panell-body table-responsive">
						  <table class="table">
							  <thead>
								  <tr>
									  <th>#</th>
									  <th>Name</th>
									  <th>Age</th>
									  <th>Actions</th>
								  </tr>
							  </thead>
							  <tbody>
								  <tr>
									  <td>1</td>
									  <td>Vincent Williamson</td>
									  <td>31</td>
									  <td>
										<ul class="action-list">
											<li><a href="#" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a></li>
											<li><a href="#" class="btn btn-danger"><i class="fa fa-times"></i></a></li>
											<li><a href="#" class="btn btn-sm btn-success"><i class="fa fa-search"></i></a></li>
										</ul>
									  
									</td>
								  </tr>
								  <tr>
									  <td>2</td>
									  <td>Taylor Reyes</td>
									  <td>22</td>
									  <td>
										<ul class="action-list">
											<li><a href="#" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a></li>
											<li><a href="#" class="btn btn-danger"><i class="fa fa-times"></i></a></li>
											<li><a href="#" class="btn btn-sm btn-success"><i class="fa fa-search"></i></a></li>
										</ul>
									</td>
								  </tr>
								  <tr>
									  <td>3</td>
									  <td>Justin Block</td>
									  <td>26</td>
									  <td>
										<ul class="action-list">
											<li><a href="#" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a></li>
											<li><a href="#" class="btn btn-danger"><i class="fa fa-times"></i></a></li>
											<li><a href="#" class="btn btn-sm btn-success"><i class="fa fa-search"></i></a></li>
										</ul>
									</td>
								  </tr>
								  
							  </tbody>
						  </table>
					  </div>
					  <div class="panell-footer">
						  <div class="row">
							  <div class="col-sm-6 col-xs-6">showing <b>5</b> out of <b>25</b> entries</div>
							  <div class="col-sm-6 col-xs-6">
								  <ul class="pagination hidden-xs pull-right">
									  <li><a href="#">«</a></li>
									  <li class="active"><a href="#">1</a></li>
									  <li><a href="#">2</a></li>
									  <li><a href="#">3</a></li>
									  <li><a href="#">4</a></li>
									  <li><a href="#">5</a></li>
									  <li><a href="#">»</a></li>
								  </ul>
								  <ul class="pagination visible-xs pull-right">
									  <li><a href="#">«</a></li>
									  <li><a href="#">»</a></li>
								  </ul>
							  </div>
						  </div>
					  </div>
				  </div>
			  </div>
		  {{-- </div>
	  </div> --}}
	  
  		<footer class="pull-left footer">
  			<p class="col-md-12">
  				<hr class="divider">
  				Copyright &COPY; 2015 <a href="http://www.pingpong-labs.com">Gravitano</a>
  			</p>
  		</footer>
  	</div>