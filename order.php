<?php
require("config.php");
require("db.php");

$carId = isset($_POST['car_id']) ? intval($_POST['car_id']) : 0;
$name = trim($_POST['name']);
$phone = trim($_POST['phone']);
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

if (!$carId || !$name || !$phone) {
    die("Заполните обязательные поля.");
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
    die("Машина недоступна или закончилась.");
}

$order = R::dispense('orders');
$order->user_id = $user->id;
$order->car_id = $car->id;
R::store($order);

$car->quantity = $car->quantity - 1;
R::store($car);

header("Location: index.php?order=success");
exit();
?>