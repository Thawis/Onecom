<?php

include '../../../lib/connect.php';
$numwar = $_POST['numwar'];
$wartype = $_POST['wartype'];
$status = '1';
if ($wartype == 'day') {
    $level = '1';
    $war_value = '+' . $numwar . ' days';
    $war_name = $numwar . 'วัน';
} else if ($wartype == 'month') {
    $level = '2';
    $war_value = '+' . $numwar . ' month';
    $war_name = $numwar . 'เดือน';
} else if ($wartype == 'year') {
    $level = '3';
    $war_value = '+' . $numwar . ' year';
    $war_name = $numwar . 'ปี';
}

$sql = 'INSERT INTO t_warranty SET War_Name = ?, War_Value = ?, War_Status = ?, War_Level = ?, War_Time = ?';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $war_name);
$stmt->bindParam(2, $war_value);
$stmt->bindParam(3, $status);
$stmt->bindParam(4, $level);
$stmt->bindParam(5, $numwar);
$stmt->execute();
$rows = $stmt->rowCount();
if ($rows > 0) {
    echo 'ok';
} else {
    echo 'not';
}
?>