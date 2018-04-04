<?php

include '../../../lib/connect.php';
$item_id = $_POST['item_id'];
$sql = 'SELECT * FROM t_repair_claim WHERE Item_ID = "' . $item_id . '" AND (Repair_Claim_Status = "1" OR Repair_Claim_Status = "2" OR Repair_Claim_Status = "3") ';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
if ($rows == 0) {
    echo 'ok';
} else {
    echo 'not';
}
?>