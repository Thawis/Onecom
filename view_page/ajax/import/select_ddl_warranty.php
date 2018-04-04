<?php

include '../../../lib/connect.php';
$sql = 'SELECT * FROM t_warranty WHERE War_Status != 0 ORDER BY War_Level ASC,War_Time ASC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array();
$i = 0;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $arr[$i]["war"] = $result['War_Value'];
    $arr[$i]["name"] = $result['War_Name'];
    $i++;
}
echo json_encode($arr);
?>