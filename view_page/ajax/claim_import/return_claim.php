<?php

include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d H:i:s");
$today2 = $dt->format("Y-m-d");
$cid = $_POST['cid'];
$s_status = "4";

$sql = 'UPDATE t_claim SET Claim_Status = ?, Claim_Date_C_Return = ? WHERE ClaimItem_ID = ? ';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $s_status);
$stmt->bindParam(2, $today2);
$stmt->bindParam(3, $cid);
try {
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows > 0) {
        $sql_i = 'INSERT INTO t_return_item SET Ref_ID_Return = ?, ReturnItem_Time = ? ';
        $stmt_i = $dbh->prepare($sql_i);
        $stmt_i->bindParam(1, $cid);
        $stmt_i->bindParam(2, $today);
        $stmt_i->execute();
        $rows_i = $stmt_i->rowCount();
        if ($rows_i > 0) {
            echo 'ok';
        }
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>