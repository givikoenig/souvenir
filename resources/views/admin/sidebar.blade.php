<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">                
            <li class="active">
                <a class="" href="/admin">
                    <i class="fa fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
            @role('admin')
                <li>
                    <a class="" href="{{ route('orders', ['status' => 'new']) }}"><i class="fa fa-first-order"></i><small> Заказы</small></a>
                </li>
                <li>
                    <a class="" href="{{ route('users') }}"><i class="fa fa-users"></i><small> Пользователи</small></a>
                </li>
                <li class="active">
                    <a class="" href="javascript: void();"></a>
                </li>
            @endrole
            @role(['admin','editor'])
            <li class="sub-menu">
                <a href="javascript:;" class="">
                  <i class="fa fa-file-text-o"></i>
                  <span>Главная&nbsp;&nbsp;стр.</span>
                  <span class="menu-arrow arrow_carrot-right"></span>
              </a>
              <ul class="sub">
                <li>
                    <a class="" href="{{ route('pageblocksEdit') }}"><i class="fa fa-cubes"></i><small> Блоки</small></a>
                </li>
                <li>
                    <a class="" href="{{ route('sliders') }}"><i class="fa fa-film"></i><small> Слайды</small></a>
                </li>
                <li>
                    <a class="" href="{{ route('banners') }}"><i class="fa fa-map"></i><small> Баннер - I</small></a>
                </li> 
                <li>
                    <a class="" href="{{ route('upcommings') }}"><i class="fa fa-map"></i><small> Баннер - II</small></a>
                </li>                         
            </ul>
            </li>
            <li  class="sub-menu">
                <a class="" href="javascript:;">
                    <i class="fa fa-shopping-basket"></i>
                    <span>Магазин</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                </a>
                <ul class="sub">
                    <li>
                        <a class="" href="{{ route('brnds') }}"><i class="fa fa-bookmark-o"></i><small> Категории товаров</small></a>
                    </li>
                    <li>
                        <a class="" href="{{ route('subbrnds') }}"><i class="fa fa-folder-o"></i><small> Субкатегории</small></a>
                    </li>
                    <li>
                        <a class="" href="{{ route('products') }}"><i class="fa fa-shopping-bag"></i><small> Товары</small></a>
                    </li>
                </ul>
            </li>
            <li  class="sub-menu">
                <a class="" href="javascript:;">
                    <i class="fa fa-envira"></i>
                    <span>Блог</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                </a>
                <ul class="sub">
                    <li>
                        <a class="" href="{{ route('categories') }}"><i class="fa fa-twitch"></i><small> Темы</small></a>
                    </li>
                    <li>
                        <a class="" href="{{ route('arts') }}"><i class="fa fa-newspaper-o"></i><small> Статьи</small></a>
                    </li>
                    <li>
                        <a class="" href="{{ route('comments') }}"><i class="fa fa-comments-o"></i><small> Комментарии</small></a>
                    </li>
                </ul>
            </li>
            <li  class="sub-menu">
                <a class="" href="javascript:;">
                    <i class="fa fa-pagelines"></i>
                    <span>Доп.страницы</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                </a>
                 <ul class="sub">
                    <li>
                        <a class="" href="{{ route('mitems') }}"><i class="fa fa-navicon"></i><small> Пункты гл.меню</small></a>
                    </li>
                    <li>
                        <a class="" href="{{ route('pages') }}"><i class="fa fa-copy"></i><small> Страницы</small></a>
                    </li>
                </ul>
            </li>
        @endrole
        
    </ul>
    <!-- sidebar menu end-->
</div>
</aside>


