<?php

include '../../../lib/connect.php';
$pname = $_POST['name'];
$sn = $_POST['sn'];
$sql = 'SELECT * FROM t_claim WHERE ClaimItem_Name = "' . $pname . '" AND S_ID = "' . $sn . '" AND (Claim_Status = "1" OR Claim_Status = "2" OR Claim_Status = "3" OR Claim_Status = "4")';
$stmt = $dbh->prepare($sql);

$stmt->execute();
$rows = $stmt->rowCount();
echo $rows;
?>