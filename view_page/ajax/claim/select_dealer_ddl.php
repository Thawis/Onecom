<?php

include '../../../lib/connect.php';
$sql = 'SELECT * FROM t_dealer WHERE Dealer_Status = "1" ';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array();
$i = 0;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $text_dealer = $result['Dealer_Name'] . ' ( ' . $result['Dealer_Company'] . ' )';
    $arr[$i]["id"] = $result['Dealer_ID'];
    $arr[$i]["name"] = $text_dealer;
    $i++;
}
echo json_encode($arr);
?>