<div class="tabcontent" id="option">

		<div class="content__header">
			<div class="header__main">
				<p class="title">Личные данные<p>
				<p>Основная информация о вас, которую вы используете на сайте PyLearn	
				</p>
			</div>
		</div>
		<div class="content__inner">
			<div class="option">

				<div class="header__profile">
					<p class="subtitle">Профиль</p>
					<p>Некоторая информация (логин, имя ...) видна другим пользователям</p>
				</div>

				<div class="option__header" data-hide="#login">
					<h4>Логин</h4>
					<p><?= $login_info ?></p>
				</div>

				<form action="" id="login" class="form" method="POST">
					<div class="inner__form">
						<div class="form__text">
							<div class="input-text">
								<input type="text" name="login" value="" maxlength="20">
								<span data-placeholder="Введите ваш новый логин"></span>
							</div>
						</div>
						<div class="form__info">
							<p></p>
						</div>
						<button type="submit" name="nw-login" class="btn">Изменить</button>
					</div>
				</form>

			</div>

			<div class="option">

				<div class="option__header" data-hide="#password">
					<h4>Пароль</h4>
					<p><?= $password_info?></p>
				</div>

				<form action="" id="password" class="form" method="POST">
					<div class="inner__form">
						<div class="form__text">
							<div class="input-text">
								<input type="password" name="password_old" value="" maxlength="16">
								<span data-placeholder="Введите старый пароль" ></span>
							</div>
							<div class="input-text">
								<input type="password" name="password_new" value="" maxlength="16">
								<span data-placeholder="Введите новый пароль" ></span>
							</div>
						</div>
						<div class="form__info">
							<p></p>
						</div>
						<button type="submit" name="nw-password" class="btn">Изменить</button>
					</div>
				</form>

			</div>

			<div class="option">
				<div class="option__header" data-hide="#name">
					<h4>Имя</h4>
					<p><?= $name_info ?></p>
				</div>
				<form action="" id="name" class="form" method="POST">
					<div class="inner__form">
						<div class="form__text">
							<div class="input-text">
								<input type="text" name="name" value="" maxlength="36">
								<span data-placeholder="Введите ваше имя"></span>
							</div>
						</div>
						<div class="form__info">
							<p></p>
						</div>
						<button type="submit" name="nw-name" class="btn">Изменить</button>
					</div>
				</form>
			</div>

			<div class="option">
				<div class="option__header" data-hide="#age">
					<h4>Дата рождения</h4>
					<p><?=$birth_date?></p>
				</div>
				<form action="" id="age" class="form" method="POST">
					<div class="inner__form">
						<div class="form__text form__date">
							<div class="input-text input__day">
								<input type="text" name="age_day" value="" maxlength="2" pattern="^[0-9]+$">
								<span data-placeholder="День"></span>
							</div>
							<div class="input-text input__month">
								<select name="age_month">
									<option value="1">Январь</option>
									<option value="2">Февраль</option>
									<option value="3">Март</option>
									<option value="4">Апрель</option>
									<option value="5">Май</option>
									<option value="6">Июнь</option>
									<option value="7">Июль</option>
									<option value="8">Август</option>
									<option value="9">Сентябрь</option>
									<option value="10">Октябрь</option>
									<option value="11">Ноябрь</option>
									<option value="12">Декабрь</option>
								</select>
								<span data-placeholder="Месяц"></span>
							</div>
							<div class="input-text input__year">
								<input type="text" name="age_year" value="" maxlength="4" pattern="^[0-9]+$">
								<span data-placeholder="Год"></span>
							</div>
						</div>
						<div class="form__info">
							<p></p>
						</div>
						<button type="submit" name="nw-age" class="btn">Изменить</button>
					</div>
				</form>
			</div>
			
			<div class="option">
				<div class="option__header" data-hide="#sex">
					<h4>Пол</h4>
					<p><?= $sex_info ?></p>
				</div>
				<form action="" id="sex" class="form" method="POST">
					<div class="inner__form">
						<div class="form__text">
							<div class="input-text">
								<input type="radio" name="sex" id="radio_male" value="0">
								<label for="radio_male">Муж</label>
							</div>
							<div class="input-text">
								<input type="radio" name="sex" id="radio_female" value="1">
								<label for="radio_female">Жен</label>
							</div>
						</div>
						<div class="form__info">
							<p></p>
						</div>
						<button type="submit" name="nw-sex" class="btn">Изменить</button>
					</div>
				</form>
			</div>

		</div>
		<!-- content__inner -->
		<div class="content__inner">
			<div class="option">

				<div class="header__profile">
					<p class="subtitle">Контактная информация</p>
					<p>Данные по которым мы можем связаться с вами (видна только вам и команде PyLearn)</p>
				</div>

				<div class="option__header" data-hide="#email">
					<h4>Email</h4>
				</div>
				<div id="email" class="option__description">
					<p><?= $email_info ?></p>
				</div>
			</div>
	</div>

</div>