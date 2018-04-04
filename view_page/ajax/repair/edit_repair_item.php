<?php

include '../../../lib/connect.php';
$item_id = $_POST['fedit_itemid'];
$item_name = $_POST['fedit_name'];
$item_sn = $_POST['fedit_sn'];
$item_manner = $_POST['fedit_manner'];

$sql = "UPDATE t_repair_item SET  Item_Name = ?, Item_SN = ?, Item_manner = ? WHERE Item_ID = ?";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $item_name);
$stmt->bindParam(2, $item_sn);
$stmt->bindParam(3, $item_manner);
$stmt->bindParam(4, $item_id);
try {
    $stmt->execute();
    echo "ok";
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>