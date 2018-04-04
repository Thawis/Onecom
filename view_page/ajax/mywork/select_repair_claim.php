<?php

session_start();
$emp_id = $_SESSION['login_id'];
include '../../../lib/connect.php';
$sql = 'SELECT * FROM t_repair_claim WHERE Emp_ID = "' . $emp_id . '" AND Repair_Claim_Status != "0" ORDER BY Date_R DESC ';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch()) {
    if ($result['Repair_Claim_Status'] == "2") {
        $status = '<label class="label label-primary" style="font-size: 12px; font-family: Tahoma;">อยู่ระหว่างซ่อม</label>';
        $action = '<button type="button" class="btn bg-green-gradient btn_add_claim" style="font-size:12px; font-family: Tahoma;" value="' . $result['Repair_Claim_ID'] . '"><span class="fa fa-plus"></span></button> '
                . '<button type="button" class="btn bg-red-gradient btn_cancel_claim" style="font-size:12px; font-family: Tahoma;" value="' . $result['Repair_Claim_ID'] . '"><span class="fa fa-close"></span></button>';
    } else if ($result['Repair_Claim_Status'] == "3") {
        $status = '<label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">ซ่อมเรียบร้อย</label>';
        $action = '<button type="button" class="btn bg-blue-gradient btn_detail_claim" style="font-size:12px; font-family: Tahoma;" value="' . $result['Item_Detail'] . '" ><span class="fa fa-info-circle"></span></button> '
                . '<button type="button" class="btn bg-red-gradient btn_cancel_claim" style="font-size:12px; font-family: Tahoma;" value="' . $result['Repair_Claim_ID'] . '"><span class="fa fa-close"></span></button>';
    } else if ($result['Repair_Claim_Status'] == "4") {
        $status = '<label class="label bg-aqua-gradient" style="font-size: 12px; font-family: Tahoma;">ส่งคืนเรียบร้อย</label>';
        $action = '<button type="button" class="btn bg-blue-gradient btn_detail_claim" style="font-size:12px; font-family: Tahoma;" value="' . $result['Item_Detail'] . '" ><span class="fa fa-info-circle"></span></button> '
                . '<button type="button" class="btn bg-red-gradient btn_cancel_claim" style="font-size:12px; font-family: Tahoma;" value="' . $result['Repair_Claim_ID'] . '" disabled=""><span class="fa fa-close"></span></button>';
    }
    $detail = '<a class="btn bg-aqua-gradient" style="font-size:12px; font-family: Tahoma;" href="M_Repair_Record_Detail.php?item_id=' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span> รายละเอียด</a>';
    $arr['data'][] = array(
        $num,
        $result['Repair_Claim_ID'],
        $result['Item_ID'],
        $detail,
        $status,
        $result['Item_manner'],
        $action
    );
    $num++;
}
echo json_encode($arr);
?>