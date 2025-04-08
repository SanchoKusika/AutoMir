<?php
require("config.php");
require("db.php");

include(ROOT . "templates/head.tpl");
include(ROOT . "templates/header.tpl");

$users = R::findAll('users');
$cars = R::findAll('cars');
$orders = R::findAll('orders');

$statusMessage = '';
if (isset($_GET['status'])) {
	switch ($_GET['status']) {
		case 'add':
			$statusMessage = 'Машина успешно добавлена.';
			break;
		case 'edit':
			$statusMessage = 'Машина успешно обновлена.';
			break;
		case 'delete':
			$statusMessage = 'Машина удалена.';
			break;
	}
}
?>

<main class="admin container">
	<h1>Админ-панель АвтоМир</h1>

	<?php if ($statusMessage): ?>
		<div class="notify"><?= $statusMessage ?></div>
	<?php endif; ?>

	<div class="admin-panel">
		<aside class="sidebar">
			<button class="tab-button active" data-tab="tables">Таблицы</button>
			<button class="tab-button" data-tab="manage">Управление машинами</button>
		</aside>

		<section class="content-area">
			<div class="tab-content active" id="tables">
				<div class="table-content">
					<h2>Машины</h2>
					<table>
						<tr>
							<th>ID</th>
							<th>Марка</th>
							<th>Модель</th>
							<th>Год</th>
							<th>Цена</th>
							<th>Остаток</th>
						</tr>
						<?php foreach ($cars as $car): ?>
						<tr>
							<td><?= $car->id ?></td>
							<td><?= $car->brand ?></td>
							<td><?= $car->model ?></td>
							<td><?= $car->year ?></td>
							<td>$<?= number_format($car->price, 2, '.', ',') ?></td>
							<td><?= $car->quantity ?></td>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>

				<div class="table-content">
					<h2>Клиенты</h2>
					<table>
						<tr>
							<th>ID</th>
							<th>Имя</th>
							<th>Телефон</th>
							<th>Email</th>
						</tr>
						<?php foreach ($users as $user): ?>
						<tr>
							<td><?= $user->id ?></td>
							<td><?= $user->name ?></td>
							<td><?= $user->phone ?></td>
							<td><?= $user->email ?></td>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>

				<div class="table-content">
					<h2>Заказы</h2>
					<table>
						<tr>
							<th>ID заказа</th>
							<th>ID клиента</th>
							<th>ID машины</th>
							<th>Дата заказа</th>
						</tr>
						<?php foreach ($orders as $order): ?>
						<tr>
							<td><?= $order->id ?></td>
							<td><?= $order->user_id ?></td>
							<td><?= $order->car_id ?></td>
							<td><?= $order->created_at ?></td>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>

			<div class="tab-content" id="manage">
				<h2>Управление машинами</h2>

				<section class="manage-section">
					<h3>Добавить машину</h3>
					<form method="post" action="car_manage.php?action=add" enctype="multipart/form-data">
						<div class="form-row">
							<input type="text" name="brand" placeholder="Марка" required>
							<input type="text" name="model" placeholder="Модель" required>
						</div>
						<div class="form-row">
							<input type="number" name="year" placeholder="Год" required>
							<input type="number" step="0.01" name="price" placeholder="Цена" required>
						</div>
						<div class="form-row">
							<input type="number" name="quantity" placeholder="Количество" required>
						</div>
						<div class="form-row">
							<label>Выберите фото:</label>
							<input type="file" name="dummy_image" accept="image/*" required>
						</div>
						<button type="submit">Добавить машину</button>
					</form>
				</section>

				<hr>

				<section class="manage-section">
					<h3>Редактировать машину</h3>
					<form method="post" action="car_manage.php?action=edit" enctype="multipart/form-data">
						<div class="form-row">
							<label>Выберите машину:</label>
							<select name="car_id" required>
								<option value="" disabled selected>Выберите машину</option>
								<?php foreach ($cars as $car): ?>
									<option value="<?= $car->id ?>"><?= $car->brand . " " . $car->model ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-row">
							<input type="text" name="brand" placeholder="Новая марка">
							<input type="text" name="model" placeholder="Новая модель">
						</div>
						<div class="form-row">
							<input type="number" name="year" placeholder="Новый год">
							<input type="number" step="0.01" name="price" placeholder="Новая цена">
						</div>
						<div class="form-row">
							<input type="number" name="quantity" placeholder="Новое количество">
						</div>
						<div class="form-row">
							<label>Новое фото (если нужно):</label>
							<input type="file" name="image" accept="image/*">
						</div>
						<button type="submit">Обновить данные</button>
					</form>
				</section>

				<hr>


				<section class="manage-section">
					<h3>Удалить машину</h3>
					<form method="post" action="car_manage.php?action=delete">
						<div class="form-row">
							<label>Выберите машину для удаления:</label>
							<select name="car_id" required>
								<option value="" disabled selected>Выберите машину</option>
								<?php foreach ($cars as $car): ?>
									<option value="<?= $car->id ?>"><?= $car->brand . " " . $car->model ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<button type="submit" onclick="return confirm('Вы уверены, что хотите удалить эту машину?');">Удалить машину</button>
					</form>
				</section>
			</div>
		</section>
	</div>
</main>

<?php
include(ROOT . "templates/footer.tpl");
?>