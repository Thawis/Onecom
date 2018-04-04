<?php

include '../../../lib/connect.php';
session_start();
$eid = $_SESSION['login_id'];
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");
$today2 = $dt->format("ym");
$number = count($_POST["P_ID"]);
$pu_type = 'sell';

//echo $_POST['imp_id_send'].','.$eid.','.$today.','.$_POST['ref'].','.$_POST['dealer'].','.$pu_type;

$sqlimp = "INSERT INTO t_import_detail SET Import_ID = ?, Date_Import = ?, Emp_ID = ?, Ref_Import_ID = ?, Dealer_ID = ?, Import_Type = ?";
$stmtimp = $dbh->prepare($sqlimp);
$stmtimp->bindParam(1, $_POST['imp_id_send']);
$stmtimp->bindParam(2, $today);
$stmtimp->bindParam(3, $eid);
$stmtimp->bindParam(4, $_POST['ref']);
$stmtimp->bindParam(5, $_POST['dealer']);
$stmtimp->bindParam(6, $pu_type);
try {
    $stmtimp->execute();
    $imp_status = 'ok';
} catch (Exception $ex) {
    echo $ex->getMessage();
}
//$imp_status = 'ok';
if ($imp_status == 'ok') {
    if ($number > 0) {
        for ($i = 0; $i < $number; $i++) {
            if (trim($_POST["P_ID"][$i] != '')) {
                $P_ID = $_POST["P_ID"][$i];
                $num = $_POST[$P_ID . "num"];
                $import_id = $_POST["imp_id_send"];
                $Date_resive = $_POST["Datewar"][$i];
                $Time_War = $_POST["Time_War"][$i];
                $Option_War = $_POST["Option_War"][$i];
                if ($Option_War == 'L-T' || $Option_War == 'none') {
                    $End_War = '';
                } else {
                    $End_War = date('Y-m-d', strtotime($Date_resive . $Option_War));
                }
                $pu_status = "1";
                $Temp_Unit_ID = $_POST['imp_uid'][$i];
            }
            //echo $P_ID.','.$num.','.$import_id.','.$Date_resive.','.$Time_War.','.$End_War.','.$Temp_Unit_ID.','.$_POST['dealer'];
            $sql_sn = "select * from temp_unit_sn where P_ID = '" . $P_ID . "' ORDER BY Number ASC";
            $stmt_sn = $dbh->prepare($sql_sn);
            $stmt_sn->execute();
            while ($result_sn = $stmt_sn->fetch()) {

                $sqlu = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_product_unit"';
                $stmtu = $dbh->prepare($sqlu);
                $stmtu->execute();
                $resultu = $stmtu->fetch();

                $nums = $resultu['AUTO_INCREMENT'];
//                if ($resultu['AUTO_INCREMENT'] < 10) {
//                    $unit_id = $P_ID . '_' . $Temp_Unit_ID . '_NO_' . '000' . $resultu['AUTO_INCREMENT'];
//                } else if ($resultu['AUTO_INCREMENT'] < 100) {
//                    $unit_id = $P_ID . '_' . $Temp_Unit_ID . '_NO_' . '00' . $resultu['AUTO_INCREMENT'];
//                } else if ($resultu['AUTO_INCREMENT'] < 1000) {
//                    $unit_id = $P_ID . '_' . $Temp_Unit_ID . '_NO_' . '0' . $resultu['AUTO_INCREMENT'];
//                } else {
//                    $unit_id = $P_ID . '_' . $Temp_Unit_ID . '_NO_' . $resultu['AUTO_INCREMENT'];
//                }
//                if ($nums < 10) {
//                    $unit_id = 'UNT' . $P_ID . $Temp_Unit_ID . '-NO-0000' . $nums;
//                } else if ($nums < 100) {
//                    $unit_id = 'UNT' . $P_ID . $Temp_Unit_ID . '-NO-000' . $nums;
//                } else if ($nums < 1000) {
//                    $unit_id = 'UNT' . $P_ID . $Temp_Unit_ID . '-NO-00' . $nums;
//                } else if ($nums < 10000) {
//                    $unit_id = 'UNT' . $P_ID . $Temp_Unit_ID . '-NO-0' . $nums;
//                }

                if ($nums < 10) {
                    $unit_id = 'UNT' . $Temp_Unit_ID . '-NO-0000' . $nums;
                } else if ($nums < 100) {
                    $unit_id = 'UNT' . $Temp_Unit_ID . '-NO-000' . $nums;
                } else if ($nums < 1000) {
                    $unit_id = 'UNT' . $Temp_Unit_ID . '-NO-00' . $nums;
                } else if ($nums < 10000) {
                    $unit_id = 'UNT' . $Temp_Unit_ID . '-NO-0' . $nums;
                } else {
                    $unit_id = 'UNT' . $Temp_Unit_ID . '-NO-' . $nums;
                }

                $sqli = "INSERT INTO t_product_unit SET P_ID = ?, Import_ID = ?, Unit_ID = ?, S_ID = ?, Date_Receive = ?, End_Warranty = ?, Warranty = ?, PU_Status = ? ";
                $stmti = $dbh->prepare($sqli);
                $stmti->bindParam(1, $P_ID);
                $stmti->bindParam(2, $import_id);
                $stmti->bindParam(3, $unit_id);
                $stmti->bindParam(4, $result_sn['S_ID']);
                $stmti->bindParam(5, $Date_resive);
                $stmti->bindParam(6, $End_War);
                $stmti->bindParam(7, $Time_War);
                $stmti->bindParam(8, $pu_status);
                try {
                    $stmti->execute();
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
            }
        }
        if ($i > 0) {
            echo 'ok';
        }
    }
}

//function genunit($length = 6) {
//    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//    $charactersLength = strlen($characters);
//    $randomString = '';
//    for ($i = 0; $i < $length; $i++) {
//        $randomString .= $characters[rand(0, $charactersLength - 1)];
//    }
//    return $randomString;
//}
?>