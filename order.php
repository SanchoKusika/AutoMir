<?php
require("config.php");
require("db.php");

header('Content-Type: application/json');

$carId = isset($_POST['car_id']) ? intval($_POST['car_id']) : 0;
$name = trim($_POST['name']);
$phone = trim($_POST['phone']);
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

if (!$carId || !$name || !$phone) {
	echo json_encode(['success' => false, 'message' => 'Заполните обязательные поля.']);
	exit;
}

$user = R::findOne('users', 'phone = ?', [$phone]);
if (!$user) {
	$user = R::dispense('users');
	$user->name = $name;
	$user->phone = $phone;
	$user->email = $email;
	R::store($user);
}

$car = R::load('cars', $carId);
if (!$car->id || $car->quantity <= 0) {
	echo json_encode(['success' => false, 'message' => 'Машина недоступна или закончилась.']);
	exit;
}

$order = R::dispense('orders');
$order->user_id = $user->id;
$order->car_id = $car->id;
R::store($order);

$car->quantity = $car->quantity - 1;
R::store($car);

echo json_encode(['success' => true, 'message' => 'Заявка успешно отправлена!']);
exit;