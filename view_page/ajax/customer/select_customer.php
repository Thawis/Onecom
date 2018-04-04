<?php

session_start();
include '../../../lib/connect.php';
$sql = 'SELECT * FROM t_customer WHERE Customer_ID != "เงินสด"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
$user_type = $_SESSION['login_type'];
while ($result = $stmt->fetch()) {

    if ($user_type == 'user') {
        if ($result['Customer_Surname'] == "company") {
            $type = '<label class="label bg-blue-gradient" style="font-size:12px; font-family:Tahoma">บริษัท</label>';
            $detail = '<button type="button" class="btn bg-aqua-gradient btn_detail" style="font-size:12px; font-family:Tahoma;" value="' . $result['Customer_ID'] . '"><span class="fa fa-info-circle"></span> รายละเอียด</button>';
            if ($result['Customer_Status'] == "1") {
                $action2 = '<button type="button" class="btn bg-yellow-gradient btn_edit_c" value="' . $result['Customer_ID'] . '" disabled=""><span class="fa fa-pencil"></span></button> '
                        . '<button type="button" class="btn bg-red-gradient btn_cancel" value="' . $result['Customer_ID'] . '" disabled=""><span class="fa fa-close"></span></button>';
            } else if ($result['Customer_Status'] == "0") {
                $action2 = '<button type="button" class="btn bg-yellow-gradient btn_edit_c" value="' . $result['Customer_ID'] . '" disabled=""><span class="fa fa-pencil" ></span></button> '
                        . '<button type="button" class="btn bg-green-gradient btn_open" value="' . $result['Customer_ID'] . '" disabled=""><span class="fa fa-circle-o"></span></button>';
            }
        } else {
            $type = '<label class="label bg-yellow-gradient" style="font-size:12px; font-family:Tahoma">บุคคล</label>';
            $detail = '<button type="button" class="btn bg-aqua-gradient btn_detail" style="font-size:12px; font-family:Tahoma;" value="' . $result['Customer_ID'] . '"><span class="fa fa-info-circle"></span> รายละเอียด</button>';
            if ($result['Customer_Status'] == "1") {
                $action2 = '<button type="button" class="btn bg-yellow-gradient btn_edit_p" value="' . $result['Customer_ID'] . '" disabled=""><span class="fa fa-pencil"></span></button> '
                        . '<button type="button" class="btn bg-red-gradient btn_cancel" value="' . $result['Customer_ID'] . '" disabled=""><span class="fa fa-close"></span></button>';
            } else if ($result['Customer_Status'] == "0") {
                $action2 = '<button type="button" class="btn bg-yellow-gradient btn_edit_p" value="' . $result['Customer_ID'] . '" disabled=""><span class="fa fa-pencil" ></span></button> '
                        . '<button type="button" class="btn bg-green-gradient btn_open" value="' . $result['Customer_ID'] . '" disabled=""><span class="fa fa-circle-o"></span></button>';
            }
        }
        if ($result['Customer_Status'] == "1") {
            $status = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma">ปกติ</label>';
        } else {
            $status = '<label class="label bg-red-gradient" style="font-size:12px; font-family:Tahoma">ยกเลิก</label>';
        }
    } else {
        if ($result['Customer_Surname'] == "company") {
            $type = '<label class="label bg-blue-gradient" style="font-size:12px; font-family:Tahoma">บริษัท</label>';
            $detail = '<button type="button" class="btn bg-aqua-gradient btn_detail" style="font-size:12px; font-family:Tahoma;" value="' . $result['Customer_ID'] . '"><span class="fa fa-info-circle"></span> รายละเอียด</button>';
            if ($result['Customer_Status'] == "1") {
                $action2 = '<button type="button" class="btn bg-yellow-gradient btn_edit_c" value="' . $result['Customer_ID'] . '"><span class="fa fa-pencil"></span></button> '
                        . '<button type="button" class="btn bg-red-gradient btn_cancel" value="' . $result['Customer_ID'] . '"><span class="fa fa-close"></span></button>';
            } else if ($result['Customer_Status'] == "0") {
                $action2 = '<button type="button" class="btn bg-yellow-gradient btn_edit_c" value="' . $result['Customer_ID'] . '" disabled=""><span class="fa fa-pencil" ></span></button> '
                        . '<button type="button" class="btn bg-green-gradient btn_open" value="' . $result['Customer_ID'] . '"><span class="fa fa-circle-o"></span></button>';
            }
        } else {
            $type = '<label class="label bg-yellow-gradient" style="font-size:12px; font-family:Tahoma">บุคคล</label>';
            $detail = '<button type="button" class="btn bg-aqua-gradient btn_detail" style="font-size:12px; font-family:Tahoma;" value="' . $result['Customer_ID'] . '"><span class="fa fa-info-circle"></span> รายละเอียด</button>';
            if ($result['Customer_Status'] == "1") {
                $action2 = '<button type="button" class="btn bg-yellow-gradient btn_edit_p" value="' . $result['Customer_ID'] . '"><span class="fa fa-pencil"></span></button> '
                        . '<button type="button" class="btn bg-red-gradient btn_cancel" value="' . $result['Customer_ID'] . '"><span class="fa fa-close"></span></button>';
            } else if ($result['Customer_Status'] == "0") {
                $action2 = '<button type="button" class="btn bg-yellow-gradient btn_edit_p" value="' . $result['Customer_ID'] . '" disabled=""><span class="fa fa-pencil" ></span></button> '
                        . '<button type="button" class="btn bg-green-gradient btn_open" value="' . $result['Customer_ID'] . '"><span class="fa fa-circle-o"></span></button>';
            }
        }
        if ($result['Customer_Status'] == "1") {
            $status = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma">ปกติ</label>';
        } else {
            $status = '<label class="label bg-red-gradient" style="font-size:12px; font-family:Tahoma">ยกเลิก</label>';
        }
    }




    $arr['data'][] = array(
        $num,
        $result['Customer_ID'],
        $result['Customer_FullName'],
        $type,
        $status,
        $detail,
        $action2,
    );
    $num++;
}
echo json_encode($arr);
?>