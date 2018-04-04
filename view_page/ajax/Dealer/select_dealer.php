<?php

include '../../../lib/connect.php';
$sql = 'SELECT * FROM t_dealer';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array('data' => array());
$num = 1;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $tel = getTel($result['Dealer_Tel']);
    if ($result['Dealer_Status'] == '1') {
        $status = '<span class="label bg-green-gradient" style="width:100px; font-size:12px; font-family: Tahoma;">ปกติ</span>';
        $action = '<center><div class="btn-group">
                                <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลตัวแทน </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" data-toggle="modal" data-target="#ModalDetail" onclick="setid(\'' . $result['Dealer_ID'] . '\')"><span class="fa fa-user"></span> รายละเอียด</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#ModalEdit" onclick="setid(\'' . $result['Dealer_ID'] . '\')"><span class="fa fa-pencil"></span> แก้ไขข้อมูล</a></li>
                                    <li><a href="#" onclick="cancel_dealer(\'' . $result['Dealer_ID'] . '\')"><span class="fa fa-close"></span> ยกเลิก</a></li>
                                </ul>
                            </div></center>';
    } else {
        $status = '<span class="label bg-red-gradient" style="width:100px; font-size:12px; font-family: Tahoma;">ยกเลิก</span>';
        $action = '<center><div class="btn-group">
                                <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลตัวแทน </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" data-toggle="modal" data-target="#ModalDetail" onclick="setid(\'' . $result['Dealer_ID'] . '\')"><span class="fa fa-user"></span> รายละเอียด</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#ModalEdit" onclick="setid(\'' . $result['Dealer_ID'] . '\')"><span class="fa fa-pencil"></span> แก้ไขข้อมูล</a></li>
                                    <li><a href="#" onclick="open_dealer(\'' . $result['Dealer_ID'] . '\')"><span class="fa fa-circle-o"></span> เปิดใช้งาน</a></li>
                                </ul>
                            </div></center>';
    }

    $arr['data'][] = array(
        $num,
        $result['Dealer_ID'],
        $result['Dealer_Name'],
        $result['Dealer_Company'],
        $tel,
        $status,
        $action,
    );
    $num++;
}

echo json_encode($arr);

function getTel($tel) {
    $f1 = substr($tel, 0, 3) . '-';
    $f2 = substr($tel, 3, 3) . '-';
    $f3 = substr($tel, 6, 4);
    return $f1 . $f2 . $f3;
}

;
?>