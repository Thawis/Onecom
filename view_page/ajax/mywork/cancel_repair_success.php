<?php

include '../../../lib/connect.php';
$item_id = $_POST['item_id'];
$cancel = "2";
$total = 0;
$sql = 'UPDATE t_repair_item SET Item_Status = ?, Repair_Total_Price = ? WHERE Item_ID = ? ';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1,$cancel);
$stmt->bindParam(2,$total);
$stmt->bindParam(3,$item_id);
try {
    $stmt->execute();
    $rows = $stmt->rowCount();
    if($rows > 0){
        echo 'ok';
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>