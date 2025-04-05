<?php
	require("config.php")
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>АвтоМир</title>
		<link rel="stylesheet" href="./css/main.css" />

		<link rel="icon" type="image/x-icon" href="./img/favicons/favicon.svg" />
		<link rel="apple-touch-icon" sizes="180x180" href="./img/favicons/apple-touch-icon.png" />
	</head>

	<body>
		<header class="header">
			<div class="container">
				<div class="header__row">
					<div class="logo">АвтоМир</div>
					<nav class="header__nav">
						<ul class="header__nav-list">
							<li><a href="#!">Католог</a></li>
							<li><a href="#!">О&#160;нас</a></li>
							<li><a href="#!">Контакты</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</header>
		<main class="main">
			<div class="container">
				<h1 class="main__slogan">Найдите машину своей мечты</h1>

				<div class="cards">
					<h2 class="cards__title">Выберите машину и&#160;подайте заявку на&#160;неё</h2>
					<div class="cards__wrapper">
						<div class="card">
							<img src="./img/cars/bmw.jpg" alt="BMW" class="card__img" />
							<div class="card__desc">
								<h2 class="card__title">X1</h2>
								<h3 class="card__model">BMW</h3>
								<h3 class="card__year">2021</h3>
								<h2 class="card__price">$54.000</h2>
							</div>
							<a href="#!" class="form-link">Оформить заявку</a>
							<h2 class="status-available" hidden>Доступен</h2>
							<h2 class="status-unavailable" hidden>Продан</h2>
						</div>
						<div class="card">
							<img src="./img/cars/nissan.jpg" alt="NISSAN" class="card__img" />
							<div class="card__desc">
								<h2 class="card__title">Ariya</h2>
								<h3 class="card__model">NISSAN</h3>
								<h3 class="card__year">2023</h3>
								<h2 class="card__price">$44.500</h2>
							</div>
							<a href="#!" class="form-link">Оформить заявку</a>
							<h2 class="status-available" hidden>Доступен</h2>
							<h2 class="status-unavailable" hidden>Продан</h2>
						</div>
						<div class="card">
							<img src="./img/cars/toyota.jpg" alt="TOYOTA" class="card__img" />
							<div class="card__desc">
								<h2 class="card__title">Corolla</h2>
								<h3 class="card__model">TOYOTA</h3>
								<h3 class="card__year">2022</h3>
								<h2 class="card__price">$26.000</h2>
							</div>
							<a href="#!" class="form-link">Оформить заявку</a>
							<h2 class="status-available" hidden>Доступен</h2>
							<h2 class="status-unavailable" hidden>Продан</h2>
						</div>
					</div>
				</div>
			</div>

			<section class="order-section">
				<div class="container">
					<h2 class="order-section__title">Оформить заявку</h2>
					<form class="order-form" id="globalOrderForm">
						<!-- Выбор автомобиля -->
						<div class="form-group">
							<label for="carSelect">Выберите автомобиль:</label>
							<select id="carSelect" class="form-select" required>
								<option value="" disabled selected>Выберите модель</option>
								<!-- Опции будут заполнены через JS -->
							</select>
						</div>

						<!-- Данные клиента -->
						<div class="form-group">
							<label for="clientName">ФИО:</label>
							<input type="text" id="clientName" placeholder="Иванов Иван" required />
						</div>

						<div class="form-group">
							<label for="clientPhone">Телефон:</label>
							<input type="tel" id="clientPhone" placeholder="+7 (999) 123-45-67" required />
						</div>

						<div class="form-group">
							<label for="clientEmail">Email:</label>
							<input type="email" id="clientEmail" placeholder="example@mail.com" />
						</div>

						<button type="submit" class="form-link">Отправить заявку</button>
					</form>
				</div>
			</section>
		</main>
		<footer class="footer">
			<div class="container">
				<h2 class="footer__copyright">
					&#169; АвтоМир
				</h2>
			</div>
		</footer>
		<script src="./js/index.bundle.js"></script>
	</body>
</html>
