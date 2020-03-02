<div class="tabcontent" id="feedback">

	<div class="content__header">
		<div class="header__main">
			<p class="title">Обратная связь<p>
			<p>Здесь вы можете написать личное сообщение любому пользователю или администратору команды PyLearn (логин админа - pylearn)
			</p>
		</div>
	</div>

	<div class="content__inner content__inner__notification">

		<div class="header__profile header__profile__notification">

			<div class="tab-message">

				<div class="tablinks-feedback tablinks-feedback-active" name="letter">
					<p>Написать</p>
				</div>

				<div class="tablinks-feedback" name="dispatch">
					<p>Исходящие</p>
				</div>

			</div>

		</div>

		<div class="content-notification">
			
			<?php require_once 'letterForm.php' ?>
			<?php require_once 'dispatchForm.php' ?>
			
		</div>

	</div>
	
</div>
