@extends('layouts.site')
@section('header')
	@if( isset($main_page_blocks) && in_array('HEADER_STICKY', $main_page_blocks) )
		@include('site.header')
	@elseif( isset($main_page_blocks) && in_array('HEADER_STICKY_2', $main_page_blocks) )
		@include('site.header2')
	@endif
<div style="margin-top: 100px;" >
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
             <script>setTimeout(function(){location.href="/"} , 5000);</script>
        </div>
    @endif
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
         {{-- <script>setTimeout(function(){location.href="/"} , 5000);</script> --}}
        <script>setTimeout(function(){location = ''} , 5000);</script>
    @endif
</div>
@endsection
@section('mobilmenu')
	@include('site.mobilmenu')
@endsection
@section('slider')
    @if( isset($main_page_blocks) && in_array('SLIDER', $main_page_blocks) )
	   @include('site.slider')
    @endif
@endsection
@section('content')
	@include('site.content')
@endsection
@section('footer')
    @if( isset($main_page_blocks) && in_array('FOOTER_SMALL', $main_page_blocks) )
	   @include('site.footer')
    @endif
@endsection
@section('quickview')
	@include('site.quickview')
@endsection