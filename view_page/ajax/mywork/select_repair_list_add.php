<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
session_start();
$emp_id = $_SESSION['login_id'];
$sql = 'SELECT tr.R_ID,Item_ID,R_DATE,Repair_Total_Price,Emp_ID,Item_Status FROM t_repair tr JOIN t_repair_item tri ON tr.R_ID = tri.R_ID '
        . 'WHERE (Item_Status = "3" OR Item_Status = "4") AND Emp_ID = "' . $emp_id . '"  ORDER BY Item_Number DESC';
$arr = array("data" => array());
$num = 1;
$stmt = $dbh->prepare($sql);
$stmt->execute();

while ($result = $stmt->fetch()) {
    $datethai = DateThai($result['R_DATE']);
    $total = number_format($result['Repair_Total_Price']).' บาท';
    if ($result['Item_Status'] == "0") {
        $status = '<label class="label bg-red-gradient" style="font-size: 12px; font-family: Tahoma;">ยกเลิกซ่อม</label>';
    } else if ($result['Item_Status'] == "1") {
        $status = '<label class="label label-warning" style="font-size: 12px; font-family: Tahoma;">รอซ่อม</label>';
    } else if ($result['Item_Status'] == "2") {
        $status = '<label class="label label-primary" style="font-size: 12px; font-family: Tahoma;">อยู่ระหว่างซ่อม</label>';
    } else if ($result['Item_Status'] == "3") {
        $status = '<label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">ซ่อมเรียบร้อย</label>';
    } else if ($result['Item_Status'] == "4") {
        $status = '<label class="label bg-aqua-gradient" style="font-size: 12px; font-family: Tahoma;">ส่งคืนเรียบร้อย</label>';
    }
    if ($result['Item_Status'] == "3") {
        $action = '<a class="btn bg-aqua-gradient" href="M_Repair_Record_Detail.php?item_id=' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span></a> '
                . '<button type="button" class="btn bg-red-gradient btn_cancel_add" value="' . $result['Item_ID'] . '" style="font-size: 12px; font-family: Tahoma;"><span class="fa fa-close"></span></button>';
    } else if ($result['Item_Status'] == "4") {
            $action = '<a class="btn bg-aqua-gradient" href="M_Repair_Record_Detail.php?item_id=' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span></a> '
            . '<button type="button" class="btn bg-red-gradient btn_cancel_add" value="' . $result['Item_ID'] . '" style="font-size: 12px; font-family: Tahoma;" disabled=""><span class="fa fa-close"></span></button>';
    }

    $arr['data'][] = array(
        $num,
        $result['R_ID'],
        $result['Item_ID'],
        $datethai,
        //$result['Repair_Total_Price'],
        $total,
        $status,
        $action,
    );
    $num++;
}
echo json_encode($arr);
?>