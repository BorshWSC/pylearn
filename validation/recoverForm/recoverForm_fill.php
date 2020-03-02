<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="form form-recover" method="post">
		<p>Восстановление пароля</p>
		<div class="input-text">
			<input type="text" name="reg_info" value="<?php echo $reg_info ?>" maxlength="40">
			<span data-placeholder="<?= $reg_info_ph ?>"></span>
		</div>
		<p class="subtitle">Введите все необходимые данные и мы отправим<br> вам на почту письмо с инструкцией </p>
		<button type="submit" name="recover">Отправить</button>
		<div class="inform inform-recover">
			<p>Вопросы? Напишите нам на почту pylearn.info@gmail.com<br> мы постараемся решить все ваши проблемы</p>
			<a href="/">Вернуться на главную страницу</a>
		</div>
</form>
