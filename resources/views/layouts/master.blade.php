<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
@php
    $title = "";
    $logo = "no-logo.png";
    if( !is_null($aplikasi) ){
        $title = $aplikasi->nama;
        $logo = is_null($aplikasi->logo) || $aplikasi->logo == "" ? $logo : $aplikasi->logo;
    }
@endphp
<link rel="icon" href="{{ asset('img/'.$logo) }}" type="any" sizes="any">
<title>@yield('title', $title)</title>

<!-- Bootstrap -->
<link href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('vendor/bootstrap/dist/css/bootstrap-notification.min.css')}}" rel="stylesheet">

<!--[if lt IE 9]>
<script src="{{ asset('js/html5shiv.min.js') }}"></script>
<script src="{{ asset('js/respond.min.js') }}"></script>
<![endif]-->
<!-- Font Awesome -->
<link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<!-- bootstrap-daterangepicker -->
<link href="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
<!-- Datatables -->
<link href="{{ asset('css/admin/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">


<link href="{{ asset('vendor/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
<!-- Leaflet -->
<link href="{{ asset('vendor/leafletjs/leaflet.css') }}" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="{{ asset('vendor/build/css/custom.min.css')}}" rel="stylesheet">
<style type="text/css">
.overflow-auto{
  	overflow: auto!important;
}

input:-moz-read-only { /* For Firefox */
  	background-color: #e8e8e8;
  	border: solid 1px #d4d4ce;
}

input:read-only {
  	background-color: #e8e8e8;
  	border: solid 1px #d4d4ce;
}
.m-0{
  	margin:0!important;
}
.p-0{
  	padding:0!important;
}
</style>
@stack('style')
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
		    <div class="col-md-3 left_col">
		        <div class="left_col scroll-view">
		          	<div class="navbar nav_title" style="border: 0;">
		            	<!-- menu profile quick info -->
		            	<div class="profile clearfix">
			              	<div class="profile_pic">
			                	<img src="{{ asset('img/pegawai/'.Auth::User()->foto ) }}" class="img-circle profile_img">
			              	</div>
			              	<div class="profile_info">
			                	<span>Welcome,</span>
			                	<h2>{{ Auth::User()->nama }}</h2>
			              	</div>
		            	</div>
		            	<!-- /menu profile quick info -->
		          	</div>

		          	<div class="clearfix"></div>

		          	<br />
		          	@include('layouts.sidebar')
		        </div>
		    </div>

		      <!-- top navigation -->
		    <div class="top_nav">
		        <div class="nav_menu">
			        <nav>
			            <div class="nav toggle">
			              	<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			            </div>
			            {{-- 
			            <ul class="nav navbar-nav">
	                        <li class=" dropdown-notifications">
	                          	<a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
	                            	<i data-count="0" class="glyphicon glyphicon-bell notification-icon"></i>
	                          	</a>

	                          	<div class="dropdown-container">
	                            	<div class="dropdown-toolbar">
	                              	<div class="dropdown-toolbar-actions">
	                                	<a href="#">Mark all as read</a>
	                              	</div>
	                              	<h3 class="dropdown-toolbar-title">Notifications (<span class="notif-count">0</span>)</h3>
	                            	</div>
	                            	<ul class="dropdown-menu">
	                            	</ul>
	                            	<div class="dropdown-footer text-center">
	                              	<a href="#">View All</a>
	                           	 </div>
	                          	</div>
	                        	</li>
	                        	<li><a href="#">Timeline</a></li>
	                        	<li><a href="#">Friends</a></li>
			            </ul> 
			            --}}

			            <ul class="nav navbar-nav navbar-right">
			              	<li class="">
			                	<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
			                  	<i class="fa fa-sign-out pull-right" style="margin-top: 15%"></i> {{ __('Logout') }}
			                	</a>

			                	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			                  	@csrf
			                	</form>
			              	</li>


			              	<li>
			                	<a class="user-profile">
			                  		Selamat Datang, <img src="{{ asset('img/user/'.Auth::User()->img ) }}" alt="">{{ Auth::User()->nama }}
			                	</a>
			              	</li>
			              
			            </ul>
			        </nav>
		        </div>
		    </div>
		      <!-- /top navigation -->

		      <!-- page content -->
		    <div class="right_col" role="main">
		        @yield('content')
		    </div>
		      <!-- /page content -->
		</div>

	    <!-- footer content -->
	    <footer class="footer_fixed">
	      <div class="pull-right">
	        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
	      </div>
	      <div class="clearfix"></div>
	    </footer>
	    <!-- /footer content -->
	</div>


	<!-- jQuery -->
	<script src="{{ asset('vendor/jquery/dist/jquery.min.js')}}"></script>
	<!-- Bootstrap -->
	<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('js/pakars1.js') }}"></script>
	<!-- PUsher -->
	<script src="{{ asset('vendor/pusher/pusher.min.js')}}"></script>

	<!-- bootstrap-daterangepicker -->
	<script src="{{ asset('vendor/moment/min/moment.min.js')}}"></script>
	<script src="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	  <!-- Datatables | Table -->
	<script src="{{ asset('js/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('js/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('js/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

	<!-- leaflet -->
	<script src="{{ asset('vendor/leafletjs/leaflet.js')}}"></script>
	<script src="{{ asset('vendor/leafletjs/leaflet-src.js')}}"></script>
	<script src="{{ asset('vendor/leaflet-providers/leaflet-providers.js')}}"></script>
	<script src="{{ asset('vendor/leafletjs/plugin/Leaflet.AccuratePosition/Leaflet.AccuratePosition.js')}}"></script>
	<script src="{{ asset('vendor/leafletjs/plugin/Leaflet.LocationShare/Leaflet.LocationShare.js')}}"></script>

	<!-- Custom Theme Scripts -->
	<script src="{{ asset('vendor/build/js/custom.min.js')}}"></script>

	<script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
	<script>
	  	if(document.getElementById("editor")){
	    	var konten = document.getElementById("editor");
		      	CKEDITOR.replace(konten,{
		      	language:'en-gb'
	    	});
	    	CKEDITOR.config.allowedContent = true;
	  	}
	  
	  
	</script>
	@stack('script')
	</body>
</html>