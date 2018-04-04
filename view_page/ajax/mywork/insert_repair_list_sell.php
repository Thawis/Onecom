<?php

include '../../../lib/connect.php';
session_start();
$emp_id = $_SESSION['login_id'];
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d H:i:s");
$today2 = $dt->format("Y-m-d");

$ORD_ID = $_POST['repair_sell_ord_id'];
$CUS_ID = $_POST['repair_sell_cus'];
$TotalMoney = $_POST['repair_sell_total'];
$status = "1";
$cancel = "2";
$typesell = "repair";
$sql_sell = "INSERT INTO t_sell SET ORD_ID = ?, Customer_ID = ?, Date_Sell = ?, Total_Money = ?, ORD_Status = ?, ORD_Type = ?, Emp_ID = ?";
$stmt = $dbh->prepare($sql_sell);
$stmt->bindParam(1, $ORD_ID);
$stmt->bindParam(2, $CUS_ID);
$stmt->bindParam(3, $today);
$stmt->bindParam(4, $TotalMoney);
$stmt->bindParam(5, $status);
$stmt->bindParam(6, $typesell);
$stmt->bindParam(7, $emp_id);
try {
    $stmt->execute();
    $state = "ok";
} catch (Exception $ex) {
    $state = "not";
    echo $ex->getMessage();
}
$number = count($_POST['Unit_ID']);
$record = 0;
if ($number > 0 && $state == "ok") {
    for ($i = 0; $i < $number; $i++) {
        if (trim($_POST["Unit_ID"][$i] != '')) {
            $unit_id = $_POST['Unit_ID'][$i];
            $pname = $_POST['Pname'][$i];
            $price = $_POST['P_Price'][$i];
            $sn = $_POST['sid_send'][$i];
            $war = $_POST['Warranty'][$i];
            $pid = $_POST['pid_send'][$i];
            $e_war_shop = $_POST['endwar_send'][$i];
            $date_r = $_POST['dateR_send'][$i];
            $date_e = $_POST['dateE_send'][$i];


            $sql_insert_sell = "INSERT INTO t_sell_detail SET ORD_ID = ?, P_ID = ?, P_Name = ?, P_Price = ?, Unit_ID = ?, S_ID = ?, Date_Receive = ?, End_Warranty = ?, "
                    . "Warranty = ?, Date_Sell_Shop = ?, End_Warranty_Shop = ?, Unit_Status = ?";
            $stmt_insert_sell = $dbh->prepare($sql_insert_sell);
            $stmt_insert_sell->bindParam(1, $ORD_ID);
            $stmt_insert_sell->bindParam(2, $pid);
            $stmt_insert_sell->bindParam(3, $pname);
            $stmt_insert_sell->bindParam(4, $price);
            $stmt_insert_sell->bindParam(5, $unit_id);
            $stmt_insert_sell->bindParam(6, $sn);
            $stmt_insert_sell->bindParam(7, $date_r);
            $stmt_insert_sell->bindParam(8, $date_e);
            $stmt_insert_sell->bindParam(9, $war);
            $stmt_insert_sell->bindParam(10, $today2);
            $stmt_insert_sell->bindParam(11, $e_war_shop);
            $stmt_insert_sell->bindParam(12, $status);
            try {
                $stmt_insert_sell->execute();
                $sql_update_unit = "UPDATE t_product_unit SET PU_Status = ? WHERE Unit_ID = ? ";
                $stmt_update = $dbh->prepare($sql_update_unit);
                $stmt_update->bindParam(1, $cancel);
                $stmt_update->bindParam(2, $unit_id);
                $stmt_update->execute();
                $record++;
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
    }
    $Service_Menu = "ขายสินค้า - เปลี่ยนอุปกรณ์";
    //$detail = "ขายสินค้าเพื่อซ่อม<br> ตามใบเสร็จเลขที่ :<br> " . $ORD_ID;
    $detail = "ขายสินค้าเพื่อซ่อม";
    $c_war = "ตามใบเสร็จ";
    if ($record > 0) {
        $sql_case = "INSERT INTO t_repair_case SET Item_ID = ?, Service_Menu = ?, Service_Price = ?, Service_Detail = ?, Repair_Type = ?, "
                . "Ref_ID_Sell = ?, Repair_Warranty = ? ";
        $stmt_case = $dbh->prepare($sql_case);
        $stmt_case->bindParam(1, $_POST['repair_sell_id']);
        $stmt_case->bindParam(2, $Service_Menu);
        $stmt_case->bindParam(3, $_POST['repair_sell_total']);
        $stmt_case->bindParam(4, $detail);
        $stmt_case->bindParam(5, $_POST['repair_sell_type']);
        $stmt_case->bindParam(6, $ORD_ID);
        $stmt_case->bindParam(7, $c_war);
        try {
            $stmt_case->execute();
            echo "ok";
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}


//if ($number > 0) {
//    for ($i = 0; $i < $number; $i++) {
//        if (trim($_POST["Unit_ID"][$i] != '')) {
//            $str .= ' unit_id : ' . $_POST['Unit_ID'][$i];
//            $str .= ' name : ' . $_POST['Pname'][$i];
//            $str .= ' price : ' . $_POST['P_Price'][$i];
//            $str .= ' warranty : ' . $_POST['Warranty'][$i];
//            $str .= ' p_id : ' . $_POST['pid_send'][$i];
//            $str .= ' end_war_date : ' . $_POST['endwar_send'][$i];
//            $str .= ' dateR : ' . $_POST['dateR_send'][$i];
//            $str .= ' dateE : ' . $_POST['dateE_send'][$i];
//            $str .= ' Total : ' . $_POST['repair_sell_total'];
//            $str .= ' Type : ' . $_POST['repair_sell_type'];
//            $str .= ' item_ID : ' . $_POST['repair_sell_id'];
//            $str .= ' cus_id :' . $_POST['repair_sell_cus'];
//            $str .= ' ORD_ID : ' . $_POST['repair_sell_ord_id'] . '||||||';
//        }
//    }
//}
?>