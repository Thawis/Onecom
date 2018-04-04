<?php
session_start();
include '../../../lib/connect.php';
$type = $_POST['type'];
$status = $_POST['status'];
$_SESSION['R_emp_type'] = $type;
$_SESSION['R_emp_status'] = $status;

$arr = array("data" => array());
$sql = '';
$num = 1;
if ($type == "All") {
    if ($status == "All") {
        $sql = 'SELECT * FROM t_employee';
    } else {
        $sql = 'SELECT * FROM t_employee WHERE Emp_Status = "' . $status . '"';
    }
} else if ($type != "All") {
    if ($status == "All") {
        $sql = 'SELECT * FROM t_employee WHERE Emp_Type = "' . $type . '"';
    } else {
        $sql = 'SELECT * FROM t_employee WHERE Emp_Status = "' . $status . '" AND Emp_Type = "' . $type . '"';
    }
}
$stmt = $dbh->prepare($sql);
$stmt->execute();
while ($result = $stmt->fetch()) {
    if ($result['Emp_Type'] == "root") {
        $userType = 'เจ้าของร้าน';
    } else if ($result['Emp_Type'] == "admin") {
        $userType = 'หัวหน้าช่าง';
    } else if ($result['Emp_Type'] == "user") {
        $userType = 'ช่างซ่อมทั่วไป';
    }

    if ($result['Emp_Status'] == '1') {
        $userStatus = 'ปกติ';
    }else{
        $userStatus = 'ยกเลิก';
    }


    $arr['data'][] = array(
        $num,
        $result['Emp_ID'],
        $result['Emp_Name'],
        $result['Emp_Gender'],
        $userType,
        $userStatus
    );
    $num++;
}
echo json_encode($arr);
?>