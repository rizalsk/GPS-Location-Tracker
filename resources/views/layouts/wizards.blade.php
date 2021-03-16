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
  <title>@yield('title', $title )</title>


  <!-- Bootstrap -->
  <link href="{{ asset('css/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <!-- Custom Theme Style -->
  {{-- <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/build/css/custom.css') }}" rel="stylesheet">

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
                <img src="{{ asset('img/user/'.Auth::User()->foto ) }}" class="img-circle profile_img">
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
                  Selamat Datang, <img src="{{ asset('img/user/'.Auth::User()->img ) }}">{{ Auth::User()->nama }}
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
  </div>


  <script src="{{ asset('js/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('js/peserta/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
  <script src="{{ asset('js/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('css/build/js/custom.min.js') }}"></script>

</body>
</html>