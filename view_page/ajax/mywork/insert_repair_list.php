<?php

include '../../../lib/connect.php';
$item_id = $_POST['item_id'];
$type = $_POST['type'];
$name = $_POST['name'];
$price = $_POST['price'];
$detail = $_POST['detail'];
$war = $_POST['war'];

$sql = "INSERT INTO t_repair_case SET Item_ID = ?, Service_Menu = ?, Service_Price = ?, Service_Detail = ?, "
        . "Repair_Type = ?, Repair_Warranty = ? ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1,$item_id);
$stmt->bindParam(2,$name);
$stmt->bindParam(3,$price);
$stmt->bindParam(4,$detail);
$stmt->bindParam(5,$type);
$stmt->bindParam(6,$war);
try {
    $stmt->execute();
    echo 'ok';
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>