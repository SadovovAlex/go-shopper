<?php 

header('Access-Control-Allow-Origin: *'); 



$conn =  new mysqli("localhost", "cp633620_fe", "9R+{a@]z$0uQ", "cp633620_go_shoping");
$conn->query("SET NAMES 'utf8'"); 
$conn->query("SET CHARACTER SET 'utf8'");
$conn->query("SET SESSION collation_connection = 'utf8_general_ci'");


if ($conn->connect_error) {
	die("Database connection established Failed..");
} 

$res = array('error' => false);
$action = 'read';



if (isset($_GET['action'])) {
	$action = $_GET['action'];
}


if ($action == 'read') {
	$result = $conn->query("
	SELECT items_name, items_pcs, unit, items_barcode, shop_name, max(itemprice_dt) as itemprice_dt, max(itemprice_price) as max_itemprice_price, min(itemprice_price) as min_itemprice_price, TRUNCATE(AVG(itemprice_price)/items_pcs,2) as pcs_price    
		FROM (
		SELECT i.*, p.*
		,(SELECT `unit_name` FROM `sh_unit` u WHERE u.unit_id = i.unit_id) as unit
		,(SELECT `shop_name` FROM `sh_shop` s WHERE s.shop_id = p.shop_id) as shop_name
		FROM `sh_items` i 
		LEFT JOIN (SELECT * from `sh_itemprice`) p ON i.items_id = p.item_id
		) z
		GROUP BY items_name, items_pcs, unit, items_barcode, shop_name
	");
	$items = array();

	while ($row = $result->fetch_assoc()){
		array_push($items, $row);		
	}
	//$result->num_rows;
	$res['items'] = $items;
}

if ($action == 'create') {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$result = $conn->query("INSERT INTO `users` (`username`, `email`, `mobile`) VALUES ('$username', '$email', '$mobile') ");

	if ($result) {
		$res['message'] = "User Added successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "Insert User fail";
	}
}

if ($action == 'update') {
	$id = $_POST['id'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];

	$result = $conn->query("UPDATE `users` SET `username` = '$username', `email` = '$email', `mobile` = '$mobile'WHERE `id` = '$id'");

	if ($result) {
		$res['message'] = "User Updated successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "User Update failed";
	}
}

if ($action == 'delete') {
	$id = $_POST['id'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];

	$result = $conn->query("DELETE FROM `users` WHERE `id` = '$id'");
	if ($result) {
		$res['message'] = "User deleted successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "User delete failed";
	}
}

$conn -> close();
header("Content-type: application/json");
echo json_encode($res, JSON_UNESCAPED_UNICODE);
die();
 ?>