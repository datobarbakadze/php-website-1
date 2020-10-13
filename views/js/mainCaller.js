$(document).ready(function(){
	$('input[name=billing_password]').on('focus',function(){
		$('.password_rule_container').slideDown(500)
	})
	$('input[name=billing_password]').on('blur',function(){
		$('.password_rule_container').slideUp(500)
	})
	$('input[name=billing_password]').on('keyup',function(){
		var passString = $(this).val();
		//checking for capital letters
		if (passString.match(/[A-Z]+/g)) {
			$('.rule-capital *').css('color','green')
		}else
			$('.rule-capital *').css('color','#808080')

		//checking for special characters
		if (passString.match(/[!@#$%^&*(),.?":{}|<>]+/g)) {
			$('.rule-special *').css('color','green')
		}else
			$('.rule-special *').css('color','#808080')

		//checking for numbers
		if (passString.match(/[0-9]+/g)) {
			$('.rule-number *').css('color','green')
		}else
			$('.rule-number *').css('color','#808080')

		//checking for length
		if (passString.length >6) {
			$('.rule-length *').css('color','green')
		}else
			$('.rule-length *').css('color','#808080')
	});

	scrollToElement('#',detectHash(1),2000,500);
	$('.review_btn').click(function(event){
		event.preventDefault();
		var itemId = $(this).data("item-id");
		formData  = query_string($('#review-form').serialize());
		alert(formData.review);
		review(formData.name, 3, formData.review, itemId,"/ajax.php?func=add_review",$('.review_msg'))
	});
	$(document).on('click',function(){
		removeHash();
	});


	function fillOnScroll(aim, fillElement){
		
			var currentScroll = $(document).scrollTop();
			var aimToScroll = $(aim).offset().top;
			var level = $(fillElement);
			var width = level.width() / level.parent().width() * 100;
			var percent = level.data('percent');
			if (aimToScroll==aimToScroll && width<=percent) {

				level.stop().animate({
					'width':level.data('percent')+'%'
				},2000);
			}
	}

	if ($(window).width()<835) {
		$(document).on('scroll',function(){
			fillOnScroll('#indicascroll','.indica_level');
			fillOnScroll('#sativascroll','.sativa_level');
			fillOnScroll('#ruderailsscroll','.ruderails_level');
		});
	}else{
		fillOnScroll('#indicascroll','.indica_level');
		fillOnScroll('#sativascroll','.sativa_level');
		fillOnScroll('#ruderailsscroll','.ruderails_level');
	}
		
	
	
})