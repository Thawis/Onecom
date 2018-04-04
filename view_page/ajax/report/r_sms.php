<?php

session_start();
include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$type = $_POST['type'];
$datestart = substr($_POST['todate'], 0, 10);
$dateend = substr($_POST['todate'], 13, 10);
$_SESSION['R_SMS_Type'] = $type;
$_SESSION['R_SMS_Start'] = $datestart;
$_SESSION['R_SMS_End'] = $dateend;
$num = 1;

$sql = '';
if ($type == "All") {
    $sql = 'SELECT * FROM t_sms WHERE SMS_Time >= "' . $datestart . '" AND SMS_Time <= "' . $dateend . '"';
} else {
    $sql = 'SELECT * FROM t_sms WHERE SMS_List_id LIKE "%' . $type . '%" AND (SMS_Time >= "' . $datestart . '" AND SMS_Time <= "' . $dateend . '")';
}
$arr = array("data" => array());
$stmt = $dbh->prepare($sql);
$stmt->execute();
while ($result = $stmt->fetch()) {
    $datethai = DateThaiTime($result['SMS_Time']);
    $tel = getTel($result['SMS_Tel_Send']);
    $needle = "Repair_NO";
    if (strpos($result['SMS_List_id'], $needle) !== false) {
        $smsType = "แจ้งเตือนซ่อม";
    } else {
        $smsType = "แจ้งเตือนเคลม";
    }


    $arr['data'][] = array(
        $num,
        $result['SMS_List_id'],
        $datethai,
        $smsType,
        $tel
    );
    $num++;
}
echo json_encode($arr);


function getTel($tel) {
    $f1 = substr($tel, 0, 3) . '-';
    $f2 = substr($tel, 3, 3) . '-';
    $f3 = substr($tel, 6, 4);
    return $f1 . $f2 . $f3;
};

?>