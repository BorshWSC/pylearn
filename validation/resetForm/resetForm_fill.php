<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="form form-reset" method="POST">
	<p>Сброс пароля</p>
	<div class="input-text">
		<input type="password" name="password" value="<?php echo $password?>" maxlength="16">
		<span data-placeholder="<?php echo $password_ph ?>" ></span>
	</div>
	<div class="input-text">
		<input type="password" name="password_2" value="<?php echo $password_2?>" maxlength="16">
		<span data-placeholder="<?php echo $passwor_2_ph ?>" ></span>
	</div>
	<button type="submit" name="reset">Отправить</button>
	<div class="inform">
		<p class="success"><?= $success ?></p>	
	</div>
</form>