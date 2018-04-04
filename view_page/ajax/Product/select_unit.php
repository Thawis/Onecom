<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$pid = $_GET["id"];
//$pid = "P05";
//$sql = "SELECT * FROM t_product_unit tpu JOIN t_import_detail  tid on tpu.Import_ID = tid.Import_ID  WHERE tpu.P_ID ='" . $pid . " AND tpu.PU_Status = '1' Order by Date_Receive ASC";
$sql = 'SELECT * FROM t_product tp JOIN t_product_unit tpu ON tp.P_ID = tpu.P_ID WHERE tp.P_ID = "' . $pid . '" AND tpu.PU_Status = "1" ORDER BY Date_Receive ASC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
//$supplier = "test";
$num = 1;
$arr = array('data' => array());
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($result['Warranty'] == "L-T" || $result['Warranty'] == "ไม่มีประกัน") {
        $date_r = DateThai($result['Date_Receive']);
        $date_e = '-';
    } else {
        $date_r = DateThai($result['Date_Receive']);
        $date_e = DateThai($result['End_Warranty']);
    }
    $arr['data'][] = array(
        $num,
        $result['S_ID'],
        $result['Unit_ID'],
        $result['Warranty'],
        $date_r,
        $date_e,
    );
    $num++;
}
echo json_encode($arr)
?>