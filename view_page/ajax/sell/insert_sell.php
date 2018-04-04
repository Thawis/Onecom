<?php

include '../../../lib/connect.php';
session_start();
$emp_id = $_SESSION['login_id'];

$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d H:i:s");

$typesell = "sell";
$status = "1";
$cancel = "2";
$ORD_ID = $_POST['ord_id_send'];
$CUS_ID = $_POST['cus_id_send'];
$TotalMoney = $_POST['total_price_send'];

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


$number = count($_POST["p_name"]);
//$state = 'ok';
$record = 0;
if ($number > 0 && $state == "ok") {
    for ($i = 0; $i < $number; $i++) {
        if (trim($_POST["p_name"][$i] != '')) {
            $pid = $_POST['p_id'][$i];
            $p_name = $_POST['p_name'][$i];
            $p_pice = $_POST['p_price'][$i];
            $p_num = $_POST['p_num'][$i];
            $sql_unit = 'SELECT * FROM t_product_unit WHERE P_ID = "' . $pid . '" AND PU_Status ="1" ORDER BY Number ASC LIMIT ' . $p_num;
            $stmt_unit = $dbh->prepare($sql_unit);
            $stmt_unit->execute();
            while ($result = $stmt_unit->fetch()) {
                if ($result['Warranty'] == "ไม่มีประกัน" || $result['Warranty'] == "L-T") {
                    $End_War_Shop = '';
                } else {
                    $End_War_Shop = EndDate($result['Warranty']);
                }
                $sql_insert_sell = "INSERT INTO t_sell_detail SET ORD_ID = ?, P_ID = ?, P_Name = ?, P_Price = ?, Unit_ID = ?, S_ID = ?, Date_Receive = ?, End_Warranty = ?, "
                        . "Warranty = ?, Date_Sell_Shop = ?, End_Warranty_Shop = ?, Unit_Status = ?";
                $stmt_insert_sell = $dbh->prepare($sql_insert_sell);
                $stmt_insert_sell->bindParam(1, $ORD_ID);
                $stmt_insert_sell->bindParam(2, $pid);
                $stmt_insert_sell->bindParam(3, $p_name);
                $stmt_insert_sell->bindParam(4, $p_pice);
                $stmt_insert_sell->bindParam(5, $result['Unit_ID']);
                $stmt_insert_sell->bindParam(6, $result['S_ID']);
                $stmt_insert_sell->bindParam(7, $result['Date_Receive']);
                $stmt_insert_sell->bindParam(8, $result['End_Warranty']);
                $stmt_insert_sell->bindParam(9, $result['Warranty']);
                $stmt_insert_sell->bindParam(10, $today);
                $stmt_insert_sell->bindParam(11, $End_War_Shop);
                $stmt_insert_sell->bindParam(12, $status);
                try {
                    $stmt_insert_sell->execute();
                    $sql_update_unit = "UPDATE t_product_unit SET PU_Status = ? WHERE Unit_ID = ? ";
                    $stmt_update = $dbh->prepare($sql_update_unit);
                    $stmt_update->bindParam(1, $cancel);
                    $stmt_update->bindParam(2, $result["Unit_ID"]);
                    $stmt_update->execute();
                    $record++;
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
            }
        }
    }

    if ($record > 0) {
        $_SESSION['ord_id_bill'] = $ORD_ID;
        echo "ok";
    }
}
function EndDate($warranty) {
    $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
    $today = $dt->format("Y-m-d");
    if ($warranty == "7วัน") {
        $End_War = date('Y-m-d', strtotime($today . " +7 days"));
        return $End_War;
    } else if ($warranty == "15วัน") {
        $End_War = date('Y-m-d', strtotime($today . " +15 days"));
        return $End_War;
    } else if ($warranty == "30วัน") {
        $End_War = date('Y-m-d', strtotime($today . " +30 days"));
        return $End_War;
    } else if ($warranty == "3เดือน") {
        $End_War = date('Y-m-d', strtotime($today . " +3 month"));
        return $End_War;
    } else if ($warranty == "6เดือน") {
        $End_War = date('Y-m-d', strtotime($today . " +6 month"));
        return $End_War;
    } else if ($warranty == "1ปี") {
        $End_War = date('Y-m-d', strtotime($today . " +1 year"));
        return $End_War;
    } else if ($warranty == "2ปี") {
        $End_War = date('Y-m-d', strtotime($today . " +2 year"));
        return $End_War;
    } else if ($warranty == "3ปี") {
        $End_War = date('Y-m-d', strtotime($today . " +3 year"));
        return $End_War;
    } else if ($warranty == "5ปี") {
        $End_War = date('Y-m-d', strtotime($today . " +5 year"));
        return $End_War;
    }
}

?>