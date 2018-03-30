<!-- BREADCRUMBS SETCTION START -->
<div class="breadcrumbs-section plr-200 mb-80">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                        <h1 class="breadcrumbs-title">{{ $user->name }}</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="{{ route('home') }}"><i class="zmdi zmdi-home" style="font-size: 20px;"></i> домой</a></li>
                            <li>{{ $user->email }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMBS SETCTION END -->
<!-- Start page content -->
<div id="page-content" class="page-wrapper">
    <!-- LOGIN SECTION START -->
    <div class="login-section mb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <p class="text-center">Учетная запись: {{ $user->email }}</p>
                    @if (isset($errors) && count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    <div class="my-account-content" id="accordion2">
                        <!-- My Personal Information -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion2" href="#personal_info">Учетные данные</a>
                                </h4>
                            </div>
                            <div id="personal_info" class="panel-collapse collapse in" role="tabpanel">
                                <div class="panel-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="new-customers">
                                            <div class="p-30">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-lg-3">
                                                            <label class="control-label"><small>Nickname:</small></label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input  type="text"  placeholder="Ваш nickname (псевдоним)…" value="{{ $user->name }}" name="name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-3">
                                                            <label class="control-label"><small>E-mail:</small></label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input  type="text"  placeholder="Ваш E-mail…" value="{{ $user->email }}" disabled="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-3">
                                                            <label class="control-label"><small>Текущий аватар:</small></label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <img src="{{ asset('assets')}}/img/author/{{ $user->avatar ? $user->avatar : '12.jpg'}}" alt="{{ $user->avatar }}" width="50">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-3">
                                                            <label class="control-label"><small>Изменить аватар:</small></label>
                                                        </div>    
                                                        <div class="col-lg-9">
                                                            {!! Form::file('avatar', ['class' => 'filestyle', 'data-buttonText'=>'&nbsp;&nbsp;Выберите изображение', 'data-buttonName'=>"btn-info", 'data-iconName'=>'fa fa-image'  ,'data-placeholder'=>"Файла нет"] ) !!}
                                                        </div>
                                                    </div>
                                                <!-- </div> -->
                                                    <div class="form-group">
                                                        <div class="col-lg-3">
                                                            <label class="control-label txtleft"><small>Новый пароль:</small></label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input  type="password"  placeholder="Введите пароль (не менее 6 символов)…" value="" name="password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-3 ">
                                                            <label class="control-label txtleft"><small>Подтверждение пароля:</small></label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input  type="password"  placeholder="Введите пароль еще раз…" value="" name="password_confirmed">
                                                        </div>
                                                    </div>   
                                                    <div class="text-center">
                                                        <button class="submit-btn-1 mt-20 btn-hover-1" type="submit" value="Save Changes" name="user_data">Сохранить</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- My shipping address -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion2" href="#my_shipping">Реквизиты для доставки товаров:</a>
                                </h4>
                            </div>
                            <div id="my_shipping" class="panel-collapse collapse" role="tabpanel" >
                                <div class="panel-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('profile') }}">
                                        {{ csrf_field() }}
                                        <div class="new-customers p-30">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-lg-3">
                                                        <label class="control-label"><small>Ф.И.О.</small></label>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <input  type="text"  placeholder="Ваше имя…" value="{{ $user->fio }}" name="fio">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-3">
                                                        <label class="control-label"><small>Телефон (10 знаков):</small></label>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <input  class="phone" type="text"  placeholder="Ваш телефон…" value="{{ $user->phone }}" name="phone">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-3">
                                                        <label class="control-label"><small>E-mail:</small></label>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <input  type="text"  placeholder="Ваш E-mail…" value="{{ $user->email }}" disabled="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-3">
                                                        <label class="control-label"><small>Адрес доставки</small></label>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <textarea  class="custom-textarea"  placeholder="Адрес доставки…" name="address">{{ $user->address }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button class="submit-btn-1 mt-20 btn-hover-1" type="submit" value="Save Changes" name="delivery_data">Сохранить</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- My billing details -->
                            <!-- <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion2" href="#billing_address">My billing details</a>
                                    </h4>
                                </div>
                                <div id="billing_address" class="panel-collapse collapse" role="tabpanel" >
                                    <div class="panel-body">
                                        <form action="#">
                                            <div class="billing-details p-30">
                                                <input type="text"  placeholder="Your Name Here...">
                                                <input type="text"  placeholder="Email address here...">
                                                <input type="text"  placeholder="Phone here...">
                                                <input type="text"  placeholder="Company neme here...">
                                                <select class="custom-select">
                                                    <option value="defalt">country</option>
                                                    <option value="c-1">Australia</option>
                                                    <option value="c-2">Bangladesh</option>
                                                    <option value="c-3">Unitd States</option>
                                                    <option value="c-4">Unitd Kingdom</option>
                                                </select>
                                                <select class="custom-select">
                                                    <option value="defalt">State</option>
                                                    <option value="c-1">Melbourne</option>
                                                    <option value="c-2">Dhaka</option>
                                                    <option value="c-3">New York</option>
                                                    <option value="c-4">London</option>
                                                </select>
                                                <select class="custom-select">
                                                    <option value="defalt">Town/City</option>
                                                    <option value="c-1">Victoria</option>
                                                    <option value="c-2">Chittagong</option>
                                                    <option value="c-3">Boston</option>
                                                    <option value="c-4">Cambridge</option>
                                                </select>
                                                <textarea class="custom-textarea" placeholder="Your address here..."></textarea>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button class="submit-btn-1 mt-20 btn-hover-1" type="submit" value="register">Save</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button class="submit-btn-1 mt-20 btn-hover-1 f-right" type="reset">Clear</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> -->
                            <!-- My Order info -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion2" href="#My_order_info">Мои заказы</a>
                                    </h4>
                                </div>
                                <div id="My_order_info" class="panel-collapse collapse" role="tabpanel" >

                                    <div class="panel-body">
                                        @if (isset($orders))
                                        @foreach ($orders as $order)
                                            <div class="payment-details p-10-30">
                                                <div class="row">
                                                    <div class="col-sm-4 text-center">
                                                        <span > № {{ $order->order_num }}</span>
                                                    </div>
                                                    <div class="col-sm-4 text-center">
                                                        <span > от {{ $order->created_at->format('d-m-Y') }}</span>
                                                    </div>
                                                    <div class="col-sm-4 text-center">
                                                        <span > статус: {{ $order->status == 0 ? 'в обработке' : 'выполнен' }} </span>
                                                    </div>
                                                </div>
                                                
                                                <table class="myorders">
                                                    @foreach ($order->zakaz_tovar as $key => $tovar)
                                                    <tr>
                                                        <td class="td-title-1">{{ $tovar->name }} {{ $tovar->quantity > 1 ? '&nbsp;&nbsp;&nbsp;&nbsp;x&nbsp;&nbsp;&nbsp;&nbsp;' . $tovar->quantity : '' }}</td>
                                                        <td class="td-title-2">{{ $tovar->price * $tovar->quantity }} &#8381;</td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td class="td-title-1">Стоимость товара:</td>
                                                        <td class="td-title-2">{{ $order->order_total }} &#8381;</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="td-title-1">Доставка:</td>
                                                        <td class="td-title-2">{{ $order->shipping }} &#8381;</td>
                                                    </tr>

                                                    <tr>
                                                        <td class="order-total">Итого:</td>
                                                        <td class="order-total-price">{{ $order->order_total + $order->shipping }} &#8381;</td>
                                                    </tr>
                                                </table>
                                                <!-- <hr> -->
                                            </div>

                                            @endforeach
                                            @else
                                            <div class="payment-details p-30 text-center">
                                                <p>Нет заказов…</p>
                                            </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <!-- Payment Method -->
                            <!-- <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion2" href="#My_payment_method">Payment Method</a>
                                    </h4>
                                </div>
                                <div id="My_payment_method" class="panel-collapse collapse" role="tabpanel" >
                                    <div class="panel-body">
                                        <form action="#">
                                            <div class="new-customers p-30">
                                                <select class="custom-select">
                                                    <option value="defalt">Card Type</option>
                                                    <option value="c-1">Master Card</option>
                                                    <option value="c-2">Paypal</option>
                                                    <option value="c-3">Paypal</option>
                                                    <option value="c-4">Paypal</option>
                                                </select>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="text"  placeholder="Card Number">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text"  placeholder="Card Security Code">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <select class="custom-select">
                                                            <option value="defalt">Month</option>
                                                            <option value="c-1">January</option>
                                                            <option value="c-2">February</option>
                                                            <option value="c-3">March</option>
                                                            <option value="c-4">April</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <select class="custom-select">
                                                            <option value="defalt">Year</option>
                                                            <option value="c-4">2017</option>
                                                            <option value="c-1">2016</option>
                                                            <option value="c-2">2015</option>
                                                            <option value="c-3">2014</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <button class="submit-btn-1 mt-20 btn-hover-1" type="submit" value="register">pay now</button>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button class="submit-btn-1 mt-20 btn-hover-1" type="submit" value="register">cancel order</button>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button class="submit-btn-1 mt-20 f-right btn-hover-1" type="submit" value="register">continue</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- LOGIN SECTION END -->
    </div>
        <!-- End page content