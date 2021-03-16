@extends('layouts.app' )
@php
    $title = "";
    $logo = "no-logo.png";
    if( !is_null($aplikasi) ){
        $title = $aplikasi->nama;
        $logo = is_null($aplikasi->logo) || $aplikasi->logo == "" ? $logo : $aplikasi->logo;
    }
@endphp

@section('content')





<div class="headline container">
  <div class="row">
    <div class="col-md-1">
      <img class="img-responsive m-auto" src="{{ asset('img/'.$logo) }}" style="">
    </div>
    <div class="col-md-10 text-white">
      <h3 style="text-align: center;">
        {{ strtoupper($title) }}
      </h3>
    </div>
  </div>
</div>


<div class="col-md-4"></div>
<div class="col-md-4" style="text-align: center;">
  @if (Session::has('message'))
  <div class="alert alert-{{ Session::get('message_type') }}" role="alert">{{ Session::get('message') }}</div>
  @endif
</div>
<div class="col-md-4"></div>

<div class="login_wrapper col-md-4" style="margin: 7% 33%;">

  <div class="animate form login_form" style="border: 3px solid #fff; border-radius: 10px;">
    <div style="text-align: center; margin-top: -15%; margin-bottom: 5%">
      <img src="img/login.png" class="img-circle" style="height: 25vh;">
    </div>
    <section class="login_content">
      <form method="POST" action="{{ route('login') }}" autocomplete="off">
        @csrf
        <center>
          <div class="form-group" style="width: 80%">
            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus placeholder="Username">

            @if ($errors->has('username'))
            <span class="invalid-feedback" role="alert" style="color: #fff">
              {{ $errors->first('username') }}
            </span>
            @endif
          </div>
          
          <div class="form-group" style="width: 80%">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
          </div>
        </center>

        <hr>
        <div class="form-group">
          <center>
            <button type="submit" class="btn btn-sm btn-default" style="width: 40%">
              {{ __('Login') }}
            </button>
          </center>
        </div>

        <div class="clearfix"></div>

        <!-- <center>
          <div class="separator">
          <h5 class="change_link" style="color: #fff">New user?
            <a href="{{ route('register') }}" class="to_register" style="color: #fff">{{ __('Register') }}</a>
          </h5>

          <div class="clearfix"></div>
        </div>
        </center> -->
      </form>
    </section>
  </div>
</div>


@endsection
