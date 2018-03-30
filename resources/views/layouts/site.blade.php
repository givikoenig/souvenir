<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $title or 'Souvenir Co.' }}</title>
    <meta name="description" content="фигурки янтарь, сувениры из янтаря, янтарные сувениры, фигурки животных янтарь, кошельковые сувениры, амулеты, обереги">
    <meta name="keywords" content="янтарные сувениры, обереги, бронза янтарь, фигурки животных бронза, кошельковые сувениры амулеты">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic|Exo+2|Fira+Sans|Noto+Sans&amp;subset=cyrillic,cyrillic-ext" rel="stylesheet"> 
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/icon/favicon.png') }}">
    <!-- All CSS Files -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Nivo-slider css -->
    <link rel="stylesheet" href="{{ asset('assets/lib/css/nivo-slider.css') }}">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="{{ asset('assets/css/core.css') }}">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="{{ asset('assets/css/shortcode/shortcodes.css') }}">
    <!-- Theme main style -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style_m.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <!-- countdown -->
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Template color css -->
    <link href="{{ asset('assets/css/color/color-core.css') }}" data-style="styles" rel="stylesheet">
    <!-- User style -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <!-- kladr -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.kladr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/form_with_map.css') }}">
    <!-- Modernizr JS -->
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- START HEADER AREA -->
        @yield('header')
        <!-- END HEADER AREA -->
        <!-- START MOBILE MENU AREA -->
        @yield('mobilmenu')
        <!-- END MOBILE MENU AREA -->
        <!-- START SLIDER AREA -->
        @yield('slider')
        <!-- END SLIDER AREA -->
        <!-- START PAGE CONTENT -->
        @yield('content')
        <!-- END PAGE CONTENT -->
        <!-- START FOOTER AREA -->
        @yield('footer')
        <!-- END FOOTER AREA -->
        <!-- START QUICKVIEW PRODUCT -->
        @yield('quickview')
        <!-- END QUICKVIEW PRODUCT -->    
    </div>
    <!-- Body main wrapper end -->
    <!-- Placed JS at the end of the document so the pages load faster -->
    <!-- jquery latest version -->
    <script src="{{ asset('assets/js/vendor/jquery-3.1.1.min.js') }}"></script>
    <!-- Bootstrap framework js -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootbox/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/comment-reply.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>
    <script src="{{ asset('assets/js/myscripts.js') }}"></script>
    <!-- jquery.nivo.slider js -->
    <script src="{{ asset('assets/lib/js/jquery.nivo.slider.js') }}"></script>
    <!-- All js plugins included in this file. -->
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.elevatezoom.js') }}"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- kladr -->
    <script src="{{ asset('assets/js/jquery.kladr.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/form.js') }}"></script> -->
    <script src="{{ asset('assets/js/form_with_map.js') }}"></script>
    <script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
    <!-- Google Map js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIH50GgDpslFv1iAe-lyhZOESBRilYAOQ"></script>
    <script src="{{ asset('assets/js/map.js') }}"></script>
   

</body>
</html>