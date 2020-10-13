	//this function makes it possible to flexibly show alert html msg after ajax response
	var show_msg = function(msg_element /*html elemnt which must be shown in jquery format  e.g$('#elemnt') */, msg_type, /* 1 or 0, 1 means success message, 0 means danger message or warning */text/*text which must be written in provided html element*/){ 
		if (msg_type==1) {
			msg_element.removeClass("alert-success alert-danger").addClass("alert-success").slideDown();
		}else if(msg_type==0){
			msg_element.removeClass("alert-success alert-danger").addClass("alert-danger").slideDown();
		}else{
			return false;
		}
		msg_element.html(text).delay(3000).slideUp();

	}
	//function detectHash let's you detect the has in the url split it on the needle of hash and get any part of it
	var detectHash = function(urlKey /* urlKey gives you on of two parts of url after splitting on hash */){
		var location = window.location.href; //grabbing the url client is in current moment
		if (location.includes("#")) { //checking if url includes hash
			var id = location.split("#")[urlKey]; //splitting and getting the part of the url
			return id;
		}
	}

	//function scrollToElement let's you scroll to any element with animation.
	//This function was ment to be used on onload but is possible to use on any specific event by providing required parameters
	var scrollToElement = function(identifier /* this should be jquery class or id identifier */, elemnt/* this should be class or id name */, animationTime,delay){
		if (typeof elemnt !== "undefined") {
			$("html, body").delay(delay)
			.animate({ scrollTop: $(identifier+elemnt+'-scroll').offset().top - 100}, 
			animationTime);
		}
	}

	//function removeHash - removes hash from the url in real time
	//for example: after using the scrollToElement you can remove hash from url
	var removeHash = function(){
		if (typeof detectHash(1) !== "undefined") {
			var url = detectHash(0);
			history.pushState({"history":url},"without hash",url);
		}
	}

	


	//function redirects or displays message while grabbing some data from php script
	//warning: you should provide json data to this functtion according to the parameters
	//this function uses showMsg function for message displaying
	var ajaxRedirect = function(result /* json array which contains message or url */,msgElement /* provide the element to in which the message should be displayed */){
		if (result.error) {// if error MESSAGE is returned
			show_msg(msgElement,0,result.error); 
		}else if(result.success){
			show_msg(msgElement,1,result.success);// if success MESSAGE is returned
		}else if(result.error_url){
			window.location = result.error_url;// if error requires redirect and url is provided in result variable MESSAGE is returned
		}else if(result.success_url){
			window.location = result.success_url;// if success requires redirect and url is provided in result variable MESSAGE is returned
		}
	}

	//basisc functions

    var query_string = function(str /*insert query string here */){ //this function used to turn query string into json array
		var resultArray = {}
		var res = str.split('&');
		console.log(res)
		for (var i = res.length - 1; i >= 0; i--) {
			var per = res[i].split('=');
			console.log(res[i])
			console.log(per)
			resultArray[""+per[0]+""] = per[1];
		}
		
		return resultArray;
		//if you use this function you need to restrict using & = symbols in text which is sent via provided query string
		//further modification is requiered (it should not be required to restrict above mentioned symbols)
	}

    //reviews section 
    var review = function(name /* name field */, rating /* email field */, review /* comment field */, item_id /* id of item to which the comment belongs */, url /* url to ajax.php url */, msg_div /* alert message div in jquery format e.g: $('#element') */){
		//update_field -  0 element is dislike - 1 elemnt is like
		$.ajax({
			url:url,
			data:{"name":name,"rating":rating,"review":review,"item_id":item_id,},
			type:"POST",
			dataType:"text",
			success: function(result){
				console.log(result);
				alert(result.substr(0,8).trim());
				if (result.substr(0,8).trim()=="success!") {
					show_msg(msg_div,1,result)
				}else{
					show_msg(msg_div,0,result)
				}
			}
		})
	}