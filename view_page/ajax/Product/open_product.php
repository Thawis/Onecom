<?php
include '../../../lib/connect.php';
$open = "1";
$pid = $_POST['P_ID'];
$sql = "UPDATE t_product SET P_Status = ? WHERE P_ID = ? ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $open);
$stmt->bindParam(2, $pid);

    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows > 0) {
        echo 'เปิดใช้งานรายการสินค้ารหัส '.$pid.' เรียบร้อย';
    }
?>