@if (isset($sliders))
<div class="slider-area slider-2">
    <div class="bend niceties preview-2">
        <div id="nivoslider-2" class="slides">  
            @foreach($sliders as $key => $slider) 
            <img src="{{ asset('assets') }}/img/bg/bg-11.jpg" alt="" title="#slider-direction-{{ $key + 1 }}"/>
            @endforeach
        </div>
        @foreach($sliders as $key => $slider)
        <div id="slider-direction-{{ ($key + 1) }}" class="slider-direction">
            <div class="slider-content-{{ $key%2 == 0 ? '1' : '2'}}">
                <div class="title-container">
                    @if ($slider['price_text'])
                    <div class="wow rotateInDownLeft" data-wow-duration="2s" data-wow-delay="0.5s">
                        <h6 class="slider2-title-1">{{ $slider['price_text'] }}</h6>
                    </div>
                    @endif
                    @if ($slider['h1_text'])
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                        <h1 class="slider2-title-2">{{ $slider['h1_text'] }}</h1>
                    </div>
                    @endif
                    @if ($slider['h2_text'])
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">
                        <h2 class="slider2-title-3">{{ $slider['h2_text'] }}</h2>
                    </div>
                    @endif
                    @if ($slider['text'])
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s">
                        <p class="slider2-title-4">{!! $slider['text'] !!}</p>
                    </div>
                    @endif
                    @if ($slider['button_text'] && $slider['brand_id'])
                    @php
                    $brand_alias = App\Brand::where('id',$slider['brand_id'])->first()->alias;
                    @endphp
                    <div class="slider-button wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.5s">
                        <a href="{{route('brands',['alias' => $brand_alias ])}}" class="button extra-small button-black">
                            <span class="text-uppercase">{{ $slider['button_text'] }}</span>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            {!! $key%2 !== 0 ? '<div class="slider-content-1-image">' : '' !!}
            <div class="wow fadeIn{{ $key%2 == 0 ? 'Left' : 'Right' }}" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="layer-1-1 {{ $key%2 !== 0 ? 'layer-2-1' : '' }}">
                    <img src="{{ asset('assets') }}/img/slider/slider-2/{{ $slider['images'] }}" alt="" />
                </div>
            </div>
            {!! $key%2 !== 0 ? '</div>' : '' !!}
        </div>
        @endforeach
    </div>
</div>
@endif
