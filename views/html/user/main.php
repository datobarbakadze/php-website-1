
<section class="ls section_padding_top_65 section_padding_bottom_100">
	<div class="container">
		<div class="row  d-flex justify-content-between">
			<form class="shop-register " method="POST" id="user-register" role="form">
				<div class="col-sm-4 bottompadding_60" id="user-register-design" >
					<h4 style="color:#ea8825;">Register on the market</h4>
					<div class="form-group validate-required" id="billing_first_name_field">
						<input type="text" class="form-control " name="billing_first_name" id="billing_first_name" placeholder="What is your First name? " value="">
					</div>
					<div class="form-group validate-required validate-email" id="billing_email_field">
						<input type="text" class="form-control " name="billing_email" id="billing_email" placeholder="What is your E-mail?" value="">
					</div>
					<div class="form-group" id="billing_password_field">
						<input type="password" class="form-control " name="billing_password" id="billing_password" placeholder="Please type a password" value="">
						<div class="password_rule_container">
							Recomended:
							<div class="password-rule rule-length"><i class="fa fa-check"></i> <span>more than 6 characters </span></div>
							<div class="password-rule rule-capital"><i class="fa fa-check"></i> <span>Must include capital letter </span></div>
							<div class="password-rule rule-special"><i class="fa fa-check"></i> <span>Must include special character </span></div>
							<div class="password-rule rule-number"><i class="fa fa-check"></i> <span>Must include number </span></div>
						</div>
					</div>
					<div class="form-group" id="billing_password2_field">
						<input type="password" class="form-control " name="billing_password2" id="billing_password2" placeholder="Please confirm the password" value="">
					</div>
					<div class="form-group checkbox">
						<div class="checkbox checkbox-slider--b-flat">
							<label>
								<input type="checkbox" id="rules_input" name="rules_input" value="1"> <span style="color: #ea8825;">I agree with the rules</span>
							</label>
						</div>
					</div>
					<button type="submit" name="register_button" class="theme_button wide_button color1 topmargin_10" style="width:100%;background: #ea8825;">Register Now</button>
					<div class="alert" id="register-alert"></div>
				</div>
			</form>
			<!-- ********************************
				************ user login ********
			*********************************** -->
			<form class="shop-register " action="/<?php echo constant('user') ?>" method="POST" id="user-login" role="form">
				<div class="col-sm-4 bottompadding_60" >
					<h4 style="color:#669543;">Log in to your account</h4>
					<div class="form-group validate-required validate-email" id="billing_email_field">
						<input type="text" class="form-control " name="login_billing_email" id="billing_email" placeholder="Please type your E-mail" value="">
					</div>
					<div class="form-group" id="billing_password_field">
						<input type="password" class="form-control " name="login_billing_password" id="billing_password" placeholder="Please type your password" value="">
					</div>
					<div class="form-group">	<a href="/forgot-password">Did you forgot your password ?</a>
					</div>
					<button type="submit" name="login_button" class="theme_button wide_button color1 topmargin_10" style="width:100%;background:#669543;">Login</button>
					<div class="alert" id="login-alert"></div>
				</div>
			</form>

			<!-- ********************************
				************ Forgot password form ********
			*********************************** -->
			<form class="shop-forgot" action="/<?php echo constant('user') ?>" method="POST"  id="user-forgot-password" role="form">
				<div class="col-sm-4 bottompadding_60" >
					<h4 style="color:#ff0046;">Forgot your password ?</h4>
					<div class="form-group validate-required validate-email topmargin_10" id="billing_email_field">
						<input type="text" class="form-control " name="forget_billing_email" id="billing_email" placeholder="Type E-mail to send the recovery code" value="">
					</div>
					<button type="submit" name="forget_button" class="theme_button wide_button color1 topmargin_10" style="width:100%;background:#ff0046;">Send recovery email</button>
					<div class="alert" id="forgot-alert"></div>
				</div>
			</form>
		</div>
	</div>
</section>