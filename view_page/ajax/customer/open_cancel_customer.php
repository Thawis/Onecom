<?php

include '../../../lib/connect.php';
$s = $_POST['state'];
$cusid = $_POST['cusid'];
$cancel = "0";
$open = "1";
if ($s == "cancel") {
    $sql = 'UPDATE t_customer SET Customer_Status = ? WHERE Customer_ID = ? ';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $cancel);
    $stmt->bindParam(2, $cusid);
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows > 0) {
        echo 'ยกเลิกข้อมูลลูกค้าเรียบร้อย';
    } else if ($rows == 0) {
        echo 'ไม่สามารถยกเลิกข้อมูลลูกค้าได้';
    }
} else if ($s == "open") {
    $sql = 'UPDATE t_customer SET Customer_Status = ? WHERE Customer_ID = ? ';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $open);
    $stmt->bindParam(2, $cusid);
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows > 0) {
        echo 'เปิดใช้งานข้อมูลลูกค้าเรียบร้อย';
    } else if ($rows == 0) {
        echo 'ไม่สามารถเปิดใช้งานข้อมูลลูกค้าได้';
    }
}
?>