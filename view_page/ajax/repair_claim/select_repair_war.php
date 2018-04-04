<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
//$sql = 'select tri.R_ID,tri.Item_ID,Customer_FullName,trc.Repair_EndWar from t_repair tr '
//        . 'JOIN t_repair_item tri ON tr.R_ID = tri.R_ID '
//        . 'JOIN t_repair_case trc ON tri.Item_ID = trc.Item_ID '
//        . 'JOIN t_customer tc ON tc.Customer_ID = tr.Customer_ID '
//        . 'WHERE Item_Status = "4" AND (DATE(Repair_EndWar) > DATE(NOW())) ';

$rid = $_POST['rid'];
//$sql = 'select tri.R_ID,tri.Item_ID,Customer_FullName,trc.Repair_EndWar from t_repair tr '
//        . 'JOIN t_repair_item tri ON tr.R_ID = tri.R_ID '
//        . 'JOIN t_repair_case trc ON tri.Item_ID = trc.Item_ID '
//        . 'JOIN t_customer tc ON tc.Customer_ID = tr.Customer_ID '
//        . 'WHERE Item_Status = "4" AND (DATE(Repair_EndWar) > DATE(NOW())) AND (tri.Item_ID = "' . $rid . '" OR tri.R_ID = "' . $rid . '")';

$sql = 'select tri.R_ID,tri.Item_ID,Customer_FullName,trc.Repair_EndWar,trc.Service_Menu from t_repair tr '
        . 'JOIN t_repair_item tri ON tr.R_ID = tri.R_ID '
        . 'JOIN t_repair_case trc ON tri.Item_ID = trc.Item_ID '
        . 'JOIN t_customer tc ON tc.Customer_ID = tr.Customer_ID '
        . 'WHERE Item_Status = "4" AND (DATE(Repair_EndWar) > DATE(NOW())) AND (tri.Item_ID = "' . $rid . '" OR tri.R_ID = "' . $rid . '")';

$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch()) {
    $end_w = DateThai($result['Repair_EndWar']);
    $war = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma;">' . $end_w . '</label>';
    $action1 = '<a class="btn bg-aqua-gradient" style="font-size:12px; font-family: Tahoma;" href="M_Repair_Record_Detail.php?item_id=' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span> รายละเอียด</a>';
//    $action = '<button type="button" class="btn bg-green-gradient btn_add_claim" value="' . $result['Item_ID'] . '"><span class="fa fa-plus"></span></button>';
    $action = '<button type="button" class="btn bg-green-gradient" id="btn_addclaim" onclick="setAddClaim(\'' . $result['Service_Menu'] . '\',\''.$result['Item_ID'].'\')"><span class="fa fa-plus"></span></button>';
    $arr['data'][] = array(
        $num,
        $result['R_ID'],
        $result['Item_ID'],
        $result['Customer_FullName'],
        $war,
        $action1,
        $action
    );
    $num++;
}
echo json_encode($arr);
?>