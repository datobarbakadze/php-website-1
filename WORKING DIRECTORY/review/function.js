$(document).ready(function(){
	//Universal commenting function
	function review(name /* name field */, rating /* email field */, review /* comment field */, item_id /* id of item to which the comment belongs */, url /* url to ajax.php url */, msg_div /* alert message div in jquery format e.g: $('#element') */){
		//update_field -  0 element is dislike - 1 elemnt is like
		$.ajax({
			url:url,
			data:{"name":name,"rating":rating,"review":review,"item_id":item_id,},
			type:"POST",
			dataType:"text",
			success: function(result){
				if (result.substr(0,8).trim()=="success") {
					show_msg(msg_div,1,result)
				}else{
					show_msg(msg_div,0,result)
				}
			}
		})
	}

	$('.review_btn').click(function(event){
		event.preventDefault();
		formData  = query_string($('#form').serialize());
		review(formData.name, formData.rating, formData.review,formData.item_id, "./function.php",$('.review_msg'))
	})
});
	