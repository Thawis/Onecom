<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$sql = 'SELECT tr.R_ID,Item_ID,R_DATE,A_Emp_ID,Item_Status,Emp_Name FROM t_repair tr JOIN t_repair_item tri ON tr.R_ID = tri.R_ID '
        . 'JOIN t_employee te ON tr.A_Emp_ID = te.Emp_ID '
        . 'WHERE Item_Status = "1" ORDER BY Item_Number DESC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch()) {
    $datethai = DateThai($result['R_DATE']);
    if ($result['Item_Status'] == "1") {
        $status = '<label class="label bg-yellow-gradient" style="font-size: 12px; font-family: Tahoma;">รอซ่อม</label>';
    } else if ($result['Item_Status'] == "2") {
        $status = '<label class="label bg-blue-gradient" style="font-size: 12px; font-family: Tahoma;">อยู่ระหว่างซ่อม</label>';
    }
    $action = '<button type="button" class="btn bg-aqua-gradient btn-block btn_rdetail" style="font-size: 12px; font-family: Tahoma;" value="'.$result['Item_ID'].'">รายละเอียด</button>';
    $name = $result['Emp_Name'].' ('.$result['A_Emp_ID'].')';
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