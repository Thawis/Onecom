<?php

include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");
$today2 = $dt->format("ym");
$state_add_ex = '';
$state_add_claim = '';
$state_update_unit = '';

$ord_id = $_POST['ex_ord_id'];
$old_unit_id = $_POST['ex_unit_id_old'];
$old_sn = $_POST['ex_sn_old'];
$new_unit_id = $_POST['ex_unit_id_new'];
$new_sn = $_POST['ex_sn_new'];
$pname = $_POST['ex_pname'];
$old_pname = $_POST['ex_pname_old'];
$end_war = $_POST['ex_end_war'];
$end_war_shop = $_POST['ex_end_war_shop'];
$date_sell_shop = $_POST['ex_date_sell_shop'];
$war = $_POST['ex_warranty'];
$manner = $_POST['ex_manner'];

$sql_id = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_claim"';
$stmt_id = $dbh->prepare($sql_id);
$stmt_id->execute();
$result_id = $stmt_id->fetch();
$num = $result_id['AUTO_INCREMENT'];
$c_id = '';

//if ($num < 10) {
//    $c_id = 'Claim_NO_000' . $num;
//} else if ($num < 100) {
//    $c_id = 'Claim_NO_00' . $num;
//} else if ($num < 1000) {
//    $c_id = 'Claim_NO_0' . $num;
//} else {
//    $c_id = 'Claim_NO_' . $num;
//}

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

$ex_status = '1';
$sql_insert_ex = 'INSERT INTO t_claim_exchange SET ORD_ID = ?, Unit_ID = ?, Unit_ID_New = ?, P_Name = ?, S_ID = ?, Date_Ex = ?, '
        . 'End_Warranty = ?, Date_Sell_Shop = ?, End_Warranty_Shop = ?, Warranty = ?, Ex_Status = ?, ClaimItem_ID = ? ';
$stmt_insert_ex = $dbh->prepare($sql_insert_ex);
$stmt_insert_ex->bindParam(1, $ord_id);
$stmt_insert_ex->bindParam(2, $old_unit_id);
$stmt_insert_ex->bindParam(3, $new_unit_id);
$stmt_insert_ex->bindParam(4, $pname);
$stmt_insert_ex->bindParam(5, $new_sn);
$stmt_insert_ex->bindParam(6, $today);
$stmt_insert_ex->bindParam(7, $end_war);
$stmt_insert_ex->bindParam(8, $date_sell_shop);
$stmt_insert_ex->bindParam(9, $end_war_shop);
$stmt_insert_ex->bindParam(10, $war);
$stmt_insert_ex->bindParam(11, $ex_status);
$stmt_insert_ex->bindParam(12, $c_id);
try {
    $stmt_insert_ex->execute();
    $rows_insert_ex = $stmt_insert_ex->rowCount();
    if ($rows_insert_ex > 0) {
        $state_add_ex = 'ok';
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}

if ($state_add_ex == 'ok') {
    $c_name = "OneComputer";
    $c_status = "1";
    $c_type = 'forshop';
    $sql_insert_c = 'INSERT INTO t_claim SET ClaimItem_ID = ?, Cus_Name = ?, ClaimItem_Name = ?, S_ID = ?, Claim_Date_Add = ?, Claim_Status = ?, Claim_Type = ?, Claim_Manner = ?';
    $stmt_insert_c = $dbh->prepare($sql_insert_c);
    $stmt_insert_c->bindParam(1, $c_id);
    $stmt_insert_c->bindParam(2, $c_name);
    $stmt_insert_c->bindParam(3, $old_pname);
    $stmt_insert_c->bindParam(4, $old_sn);
    $stmt_insert_c->bindParam(5, $today);
    $stmt_insert_c->bindParam(6, $c_status);
    $stmt_insert_c->bindParam(7, $c_type);
    $stmt_insert_c->bindParam(8, $manner);
    try {
        $stmt_insert_c->execute();
        $rows_insert_c = $stmt_insert_c->rowCount();
        if ($rows_insert_c > 0) {
            $state_add_claim = 'ok';
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

if ($state_add_claim == 'ok') {
    $cu_status = '3';
    $cu_status2 = '3';
    $sql_update_old_unit = 'UPDATE t_sell_detail SET Unit_Status = ? WHERE ORD_ID = ? AND Unit_ID = ?';
    $stmt_update_old_unit = $dbh->prepare($sql_update_old_unit);
    $stmt_update_old_unit->bindParam(1, $cu_status);
    $stmt_update_old_unit->bindParam(2, $ord_id);
    $stmt_update_old_unit->bindParam(3, $old_unit_id);
    try {
        $stmt_update_old_unit->execute();
        $rows_update = $stmt_update_old_unit->rowCount();
        if ($rows_update > 0) {
            $sql_update_new_unit = 'UPDATE t_product_unit SET PU_Status = ? WHERE Unit_ID = ?';
            $stmt_update_new_unit = $dbh->prepare($sql_update_new_unit);
            $stmt_update_new_unit->bindParam(1, $cu_status2);
            $stmt_update_new_unit->bindParam(2, $new_unit_id);
            $stmt_update_new_unit->execute();
            $rows_update_2 = $stmt_update_new_unit->rowCount();
            if ($rows_update_2 > 0) {
                $state_update_unit = 'ok';
                echo 'บันทึกข้อมูลเคลมแลกเปลี่ยนเรียบร้อย';
            }
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
?>



