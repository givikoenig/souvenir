<!-- FEATURED PRODUCT SECTION START -->
@if (isset($new_arrivals))
<div class="featured-product-section section-bg-tb pt-80 pb-55">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-left mb-20">
                    <h2 class="uppercase">последние поступления</h2>
                    <h6>Наиболее интересные и крутые новинки. Самые разнообразные модели всех категорий.</h6>
                </div>
            </div>
        </div>
        <div class="featured-product">
            <div class="row active-featured-product slick-arrow-2">
                <!-- product-item start -->
                @foreach ($new_arrivals as $new_arrival)
                    @if ($new_arrival->visible)
                        <div class="col-xs-12">
                            <div class="product-item product-item-2">

                                <div class="product-img">
                                    <a href="{{ route('product',['id' => $new_arrival['id']]) }}">
                                        <img src="{{ asset('assets') }}/img/product/{{ json_decode($new_arrival['images'],true)['min'] }}" alt="{{ $new_arrival['name'] }}" title="{{ $new_arrival['name'] }}" />
                                    </a>
                                </div>
                                <div class="product-info">
                                    <h6 class="product-title">
                                        <a href="{{ route('product',['id' => $new_arrival['id']]) }}" title="{{ $new_arrival['name'] }}">{{ $new_arrival['name'] }}</a>
                                    </h6>
                                    {{-- <h6 class="brand-name">{{ $new_arrival->subbrand->brand->name }}</h6> --}}
                                    <h6 class="brand-name mb-20">{{ $new_arrival->anons }}</h6>
                                    <h3 class="pro-price">{{ $new_arrival['price'] }}&#8381;
                                        &nbsp;<span class="tab-old-price rouble">{{ $new_arrival['sale'] ? $new_arrival['old_price'] . '&#8381;' : '' }}</span>
                                        @if($new_arrival['sale'] == 1)<span class="featured sale-product">sale</span>@endif
                                        @if($new_arrival['new'] == 1)<span class="featured new-product">new</span>@endif
                                        @if($new_arrival['hits'] == 1)<span class="featured hit-product">hit</span>@endif
                                        @if($new_arrival['spec'] == 1)<span class="featured spec-product">spec</span>@endif
                                        <!-- </span> -->
                                    </h3>
                                </div>
                                
                                <ul class="action-button">
                                    <li>
                                        <form action="" method="post" class="add-wish">
                                            {!! csrf_field() !!}
                                            <a href="#" type="submit" class="add-wish-button" attr-id="{{ $new_arrival->id }}" title="Избранное"><i class="zmdi zmdi-favorite"></i></a>
                                        </form>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="modal"  data-target="#productModal"
                                        data-url="{{ route('home') }}"
                                        data-id="{{ $new_arrival->id }}" 
                                        data-available="{{ $new_arrival->available }}" 
                                        data-name="{{ $new_arrival->name }}" 
                                        data-price="{{ $new_arrival->price }}" 
                                        data-oldprice="{{ $new_arrival->old_price }}" 
                                        data-content="{{ $new_arrival->content }}" 
                                        data-image="{{ json_decode($new_arrival->images,true)['max'] }}" 
                                        class="open-ProductModal" title="Просмотр"><i class="zmdi zmdi-zoom-in"></i></a>
                                    </li>
                                    <li>

                                        <form action="" method="post" class="add-compare">
                                         {!! csrf_field() !!}
                                            <a href="#" type="submit" class="add-compare-button" attr-id="{{ $new_arrival->id }}" title="Сравнить"><i class="zmdi zmdi-refresh"></i></a>
                                        </form>
                                    </li>

                                    <li>
                                        <form action="" method="post" class="add-form2 dcart">
                                            {!! csrf_field() !!}
                                            @if($new_arrival->available == 1)
                                            <input type="hidden" class="productqty" name="qty" value="1" />
                                            <a href="#" type="submit" class="add-button2" attr-id="{{ $new_arrival->id }}" title="Добавить в корзину"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
                                            @elseif ($new_arrival->available == 0)
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
    </div>            
</div>
@endif
    <!-- FEATURED PRODUCT SECTION END -->