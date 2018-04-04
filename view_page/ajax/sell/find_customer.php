<?php

include '../../../lib/connect.php';
//$name = $_POST['cus_name'];
//$surname = $_POST['cus_surname'];
$typec = $_POST['typec'];
$sql = '';
if ($typec == 'cuscompany') {
    $name = $_POST['cus_name'];
    $sql = 'SELECT * FROM t_customer WHERE Customer_Name = "' . $name . '" AND Customer_Surname = "company" AND Customer_Status = "1"';
} else if ($typec == 'cusname') {
    $name = str_replace(" ", "", $_POST['cus_name']);
    $surname = str_replace(" ", "", $_POST['cus_surname']);
    $sql = 'SELECT * FROM t_customer WHERE Customer_Name = "' . $name . '" AND Customer_Surname = "' . $surname . '" AND Customer_Status = "1"';
}
$stmt = $dbh->prepare($sql);
try {
    $stmt->execute();
} catch (Exception $ex) {
    echo $ex->getMessage();
}
$rows = $stmt->rowCount();
$result = $stmt->fetch();
$cus_id = "";
if ($rows == 0) {
    $sql2 = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_customer"';
    $stmt2 = $dbh->prepare($sql2);
    $stmt2->execute();
    $result2 = $stmt2->fetch();
    if ($result2['AUTO_INCREMENT'] > 9) {
        $cus_id = "cus_" . $result2['AUTO_INCREMENT'];
    } else {
        $cus_id = "cus_0" . $result2['AUTO_INCREMENT'];
    }
    $data = array(
        "rows" => $rows,
        "cus_id" => $cus_id,
    );
} else {
    $data = array(
        "rows" => $rows,
        "cus_id" => $result['Customer_ID'],
        "cus_name" => $result['Customer_Name'],
        "cus_surname" => $result['Customer_Surname'],
        "cus_address" => $result['Customer_Address'],
        "cus_tel" => $result['Customer_Tel'],
    );
}


echo json_encode($data);
?>