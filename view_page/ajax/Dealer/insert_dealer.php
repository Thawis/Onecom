<?php

include '../../../lib/connect.php';
//$dealer_id = $_POST['dealer_id'];
//$dealer_name = $_POST['dealer_name'];
//$dealer_company = $_POST['dealer_company'];
//$dealer_gender = $_POST['dealer_gender'];
//$dealer_address = $_POST['dealer_address'];
$dealer_tel = $_POST['dealer_tel'];
$tel = str_replace("-", "", $dealer_tel);
$status = '1';
$name = str_replace(" ", "", $_POST['dealer_name']);
$surname = str_replace(" ", "", $_POST['dealer_surname']);
$fullname = $name . ' ' . $surname;
//$sql ='INSERT INTO t_dealer (Dealer_ID,Dealer_Company,Dealer_Address,Dealer_Name,Dealer_Gender,Dealer_Tel,Dealer_Status) VALUES (?,?,?,?,?,?,?)';
$sql = 'INSERT INTO t_dealer SET Dealer_ID = ?, Dealer_Company = ?, Dealer_Address = ?, Dealer_Name = ?, Dealer_Gender = ?, Dealer_Tel = ?, Dealer_Status = ?';
$stmt = $dbh->prepare($sql);

$stmt->bindParam(1, $_POST['dealer_id']);
$stmt->bindParam(2, $_POST['dealer_company']);
$stmt->bindParam(3, $_POST['dealer_address']);
$stmt->bindParam(4, $fullname);
$stmt->bindParam(5, $_POST['dealer_gender']);
$stmt->bindParam(6, $tel);
$stmt->bindParam(7, $status);

try {
    $stmt->execute();
    echo 'เพิ่มข้อมูลเรียบร้อย';
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>