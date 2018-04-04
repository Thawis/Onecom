<?php

session_start();
include '../../../lib/connect.php';
require '../../../lib/getDate_TH.php';

$type = $_POST['type'];
$datestart = substr($_POST['todate'], 0, 10);
$dateend = substr($_POST['todate'], 13, 10);

$_SESSION['R_claim_type'] = $type;
$_SESSION['R_claim_start'] = $datestart;
$_SESSION['R_claim_end'] = $dateend;

if ($type == 'All') {
    //SELECT ClaimItem_ID,Claim_Date_Add,Claim_Date_C_Return,Dealer_ID,Cus_Name,Claim_Type,Claim_Manner,S_ID,ClaimItem_Name
    $sql = 'SELECT * FROM t_claim '
            . 'WHERE (Claim_Date_Add >= "' . $datestart . '" AND Claim_Date_Add <= "' . $dateend . '") AND Claim_Status != "0"';
} else {
    $sql = 'SELECT * FROM t_claim '
            . 'WHERE (Claim_Date_Add >= "' . $datestart . '" AND Claim_Date_Add <= "' . $dateend . '") AND Claim_Type = "' . $type . '" AND Claim_Status != "0"';
}

$num = 1;
$arr = array("data" => array());
$stmt = $dbh->prepare($sql);
$stmt->execute();
while ($result = $stmt->fetch()) {
    if ($result['Claim_Status'] == '1') {
        $status = 'รอส่งเคลม';
        $date_add_return = 'วันที่รับเคลม : ' . DateThai($result['Claim_Date_Add']) . ' <br>'
                . 'วันที่ส่งคืนลูกค้า : - ';
    } else if ($result['Claim_Status'] == '2') {
        $status = 'ส่งเคลม';
        $date_add_return = 'วันที่รับเคลม : ' . DateThai($result['Claim_Date_Add']) . ' <br>'
                . 'วันที่ส่งคืนลูกค้า : - ';
    } else if ($result['Claim_Status'] == '3') {
        $status = 'รอส่งคืนลูกค้า';
        $date_add_return = 'วันที่รับเคลม : ' . DateThai($result['Claim_Date_Add']) . ' <br>'
                . 'วันที่ส่งคืนลูกค้า : - ';
    } else if ($result['Claim_Status'] == '4') {
        $status = 'ส่งคืนเรียบร้อย';
        $date_add_return = 'วันที่รับเคลม : ' . DateThai($result['Claim_Date_Add']) . ' <br>'
                . 'วันที่ส่งคืนลูกค้า : ' . DateThai($result['Claim_Date_C_Return']);
    }
    if ($result['Claim_Type'] == 'forshop') {
        $typec = "สินค้าเคลมของร้าน";
    } else if ($result['Claim_Type'] == 'forcus') {
        $typec = "ของลูกค้า";
    }

    $c_id = $result['ClaimItem_ID'];
    $detail = 'ชื่อสินค้า : ' . $result['ClaimItem_Name'] . '<br>'
            . 'S/N : ' . $result['S_ID'] . '<br>'
            . 'อาการเสีย : ' . $result['Claim_Manner'] . '<br>'
            . 'ประเภทการเคลม : ' . $typec . '<br>'
            . 'ชื่อลูกค้า : ' . $result['Cus_Name'] . '<br>'
            . 'ตัวแทนที่ส่งเคลม : ' . $result['Dealer_ID'];

    $arr['data'][] = array(
        $num,
        $c_id,
        $date_add_return,
        $detail,
        $status
    );
    $num++;
}
echo json_encode($arr);
?>