
<section class="ls section_padding_top_65 section_padding_bottom_75 columns_padding_25">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 ">
				<form class="shop-register " action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST" id="user-recover" role="form">
				<div class="col-sm-3"></div>
				<div class="col-sm-6 bottompadding_60" id="user-login-design">
					<h4 style="color:#ff0046;">Recover your password</h4>
					<div class="form-group validate-required validate-email" id="recover_passsword">
						<input type="password" class="form-control " name="billing_password" id="billing_password" placeholder="Please type your E-mail" value="">
						<div class="password_rule_container">
							Recomended:
							<div class="password-rule rule-length"><i class="fa fa-check"></i> <span>more than 6 characters </span></div>
							<div class="password-rule rule-capital"><i class="fa fa-check"></i> <span>Must include capital letter </span></div>
							<div class="password-rule rule-special"><i class="fa fa-check"></i> <span>Must include special character </span></div>
							<div class="password-rule rule-number"><i class="fa fa-check"></i> <span>Must include number </span></div>
						</div>
					</div>
					<div class="form-group" id="billing_password_field">
						<input type="password" class="form-control " name="billing_password2" id="billing_password" placeholder="Please type your password" value="">
					</div>
					<button type="submit" name="recover_button" class="theme_button wide_button color1 topmargin_10" style="width:100%;background:#ff0046;">Recover</button>
					<?php $obj->recoverPass() ?>
				</div>
			</form>
			</div>
		</div>
	</div>
</section>