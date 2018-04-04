<?php

include '../../../lib/connect.php';
$sql = 'SELECT * FROM t_warranty WHERE War_Status != 0 ORDER BY War_Level ASC,War_Time ASC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;

while ($result = $stmt->fetch()) {
    if ($result['War_Status'] == '1' || $result['War_Status'] == '2') {
        $status = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma;" >ปกติ</label>';
    }
    $action = '<button type="button" class="btn bg-red-gradient" onclick="remove_menu(\'' . $result['War_Number'] . '\')"><span class="fa fa-close"></span></button>';
    $arr['data'][] = array(
        $num,
        $result['War_Name'],
        $status,
        $action
    );
    $num++;
}
echo json_encode($arr);
?>