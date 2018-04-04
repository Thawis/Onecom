<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
session_start();
$emp_id = $_SESSION['login_id'];
$sql = 'SELECT Item_ID,Item_Status,Type_Item,Item_Name,Item_manner,tr.R_DATE FROM t_repair tr JOIN t_repair_item tri ON tr.R_ID = tri.R_ID '
        . 'WHERE Item_Status = "2" AND Emp_ID = "' . $emp_id . '"  ORDER BY Item_Number DESC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch()) {
    $date_work = DateThaiTime($result['R_DATE']);
    if ($result['Type_Item'] == "PC-Case") {
        $itemType = '<label class="label bg-yellow-gradient" style="font-size: 12px; font-family: Tahoma;">' . $result['Type_Item'] . '</label>';
    } else if ($result['Type_Item'] == "NoteBook") {
        $itemType = '<label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">' . $result['Type_Item'] . '</label>';
    } else if ($result['Type_Item'] == "ETC") {
        $itemType = '<label class="label bg-red-gradient" style="font-size: 12px; font-family: Tahoma;">' . $result['Type_Item'] . '</label>';
    }

    $sql_rows = 'SELECT * FROM t_repair_case WHERE Item_ID = "' . $result['Item_ID'] . '"';
    $stmt_rows = $dbh->prepare($sql_rows);
    $stmt_rows->execute();
    $rows = $stmt_rows->rowCount();


    if ($rows == 0) {
        $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-aqua-gradient btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-chevron-circle-down"></span> จัดการซ่อม</button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a href="M_Repair_Record.php?item_id=' . $result['Item_ID'] . '"><span class="fa fa-plus"></span> บันทึกงานซ่อม</a></li>
                                                <li><a href="#" onclick="setCancel(\'' . $result['Item_ID'] . '\')"><span class="fa fa-close"></span> ยกเลิกงานซ่อม</a></li>
                                            </ul>
                                        </div></center>';
    } else {
        $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-aqua-gradient btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-chevron-circle-down"></span> จัดการซ่อม</button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a href="M_Repair_Record.php?item_id=' . $result['Item_ID'] . '"><span class="fa fa-cog"></span> แก้ไขงานซ่อม</a></li>
                                                <li><a href="#" onclick="setCancel2(\'' . $result['Item_ID'] . '\')"><span class="fa fa-close"></span> ยกเลิกงานซ่อม</a></li>
                                            </ul>
                                        </div></center>';
    }


    
    
    $arr['data'][] = array(
        $num,
        $result['Item_ID'],
        $itemType,
        $result['Item_Name'],
        $result['Item_manner'],
        $date_work,
        $action,
    );
    $num++;
}
echo json_encode($arr);
?>
