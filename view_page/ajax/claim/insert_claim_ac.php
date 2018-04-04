<?php

session_start();
include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");
$today2 = $dt->format("ym");
$sql_id = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_claim"';
$stmt_id = $dbh->prepare($sql_id);
$stmt_id->execute();
$result_id = $stmt_id->fetch();
$num = $result_id['AUTO_INCREMENT'];

$c_id = '';
if ($num < 10) {
    $c_id = 'CLM' . $today2 . '-NO-0000' . $num;
} else if ($num < 100) {
    $c_id = 'CLM' . $today2 . '-NO-000' . $num;
} else if ($num < 1000) {
    $c_id = 'CLM' . $today2 . '-NO-00' . $num;
} else if ($num < 10000) {
    $c_id = 'CLM' . $today2 . '-NO-0' . $num;
} else {
    $c_id = 'CLM' . $today2 . '-NO-' . $num;
}
$_SESSION['Claim_ID'] = $c_id;
$cus_name = $_POST['ac_cusname'];
$cus_tel = str_replace("-", "", $_POST['ac_custel']);
$pname = $_POST['ac_pname'];
$sn = $_POST['ac_sn'];
$manner = $_POST['ac_manner'];
$ord = $_POST['ac_ord_id'];
$uid = $_POST['ac_unit_id'];
$c_type = "forcus";
$c_status = "1";
$sql_insert_c = 'INSERT INTO t_claim SET ClaimItem_ID = ?, Cus_Name = ?, Cus_Tel = ?, ClaimItem_Name = ?, S_ID = ?, Claim_Date_Add = ?, Claim_Status = ?, '
        . 'Claim_Type = ?, Claim_Manner = ? ';

$stmt_insert_c = $dbh->prepare($sql_insert_c);
$stmt_insert_c->bindParam(1, $c_id);
$stmt_insert_c->bindParam(2, $cus_name);
$stmt_insert_c->bindParam(3, $cus_tel);
$stmt_insert_c->bindParam(4, $pname);
$stmt_insert_c->bindParam(5, $sn);
$stmt_insert_c->bindParam(6, $today);
$stmt_insert_c->bindParam(7, $c_status);
$stmt_insert_c->bindParam(8, $c_type);
$stmt_insert_c->bindParam(9, $manner);
try {
    $stmt_insert_c->execute();
    $rows_c = $stmt_insert_c->rowCount();
    if ($rows_c > 0) {
        //echo 'ok';
        $sql_temp = 'INSERT INTO temp_claim SET Claim_ID = ?, ORD_ID = ?, Unit_ID = ?';
        $stmt_temp = $dbh->prepare($sql_temp);
        $stmt_temp->bindParam(1, $c_id);
        $stmt_temp->bindParam(2, $ord);
        $stmt_temp->bindParam(3, $uid);
        $stmt_temp->execute();
        $rows_temp = $stmt_temp->rowCount();
        if ($rows_temp > 0) {
            echo 'ok';
        }
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>