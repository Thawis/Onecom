<?php

include '../../../lib/connect.php';
$state = $_POST['state'];
$sid = $_POST['sid'];
$open = "1";
$cancel = "0";
if ($state == "open") {
    $sql = 'UPDATE t_service_menu SET Service_Status = ? WHERE Service_ID = ? ';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $open);
    $stmt->bindParam(2, $sid);
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows > 0) {
        echo 'เปิดการใช้งานบริการนี้เรียบร้อย';
    } else {
        echo 'ไม่สามารถเปิดการใช้งานบริการนี้ได้';
    }
} else if ($state == "cancel") {
    $sql = 'UPDATE t_service_menu SET Service_Status = ? WHERE Service_ID = ? ';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $cancel);
    $stmt->bindParam(2, $sid);
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows > 0) {
        echo 'เปิดการใช้งานบริการนี้เรียบร้อย';
    } else {
        echo 'ไม่สามารถเปิดการใช้งานบริการนี้ได้';
    }
}
?>