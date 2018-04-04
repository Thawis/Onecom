<?php

include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");

$dealer = $_POST['ddl_dealer'];
$c_id = $_POST['send_cid'];
$status = "2";

$sql = 'UPDATE t_claim SET Dealer_ID = ?, Claim_Date_Send = ?, Claim_Status = ? WHERE ClaimItem_ID = ? ';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $dealer);
$stmt->bindParam(2, $today);
$stmt->bindParam(3, $status);
$stmt->bindParam(4, $c_id);
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