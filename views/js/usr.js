$(document).ready(function(){
	
	$('#user-register').validate({ // initialize the plugin
		rules: {
            billing_email: {required: true, minlength:5, email:true },
            billing_first_name: {required: true, minlength:1 },
            billing_password: {required:true, minlength:6}
        },errorPlacement: function(){ return false; },
    	submitHandler: function(){
    		$('#user-register').ajaxSubmit({
    			url:'/user/register',dataType:'json',
    			success: function(response){
                    console.log(response);
    				ajaxRedirect(response,$('#register-alert'));
    			}
    		});
    	}

	});

	$('#user-forgot-password').validate({ // initialize the plugin
		rules: {
            billing_email: {required: true}
        },errorPlacement: function(){ return false; },
    	submitHandler: function(){
    		$('#user-forgot-password').ajaxSubmit({
    			url:'/user/forget',dataType:'json',
    			success: function(response){
    				ajaxRedirect(response,$('#forgot-alert'));
    				console.log(response);
    			}
    		});
    	}

	});

	$('#user-login').validate({ // initialize the plugin
		rules: {
            login_billing_email: {required: true, email:true },
            login_billing_password: {required:true }
        },errorPlacement: function(){ return false; },
    	submitHandler: function(){
    		$('#user-login').ajaxSubmit({
    			url:'/user/login',dataType:'json',
    			success: function(response){
    				ajaxRedirect(response,$('#login-alert'));
    			}
    		});
    	}

	});
	
	$('#user-recover').validate({ // initialize the plugin
		rules: {
            billing_password: {required:true, minlength:6},
            billing_password2: {required:true, minlength:6}
        }, 
        errorPlacement: function(){
       		 return false;
    	}

	});

    //account update
    $('form#user-account input').on('change',function(){
        $('#user-account').ajaxSubmit({
            url:'/user/accountUpdate',dataType:'json',
            success: function(response){
                ajaxRedirect(response,$('#account-alert'));
            }
        });

    });


    $('#account-password').validate({ // initialize the plugin
        rules: {
            account_password: {required:true, minlength:6},
            account_password2: {required:true, minlength:6}
        }, 
        errorPlacement: function(){
             return false;
        },
        submitHandler: function(){
            $('#account-password').ajaxSubmit({
                url:'/user/passwordChange',dataType:'json',
                success: function(response){
                    ajaxRedirect(response,$('#change-password-alert'));
                }
            });
        }

    });


	
});