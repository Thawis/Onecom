<?php

include '../../../lib/connect.php';
$rid = $_POST['rid'];
$sql = 'select tri.R_ID,tri.Item_ID,Customer_FullName,trc.Repair_EndWar from t_repair tr '
        . 'JOIN t_repair_item tri ON tr.R_ID = tri.R_ID '
        . 'JOIN t_repair_case trc ON tri.Item_ID = trc.Item_ID '
        . 'JOIN t_customer tc ON tc.Customer_ID = tr.Customer_ID '
        . 'WHERE Item_Status = "4" AND (DATE(Repair_EndWar) > DATE(NOW())) AND (tri.Item_ID = "' . $rid . '" OR tri.R_ID = "' . $rid . '")';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
echo $rows;
?>