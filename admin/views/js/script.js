$(document).ready(function(){
	
	$("#drag-and-drop-zone").dmUploader({
	  url: '/admin/ajax.php?func=image_upload',
	  data: 'face=sfs',
	  maxFileSize: 300000000000, // 3 Megs 
    onDragEnter: function(){
      // Happens when dragging something over the DnD area
      this.addClass('active');
    },
    extraData: function(){
    	return { "item_id": $('.item_id').val() }
    },
    onDragLeave: function(){
      // Happens when dragging something OUT of the DnD area
      this.removeClass('active');
    },
    onInit: function(){
      // Plugin is ready to use
      ui_add_log('Penguin initialized :)', 'info');
    },
    onComplete: function(){
      // All files in the queue are processed (success or error)
      ui_add_log('All pending tranfers finished');
    },
    onNewFile: function(id, file){
      // When a new file is added using the file selector or the DnD area
      ui_add_log('New file added #' + id);
      ui_multi_add_file(id, file);
    },
    onBeforeUpload: function(id){
      // about tho start uploading a file
      ui_add_log('Starting the upload of #' + id);
      ui_multi_update_file_status(id, 'uploading', 'Uploading...');
      ui_multi_update_file_progress(id, 0, '', true);
    },
    onUploadCanceled: function(id) {
      // Happens when a file is directly canceled by the user.
      ui_multi_update_file_status(id, 'warning', 'Canceled by User');
      ui_multi_update_file_progress(id, 0, 'warning', false);
    },
    onUploadProgress: function(id, percent){
      // Updating file progress
      ui_multi_update_file_progress(id, percent);
    },
    onUploadSuccess: function(id, data){
      // A file was successfully uploaded
      ui_add_log('Server Response for file #' + id + ': ' + JSON.stringify(data));
      ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
      ui_multi_update_file_status(id, 'success', 'Upload Complete');
      ui_multi_update_file_progress(id, 100, 'success', false);
    },
    onUploadError: function(id, xhr, status, message){
      ui_multi_update_file_status(id, 'danger', message);
      ui_multi_update_file_progress(id, 0, 'danger', false);  
    },
    onFallbackMode: function(){
      // When the browser doesn't support this plugin :(
      ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
    },
    onFileSizeError: function(file){
      ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
    }
		});

	function ui_add_log(message, color)
{
  var d = new Date();

  var dateString = (('0' + d.getHours())).slice(-2) + ':' +
    (('0' + d.getMinutes())).slice(-2) + ':' +
    (('0' + d.getSeconds())).slice(-2);

  color = (typeof color === 'undefined' ? 'muted' : color);

  var template = $('#debug-template').text();
  template = template.replace('%%date%%', dateString);
  template = template.replace('%%message%%', message);
  template = template.replace('%%color%%', color);
  
  $('#debug').find('li.empty').fadeOut(); // remove the 'no messages yet'
  $('#debug').prepend(template);
}

// Creates a new file and add it to our list
function ui_multi_add_file(id, file)
{
  var template = $('#files-template').text();
  template = template.replace('%%filename%%', file.name);

  template = $(template);
  template.prop('id', 'uploaderFile' + id);
  template.data('file-id', id);

  $('#files').find('li.empty').fadeOut(); // remove the 'no files yet'
  $('#files').prepend(template);
}

// Changes the status messages on our list
function ui_multi_update_file_status(id, status, message)
{
  $('#uploaderFile' + id).find('span').html(message).prop('class', 'status text-' + status);
}

// Updates a file progress, depending on the parameters it may animate it or change the color.
function ui_multi_update_file_progress(id, percent, color, active)
{
  color = (typeof color === 'undefined' ? false : color);
  active = (typeof active === 'undefined' ? true : active);

  var bar = $('#uploaderFile' + id).find('div.progress-bar');

  bar.width(percent + '%').attr('aria-valuenow', percent);
  bar.toggleClass('progress-bar-striped progress-bar-animated', active);

  if (percent === 0){
    bar.html('');
  } else {
    bar.html(percent + '%');
  }

  if (color !== false){
    bar.removeClass('bg-success bg-info bg-warning bg-danger');
    bar.addClass('bg-' + color);
  }
}
	



// checking the services/ service cgeck
$('.service_check').on('change',function(){
 	var id = $(this).data('id');
 	var tourId = $(this).data('tour-id');
 	if ($(this).is(":checked")) {
 		var action = "mark";
 		
 	}else if ($(this).not(":checked")) {
 		var action = "unmark";
 	}
 	$.ajax({
			url: "/admin/ajax.php/?func=serviceCheck",
			data:'id='+id+'&action='+action+'&tour_id='+tourId,
			type:'POST',
			success: function(response){
				console.log(response);
				if (response!="success") {
					$('.error_bar').slideDown(300).css('color','red').text("Error Contact the developer").delay(500).slideUp(300);
				}
			}
		});
 	
 });

//checking the disabled week days
$('.week_check').on('change',function(){
 	var day_id = $(this).data('day-id');
 	var tourId = $(this).data('tour-id');
 	if ($(this).is(":checked")) {
 		var action = "mark";
 		
 	}else if ($(this).not(":checked")) {
 		var action = "unmark";
 	}

 	$.ajax({
			url: "/admin/ajax.php/?func=weekCheck",
			data:'day_id='+day_id+'&action='+action+'&tour_id='+tourId,
			type:'POST',
			success: function(response){
				console.log(response);
				if (response!="success") {
					$('.error_bar').slideDown(300).css('color','red').text("Error Contact the developer").delay(500).slideUp(300);
				}
			}
		});
 	
 });
// checking the facility/ facility cgeck
$('.facility_check').on('change',function(){
 	var id = $(this).data('id');
 	var tourId = $(this).data('tour-id');
 	if ($(this).is(":checked")) {
 		var action = "mark";
 		
 	}else if ($(this).not(":checked")) {
 		var action = "unmark";
 	}
 	$.ajax({
			url: "/admin/ajax.php/?func=facilityCheck",
			data:'id='+id+'&action='+action+'&tour_id='+tourId,
			type:'POST',
			success: function(response){
				console.log(response);
				if (response!="success") {
					$('.error_bar').slideDown(300).css('color','red').text("Error Contact the developer").delay(500).slideUp(300);
				}
			}
		});
 	
 });
//add inclusions

$('.add_inc').click(function(){
			var id = $(this).data("tour-id");
			var update = $(this).data("update");
			 $.ajax({url: "/admin/ajax.php/?func=add_inc",
			 	data:'tour_id='+id+'&text='+$('input[name=inc_text]').val()+'&update='+update,
			 	type:'POST',
			  success: function(result){
		        if(result=="success"){
		        	$('.error_bar').slideDown(300).css({background:'rgba(92,184,92,0.7)'}).text("GInclusion has been added").delay(500).slideUp(300);
		        }else if(result=="already"){
		        	$('.error_bar').slideDown(300).css({background:'red'}).text("Already exists for this tour").delay(500).slideUp(300);
		        }else{
		        	alert("FAIL");
		        }
		    }});
	    
	}); 

//add disabled dates
$('.add_date').click(function(){
			var id = $(this).data("tour-id");
			var update = $(this).data("update");
			 $.ajax({url: "/admin/ajax.php/?func=add_disabled_date",
			 	data:'tour_id='+id+'&text='+$('input[name=disable_date]').val()+'&update='+update,
			 	type:'POST',
			  success: function(result){
			  	alert(result);
		        if(result=="success"){
		        	$('.error_bar').slideDown(300).css({background:'rgba(92,184,92,0.7)'}).text("GInclusion has been added").delay(500).slideUp(300);
		        }else if(result=="already"){
		        	$('.error_bar').slideDown(300).css({background:'red'}).text("Already exists for this tour").delay(500).slideUp(300);
		        }else{
		        	alert("FAIL");
		        }
		    }});
	    
	}); 


//just delete function








	//upload function
	$('select[name=type]').on('change',function(){
		var val = $(this).val();
		if (val=="tour") {
			$('.tags-wrapper').show();
			$('select[name=level]').show();
			$('.level_label').show();
			$('.add_image2').text("375 x 560");
		}else if(val=="transfer"){
			$('.tags-wrapper').hide();
			$('select[name=level]').hide();
			$('.level_label').hide();
			
			$('.add_image2').text("364 x 294");
		}
	});
	//add services
	$('#add_services').validate({ // initialize the plugin
		rules: {
            schedule_date: {required: true, minlength:1 },service_title: {required: true},service_price: {required: true,minlength:1},service_icon: {required: true,minlength:1}}, 
        errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
    		$('#add_services').ajaxSubmit({
			    success : function (response) {
			    	console.log(response);
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("Services has been updated!").slideDown().delay(3000).slideUp();
			            }else if(response=="fail"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("This service already exists for this tour").slideDown().delay(3000).slideUp();
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();

			            }
			        }
			    });
			}

	});

	//add faq
	$('#add_faq').validate({ // initialize the plugin
		rules: {
            faq_question: {required: true, minlength:1 },
            faq_answer: {required: true}
        }, 
        errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
    		$('#add_faq').ajaxSubmit({
			    success : function (response) {
			    	console.log(response);
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("Question has been updated!").slideDown().delay(3000).slideUp();
			            }else if(response=="fail"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("This Question or answer already exists for this tour").slideDown().delay(3000).slideUp();
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();

			            }
			        }
			    });
			}

	});


	//add facility
	$('#add_facility').validate({ // initialize the plugin
		rules: {
            facility_title: {required: true},facility_price: {required: true,minlength:1},facility_icon: {required: true,minlength:1}}, 
        errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
    		$('#add_facility').ajaxSubmit({
			    success : function (response) {
			    	console.log(response);
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("facility has been updated!").slideDown().delay(3000).slideUp();
			            }else if(response=="fail"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("This facility already exists for this tour").slideDown().delay(3000).slideUp();
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();

			            }
			        }
			    });
			}

	});

	//add schedule
	$('#add_schedule').validate({ // initialize the plugin
		rules: {
            schedule_date: {required: true, minlength:1 },schedule_place: {required: true},from_time: {required: true,minlength:1},to_time: {required: true,minlength:1}}, 
        errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
    		$('#add_schedule').ajaxSubmit({
			    success : function (response) {
			    	console.log(response);
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("Tour has been updated!").slideDown().delay(3000).slideUp();
			            }else if(response=="fail"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("This shcedule already exists for this tour").slideDown().delay(3000).slideUp();
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();

			            }
			        }
			    });
			}

	});


	//uplioad day image

	//update comment
	$('.updatecomment').click(function(event){
		event.preventDefault();
		var id = $(this).attr("id").split('_')[1];
		$.ajax({
			url: "/admin/ajax.php/?func=delete_coment",
			data:'id='+id,
			type:'POST',
			success: function(response){
				if(response=="success"){
					$('#fullcoment_'+id).hide(700);
				}else{
					$('.error_bar').slideDown(300).css('color','red').text("Error while adding comment!").delay(500).slideUp(300);
				}
			}
		});
	});


		//updating lang function
		$('.save_btn').click(function(){
			var id = $(this).attr("id");
			var word = $('#word_'+id).val();
			 $.ajax({url: "/admin/ajax.php/?func=update_lang",
			 	data:'id='+id+'&word='+word,
			 	type:'POST',
			  success: function(result){
		        if(result=="success"){
		        	$('.error_bar').slideDown(300).text("Lang has been pdated! ").delay(500).slideUp(300);
		        }else{
		        	alert("ერრორი დაუკავშირდით დეველოპერს!");
		        }
		    }});
	    
	}); 
	// delete prices
 




	//inserting lang function
	$('.add_btn').click(function(){
			var lang = $('.insert').val();
			var word = $('#word').val();
			//alert(ka);
		  	//alert(de);
		  	//alert(lang);
			 $.ajax({url: "/admin/ajax.php/?func=insert_lang",
			 	data:'lang='+lang+'&word='+word,
			 	type:'POST',
			  success: function(result){

		        if(result=="success"){
		        	$('.error_bar').slideDown(300).text("lang has been added! ").delay(500).slideUp(300);
		        }else{
		        	alert(result);
		        }
		    }});
	    
	}); 

	//update product
	










	//update page
	$('.submit_page').click(function(){
		var id = $(this).attr("id").split("_")[1];
		var title = $('[name=title_'+id+']').val();
		var desc = $('[name=desc_'+id+']').val();
		$.ajax({url: "/admin/ajax.php/?func=submit_page",
			 	data:'id='+id+'&title='+title+'&desc='+desc,
			 	type:'POST',
			  success: function(result){
		        if(result=="success"){
		        	$('.error_bar').slideDown(300).text("Page has been updated! ").delay(1000).slideUp(300);
		        }else{
		        	alert(result);
		        }
		    }});
	});
       

    
	 //delete image
	 $('.delete_day_image').click(function(event){
		var id = $(this).attr("id");
		$.ajax({
			url: "/admin/ajax.php/?func=delete_image",
			data:'id='+id,
			type:'POST',
			success: function(response){
				if(response=="success"){
					$('#image_'+id).hide(700);
				}else{
					$('.error_bar').slideDown(300).css('color','red').text("Error while adding comment!").delay(500).slideUp(300);
				}
			}
		});
	});

	 //check the besttour
	 $('.best_check').on('change',function(){
	 	var id = $(this).data('id');
	 	if ($(this).is(":checked")) {
	 		var action = "mark";
	 		
	 	}else if ($(this).not(":checked")) {
	 		var action = "unmark";
	 	}
	 	$.ajax({
				url: "/admin/ajax.php/?func=checkBest",
				data:'id='+id+'&action='+action,
				type:'POST',
				success: function(response){
					if (response!="success") {
						$('.error_bar').slideDown(300).css('color','red').text("Error Contact the developer").delay(500).slideUp(300);
					}
				}
			});
	 	
	 });

	 //add an article
	 	$('.add_blog_form').validate({ // initialize the plugin
		rules: {
            title: {
                required: true,
                minlength:1
            },
            description: {
                required: true,
                minlength:1
            },
            tags: {
                required: true,
                minlength:1
            },
            author: {
                required: true,
                minlength:1
            }
        }, 
        errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
			var form = $('.add_blog_form').serializeArray();
			for (instance in CKEDITOR.instances) {
			    CKEDITOR.instances['editor1'].updateElement();
			}
			$('.add_blog_form').ajaxSubmit({
			    success : function (response) {
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("Article has been added!").slideDown().delay(3000).slideUp();
			            }else if(response=="fail"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("Please Choose all images to add the tour!").slideDown().delay(3000).slideUp();
			            }else if(response=="failt"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("article already exists!").slideDown().delay(3000).slideUp();
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();
			            	
			            }
			            console.log(response);
			        }
			    });
			}

	});

	//update blog form
	$('.update_blog_form').validate({ // initialize the plugin
		rules: {
            title: {
                required: true,
                minlength:1
            },
            description: {
                required: true,
                minlength:1
            },
            tags: {
                required: true,
                minlength:1
            },
            author: {
                required: true,
                minlength:1
            }
        }, 
        errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
			var form = $('.update_blog_form').serializeArray();
			for (instance in CKEDITOR.instances) {
			    CKEDITOR.instances['editor1'].updateElement();
			}
			$('.update_blog_form').ajaxSubmit({
			    success : function (response) {
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("Article has been Updated!").slideDown().delay(3000).slideUp();
			            }else if(response=="fail"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("Please Choose all images to add the tour!").slideDown().delay(3000).slideUp();
			            }else if(response=="failt"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("article already exists!").slideDown().delay(3000).slideUp();
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();
			            	
			            }
			            console.log(response);
			        }
			    });
			}

	});

	 //delete blog
	$('.delete_blog').click(function(){
		var id = $(this).attr('id');
		$.ajax({url: "/admin/ajax.php/?func=delete_blog",
		 	data:'id='+id,
		 	type:'POST',
		  success: function(result){
	        if(result=="success"){
	        	$('.blog_list_'+id).hide(500);
	        }else{
	        	alert(result);
	        }
	    }});

	});

	//active comment
	$('.edit').click(function(){
		var table = $(this).data("table");
		var id = $(this).data("id");
		var action = $(this).data("action");
		$.ajax({
			url: "/admin/ajax.php/?func=commentChange",
			data:'id='+id+'&table='+table+'&action='+action,
			type:'POST',
			success: function(response){
				if(response=="success"){
					$('#comment_'+id).hide(500);
				}else{
					$('.error_bar').slideDown(300).css('color','red').text("Error while adding comment!").delay(500).slideUp(300);
				}
			}
		});
	});

	//add slide
	$('.add_slide_form').validate({ // initialize the plugin
		rules: {
            ordering: {
                required: true,
                minlength:1
            },
            file: {
            	required: true
            }


        }, 
        errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
			var form = $('.add_slide_form').serializeArray();
			console.log(form);
			$('.add_slide_form').ajaxSubmit({
			    success : function (response) {
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("Slide has been added!").slideDown().delay(3000).slideUp();
			            }else if(response=="Fail failed"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'})
			            	.html("Can't upload file contact developer").slideDown().delay(3000).slideUp();
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();

			            }
			            console.log(response);
			        }
			    });
			}

	});

	//update slide
	$('.update_slide_form').validate({ // initialize the plugin
		rules: {
            ordering: {
                required: true,
                minlength:1
            }
        }, 
        errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
			var form = $('.update_slide_form').serializeArray();
			console.log(form);
			$('.update_slide_form').ajaxSubmit({
			    success : function (response) {
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("Slide has been Updated!").slideDown().delay(3000).slideUp();
			            }else if(response=="Fail failed"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'})
			            	.html("Can't upload file contact developer").slideDown().delay(3000).slideUp();
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();

			            }
			        }
			    });
			}

	});

	//delete slide
	$('.deleteSlide').click(function(){
		var id = $(this).data('id');
		$.ajax({
			url: "/admin/ajax.php/?func=deleteSlide",
			data:'id='+id,
			type:'POST',
			success: function(response){
				if(response=="success"){
					$('.slide_'+id).hide(700);
				}else{
					$('.error_bar').slideDown(300).css('color','red').text("Error while adding comment!").delay(500).slideUp(300);
				}
			}
		});
	});

	//add activity or inclusion to tour
	$('.action_submit').click(function(event){
		event.preventDefault();
		var action = $(this).data('action');
		var tour_id = $(this).data('tour-id');
		if (action=="a") {
			var option = $('select[name=activity]').val();
		}else if (action=="i") {
			var option = $('select[name=inclusion]').val();
		}

		$.ajax({
			url: "/admin/ajax.php/?func=insertAction",
			data:'tour_id='+tour_id+'&action='+action+'&option='+option,
			type:'POST',
			success: function(response){
				if(response=="success"){
					$('.error_bar').slideDown(300).css('color','white').text("has been aded").delay(500).slideUp(300);
				}else if (response=="failt") {
					$('.error_bar').slideDown(300).css('color','red').text("alerady exists").delay(500).slideUp(300);
				}else{
					$('.error_bar').slideDown(300).css('color','red').text("Error while adding comment!").delay(500).slideUp(300);
				}
			}
		});
	});

	//delete activity or inclusion from container table
	$(document).on('click','.deleteAction',function(){
		var id = $(this).data('action-id');
		var type=$(this).data('type');
		var tour_id = $(this).data('tour-id');
		$.ajax({
			url: "/admin/ajax.php/?func=deleteAction",
			data:'id='+id+'&type='+type+'&tour_id='+tour_id,
			type:'POST',
			success: function(response){
				if(response=="success"){
					$('#action_'+type+'_'+id).hide();
				}else if (response=="failt") {
					$('.error_bar').slideDown(300).css('color','red').text("alerady exists").delay(500).slideUp(300);
				}else{
					$('.error_bar').slideDown(300).css('color','red').text("Error while adding comment!").delay(500).slideUp(300);
				}
			}
		});
	});

	//add activity or inclusion in it's database
	$('#add_action_form').validate({ // initialize the plugin
		rules: {
            name: {
                required: true,
                minlength:1
            },value: {
                required: true,
                minlength:1
            },file: {
                required: true,
                minlength:1
            },table: {
                required: true,
                minlength:1
            },file_white: {
                required: true,
                minlength:1
            }
        }, 
        errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
			var form = $('#add_action_form').serializeArray();
			console.log(form);
			$('#add_action_form').ajaxSubmit({
			    success : function (response) {
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("Slide has been Updated!").slideDown().delay(3000).slideUp();
			            }else if(response=="Fail failed"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'})
			            	.html("Can't upload file contact developer").slideDown().delay(3000).slideUp();
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();

			            }
			        }
			    });
			}

	});

	//delete activity from it's database
	$('.delteteActorinc').click(function(){
		var id = $(this).data('id');
		var table = $(this).data('table');
		$.ajax({
			url: "/admin/ajax.php/?func=delteteActorinc",
			data:'id='+id+'&table='+table,
			type:'POST',
			success: function(response){
				if(response=="success"){
					$('#action_'+table+'_'+id).hide();
				}else if (response=="failt") {
					$('.error_bar').slideDown(300).css('color','red').text("alerady exists").delay(500).slideUp(300);
				}else{
					$('.error_bar').slideDown(300).css('color','red').text("Error while adding comment!").delay(500).slideUp(300);
				}
				alert(response);
			}
		});
	});

	//textarea length counter
	$('.team_desc').keyup(function(){
		var len = $(this).val().length;
		$('.count_update').html(len);
	});

	//add team
	
	$('.add_team_form').validate({ // initialize the plugin
		rules: {
            f_name: {
                required: true,
                minlength:1
            },l_name: {
                required: true,
                minlength:1
            },profesion: {
                required: true,
                minlength:1
            },file: {
                required: true,
                minlength:1
            },desc: {
                required: true,
                minlength:1
            }
        }, 
        errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
			var form = $('.add_team_form').serializeArray();
			console.log(form);
			$('.add_team_form').ajaxSubmit({
			    success : function (response) {
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("Team member has been Updated!").slideDown().delay(3000).slideUp();
			            }else if(response=="Fail failed"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'})
			            	.html("Can't upload file contact developer").slideDown().delay(3000).slideUp();
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();

			            }
			        }
			    });
			}

	});

	//update team
	
	$('.update_team_form').validate({ // initialize the plugin
		rules: {
            
        }, 
        errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
			var form = $('.update_team_form').serializeArray();
			console.log(form);
			$('.update_team_form').ajaxSubmit({
			    success : function (response) {
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("Team member has been Updated!").slideDown().delay(3000).slideUp();
			            }else if(response=="Fail failed"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'})
			            	.html("Can't upload file contact developer").slideDown().delay(3000).slideUp();
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();

			            }

			        }
			    });
			}

	});

	//check best team mebers
	$('.best_team_check').on('change',function(){
	 	var id = $(this).data('id');
	 	if ($(this).is(":checked")) {
	 		var action = "mark";
	 		
	 	}else if ($(this).not(":checked")) {
	 		var action = "unmark";
	 	}
	 	$.ajax({
				url: "/admin/ajax.php/?func=checkBestTeam",
				data:'id='+id+'&action='+action,
				type:'POST',
				success: function(response){
					if (response=="success") {
						
					}else if (response=="num fail") {
						$('.error_bar').slideDown(300).css('color','red').text("There is already a three best team member").delay(500).slideUp(300);
					}else{
						$('.error_bar').slideDown(300).css('color','red').text("Something went wrong contact the developer").delay(500).slideUp(300);
					}
				}
			});
	 	
	 });

	//delete Team member
	$('.deleteTeam').on('click',function(){
	 	var id = $(this).data('id');
	 	
	 	$.ajax({
				url: "/admin/ajax.php/?func=deleteTeam",
				data:'id='+id,
				type:'POST',
				success: function(response){
					if (response=="success") {
						$('#team_'+id).hide(700);
					}else{
						$('.error_bar').slideDown(300).css('color','red').text("Something went wrong contact the developer").delay(500).slideUp(300);
					}
				}
			});
	 	
	 });

	//add FUN INFO 
	
	$('.info_form').validate({ // initialize the plugin
		rules: {
            title: {
                required: true,
                minlength:1
            },number: {
                required: true,
                minlength:1
            },measure: {
                required: true,
                minlength:1
            },file: {
                required: true,
                minlength:1
            }
        }, 
        errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
			var form = $('.info_form').serializeArray();
			console.log(form);
			$('.info_form').ajaxSubmit({
			    success : function (response) {
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("Fun info has been added").slideDown().delay(3000).slideUp();
			            }else if(response=="Fail failed"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'})
			            	.html("Can't upload file contact developer").slideDown().delay(3000).slideUp();
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();

			            }
			        }
			    });
			}

	});

	//update fun info value
	$(document).on('change','.fun_value',function(){
		var id = $(this).data('id');
		var value = $(this).val();
	 	$.ajax({
				url: "/admin/ajax.php/?func=updaateFun",
				data:'id='+id+'&number='+value,
				type:'POST',
				success: function(response){
					if (response=="success") {
						$('.error_bar').hide().css('background-color','#5cb85c').html("Fun info has been added").slideDown().delay(3000).slideUp();
					}else{
						$('.error_bar').slideDown(300).css('color','red').text("Something went wrong contact the developer").delay(500).slideUp(300);
					}
				}
			});
	});

	//delete fun info\
	$(document).on('click','.deleteFun',function(){
		var id = $(this).data('id');
	 	$.ajax({
				url: "/admin/ajax.php/?func=deleteFun",
				data:'id='+id,
				type:'POST',
				success: function(response){
					if (response=="success") {
						$('#info_'+id).hide(1000);
					}else{
						$('.error_bar').slideDown(300).css('color','red').text("Something went wrong contact the developer").delay(500).slideUp(300);
					}
				}
			});
	});

	//add category
	$('.add_category_form').validate({ // initialize the plugin
		rules: {
            title: {
                required: true,
                minlength:1
            },name: {
                required: true,
                minlength:1
            },file: {
                required: true,
                minlength:1
            },type: {
            	required:true,
            }
        }, 
        errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
			var form = $('.add_category_form').serializeArray();
			console.log(form);
			$('.add_category_form').ajaxSubmit({
			    success : function (response) {
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("Category has been added").slideDown().delay(3000).slideUp();
			            }else if(response=="Fail failed"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'})
			            	.html("Can't upload file contact developer").slideDown().delay(3000).slideUp();
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();

			            }
			        }
			    });
			}

	});

	$('.add_review_form').validate({ // initialize the plugin
		rules: {
            name: {
                required: true,
                minlength:1
            },type: {
            	required:true,
            }
        }, 
        errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
			var form = $('.add_review_form').serializeArray();
			console.log(form);
			$('.add_review_form').ajaxSubmit({
			    success : function (response) {
			    	alert(response);
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("Review has been added").slideDown().delay(3000).slideUp();
			            }else if(response=="Fail failed"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'})
			            	.html("Can't upload file contact developer").slideDown().delay(3000).slideUp();
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();

			            }
			        }
			    });
			}

	});

	//delte category
	$(document).on('click','.deleteCat',function(){
		var id = $(this).data('id');
	 	$.ajax({
				url: "/admin/ajax.php/?func=deleteCat",
				data:'id='+id,
				type:'POST',
				success: function(response){
					alert(response);
					if (response=="success") {
						$('#cat_'+id).hide(1000);
					}else{
						$('.error_bar').slideDown(300).css('color','red').text("Something went wrong contact the developer").delay(500).slideUp(300);
					}
				}
			});
	});

	//update category
	$('.update_category_form').validate({
		rules: {
            
        }, 
        errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
			var form = $('.update_category_form').serializeArray();
			console.log(form);
			$('.update_category_form').ajaxSubmit({
			    success : function (response) {
			    	alert(response);
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("category has been updated").slideDown(100).delay(100).slideUp(100);
			            }else if(response=="Fail failed"){
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'})
			            	.html("Can't upload file contact developer").slideDown(100).delay(100).slideUp(100);
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown(100).delay(100).slideUp(100);

			            }
			        }
			    });
			}

	});

	
	//adding category
	// $(document).on('click','div.cats',function(){
	// 	var text = $(this).data('id');
	// 	var val = $('input[name=category]').val();
	// 	$('input[name=category]').val(val+text+",");
	// 	$(this).removeClass('cats').addClass('cats_red');
	// });
	// $(document).on('click','div.cats_red',function(){
	// 	var text = $(this).data('id');
	// 	var val = $('input[name=category]').val();
	// 	var str = val.replace(text+",", "");
	// 	$('input[name=category]').val(str);
	// 	$(this).removeClass('cats_red').addClass('cats');
	// });

	//delte tour
	$('.delete_tour').click(function(){
		var id = $(this).data('id');
		$.ajax({
			url: "/admin/ajax.php/?func=deleteTour",
			data:'id='+id,
			type:'POST',
			success: function(response){
				alert(response);
				if(response=="success"){
					$('#tour_'+id).hide(700);
				}else{
					$('.error_bar').slideDown(300).css('color','red').text("Error while adding comment!").delay(500).slideUp(300);
				}
			}
		});
	});
	//call the function hider for hiding any div by clicking any div
	
	// UPDATING PAGE
	$('input[name=updatePage]').click(function(event){
		event.preventDefault();
		var id = $(this).data('id');
		$('.updatePage_'+id).ajaxSubmit({
			success : function (response) {
			            if (response=="success") {
			            	$('.error_bar').css('background-color','#5cb85c').html("Page has been updated").slideDown().delay(3000).slideUp();
			            }else{
			            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();

			            }
			        }
		});
	});

	//ADDING IMAGE TO GALLERY
	$('#add_gallery').click(function(event){
		event.preventDefault();
	
		$('#gallery_form').ajaxSubmit({
			success: function(response){
				if (response=="success") {
					$('.error_bar').css('background-color','#5cb85c').html("Image has been added in gallery").slideDown().delay(3000).slideUp();
				}else{
	            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();
				}
			}
		});
	});
	//delete gallery image
	$('.delete_gal').click(function(){
		alert("asfsa");
		var id = $(this).data('id');
		$.ajax({
			url: "/admin/ajax.php/?func=deleteGallery",
			data:'id='+id,
			type:'POST',
			success: function(response){
				if(response=="success"){
					$('#gal_'+id).hide(700);
				}else{
					$('.error_bar').slideDown(300).css('color','red').text("Error while adding comment!").delay(500).slideUp(300);
				}
			}
		});
	});
	

















/*********************************************
this is ganja wbesite 

***************************************/

$(document).on('click','div.attr',function(){
	if (!$(this).hasClass('attr_red')) {
		var attrId = $(this).data("attr-id");
		var variantId = $(this).data("variant-id");
		var inputVal = $('input[name=variant_input]').val();
		var str = ""+attrId+"-"+variantId;
		inputVal+=","+str;
		$('input[name=variant_input]').val(inputVal.replace(/,$|^,/,'')).trigger('change');
		$(this).addClass('attr_red');
	}else if ($(this).hasClass('attr_red')) {
		var attrId = $(this).data("attr-id");
		var variantId = $(this).data("variant-id");
		var inputVal = $('input[name=variant_input]').val();
		var regex = attrId+"-"+variantId+","+"|"+attrId+"-"+variantId;
		var re = new RegExp(regex,"g");
		inputVal = inputVal.replace(re,'')
		$('input[name=variant_input]').val(inputVal);
		$('input[name=variant_input]').val(inputVal.replace(/,$|^,/,'')).trigger('change');
		$(this).removeClass('attr_red');
	}
});

$('input[name=item_title]').on('keyup',function(){
	var item_title = $(this).val();
	var url = item_title.toLowerCase();
	url = url.replace(/[^A-Za-z0-9_\.]+/gi,'-');
	url = url.replace(/^-|-$/gi,'');
	$('input[name=item_url]').val(url);
})

var text = CKEDITOR.instances["more_info"];
var blogText = CKEDITOR.instances["blog_description"]
if (text) {
	text.on('change',function(){  //detecting the change of the ckeditor
		CKEDITOR.instances["more_info"].updateElement(); //updating the orginal textarea after the ckeditor textarea is changed
		$('#more_info').trigger('change'); //triggering the change on original textarea
	})
}
if (blogText) {
	blogText.on('change',function(){  //detecting the change of the ckeditor
		CKEDITOR.instances["blog_description"].updateElement(); //updating the orginal textarea after the ckeditor textarea is changed
		$('#blog_description').trigger('change'); //triggering the change on original textarea
	})
}



var insertFunction = function(formElement /* this element should be ID but you can provide CLASS too*/,additionalElement1="testelement",additionalElement2="testelement"){

	$(''+formElement+' input,'+formElement+' textarea, '+formElement+' select, '+additionalElement1+','+additionalElement2+'').on('change',function(){

		//update tour
		$(''+formElement+'').validate({ // initialize the plugin
			rules: {
	            description:{
	            	required:1	
	            }

	        }, 
	        errorPlacement: function(){
	       		 return false;
	    	},

		});
		$(''+formElement+'').ajaxSubmit({
		    success : function (response) {
	    	console.log(response);
	            if (response=="success") {
	            	$('.error_bar').css('background-color','#5cb85c').html("Product has been updated!").slideDown(100).delay(100).slideUp(100);
	            }else if(response=="fail"){
	            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("Error while uploading file").slideDown(100).delay(100).slideUp(100);
	            }else{
	            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown(100).delay(100).slideUp(100);

	            }
	        }
	    });

		
	});


}


insertFunction("#update_item_form", "#more_info");
insertFunction("#update_attr_form");
insertFunction("#update_variant_form");
insertFunction("#update_category_form");
insertFunction("#udpate_blog_form", "#blog_description");


var insertonclick = function(formElement){
	$(''+formElement+'').validate({ // initialize the plugin
		rules: {}, 
	    errorPlacement: function(){
	   		 return false;
		},
		submitHandler: function () {
			$(''+formElement+'').ajaxSubmit({
			    success : function (response) {
			    	console.log(response);
		            if (response=="success") {
		            	$('.error_bar').css('background-color','#5cb85c').html("Item has been added").slideDown().delay(3000).slideUp();
		            }else{
		            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! ").slideDown().delay(3000).slideUp();

		            }
		        }
		    });
		}
	});

}
insertonclick('#add_question_form');
insertonclick('#add_price_form');


/*   just thinking */
	$('#prices_form').validate({
		rules:{
			quantity:{
				required:true
			},
			price:{
				required:true
			}
		},
		errorPlacement: function(){
       		 return false;
    	},
    	submitHandler: function () {
		$('#prices_form').ajaxSubmit({
		    success : function (response) {
		            if (response=="success") {
		            	$('.error_bar').css('background-color','#5cb85c').html("Price has been added").slideDown().delay(3000).slideUp();
		            }else if(response=="fail"){
		            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("Sorry Error!").slideDown().delay(3000).slideUp();
		            }else if (response=='already') {
		            	$('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("This quantity is already set").slideDown().delay(3000).slideUp();
		            }else{
		            $('.error_bar').css({'border-bottom':'#c9302c','background-color':'rgba(201,48,42,0.7)'}).html("ERROR! contact the developer").slideDown().delay(3000).slideUp();

		            }
		            console.log(response);
		        }
		    });
		}
	});
var likesmth = 

	$('.just-delete').click(function(){
		var id = $(this).data("object-id");
		var table = $(this).data("object-table");
		var objectId= $(this).data("object-class");
		if (typeof $(this).data('image-col') !=='undefined') {
			var imageColumn = $(this).data('image-col');
			var data = 'id='+id+'&table='+table+'&imageCol='+imageColumn;
		}else
			var data = 'id='+id+'&table='+table;
		
		 $.ajax({url: "/admin/ajax.php/?func=just_delete",
		 	data:data,
		 	type:'POST',
		  success: function(result){
	        if(result=="success"){
	        	$('#'+objectId+'-'+id).hide(500);
	        	$('.error_bar').slideDown(300).text("Object has been deleted").delay(500).slideUp(300);
	        }else{
	        	alert(result);
	        }
	}});
    
});

    $('.review_admin').click(function(){
    	var id = $(this).data("review-id");
    	var status = $(this).data('status-id');
    	var objectId = $(this).data('object-class');
    	$.ajax({url: "/admin/ajax.php/?func=review_status",
		 	data:'id='+id+'&status='+status,
		 	type:'POST',
			success: function(result){
		        if(result=="success"){
		        	$('#'+objectId+'-'+id).hide(500);
		        	$('.error_bar').slideDown(300).text("Object has been deleted").delay(500).slideUp(300);
		        }else{
		        	alert(result);
		        }
		    }
		});
    });
$('.del_image').click(function(){
			var id = $(this).data("id");
			 $.ajax({url: "/admin/ajax.php/?func=delete_gallery_image",
			 	data:'id='+id,
			 	type:'POST',
			  success: function(result){
		        // if(result=="success"){
		        	$('#gallery_image_'+id).hide(300);
		        	$('.error_bar').slideDown(300).text("Gallery image has been deleted").delay(500).slideUp(300);
		        // }else{
		        // 	alert("fail");
		        // }
		    }});
	    
	}); 






















































































//end of jquery //@@@@
CKEDITOR.replace("more_info");
CKEDITOR.replace("blog_description");

});

//.replace(/^-|-$/,'').replace(/-{2,3}/,'-')


		

var hider = function(divToHide){
		$('#'+divToHide+'').slideToggle(500)
	}
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.add_image')
                        .css({'background-image':"url('"+e.target.result+"')",'border':'none','border-radius':'180px'})
                        .width(180)
                        .height(180)
                        .html("");
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURLsecond(input){
        	if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.add_image1')
                        .css({'background-image':"url('"+e.target.result+"')",'border':'none','border-radius':'180px'})
                        .width(180)
                        .height(180)
                        .html("");
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        function readURLthird(input){
        	if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.add_image2')
                        .css({'background-image':"url('"+e.target.result+"')",'border':'none','border-radius':'180px'})
                        .width(180)
                        .height(180)
                        .html("");
                };

                reader.readAsDataURL(input.files[0]);
            }
        }



