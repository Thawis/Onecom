<?php

include '../../../lib/connect.php';
$cid = $_POST['ccus_id'];
$cname = $_POST['ccus_name'];
$tel = str_replace("-", "", $_POST['ccus_tel']);
$address = $_POST['ccus_address'];

$sql_chk = 'SELECT * FROM t_customer WHERE Customer_ID = "' . $cid . '" AND Customer_FullName = "' . $cname . '" ';
$stmt_chk = $dbh->prepare($sql_chk);
$stmt_chk->execute();
$rows_chk = $stmt_chk->rowCount();
if ($rows_chk >= 1) {
    $sql = 'UPDATE t_customer SET Customer_Name = ?, Customer_FullName = ?, Customer_Address = ?, Customer_Tel = ? '
            . 'WHERE Customer_ID = ? ';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $cname);
    $stmt->bindParam(2, $cname);
    $stmt->bindParam(3, $address);
    $stmt->bindParam(4, $tel);
    $stmt->bindParam(5, $cid);
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows > 0) {
        echo 'แก้ไขข้อมูลลูกค้าเรียบร้อย';
    } else {
        echo 'แก้ไขข้อมูลลูกค้าเรียบร้อย';
    }
} else {
    $sql_chk1 = 'SELECT * FROM t_customer WHERE Customer_FullName = "' . $cname . '"';
    $stmt_chk1 = $dbh->prepare($sql_chk1);
    $stmt_chk1->execute();
    $rows_chk1 = $stmt_chk1->rowCount();
    if ($rows_chk1 == 0) {
        $sql = 'UPDATE t_customer SET Customer_Name = ?, Customer_FullName = ?, Customer_Address = ?, Customer_Tel = ? '
                . 'WHERE Customer_ID = ? ';
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $cname);
        $stmt->bindParam(2, $cname);
        $stmt->bindParam(3, $address);
        $stmt->bindParam(4, $tel);
        $stmt->bindParam(5, $cid);
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