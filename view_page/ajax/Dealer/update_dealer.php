<?php

include '../../../lib/connect.php';
$tel = $_POST['edit_dealer_tel'];
$tel2 = str_replace("-", "", $tel);
$name = str_replace(" ", "", $_POST['edit_dealer_name']);
$surname = str_replace(" ", "", $_POST['edit_dealer_surname']);
$fullname = $name . ' ' . $surname;

$sql = 'UPDATE t_dealer SET Dealer_Company = ?, Dealer_Address = ?, Dealer_Name = ?, Dealer_Gender = ?, Dealer_Tel = ? WHERE Dealer_ID = ? ';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $_POST['edit_dealer_company']);
$stmt->bindParam(2, $_POST['edit_dealer_address']);
$stmt->bindParam(3, $fullname);
$stmt->bindParam(4, $_POST['edit_dealer_gender']);
$stmt->bindParam(5, $tel2);
$stmt->bindParam(6, $_POST['edit_dealer_id']);

try {
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows > 0) {
        echo 'ok';
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>