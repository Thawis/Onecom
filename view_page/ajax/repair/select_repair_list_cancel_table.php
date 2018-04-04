<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$sql = 'SELECT tr.R_ID,Item_ID,R_DATE,A_Emp_ID,Item_Status,Emp_Name FROM t_repair tr JOIN t_repair_item tri ON tr.R_ID = tri.R_ID '
        . 'JOIN t_employee te ON te.Emp_ID = tr.A_Emp_ID '
        . 'WHERE Item_Status = "0" ORDER BY Item_Number DESC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch()) {
    $name = $result['Emp_Name'].' ( '.$result['A_Emp_ID'].' )';
    $datethai = DateThai($result['R_DATE']);
    $status = '<label class="label bg-red-gradient" style="font-size: 12px; font-family: Tahoma;">ยกเลิกซ่อม</label>';
    $action = '<button type="button" class="btn bg-green-gradient btn-block btn_open_cancel" style="font-size: 12px; font-family: Tahoma;" value="'.$result['Item_ID'].'"><span class="fa fa-refresh"></span> เปิดรับซ่อมสินค้า</button>';
    $arr['data'][] = array(
        $num,
        $result['R_ID'],
        $result['Item_ID'],
        $datethai,
        //$result['A_Emp_ID'],
        $name,
        $status,
        $action,
    );
    $num++;
}
echo json_encode($arr);
?>