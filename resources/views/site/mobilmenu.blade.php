
<div class="mobile-menu-area hidden-lg hidden-md">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            @if(isset($brands))
                            <li><a href="{{ route('brands') }}">{{ $brands_page['name'] }}</a>
                                <ul>
                                    @foreach($brands as $brand)
                                    <li><a href="{{ route('brands',array('alias'=>$brand->alias)) }}">{{ $brand['name'] }}</a></li>
                                    @foreach($brand->subbrands as $subbrand)
                                    @if($subbrand)
                                    <li>
                                        <a href="{{ route('brands',array('alias'=>$brand->alias,'subalias'=>$subbrand['alias'])) }}">&nbsp;&nbsp;&nbsp;- {{ $subbrand['name'] }}</a>
                                    </li>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </ul>
                            </li>
                            @endif
                            @if(isset($blog_page))
                            <li><a href="{{ url('/articles') }}">{{ $blog_page->title }}</a>
                                @if(isset($categories))
                                <ul>
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
                                <ul>
                                    @foreach($mitems[$key]->pages as $page)
                                    @if($page->alias <> $item['alias'])
                                        <li>
                                            <a href="{{ route($item['alias'], ['alias' => $page['alias']] ) }}">{{ $page['name'] }}</a>
                                        </li>
                                    @endif
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
