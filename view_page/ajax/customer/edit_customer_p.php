<?php

include '../../../lib/connect.php';
$cid = $_POST['cus_id'];
$cname = str_replace(" ", "", $_POST['cus_name']);
$csname = str_replace(" ", "", $_POST['cus_surname']);
$tel = str_replace("-", "", $_POST['cus_tel']);
$address = $_POST['cus_address'];
$fullname = $cname . " " . $csname;

$sql_chk = 'SELECT * FROM t_customer WHERE Customer_ID = "' . $cid . '" AND Customer_FullName = "' . $fullname . '" ';
$stmt_chk = $dbh->prepare($sql_chk);
$stmt_chk->execute();
$rows_chk = $stmt_chk->rowCount();
if ($rows_chk >= 1) {
    $sql = 'UPDATE t_customer SET Customer_Name = ?, Customer_Surname = ?, Customer_FullName = ?, Customer_Address = ?, Customer_Tel = ? '
            . 'WHERE Customer_ID = ? ';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $cname);
    $stmt->bindParam(2, $csname);
    $stmt->bindParam(3, $fullname);
    $stmt->bindParam(4, $address);
    $stmt->bindParam(5, $tel);
    $stmt->bindParam(6, $cid);
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows > 0) {
        echo 'แก้ไขข้อมูลลูกค้าเรียบร้อย';
    } else {
        echo 'แก้ไขข้อมูลลูกค้าเรียบร้อย';
    }
} else {
    $sql_chk1 = 'SELECT * FROM t_customer WHERE Customer_FullName = "' . $fullname . '"';
    $stmt_chk1 = $dbh->prepare($sql_chk1);
    $stmt_chk1->execute();
    $rows_chk1 = $stmt_chk1->rowCount();
    if ($rows_chk1 == 0) {
        $sql = 'UPDATE t_customer SET Customer_Name = ?, Customer_Surname = ?, Customer_FullName = ?, Customer_Address = ?, Customer_Tel = ? '
                . 'WHERE Customer_ID = ? ';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $cname);
        $stmt->bindParam(2, $csname);
        $stmt->bindParam(3, $fullname);
        $stmt->bindParam(4, $address);
        $stmt->bindParam(5, $tel);
        $stmt->bindParam(6, $cid);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if ($rows > 0) {
            echo 'แก้ไขข้อมูลลูกค้าเรียบร้อย';
        } else {
            echo 'ไม่สามารถแก้ข้อมูลลูกค้าได้';
        }
    } else {
        echo 'ไม่สามารถแก้ข้อมูลลูกค้าได้';
    }
}
?>