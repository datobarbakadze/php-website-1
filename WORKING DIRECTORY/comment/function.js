$(document).ready(function(){
	function OBJbeforesend(){
		this.before = function(){
			beforeSendGif(0,$('.before_comment'),"36px","../loading.gif")
		}
		this.after = function(){
			beforeSendGif(1,$('.before_comment'))
		}
	}
	var OBJbeforesend = new OBJbeforesend();

	function beforeSendGif(method,/* 0 = before 1= after */ element, /* pass the elemtn after which you want gif to hosw up*/ size, /*specfy gif size*/ gif /*full path of gif*/){
		if (method==0) {
			element.after("<img src='"+gif+"' class='loadgif' width='"+size+"' height='"+size+"'>");
		}else if(method==1){
			$('.loadgif').show().delay(10000000).remove()
		}else{
			return false;
		}
	}

	function query_string(str /*insert query string here */){ //this function used to turn query string into json array
		var resultArray = {}
		var res = str.split('&');
		console.log(res)
		for (var i = res.length - 1; i >= 0; i--) {
			var per = res[i].split("=");
			resultArray[""+per[0]+""] = per[1];
		}
		return resultArray;
		//if you use this function you need to restrict using & = symbols in text which is sent via provided query string
		//further modification is requiered (it should not be required to restrict above mentioned symbols)
	}



	//this function makes it possible to flexibly show alert html msg after ajax response
	function show_msg(msg_element /*html elemnt which must be shown in jquery format  e.g$('#elemnt') */, msg_type, /* 1 or 0, 1 means success message, 0 means danger message or warning */text/*text which must be written in provided html element*/){ 
		if (msg_type==1) {
			msg_element.removeClass("alert-success alert-danger").addClass("alert-success").slideDown();
		}else if(msg_type==0){
			msg_element.removeClass("alert-success alert-danger").addClass("alert-danger").slideDown();
		}else{
			return false;
		}
		msg_element.html(text).delay(3000).slideUp();
	}
	

	//Universal commenting function
	function comment(name /* name field */, email /* email field */, comment /* comment field */, item_id /* id of item to which the comment belongs */, url /* url to ajax.php url */, msg_div /* alert message div in jquery format e.g: $('#element') */){
		//update_field -  0 element is dislike - 1 elemnt is like
		$.ajax({
			url:url,
			data:{"name":name,"email":email,"comment":comment,"item_id":item_id,},
			type:"POST",
			dataType:"text",
			beforeSend: OBJbeforesend.before(),
			success: function(result){
				if (result.substr(0,8).trim()=="success") {
					show_msg(msg_div,1,result)
				}else{
					show_msg(msg_div,0,result)
				}
				OBJbeforesend.after();
			}
		})
	}

	$('.comment_btn').click(function(e){
		e.preventDefault();
		formData  = query_string($('#form').serialize());
		comment(formData.name, formData.email, formData.comment, formData.item_id,"function.php",$(".msg_div"))
	});

})