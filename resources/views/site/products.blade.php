@extends('layouts.site')

@section('header')
	@if( isset($page_blocks) && in_array('HEADER_STICKY_2', $page_blocks) )
		@include('site.header2')
	@endif
@endsection

@section('mobilmenu')
	@include('site.mobilmenu')
@endsection

@section('content')
	@include('site.content_products')
@endsection

@section('footer')
	@include('site.footer')
@endsection

@section('quickview')
	@include('site.quickview')
@endsection