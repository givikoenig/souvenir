@set($is_alias,Route::current()->alias)
@if ($is_alias)
    @set ( $brandid, \App\Brand::where('alias',$is_alias)->first()->id )
@endif

@set($is_subalias, Route::current()->subalias)
@if ($is_subalias)
    @set( $subbrandid, \App\Subbrand::where('alias',$is_subalias)->first()->id )
@endif

<!-- BREADCRUMBS SETCTION START -->
<div class="breadcrumbs-section plr-200 mb-80">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                    
                        <h1 class="breadcrumbs-title">
                            {{ $is_alias ? \App\Brand::where('alias',$is_alias)->first()->name : 'магазин' }}
                            {{ $is_subalias ? ' - ' .\App\Subbrand::where('alias',$is_subalias)->first()->name : '' }}
                        </h1>
                        <ul class="breadcrumb-list">
                            <li><a href="/"><i class="zmdi zmdi-home" style="font-size: 20px;"></i> домой</a></li>
                            @if (is_null($is_alias))
                                <li>магазин</li>
                            @else 
                                <li><a href="{{route('brands')}}">магазин</a></li>
                            @endif
                            @if (!is_null($is_alias) && is_null($is_subalias) )
                                <li>{{ \App\Brand::where('alias',$is_alias)->first()->name }}</li>
                            @elseif  (!is_null($is_alias) && !is_null($is_subalias) )
                                <li><a href="{{route('brands',$is_alias)}}">{{ \App\Brand::where('alias',$is_alias)->first()->name }}</a></li>
                            @endif
                            @if (!is_null($is_subalias))
                                <li>{{ \App\Subbrand::where('alias',$is_subalias)->first()->name }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMBS SETCTION END -->

<div id="page-content" class="page-wrapper">
    <div class="cart_result_here"></div>
    <!-- SHOP SECTION START -->
    <div class="shop-section mb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-push-3 col-sm-12">
                    <div class="shop-content">
                        @if (isset($products))
                            @if($products->total())
                                <div class="shop-option box-shadow mb-30 clearfix">
                                    <!-- Nav tabs -->
                                    <ul type="submit" class="shop-tab f-left" role="tablist">
                                        <li class="style-grid">
                                            <a href="#" data-toggle="tab"><i class="zmdi zmdi-view-module"></i></a>
                                        </li>
                                        <li class="style-list">
                                            <a href="#" data-toggle="tab"><i class="zmdi zmdi-view-list-alt"></i></a>
                                        </li>
                                    </ul>
                                    <div class="short-by f-left text-center">
                                        <small>Сортировка:&nbsp;</small>
                                        <small class="sort">@sortablelink('price', 'Цена')</small>
                                        <small> | </small>
                                        <small class="sort">@sortablelink('name', 'Название' )</small>
                                        <small> | </small>
                                        <small class="sort">@sortablelink('created_at', 'Дата' )</small>
                                    </div>
                                    <!-- showing -->
                                    <div class="showing f-right text-right">
                                            <small>Показано : {{$products->firstItem() .'-'. $products->lastItem() }} из {{$products->total()}}</small>
                                    </div>
                                </div>
                            @endif
                        @endif
                        <!-- shop-option end -->
                        <div class="tab-content">
                            <!-- grid-view -->
                            <div role="tabpanel" class="stab-pane grid-row">
                                <div class="row">
                                    @if (isset($products))
                                    <!-- product-item start -->
                                    @foreach ($products as $grid_item)
                                        @if ($grid_item->visible)
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="product-item">
                                                    <div class="product-img stext-center">
                                                        <a href="{{ route('product', $grid_item['id']) }}">
                                                            <img src="{{asset('assets')}}/img/product/{{ json_decode($grid_item['images'],true)['min'] }}" alt="img" {{-- style="width: 70%;" --}} title="{{$grid_item->name }}" />
                                                        </a>

                                                    </div>
                                                    <div class="product-info">
                                                        <h6 class="product-title" style="padding: 0 10px;">
                                                            <a href="{{ route('product', $grid_item['id']) }}" title="{{$grid_item->name }}">{{$grid_item->name }}</a>
                                                        </h6>
                                                        {{-- <h6 class="brand-name">{{ $grid_item->subbrand->brand->name }}</h6> --}}
                                                        <h6 class="brand-name mb-20">{{ $grid_item->anons }}</h6>
                                                        <h4 class="pro-price">{{$grid_item->price }} &#8381;
                                                            &nbsp;<span class="tab-old-price rouble">{{ $grid_item['sale'] ? $grid_item['old_price'] . '&#8381;' : '' }}</span>
                                                        @if($grid_item['sale'] == 1)<span class="featured sale-product">sale</span>@endif
                                                        @if($grid_item['new'] == 1)<span class="featured new-product">new</span>@endif
                                                        @if($grid_item['hits'] == 1)<span class="featured hit-product">hit</span>@endif
                                                        @if($grid_item['spec'] == 1)<span class="featured spec-product">spec</span>@endif

                                                        </h4>
                                                        <ul class="action-button">
                                                            <li>
                                                                <form action="" method="post" class="add-wish">
                                                                    {!! csrf_field() !!}
                                                                    <a href="#" type="submit" class="add-wish-button" attr-id="{{ $grid_item->id }}" title="Избранное"><i class="zmdi zmdi-favorite"></i></a>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <a href="#" data-toggle="modal"  data-target="#productModal"
                                                                 data-url="{{ route('home') }}"
                                                                 data-id="{{ $grid_item->id }}"
                                                                 data-available="{{ $grid_item->available }}" 
                                                                 data-name="{{ $grid_item->name }}" 
                                                                 data-price="{{ $grid_item->price }}" 
                                                                 data-oldprice="{{ $grid_item->old_price }}" 
                                                                 data-content="{{ $grid_item->content }}" 
                                                                 data-image="{{ json_decode($grid_item->images,true)['max'] }}" 
                                                                 class="open-ProductModal" title="Быстрый просмотр"><i class="zmdi zmdi-zoom-in"></i></a>
                                                            </li>
                                                            <li>
                                                                <form action="" method="post" class="add-compare">
                                                                 {!! csrf_field() !!}
                                                                    <a href="#" type="submit" class="add-compare-button" attr-id="{{ $grid_item->id }}" title="Сравнить"><i class="zmdi zmdi-refresh"></i></a>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <form action="" method="post" class="add-form2 dcart">
                                                                    {!! csrf_field() !!}
                                                                    @if($grid_item->available == 1)
                                                                    <input type="hidden" class="productqty" name="qty" value="1" />
                                                                    <a href="#" type="submit" class="add-button2"  attr-id="{{ $grid_item->id }}" title="Добавить в корзину"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                                    @elseif ($grid_item->available == 0)
                                                                    <a href="javascript: void(0)" title="Нет в наличии"><i class="zmdi zmdi-close"></i></a>
                                                                    @endif
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <!-- list-view -->
                            <div role="tabpanel" class="stab-pane list-row">
                                <div class="row">
                                    <!-- product-item start -->
                                    @foreach ($products as $list_item)
                                        @if ($list_item->visible)
                                            <div class="col-md-12">
                                                <div class="shop-list product-item">
                                                    <div class="product-img text-center">
                                                        <a href="{{ route('product', $list_item['id']) }}">
                                                            <img src="{{asset('assets')}}/img/product/{{ json_decode($list_item['images'],true)['min'] }}" alt="{{ $list_item['name'] }}"  style="width: 70%;" title="{{ $list_item['name'] }}" />
                                                        </a>
                                                    </div>
                                                    <div class="product-info">
                                                        <div class="clearfix">
                                                            <h6 class="product-title f-left">
                                                                <a href="{{ route('product', $list_item['id']) }}" title="{{ $list_item['name'] }}">{{ $list_item['name'] }}</a>
                                                            </h6>
                                                        </div>
                                                        {{-- <h6 class="brand-name mb-30">{{ $list_item->subbrand->brand->name }}</h6> --}}
                                                        <h6 class="brand-name mb-30">{{ $list_item->anons }}</h6>
                                                        {{-- <h3 class="pro-price">{{ $list_item['price'] }} &#8381;</h3> --}}
                                                        <h4 class="pro-price">{{$grid_item->price }} &#8381;
                                                            &nbsp;<span class="tab-old-price rouble">{{ $list_item['sale'] ? $list_item['old_price'] . '&#8381;' : '' }}</span>
                                                        @if($list_item['sale'] == 1)<span class="featured sale-product">sale</span>@endif
                                                        @if($list_item['new'] == 1)<span class="featured new-product">new</span>@endif
                                                        @if($list_item['hits'] == 1)<span class="featured hit-product">hit</span>@endif
                                                        @if($list_item['spec'] == 1)<span class="featured spec-product">spec</span>@endif
                                                        <p>{{ str_limit($list_item['content'], 255) }}</p>
                                                        <ul class="action-button">
                                                            <li>
                                                                <form action="" method="post" class="add-wish">
                                                                    {!! csrf_field() !!}
                                                                    <a href="#" type="submit" class="add-wish-button" attr-id="{{ $list_item->id }}" title="Избранное"><i class="zmdi zmdi-favorite"></i></a>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <a href="#" data-toggle="modal"  data-target="#productModal"
                                                                     data-url="{{ route('home') }}" 
                                                                     data-id="{{ $list_item->id }}"
                                                                     data-available="{{ $list_item->available }}" 
                                                                     data-name="{{ $list_item->name }}" 
                                                                     data-price="{{ $list_item->price }}" 
                                                                     data-oldprice="{{ $list_item->old_price }}" 
                                                                     data-content="{{ $list_item->content }}" 
                                                                     class="open-ProductModal" title="Быстрый просмотр"><i class="zmdi zmdi-zoom-in"></i></a>
                                                            </li>
                                                            <li>
                                                                <form action="" method="post" class="add-compare">
                                                                 {!! csrf_field() !!}
                                                                    <a href="#" type="submit" class="add-compare-button" attr-id="{{ $list_item->id }}" title="Сравнить"><i class="zmdi zmdi-refresh"></i></a>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <form action="" method="post" class="add-form2 dcart">
                                                                    {!! csrf_field() !!}
                                                                    @if($list_item->available == 1)
                                                                    <input type="hidden" class="productqty" name="qty" value="1" />
                                                                    <a href="#" type="submit" class="add-button2"  attr-id="{{ $list_item->id }}" title="Добавить в корзину"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                                    @elseif ($list_item->available == 0)
                                                                    <a href="javascript: void(0);" title="Нет в наличии"><i class="zmdi zmdi-close"></i></a>
                                                                    @endif
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <!-- product-item end -->
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                {!! $products->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-md-pull-9 col-sm-12">
                    <!-- widget-search -->
                    <aside class="widget-search mb-30">
                        <form action="{{ route('brands') }}">
                            <input type="text" placeholder="Поиск товара..."  name="keyword">
                            <button type="submit"><i class="zmdi zmdi-search"></i></button>
                        </form>
                    </aside>
                    @if (isset($brands))
                    <!-- widget-categories -->
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
                        <h6 class="widget-title border-left mb-20">последние поступления</h6>
                        @foreach($new_products as $new_product)
                            @if ($new_product->visible)
                                <!-- product-item start -->
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="{{ route('product',['id' => $new_product['id']]) }}">
                                            <img src="{{ asset('assets') }}/img/product/{{ json_decode( $new_product['images'],true )['med'] }}" alt="" style="width: 55px;" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6>
                                            <a href="{{ route('product',['id' => $new_product['id']]) }}">{{ $new_product['name'] }}</a>
                                        </h6>
                                        <h3 class="pro-price">{{ $new_product['price'] }}{{-- <span class="rouble">c</span> --}} &#8381;</h3>
                                    </div>
                                </div><!-- product-item end -->
                            @endif
                        @endforeach
                    </aside>                             
                    @endif
                </div><!-- col-md-3 end-->
            </div><!-- crow end-->
        </div><!-- container end-->
    </div><!-- shop-section end-->
    <!-- SHOP SECTION END --> 
</div><!-- page-wrapper end-->