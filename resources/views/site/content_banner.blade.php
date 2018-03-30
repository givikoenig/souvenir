
@if (isset($banners))
        <!-- BANNER-SECTION START -->
        <div class="banner-section ptb-60">
            <div class="container">
                <div class="row">

                    <!-- banner-item start -->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        @if (isset($banners[0]))
                        <div class="banner-item banner-2">
                            <div class="banner-img">
                                <a href="{{ route('product', array('id' => $banners[0]['id'])) }}"><img src="{{ asset('assets') }}/img/banner/{{ $banners[0]['images'] }}" alt="banner1.jpg" title="{{ $banners[0]['name'] }}"></a>
                            </div>
                            <h5 class="banner-title-2" title="{{ $banners[0]['name'] }}"><a href="{{ route('product', array('id' => $banners[0]['id'])) }}">{{ str_limit($banners[0]['name'],20) }}</a></h5>
                            <h3 class="pro-price">{{ $banners[0]['price'] }} <span class="rouble">c</span> </h3>
                            <div class="banner-button">
                             <a href="{{ route('product', array('id' => $banners[0]['id'])) }}" data-product_name="{{ $banners[0]['name'] }}" >Купить прямо сейчас <i class="zmdi zmdi-long-arrow-right"></i></a> 
                         </div>
                     </div>
                     @endif
                 </div>
                 <!-- banner-item end -->

                 <!-- banner-item start -->
                 <div class="col-md-4 col-sm-6 col-xs-12">
                    {{-- @if (isset($banners[1])) --}}
                    @if ($i)
                    <div class="banner-item banner-3">
                        <div class="banner-img">
                            <a href="{{ route('product', array('id' => $banners[1]['id'])) }}"><img src="{{ asset('assets') }}/img/banner/{{ $banners[1]['images'] }}" alt="banner2.jpg" title="{{ $banners[1]['name'] }}"></a>
                        </div>
                        <div class="banner-info text-left">
                            <h5 class="banner-title-2" title="{{ $banners[1]['name'] }}"><a href="{{ route('product', array('id'=>$banners[1]['id'])) }}">{{ str_limit($banners[1]['name'],20) }}</a></h5>
                            <ul class="banner-featured-list">
                                @if (isset($banner2txt))
                                @foreach ($banner2txt as $string)
                                <li class="text-left" style="width: 100%;">
                                    <i class="zmdi zmdi-check"></i><span>{{ $string[0] ? $string[0] : '...' }} {{ $string[1] ? $string[1] : '...' }} {{-- {{ $string[2] ? $string[2] : '...' }} --}}</span>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                            <div class="banner-button text-center">
                               <a href="{{ route('product', array('id'=>$banners[1]['id'])) }}">Подробно <i class="zmdi zmdi-long-arrow-right"></i></a> 
                           </div>
                       </div>
                 </div>
                 @endif
             </div> 
             <!-- banner-item end -->
             <!-- banner-item start -->
             @php
                $i ? $n = 2 : $n = 1;
             @endphp
             <div class="col-md-4 hidden-sm col-xs-12">
                @if (isset($banners[$n]))
                <div class="banner-item banner-4">
                    <div class="banner-img">
                        <a href="{{ route('product', array('id' => $banners[$n]['id'])) }}"><img src="{{ asset('assets') }}/img/banner/{{ $banners[$n]['images'] }}" alt="banner3.jpg" title="{{ $banners[$n]['name'] }}"></a>
                    </div>
                    <h5 class="banner-title-2" title="{{ $banners[$n]['name'] }}"><a href="{{ route('product', array('id' => $banners[$n]['id'])) }}">{{ str_limit($banners[$n]['name'],20) }}</a></h5>
                    <div class="banner-button">
                         <a href="{{ route('product', array('id' => $banners[$n]['id'])) }}">Купить прямо сейчас <i class="zmdi zmdi-long-arrow-right"></i></a> 
                     </div>
                 </div>
                 @endif
             </div>
         <!-- banner-item end -->
        </div>
        </div>
        </div> 
        <!-- BANNER-SECTION END -->
        @endif

