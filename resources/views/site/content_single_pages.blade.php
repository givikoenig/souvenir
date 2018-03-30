@if(isset($page))
<div class="blog-section mb-50">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-xs-12">
                <div class="blog-details-area">
                    @if($page->img)
                    <div class="blog-details-photo bg-img-1 p-20 mb-30">
                        <img src="{{ asset('assets') }}/img/others/{{ json_decode($page->img, true)['max'] }}" alt="">
                    </div>
                    @endif
                    <h3 class="blog-details-title mb-30">{{ $page->title }}</h3>
                    <div class="blog-description mb-60">
                        {!! $page->desc !!}
                        <div class="quote-author pl-60 quote-border">
                            {!! $page->excerption !!}
                        </div>
                        <br />
                        {!! $page->text !!}    
                    </div>
                    <div class="blog-share-tags box-shadow clearfix mb-50">
                        <div class="blog-share f-left">
                            <p class="share-tags-title f-left">поделиться</p>
                            <ul class="footer-social f-left">
                                @set($ttl,urlencode($page->title))
                                @set($url, urlencode( Request::fullUrl() ) )
                                @set($summary,urlencode($page->desc))
                                @set($image,urlencode(json_decode($page->img, true)['mini']))
                                <li>
                                    <a class="facebook b-xfbml-parse-ignore" onClick="window.open('http://www.facebook.com/sharer.php?s=100&p[title]={{$ttl}}&p[summary]={{$summary}}&p[url]={{$url}}&&p[images][0]={{$image}}','sharer','toolbar=0,status=0,width=700,height=500');"  href="javascript: void(0)" title="Facebook"><i class="zmdi zmdi-facebook"></i></a>
                                </li>
                                <li>
                                    <a class="google-plus" onClick="window.open('https://plusone.google.com/_/+1/confirm?hl=ru&amp;url={{$url}}','sharer','toolbar=0,status=0,width=700,height=500');" href="javascript: void(0)" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a>
                                </li>
                                <li>
                                    <a class="twitter" onClick="window.open('https://twitter.com/share?url={{url()->current()}}','sharer','toolbar=0,status=0,width=700,height=500');" href="javascript: void(0)" title="Twitter"><i class="zmdi zmdi-twitter"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="blog-share-tags sbox-shadow clearfix mb-30">
                        <!-- BANNER-SECTION START -->
                        @if( isset($litera_page_blocks) && in_array('BANNER', $litera_page_blocks) )
                            @if (isset($banners))
                            <div class="banner-section mb-30">
                                <div class="container">
                                    <div class="row">
                                        <!-- banner-item start -->
                                        <div class="col-md-4  col-xs-12">
                                            @if ($banners[0])
                                            <div class="banner-item banner-2">
                                                <div class="banner-img">
                                                    <a href="{{ route('product', array('id' => $banners[0]['id'])) }}"><img src="{{ asset('assets') }}/img/banner/{{ $banners[0]['images'] }}" alt=""></a>
                                                </div>
                                                <h5 class="banner-title-2"><a href="{{ route('product', array('id' => $banners[0]['id'])) }}">{{ str_limit($banners[0]['name'],20) }}</a></h5>
                                                <h3 class="pro-price">{{ $banners[0]['price'] }} <span class="rouble">c</span> </h3>
                                                <div class="banner-button">
                                                 <a href="{{ route('product', array('id' => $banners[0]['id'])) }}" data-product_name="{{ $banners[0]['name'] }}" >Купить прямо сейчас <i class="zmdi zmdi-long-arrow-right"></i></a> 
                                             </div>
                                         </div>
                                         @endif
                                     </div>
                                     <!-- banner-item end -->
                                     <!-- banner-item start -->
                                     <div class="col-md-4 col-xs-12">
                                        @if ($banners[1])
                                        <div class="banner-item banner-3">
                                            <div class="banner-img">
                                                <a href="{{ route('product', array('id' => $banners[1]['id'])) }}"><img src="{{ asset('assets') }}/img/banner/{{ $banners[1]['images'] }}" alt=""></a>
                                            </div>
                                            <div class="banner-info text-right">
                                                <h5 class="banner-title-2"><a href="{{ route('product', array('id'=>$banners[1]['id'])) }}">{{ str_limit($banners[1]['name'],20) }}</a></h5>
                                                <ul class="banner-featured-list">

                                                    @foreach ($banner2txt as $string)
                                                    <li class="text-left">
                                                        <i class="zmdi zmdi-check"></i><span>{{ $string[0] ? $string[0] : '...' }} {{ $string[1] ? $string[1] : '...' }} {{-- {{ $string[2] ? $string[2] : '...' }} --}}</span>
                                                    </li>
                                                    @endforeach    
                                                </ul>
                                                <div class="banner-button">
                                                 <a href="{{ route('product', array('id'=>$banners[1]['id'])) }}">Подробно <i class="zmdi zmdi-long-arrow-right"></i></a> 
                                             </div>
                                         </div>
                                     </div>
                                     @endif
                                 </div> 
                                 <!-- banner-item end -->
                                 <!-- banner-item start -->
                                 <div class="col-md-4 hidden-sm col-xs-12">
                                    <div class="banner-item banner-4">
                                        <div class="banner-img">
                                            <a href="{{ route('product', array('id' => $banners[2]['id'])) }}"><img src="{{ asset('assets') }}/img/banner/{{ $banners[2]['images'] }}" alt=""></a>
                                        </div>
                                        <h5 class="banner-title-2" ><a href="{{ route('product', array('id' => $banners[2]['id'])) }}">{{ str_limit($banners[2]['name'],20) }}</a></h5>
                                        <div class="banner-button">
                                             <a href="{{ route('product', array('id' => $banners[2]['id'])) }}">Купить прямо сейчас <i class="zmdi zmdi-long-arrow-right"></i></a> 
                                         </div>
                                     </div>
                                 </div>
                             <!-- banner-item end -->
                            </div>
                            </div>
                            </div> 
                            @endif
                        @endif
                        <!-- BANNER-SECTION END -->
                        <!-- UP COMMING PRODUCT SECTION START -->
                        @if( isset($litera_page_blocks) && in_array('UP_COMING_PRODUCT', $litera_page_blocks) )
                            @if(isset($upcomming))
                            <div class="up-comming-product-section mb-30">
                                <div class="container">
                                    <div class="row">
                                        @if ($upcomming)
                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                            <div class="up-comming-pro gray-bg clearfix">
                                                <div class="up-comming-pro-img f-left">
                                                    <a href="#">
                                                        <img src="{{ asset('assets') }}/img/up-comming/{{ $upcomming->img_362x350 }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="up-comming-pro-info f-left">
                                                    <h3><a href="#">{{ $upcomming->title }}</a></h3>
                                                    <p>{{ str_limit($upcomming->text, 275 ) }}</p>
                                                    <div class="up-comming-time">
                                                        <div data-countdown="{{ $upcomming->until_date->format('Y/m/d') }}"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 hidden-sm col-xs-12">
                                                <div class="banner-item banner-1">
                                                    <div class="ribbon-price">
                                                        <span>&#8381; {{ $upcomming->product->price }}</span>
                                                    </div>
                                                    <div class="banner-img">
                                                        <a href="{{ route('product', array($upcomming->product->id)) }}"><img src="{{ asset('assets') }}/img/banner/{{ $upcomming->banner_image }}" alt=""></a>
                                                    </div>
                                                    <div class="banner-info">
                                                        <h3><a href="{{ route('product', array($upcomming->product->id)) }}">{{ $upcomming->product->name }}</a></h3>
                                                        <ul class="banner-featured-list">
                                                            @if(isset($upcomming_txt) )
                                                                @foreach($upcomming_txt as $txt)
                                                                <li  class="text-left">
                                                                    <i class="zmdi zmdi-check"></i><span>{{ $txt[0] ? $txt[0] : '...' }} {{ $txt[1] ? $txt[1] : '...' }}</span>
                                                                </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                        <br />
                                                        <div class="banner-button text-center">
                                                           <a href="{{ route('product', array($upcomming->product->id)) }}">Подробно <i class="zmdi zmdi-long-arrow-right"></i></a> 
                                                       </div>
                                                   </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                @if( isset($litera_page_blocks))
                    @if (in_array('SALE_PRODUCTS', $litera_page_blocks))
                        @if (isset($sale_products))
                        <div class="dropdown-width mt-30">
                            <aside class="widget widget-product box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">распродажа</h6>
                                @foreach ($sale_products as $sale_product)
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="{{ route('product',['id' => $sale_product['id']]) }}">
                                            <img src="{{ asset('assets') }}/img/product/{{ json_decode($sale_product['images'],true)['med'] }}" alt="{{ $sale_product['name'] }}"/>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6>
                                            <a href="{{ route('product',['id' => $sale_product['id']]) }}" title="{{ $sale_product['name'] }}" >{{ $sale_product['name'] }}</a>
                                        </h6>
                                        <h3 class="pro-price">{{$sale_product['price']}}&#8381; <span class="oldprice">{{$sale_product['old_price'] ? $sale_product['old_price'] .'&#8381;' : '' }}</span> </h3>
                                    </div>
                                </div>
                                @endforeach
                            </aside>
                        </div>
                        @endif
                    @endif
                    @if ((in_array('NEW_PRODUCTS', $litera_page_blocks)))
                        @if(isset($new_products))
                        <div class="dropdown-width mt-30">
                            <aside class="widget widget-product">
                                <h6 class="widget-title border-left mb-20">Наши новинки</h6>
                                @foreach($new_products as $new_product)
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="{{ route('product',['id' => $new_product['id']]) }}">
                                            <img src="{{ asset('assets') }}/img/product/{{ json_decode( $new_product['images'],true )['med'] }}" alt=""  />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6>
                                            <a href="{{ route('product',['id' => $new_product['id']]) }}">{{ $new_product['name'] }}</a>
                                        </h6>
                                        <h3 class="pro-price">{{ $new_product['price'] }} <span class="rouble">c</span> </h3>
                                    </div>
                                </div>
                                @endforeach
                            </aside>
                        </div>
                        @endif
                    @endif
                    @if ((in_array('HITS_PRODUCTS', $litera_page_blocks)))
                        @if(isset($hits_products))
                        <div class="dropdown-width mt-30">
                            <aside class="widget widget-product">
                                <h6 class="widget-title border-left mb-20">Хиты продаж</h6>
                                @foreach($hits_products as $hits_product)
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="{{ route('product',['id' => $hits_product['id']]) }}">
                                            <img src="{{ asset('assets') }}/img/product/{{ json_decode( $hits_product['images'],true )['med'] }}" alt=""  />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6>
                                            <a href="{{ route('product',['id' => $hits_product['id']]) }}">{{ $hits_product['name'] }}</a>
                                        </h6>
                                        <h3 class="pro-price">{{ $hits_product['price'] }} <span class="rouble">c</span> </h3>
                                    </div>
                                </div>
                                @endforeach
                            </aside>
                        </div>
                        @endif
                    @endif
                    @if ((in_array('SPEC_PRODUCTS', $litera_page_blocks)))
                        @if(isset($spec_products))
                        <div class="dropdown-width mt-30">
                            <aside class="widget widget-product">
                                <h6 class="widget-title border-left mb-20">эксклюзив</h6>
                                @foreach($spec_products as $spec_product)
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="{{ route('product',['id' => $spec_product['id']]) }}">
                                            <img src="{{ asset('assets') }}/img/product/{{ json_decode( $spec_product['images'],true )['med'] }}" alt=""  />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6>
                                            <a href="{{ route('product',['id' => $spec_product['id']]) }}">{{ $spec_product['name'] }}</a>
                                        </h6>
                                        <h3 class="pro-price">{{ $spec_product['price'] }} <span class="rouble">c</span> </h3>
                                    </div>
                                </div>
                                @endforeach
                            </aside>
                        </div>
                        @endif
                    @endif
                @endif
            </div>
            <!-- GOOGLE MAP SECTION START -->
            @if( isset($litera_page_blocks) && in_array('GOOGLE_MAP', $litera_page_blocks) )
            <div class="col-md-12 col-xs-12">
                <div class="google-map-section mb-30">
                    <div class="container-fluid">
                        <div class="google-map splr-185">
                            <div id="googleMap"></div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- GOOGLE MAP SECTION END -->
            <!-- NEWSLETTER SECTION START -->
            @if( isset($litera_page_blocks) && in_array('NEWSLETTER', $litera_page_blocks) )
            <div class="col-md-12 col-xs-12">
                <div class="newsletter-section section-bg-tb pt-60 pb-80">
                    <div class="container">
                        <div class="row">
                            {{-- <div class="col-md-8 col-md-offset-2 col-xs-12"> --}}
                            <div class="newsletter">
                                <div class="newsletter-info text-center">
                                    <h2 class="newsletter-title">новости</h2>
                                    <p>Подпишись на нашу новостную рассылку <br class="hidden-xs">и всегда оставайся в курсе самых интересных событий компании</p>
                                </div>
                                <div class="subcribe clearfix">
                                    <form method="post" action="">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <input type="email" name="email" placeholder=" Введите Ваш Еmail-адрес..."/>
                                        <button class="submit-btn-2 btn-hover-2" type="submit">подписаться</button>
                                    </form>
                                </div>
                            </div>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- NEWSLETTER SECTION END -->
        </div>
    </div>
</div>
@endif