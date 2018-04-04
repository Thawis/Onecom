<?php


include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d H:i:s");
session_start();
$emp_id = $_SESSION['login_id'];
$cus_id = $_POST['cus_id_send'];
$r_id = $_POST['r_id_send'];
$status = '1';
$stack = 0;
$N = 'N';
$sql = "INSERT INTO t_repair SET R_ID = ?, R_DATE = ?, Customer_ID = ?, A_Emp_ID = ?, Type = ?";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $r_id);
$stmt->bindParam(2, $today);
$stmt->bindParam(3, $cus_id);
$stmt->bindParam(4, $emp_id);
$stmt->bindParam(5, $N);

try {
    $stmt->execute();
    $state = "ok";
} catch (Exception $ex) {
    echo $ex->getMessage();
}
$record = 0;
$number = count($_POST['type_send']);
if ($number > 0 && $state == "ok") {
    for ($i = 0; $i < $number; $i++) {
        $type = $_POST['type_send'][$i];
        $name = $_POST['name_send'][$i];
        $sn = $_POST['sn_send'][$i];
        $manner = $_POST['manner_send'][$i];
        $eqm = $_POST['eqm_send'][$i];
        //set item id
        $sql_rt = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_repair_item"';
        $stmt_rt = $dbh->prepare($sql_rt);
        $stmt_rt->execute();
        $result_rt = $stmt_rt->fetch();
        $rt_num = $result_rt['AUTO_INCREMENT'];
        $items_id = $r_id . "-" . $rt_num;
        //insert_item
        $sql_i = 'INSERT INTO t_repair_item SET Item_ID = ?, R_ID = ?, Type_Item = ?, Item_Name = ?, Item_SN = ?, Item_eqm = ?, Item_manner = ?, Item_Status = ?, SMS_Stack = ?';
        $stmt_i = $dbh->prepare($sql_i);
        $stmt_i->bindParam(1, $items_id);
        $stmt_i->bindParam(2, $r_id);
        $stmt_i->bindParam(3, $type);
        $stmt_i->bindParam(4, $name);
        $stmt_i->bindParam(5, $sn);
        $stmt_i->bindParam(6, $eqm);
        $stmt_i->bindParam(7, $manner);
        $stmt_i->bindParam(8, $status);
        $stmt_i->bindParam(9, $stack);
        try {
            $stmt_i->execute();
            $record++;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
if ($record > 0) {
    $_SESSION['Repair_ID'] = $r_id;
    echo "ok";
}
?>