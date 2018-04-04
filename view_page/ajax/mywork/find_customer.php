<?php

include '../../../lib/connect.php';
$item_id = $_POST['item_id'];
$sql = 'SELECT Customer_ID FROM t_repair_item JOIN t_repair ON t_repair_item.R_ID = t_repair.R_ID WHERE t_repair_item.Item_ID = "' . $item_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
echo $result['Customer_ID'];

?>