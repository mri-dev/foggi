<div class="account page-width">
	<div class="grid-layout">
		<div class="grid-row grid-row-20">
			<? $this->render('user/inc/account-offline', true); ?>
		</div>
		<div class="grid-row grid-row-80">
			<h1>Bejelentkezés</h1>
			<?=$this->msg?>
			<div class="login-form">
			<? echo $this->templates->get( 'user_login', array( 'clear' => true ) ); ?>
			</div>
		</div>
	</div>
</div>
