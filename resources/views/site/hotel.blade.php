@extends('layouts.site')

@section('header')
	@include('site.header2')
@endsection

@section('mobilmenu')
	@include('site.mobilmenu')
@endsection

@section('content')
	@include('site.content_hotel')
@endsection

@section('footer')
	@include('site.footer')
@endsection