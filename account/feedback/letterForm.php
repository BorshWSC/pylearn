<div class="tabcontent-feedback tabcontent-feedback-active" id="letter">
	
	<form action="" class="form-feedback" method="POST">

		<div class="form-feedback__info">
			<div class="form-feedback__header">
				<p>Кому</p>
			</div>
		
			<div class="form-feedback__status">
				<p></p>
			</div>

		</div>
		
		<div class="form__text">
			<div class="input-text">
				<input type="text" name="login" value="" maxlength="20">
				<span data-placeholder="Введите логин получателя"></span>
			</div>
		</div>
			
		<div class="form-feedback__header">
			<p>Тема</p>
		</div>

		<div class="form__text">
			<div class="input-text input-text-feedback">
				<input type="text" name="title" value="" maxlength="70">
				<span data-placeholder="Введите заголовок сообщения"></span>
			</div>
		</div>

		<div class="form-feedback__header">
			<p>Сообщение</p>
		</div>

		<div class="form__text">
			<textarea name="message_content"></textarea>
		</div>

		<button type="submit" name="send" class="btn-send">Отправить</button>

	</form>

</div>