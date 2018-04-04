<?php

include '../../../lib/connect.php';
$cusid = $_POST['cusid'];
$sql = 'SELECT * FROM t_customer WHERE Customer_ID = "' . $cusid . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$data = array(
    "id" => $result['Customer_ID'],
    "fname" => $result['Customer_Name'],
    "sname" => $result['Customer_Surname'],
    "tel" => $result['Customer_Tel'],
    "address" => $result['Customer_Address']
);
echo json_encode($data);
?>