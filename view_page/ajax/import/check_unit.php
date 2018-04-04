<?php

include '../../../lib/connect.php';
$imp_id = $_POST['import_id'];
$sql = 'SELECT * FROM t_product_unit WHERE Import_ID = "' . $imp_id . '" AND PU_Status = "2"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
echo $rows;
?>