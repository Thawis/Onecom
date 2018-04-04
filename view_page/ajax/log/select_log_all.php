<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$sql = 'SELECT * FROM t_logfile JOIN t_employee ON t_logfile.Emp_ID = t_employee.Emp_ID ORDER BY L_Number DESC ';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $name = $result['Emp_Name'].' ( '.$result['Emp_ID'].' ) ';
    if($result['L_Event']=='login'){
        $event = '<label class="label bg-green-gradient" style="font-size:12px font-family:Tahoma;"> LOGIN </label>';
    }else if($result['L_Event']=='logout'){
        $event = '<label class="label bg-red-gradient" style="font-size:12px font-family:Tahoma;"> LOGOUT </label>';
    }
    if($result['Emp_Type']=="root"){
        $type = '<label class="label bg-green-gradient" style="font-size:12px font-family:Tahoma;">เจ้าของร้าน</label>';
    }else if($result['Emp_Type']=="admin"){
        $type = '<label class="label bg-blue-gradient" style="font-size:12px font-family:Tahoma;">หัวหน้าช่าง</label>';
    }else{
        $type = '<label class="label bg-yellow-gradient" style="font-size:12px font-family:Tahoma;">ช่างซ่อมทั่วไป</label>';
    }
    
    $date_log = DateThai($result['L_Date']);
    $arr['data'][] = array(
        $num,
        $name,
        $date_log,
        $result['L_Time'],
        $type,
        $event
    );
    $num++;
}
echo json_encode($arr);
?>