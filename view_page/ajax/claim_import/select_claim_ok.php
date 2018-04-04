<?php

session_start();
include '../../../lib/connect.php';
//$sql = 'SELECT * FROM t_claim tc JOIN t_claim_detail td ON tc.ClaimItem_ID = td.ClaimItem_ID WHERE tc.Claim_Status = "3" OR tc.Claim_Status = "4" ORDER BY tc.Number_Claim DESC ';
$sql = 'SELECT * FROM t_claim tc JOIN t_claim_detail td ON tc.ClaimItem_ID = td.ClaimItem_ID WHERE tc.Claim_Status = "3" OR tc.Claim_Status = "4" ORDER BY tc.Claim_Status ASC,tc.Number_Claim DESC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch()) {
    $mess = 'จากร้าน OneComputer ถึงคุณ' . $result['Cus_Name'] . ' สินค้าเคลมมาถึงร้านแล้ว';

    $detail = '<button type="button" class="btn bg-aqua-gradient btn_detail" style="font-size:12px; font-family:Tahoma;" value="' . $result['ClaimItem_ID'] . '">'
            . '<span class="fa fa-info-circle"></span> รายละเอียดเคลม</button>';

    if ($result['Claim_Type'] == "forshop") {
        $action2 = '<button type="button" class="btn bg-red-gradient btn_sms" value="' . $result['ClaimItem_ID'] . '" disabled=""> <span class="fa fa-comment-o"></span> SMS</button> '
                . '<button type="button" class="btn bg-green-gradient btn_return" style="font-size:14px; font-family: Tahoma;" value="' . $result['ClaimItem_ID'] . '" disabled="";> <span class="fa fa-exchange"></span> ส่งคืน</button>';
        if ($result['Claim_Status'] == "3") {
            $status = '<label class="label bg-blue-gradient" style="font-size:12px; font-family:Tahoma;">รอส่งคืนลูกค้า</label>';
        } else if ($result['Claim_Status'] == "4") {
            $status = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma;">ส่งคืนเรียบร้อย</label>';
        }
    } else if ($result['Claim_Type'] == "forcus") {
        if ($result['Claim_Status'] == "3") {
            $action2 = '<button type="button" class="btn bg-red-gradient btn_sms" onclick="sendSMS(\'' . $result['Cus_Tel'] . '\',\'' . $mess . '\',\'' . $result['ClaimItem_ID'] . '\')"> <span class="fa fa-comment-o"></span> SMS</button> '
                    . '<button type="button" class="btn bg-green-gradient btn_return" style="font-size:14px; font-family: Tahoma;" value="' . $result['ClaimItem_ID'] . '"> <span class="fa fa-exchange"></span> ส่งคืน</button>';
            $status = '<label class="label bg-blue-gradient" style="font-size:12px; font-family:Tahoma;">รอส่งคืนลูกค้า</label>';
        } else if ($result['Claim_Status'] == "4") {
            $status = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma;">ส่งคืนเรียบร้อย</label>';
            $action2 = '<button type="button" class="btn bg-red-gradient btn_sms" value="' . $result['ClaimItem_ID'] . '" disabled=""> <span class="fa fa-comment-o"></span> SMS</button> '
                    . '<button type="button" class="btn bg-green-gradient btn_return" style="font-size:14px; font-family: Tahoma;" value="' . $result['ClaimItem_ID'] . '" disabled="";> <span class="fa fa-exchange"></span> ส่งคืน</button>';
        }
    }

    if ($_SESSION['login_type'] == 'user' && $result['Claim_Status'] == "3") {
        $action2 = '<button type="button" class="btn bg-red-gradient btn_sms" value="' . $result['ClaimItem_ID'] . '" disabled=""> <span class="fa fa-comment-o"></span> SMS</button> '
                . '<button type="button" class="btn bg-green-gradient btn_return" style="font-size:14px; font-family: Tahoma;" value="' . $result['ClaimItem_ID'] . '"> <span class="fa fa-exchange"></span> ส่งคืน</button>';
    }

    $arr['data'][] = array(
        $num,
        $result['ClaimItem_ID'],
        $result['Cus_Name'],
        $status,
        $detail,
        $action2,
    );
    $num++;
}
echo json_encode($arr);
?>