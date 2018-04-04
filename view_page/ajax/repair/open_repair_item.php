<?php

include '../../../lib/connect.php';
$item_id = $_POST['item_id'];
$status = "1";
$sql = "UPDATE t_repair_item SET Item_Status = ? WHERE Item_ID = ?";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $status);
$stmt->bindParam(2, $item_id);
try {
    $stmt->execute();
    echo "ok";
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>