<?php

session_start();
$user_type = $_SESSION['login_type'];
include '../../../lib/connect.php';
$sql = 'SELECT * FROM t_group_product';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array('data' => array());
$num = 1;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($user_type == "user") {
        if ($result['G_Status'] == '1') {
            $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled=""> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลประเภทสินค้า </button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalGroup-edit" class="modal-group" onclick="EditGroup(\'' . $result['G_ID'] . '\',\'' . $result['G_Name'] . '\');" ><span class="fa fa-gear"></span> แก้ไขข้อมูลประเภทสินค้า</a></li>
                                                <li><a onclick="CancelGroup(\'' . $result['G_ID'] . '\');" ><span class="fa fa-close"></span> ระงับการใช้งานประเภทสินค้า</a></li>
                                            </ul>
                                        </div></center>';
        } else if ($result['G_Status'] == '0') {
            $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled=""> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลประเภทสินค้า </button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalGroup-edit" class="modal-group" onclick="EditGroup(\'' . $result['G_ID'] . '\',\'' . $result['G_Name'] . '\');" ><span class="fa fa-gear"></span> แก้ไขข้อมูลประเภทสินค้า</a></li>
                                                <li><a onclick="OpenGroup(\'' . $result['G_ID'] . '\');" ><span class="fa fa-check"></span> เปิดใช้งานประเภทสินค้า</a></li>
                                                <li><a onclick="RemoveGroup(\'' . $result['G_ID'] . '\')"><span class="fa fa-recycle"></span> ลบออกจากระบบ</a><li>
                                            </ul>
                                        </div></center>';
        }
    } else {
        if ($result['G_Status'] == '1') {
            $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลประเภทสินค้า </button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalGroup-edit" class="modal-group" onclick="EditGroup(\'' . $result['G_ID'] . '\',\'' . $result['G_Name'] . '\');" ><span class="fa fa-pencil"></span> แก้ไขข้อมูลประเภทสินค้า</a></li>
                                                <li><a href="#" onclick="CancelGroup(\'' . $result['G_ID'] . '\');" ><span class="fa fa-close"></span> ยกเลิกการใช้งานประเภทสินค้า</a></li>
                                            </ul>
                                        </div></center>';
        } else if ($result['G_Status'] == '0') {
            $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลประเภทสินค้า </button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalGroup-edit" class="modal-group" onclick="EditGroup(\'' . $result['G_ID'] . '\',\'' . $result['G_Name'] . '\');" ><span class="fa fa-pencil"></span> แก้ไขข้อมูลประเภทสินค้า</a></li>
                                                <li><a href="#" onclick="OpenGroup(\'' . $result['G_ID'] . '\');" ><span class="fa fa-circle-o"></span> เปิดใช้งานประเภทสินค้า</a></li>
                                                <li><a href="#" onclick="RemoveGroup(\'' . $result['G_ID'] . '\')"><span class="fa fa-warning"></span> ลบออกจากระบบ</a><li>
                                            </ul>
                                        </div></center>';
        }
    }




    $status;
    if ($result['G_Status'] == '1') {
        $status = '<span class="label bg-green-gradient" style"font-size:14px; font-family:Tahoma;">ปกติ</span>';
    } else {
        $status = '<span class="label bg-red-gradient" style"font-size:14px; font-family:Tahoma;">ยกเลิก</span>';
    }


    $arr['data'][] = array(
        $num,
        $result['G_ID'],
        $result['G_Name'],
        $status,
        $action,
    );
    $num++;
}
echo json_encode($arr)
?>

