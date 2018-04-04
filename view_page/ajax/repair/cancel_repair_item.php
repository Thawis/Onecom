<?php

include '../../../lib/connect.php';
$emp_id = "";
$cancel = "";
$item_id = $_POST['item_id'];
$status = "0";
$sql = "UPDATE t_repair_item SET Emp_ID = ?, Item_Status = ? WHERE Item_ID = ?";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $emp_id);
$stmt->bindParam(2, $status);
//$stmt->bindParam(3,$cancel);
$stmt->bindParam(3, $item_id);
try {
    $stmt->execute();
    echo "ok";
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>