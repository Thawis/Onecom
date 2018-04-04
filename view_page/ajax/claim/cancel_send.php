<?php

include '../../../lib/connect.php';
$cid = $_POST['c_id'];
$status = "1";
$date_cancel = "";
$sql = 'UPDATE t_claim SET Claim_Date_Send = ?, Claim_Status = ? WHERE ClaimItem_ID = ? ';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $cid);
$stmt->bindParam(2, $status);
$stmt->bindParam(3, $cid);
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