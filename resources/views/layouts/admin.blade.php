<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal" >
  <link rel="shortcut icon" href="{{ asset('adm/favicon.png') }}">

  <title>{{ $title or 'Souvenir Co. AdminPanel' }}</title>

  <!-- Bootstrap CSS -->    
  <link href="{{ asset('adm/bootstrap-3.2.0/css/bootstrap.css') }}" rel="stylesheet" />
  <!-- bootstrap theme -->
  <link href="{{ asset('adm/css/bootstrap-theme.css') }}" rel="stylesheet" />
  <!-- font icon -->
  <link href="{{ asset('adm/icon-fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" />   
  <!-- external css-->
  <link href="{{ asset('adm/bootstrap-iconpicker/css/bootstrap-iconpicker.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('adm/assets/css/magnific-popup.css') }}">
  <link href="{{ asset('adm/css/ekko-lightbox.css') }}" rel="stylesheet"  />
  <!-- full calendar css-->
  <link href="{{ asset('adm/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css') }}" rel="stylesheet" />
  <link href="{{ asset('adm/assets/fullcalendar/fullcalendar/fullcalendar.css') }}" rel="stylesheet" />
  <link href="{{ asset('adm/assets/fullcalendar/fullcalendar/demos/cupertino/theme.css') }}" rel="stylesheet" />
  <link href="{{ asset('adm/css/fullcalendar.css') }}" rel="stylesheet" />
  <!-- easy pie chart-->
  <link href="{{ asset('adm/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css" media="screen"/>
  <!-- owl carousel -->
  <link href="{{ asset('adm/css/owl.carousel.css') }}"  rel="stylesheet" />
  <link href="{{ asset('adm/css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" />
  <!-- Custom styles -->
  {{-- <link href="{{ asset('adm/css/widgets.css') }}" rel="stylesheet" /> --}}
  <link href="{{ asset('adm/css/elegant-icons-style.css') }}" rel="stylesheet" />
  <link href="{{ asset('adm/css/style.css') }}" rel="stylesheet" />
  
  <link href="{{ asset('adm/css/style-responsive.css') }}" rel="stylesheet" />
  <link href="{{ asset('adm/css/xcharts.min.css') }}" rel=" stylesheet" />	
  <link href="{{ asset('adm/css/jquery-ui-1.10.4.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('adm/assets/jquery-ui/jquery-ui-1.10.1.custom.css') }}" rel="stylesheet" />
  {{-- <link href="{{ asset('adm/css/jquery-ui.css') }}" rel="stylesheet" /> --}}
  <link href="{{ asset('adm/css/custom.css') }}" rel="stylesheet" />
  {{-- <link href="{{ asset('adm/assets/style.css') }}" rel="stylesheet" /> --}}
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">
    <header class="header dark-bg">
      @yield('header')
    </header>      
    <!--header end-->

    <aside>
      @yield('sidebar')
    </aside>
    
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper"> 
       <div class="row">
        <div class="col-lg-12">
          @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
          @endif
          @yield('content')
        </div>  
      </div>
    </section>
  </section>
</section>

<!-- javascripts -->
<script src="{{ asset('adm/js/jquery.js') }}"></script>
<script src="{{ asset('adm/js/jquery-ui-1.10.4.min.js') }}"></script>
<script src="{{ asset('adm/jquery/jquery-1.10.2.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('adm/js/jquery-ui-1.9.2.custom.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('adm/js/bootstrap.min.js') }}"></script>
<!-- nice scroll -->
<script src="{{ asset('adm/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('adm/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
<!-- Bootstrap-Iconpicker Iconset for Font Awesome -->
<script src="{{ asset('adm/bootstrap-iconpicker/js/iconset/iconset-fontawesome-4.3.0.min.js') }}" type="text/javascript"></script>
<!-- Bootstrap-Iconpicker -->
<script src="{{ asset('adm/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('adm/bootstrap-iconpicker/js/iconset/iconset-glyphicon.js') }}" type="text/javascript"></script>

<!-- charts scripts -->
<script src="{{ asset('adm/assets/jquery-knob/js/jquery.knob.js') }}"></script>
<script src="{{ asset('adm/js/jquery.sparkline.js') }}" type="text/javascript"></script>
<script src="{{ asset('adm/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
<script src="{{ asset('adm/js/owl.carousel.js') }}" type="text/javascript" ></script>

<script src="{{ asset('adm/js/fullcalendar.min.js') }}"></script> 
{{-- <script src="{{ asset('adm/assets/fullcalendar/fullcalendar/fullcalendar.js') }}"></script> --}}
<!--script for this page only-->
<script src="{{ asset('adm/js/calendar-custom.js') }}"></script>
<script src="{{ asset('adm/js/jquery.rateit.min.js') }}"></script>
<!-- custom select -->
<script src="{{ asset('adm/js/jquery.customSelect.min.js') }}" ></script>
<script src="{{ asset('adm/assets/chart-master/Chart.js') }}"></script>
<script src="{{ asset('adm/js/bootstrap-filestyle.min.js') }}"></script>

<script src="{{ asset('adm/assets/js/jquery.magnific-popup.min.js') }}"></script>
<!--custome script for all page-->
<script src="{{ asset('adm/js/scripts.js') }}"></script>
<script src="{{ asset('adm/assets/ckeditor/ckeditor.js') }}"></script> 
<script src="{{ asset('adm/js/ekko-lightbox.js') }}"></script> 
<!-- custom script for this page-->

<script src="{{ asset('adm/js/sparkline-chart.js') }}"></script>
<script src="{{ asset('adm/js/easy-pie-chart.js') }}"></script>
<script src="{{ asset('adm/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('adm/js/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('adm/js/xcharts.min.js') }}"></script>
<script src="{{ asset('adm/js/jquery.autosize.min.js') }}"></script>
<script src="{{ asset('adm/js/jquery.placeholder.min.js') }}"></script>
<script src="{{ asset('adm/js/gdp-data.js') }}"></script> 
<script src="{{ asset('adm/js/morris.min.js') }}"></script>
<script src="{{ asset('adm/js/sparklines.js') }}"></script> 
<script src="{{ asset('adm/js/charts.js') }}"></script>
<script src="{{ asset('adm/js/charts.js') }}"></script>
<script src="{{ asset('adm/js/filterselect.js') }}"></script>
{{-- <script src="{{ asset('adm/js/plugins.js') }}"></script> --}}
<script src="{{ asset('adm/js/jquery-ui.js') }}"></script>
<script src="{{ asset('adm/js/custom.js') }}"></script>

<script>

      //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
      });

      carousel
      $(document).ready(function() {
        $("#owl-slider").owlCarousel({
          navigation : true,
          slideSpeed : 300,
          paginationSpeed : 400,
          singleItem : true

        });
      });

      //custom select box

      $(function(){
        $('select.styled').customSelect();
      });
      
      /* ---------- Map ---------- */
      $(function(){
       $('#map').vectorMap({
         map: 'world_mill_en',
         series: {
           regions: [{
             values: gdpData,
             scale: ['#000', '#000'],
             normalizeFunction: 'polynomial'
           }]
         },
         backgroundColor: '#eef3f7',
         onLabelShow: function(e, el, code){
           el.html(el.html()+' (GDP - '+gdpData[code]+')');
         }
       });
     });

   </script>

 </body>
 </html>

