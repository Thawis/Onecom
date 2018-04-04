<?php

include '../../../lib/connect.php';
$sql = 'SELECT * FROM t_employee WHERE Emp_Status = "1" AND Emp_Type != "root" ORDER BY Emp_ID ASC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array('data' => array());
$num = 1;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //$del = '<button class="btn btn-danger btn-sm" onclick="clear_emp(\'' . $result['Emp_ID'] . '\')"><span class="fa fa-recycle"></span> ลบออกจากระบบ</button>';

    if ($result['Emp_Status'] == "1") {
        $status = '<span class="label bg-green-gradient" style="width:100px; font-size:12px; font-family:Tahoma;">ปกติ</span>';
    } else {
        $status = '<span class="label bg-red-gradient" style="width:100px; font-size:12px; font-family:Tahoma;">ยกเลิก</span>';
    }

    if ($result['Emp_Type'] == "admin") {
        $action = '<button class="btn bg-yellow-gradient btn-sm btn_u" value="'.$result['Emp_ID'].'"><span class="fa fa-refresh"></span> เปลี่ยนช่างทั่วไป</button>';
    } else if ($result['Emp_Type'] == "user") {
        $action = '<button class="btn bg-blue-gradient btn-sm btn_a" value="'.$result['Emp_ID'].'"><span class="fa fa-refresh"></span> เปลี่ยนเป็นหัวหน้าช่าง</button>';
    }
    //$callback = '<button class="btn btn-success btn-sm" onclick="return_emp(\'' . $result['Emp_ID'] . '\')"><span class="fa fa-refresh"></span> เปิดการใช้งาน</button>';
    $position = $result['Emp_Type'];
    if ($position == 'admin') {
        $type = '<span class="label bg-blue-gradient" style="width:100px; font-size:12px; font-family:Tahoma;">หัวหน้าช่าง</span>';
    } else if ($position == 'root') {
        $type = '<span class="label bg-green-gradient" style="width:100px; font-size:12px; font-family:Tahoma;">เจ้าของร้าน</span>';
    } else {
        $type = '<span class="label bg-yellow-gradient" style="width:100px; font-size:12px; font-family:Tahoma;">ช่างซ่อมทั่วไป</span>';
    }
    $arr['data'][] = array(
        $num,
        $result['Emp_ID'],
        $result['Emp_Name'],
        $type,
        $status,
        $action
    );
    $num++;
}
echo json_encode($arr);
?>