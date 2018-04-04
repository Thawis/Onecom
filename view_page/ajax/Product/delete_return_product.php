<?php

include '../../../lib/connect.php';
//$pid = $_POST['P_ID'];

$cancel = "0";
$pid = $_POST['P_ID'];
$action = $_POST['action'];

if ($action == "cancel") {
    $sql = "UPDATE t_product SET P_Status = ? WHERE P_ID = ? ";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $cancel);
    $stmt->bindParam(2, $pid);

    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows > 0) {
        echo 'ยกเลิกรายการสินค้ารหัส ' . $pid . ' เรียบร้อย';
    }
}else if($action == "remove"){
    $sql = 'DELETE FROM t_product WHERE P_ID = "' . $pid . '"';
    $stmt = $dbh->prepare($sql);
    try {
        $stmt->execute();
        echo 'ลบข้อมูล ' . $pid . ' ออกจากระบบเรียบร้อย';
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
?>