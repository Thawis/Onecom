<?php

include '../../../lib/connect.php';
$typec = $_POST['typecus'];
if ($typec == 'cuscompany') {
    $sql = "INSERT INTO t_customer SET Customer_ID = ?, Customer_Name = ?, Customer_Surname = ?, Customer_FullName = ?, Customer_Address = ?, Customer_Tel = ?, Customer_Status = ? ";
    $status = "1";
    $tel = str_replace("-", "", $_POST['cus_tel']);
    //$fullname = $_POST['cus_name'] . ' ' . $_POST['cus_surname'];
    $surname = "company";
    $fullname = $_POST['cus_name'];
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $_POST['cus_id']);
    $stmt->bindParam(2, $_POST['cus_name']);
    $stmt->bindParam(3, $surname);
    $stmt->bindParam(4, $fullname);
    $stmt->bindParam(5, $_POST['cus_address']);
    $stmt->bindParam(6, $tel);
    $stmt->bindParam(7, $status);
    try {
        $stmt->execute();
        echo 'เพิ่มข้อมูลลูกค้าเรียบร้อย';
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
} else {
    $sql = "INSERT INTO t_customer SET Customer_ID = ?, Customer_Name = ?, Customer_Surname = ?, Customer_FullName = ?, Customer_Address = ?, Customer_Tel = ?, Customer_Status = ? ";
    $status = "1";
    $tel = str_replace("-", "", $_POST['cus_tel']);
    $fullname = $_POST['cus_name'] . ' ' . $_POST['cus_surname'];
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $_POST['cus_id']);
    $stmt->bindParam(2, $_POST['cus_name']);
    $stmt->bindParam(3, $_POST['cus_surname']);
    $stmt->bindParam(4, $fullname);
    $stmt->bindParam(5, $_POST['cus_address']);
    $stmt->bindParam(6, $tel);
    $stmt->bindParam(7, $status);
    try {
        $stmt->execute();
        echo 'เพิ่มข้อมูลลูกค้าเรียบร้อย';
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
?>