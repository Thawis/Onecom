<?php

include '../../../lib/connect.php';
session_start();
$id = $_SESSION['login_id'];
//$userType = $_SESSION['login_type'];
//$id = $_GET['emp_id'];
//$id = 'Emp01';
$sql = 'select * from t_employee where Emp_Status = 1';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array('data' => array());
$num = 1;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //$action = '';

    if ($id == $result['Emp_ID'] || $result['Emp_Type'] == "root") {
        if ($result['Emp_Type'] == "root") {
            $action = '<center><div class="btn-group">
                                <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลพนักงาน </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" data-toggle="modal" data-target="#ModalDetail" onclick="setid(\'' . $result['Emp_ID'] . '\')"><span class="fa fa-info-circle"></span> รายละเอียด</a></li>
                                </ul>
                            </div></center>';
        } else {
            $action = '<center><div class="btn-group">
                                <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลพนักงาน </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" data-toggle="modal" data-target="#ModalDetail" onclick="setid(\'' . $result['Emp_ID'] . '\')"><span class="fa fa-info-circle"></span> รายละเอียด</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#ModalEdit" onclick="setid(\'' . $result['Emp_ID'] . '\')"><span class="fa fa-pencil"></span> แก้ไขข้อมูล</a></li>
                                </ul>
                            </div></center>';
        }
    } else {
        $action = '<center><div class="btn-group">
                                <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลพนักงาน </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" data-toggle="modal" data-target="#ModalDetail" onclick="setid(\'' . $result['Emp_ID'] . '\')"><span class="fa fa-info-circle"></span> รายละเอียด</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#ModalEdit" onclick="setid(\'' . $result['Emp_ID'] . '\')"><span class="fa fa-pencil"></span> แก้ไขข้อมูล</a></li>
                                    <li><a href="#" onclick="banemp(\'' . $result['Emp_ID'] . '\')"><span class="fa fa-user-times"></span> ระงับการใช้งาน</a></li>
                                </ul>
                            </div></center>';
    }




//    $num = $result['Emp_Status'];
//    $status;
//    if ($num == 1) {
//        $status = '<span class="label label-success">ปกติ</span>';
//    } else {
//        $status = '<span class="label label-danger">ยกเลิก</span>';
//    }
    $position = $result['Emp_Type'];
    if ($position == 'admin') {
        $type = '<span class="label bg-blue-gradient" style="width:100px; font-size:12px; font-family:Tahoma;">หัวหน้าช่าง</span>';
    } else if ($position == 'root') {
        $type = '<span class="label bg-green-gradient" style="width:100px; font-size:12px; font-family:Tahoma;">เจ้าของร้าน</span>';
    } else {
        $type = '<span class="label bg-yellow-gradient" style="width:100px; font-size:12px; font-family:Tahoma;">ช่างซ่อมทั่วไป</span>';
    }

    $gender = $result['Emp_Gender'];
    if ($gender == 'ชาย') {
        $sex = 'ชาย';
        //$sex = '<span class="label bg-teal-active color-palette" style="width:100px;">'.$result['Emp_Gender'].'</span>';
    } else if ($gender == 'หญิง') {
        //$sex = '<span class="label bg-maroon-active color-palette" style="width:100px;">'.$result['Emp_Gender'].'</span>';
        $sex = 'หญิง';
    }

    $arr['data'][] = array(
        $num,
        $result['Emp_ID'],
        $result['Emp_Name'],
        $sex,
        $type,
        //$status,
        $action,
    );
    $num++;
}
echo json_encode($arr)
?>