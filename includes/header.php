<header class="header">
		<div class="container-main">
			<div class="header__inner">
				<div class="header__logo">
					<a href ="/" class="header__logo__link">PyLearn</a>
				</div>
				<nav class="nav">
					<a href="/" class="nav__link">На главную</a>
					<a href="#" class="nav__link" data-scroll="#about">О нас</a>
					<a href="#" class="nav__link" data-scroll="#courses">Курсы</a>

					<?php if(!isset($_COOKIE['user']))
							{	
								?>
								<a href="../validation/regForm.php" class="nav__link">Регистрация</a>
								<a href="../validation/authForm.php" class="nav__link">Войти</a>
								<?php
							} 
							else
							{ ?>

								<a href="home.php" class="nav__link">Личный кабинет</a>
								<a href="../validation/out.php" class="nav__link">Выход</a>

								<?php
							}
					?>

				</nav>
			</div>
		</div>
	</header>