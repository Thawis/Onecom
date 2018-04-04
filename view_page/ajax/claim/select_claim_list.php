<?php

session_start();
include '../../../lib/connect.php';
$userType = $_SESSION['login_type'];
$sql = "SELECT * FROM t_claim WHERE Claim_Status != '0' Order by Claim_Status ASC ";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch()) {
    if ($result['Claim_Type'] == "forshop") {
        $c_type = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma;">สินค้าเคลมของร้าน</label>';
    } else if ($result['Claim_Type'] == "forcus") {
        $c_type = '<label class="label bg-blue-gradient" style="font-size:12px; font-family:Tahoma;">ของลูกค้า</label>';
    }

    if ($userType == "user") {
        if ($result['Claim_Status'] == "1") {
            $action3 = '<button type="button" class="btn bg-green-gradient btn_send" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '"><span class="fa fa-truck"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_c" value="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-pencil"></span></button> '
                    . '<button type="button" class="btn bg-red-gradient btn_cancel_c" value="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-close"></span></button>';
            $status = '<label class="label bg-red-gradient" style="font-size:12px; font-family:Tahoma;">รอส่งเคลม</label>';
            $detail = '<button type="button" class="btn bg-aqua-gradient btn_c_detail" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '"> รายละเอียด </button>';
        } else if ($result['Claim_Status'] == "2") {
            $action3 = '<button type="button" class="btn bg-green-gradient btn_send" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-truck"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_c" value="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-pencil"></span></button> '
                    . '<button type="button" class="btn bg-red-gradient btn_cancel_c" value="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-close"></span></button>';
            $status = '<label class="label bg-yellow-gradient" style="font-size:12px; font-family:Tahoma;">ส่งเคลม</label>';
            $detail = '<button type="button" class="btn bg-aqua-gradient btn_c_detail" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '"> รายละเอียด </button>';
        } else if ($result['Claim_Status'] == "3") {
            $action3 = '<button type="button" class="btn bg-green-gradient btn_send" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-truck"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_c" value="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-pencil"></span></button> '
                    . '<button type="button" class="btn bg-red-gradient btn_cancel_c" value="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-close"></span></button>';
            $status = '<label class="label bg-blue-gradient" style="font-size:12px; font-family:Tahoma;">รอส่งคืนลูกค้า</label>';
            $detail = '<button type="button" class="btn bg-aqua-gradient btn_c_detail" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '"> รายละเอียด </button>';
        } else if ($result['Claim_Status'] == "4") {
            $action3 = '<button type="button" class="btn bg-green-gradient btn_send" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-truck"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_c" value="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-pencil"></span></button> '
                    . '<button type="button" class="btn bg-red-gradient btn_cancel_c" value="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-close"></span></button>';
            $status = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma;">ส่งคืนเรียบร้อย</label>';
            $detail = '<button type="button" class="btn bg-aqua-gradient btn_c_detail" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '"> รายละเอียด </button>';
        }
    } else {
        if ($result['Claim_Status'] == "1") {
            $action3 = '<button type="button" class="btn bg-green-gradient btn_send" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '"><span class="fa fa-truck"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_c" value="' . $result['ClaimItem_ID'] . '"><span class="fa fa-pencil"></span></button> '
                    . '<button type="button" class="btn bg-red-gradient btn_cancel_c" value="' . $result['ClaimItem_ID'] . '"><span class="fa fa-close"></span></button>';
            $status = '<label class="label bg-red-gradient" style="font-size:12px; font-family:Tahoma;">รอส่งเคลม</label>';
            $detail = '<button type="button" class="btn bg-aqua-gradient btn_c_detail" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '"> รายละเอียด </button>';
        } else if ($result['Claim_Status'] == "2") {
            $action3 = '<button type="button" class="btn bg-green-gradient btn_send" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-truck"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_c" value="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-pencil"></span></button> '
                    . '<button type="button" class="btn bg-red-gradient btn_cancel_c" value="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-close"></span></button>';
            $status = '<label class="label bg-yellow-gradient" style="font-size:12px; font-family:Tahoma;">ส่งเคลม</label>';
            $detail = '<button type="button" class="btn bg-aqua-gradient btn_c_detail" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '"> รายละเอียด </button>';
        } else if ($result['Claim_Status'] == "3") {
            $action3 = '<button type="button" class="btn bg-green-gradient btn_send" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-truck"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_c" value="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-pencil"></span></button> '
                    . '<button type="button" class="btn bg-red-gradient btn_cancel_c" value="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-close"></span></button>';
            $status = '<label class="label bg-blue-gradient" style="font-size:12px; font-family:Tahoma;">รอส่งคืนลูกค้า</label>';
            $detail = '<button type="button" class="btn bg-aqua-gradient btn_c_detail" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '"> รายละเอียด </button>';
        } else if ($result['Claim_Status'] == "4") {
            $action3 = '<button type="button" class="btn bg-green-gradient btn_send" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-truck"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_c" value="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-pencil"></span></button> '
                    . '<button type="button" class="btn bg-red-gradient btn_cancel_c" value="' . $result['ClaimItem_ID'] . '" disabled=""><span class="fa fa-close"></span></button>';
            $status = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma;">ส่งคืนเรียบร้อย</label>';
            $detail = '<button type="button" class="btn bg-aqua-gradient btn_c_detail" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '"> รายละเอียด </button>';
        }
    }
        $action4 = $action3.' <button type="button" class="btn bg-yellow-gradient btn_c_bill" style="font-size:12px; font-family:Tahoma;" value ="' . $result['ClaimItem_ID'] . '"><span class="fa fa-print"></span></button>';


    $arr['data'][] = array(
        $num,
        $result['ClaimItem_ID'],
        $result['Cus_Name'],
        $status,
        $c_type,
        $detail,
        $action4,
    );
    $num++;
}
echo json_encode($arr);
?>