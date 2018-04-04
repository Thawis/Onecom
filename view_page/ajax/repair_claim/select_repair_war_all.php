<?php

session_start();
include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$sql = 'SELECT Repair_Claim_ID,Item_ID,Customer_FullName,Emp_ID,Repair_Claim_Status FROM t_repair_claim trc JOIN  t_customer tc ON trc.Customer_ID = tc.Customer_ID WHERE Repair_Claim_Status != "4" AND Repair_Claim_Status != "0" Order by Repair_Claim_Number DESC ';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch()) {
    if ($result['Repair_Claim_Status'] == "0") {
        $status = '<label class="label bg-red-gradient" style="font-size: 12px; font-family: Tahoma;">ยกเลิกซ่อม</label>';
        $action2 = '<button type="button" class="btn bg-red-gradient btn_sms" value="' . $result['Repair_Claim_ID'] . '" disabled=""> <span class="fa fa-comment-o"> SMS</span></button> '
                . '<button type="button" class="btn bg-green-gradient btn_return" style="font-size:14px; font-family: Tahoma;" value="' . $result['Repair_Claim_ID'] . '" disabled=""> <span class="fa fa-exchange"> ส่งคืน</span></button>';
    } else if ($result['Repair_Claim_Status'] == "1") {
        $status = '<label class="label label-warning" style="font-size: 12px; font-family: Tahoma;">รอซ่อม</label>';
        $action2 = '<button type="button" class="btn bg-red-gradient btn_sms" value="' . $result['Repair_Claim_ID'] . '" disabled=""> <span class="fa fa-comment-o"> SMS</span></button> '
                . '<button type="button" class="btn bg-green-gradient btn_return" style="font-size:14px; font-family: Tahoma;" value="' . $result['Repair_Claim_ID'] . '" disabled=""> <span class="fa fa-exchange"> ส่งคืน</span></button>';
    } else if ($result['Repair_Claim_Status'] == "2") {
        $status = '<label class="label label-primary" style="font-size: 12px; font-family: Tahoma;">อยู่ระหว่างซ่อม</label>';
        $action2 = '<button type="button" class="btn bg-red-gradient btn_sms" value="' . $result['Repair_Claim_ID'] . '" disabled=""> <span class="fa fa-comment-o"> SMS</span></button> '
                . '<button type="button" class="btn bg-green-gradient btn_return" style="font-size:14px; font-family: Tahoma;" value="' . $result['Repair_Claim_ID'] . '" disabled=""> <span class="fa fa-exchange"> ส่งคืน</span></button>';
    } else if ($result['Repair_Claim_Status'] == "3") {
        $status = '<label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">ซ่อมเรียบร้อย</label>';
        $action2 = '<button type="button" class="btn bg-red-gradient btn_sms" value="' . $result['Repair_Claim_ID'] . '"> <span class="fa fa-comment-o"> SMS</span></button> '
                . '<button type="button" class="btn bg-green-gradient btn_return" style="font-size:14px; font-family: Tahoma;" value="' . $result['Repair_Claim_ID'] . '"> <span class="fa fa-exchange"> ส่งคืน</span></button>';
        if ($_SESSION['login_type'] == 'user') {
            $action2 = '<button type="button" class="btn bg-red-gradient btn_sms" value="' . $result['Repair_Claim_ID'] . '" disabled=""> <span class="fa fa-comment-o"> SMS</span></button> '
                    . '<button type="button" class="btn bg-green-gradient btn_return" style="font-size:14px; font-family: Tahoma;" value="' . $result['Repair_Claim_ID'] . '"> <span class="fa fa-exchange"> ส่งคืน</span></button>';
        }
    } else if ($result['Repair_Claim_Status'] == "4") {
        $status = '<label class="label bg-aqua-gradient" style="font-size: 12px; font-family: Tahoma;">ส่งคืนเรียบร้อย</label>';
    }
    $action1 = '<a class="btn bg-aqua-gradient" style="font-size:12px; font-family: Tahoma;" href="M_Repair_Record_Detail.php?item_id=' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span> รายละเอียด</a>';

    $sql1 = 'SELECT Emp_Name FROM t_employee WHERE Emp_ID = "' . $result['Emp_ID'] . '"';
    $stmt1 = $dbh->prepare($sql1);
    $stmt1->execute();
    $result1 = $stmt1->fetch();
    $name = $result1['Emp_Name'] . ' (' . $result['Emp_ID'] . ')';
    $arr['data'][] = array(
        $num,
        //$result['Repair_Claim_ID'],
        $result['Item_ID'],
        $result['Customer_FullName'],
        //$result['Emp_ID'],
        $name,
        $status,
        $action1,
        $action2
    );
    $num++;
}
echo json_encode($arr);
?>