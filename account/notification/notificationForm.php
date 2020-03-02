<div class="tabcontent tabcontent-active" id="notification">

	<div class="content__header">
		<div class="header__main">
			<p class="title">Уведомления<p>
			<p>Список сообщений адресованных лично вам
			</p>
		</div>
	</div>

	<div class="content__inner content__inner__notification">

		<div class="header__profile header__profile__notification">

			<div class="tab-message">

				<div class="tablinks-message tablinks-message-active" name="new-message">
					<p >Входящие</p>
				</div>
				<div class="tablinks-message" name="favorite">
					<p >Избранное</p>
				</div>
				<div class="tablinks-message" name="history">
					<p >История</p>
				</div>

			</div>

		</div>

		<div class="content-notification">
			
			<?php require_once 'new_messageForm.php' ?>

			<?php require_once 'chosenForm.php' ?>

			<?php require_once 'historyForm.php' ?>
			
		</div>

	</div>
	
</div>


