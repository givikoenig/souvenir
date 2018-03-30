
<div id="quickview-wrapper">
    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="modal-product clearfix">
                        <div class="product-images">
                            <div class="main-image images">
                                <img alt="" id="prodImage" src="">
                            </div>
                        </div><!-- .product-images -->

                        <div class="product-info">
                            <h1 id="prodName"></h1>
                            <div class="price-box-3">
                                <div class="s-price-box">
                                    <span class="new-price" id="prodPrice"></span>
                                    <span class="old-price" id="prodOldPrice"></span>
                                </div>
                            </div>
                            
                                <a href="" class="see-all" id="prodId">Подробнее...</a>
                                <form action="" method="post" class="add-form cart">
                                    {!! csrf_field() !!}
                                    <input type="hidden" id="productId" name="id" value="" />
                                    <div class="cart_result"></div>
                                    <div class="quick-add-to-cart">
                                            <div class="numbers-row">
                                                <input type="number" min="0" id="french-hens" name="qty" value="1" />
                                            </div>
                                            <button id="add-button" class="add-button single_add_to_cart_button" type="submit">Добавить в корзину</button>
                                    </div>
                                </form>
                            <div class="quick-desc" id="prodDescr"> 
                            </div>
                            <div class="social-sharing">
                                <div class="widget widget_socialsharing_widget">
                                    <h3 class="widget-title-modal">Поделиться</h3>
                                    <ul class="social-icons clearfix">
                                        <li>
                                            <a class="facebook" href="javascript: void(0)" title="Facebook">
                                                <i class="zmdi zmdi-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="google-plus" href="javascript: void(0)" title="Google +">
                                                <i class="zmdi zmdi-google-plus"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="twitter" href="javascript: void(0)" title="Twitter">
                                                <i class="zmdi zmdi-twitter"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .product-info -->
                    </div><!-- .modal-product -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div>
    <!-- END Modal -->
</div>
