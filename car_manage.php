<?php
require("config.php");
require("db.php");

$action = isset($_GET['action']) ? $_GET['action'] : '';

if(isset($_GET['action']) && $_GET['action'] == 'add'){
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$car = R::dispense('cars');
		$brand = trim($_POST['brand']);
		$model = trim($_POST['model']);
		$car->brand = $brand;
		$car->model = $model;
		$car->year = $_POST['year'];
		$car->price = $_POST['price'];
		$car->quantity = $_POST['quantity'];

		if(isset($_FILES['dummy_image']) && $_FILES['dummy_image']['error'] == 0) {
			$uploadDir = 'assets/img/cars/';
			$extension = pathinfo($_FILES['dummy_image']['name'], PATHINFO_EXTENSION);
			$newName = strtolower($brand) . '_' . strtolower($model) . '.' . $extension;
			$targetFile = $uploadDir . $newName;
			if(move_uploaded_file($_FILES['dummy_image']['tmp_name'], $targetFile)) {
			} else {}
		}

		R::store($car);
		header("Location: admin.php?status=add");
		exit();
	}
} elseif ($action == 'edit') {
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$id = intval($_POST['car_id']);
		$car = R::load('cars', $id);
		if ($car->id) {
			if (!empty($_POST['brand'])) $car->brand = $_POST['brand'];
			if (!empty($_POST['model'])) $car->model = $_POST['model'];
			if (!empty($_POST['year'])) $car->year = $_POST['year'];
			if (!empty($_POST['price'])) $car->price = $_POST['price'];
			if (!empty($_POST['quantity'])) $car->quantity = $_POST['quantity'];

			if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
				$uploadDir = 'assets/img/cars/';
				$filename = time() . '_' . basename($_FILES['image']['name']);
				$targetFile = $uploadDir . $filename;
				if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
					$car->image = $targetFile;
				}
		}

			R::store($car);
			header("Location: admin.php?status=edit");
			exit();
		}
	}
} elseif ($action == 'delete') {
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$id = intval($_POST['car_id']);
	} else {
		$id = isset($_GET['car_id']) ? intval($_GET['car_id']) : 0;
	}
	$car = R::load('cars', $id);
	if ($car->id) {
		R::trash($car);
	}
	header("Location: admin.php?status=delete");
	exit();
} else {
	header("Location: admin.php");
	exit();
}
?>