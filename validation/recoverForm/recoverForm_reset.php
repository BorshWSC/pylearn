<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="form" method="POST">
	<div class="form__inner">
		<div class="form__header">
			<p>Проверьте свою почту</p>
			<i class="far fa-envelope"></i>
		</div>
		<div class="form__description">
			<p>
				На указанную вами почту <?php echo $_SESSION['email'] ?> было отправлено письмо с инструкцией по сбросу пароля<br>
				<?php if(isset($_SESSION['refresh'])){ echo $_SESSION['refresh']; } ?>
			</p>
		</div>
		<div class="form__button">
			<button type="submit" name="refresh_rec"> 
				<i class="fas fa-redo"></i>
			</button>
			<button type="button" onClick='location.href="https://pylearn.info/"'> На главную</button>
		</div>
	</div>
</form>