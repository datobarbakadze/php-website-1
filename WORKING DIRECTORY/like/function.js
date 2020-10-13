
$(document).ready(function(){


	function like_dislike(type, item_id, url, update_field){
		//update_field -  0 element is dislike - 1 elemnt is like
		$.ajax({
			url:url,
			data:{"type":type,"item_id":item_id},
			type:"POST",
			dataType:'json',
			success: function(result){
				console.log(result)
				update_field[0].html(result.dislike)
				update_field[1].html(result.like)
			}
		})
	}
	$('.like_dislike').click(function(){
		var type = $(this).data('type');
		var item_id = $(this).data('item-id');
		like_dislike(type,item_id,'function.php',[$('.dislike_num'),$('.like_num')]);
	});
})