@extends('layouts.app')

@section('content')

<div class="headline">
    <div class="col-md-1"><img src="{{ asset('img/logo.png') }}" style="width: 100%; height: 100%; margin-left: 230%"></div>
    <div class="col-md-10"><h3 style="text-align: center;">SISTEM INFORMASI <br>PENERIMAAN PELATIHAN TENAGA KERJA <br> UPTD. BALAI LATIHAN KERJA INDUSTRI DAN PARIWISATA</h3></div>
</div>

<div class="login_wrapper col-md-4" style="margin: 7% 33%;">


    <div class="animate form login_form" style="border: 3px solid #fff; border-radius: 10px;">
    <div style="text-align: center; margin-top: -15%; margin-bottom: 5%">
      <img src="img/login.png" class="img-circle" style="height: 30%; width: 30%;">
    </div>
        <section class="login_content">
            <form method="POST" action="/goRegister" autocomplete="off">
                @csrf
                <center>
                    <div class="form-group" style="width: 80%">
                    
                    <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required autofocus placeholder="Nama Lengkap">

                    @if ($errors->has('nama'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group" style="width: 80%">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="E-Mail">

                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group" style="width: 80%">
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus placeholder="Username  [3-10 karakter]">

                    @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
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

                {{-- <div class="form-group" style="width: 80%">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                </div> --}}

                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-default" style="width: 40%">
                        {{ __('Register') }}
                    </button>
                </div>

                <div class="clearfix"></div>
                </center>
            </form>
        </section>
    </div>
</div>
@endsection
