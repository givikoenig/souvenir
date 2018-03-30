<!-- NEWSLETTER SECTION START -->
    <div class="newsletter-section section-bg-tb pt-60 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-xs-12">
                    <div class="newsletter">
                        <div class="newsletter-info text-center">
                            <h2 class="newsletter-title">новости</h2>
                            <p>Подпишись на нашу новостную рассылку <br class="hidden-xs">и всегда оставайся в курсе самых интересных событий компании</p>
                        </div>
                        <div class="subcribe clearfix">
                            <form method="post" action="{{-- {{ route('home') }} --}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="email" name="email" placeholder=" Введите Ваш Еmail-адрес..."/>
                                <button class="submit-btn-2 btn-hover-2" type="submit">подписаться</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- NEWSLETTER SECTION END -->