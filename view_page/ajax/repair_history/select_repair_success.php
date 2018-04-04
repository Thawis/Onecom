<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
session_start();
$emp_id = $_SESSION['login_id'];
//$sql = 'SELECT tr.R_ID,Item_ID,R_DATE,Repair_Total_Price,Emp_ID,Item_Status,ReturnItem_Time,Return_Number '
//        . 'FROM t_repair tr JOIN t_repair_item tri ON tr.R_ID = tri.R_ID JOIN t_return_item tr_i ON tr_i.Ref_ID_Return = tri.Item_ID '
//        . 'WHERE Item_Status = "4" ORDER BY Return_Number DESC ';
$sql = 'SELECT tr.R_ID,Item_ID,R_DATE,Repair_Total_Price,Emp_ID,Item_Status,ReturnItem_Time,Return_Number,tc.Customer_FullName,tri.Item_Name '
        . 'FROM t_repair tr JOIN t_repair_item tri ON tr.R_ID = tri.R_ID JOIN t_return_item tr_i ON tr_i.Ref_ID_Return = tri.Item_ID '
        . 'JOIN t_customer tc ON tc.Customer_ID = tr.Customer_ID '
        . 'WHERE Item_Status = "4" ORDER BY Return_Number DESC ';
$arr = array("data" => array());
$num = 1;
$stmt = $dbh->prepare($sql);
$stmt->execute();

while ($result = $stmt->fetch()) {
    $datethai = DateThai($result['R_DATE']);
    $datethai_end = DateThai($result['ReturnItem_Time']);
    $totalPrice = number_format($result['Repair_Total_Price']).' บาท';
    $bill = '';

    $sql1 = 'SELECT Emp_Name FROM t_employee WHERE Emp_ID = "' . $result['Emp_ID'] . '"';
    $stmt1 = $dbh->prepare($sql1);
    $stmt1->execute();
    $result1 = $stmt1->fetch();
    $name = $result1['Emp_Name'] . ' (' . $result['Emp_ID'] . ')';

//    if ($result['Item_Status'] == "0") {
//        $status = '<label class="label bg-red-gradient" style="font-size: 12px; font-family: Tahoma;">ยกเลิกซ่อม</label>';
//    } else if ($result['Item_Status'] == "1") {
//        $status = '<label class="label label-warning" style="font-size: 12px; font-family: Tahoma;">รอซ่อม</label>';
//    } else if ($result['Item_Status'] == "2") {
//        $status = '<label class="label label-primary" style="font-size: 12px; font-family: Tahoma;">อยู่ระหว่างซ่อม</label>';
//    } else if ($result['Item_Status'] == "3") {
//        $status = '<label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">ซ่อมเรียบร้อย</label>';
//    } else if ($result['Item_Status'] == "4") {
//        $status = '<label class="label bg-aqua-gradient" style="font-size: 12px; font-family: Tahoma;">ส่งคืนเรียบร้อย</label>';
//    }
    if ($result['Item_Status'] == "3") {
        $action = '<a class="btn bg-aqua-gradient" href="M_Repair_Record_Detail.php?item_id=' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span></a> '
                . '<button type="button" class="btn bg-red-gradient btn_cancel_add" value="' . $result['Item_ID'] . '" style="font-size: 12px; font-family: Tahoma;"><span class="fa fa-close"></span></button>';
        $bill = '<button type="button" class="btn bg-yellow-gradient btn_rbill" value="' . $result['Item_ID'] . '" style="font-size: 12px; font-family: Tahoma;" disabled=""><span class="fa fa-print"></span> ใบเสร็จซ่อม </button>';
    } else if ($result['Item_Status'] == "4") {
        $action = '<a class="btn bg-aqua-gradient" href="M_Repair_Record_Detail.php?item_id=' . $result['Item_ID'] . '" style="font-size: 12px; font-family: Tahoma;"><span class="fa fa-info-circle"></span> รายละเอียดซ่อม</a> ';
        $bill = '<button type="button" class="btn bg-yellow-gradient btn_rbill" value="' . $result['Item_ID'] . '" style="font-size: 12px; font-family: Tahoma;"><span class="fa fa-print"></span> ใบเสร็จซ่อม </button>';
    }

    $arr['data'][] = array(
        $num,
        $result['R_ID'],
        $result['Item_ID'],
        //$datethai,
        //$datethai_end,
        //$result['Emp_ID'],
        //$status,
        //$result['Repair_Total_Price'],
        $name,
        $totalPrice,
        $action,
        $bill,
        $result['Customer_FullName'],
        $result['Item_Name']
    );
    $num++;
}
echo json_encode($arr);
?>