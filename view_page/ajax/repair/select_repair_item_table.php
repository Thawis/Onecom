<?php

include '../../../lib/connect.php';
session_start();
$type = $_SESSION['login_type'];
$rid = $_POST['r_id'];
$sql = 'SELECT * FROM t_repair tr JOIN t_repair_item tri ON tr.R_ID = tri.R_ID WHERE tr.R_ID = "' . $rid . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
//num = 1;
while ($result = $stmt->fetch()) {
    if ($type == "admin" || $type == "root") {
        if ($result['Item_Status'] == "0") {
            $status = '<label class="label bg-red-gradient" style="font-size: 12px; font-family: Tahoma;">ยกเลิกซ่อม</label>';
            $action = '<button type="button" class="btn bg-aqua-gradient btn_detail_item" value="' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_item" value="' . $result['Item_ID'] . '"><span class="fa fa-pencil"></span></button> '
                    . '<button type="button" class="btn bg-red-gradient btn_cancel_item" value="' . $result['Item_ID'] . '" disabled=""><span class="fa fa-close"></span></button> ';
        } else if ($result['Item_Status'] == "1") {
            $status = '<label class="label label-warning" style="font-size: 12px; font-family: Tahoma;">รอซ่อม</label>';
            $action = '<button type="button" class="btn bg-aqua-gradient btn_detail_item" value="' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_item" value="' . $result['Item_ID'] . '"><span class="fa fa-pencil"></span></button> '
                    . '<button type="button" class="btn bg-red-gradient btn_cancel_item" value="' . $result['Item_ID'] . '"><span class="fa fa-close"></span></button> ';
        } else if ($result['Item_Status'] == "2") {
            $status = '<label class="label label-primary" style="font-size: 12px; font-family: Tahoma;">อยู่ระหว่างซ่อม</label>';
            $action = '<button type="button" class="btn bg-aqua-gradient btn_detail_item" value="' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_item" value="' . $result['Item_ID'] . '" disabled="" ><span class="fa fa-pencil"></span></button> '
                    . '<button type="button" class="btn bg-red-gradient btn_cancel_item" value="' . $result['Item_ID'] . '" disabled=""><span class="fa fa-close"></span></button>';
        } else if ($result['Item_Status'] == "3") {
            $status = '<label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">ซ่อมเรียบร้อย</label>';
            $action = '<button type="button" class="btn bg-aqua-gradient btn_detail_item" value="' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_item" value="' . $result['Item_ID'] . '" disabled="" ><span class="fa fa-pencil"></span></button> '
                    . '<button type="button" class="btn bg-red-gradient btn_cancel_item" value="' . $result['Item_ID'] . '" disabled=""><span class="fa fa-close"></span></button>';
        } else if ($result['Item_Status'] == "4") {
            $status = '<label class="label bg-aqua-gradient" style="font-size: 12px; font-family: Tahoma;">ส่งคืนเรียบร้อย</label>';
            $action = '<button type="button" class="btn bg-aqua-gradient btn_detail_item" value="' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_item" value="' . $result['Item_ID'] . '" disabled="" ><span class="fa fa-pencil"></span></button> '
                    . '<button type="button" class="btn bg-red-gradient btn_cancel_item" value="' . $result['Item_ID'] . '" disabled=""><span class="fa fa-close"></span></button>';
        }
    } else if ($type == "user") {
        if ($result['Item_Status'] == "0") {
            $status = '<label class="label bg-red-gradient" style="font-size: 12px; font-family: Tahoma;">ยกเลิกซ่อม</label>';
            $action = '<button type="button" class="btn bg-aqua-gradient btn_detail_item" value="' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_item" value="' . $result['Item_ID'] . '"><span class="fa fa-pencil"></span></button> ';
        } else if ($result['Item_Status'] == "1") {
            $status = '<label class="label label-warning" style="font-size: 12px; font-family: Tahoma;">รอซ่อม</label>';
            $action = '<button type="button" class="btn bg-aqua-gradient btn_detail_item" value="' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_item" value="' . $result['Item_ID'] . '"><span class="fa fa-pencil"></span></button> ';
        } else if ($result['Item_Status'] == "2") {
            $status = '<label class="label label-primary" style="font-size: 12px; font-family: Tahoma;">อยู่ระหว่างซ่อม</label>';
            $action = '<button type="button" class="btn bg-aqua-gradient btn_detail_item" value="' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_item" value="' . $result['Item_ID'] . '" disabled="" ><span class="fa fa-pencil"></span></button> ';
        } else if ($result['Item_Status'] == "3") {
            $status = '<label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">ซ่อมเรียบร้อย</label>';
            $action = '<button type="button" class="btn bg-aqua-gradient btn_detail_item" value="' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_item" value="' . $result['Item_ID'] . '" disabled="" ><span class="fa fa-pencil"></span></button> ';
        } else if ($result['Item_Status'] == "4") {
            $status = '<label class="label bg-aqua-gradient" style="font-size: 12px; font-family: Tahoma;">ส่งคืนเรียบร้อย</label>';
            $action = '<button type="button" class="btn bg-aqua-gradient btn_detail_item" value="' . $result['Item_ID'] . '"><span class="fa fa-info-circle"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient btn_edit_item" value="' . $result['Item_ID'] . '" disabled="" ><span class="fa fa-pencil"></span></button> ';
        }
    }
    $arr["data"][] = array(
        //$num,
        $result['Item_ID'],
        $result['Item_Name'],
        $result['Item_SN'],
        $result['Item_manner'],
        $status,
        $action
    );
    //$num++;
}
echo json_encode($arr);
?>