<?php

session_start();
$emp_id = $_SESSION['login_id'];
include '../../../lib/connect.php';
$item_id = $_POST['item_id'];
//$manner = $_POST['item_manner'];
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d H:i:s");
$today2 = $dt->format("ym");

$sql_id = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_repair_claim"';
$stmt_id = $dbh->prepare($sql_id);
$stmt_id->execute();
$result_id = $stmt_id->fetch();
$num = $result_id['AUTO_INCREMENT'];
$cr_id = '';
//if ($num < 10) {
//    $cr_id = 'Claim_Repair_NO_000' . $num;
//} else if ($num < 100) {
//    $cr_id = 'Claim_Repair_NO_00' . $num;
//} else if ($num < 1000) {
//    $cr_id = 'Claim_Repair_NO_0' . $num;
//} else {
//    $cr_id = 'Claim_Repair_NO_' . $num;
//}
if ($num < 10) {
    $cr_id = 'RPC' . $today2 . '-NO-0000' . $num;
} else if ($num < 100) {
    $cr_id = 'RPC' . $today2 . '-NO-000' . $num;
} else if ($num < 1000) {
    $cr_id = 'RPC' . $today2 . '-NO-00' . $num;
} else if ($num < 10000) {
    $cr_id = 'RPC' . $today2 . '-NO-0' . $num;
} else {
    $cr_id = 'RPC' . $today2 . '-NO-' . $num;
}


$sql_item = 'SELECT Item_ID,Item_manner,Customer_ID FROM t_repair_item tri JOIN t_repair tr ON tr.R_ID = tri.R_ID WHERE tri.Item_ID = "' . $item_id . '"';
$stmt_item = $dbh->prepare($sql_item);
$stmt_item->execute();
$result = $stmt_item->fetch();
$item_id2 = $result['Item_ID'];
$cus_id = $result['Customer_ID'];
$item_manner = $_POST['item_manner'];
$rows_item = $stmt_item->rowCount();

if ($rows_item > 0) {
    $status = "2";
    $sql_inert = 'INSERT INTO t_repair_claim SET Repair_Claim_ID = ?, Item_ID = ?, Date_R = ?, Item_manner = ?, Customer_ID = ?, Repair_Claim_Status = ?, Emp_ID = ?';
    $stmt_insert = $dbh->prepare($sql_inert);
    $stmt_insert->bindParam(1, $cr_id);
    $stmt_insert->bindParam(2, $item_id2);
    $stmt_insert->bindParam(3, $today);
    $stmt_insert->bindParam(4, $item_manner);
    $stmt_insert->bindParam(5, $cus_id);
    $stmt_insert->bindParam(6, $status);
    $stmt_insert->bindParam(7, $emp_id);
    try {
        $stmt_insert->execute();
        $rows_insert = $stmt_insert->rowCount();
        if ($rows_insert > 0) {
            echo 'ok';
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
?>