<?php

include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d H:i:s");
$end = '4';
$c_id = $_POST['c_id'];

$sql_u = "UPDATE t_repair_claim SET Repair_Claim_Status = ?, Date_S = ?  WHERE Repair_Claim_ID = ? ";
$stmt_u = $dbh->prepare($sql_u);
$stmt_u->bindParam(1, $end);
$stmt_u->bindParam(2, $today);
$stmt_u->bindParam(3, $c_id);
try {
    $stmt_u->execute();
    $rows_u = $stmt_u->rowCount();
    if ($rows_u > 0) {
        $sql_i = 'INSERT INTO t_return_item SET Ref_ID_Return = ?, ReturnItem_Time = ? ';
        $stmt_i = $dbh->prepare($sql_i);
        $stmt_i->bindParam(1, $c_id);
        $stmt_i->bindParam(2, $today);
        try {
            $stmt_i->execute();
            $rows_i = $stmt_i->rowCount();
            if ($rows_i > 0) {
                echo 'ok';
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>