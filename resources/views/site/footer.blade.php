
<footer id="footer" class="footer-area footer-2">
            <div class="footer-top footer-top-2 text-center ptb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="footer-logo">
                                <a href="{{route('home')}}"><img src="{{ asset('assets') }}/images/logo/logo.png" alt=""></a>
                            </div>
                            @if (isset($menu))
                            <ul class="footer-menu-2">
                                @if ($main_page['name'])
                                    <li><a href="/">{{ $main_page['name'] }}</a></li>
                                @endif
                                @if ($brands_page['name'])
                                    <li><a href="{{ route('brands') }}">{{ $brands_page['name'] }}</a></li>
                                @endif
                                @if ($blog_page['title'])
                                    <li><a href="{{ route('articles') }}">{{ $blog_page['title'] }}</a></li>
                                @endif
                                    @foreach($menu as $item)
                                        <li><a href="{{ route($item['alias']) }}">{{ $item['title'] }}</a></li>
                                    @endforeach
                            </ul>
                            @endif                                                  
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom footer-bottom-2 text-center gray-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-5">
                            <div class="copyright-text copyright-text-2">
                                <p>&copy; <a href="{{route('home')}}">{{ $company or 'Souvenir Co.'}}</a> 2017. All Rights Reserved.</p>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <ul class="footer-social footer-social-2">
                                <li>
                                    <a class="facebook" href="https://www.facebook.com/suvenirbronz" target="_blank" title="Facebook"><i class="zmdi zmdi-facebook"></i></a>
                                </li>
                                <li>
                                    <a class="google-plus" href="https://plus.google.com/" target="_blank" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a>
                                </li>
                                <li>
                                    <a class="twitter" href="" title="Twitter"><i class="zmdi zmdi-twitter"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-4 col-sm-3">
                            <div class="copyright-text copyright-text-2">
                                <p>Powered by <a href="http://givik.ru" target="_blank">GiViK</a></p>
                            </div>
                            {{-- <ul class="footer-payment">
                                <li>
                                    <a href="javascript: void(0)"><img src="{{ asset('assets') }}/img/payment/1.jpg" alt=""></a>
                                </li>
                                <li>
                                    <a href="javascript: void(0)"><img src="{{ asset('assets') }}/img/payment/2.jpg" alt=""></a>
                                </li>
                                <li>
                                    <a href="javascript: void(0)"><img src="{{ asset('assets') }}/img/payment/3.jpg" alt=""></a>
                                </li>
                                <li>
                                    <a href="javascript: void(0)"><img src="{{ asset('assets') }}/img/payment/4.jpg" alt=""></a>
                                </li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
        </footer>
