<form action="" method="post">
	<div class="contact-form">
		<div class="row np">
			<div class="col-md-3 form-text-md">
				<strong>Név</strong> (kötelező)
			</div>
			<div class="col-md-9">
				<input type="text" class="form-control" name="contact_name">
			</div>
		</div>
		<br>
		<div class="row np">
			<div class="col-md-3 form-text-md">
				<strong>E-mail cím</strong> (kötelező)
			</div>
			<div class="col-md-9">
				<input type="text" class="form-control" name="contact_email">
			</div>
		</div>
		<br>
		<div class="row np">
			<div class="col-md-3 form-text-md">
				<strong>Tárgy</strong>
			</div>
			<div class="col-md-9">
				<input type="text" class="form-control" name="contact_subject">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-12">
				<div>
					<strong>Üzenet</strong>
				</div>
				<textarea name="contact_msg" class="form-control msg"></textarea>
			</div>
		</div>
		<div class="row np">
			<div class="col-md-12 left">
				<? \Applications\Captcha::show(); ?>
				<div style="float:right; text-align:right;">
					<br>
					<button class="btn btn-default" name="contact_form" value="1">ÜZENET KÜLDÉSE</button>
				</div>
			</div>
		</div>
	</div>
</form>
