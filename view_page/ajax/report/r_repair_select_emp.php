<?php

include '../../../lib/connect.php';
$sql = 'SELECT * FROM t_employee WHERE Emp_Status = "1" ';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array();
$i = 0;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $text_dealer = $result['Emp_Name'] . ' ( ' . $result['Emp_ID'] . ' )';
    $arr[$i]["id"] = $result['Emp_ID'];
    $arr[$i]["name"] = $text_dealer;
    $i++;
}
echo json_encode($arr);
?>