
<header class="header-area header-wrapper header-2">
<!-- header-middle-area -->
<div id="sticky-header" class="header-middle-area plr-185">
    <div class="container-fluid">
        <div class="full-width-mega-dropdown">
            <div class="row">
                <!-- logo -->
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <div class="logo">
                        <a href="/">
                            <img src="{{ asset('assets') }}/images/logo/logo.png" alt="main logo">
                        </a>

                    </div>
                </div>
                <div class="col-md-8 hidden-sm hidden-xs">
                    <nav id="primary-menu">
                        @if (isset($menu))
                        {{-- <ul class="main-menu text-center"> --}}
                        <ul id="main-nav" class="main-menu text-center">
                            @if ($main_page['name'])
                            <li><a href="/">{{ $main_page['name'] }}</a></li>
                            @endif
                            @if (isset($brands))
                            {{-- <li class="mega-parent"><a href="{{ route('brands') }}">{{ $brands_page['name'] }}</a> --}}
                            <li class="menu-item menu-item-has-children"><a href="{{ route('brands') }}">{{ $brands_page['name'] }}</a>

                                <div class="smega-menu clearfix visible-lg">
                                    
                                   
                                    <ul class="ssub-menu">
                                        @php
                                            // $chunk_brands = array_chunk($brands->toArray(), 4);
                                            // dd($chunk_brands);
                                        @endphp
                                        @foreach($brands as $key => $brand)
                                        <li><span><a href="{{ route('brands',array('alias'=>$brand['alias'])) }}">{{ $brand['name'] }}</a></span>
                                        <ul class="sub-menu">

                                            @foreach($brand->subbrands as $subbrand)
                                                @if($subbrand)
                                                    <li  class="smenu-item" style="white-space: nowrap;">
                                                    <a href="{{ route('brands',array('alias'=>$brand->alias,'subalias'=>$subbrand['alias'])) }}">{{ $subbrand['name'] }}</a>
                                                </li>
                                                @endif
                                            @endforeach
                                            
                                        </ul>
                                        </li>
                                        @endforeach
                                    </ul>

                                    {{-- 
                                    <div class="smega-menu-footer">
                                        <img src="img/marine-logo-menu-light.png" alt="">
                                        <span>- Choose <strong>Your Style</strong></span>
                                    </div> --}}

                                </div>


                               {{--  <div class="mega-menu-area clearfix"    style="top: 83%; left: -40% ;width: 180%;">

                                    <div class="mega-menu-link f-left">
                                        @foreach($brands as $key => $brand)
                                        <ul class="single-mega-item">
                                            {!! $key > 2 ? '<br />' : '' !!}
                                                <li class="menu-title"><a href="{{ route('brands',array('alias'=>$brand->alias)) }}" style="font-size: 16px;">{{ $brand['name'] }}</a></li>
                                                @foreach($brand->subbrands as $subbrand)
                                                @if($subbrand)
                                                <li>
                                                    <a href="{{ route('brands',array('alias'=>$brand->alias,'subalias'=>$subbrand['alias'])) }}" style="font-size: 13px;">{{ $subbrand['name'] }}</a>
                                                </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                        @endforeach
                                    </div>
                                    <div class="mega-menu-photo f-left">
                                        <a href="#">
                                            <img src="{{ asset('assets') }}/img/mega-menu/1.png" alt="mega menu image">
                                        </a>
                                    </div>

                                </div> --}}

                            </li>
                            @endif
                            @if(isset($blog_page))
                                <li><a href="{{ url('/articles') }}">{{ $blog_page->title }}</a>
                                @if(isset($categories))
                                    <ul class="dropdwn" style="top: 83%;">
                                    @foreach($categories as $category)
                                        @if($category->parent_id !== 0)
                                        <li><a href="{{ route('articles',$category->alias) }}">{{ $category->title }}</a></li>
                                        @endif
                                    @endforeach                                        
                                    </ul>
                                @endif
                                </li>
                            @endif
                            @foreach($menu as $key => $item)
                                @if ($item['type'] == 1)
                                <li><a href="{{ route($item['alias']) }}">{{ $item['title'] }}</a>
                                </li>
                                @elseif ($item['type'] == 2)
                                <li><a href="{{ route($item['alias']) }}">{{ $item['title'] }}</a>
                                    @if($mitems[$key]->pages)
                                    <ul class="dropdwn" style="top: 83%;">
                                        @foreach($mitems[$key]->pages as $page)
                                            @if($page->alias <> $item['alias'])
                                                <li>
                                                    <a href="{{ route($item['alias'], array('alias' => $page['alias'])) }}">{{ $page['name'] }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endif
                            @endforeach
                        </ul>
                     @endif
                 </nav>
             </div>
             <!-- header-search & total-cart -->
             <div class="col-md-2 col-sm-6 col-xs-12">
                <div class="search-top-cart  f-right">
                    <!-- header-search -->
                    <div class="header-search header-search-2 f-left">
                        <div class="header-search-inner">
                         <button class="search-toggle">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                        <form action="{{ route('brands') }}">
                            <div class="top-search-box">
                                <input type="text" placeholder="Поиск товара..."  name="keyword">
                                <button type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </div>
                        </form> 
                    </div>
                </div>
                <div class="header-account header-account-2 f-left">
                    <ul class="user-meta">
                        <li><a href="{{ Auth::user() ? route('profile') : '#' }}" title="Профиль"><i class="zmdi  {{ Auth::user() ? 'zmdi-account' : 'zmdi-view-headline' }} "></i></a>
                            <ul>
                                @if (Auth::user()) 
                                <li><a href="{{ route('profile') }}" title="Профиль">{{ Auth::user()->name }}</a></li>
                                @endif
                                <li>
                                    <a href="{{route('cart')}}#wishlist">
                                        <span id="wlcount">Избранное&nbsp;&nbsp;({{Cart::instance('wishlist')->count()}})</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('compare')}}">
                                        <span id="comparecount">Сравнение&nbsp;&nbsp;({{Cart::instance('compare')->count()}})</span>
                                    </a>
                                </li>
                                <li><a href="{{ Auth::user() ? url('/logout') : '#' }}"><div data-toggle="modal"  data-target="{{ Auth::user() ? '' : '#modalLogin' }}">
                                                    {{ Auth::user() ? 'Выход' : 'Вход'}}  
                                                </div>  
                                    </a>
                                </li>
                                @if ( !(Auth::user()))
                                <li><a href="#"><span data-toggle="modal"  data-target="#modalRegister">Регистрация</span></a></li>
                                @endif        
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- total-cart -->
                <div class="total-cart total-cart-2 f-left">
                    <div class="total-cart-in">
                        <div class="cart-toggler">
                            <a href="{{ route('cart') }}">
                                <span class="cart-quantity">{{Cart::instance('shopping')->count()}}</span><br>
                                <span class="cart-icon">
                                    <i class="zmdi zmdi-shopping-cart-plus"></i>
                                </span>
                            </a>                            
                        </div>
                        <ul>
                            <li>
                                <div class="top-cart-inner your-cart">
                                    <h5 class="text-capitalize">Ваша Корзина</h5>
                                </div>
                            </li>
                            <li>
                                <div  id="cart-wrap" class="{{ Cart::instance('shopping')->total() > 0 ? 'total-cart-pro' : '' }}">
                                    
                                    @foreach(Cart::instance('shopping')->content() as $row)
                                    <div class="single-cart clearfix">
                                       
                                        <div class="cart-img f-left">
                                            <a href="{{ route('product',$row->id) }}">
                                                <img src="{{ asset('assets') }}/img/product/{{ json_decode(App\Product::where('id',$row->id)->first()->images,true)['min'] }}" alt="Cart Product" width="100" style="width: 65px;" />
                                            </a>
                                            <form action="" method="post" class="delete-form">
                                            {!! csrf_field() !!}
                                            
                                            <div class="del-icon">
                                                <a type="submit"  class="del-button" attr-rowid="{{ $row->rowId }}" attr-prodid="{{$row->id}}" title="Удалить товар из корзины">
                                                    <i class="zmdi zmdi-close" ></i>
                                                </a>
                                            </div>
                                            </form>
                                        </div>
                                        <div class="cart-info f-left">
                                            <h6 class="text-capitalize">
                                                <a href="{{ route('product',$row->id) }}">{{$row->name}}</a>
                                            </h6>
                                            <p>
                                                <span>Кол-во:</span>{{ $row->qty }}
                                            </p>
                                            <p>
                                                <span>Цена:</span>{{$row->price .' &#8381;'}}
                                            </p>
                                            <p>
                                                <span>Сумма:</span>{{ ($row->price * $row->qty) .' &#8381;' }}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                  
                                </div>
                            </li>
                            <li>
                                <div class="top-cart-inner subtotal">
                                    <h4 class="text-uppercase g-font-2">
                                        Итого  :  
                                        <span class="cart-total">{{ Cart::instance('shopping')->total() . ' &#8381;' }}</span>
                                    </h4>
                                </div>
                            </li>
                            <li>
                                <div class="top-cart-inner view-cart">
                                    <h4 class="text-uppercase">
                                        <a href="{{ route('cart') }}"  class="cart-page">{{ Cart::instance('shopping')->total() > 0 ? 'оформить заказ' : 'корзина пуста' }}</a>
                                    </h4>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
</div>
</header>
<!-- Login form modal window -->
<div id="modalLogin" class="modal fade smodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <span class="close-modal"> &times;</span></button>
                <h3 class="modal-title">Вход</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email" class="control-label">E-mail</label>
                        <div>
                            <input id="email" type="email" class="form-control  pwd" name="email" value="{{ old('email') }}" autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Пароль</label>
                        <div>
                            <input id="password" type="password" class="form-control pwd" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Запомнить
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="btn-wrap mb-20">
                            <button type="submit" class="button extra-small mb-20">
                                <span> Вход </span>
                            </button>
                            <a class="submit-btn-2 btn-hover-2" href="{{ url('password/reset') }}">
                            Забыли пароль ?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Registration form modal window -->
<div id="modalRegister" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <span class="close-modal"> &times;</span></button>
                <h3 class="modal-title">Регистрация</h3>
            </div>
            <div class="modal-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nick name
                            <p style="font-size: 10px;">(Псевдоним для блога)</p>
                            </label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control pwd" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Пароль</label>
                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control  pwd" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Еще раз пароль</label>
                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control  pwd" name="password_confirmation" required>
                            </div>
                        </div>
                        <input type="hidden" name="croute" value="{{ Route::current()->getName() }}">
                        <div class="form-group">
                        <div class="btn-wrap mt-20 text-center">
                            <button type="submit" class="button extra-small mb-20">
                                <span> Отправить </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
