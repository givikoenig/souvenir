@extends('layouts.admin')

@section('header')
	@include('admin.header')
@endsection

@section('sidebar')
	@include('admin.sidebar')
@endsection

@section('content')
	@include('admin.content_banners_search')
@endsection