<!-- BREADCRUMBS SETCTION START -->
        <div class="breadcrumbs-section plr-200 mb-80">
            <div class="breadcrumbs overlay-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="breadcrumbs-inner">
                                <h1 class="breadcrumbs-title">{{ $product ? $product->name : 'Нет такого товара' }}</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="{{ route('home') }}"><i class="zmdi zmdi-home" style="font-size: 20px;"></i> домой</a></li>
                                    <li><a href="{{route('brands')}}">Магазин</a></li>
                                    @if(isset($product->subbrand->brand))
                                        <li><a href="{{route('brands', $product->subbrand->brand->alias)}}">{{ $product->subbrand->brand->name }}</a></li>
                                    @endif
                                    @if(isset($product->subbrand))
                                        <li><a href="{{route('brands', ['alias' => $product->subbrand->brand->alias, 'subalias' => $product->subbrand->alias]  )}}">{{ $product->subbrand->name }}</a></li>
                                    @endif
                                    <li>{{ $product ? $product->name : 'Нет такого товара' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMBS SETCTION END -->

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper">
                <div class="cart_result_here"></div>
            <!-- SHOP SECTION START -->
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-9 col-md-push-3 col-xs-12">
                            @if(isset($product))
                            <!-- single-product-area start -->
                            <div class="single-product-area mb-80">
                                <div class="row">
                                    <!-- imgs-zoom-area start -->
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        @if (isset($slides))
                                        <div class="imgs-zoom-area">
                                            <img class="zoom_03" src="{{asset('assets')}}/img/product/slides/{{ !empty($slides[0]) ? $slides[0] : 'noGoods.jpg' }}"  data-zoom-image="{{asset('assets')}}/img/product/slides/{{ !empty($slides[0]) ? $slides[0] : 'noGoods.jpg' }}" alt="">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div id="gallery_01" class="carousel-btn slick-arrow-3 mt-30">
                                                        @foreach ($slides as $slide)
                                                        <div class="p-c">
                                                            <a href="#" data-image="{{asset('assets')}}/img/product/slides/{{ !empty($slide) ? $slide : 'noGoods.png' }}" data-zoom-image="{{asset('assets')}}/img/product/slides/{{ !empty($slide) ? $slide : 'noGoods.png' }}">
                                                                <img src="{{asset('assets')}}/img/product/slides/{{ !empty($slide) ? $slide : 'noGoods.png' }}" alt="">
                                                            </a>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <!-- imgs-zoom-area end -->
                                    <!-- single-product-info start -->
                                    <div class="col-md-7 col-sm-7 col-xs-12"> 
                                        <div class="single-product-info">
                                            <h3 class="text-black-1">{{ $product->name }}</h3>
                                            <h6 class="brand-name-2">{{ $product->subbrand->brand->name .' - '. $product->subbrand->name }}</h6>
                                            <br />
                                            <h6 class="brand-name">Артикул: {{ $product->articul }}</h6>
                                            <hr>
                                            <div class="single-product-tab">
                                                <ul class="reviews-tab mb-20">
                                                    <li  class="active"><a href="#anons" data-toggle="tab">материал</a></li>
                                                    <li><a href="#description" data-toggle="tab">описание</a></li>
                                                    <li ><a href="#information" data-toggle="tab">характеристики</a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="anons">
                                                        <p>{!! $product->anons !!}</p>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="description">
                                                        <p>{!! $product->content !!}</p>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="information">
                                                        <p>{!! $product->techs !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            @if ($product->price)
                                            <div class="single-pro-color-rating clearfix">
                                                <h4 class="prod-price"> {{ $product->price }} <span class="rouble">c</span> </h4>
                                            </div>
                                            <hr>
                                            @endif
                                            <!-- plus-minus-pro-action -->
                                            <div class="plus-minus-pro-action">
                                                
                                                <form action="" method="post" class="add-form2 cart">
                                                   {!! csrf_field() !!}
                                                    <div class="sin-plus-minus f-left clearfix">
                                                        <p class="color-title f-left">Кол-во:</p>
                                                        <div class="cart-plus-minus2 f-left">
                                                            <input type="text" value="1" name="qtybutton" class="cart-plus-minus-box" {{$product->available == 0 ? 'disabled' : ''}} >
                                                        </div>
                                                        <ul class="beside-button action-button">
                                                            <li class="count-add-button">
                                                                @if($product->available == 1)
                                                                    <a href="#" type="submit" class="add-button2" attr-id="{{ $product->id }}" title="Добавить в корзину"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                                @elseif ($product->available == 0)
                                                                    <a href="javascript: void(0)" title="Нет в наличии"><i class="zmdi zmdi-close"></i></a>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </form>
                                                <div class="sin-pro-action f-right">
                                                    <ul class="action-button">
                                                        <li>

                                                            <form action="" method="post" class="add-wish">
                                                                {!! csrf_field() !!}
                                                                <a href="#" type="submit" class="add-wish-button prod-wish" attr-id="{{ $product->id }}" title="Добавить в избранное"><i class="zmdi zmdi-favorite"></i></a>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-toggle="modal"  data-target="#productModal"
                                                             data-url="{{ route('home') }}"
                                                             data-id="{{ $product->id }}" 
                                                             data-available="{{ $product->available }}" 
                                                             data-name="{{ $product->name }}" 
                                                             data-price="{{ $product->price }}" 
                                                             data-oldprice="{{ $product->old_price }}" 
                                                             data-content="{{ $product->content }}" 
                                                             data-image="{{ json_decode($product->images,true)['max'] }}" 
                                                             class="open-ProductModal" title="Просмотр"><i class="zmdi zmdi-zoom-in"></i></a>
                                                        </li>
                                                        <li>
                                                            <form action="" method="post" class="add-compare">
                                                                {!! csrf_field() !!}
                                                                <a href="#" type="submit" class="add-compare-button prod-wish" attr-id="{{ $product->id }}" title="Сравнить"><i class="zmdi zmdi-refresh"></i></a>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                    <!-- single-product-info end -->
                                </div>
                            </div>
                            <!-- single-product-area end -->
                            
                            @if (isset($related))
                            <div class="related-product-area">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="section-title text-left mb-40">
                                            <h2 class="uppercase">похожие товары</h2>
                                            <h6>Товары той же категории, близкие по цене</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="active-related-product">
                                         <!-- product-item start -->
                                         @foreach ($related as $item)
                                        <div class="col-xs-12">
                                            <div class="product-item">
                                                <div class="product-img">
                                                    <a href="{{route('product',$item->id)}}">
                                                        <img src="{{asset('assets')}}/img/product/{{ json_decode($item['images'],true)['med'] }}" alt=""/>
                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    <h6 class="product-title">
                                                        <a href="{{route('product',$item->id)}}">{{ $item->name }}</a>
                                                    </h6>
                                                    <h3 class="pro-price">{{ $item->price }} <span class="rouble">c</span> </h3>
                                                    <ul class="action-button">
                                                        <li>
                                                            <form action="" method="post" class="add-wish">
                                                                {!! csrf_field() !!}
                                                                <a href="#" type="submit" class="add-wish-button" attr-id="{{ $item->id }}" title="Избранное"><i class="zmdi zmdi-favorite"></i></a>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-toggle="modal"  data-target="#productModal"
                                                             data-url="{{ route('home') }}"
                                                             data-id="{{ $item->id }}" 
                                                             data-available="{{ $item->available }}" 
                                                             data-name="{{ $item->name }}" 
                                                             data-price="{{ $item->price }}" 
                                                             data-oldprice="{{ $item->old_price }}" 
                                                             data-content="{{ $item->content }}" 
                                                             data-image="{{ json_decode($item->images,true)['max'] }}" 
                                                             class="open-ProductModal" title="Просмотр"><i class="zmdi zmdi-zoom-in"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Сравнить"><i class="zmdi zmdi-refresh"></i></a>
                                                        </li>
                                                        <li>
                                                            <form action="" method="post" class="add-form2 dcart">
                                                                {!! csrf_field() !!}
                                                                @if($item->available == 1)
                                                                <input type="hidden" class="productqty" name="qty" value="1" />
                                                                <a href="#" type="submit" class="add-button2" attr-id="{{ $item->id }}" title="Добавить в корзину"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                                @elseif ($item->available == 0)
                                                                <a href="javascript: void(0)" title="Нет в наличии"><i class="zmdi zmdi-close"></i></a>
                                                                @endif
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <!-- product-item end -->
                                        
                                    </div>   
                                </div>
                            </div>
                            @endif

                            @else

                            <div class="single-product-area mb-80">
                                <div class="row">
                                    <div class="product-img text-center mt-30 noproduct-img">
                                        <img src="{{asset('assets')}}/img/product/noproduct.jpg"  alt="no product"/>
                                    </div>
                                </div>
                            </div>

                            @endif

                        </div>
                        

                        <div class="col-md-3 col-md-pull-9 col-xs-12">
                            <!-- widget-search -->
                            <aside class="widget-search mb-30">
                                <form action="{{ route('brands') }}">
                                    <input type="text" placeholder="Поиск товара..."  name="keyword">
                                    <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                </form>
                            </aside>

                            <!-- widget-categories -->
                            @if (isset($brands))
                            <aside class="widget widget-categories box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">Категории</h6>
                                <div id="cat-treeview" class="product-cat">
                                    <ul>

                                        @foreach ($brands as $brand)
                                            <li class="closed"><a href="#">{{ $brand->name }}</a>
                                                <ul>
                                                    <li><a href="{{ route('brands', $brand->alias) }}">Все {{ $brand->name }}</a></li>
                                                    @foreach ($brand->subbrands as $subbrand)
                                                    <li><a href="{{ route('brands', [$brand->alias, $subbrand->alias] ) }}">{{ $subbrand->name }}</a></li>
                                                    @endforeach
                                                    
                                                </ul>
                                            </li> 
                                        @endforeach

                                    </ul>
                                </div>
                            </aside>
                            @endif
                            
                            <!-- widget-product -->
                            @if (isset($new_products))
                                <aside class="widget widget-product box-shadow">
                                    <h6 class="widget-title border-left mb-20">последние поступлления</h6>
                                    @foreach($new_products as $new_product)
                                    <!-- product-item start -->
                                    <div class="product-item">
                                        <div class="product-img">
                                            <a href="{{ route('product',['id' => $new_product['id']]) }}">
                                                <img src="{{ asset('assets') }}/img/product/{{ json_decode( $new_product['images'],true )['med'] }}" alt=""/>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6>
                                                <a href="{{ route('product',['id' => $new_product['id']]) }}">{{ $new_product['name'] }}</a>
                                            </h6>
                                            <h3 class="pro-price">{{ $new_product['price'] }} <span class="rouble">c</span> </h3>
                                        </div>
                                    </div><!-- product-item end -->
                                    @endforeach
                                </aside>                             
                                @endif

                        </div>
                    </div>
                </div>
            </div>
            <!-- SHOP SECTION END -->             

        </section>
        <!-- End page content