<?php

include '../../../lib/connect.php';
$sql = 'SELECT * FROM t_employee WHERE Emp_Status = "0" ORDER BY Emp_ID ASC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array('data' => array());
$num = 1;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $del = '<button class="btn btn-danger btn-sm" onclick="clear_emp(\'' . $result['Emp_ID'] . '\')"><span class="fa fa-recycle"></span> ลบออกจากระบบ</button>';
    $callback = '<button class="btn btn-success btn-sm" onclick="return_emp(\'' . $result['Emp_ID'] . '\')"><span class="fa fa-refresh"></span> เปิดการใช้งาน</button>';

    $position = $result['Emp_Type'];
    if ($position == 'admin') {
        $type = '<span class="label bg-blue-gradient" style="width:100px; font-size:12px; font-family:Tahoma;">หัวหน้าช่าง</span>';
    } else if($position == 'root') {
        $type = '<span class="label bg-green-gradient" style="width:100px; font-size:12px; font-family:Tahoma;">เจ้าของร้าน</span>';
    }else{
        $type = '<span class="label bg-yellow-gradient" style="width:100px; font-size:12px; font-family:Tahoma;">ช่างซ่อมทั่วไป</span>';
    }

    $arr['data'][] = array(
        $num,
        $result['Emp_ID'],
        $result['Emp_Name'],
        $type,
        $del,
        $callback
    );
    $num++;
}
echo json_encode($arr);
?>