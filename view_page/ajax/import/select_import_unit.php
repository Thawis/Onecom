<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$import_id = $_POST['import_id'];
//$sql = "SELECT * FROM t_product_unit WHERE Import_ID = '" . $import_id . "' ORDER BY Number asc";
$sql = 'SELECT Unit_ID,P_Name,S_ID,Date_Receive,End_Warranty,Warranty,PU_Status FROM t_product_unit tpu JOIN t_product tp ON tpu.P_ID = tp.P_ID '
        . 'WHERE Import_ID = "' . $import_id . '" ORDER BY Number asc';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $dateR_thai = DateThai($result['Date_Receive']);
    $dateE_thai = DateThai($result['End_Warranty']);
    if ($result['PU_Status'] == "1") {
        $status = '<label class="label label-success" style="font-family: Tahoma; font-size: 12px;">สินค้าพร้อมจำหน่าย</label>';
    } else if ($result['PU_Status'] == "2") {
        $status = '<label class="label label-danger" style="font-family: Tahoma; font-size: 12px;">สินค้าถูกจำหน่ายแล้ว</label>';
    } else if ($result['PU_Status'] == "3") {
        $status = '<label class="label label-warning" style="font-family: Tahoma; font-size: 12px;">สินค้าเปลี่ยนสวนเคลม</label>';
    } else{
        $status = '<label class="label label-danger" style="font-family: Tahoma; font-size: 12px;">สินค้าถูกจำหน่ายแล้ว</label>';
    }
    $arr['data'][] = array(
        $num,
        $result['Unit_ID'],
        $result['P_Name'],
        $result['S_ID'],
        $dateR_thai,
        $dateE_thai,
        $result['Warranty'],
        $status
    );
    $num++;
}
echo json_encode($arr);
?>