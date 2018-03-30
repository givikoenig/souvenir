<!-- BREADCRUMBS SETCTION START -->
<div class="breadcrumbs-section plr-200 mb-80">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                        <h1 class="breadcrumbs-title">Корзина</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="{{route('home')}}"><i class="zmdi zmdi-home" style="font-size: 20px;"></i> домой</a></li>
                            <li class="breadcrumbs-item">Корзина</li>
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
    <!-- SHOP SECTION START -->
    <div class="shop-section mb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-12">
                    <ul class="cart-tab">
                        <li>
                            <a id="crt" class="active" href="#shopping-cart" data-toggle="tab">
                                <span>01</span>
                                Корзина
                            </a>
                        </li>
                        <li>
                            <a id="wl" href="#wishlist" data-toggle="tab">
                                <span>02</span>
                                Избранное
                            </a>
                        </li>
                        <li>
                            <a id="ch" href="#checkout" data-toggle="tab">
                                <span>03</span>
                                Проверка
                            </a>
                        </li>
                        <li>
                            <a id="ord" href="#order-complete" data-toggle="tab">
                                <span>04</span>
                                Заказ
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-10 col-sm-12">
                    <!-- Tab panes -->
                    <div class="tab-content">
                     <a href="#" data-url="{{ route('home') }}" class="open-ProductModal" title=""></a>
                     <div class="tab-pane active" id="shopping-cart">
                        @if($cart_count > 0)
                        <div class="shopping-cart-content">
                            <div class="table-content table-responsive mb-50">
                                <table class="text-center">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">наименование</th>
                                            <th class="product-price">цена</th>
                                            <th class="product-quantity">количество</th>
                                            <th class="product-subtotal">сумма</th>
                                            <th class="product-remove">удалить</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart_content as $row)
                                        <?php $row->associate('App\Product'); ?>
                                        <tr>
                                            <td class="product-thumbnail">
                                                <div class="pro-thumbnail-img">
                                                    <img src="{{ asset('assets') }}/img/product/{{ json_decode($row->model->images,true)['min'] }}" alt="Shopping Cart" style="width: 65px;">
                                                </div>
                                                <div class="pro-thumbnail-info text-left">
                                                    <h6 class="product-title-2">
                                                        <a href="{{ route('product', $row->id) }}">{{ $row->name }}</a>
                                                    </h6>
                                                    <small>
                                                        <i>{{$row->model->subbrand->brand->name}} &rarr; {{$row->model->subbrand->name}}</i>
                                                    </small>
                                                    <p>{{ str_limit($row->model->content, 50) }}</p>
                                                </div>
                                            </td>
                                            <td class="product-price">{{ $row->price }} &#8381; </td>

                                            <form action="" class="change-qty">
                                                {!! csrf_field() !!}
                                                <td class="product-quantity">
                                                    <div class="cart_result"></div>
                                                    <div class="cart-plus-minus f-left">
                                                        <input type="text" value="{{ $row->qty }}" name="qtybutton" class="kolvo cart-plus-minus-box" attr-rid="{{ $row->rowId }}" disabled="">
                                                    </div> 
                                                </td>
                                            </form>

                                            <td class="product-subtotal">{{ ($row->price * $row->qty) }} &#8381; </td>
                                            <td class="product-remove">
                                                <form action="" method="post" class="delete-form">
                                                    {!! csrf_field() !!}
                                                    <a href="#" type="submit" class="del-button" attr-rowid="{{ $row->rowId }}" attr-prodid="{{$row->id}}" title="Удалить товар из корзины"><i class="zmdi zmdi-close"></i></a>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-md-push-6">
                                    <div class="payment-details box-shadow p-30 mb-50">
                                        <h6 class="widget-title itogo border-left smb-20">итого :
                                            <span class="order-total-price">&nbsp;&nbsp;&nbsp;&nbsp;{{ $cart_total }} &#8381;</span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-md-push-6">
                                    <div class="spayment-details box-shadow p-30 mb-50">
                                        <button id="cart-dalee" class="submit-btn-1 black-bg btn-hover-2">далее</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="text-center if_empty">
                            <h2 class="wl-pbl" >КОРЗИНА ПУСТА</h2>
                            <br />
                            <img src="{{ asset('assets') }}/img/cart/cart1.png" alt="empty_cart">
                            <br /><br /><br />
                            <form action="{{route('brands')}}">
                                <button class="submit-btn-1 black-bg btn-hover-2" type="submit">срочно в магазин!!!</button>
                            </form>
                        </div>
                        @endif
                    </div>
                    <!-- shopping-cart end -->
                    <!-- wishlist start -->
                    <div class="tab-pane" id="wishlist">
                        @if($wishlist_count > 0)
                        <div class="wishlist-content">
                            <div class="table-content table-responsive mb-50">
                                <table class="text-center">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">наименование</th>
                                            <th class="product-price">цена</th>
                                            <th class="product-stock">наличие</th>
                                            <th class="product-add-cart">в корзину</th>
                                            <th class="product-remove">удалить</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($wishlist_content as $item)
                                        <?php $item->associate('App\Product'); ?>
                                        <tr class="wlcontent">
                                            <td class="product-thumbnail">
                                                <div class="pro-thumbnail-img">
                                                    <img src="{{ asset('assets') }}/img/product/{{ json_decode($item->model->images,true)['min'] }}" alt="WishList" style="width: 65px;">
                                                </div>
                                                <div class="pro-thumbnail-info text-left">
                                                    <h6 class="product-title-2">
                                                        <a href="{{ route('product', $item->id) }}">{{$item->name}}</a>
                                                    </h6>
                                                    <small>
                                                        <i>{{$item->model->subbrand->brand->name}} &rarr; {{$item->model->subbrand->name}}</i>
                                                    </small>
                                                    <p>{{ str_limit($item->model->content, 50) }}</p>
                                                </div>
                                            </td>
                                            <td class="product-price">{{$item->price}} &#8381;</td>
                                            <td class="product-stock text-uppercase">{{ $item->model->available == '1' ? 'Есть' : 'Нет' }}</td>
                                            <td class="product-add-cart">
                                                <a href="#" data-toggle="modal"  data-target="#productModal"
                                                data-url="{{ route('home') }}"
                                                data-id="{{ $item->model->id }}"
                                                data-available="{{ $item->model->available }}" 
                                                data-name="{{ $item->model->name }}" 
                                                data-price="{{ $item->model->price }}" 
                                                data-oldprice="{{ $item->model->old_price }}" 
                                                data-content="{{ $item->model->content }}" 
                                                data-image="{{ json_decode($item->model->images,true)['max'] }}" 
                                                class="open-ProductModal" title="Добавить в корзину"><i class="zmdi zmdi-shopping-cart-plus"></i>
                                            </a>
                                        </td>
                                        <td class="product-remove">
                                            <form action="" method="post" class="wl-delete-form">
                                                {!! csrf_field() !!}
                                                <a href="#" type="submit" class="wl-del-button" attr-wlrowid="{{ $item->rowId }}" attr-wlprodid="{{$item->id}}" title="Удалить товар из списка"><i class="zmdi zmdi-close"></i></a>
                                            </form>
                                            <!-- <a href="#"><i class="zmdi zmdi-close"></i></a> -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($cart_count > 0)
                        <div class="row">
                            <div class="col-md-6 col-md-push-6">
                                <div class="spayment-details box-shadow p-30 mb-50">
                                    <button id="wish-dalee" class="submit-btn-1 black-bg btn-hover-2">далее</button>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- </form> -->
                    </div>
                    @else
                    <div class="row text-center if_empty">
                        <h2 class="wl-pbl">СПИСОК ИЗБРАННОГО ПУСТ</h2>
                        <div class="spayment-details box-shadow p-30 text-center">
                            <img src="{{ asset('assets') }}/img/cart/cart2.png" alt="empty_cart" width="500">
                            <br /><br /><br />
                            <form action="{{route('brands')}}">
                                <button class="submit-btn-1 black-bg btn-hover-2" type="submit">в магазин</button>
                            </form>
                        </div>
                    </div>
                    <br />
                    @if($cart_count > 0)
                    <div class="row">
                        <div class="spayment-details box-shadow p-30 mb-50 text-center">
                            <button id="wish-dalee" class="submit-btn-1 black-bg btn-hover-2">далее</button>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
                <!-- wishlist end -->
                <!-- checkout start -->
                <div class="tab-pane" id="checkout">
                    @if($cart_count > 0)
                    <div class="checkout-content box-shadow p-30">
                        <div class="row">
                            <!-- billing details -->
                            <div class="col-md-6">
                                <div class="billing-details pr-10">
                                    <form id="shipping-form" class="js-form-address" action="" method="post">   
                                        <h6 class="widget-title border-left mb-20">адрес доставки</h6>
                                        <div class="field">
                                            <label>Регион</label>
                                            <input name="region" type="text" id="region">
                                        </div>
                                        <div class="field">
                                            <label>Район</label>
                                            <input name="district" type="text" id="district">
                                        </div>
                                        <div class="field">
                                            <label>Город</label>
                                            <input name="city" type="text" id="city">
                                        </div>
                                        <div class="field">
                                            <label>Улица</label>
                                            <input name="street" type="text" id="street">
                                        </div>
                                        <div class="field">
                                            <label>Номер дома</label>
                                            <input name="building" type="text" id="building">
                                        </div>
                                        <div class="field">
                                            <label>Квартира</label>
                                            <input id="appt" name="appt" type="text">
                                        </div>
                                        <div class="field">
                                            <label>Примечания</label>
                                            <textarea id="prim" name="prim"></textarea>
                                        </div>
                                        <div class="block">
                                            <p class="title">Убедитесь, что адрес доставки появился и заполнен правильно в поле ниже:</p>
                                            <p id="address" class="value">{{ Auth::user() ? Auth::user()->address : ''}}</p>
                                        </div>
                                        {!! csrf_field() !!}
                                    </form>

                                    <button  id="calc_shipping" class="shipping-btn submit-btn-1 mt-30 btn-hover-1" type="submit">расчитать доставку</button>        
                                    <br /><br />

                                    <form id="orderform"  action="{{ route('cart') }}" method="post"> 
                                       {!! csrf_field() !!}      

                                       <h6 class="widget-title border-left mb-20">контакт</h6>

                                       <div class="field">
                                        <label>* Ф.И.О.</label>
                                        <input id="fio" type="text" name="fio" value="{{ Auth::user() ? Auth::user()->fio : ''}}">
                                    </div>
                                    <div class="field">
                                        <label>* Email адрес</label>
                                        <input id="user_email" type="email" name="email" value="{{ Auth::user() ? Auth::user()->email : '' }}">
                                    </div>
                                    <div class="field">
                                        <label>* Телефон</label>
                                        <input id="phone" class="phone" name="phone" type="text" placeholder="10 цифр…" value="{{ Auth::user() ? Auth::user()->phone : ''}}"> 
                                    </div>
                                    <br />

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="payment-details pl-10 mb-50">
                                    <div id="map" class="panel-map"></div>
                                    <br />
                                    <h6 class="widget-title border-left mb-20">Ваш заказ</h6>

                                    <input type="hidden" name="cart_content" value="{{$cart_content}}">
                                    <input id="cart_total" type="hidden" name="cart_total" value="{{$cart_total}}">
                                    <input id="shipping_total" type="hidden" name="shipping" value="">
                                    <input id="delivery_address" type="hidden" name="delivery_address" value="">
                                    <input id="delivery_prim" type="hidden" name="delivery_prim" value="">
                                    <table>
                                        @foreach($cart_content as $row)
                                        <tr>
                                            <td class="td-title-1">{{ $row->name }} {{ ($row->qty > 1) ? ' x ' . $row->qty : '' }}</td>
                                            <td class="td-title-2">{{ ($row->price * $row->qty) }} &#8381;</td>
                                        </tr>
                                        @endforeach

                                        <tr>
                                            <td class="td-title-1">Стоимость товара</td>
                                            <td class="td-title-2">{{ $cart_total }} &#8381;</td>
                                        </tr>
                                        <tr>
                                            <td class="td-title-1">Доставка</td>
                                            <td class="td-title-2"><span id="shipping">0.00</span><span> &#8381;</span></td>
                                        </tr>
                                        <tr>
                                            <td class="order-total">Итого:</td>
                                            <td class="order-total-price"> <span id="itogo_cart">{{ $cart_total }}</span><span> &#8381;</span></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="center">{!! $captcha !!}</div>
                                <input type="text" id="captcha" name="captcha" placeholder="Введите символы с картинки…">
                            </div>
                        </form>  
                    </div>
                    <button  id="makeorder" class="submit-btn-1 mt-30 btn-hover-1" type="submit" disabled="">оформить заказ</button>
                </div>
                @else
                <div class="text-center if_empty">
                    <h2 class="wl-pbl" >КОРЗИНА ПУСТА</h2>
                    <br />
                    <img src="{{ asset('assets') }}/img/cart/cart3.png" alt="empty_cart" width="700">
                    <br /><br /><br />
                    <form action="{{route('brands')}}">
                        <button class="submit-btn-1 black-bg btn-hover-2" type="submit">в магазин</button>
                    </form>
                </div>
                @endif
            </div>
            <!-- checkout end -->
            <!-- order-complete start -->
            <div class="tab-pane"  id="order-complete">
                @if($cart_count > 0)
                <div class="order-complete-content box-shadow">
                    <div class="thank-you p-30 text-center">
                        <h6 class="text-black-5 mb-0">Спасибо. Ваш заказ принят.</h6>
                    </div>
                    <div class="order-info p-30 mb-10">
                        <ul class="order-info-list">
                            <li>
                                <h6>№ заказа</h6>
                                <p id="last_order_num"></p>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="payment-details p-30">
                                <h6 class="widget-title border-left mb-20">Ваш заказ</h6>
                                <table>
                                    @foreach($cart_content as $row)
                                    <tr>
                                        <td class="td-title-1">{{ $row->name }} {{ ($row->qty > 1) ? ' x ' . $row->qty : '' }}</td>
                                        <td class="td-title-2">{{ ($row->price * $row->qty) }} &#8381;</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="td-title-1">Стоимость товара</td>
                                        <td class="td-title-2">{{ $cart_total }} &#8381;</td>
                                    </tr>
                                    <tr>
                                        <td class="td-title-1">Доставка</td>
                                        <td class="td-title-2"><span id="tot-shipping">0.00</span><span> &#8381;</span></td>
                                    </tr>
                                    <tr>
                                        <td class="order-total">Итого:</td>
                                        <td class="order-total-price"> <span id="tot-itogo_cart">{{ $cart_total }}</span><span> &#8381;</span></td>
                                    </tr> 
                                </table>
                            </div>         
                        </div>
                        <div class="col-md-6">
                            <div class="bill-details p-30">
                                <h6 class="widget-title border-left mb-20">Детали доставки</h6>
                                <ul class="bill-address">
                                    <li>
                                        <span>Адрес:</span>
                                        <span class="order-details" id="tot-address"></span>
                                    </li>
                                    <li>
                                        <span>email:</span>
                                        <span class="order-details" id="tot-email"></span>
                                    </li>
                                    <li>
                                        <span>телефон : </span>
                                        <span class="order-details" id="tot-phone"></span>
                                    </li>
                                    <li>
                                        <span>контакт : </span>
                                        <span class="order-details" id="tot-contact"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="thank-you p-30 text-center">
                        <h6 class="text-black-5 mb-0"><a href="{{ route('profile') }}#My_order_info">Мои заказы →</a></h6>
                    </div>
                </div>
                @else
                <div class="text-center if_empty">
                    <h2 class="wl-pbl" >КОРЗИНА ПУСТА</h2>
                    <!-- <br /> -->
                    <img src="{{ asset('assets') }}/img/cart/cart4.png" alt="empty_cart" width="500">
                    <br /><br /><br />
                    <form action="{{route('brands')}}">
                        <button class="submit-btn-1 black-bg btn-hover-2" type="submit">в магазин</button>
                    </form>
                </div>
                @endif
            </div>
            <!-- order-complete end -->
        </div>
    </div>
</div>
</div>
</div>
<!-- SHOP SECTION END -->             

</section>

