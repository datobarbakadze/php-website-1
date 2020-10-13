$(document).ready(function(){

var updateCart = function(basket){
	$.ajax({
		url:'/cart/get_cart_count',
		data:{'basket':basket},
		type:'POST',
		dataType:'text',
		success: function(count){
			$('.'+basket+'-count').html(count);
			$('.main-'+basket+'-count').html(count);
		}
	});
}

var ajaxCart = function(item_id,sub_quantity,quantity,basket){
	$.ajax({
		url:'/cart/cart_add',
		data: {
			"item_id":item_id,
			"sub_quantity":sub_quantity,
			"quantity":quantity,
			"basket":basket
		},
		dataType:'json',
		type:'POST',
		success: function(response){
			if (response.success) {
				updateCart(basket);
				if (basket=="cart") {
					$('#shop-cart-'+item_id)
					.removeAttr('data-item-id')
					.css({'background':'#ccc','cursor':'not-allowed'}).html("ALREADY IN CART").removeAttr('id');
				}else if(basket=="whishlist"){
					$('.add_to_whishlist i').css('color','#54be73');
					$('.whishlist-plus').css('background','#ccc').html("-");
					$('.add_to_whishlist')
					.removeAttr('data-item-id')
					.css({'cursor':'not-allowed'}).removeAttr('id');
				}
				
			}else
				console.log(response);
		}
	});
}

$(document).on('click','.shop-to-cart',function(event){
	event.preventDefault();
	var item_id = $(this).data('item-id');
	var sub_quantity = $(this).data('sub-quantity');
	var quantity = $(this).data('quantity');
	var basket = $(this).data("basket");
	//adding to cart
	ajaxCart(item_id,sub_quantity,quantity,basket);
});
//adding to cart
$(document).on('click','#ajax-to-cart',function(event){
   	event.preventDefault();
	var item_id = $(this).data('item-id');
	var sub_quantity = $('input[name=sub_quantity]:checked').val();
	var quantity = $('input[name=quantity]').val();
	var basket = $(this).data("basket");
	//adding to cart
	ajaxCart(item_id,sub_quantity,quantity,basket);
	
});

//get cart for the dropdown
var getCart = function(basket){
	$.ajax({
		url:'/cart/get_cart',
		dataType:'json',
		data:{'basket':basket},
		type:'POST',
		success: function(response){
			console.log(response);
			if (typeof response.error === 'undefined') {
				$('.'+basket+'-scroll').html("");
				var src="https://image.shutterstock.com/image-photo/sunflower-hd-iamge-yellow-flower-260nw-1455245942.jpg";
				var totalCost = 0;
				Object.keys(response).forEach(function(key) {
					totalCost+=response[key].price;
					 // empty the cart
					$('.'+basket+'-scroll').append('<a class="dropdown-item dropdown-item-'+key+' href="#"></a>'); //creating dropdown item
					$('.dropdown-item-'+key+'').append('<div class="cart-item-image"></div>'); //creating cart image container item
					$('.dropdown-item-'+key+' .cart-item-image').append('<img src="'+src+'">'); //creating actual image fro cart item


					$('.dropdown-item-'+key+'').append('<span class="cart-item-title">'+response[key].title+'</span>');//creating title
					$('.dropdown-item-'+key+'').append('<span class="cart-item-price">'+response[key].price+'$</span>');//creating price
					//creating delete button
					$('.dropdown-item-'+key+'').append('<span class="ajax-delete-busket" data-basket="'+basket+'" data-item-id="'+response[key].item_id+'" ><i class="fa fa-trash" aria-hidden="true"></i></span>');
				});
				$('.total-cost b span').html(totalCost);
			}else{
				$('.'+basket+'-scroll').html(response.error).css('text-align','center');
			}
				
		}
	});
}



$('.sub-quantity, #product_quantity').on('change',function(){
	var quantity = $('#product_quantity').val();
	var subQuantity = $('.sub-quantity:checked').val();
	var subPrice = $('.sub-quantity:checked').data("sub-price");
	var inStock = $('.sub-quantity:checked').data('stock');
	var total  = quantity * subPrice;
	if (inStock<quantity) {
		$('#product_quantity').val(Math.floor(inStock));
		//calculating total again when quantity was more than it is in stock
		total  = $('#product_quantity').val() * $('.sub-quantity:checked').data("sub-price"); 
	}
	$('#main-amount span').html(total);
	$('#product_quantity').attr('max',Math.floor(inStock));
	
	
})

$('.cart-sub-quantity, .cart-quantity').on('change',function(){
	var key = $(this).data('key');
	var quantity = $('#cart-quantity-'+key).val();
	var subQuantity = $('#cart-sub-quantity-'+key+' option:selected').val();
	var subPrice = $('#cart-sub-quantity-'+key+' option:selected').data("cart-sub-price");
	var inStock = $('#cart-sub-quantity-'+key+' option:selected').data('stock');
	var total  = quantity * subPrice;
	if (inStock<quantity) {
		$('#cart-quantity-'+key).val(inStock).trigger('change');
		//calculating total again when quantity was more than it is in stock
		 
	}
	$('#cart-quantity-'+key).attr('max',Math.floor(inStock));;
	
})

var deleteCart = function(key,basket,itemId){
	$.ajax({
		url:'/cart/deleteCart',
		data: {"key":key,"basket":basket,"item_id":itemId},
		type:'POST',
		dataType:'json',
		success: function(response){
			if (response.message=="success") {
				updateCart(basket);
				if (itemId==$('.product-id').html()) {
					if (basket=="cart") {
						$('.add_to_cart')
						.attr('data-item-id',itemId)
						.css({'background':'#54be73','cursor':'pointer'}).html("ADD IN CART").attr('id','ajax-to-cart');
					}else if(basket=="whishlist"){
						$('.add_to_whishlist')
						.attr('data-item-id',itemId)
						.css({'cursor':'pointer'}).attr('id','ajax-to-cart');
						$('.whishlist-plus').css('background','#ff0046').html("+");
						$('.add_to_whishlist i').css('color','#ccc');
					}
					$('#main-cart-item-'+key).slideUp();
				}
			}
		}
	});
}

$(document).on('change','select[name=cart-sub-quantity], input[name=cart-quantity]',function(){
	var key = $(this).data('key');
	var quantity = $('#cart-quantity-'+key).val();
	var subQuantity = $('#cart-sub-quantity-'+key).val();
	var basket = $(this).data('basket');
	$.ajax({
		url:'/cart/updateCart',
		data: {"item_id":$(this).data('item-id'),
				"sub_quantity":subQuantity,
				"quantity":quantity,
				"basket":basket
			},
		type:'POST',
		dataType:'json',
		success: function(response){
			console.log(response);
			if (typeof response.error!=="undefined") {
				alert(response.error);
			}else{
				$('#single-cart-amount-'+key).html(" "+response.single_price);
				$('#single-full-amount-'+key).html(" "+quantity*response.single_price);
				updateMainCart(basket);
			}
		}
	});
});

var updateMainCart = function(basket){
	$.ajax({
		url:'/cart/updateMainCart',
		data: {"basket":basket},
		type:'POST',
		dataType:'json',
		success: function(response){
			if (typeof response.error!=="undefined") {
				alert(response.error);
			}else{
				$('.cart-sub-total').html(response.total_cost);
				$('.cart-total').html(response.total_cost);
			}
		}
	});
}

$('.header_cart').click(function(){
	getCart("cart");
});
$('.header_heart').click(function(){
	getCart("whishlist");
});

$(document).on('click','.ajax-delete-busket',function(){
	var key = $(this).data("key");
	var itemId = $(this).data("item-id");
	var basket = $(this).data("basket")
	deleteCart(key,basket,itemId);
});
	
});