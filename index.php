<?php
require("config.php");
require("db.php");

include(ROOT . "templates/head.tpl");
include(ROOT . "templates/header.tpl");
?>

<main class="main">
	<div class="container">
		<h1 class="main__slogan">Найдите машину своей мечты</h1>

		<div class="cards">
			<h2 class="cards__title">Выберите машину и&#160;подайте заявку на&#160;неё</h2>
			<div class="cards__wrapper">

			<?php
			$cars = R::findAll('cars');

			foreach ($cars as $car):
				$imagePath = HOST . 'assets/img/cars/' . strtolower($car->brand) . '.jpg';
				$isSold = ($car->quantity <= 0);
			?>
				<div class="card">
					<img src="<?= $imagePath ?>" alt="<?= $car->brand ?>" class="card__img" />
					<div class="card__desc">
						<h2 class="card__title"><?= $car->model ?></h2>
						<h3 class="card__model"><?= $car->brand ?></h3>
						<h3 class="card__year"><?= $car->year ?></h3>
					<h2 class="card__price">$<?= number_format($car->price, 0, '.', ',') ?></h2>
					</div>
					<?php if (!$isSold): ?>
						<a href="#order-form" class="form-link">Оформить заявку</a>
					<?php endif; ?>
					<h2 class="status-available" <?= $isSold ? 'hidden' : '' ?>>Доступен</h2>
					<h2 class="status-unavailable" <?= !$isSold ? 'hidden' : '' ?>>Продан</h2>
				</div>
			<?php endforeach; ?>

			</div>
		</div>
	</div>

	<section class="order-section" id="order-form">
	    <div class="container">
	        <h2 class="order-section__title">Оформить заявку</h2>
	        <form class="order-form" id="globalOrderForm" action="order.php" method="POST">
	            <div class="form-group">
	                <label for="carSelect">Выберите автомобиль:</label>
	                <select id="carSelect" name="car_id" class="form-select" required>
	                    <option value="" disabled selected>Выберите модель</option>
	                </select>
	            </div>

	            <div class="form-group">
	                <label for="clientName">ФИО:</label>
	                <input type="text" id="clientName" name="name" placeholder="Иванов Иван" required />
	            </div>

	            <div class="form-group">
	                <label for="clientPhone">Телефон:</label>
	                <input type="tel" id="clientPhone" name="phone" placeholder="+7 (999) 123-45-67" required />
	            </div>

	            <div class="form-group">
	                <label for="clientEmail">Email:</label>
	                <input type="email" id="clientEmail" name="email" placeholder="example@mail.com" />
	            </div>

	            <button type="submit" class="form-link">Отправить заявку</button>
	        </form>
	    </div>
	</section>

</main>

<?php
include(ROOT . "templates/footer.tpl");
?>