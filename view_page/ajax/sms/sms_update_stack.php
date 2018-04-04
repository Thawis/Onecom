<?php

include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d H:i:s");

$sms = $_POST['sms'] + 1;
$id = $_POST['id'];
$tel = $_POST['tel'];
$mess = $_POST['mess'];
$sql = "UPDATE t_repair_item SET SMS_Stack = ? WHERE Item_ID = ? ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $sms);
$stmt->bindParam(2, $id);
$stmt->execute();
$rows = $stmt->rowCount();
if ($rows > 0) {
    $sql_sms = 'INSERT INTO t_sms SET SMS_List_id = ?, SMS_Detail = ?, SMS_Time = ?, SMS_Tel_Send = ? ';
    $stmt_sms = $dbh->prepare($sql_sms);
    $stmt_sms->bindParam(1, $id);
    $stmt_sms->bindParam(2, $mess);
    $stmt_sms->bindParam(3, $today);
    $stmt_sms->bindParam(4, $tel);
    try {
        $stmt_sms->execute();
        $rows_sms = $stmt_sms->rowCount();
        if ($rows_sms > 0) {
            echo 'ok';
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
} else {
    echo 'not';
}

//echo $sms.','.$id;
?>