<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$sql = 'SELECT * FROM t_sms Order by SMS_Number DESC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch()) {
    $time_day = DateThaiTime($result['SMS_Time']);
    $tel = getTel($result['SMS_Tel_Send']);
    $arr['data'][] = array(
        $num,
        $result['SMS_List_id'],
        $time_day,
        $tel,
        $result['SMS_Detail']
    );
    $num++;
}
echo json_encode($arr);

function getTel($tel) {
    $f1 = substr($tel, 0, 3) . '-';
    $f2 = substr($tel, 3, 3) . '-';
    $f3 = substr($tel, 6, 4);
    return $f1 . $f2 . $f3;
}

;
?>