<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="form" method="POST">
			<p>Регистрация</p>
			<div class="input-text">
				<input type="text" name="login" value="<?php echo $login?>" maxlength="20">
				<span data-placeholder="<?php echo $login_ph ?>"></span>
			</div>
			<div class="input-text">
				<input type="text" name="email" value="<?php echo $email?>">
				<span data-placeholder="<?php echo $email_ph ?>"></span>
			</div>
			<div class="input-text">
				<input type="password" name="password" value="<?php echo $password?>" maxlength="16">
				<span data-placeholder="<?php echo $password_ph ?>" ></span>
			</div>
			<div class="input-text">
				<input type="password" name="password_2" value="<?php echo $password_2?>" maxlength="16">
				<span data-placeholder="<?php echo $passwor_2_ph ?>" ></span>
			</div>
			<button type="submit" name="sign_up">Отправить</button>
			<div class="inform">
				<p>Уже есть аккаунт?</p>
				<p>Перейдите по ссылке и авторизуйтесь</p>
				<a href="authForm.php">Авторизация</a>
			</div>
</form>