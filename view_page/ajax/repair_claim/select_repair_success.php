<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';

$sql = 'SELECT Repair_Claim_ID,Item_ID,Date_R,Date_S,Item_Detail,Customer_FullName,Emp_ID From t_repair_claim trc JOIN t_customer tc '
        . 'WHERE trc.Customer_ID = tc.Customer_ID AND trc.Repair_Claim_Status = "4" '
        . 'ORDER BY Date_S DESC';

$arr = array("data" => array());
$num = 1;
$stmt = $dbh->prepare($sql);
$stmt->execute();

while ($result = $stmt->fetch()) {
    $datethai = DateThai($result['Date_R']);
    $datethai_end = DateThai($result['Date_S']);
    $action = '<button type="button" class="btn bg-aqua-gradient btn_detail_claim" value="' . $result['Item_Detail'] . '" style="font-size: 12px; font-family: Tahoma;"><span class="fa fa-info-circle"></span> รายละเอียด</button>';
    $sql1 = 'SELECT Emp_Name FROM t_employee WHERE Emp_ID = "' . $result['Emp_ID'] . '"';
    $stmt1 = $dbh->prepare($sql1);
    $stmt1->execute();
    $result1 = $stmt1->fetch();
    $name = $result1['Emp_Name'] . ' (' . $result['Emp_ID'] . ')';
    $arr['data'][] = array(
        $num,
        $result['Repair_Claim_ID'],
        $result['Item_ID'],
        //$datethai,
        //$datethai_end,
        $result['Customer_FullName'],
        //$result['Emp_ID'],
        $name,
        $action
    );
    $num++;
}
echo json_encode($arr);
?>