<?php

include '../../../lib/connect.php';
$serid = $_POST['serid'];
$sql = 'SELECT * FROM t_service_menu WHERE Service_ID = "' . $serid . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$data = array(
    "id" => $result['Service_ID'],
    "name" => $result['Service_Menu'],
    "price" => $result['Service_Price'],
    "type" => $result['Service_Type']
);
echo json_encode($data);
?>