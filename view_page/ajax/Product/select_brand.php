<?php

session_start();
$user_type = $_SESSION['login_type'];
include '../../../lib/connect.php';
$sql = 'select * from t_brand';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array('data' => array());
$num = 1;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($user_type == "user") {
        if ($result['B_Status'] == '1') {
            $status = '<span class="label bg-green-gradient" style"font-size:14px; font-family:Tahoma;">ปกติ</span>';
            $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled=""> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลยี่ห้อสินค้า </button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalBrand-edit" class="modal-group" onclick="EditBrand(\'' . $result['B_ID'] . '\',\'' . $result['B_Name'] . '\');" ><span class="fa fa-gear"></span> แก้ไขข้อมูลยี่ห้อ</a></li>                                               
                                                <li><a onclick="CancelBrand(\'' . $result['B_ID'] . '\');" ><span class="fa fa-close"></span> ระงับการใช้งานยี่ห้อ</a></li>
                                            </ul>
                                        </div></center>';
        } else {
            $status = '<span class="label bg-red-gradient" style"font-size:14px; font-family:Tahoma;">ยกเลิก</span>';
            $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled=""> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลยี่ห้อสินค้า </button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalBrand-edit" class="modal-group" onclick="EditBrand(\'' . $result['B_ID'] . '\',\'' . $result['B_Name'] . '\');" ><span class="fa fa-gear"></span> แก้ไขข้อมูลยี่ห้อ</a></li>                                               
                                                <li><a onclick = "OpenBrand(\'' . $result['B_ID'] . '\');" ><span class = "fa fa-check"></span> เปิดใช้งานยี่ห้อ</a></li>
                                                <li><a onclick = "RemoveBrand(\'' . $result['B_ID'] . '\');" ><span class = "fa fa-recycle"></span> ลบยี่ห้อออกจากระบบ</a></li>
                                            </ul>
                                        </div></center>';
        }
    } else {
        if ($result['B_Status'] == '1') {
            $status = '<span class="label bg-green-gradient" style"font-size:14px; font-family:Tahoma;">ปกติ</span>';
            $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลยี่ห้อสินค้า </button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalBrand-edit" class="modal-group" onclick="EditBrand(\'' . $result['B_ID'] . '\',\'' . $result['B_Name'] . '\');" ><span class="fa fa-pencil"></span> แก้ไขข้อมูลยี่ห้อ</a></li>                                               
                                                <li><a href="#" onclick="CancelBrand(\'' . $result['B_ID'] . '\');" ><span class="fa fa-close"></span> ยกเลิกการใช้งานยี่ห้อ</a></li>
                                            </ul>
                                        </div></center>';
        } else {
            $status = '<span class="label bg-red-gradient" style"font-size:14px; font-family:Tahoma;">ยกเลิก</span>';
            $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลยี่ห้อสินค้า </button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalBrand-edit" class="modal-group" onclick="EditBrand(\'' . $result['B_ID'] . '\',\'' . $result['B_Name'] . '\');" ><span class="fa fa-pencil"></span> แก้ไขข้อมูลยี่ห้อ</a></li>                                               
                                                <li><a href="#" onclick = "OpenBrand(\'' . $result['B_ID'] . '\');" ><span class = "fa fa fa-circle-o"></span> เปิดใช้งานยี่ห้อ</a></li>
                                                <li><a href="#" onclick = "RemoveBrand(\'' . $result['B_ID'] . '\');" ><span class = "fa fa-warning"></span> ลบยี่ห้อออกจากระบบ</a></li>
                                            </ul>
                                        </div></center>';
        }
    }

    $arr['data'][] = array(
        $num,
        $result['B_ID'],
        $result['B_Name'],
        $status,
        $action,
    );
    $num++;
}
echo json_encode($arr)
?>

