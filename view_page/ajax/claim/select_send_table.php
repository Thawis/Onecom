<?php

session_start();
include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$usertype = $_SESSION['login_type'];
$sql = 'SELECT ClaimItem_ID,Dealer_Name,Dealer_Company,Claim_Date_Send FROM t_claim tc JOIN t_dealer td ON tc.Dealer_ID = td.Dealer_ID '
        . 'WHERE Claim_Status = "2"  ORDER BY Number_Claim DESC ';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch()) {
    if ($usertype == "user") {
        $action = '<button type="button" class="btn bg-red-gradient btn_cancel_send" value="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-close"> ยกเลิกการส่งสินค้าเคลม</span></button>';
    } else {
        $action = '<button type="button" class="btn bg-red-gradient btn_cancel_send" value="' . $result['ClaimItem_ID'] . '"><span class="fa fa-close"> ยกเลิกการส่งสินค้าเคลม</span></button>';
    }
    $date_send = DateThai($result['Claim_Date_Send']);
    $dealer = $result['Dealer_Name'] . ' ( ' . $result['Dealer_Company'] . ' )';
    $arr['data'][] = array(
        $num,
        $result['ClaimItem_ID'],
        $dealer,
        $date_send,
        $action
    );
    $num++;
}
echo json_encode($arr);
?>