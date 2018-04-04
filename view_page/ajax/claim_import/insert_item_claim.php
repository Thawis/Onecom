<?php

include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");

$name_old = $_POST['item_name_old'];
$sn_old = $_POST['item_sn_old'];

$c_id = $_POST['item_c_id'];
$sn_new = $_POST['item_sn_new'];
$pname = $_POST['item_name_new'];
$end_war_shop = $_POST['item_endshop'];
$end_war = $_POST['e_war'];
$date_sell_shop = $_POST['date_s'];
$war = $_POST['war'];
$status_ex = "1";
$status_c = "3";
$detail = 'รับเข้าเป็นสินค้าเปลี่ยน ชื่อสินค้า : ' . $pname . " S/N : " . $sn_new;

$sql_select_ord = 'SELECT * FROM temp_claim WHERE Claim_ID = "' . $c_id . '"';
$stmt_select_ord = $dbh->prepare($sql_select_ord);
$stmt_select_ord->execute();
$result_ord = $stmt_select_ord->fetch();
$rows_ord = $stmt_select_ord->rowCount();
if ($rows_ord > 0) {
    $sql_del = 'DELETE FROM temp_claim WHERE Claim_ID = "' . $c_id . '"';
    $stmt_del = $dbh->prepare($sql_del);
    $stmt_del->execute();
}

$ord = $result_ord['ORD_ID'];
$unit = $result_ord['Unit_ID'];

//$sql = 'INSERT INTO t_claim_exchange SET P_Name = ?, S_ID = ?, Date_EX = ?, End_Warranty = ?, Date_Sell_Shop = ?, '
//        . 'End_Warranty_Shop = ?, ClaimItem_ID = ?, Warranty = ?, Ex_Status = ? ';
$sql = 'INSERT INTO t_claim_exchange SET ORD_ID = ?, Unit_ID = ?, Unit_ID_New = ?, P_Name = ?, S_ID = ?, Date_EX = ?, End_Warranty = ?, Date_Sell_Shop = ?, '
        . 'End_Warranty_Shop = ?, ClaimItem_ID = ?, Warranty = ?, Ex_Status = ? ';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1,$ord);
$stmt->bindParam(2,$unit);
$stmt->bindParam(3,$unit);
$stmt->bindParam(4, $pname);
$stmt->bindParam(5, $sn_new);
$stmt->bindParam(6, $today);
$stmt->bindParam(7, $end_war);
$stmt->bindParam(8, $date_sell_shop);
$stmt->bindParam(9, $end_war_shop);
$stmt->bindParam(10, $c_id);
$stmt->bindParam(11, $war);
$stmt->bindParam(12, $status_ex);

try {
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows > 0) {
        $sql_update_sell = 'UPDATE t_sell_detail SET Unit_Status = ? WHERE P_Name = ? AND S_ID = ? ';
        $stmt_update_sell = $dbh->prepare($sql_update_sell);
        $stmt_update_sell->bindParam(1, $status_c);
        $stmt_update_sell->bindParam(2, $name_old);
        $stmt_update_sell->bindParam(3, $sn_old);
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
                    //echo 'ok';
                    $sql_ci = 'UPDATE t_claim_exchange SET Ex_Status = ? WHERE P_Name = ? AND S_ID = ? ';
                    $stmt_ci = $dbh->prepare($sql_ci);
                    $stmt_ci->bindParam(1,$status_c);
                    $stmt_ci->bindParam(2,$name_old);
                    $stmt_ci->bindParam(3,$sn_old);
                    $stmt_ci->execute();
                    echo 'ok';
                }
            }
        }
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>