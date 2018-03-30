<div class="breadcrumbs-section plr-200 mb-80">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                        <h1 class="breadcrumbs-title">Сравнение товаров</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="{{ route('home') }}"><i class="zmdi zmdi-home" style="font-size: 20px;"></i> домой</a></li>
                            <li class="breadcrumbs-item">Сравнение товаров</li></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Start page content -->
<section id="page-content" class="page-wrapper">
    <div class="cart_result_here"></div>
    <!-- SHOP SECTION START -->
    <div class="shop-section mb-80">
        <div class="container">
            <div class="row">
                @if($compare_count > 0)

                    @foreach($compare_content as $key => $row)
                    <?php $row->associate('App\Product'); ?>
                    <?php  $slides = explode('|', $row->model->img_slide); ?>
    
                        <div class="col-md-12 col-xs-12">
                                
                                <!-- single-product-area start -->
                                <div class="single-product-area mb-80">
                                    <div class="row">
                                        <!-- imgs-zoom-area start -->
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            @if (isset($slides))
                                            <div class="imgs-zoom-area text-center">
                                            <img class="zoom_03" src="{{asset('assets')}}/img/product/slides/{{ !empty($slides[0]) ? $slides[0] : 'noGoods.jpg' }}" alt="" style="width: 80%!important;">
                                                
                                            </div>
                                            @endif
                                        </div>
                                        <!-- imgs-zoom-area end -->

                                        <!-- single-product-info start -->
                                        <div class="col-md-7 col-sm-7 col-xs-12"> 

                                            <div class="single-product-info">
                                                <h3 class="text-black-1">{{ $row->name }}</h3>
                                                <h6 class="brand-name-2">{{ $row->model->subbrand->brand->name .' - '. $row->model->subbrand->name }}</h6>
                                                <!-- hr -->
                                                <hr>
                                                <!-- single-product-tab -->
                                                <div class="single-product-tab">
                                                    <ul class="reviews-tab mb-20">
                                                        <li  class="active"><a href="#anons_{{ $key }}" data-toggle="tab">материал</a></li>
                                                        <li><a href="#description_{{ $key }}" data-toggle="tab">описание</a></li>
                                                        <li ><a href="#information_{{ $key }}" data-toggle="tab">характеристики</a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div role="tabpanel" class="tab-pane active" id="anons_{{ $key }}">
                                                            <p>{!! $row->model->anons !!}</p>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane" id="description_{{ $key }}">
                                                            <p>{!! $row->model->content !!}</p>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane" id="information_{{ $key }}">
                                                            {!! $row->model->techs !!}
                                                        </div>

                                                    </div>
                                                </div>
                                                <hr>
                                                <!-- single-pro-color-rating -->
                                                
                                                <div class="single-pro-color-rating clearfix"  style="{{ $row->model->old_price ? 'float: left;' : ''}}">
                                                    <h4 class="prod-price">{{ $row->price }} &#8381;</h4>
                                                </div>
                                                @if ($row->model->old_price)
                                                <div class="single-pro-color-rating text-right">
                                                    <h4 class="prod-price"  style="text-decoration: line-through;">{{ $row->model->old_price }} &#8381;</h4>
                                                </div>
                                                @endif
                                                <hr>
                                               
                                                <!-- plus-minus-pro-action -->
                                                <div class="plus-minus-pro-action">
                                                    
                                                    <form action="" method="post" class="add-form2 cart">
                                                       {!! csrf_field() !!}
                                                        <div class="sin-plus-minus f-left clearfix">
                                                            <p class="color-title f-left">Кол-во:</p>
                                                            <div class="cart-plus-minus2 f-left">
                                                                <input type="text" value="1" name="qtybutton" class="cart-plus-minus-box" >
                                                            </div>
                                                            <ul class="beside-button action-button">
                                                                <li class="count-add-button">
                                                                   @if($row->model->available == 1)
                                                                        <a href="#" type="submit" class="add-button2" attr-id="{{ $row->model->id }}" title="Добавить в корзину"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                                    @elseif ($row->model->available == 0)
                                                                        <a href="javascript: void(0)" title="Нет в наличии"><i class="zmdi zmdi-close"></i></a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </form>
                                                    <div class="sin-pro-action f-right">
                                                        <ul class="action-button">
                                                            <li>
                                                                <form action="" method="post" class="compare-delete-form">
                                                                    {!! csrf_field() !!}
                                                                    <a href="#" type="submit" class="compare-del-button prod-wish" attr-comparerowid="{{ $row->rowId }}" attr-compareprodid="{{$row->model->id}}" title="Удалить товар из сравнения"><i class="zmdi zmdi-minus"></i></a>
                                                                </form>
                                                            </li>
                                                            <li  class="hidden_el">
                                                                <a href="#" data-toggle="modal"  data-target="#productModal"
                                                                 data-url="{{ route('home') }}"
                                                                 data-id="{{ $row->model->id }}" 
                                                                 data-available="{{ $row->model->available }}" 
                                                                 data-name="{{ $row->name }}" 
                                                                 data-price="{{ $row->price }}" 
                                                                 data-oldprice="{{ $row->model->old_price }}" 
                                                                 data-content="{{ $row->model->content }}" 
                                                                 data-image="{{ json_decode($row->model->images,true)['max'] }}" 
                                                                 class="open-ProductModal" title="Просмотр"><i class="zmdi zmdi-zoom-in"></i></a>
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
                        </div>
                    @endforeach
                @else
                    <div class="row text-center">
                        <h2 class="wl-pbl">СПИСОК СРАВНЕНИЯ ПУСТ</h2>
                        <div class="spayment-details box-shadow p-30 text-center">
                            <img src="{{ asset('assets') }}/img/cart/cart5.png" alt="empty_cart">
                            <br />
                        </div>
                        <br /><br />
                            <form action="{{route('brands')}}">
                                <button class="submit-btn-1 black-bg btn-hover-2" type="submit">в магазин</button>
                            </form>
                    </div>
                
                @endif
            </div>
        </div>
    </div>

</section>
<!-- End page content