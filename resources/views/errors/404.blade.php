@extends('layouts.site')

@section('header')
	@include('site.header2')
@endsection

@section('mobilmenu')
	@include('site.mobilmenu')
@endsection

@section('content')
	<div id="page-content" class="page-wrapper">
	    <div class="error-section mb-80">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-12 text-center">
	                    <h2 class="wl-pbl">СТРАНИЦА НЕ НАЙДЕНА</h2>
	                    <div class="error-404 box-shadow">
	                        <img src="{{asset('assets')}}/img/others/error2.jpg" alt="error">
	                        <div class="go-to-btn btn-hover-2">
	                            <a href="{{route('home')}}">на главную</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@section('footer')
	@include('site.footer')
@endsection