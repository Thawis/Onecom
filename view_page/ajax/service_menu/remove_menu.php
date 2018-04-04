<?php

include '../../../lib/connect.php';
$sql = 'DELETE FROM t_service_menu WHERE Service_ID = "' . $_POST['serid'] . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
if ($rows >= 1) {
    echo 'ลบรายการบริการเรียบร้อย';
}else{
    echo 'ไม่สามารถลบรายการบริการนี้ได้';
}
?>