<?php

include '../../../lib/connect.php';
$c_id = $_POST['c_id'];
$sql = 'SELECT * FROM t_claim WHERE ClaimItem_ID = "' . $c_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$data = array(
    "rows" => $rows,
    "cid" => $result['ClaimItem_ID'],
    "name" => $result['Cus_Name'],
    "tel" => $result['Cus_Tel'],
    "manner"=> $result['Claim_Manner']
);
echo json_encode($data);
?>