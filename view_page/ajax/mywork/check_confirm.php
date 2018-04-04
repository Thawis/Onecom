<?php

include '../../../lib/connect.php';
$item_id = $_POST['item_id'];
$sql = 'SELECT * FROM t_repair_case WHERE Item_ID = "' . $item_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
echo $rows;
?>