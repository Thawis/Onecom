<?php

include '../../../lib/connect.php';
$c_id = $_POST['claim_id'];
$detail = $_POST['claim_detail'];
$status = "3";
$sql = "UPDATE t_repair_claim SET Item_Detail = ?, Repair_Claim_Status = ? WHERE Repair_Claim_ID = ? ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $detail);
$stmt->bindParam(2, $status);
$stmt->bindParam(3, $c_id);
try {
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows > 0) {
        echo 'ok';
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>