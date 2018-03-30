<div class="up-comming-product-section mb-80">
    <div class="container">
        <div class="row">
            @if ($upcomming)
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="up-comming-pro gray-bg clearfix">
                    <div class="up-comming-pro-img f-left">
                        <a href="{{$upcomming->link}}">
                            <img src="{{ asset('assets') }}/img/up-comming/{{ $upcomming->img_362x350 }}" alt="">
                        </a>
                    </div>
                    @if($upcomming->title )
                    <div class="up-comming-pro-info f-left">
                        <h3><a href="{{$upcomming->link}}">{{ $upcomming->title }}</a></h3>
                        <p>{{ str_limit($upcomming->text, 275 ) }}</p>
                        <div class="up-comming-time">
                            <div data-countdown="{{$upcomming->until_date->format('Y/m/d') }}"></div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4 hidden-sm col-xs-12">
                <div class="banner-item banner-1">
                    <div class="ribbon-price">
                        <span>&#8381; {{ $upcomming->product->price }}</span>
                    </div>
                    <div class="banner-img">
                        <a href="{{ route('product', array($upcomming->product->id)) }}"><img src="{{ asset('assets') }}/img/banner/{{ $upcomming->banner_image }}" alt="{{ $upcomming->product->name }}" title="{{ $upcomming->product->name }}"></a>
                    </div>
                    <div class="banner-info">
                        <h3><a href="{{ route('product', array($upcomming->product->id)) }}" title="{{ $upcomming->product->name }}">{{ $upcomming->product->name }}</a></h3>
                        <ul class="banner-featured-list">
                            @if(isset($upcomming_txt) )
                                @foreach($upcomming_txt as $txt)
                                <li  class="text-left">
                                    <i class="zmdi zmdi-check"></i><span>{{ $txt[0] ? $txt[0] : '...' }} {{ $txt[1] ? $txt[1] : '...' }}</span>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                        <br />
                        <div class="banner-button text-center">
                           <a href="{{ route('product', array($upcomming->product->id)) }}">Подробно <i class="zmdi zmdi-long-arrow-right"></i></a> 
                       </div>
                   </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
