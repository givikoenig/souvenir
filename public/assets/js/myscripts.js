jQuery(document).ready(function($) {

// ====== Product QuickView ======= //

	$(".open-ProductModal").on("click", function() {
		var prodId = $(this).data("id");
		var prodAv = $(this).data("available");
		var siteUrl = $(this).data("url");
		var prodLink = siteUrl + "/product/" + prodId;
		var prodName = $(this).data("name");
		var prodPrice = $(this).data("price");
		var prodOldPrice = $(this).data("oldprice");
		var prodImage = $(this).data("image");
		var imgPath = siteUrl + "/assets/img/product/";
		var img = imgPath + prodImage;
		var prodDescr = $(this).data("content");
		if (prodAv == '0') {
			$("#french-hens").val(0);
			$("#french-hens").attr("disabled","");
			$("#add-button").text("Товар отсутствует");
			$("#add-button").attr("disabled","");
		} else {
			$("#french-hens").val(1);
			$("#french-hens").removeAttr("disabled");
			$("#add-button").text("Добавить в корзину");
			$("#add-button").removeAttr("disabled");
		}
		$("#productId").val(prodId);
		$("#prodName").text(prodName);
		if (prodPrice != 0) {
			$("#prodPrice").text(prodPrice).append(' &#8381;');
		}
		if (prodOldPrice != 0) {
			$("#prodOldPrice").text(prodOldPrice).append(' &#8381;');
		}
		if (prodImage != 0) {
			$("#prodImage").attr("src", img);
		}
		$("#prodDescr").text(prodDescr);
		$("#prodId").attr("href", prodLink);
	});

// ==== Adding Product to Shopping Cart from QuickView modal-window ==== //

	$(".add-form").on("click", ".add-button" , function(e){
		e.preventDefault();
		var siteUrl = $(".open-ProductModal").data("url");
		var data = $('.add-form').serializeArray();
		var pathname = window.location.pathname; // Returns path only
		var url      = window.location.href;     // Returns full URL
		$.ajax({
			url: siteUrl + "/addtocart",
			data: data,
			datatype:'JSON',
			headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type:'POST',
			success: function(html) {
				$('.cart_result').
				css('color','#6c3906')
				.text('Товар "' + html.data.name + '"' + ' добавлен в корзину в количестве ' + html.data.qty + ' шт.')
				.fadeIn(500)
				.delay(2000)
				.fadeOut(500);

				if (pathname == '/cart') {
					$("#crt").click();
				}
				
				setTimeout(function(){
					$("#prodId").click();
				}, 3000);

				$(".cart-quantity").text(html.data.count);
				$("#cart-wrap").attr("class", "total-cart-pro");
				$("#cart-wrap").append("<div class='single-cart clearfix'>"
					+ "<div class='cart-img f-left'><a href='"
					+ siteUrl + "/product/" + html.data.id + "'><img src='" + siteUrl + "/assets/img/product/"+
					html.data.image + "' alt='Cart Product' width='65' /></a>"
					+"<div class='del-icon'><a href='#'><i class=''></i></a></div></div>"
					+"<div class='cart-info f-left'><h6 class='text-capitalize'><a href='"
					+ siteUrl + "/product/" + html.data.id + "'>"
					+ html.data.name +
					"</a></h6><p><span>Кол-во:</span>" 
					+ html.data.qty +
					"</p><p><span>Цена:</span>" 
					+ html.data.price +
					" &#8381;</p><p><span>Сумма:</span>"
					+ html.data.one_prod_sum + " &#8381;</p></div></div>");

				$(".cart-total").text(html.data.total).append(" &#8381;");
				$(".cart-page").text("оформить заказ");

			},
			error: function() {
				$('.cart_result').
				css('color','#6c3906')
				.text('Ошибка при добавлении товара в корзину…')
				.fadeIn(500)
				.delay(2000)
				.fadeOut(500);
			}
		});
	});

// ======= Adding Product to Shopping Cart from Pages ======= //

	$(".add-form2").on("click", ".add-button2", function(j){
		j.preventDefault();
		var siteUrl = $(".open-ProductModal").data("url");
		var id = $(this).attr("attr-id");
		var $button = $(this);
		var new_qty = $button.parent().parent().parent().find("input").val();
		var data = $('.add-form2').serializeArray();
		data.push({name: 'id', value: id});
		if (new_qty > 0) {
			data.push({name: 'qty', value: new_qty});
		}
		$.ajax({
			url: siteUrl + "/addtocart",
			data: data,
			datatype:'JSON',
			headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type:'POST',
			success: function(html) {
				if ( !$("body").hasClass("cart_result") ) {
					$(".cart_result_here").addClass("cart_result");
				}
				$('.cart_result').
				css('color','#6c3906')
				.text('Товар "' + html.data.name + '"' + ' добавлен в корзину в количестве ' + html.data.qty + ' шт.')
				.fadeIn(500)
				.delay(2000)
				.fadeOut(500);
				setTimeout(function(){
					$("#prodId").click();
				}, 3000);
				$(".cart-quantity").text(html.data.count);
				$("#cart-wrap").attr("class", "total-cart-pro");
				$("#cart-wrap").append("<div class='single-cart clearfix'>"
					+ "<div class='cart-img f-left'><a href='"
					+ siteUrl + "/product/" + html.data.id + "'><img src='" + siteUrl + "/assets/img/product/"+
					html.data.image + "' alt='Cart Product' width='65' /></a>"
					+"<div class='del-icon'><a href='#'><i class=''></i></a></div></div>"
					+"<div class='cart-info f-left'><h6 class='text-capitalize'><a href='"
					+ siteUrl + "/product/" + html.data.id + "'>"
					+ html.data.name +
					"</a></h6><p><span>Кол-во:</span>" 
					+ html.data.qty +
					"</p><p><span>Цена:</span>" 
					+ html.data.price +
					" &#8381;</p><p><span>Сумма:</span>"
					+ html.data.one_prod_sum + " &#8381;</p></div></div>");
				$(".cart-total").text(html.data.total).append(" &#8381;");
				$(".cart-page").text("оформить заказ");
			},
			error: function() {
				$('.cart_result').
				css('color','#6c3906')
				.text('Ошибка при добавлении товара в корзину…')
				.fadeIn(500)
				.delay(2000)
				.fadeOut(500);
			}
		});
	});

// ========= Deletng Product from Shopping Cart ======== //

	$(".del-button").on("click", function(f){
		f.preventDefault();
		$butn = $(this);
		var siteUrl = $(".open-ProductModal").data("url");
		var rowid = $(this).attr("attr-rowid");
		var prodid = $(this).attr("attr-prodid");
		var data = $(".delete-form").serializeArray();
		data.push({name: 'rowid', value: rowid});
		data.push({name: 'prodid', value: prodid});
		$.ajax({
			url: siteUrl + "/delfromcart",
			data: data, 
			headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'POST',
			dataType: 'JSON',
			success: function(html) {
				$(".cart-quantity").text(html.data.count);
				$("#cart-wrap").attr("class", "total-cart-pro");
				$butn.parent().parent().parent().children().fadeOut(700, function() {
					$butn.parent().parent().parent().empty();
				});
				$(".cart-total").text(html.data.total);
				$(".cart-page").text("просмотр корзины");

				$('.cart_result').
				css('color','#6c3906')
				.text('Пересчет корзины…')
				.fadeIn(500)
				.delay(1000)
				.fadeOut(500);
				
				setTimeout(function(){
					location.reload();
				}, 2000);

			},
			error: function() {
				$('.cart_result').
				css('color','#6c3906')
				.text('Ошибка при удалении товара…')
				.fadeIn(500)
				.delay(2000)
				.fadeOut(500);
			}
		});
	});

// ============ Cart Recalculating ============ //

	$(".qtybutton").on("click", function() {
		var siteUrl = $(".open-ProductModal").data("url");
		var $button = $(this);
		var newqty = $button.parent().find("input").val();
		var rid = $button.parent().find("input").attr("attr-rid");
		var data = $(".change-qty").serializeArray();
		data.push({name: 'rid', value: rid});
		data.push({name: 'newqty', value: newqty});
		$.ajax({
			url: siteUrl + "/updatecart",
			data: data, 
			headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'POST',
			dataType: 'JSON',
			success: function(html) {
				$('.cart_result').
				css('color','#6c3906')
				.text('Пересчет корзины…')
				.fadeIn(500)
				.delay(1000)
				.fadeOut(500);
				setTimeout(function(){
					location.reload();
				}, 2000);
			},
			error: function() {
				$('.cart_result').
				css('color','#6c3906')
				.text('Ошибка при перерасчете товаров…')
				.fadeIn(500)
				.delay(2000)
				.fadeOut(500);
			}
		});
	});

// =========== Adding Product to WishList =========== //

	$(".add-wish").on("click", ".add-wish-button", function(k) {
		k.preventDefault();
		var siteUrl = $(".open-ProductModal").data("url");
		var id = $(this).attr("attr-id");
		var data = $(".add-wish").serializeArray();
		data.push({name: 'id', value: id});
		$.ajax({
			url: siteUrl + "/addtowishlist",
			data: data, 
			headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'POST',
			dataType: 'JSON',
			success: function(html) {
				if ( !$("body").hasClass("cart_result") ) {
					$(".cart_result_here").addClass("cart_result");
				}
				if(html.data.inlist == "no") {
					$("#wlcount").text('Избранное(' + html.data.count + ')');
					$('.cart_result').
					css('color','#6c3906')
					.text('Товар "' + html.data.name + '"' + ' добавлен в избранное')
					.fadeIn(500)
					.delay(2000)
					.fadeOut(500);
				} else {
					$('.cart_result').
					css('color','#6c3906')
					.text('Товар "' + html.data.name + '"' + ' уже был добавлен в избранное')
					.fadeIn(500)
					.delay(2000)
					.fadeOut(500);
				}
			},
			error: function() {
				$('.cart_result').
				css('color','#6c3906')
				.text('Ошибка при добавлении товара в Избранное…')
				.fadeIn(500)
				.delay(2000)
				.fadeOut(500);
			}
		});
	});

// ======= Deletng Product from WishList ======== //

	$(".wl-del-button").on("click", function(f){
		f.preventDefault();
		var $but = $(this);
		var siteUrl = $(".open-ProductModal").data("url");
		var wlrowid = $(this).attr("attr-wlrowid");
		var wlprodid = $(this).attr("attr-wlprodid");
		var data = $(".wl-delete-form").serializeArray();
		data.push({name: 'wlrowid', value: wlrowid});
		data.push({name: 'wlprodid', value: wlprodid});
		$.ajax({
			url: siteUrl + "/delfromwishlist",
			data: data, 
			headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'POST',
			dataType: 'JSON',
			success: function(html) {
				$but.parent().parent().parent().children().fadeOut(700, function() {
					$but.parent().parent().parent().empty();
				});
			},
			error: function() {
				$('.cart_result').
				css('color','#6c3906')
				.text('Ошибка при удалении товара из Избранного…')
				.fadeIn(500)
				.delay(2000)
				.fadeOut(500);
			}
		});
	});


// =========== Adding Product to ComparisonList =========== //

	$(".add-compare").on("click", ".add-compare-button", function(z) {
		z.preventDefault();
		var siteUrl = $(".open-ProductModal").data("url");
		var id = $(this).attr("attr-id");
		var data = $(".add-compare").serializeArray();
		data.push({name: 'id', value: id});
		$.ajax({
			url: siteUrl + "/addtocompare",
			data: data, 
			headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'POST',
			dataType: 'JSON',
			success: function(html) {
				if ( !$("body").hasClass("cart_result") ) {
					$(".cart_result_here").addClass("cart_result");
				}
				if(html.data.inlist == "no") {
					$("#comparecount").text('Сравнение (' + html.data.count + ')');
					$('.cart_result').
					css('color','#6c3906')
					.text('Товар "' + html.data.name + '"' + ' добавлен в сравнение')
					.fadeIn(500)
					.delay(2000)
					.fadeOut(500);
				} else {
					$('.cart_result').
					css('color','#6c3906')
					.text('Товар "' + html.data.name + '"' + ' уже был добавлен в сравнение')
					.fadeIn(500)
					.delay(2000)
					.fadeOut(500);
				}
			},
			error: function() {
				$('.cart_result').
				css('color','#6c3906')
				.text('Ошибка при добавлении товара в сравнение…')
				.fadeIn(500)
				.delay(2000)
				.fadeOut(500);
			}
		});
	});

// ======= Deletng Product from CompareList ======== //

	$(".compare-del-button").on("click", function(f){
		f.preventDefault();
		var $but = $(this);
		var siteUrl = $(".open-ProductModal").data("url");
		var comparerowid = $(this).attr("attr-comparerowid");
		var compareprodid = $(this).attr("attr-compareprodid");
		var data = $(".compare-delete-form").serializeArray();
		data.push({name: 'comparerowid', value: comparerowid});
		data.push({name: 'compareprodid', value: compareprodid});
		$.ajax({
			url: siteUrl + "/delfromcompare",
			data: data, 
			headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'POST',
			dataType: 'JSON',
			success: function(html) {
				$but.parent().parent().parent().parent().parent().parent().parent().parent().children().fadeOut(700, function() {
					$but.parent().parent().parent().parent().parent().parent().parent().parent().empty();
				});
			},
			error: function() {
				$('.cart_result').
				css('color','#6c3906')
				.text('Ошибка при удалении товара из списка сравнения…')
				.fadeIn(500)
				.delay(2000)
				.fadeOut(500);
			}
		});
	});

// ======= CartPage Title & Breadcrumbs ======= //

	$("#crt").on("click", function() {
		$(".breadcrumbs-title").text("Корзина");
		$(".breadcrumbs-item").text("Корзина");
		setTimeout(function(){
			location.reload();
		},700);
	});

	$("#wl").on("click", function() {
		$(".breadcrumbs-title").text("Избранное");
		$(".breadcrumbs-item").text("Избранное");
	});

	$("#ch").on("click", function() {
		$(".breadcrumbs-title").text("Проверка");
		$(".breadcrumbs-item").text("Проверка");
	});

	$("#ord").on("click", function() {
		$(".breadcrumbs-title").text("Заказ");
		$(".breadcrumbs-item").text("Заказ");
	});

// ======== Кнопка "Далее" в корзине ======= //

	$("#cart-dalee").on("click", function() {
		$("#wl").click();
	});

	$("#wish-dalee").on("click", function() {
		$("#ch").click();
	});

		$("#prodId").on("click", function() {
		$("#close").trigger("click");
	});

// =================  //  ============== //

$(".phone").mask("+7 (999) 999-99-99");

$("#appt").blur(function() {
	var appart = $("#appt").val();
	if ( $.trim(appart) != '' ) {
		$("#address").append(', кв.' + appart );
	}
});

// ============== Delivery Address Forming  && Shipping Calculation ========= // 

$("#calc_shipping").on("click", function(e) {
	e.preventDefault();
	var data = $("#shipping-form").serializeArray();
	var address = $("#address").text();
	data.push({name: 'address', value: address});
	var siteUrl = $(".open-ProductModal").data("url");
	data.push({name: 'address', value: address});
	// $("#order_captcha").click();
	
	$.ajax({
	 	url: siteUrl + "/shipping",
	 	data:data,
	 	headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	 	type:'POST',
	 	datatype:'JSON',
	 	success: function(html) {
	 		if ( $.trim(html.error) != '') {
	 			$('.wrap_result')
				.css('color','#6c3906')
				.text(html.error)
				.fadeIn(500)
				.delay(2000)
				.fadeOut(500);
	 		} else {
	 			bootbox.confirm({
	 				message: '<br>Адрес доставки: ' + html.data.address +  '.<br>Стоимость доставки: ' + html.data.shipping + '.00 руб.' ,
	 				buttons: {
	 					confirm: {
	 						label: 'Да'
	 					},
	 					cancel: {
	 						label: 'Нет'
	 					}
	 				},
	 				callback: function(result) {
		 				if (result == true) {
					 		$("#region").attr("disabled","");
					 		$("#district").attr("disabled","");
					 		$("#city").attr("disabled","");
					 		$("#street").attr("disabled","");
					 		$("#building").attr("disabled","");
					 		$("#appt").attr("disabled","");
					 		$("#prim").attr("disabled","");
					 		$("#calc_shipping").fadeOut(2000);
					 		$("#shipping").text( html.data.shipping + '.00' );
					 		$('.wrap_result')
							.css('color','#6c3906')
							.text( 'Адрес доставки: ' + html.data.address + '; стоимость доставки: ' + html.data.shipping + '.00 руб.')
							.fadeIn(500)
							.delay(2000)
							.fadeOut(500);
							// alert( html.data.total );
							$("#cart_total").val(html.data.total);
							$("#shipping_total").val(html.data.shipping);
							$("#itogo_cart").text( html.data.itogo + '.00' );
							$("#address").text(html.data.address);
							$("#delivery_address").val(html.data.address);
							$("#delivery_prim").val(html.data.prim);
							$("#makeorder").removeAttr("disabled");


						}
					}

				});
				
			}

	 	},
	 	error: function() {
			$('.wrap_result')
			.css('color','#6c3906')
			.text('Ошибка при расчете стоимости доставки…')
			.fadeIn(500)
			.delay(2000)
			.fadeOut(500);
		}
	});

});

// ============ Make Order ============== //

$("#makeorder").on("click", function(e) {
	e.preventDefault();
	var data = $("#orderform").serializeArray();
	var address = $("#delivery_address").val();
	var prim = $("#delivery_prim").val();
	var shipping = $("#shipping_total").val();
	data.push({name: 'address', value: address});
	data.push({name: 'prim', value: prim});
	data.push({name: 'shipping', value: shipping});

	$.ajax({
	 	url: $('#orderform').attr('action'),
	 	data:data,
	 	headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	 	type:'POST',
	 	datatype:'JSON',
	 	success: function(html) {
	 		
	 		if ( $.trim(html.error) != '') {
	 			$('.wrap_result')
				.css('color','#6c3906')
				.text(html.error)
				.fadeIn(500)
				.delay(2000)
				.fadeOut(500);
	 		} else {
	 			$("#address").text(html.data.address);
	 			$("#tot-address").text(html.data.address);
	 			$("#tot-email").text(html.data.email);
	 			$("#tot-phone").text(html.data.phone);
	 			$("#tot-contact").text(html.data.contact);
	 			$("#shipping").text(html.data.shipping + '.00');
	 			$("#tot-shipping").text(html.data.shipping + '.00');
	 			$("#tot-itogo_cart").text(html.data.itogo + '.00');
	 			$("#last_order_num").text(html.data.last_order_num);

	 			$('.wrap_result')
				.css('color','#6c3906')
				.text("Ваш заказ принят, мы свяжемся с Вами в ближайшее время")
				.fadeIn(500)
				.delay(2000)
				.fadeOut(500)

	 			$("#fio").attr("disabled","");
	 			$("#user_email").attr({
	 				type: "text",
	 				disabled : ""
	 			});
	 			$("#phone").attr("disabled","");
	 			$("#makeorder").attr("disabled", "");
	 			$(".order-complete-content").css('visibility','visible');
	 			$("#makeorder").fadeOut(1000);

	 			setTimeout(function(){
					$("#ord").click();
				}, 3000);	
	 		}
	 	 },
	 	error: function() {
			// alert('error');
			$('.wrap_result')
			.css('color','#6c3906')
			.text('Ошибка при оформлении заказа…')
			.fadeIn(500)
			.delay(2000)
			.fadeOut(500);
		}
	});

});

// ========= Elevatezoom ===============//
	
	$(".zoom_03").elevateZoom({
		gallery:'gallery_01', cursor: 'pointer',
		galleryActiveClass: 'active',
		zoomWindowOffetx: 10,
		zoomWindowHeight:560,
		zoomWindowWidth:504,
		borderSize: 0
	}); 

// ===== Passing Images to Fancybox - done already in build-in plugin ====== //

//  ======= Products View Type ======= //

	$(".style-grid").click(function () {
		$(".grid-row").show();
		$(".list-row").hide();
		$(".style-grid a i").css("color","#ff7f00");
		$(".style-list a i").css("color","#999999");
		$.cookie('select_style', 'grid', 20);
	});

	$(".style-list").click(function () {
		$(".list-row").show();
		$(".grid-row").hide();
		$(".style-list a i").css("color","#ff7f00");
		$(".style-grid a i").css("color","#999999");
		$.cookie('select_style', 'list', 20);
	});

	if ($.cookie('select_style') == 'grid') {
		$(".grid-row").show();
		$(".list-row").hide();
		$(".style-grid a i").css("color","#ff7f00");
		$(".style-list a i").css("color","#999999");
	} else {
		$(".list-row").show();
		$(".grid-row").hide();
		$(".style-list a i").css("color","#ff7f00");
		$(".style-grid a i").css("color","#999999");
	}

// ============ Adding Article's Like ============== //

	$('#likeform').on('click','#likesubmit',function(e) {
		e.preventDefault();
		var data = $('#likeform').serializeArray();
		$.ajax({
			url:$('#likeform').attr('action'),
			data:data,
			headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type:'POST',
			datatype:'JSON',
			success: function(html) {
				if (html.data.double == 'double') {
					$('.wrap_result').
					css('color','#6c3906')
					.text('Вы уже "лайкнули" эту статью…')
					.fadeIn(500)
					.delay(3000)
					.fadeOut(500);
				} else {
					$('.like-count').text(+($('.like-count').text()) + 1).css({"color": "#ff7f00"});
					$('.like-span').css({"color": "#ff7f00"});
				}
			},
			error: function() {
				$('.wrap_result').
				css('color','#6c3906')
				.text('Ошибка при добавлении лайка…')
				.fadeIn(500)
				.delay(2000)
				.fadeOut(500);
			}
		});
	});

// ============= Range Comment IDs ================ //

	$('.commentlist ul li').each(function(i) {
		$(this).find('.commentNumber').text('#' + ( Math.round(i/3) + 1));
	});

// ================ Add Comment ================== //

	$('#commentform').on('click','#submit',function(e) {
		e.preventDefault();
		var comParent = $(this);
		$('.wrap_result').
		css('color','#6c3906').
		text('Сохранение комментария').
		fadeIn(500,function() {
			var data = $('#commentform').serializeArray();
			$.ajax({
				url:$('#commentform').attr('action'),
				data:data,
				headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:'POST',
				datatype:'JSON',
				success: function(html) {
					if(html.error) {
						$('.wrap_result').css('color','red').append('<br /><strong>Ошибка: </strong>' + html.error.join('<br />'));
						$('.wrap_result').delay(2000).fadeOut(500);
					}
					else if(html.success) {
						$('.wrap_result')
						.append('<br /><strong>Сохранено!</strong>')
						.delay(2000)
						.fadeOut(500,function() {
							if(html.data.parent_id > 0) {
								comParent.parents('div#respond').prev().after('<div class="media mt-30 children">' + html.comment + '</div>');
							}
							else {
								if($.contains('#comments','ul.commentlist')) {
									$('ul.commentlist').append(html.comment);
								}
								else {
									$('#respond').before('<ul class="commentlist group">' + html.comment + '</ul>');
								}
							}
							$('#cancel-comment-reply-link').click();
						});
						$("#comment").val('');
						// $("#comment_captcha").val('');
					}
				},
				error:function() {
					$('.wrap_result').css('color','red').append('<br /><strong>Ошибка: </strong>');
					$('.wrap_result').delay(2000).fadeOut(500, function() {
						$('#cancel-comment-reply-link').click();
					});
				}
			});
		});
	});

	
});