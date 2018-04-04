<?php

include '../../../lib/connect.php';
$c_id = $_POST['etc_c_id'];
$pname = $_POST['etc_name_old'];
$sn = $_POST['etc_sn_old'];
$detail = $_POST['etc_detail'];

$status_c = "3";
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");

$sql_update_sell = 'UPDATE t_sell_detail SET Unit_Status = ? WHERE P_Name = ? AND S_ID = ? ';
$stmt_update_sell = $dbh->prepare($sql_update_sell);
$stmt_update_sell->bindParam(1, $status_c);
$stmt_update_sell->bindParam(2, $pname);
$stmt_update_sell->bindParam(3, $sn);
$stmt_update_sell->execute();
$rows2 = $stmt_update_sell->rowCount();
if ($rows2 >= 0) {
    $sql_update_claim = 'UPDATE t_claim SET Claim_Date_D_Return = ?, Claim_Status = ? WHERE ClaimItem_ID = ? ';
    $stmt_c = $dbh->prepare($sql_update_claim);
    $stmt_c->bindParam(1, $today);
    $stmt_c->bindParam(2, $status_c);
    $stmt_c->bindParam(3, $c_id);
    $stmt_c->execute();
    $rows3 = $stmt_c->rowCount();
    if ($rows3 > 0) {
        $sql_di = 'INSERT INTO t_claim_detail SET ClaimItem_ID = ?, Claim_Detail = ?';
        $stmt_id = $dbh->prepare($sql_di);
        $stmt_id->bindParam(1, $c_id);
        $stmt_id->bindParam(2, $detail);
        $stmt_id->execute();
        $rows4 = $stmt_id->rowCount();
        if ($rows4 > 0) {
            echo 'ok';
        }
    }
}
?>