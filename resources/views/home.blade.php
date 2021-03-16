@extends('layouts.master')

@section('content')

@php
    $title = "";
    $logo = "no-logo.png";
    if( !is_null($aplikasi) ){
        $title = $aplikasi->nama;
        $logo = is_null($aplikasi->logo) || $aplikasi->logo == "" ? $logo : $aplikasi->logo;
    }
@endphp
<style>
	/* Slideshow container */
	.slideshow-container {
		max-width: 100%;
		position: relative;
		margin: auto;
	}
	/* The dots/bullets/indicators */
	.dot {
		height: 15px;
		width: 15px;
		margin: 0 2px;
		background-color: #bbb;
		border-radius: 50%;
		display: inline-block;
		transition: background-color 0.6s ease;
	}
	.activeslide {
		background-color: #717171;
	}
	/* Fading animation */
	.fade {
		-webkit-animation-name: fade;
		-webkit-animation-duration: 3.9s;
		animation-name: fade;
		animation-duration: 3.9s;
	}
	@-webkit-keyframes fade {
		from {opacity: .4} 
		to {opacity: 1}
	}
	@keyframes fade {
		from {opacity: .1} 
		to {opacity: 1}
	}
	/* On smaller screens, decrease text size */
	@media only screen and (max-width: 300px) {
		.text {font-size: 11px}
	}

	.morecontent span {
		display: none;
	}
	.morelink {
		display: block;
	}
</style>


<div class="headline" >
	<div class="col-md-2" style="text-align: center;"><img src="{{ asset('img/'.$logo ) }}" style="width: 55%; height: 55%;"></div>
	<div class="col-md-8"><h3 style="text-align: center; font-weight: bold">{{ strtoupper($title) }}</h3></div>
</div>

<div class="row" style="margin-top: 25vh;">
	<div class="slideshow-container " >

		@foreach($sliders as $key => $slider)
		<div class="mySlides fade">
			<img src="{{ asset('img/sliders/'.$slider->image)}}" style="width:100%;height: 350px">
		</div>
		@endforeach

		<div style="text-align:center">
			@foreach($sliders as $key => $slider)
			<span class="dot"></span> 
			@endforeach
		</div>
	</div>
</div>

<script src="{{ asset('js/jqueryy/jj.js') }}"></script>
	
@endsection