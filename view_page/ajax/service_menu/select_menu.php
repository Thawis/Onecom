<?php

include '../../../lib/connect.php';
$sql = 'SELECT * FROM t_service_menu ORDER BY Service_Type DESC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch()) {
    if ($result['Service_Status'] == "1") {
        $status = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma;">ปกติ</label>';
        $action = '<center><div class="btn-group">
                                <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span>  จัดการเมนูซ่อม </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" onclick="edit_menu(\'' . $result['Service_ID'] . '\')"><span class="fa fa-pencil"></span> แก้ไขข้อมูล</a></li>
                                    <li><a href="#" onclick="cancel_menu(\'' . $result['Service_ID'] . '\')"><span class="fa fa-close"></span> ยกเลิก</a></li>
                                </ul>
                            </div></center>';
    } else if ($result['Service_Status'] == "0") {
        $status = '<label class="label bg-red-gradient" style="font-size:12px; font-family:Tahoma;">ยกเลิก</label>';
        $action = '<center><div class="btn-group">
                                <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span>  จัดการเมนูซ่อม </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" onclick="open_menu(\'' . $result['Service_ID'] . '\')"><span class="fa fa-circle-o"></span> เปิดใช้</a></li>
                                    <li><a href="#" onclick="remove_menu(\'' . $result['Service_ID'] . '\')"><span class="fa fa-warning"></span> ลบออกจากระบบ</a></li>
                                </ul>
                            </div></center>';
    }
    //$action = '';
    if ($result['Service_Type'] == "PC") {
        $type = '<label class="label bg-blue-gradient" style="font-size:12px; font-family:Tahoma;">PC</label>';
    } else if ($result['Service_Type'] == "NB") {
        $type = '<label class="label bg-yellow-gradient" style="font-size:12px; font-family:Tahoma;">NB</label>';
    } else if ($result['Service_Type'] == "All") {
        $type = '<label class="label bg-orange" style="font-size:12px; font-family:Tahoma;">ทั้งหมด</label>';
    }

    $arr['data'][] = array(
        $num,
        $result['Service_ID'],
        $result['Service_Menu'],
        $result['Service_Price'],
        $type,
        $status,
        $action,
    );
    $num++;
}
echo json_encode($arr)
?>