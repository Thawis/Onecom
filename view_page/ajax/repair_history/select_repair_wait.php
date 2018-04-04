<?php

session_start();
include '../../../lib/connect.php';
$sql = 'SELECT Customer_FullName,tri.Item_ID,tr.R_ID,tri.Item_Name,tri.Repair_Total_Price,tri.SMS_Stack,tri.Emp_ID '
        . 'FROM t_repair_item tri JOIN t_repair tr ON tri.R_ID = tr.R_ID JOIN t_customer tc ON tr.Customer_ID = tc.Customer_ID '
        . 'WHERE tri.Item_Status = "3" ORDER BY Item_Number DESC ';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch()) {
    $price = number_format($result['Repair_Total_Price']) . ' บาท';
    $action = '<a class="btn bg-aqua-gradient" style="font-size:12px; font-family: Tahoma;" href="M_Repair_Record_Detail.php?item_id=' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span> รายละเอียด</a>';
    $action2 = '<button type="button" class="btn bg-red-gradient btn_sms" value="' . $result['Item_ID'] . '"> <span class="fa fa-comment-o"></span> SMS</button> '
            . '<button type="button" class="btn bg-green-gradient btn_return" style="font-size:14px; font-family: Tahoma;" value="' . $result['Item_ID'] . '"> <span class="fa fa-exchange"></span> ส่งคืน</button>';
    if ($_SESSION['login_type'] == 'user') {
        $action2 = '<button type="button" class="btn bg-red-gradient btn_sms" value="' . $result['Item_ID'] . '" disabled=""> <span class="fa fa-comment-o"></span> SMS</button> '
                . '<button type="button" class="btn bg-green-gradient btn_return" style="font-size:14px; font-family: Tahoma;" value="' . $result['Item_ID'] . '"> <span class="fa fa-exchange"></span> ส่งคืน</button>';
    }



    $sql1 = 'SELECT Emp_Name FROM t_employee WHERE Emp_ID = "' . $result['Emp_ID'] . '"';
    $stmt1 = $dbh->prepare($sql1);
    $stmt1->execute();
    $result1 = $stmt1->fetch();
    $name = $result1['Emp_Name'] . ' (' . $result['Emp_ID'] . ')';

    $arr['data'][] = array(
        $num,
        $result['R_ID'],
        $result['Item_ID'],
        $name,
        $price,
        $action,
        $action2,
        $result['Customer_FullName'],
        $result['Item_Name'],
            //$result['Emp_ID'],
            //$result['SMS_Stack'],
    );
    $num++;
}
echo json_encode($arr);
?>