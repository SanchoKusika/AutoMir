<?php
require("config.php");
require("db.php");

include(ROOT . "templates/head.tpl");
include(ROOT . "templates/header.tpl");

$users = R::findAll('users');
$cars = R::findAll('cars');
$orders = R::findAll('orders');
?>

<main class="admin container">
	<h1>Админ-панель АвтоМир</h1>
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
</main>

<?php
include(ROOT . "templates/footer.tpl");
?>