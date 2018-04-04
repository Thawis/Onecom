<?php

include '../../../lib/connect.php';
$item_id = $_POST['item_id'];
$sql = 'SELECT SUM(Service_Price) FROM t_repair_case WHERE Item_ID = "' . $item_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$total = $result['SUM(Service_Price)'];
$status = "3";
$sql_update_repair = "UPDATE t_repair_item SET Repair_Total_Price = ?, Item_Status = ? WHERE Item_ID = ? ";
$stmt_update = $dbh->prepare($sql_update_repair);
$stmt_update->bindParam(1,$total);
$stmt_update->bindParam(2,$status);
$stmt_update->bindParam(3,$item_id);
try {
    $stmt_update->execute();
    $rows = $stmt_update->rowCount();
    if($rows > 0){
        echo 'ok';
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>