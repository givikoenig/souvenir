<!-- PRODUCT TAB SECTION START -->
    <div class="product-tab-section section-bg-tb pt-80 pb-55">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="section-title text-left mb-40">
                        <h2 class="uppercase">популярные товары</h2>
                        <h6>There are many variations of passages of brands available,</h6>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="pro-tab-menu pro-tab-menu-2 text-right">
                        <!-- Nav tabs -->
                        <ul class="" >
                            
                            @if (count($hits_products) <> 0)
                                <li class="active"><a href="#best-seller"  data-toggle="tab">Хиты продаж</a></li>
                            @endif
                            @if (count($new_products) <> 0)
                                <li><a href="#new-arrival" data-toggle="tab">Новинки</a></li>
                            @endif
                            @if (count($sale_products) <> 0)
                                <li><a href="#popular-product" data-toggle="tab">Распродажа</a></li>
                            @endif
                            @if (count($spec_products) <> 0)
                                <li><a href="#special-offer"  data-toggle="tab">Специальные предложения</a></li>
                            @endif
                        </ul>
                    </div>                       
                </div>
            </div>
            <div class="product-tab">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="cart_result"></div>
                    
                    @if (isset($hits_products))
                    <div class="tab-pane active" id="best-seller">
                        <div class="row">
                            @foreach ($hits_products as $key=>$hits_product)
                            @if ($hits_product->visible)
                                <div class="col-md-3 col-sm-4 col-xs-12">
                                    <div class="product-item product-item-2">
                                        <div class="product-img">
                                            <a href="{{ route('product',['id' => $hits_product['id']]) }}">
                                                <img src="{{ asset('assets') }}/img/product/{{ json_decode($hits_product['images'],true)['min'] }}" alt="{{ $hits_product->name }}" title="{{ $hits_product->name }}" />
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="product-title" title="{{ $hits_product->name }}">
                                                <a href="{{ route('product',['id' => $hits_product['id']]) }}">{{ $hits_product->name }}</a>
                                            </h6>
                                            {{-- <h6 class="brand-name">{{ $hits_product->subbrand->brand->name }}</h6> --}}
                                            <h6 class="brand-name">{{ str_limit($hits_product->anons, 26) }}</h6>
                                            <h3 class="pro-price">{{ $hits_product['price'] }} <span class="rouble">c</span> </h3>
                                        </div>
                                        <ul class="action-button">
                                            <li>
                                                <form action="" method="post" class="add-wish">
                                                    {!! csrf_field() !!}
                                                    <a href="#" type="submit" class="add-wish-button" attr-id="{{ $hits_product->id }}" title="Избранное"><i class="zmdi zmdi-favorite"></i></a>
                                                </form>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="modal"  data-target="#productModal"
                                                 data-url="{{ route('home') }}"
                                                 data-id="{{ $hits_product->id }}"
                                                 data-available="{{ $hits_product->available }}" 
                                                 data-name="{{ $hits_product->name }}" 
                                                 data-price="{{ $hits_product->price }}" 
                                                 data-oldprice="{{ $hits_product->old_price }}" 
                                                 data-content="{{ $hits_product->content }}" 
                                                 data-image="{{ json_decode($hits_product->images,true)['max'] }}" 
                                                 class="open-ProductModal" title="Просмотр"><i class="zmdi zmdi-zoom-in"></i></a>
                                            </li>
                                            <li>
                                                <form action="" method="post" class="add-compare">
                                                 {!! csrf_field() !!}
                                                    <a href="#" type="submit" class="add-compare-button" attr-id="{{ $hits_product->id }}" title="Сравнить"><i class="zmdi zmdi-refresh"></i></a>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="" method="post" class="add-form2 cart">
                                                {!! csrf_field() !!}
                                                @if($hits_product->available == 1)
                                                    <input type="hidden" class="productqty" name="qty" value="1" />
                                                    <a href="#" type="submit" class="add-button2"  attr-id="{{ $hits_product->id }}" title="Добавить в корзину"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                @elseif ($hits_product->available == 0)
                                                    <a href="javascript: void(0)" title="Нет в наличии"><i class="zmdi zmdi-close"></i></a>
                                                @endif
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>                                        
                    </div>
                    <!-- best-seller end -->
                    @endif
                    <!-- new-arrival start -->
                    @if (isset($new_products))
                    <div class="tab-pane" id="new-arrival">
                        <div class="row">
                            @foreach ($new_products as $key=>$new_product)
                            @if ($new_product->visible )
                                <div class="col-md-3 col-sm-4 col-xs-12">
                                    <div class="product-item product-item-2">
                                        <div class="product-img">
                                            <a href="{{ route('product',['id' => $new_product['id']]) }}">
                                                <img src="{{ asset('assets') }}/img/product/{{ json_decode($new_product['images'],true)['min'] }}" alt="{{ $new_product->name }}" title="{{ $new_product->name }}" />
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="product-title" title="{{ $new_product->name }}">
                                                <a href="{{ route('product',['id' => $new_product['id']]) }}">{{ $new_product['name'] }}</a>
                                            </h6>
                                            {{-- <h6 class="brand-name">{{ $new_product->subbrand->brand->name }}</h6> --}}
                                            <h6 class="brand-name">{{ $new_product->anons }}</h6>
                                            <h3 class="pro-price">{{ $new_product['price'] }} <span class="rouble">c</span> </h3>
                                        </div>
                                        <ul class="action-button">
                                            <li>
                                                <form action="" method="post" class="add-wish">
                                                    {!! csrf_field() !!}
                                                    <a href="#" type="submit" class="add-wish-button" attr-id="{{ $new_product->id }}" title="Избранное"><i class="zmdi zmdi-favorite"></i></a>
                                                </form>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="modal"  data-target="#productModal"
                                                 data-url="{{ route('home') }}"
                                                 data-id="{{ $new_product->id }}"
                                                 data-available="{{ $new_product->available }}" 
                                                 data-name="{{ $new_product->name }}" 
                                                 data-price="{{ $new_product->price }}" 
                                                 data-oldprice="{{ $new_product->old_price }}" 
                                                 data-content="{{ $new_product->content }}" 
                                                 data-image="{{ json_decode($new_product->images,true)['max'] }}" 
                                                 class="open-ProductModal" title="Просмотр"><i class="zmdi zmdi-zoom-in"></i></a>
                                            </li>
                                            <li>
                                                <form action="" method="post" class="add-compare">
                                                 {!! csrf_field() !!}
                                                    <a href="#" type="submit" class="add-compare-button" attr-id="{{ $new_product->id }}" title="Сравнить"><i class="zmdi zmdi-refresh"></i></a>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="" method="post" class="add-form2 cart">
                                                {!! csrf_field() !!}
                                                @if($new_product->available == 1)
                                                    <input type="hidden" class="productqty" name="qty" value="1" />
                                                    <a href="#" type="submit" class="add-button2"  attr-id="{{ $new_product->id }}" title="Добавить в корзину"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                @elseif ($new_product->available == 0)
                                                    <a href="javascript: void(0)" title="Нет в наличии"><i class="zmdi zmdi-close"></i></a>
                                                @endif
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @endforeach
                        </div>                                        
                    </div>
                    @endif
                    <!-- new-arrival end -->
                   <!-- popular-product start -->
                    <div class="tab-pane" id="popular-product">
                        <div class="row">
                            @foreach ($sale_products as $key=>$sale_product)
                            @if ($sale_product->visible )
                                <div class="col-md-3 col-sm-4 col-xs-12">
                                    <div class="product-item product-item-2">
                                        <div class="product-img">
                                            <a href="{{ route('product',['id' => $sale_product['id']]) }}">
                                                <img src="{{ asset('assets') }}/img/product/{{ json_decode($sale_product['images'],true)['min'] }}" alt="{{ $sale_product->name }}" title="{{ $sale_product->name }}" />
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="product-title" title="{{ $sale_product->name }}">
                                                <a href="{{ route('product',['id' => $sale_product['id']]) }}">{{ $sale_product['name'] }}</a>
                                            </h6>
                                            {{-- <h6 class="brand-name">{{ $sale_product->subbrand->brand->name }}</h6> --}}
                                            <h6 class="brand-name">{{ $sale_product->anons }}</h6>
                                            <h3 class="pro-price">{{ $sale_product['price'] }}<span class="rouble">c</span>&nbsp;&nbsp;&nbsp;<span class="tab-old-price rouble">{{ $sale_product['old_price'] ? $sale_product['old_price'] . 'c' : '' }}</span>
                                            </h3>
                                        </div>
                                        <ul class="action-button">
                                            <li>
                                                <form action="" method="post" class="add-wish">
                                                    {!! csrf_field() !!}
                                                    <a href="#" type="submit" class="add-wish-button" attr-id="{{ $sale_product->id }}" title="Избранное"><i class="zmdi zmdi-favorite"></i></a>
                                                </form>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="modal"  data-target="#productModal"
                                                 data-url="{{ route('home') }}"
                                                 data-id="{{ $sale_product->id }}"
                                                 data-available="{{ $sale_product->available }}"
                                                 data-name="{{ $sale_product->name }}" 
                                                 data-price="{{ $sale_product->price }}" 
                                                 data-oldprice="{{ $sale_product->old_price }}" 
                                                 data-content="{{ $sale_product->content }}" 
                                                 data-image="{{ json_decode($sale_product->images,true)['max'] }}" 
                                                 class="open-ProductModal" title="Просмотр"><i class="zmdi zmdi-zoom-in"></i></a>
                                            </li>
                                            <li>
                                                <form action="" method="post" class="add-compare">
                                                 {!! csrf_field() !!}
                                                    <a href="#" type="submit" class="add-compare-button" attr-id="{{ $sale_product->id }}" title="Сравнить"><i class="zmdi zmdi-refresh"></i></a>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="" method="post" class="add-form2 cart">
                                                {!! csrf_field() !!}
                                                @if($sale_product->available == 1)
                                                    <input type="hidden" class="productqty" name="qty" value="1" />
                                                    <a href="#" type="submit" class="add-button2"  attr-id="{{ $sale_product->id }}" title="Добавить в корзину"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                @elseif ($sale_product->available == 0)
                                                    <a href="javascript: void(0)" title="Нет в наличии"><i class="zmdi zmdi-close"></i></a>
                                                @endif
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                             @endforeach
                        </div>
                    </div>
                    <!-- popular-product end -->
                    <!-- special-offer start -->
                    @if (isset($spec_products))
                    <div class="tab-pane" id="special-offer">
                        <div class="row">
                            @foreach ($spec_products as $key=>$spec_product)
                                @if ($spec_product->visible)
                                    <div class="col-md-3 col-sm-4 col-xs-12">
                                        <div class="product-item product-item-2">
                                            <div class="product-img">
                                                <a href="{{ route('product',['id' => $spec_product['id']]) }}">
                                                    <img src="{{ asset('assets') }}/img/product/{{ json_decode($spec_product['images'],true)['min'] }}" alt="{{ $spec_product->name }}" title="{{ $spec_product->name }}" />
                                                </a>
                                            </div>
                                            <div class="product-info">
                                                <h6 class="product-title" title="{{ $spec_product->name }}">
                                                    <a href="{{ route('product',['id' => $spec_product['id']]) }}">{{ $spec_product['name'] }}</a>
                                                </h6>
                                                {{-- <h6 class="brand-name">{{ $spec_product->subbrand->brand->name }}</h6> --}}
                                                <h6 class="brand-name">{{ $spec_product->anons }}</h6>
                                                <h3 class="pro-price">{{ $spec_product['price'] }} <span class="rouble">c</span> </h3>
                                            </div>
                                            <ul class="action-button">
                                                <li>
                                                    <form action="" method="post" class="add-wish">
                                                        {!! csrf_field() !!}
                                                        <a href="#" type="submit" class="add-wish-button" attr-id="{{ $spec_product->id }}" title="Избранное"><i class="zmdi zmdi-favorite"></i></a>
                                                    </form>
                                                </li>
                                                <li>
                                                    <a href="#" data-toggle="modal"  data-target="#productModal"
                                                     data-url="{{ route('home') }}"
                                                     data-id="{{ $spec_product->id }}"
                                                     data-available="{{ $spec_product->available }}" 
                                                     data-name="{{ $spec_product->name }}" 
                                                     data-price="{{ $spec_product->price }}" 
                                                     data-oldprice="{{ $spec_product->old_price }}" 
                                                     data-content="{{ $spec_product->content }}" 
                                                     data-image="{{ json_decode($spec_product->images,true)['max'] }}" 
                                                     class="open-ProductModal" title="Просмотр"><i class="zmdi zmdi-zoom-in"></i></a>
                                                </li>
                                                <li>
                                                    <form action="" method="post" class="add-compare">
                                                     {!! csrf_field() !!}
                                                        <a href="#" type="submit" class="add-compare-button" attr-id="{{ $spec_product->id }}" title="Сравнить"><i class="zmdi zmdi-refresh"></i></a>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="" method="post" class="add-form2 cart">
                                                    {!! csrf_field() !!}
                                                    @if($spec_product->available == 1)
                                                        <input type="hidden" class="productqty" name="qty" value="1" />
                                                        <a href="#" type="submit" class="add-button2"  attr-id="{{ $spec_product->id }}" title="Добавить в корзину"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                    @elseif ($spec_product->available == 0)
                                                        <a href="javascript: void(0)" title="Нет в наличии"><i class="zmdi zmdi-close"></i></a>
                                                    @endif
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>                                        
                    </div>
                    <!-- special-offer end -->
                    @endif
                </div> 
            </div>
        </div>
    </div>
    <!-- PRODUCT TAB SECTION END -->