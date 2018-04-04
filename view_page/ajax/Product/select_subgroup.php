<?php

session_start();
$user_type = $_SESSION['login_type'];
include '../../../lib/connect.php';
//$sql = 'select SG_ID,SG_Name,G_Name,SG_Status,G_Status,tgp.G_ID from t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID WHERE tgp.G_Status = "1"';
$sql = 'select * from t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID WHERE tgp.G_Status = "1"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array('data' => array());
$num = 1;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($user_type == "user") {
        if ($result['SG_Status'] == '1') {
            $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled=""> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลประเภทสินค้า </button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalSub-edit" class="modal-group" onclick="EditSub(\'' . $result['SG_ID'] . '\',\'' . $result['SG_Name'] . '\',\'' . $result['G_ID'] . '\');" ><span class="fa fa-gear"></span> แก้ไขข้อมูลประเภทสินค้า</a></li>
                                                <li><a onclick="CancelSub(\'' . $result['SG_ID'] . '\');" ><span class="fa fa-close"></span> ระงับการใช้งานประเภทสินค้า</a></li>
                                            </ul>
                                        </div></center>';
        } else if ($result['SG_Status'] == '0') {
            $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled=""> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลประเภทสินค้า </button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalSub-edit" class="modal-group" onclick="EditSub(\'' . $result['SG_ID'] . '\',\'' . $result['SG_Name'] . '\',\'' . $result['G_ID'] . '\');" ><span class="fa fa-gear"></span> แก้ไขข้อมูลประเภทสินค้า</a></li>
                                                <li><a onclick="OpenSub(\'' . $result['SG_ID'] . '\');" ><span class="fa fa-check"></span> เปิดใช้งานประเภทสินค้า</a></li>
                                                <li><a onclick="RemoveSub(\'' . $result['SG_ID'] . '\');" ><span class="fa fa-recycle"></span> ลบออกจากระบบ</a></li>
                                            </ul>
                                        </div></center>';
        }
    } else {
        if ($result['SG_Status'] == '1') {
            $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลประเภทสินค้า </button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalSub-edit" class="modal-group" onclick="EditSub(\'' . $result['SG_ID'] . '\',\'' . $result['SG_Name'] . '\',\'' . $result['G_ID'] . '\');" ><span class="fa fa-pencil"></span> แก้ไขข้อมูลประเภทสินค้า</a></li>
                                                <li><a href="#" onclick="CancelSub(\'' . $result['SG_ID'] . '\');" ><span class="fa fa-close"></span> ยกเลิกการใช้งานประเภทสินค้า</a></li>
                                            </ul>
                                        </div></center>';
        } else if ($result['SG_Status'] == '0') {
            $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลประเภทสินค้า </button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalSub-edit" class="modal-group" onclick="EditSub(\'' . $result['SG_ID'] . '\',\'' . $result['SG_Name'] . '\',\'' . $result['G_ID'] . '\');" ><span class="fa fa-gear"></span> แก้ไขข้อมูลประเภทสินค้า</a></li>
                                                <li><a href="#" onclick="OpenSub(\'' . $result['SG_ID'] . '\');" ><span class="fa fa-circle-o"></span> เปิดใช้งานประเภทสินค้า</a></li>
                                                <li><a href="#" onclick="RemoveSub(\'' . $result['SG_ID'] . '\');" ><span class="fa fa-warning"></span> ลบออกจากระบบ</a></li>
                                            </ul>
                                        </div></center>';
        }
    }


    $status;
    if ($result['SG_Status'] == '1') {
        $status = '<span class="label bg-green-gradient" style"font-size:14px; font-family:Tahoma;">ปกติ</span>';
    } else {
        $status = '<span class="label bg-red-gradient" style"font-size:14px; font-family:Tahoma;">ยกเลิก</span>';
    }



    $arr['data'][] = array(
        $num,
        $result['SG_ID'],
        $result['SG_Name'],
        $result['G_Name'],
        $status,
        $action,
    );
    $num++;
}
echo json_encode($arr)
?>

