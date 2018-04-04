<?php

session_start();
include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Ymd");
$today2 = $dt->format("Y-m-d");
$today3 = $dt->format("ym");
//echo $_POST['ex_new_pid'],$_POST['ex_new_uid'],$_POST['ex_claim_id'],$_POST['ex_old_pname'],$_POST['ex_old_sn'],$_POST['ex_new_pname'],$_POST['ex_new_sn'];

$sql = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_import_detail"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();

$claim_4 = '4';
$pu_status = '1';
$type_imp = "re_sell";
$emp_id = $_SESSION['login_id'];
//$imp_id = 'Import_' . $today . '_NO_' . $result['AUTO_INCREMENT'];
$numz = $result['AUTO_INCREMENT'];
if ($numz < 10) {
    $imp_id = 'IMP' . $today3 . '-NO-0000' . $numz;
} else if ($numz < 100) {
    $imp_id = 'IMP' . $today3 . '-NO-000' . $numz;
} else if ($numz < 1000) {
    $imp_id = 'IMP' . $today3 . '-NO-00' . $numz;
} else if ($numz < 10000) {
    $imp_id = 'IMP' . $today3 . '-NO-0' . $numz;
}
$c_id = $_POST['ex_claim_id'];

$sql_dealer = 'SELECT Dealer_ID FROM t_claim WHERE ClaimItem_ID = "' . $c_id . '"';
$stmt_dealer = $dbh->prepare($sql_dealer);
$stmt_dealer->execute();
$result_dealer = $stmt_dealer->fetch();


$dealer_id = $result_dealer['Dealer_ID'];

$sqlu = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_product_unit"';
$stmtu = $dbh->prepare($sqlu);
$stmtu->execute();
$resultu = $stmtu->fetch();
$numtu = $result['AUTO_INCREMENT'];
//if ($resultu['AUTO_INCREMENT'] < 10) {
//    $unit_id = $_POST['ex_new_pid'] . '_' . $_POST['ex_new_uid'] . '_NO_' . '000' . $resultu['AUTO_INCREMENT'];
//} else if ($resultu['AUTO_INCREMENT'] < 100) {
//    $unit_id = $_POST['ex_new_pid'] . '_' . $_POST['ex_new_uid'] . '_NO_' . '00' . $resultu['AUTO_INCREMENT'];
//} else if ($resultu['AUTO_INCREMENT'] < 1000) {
//    $unit_id = $_POST['ex_new_pid'] . '_' . $_POST['ex_new_uid'] . '_NO_' . '0' . $resultu['AUTO_INCREMENT'];
//} else {
//    $unit_id = $_POST['ex_new_pid'] . '_' . $_POST['ex_new_uid'] . '_NO_' . $resultu['AUTO_INCREMENT'];
//}
//$unit_id;

if ($numtu < 10) {
    $unit_id = 'UNT' . $_POST['ex_new_uid'] . '-NO-0000' . $numtu;
} else if ($numtu < 100) {
    $unit_id = 'UNT' . $_POST['ex_new_uid'] . '-NO-000' . $numtu;
} else if ($numtu < 1000) {
    $unit_id = 'UNT' . $_POST['ex_new_uid'] . '-NO-00' . $numtu;
} else if ($numtu < 10000) {
    $unit_id = 'UNT' . $_POST['ex_new_uid'] . '-NO-0' . $numtu;
} else {
    $unit_id = 'UNT' . $_POST['ex_new_uid'] . '-NO-' . $numtu;
}


$sql_claim_ex = 'SELECT End_Warranty,Warranty FROM t_claim_exchange WHERE ClaimItem_ID = "' . $c_id . '"';
$stmt_claim_ex = $dbh->prepare($sql_claim_ex);
$stmt_claim_ex->execute();
$result_claim_ex = $stmt_claim_ex->fetch();

$endwar = $result_claim_ex['End_Warranty'];
$war = $result_claim_ex['Warranty'];



$sql_insert_imp = 'INSERT INTO t_import_detail SET Import_ID = ?, Date_Import = ?, Emp_ID = ?, Ref_Import_ID = ?, Dealer_ID = ?, Import_Type = ?';
$stmt_insert_imp = $dbh->prepare($sql_insert_imp);
$stmt_insert_imp->bindParam(1, $imp_id);
$stmt_insert_imp->bindParam(2, $today2);
$stmt_insert_imp->bindParam(3, $emp_id);
$stmt_insert_imp->bindParam(4, $c_id);
$stmt_insert_imp->bindParam(5, $dealer_id);
$stmt_insert_imp->bindParam(6, $type_imp);
$stmt_insert_imp->execute();
$rows_insert_imp = $stmt_insert_imp->rowCount();

if ($rows_insert_imp > 0) {
    $sql_insert_unit = 'INSERT INTO t_product_unit SET P_ID = ?, Import_ID = ?, Unit_ID = ?, S_ID = ?, Date_Receive = ?, End_Warranty = ?, Warranty = ?, PU_Status = ?';
    $stmt_insert = $dbh->prepare($sql_insert_unit);
    $stmt_insert->bindParam(1, $_POST['ex_new_pid']);
    $stmt_insert->bindParam(2, $imp_id);
    $stmt_insert->bindParam(3, $unit_id);
    $stmt_insert->bindParam(4, $_POST['ex_new_sn']);
    $stmt_insert->bindParam(5, $today2);
    $stmt_insert->bindParam(6, $endwar);
    $stmt_insert->bindParam(7, $war);
    $stmt_insert->bindParam(8, $pu_status);
    $stmt_insert->execute();
    $rows_insert = $stmt_insert->rowCount();
    $detail_claim = 'รับเข้าสินค้าของร้าน ชื่อสินค้า : ' . $_POST['ex_new_pname'] . ' S/N : ' . $_POST['ex_new_sn'];
}

if ($rows_insert > 0) {
    $sql_update_claim = 'UPDATE t_claim SET Claim_Date_D_Return = ?, Claim_Date_C_Return = ?, Claim_Status = ? WHERE ClaimItem_ID = ? ';
    $stmt_c = $dbh->prepare($sql_update_claim);
    $stmt_c->bindParam(1, $today2);
    $stmt_c->bindParam(2, $today2);
    $stmt_c->bindParam(3, $claim_4);
    $stmt_c->bindParam(4, $c_id);
    $stmt_c->execute();
    $rows3 = $stmt_c->rowCount();
    if ($rows3 > 0) {
        $sql_di = 'INSERT INTO t_claim_detail SET ClaimItem_ID = ?, Claim_Detail = ?';
        $stmt_id = $dbh->prepare($sql_di);
        $stmt_id->bindParam(1, $c_id);
        $stmt_id->bindParam(2, $detail_claim);
        $stmt_id->execute();
        $rows4 = $stmt_id->rowCount();
        if ($rows4 > 0) {
            echo 'ok';
        }
    }
}
?>