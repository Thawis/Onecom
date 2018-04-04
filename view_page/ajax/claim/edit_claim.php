<?php

include '../../../lib/connect.php';
$c_id = $_POST['hidden_c_id_edit'];
$cus_name = $_POST['edit_cusname'];
$cus_tel = str_replace("-", "", $_POST['edit_custel']);
$manner = $_POST['edit_manner'];

$sql = "UPDATE t_claim SET Cus_Name = ?, Cus_Tel = ?, Claim_Manner = ? WHERE ClaimItem_ID = ? ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $cus_name);
$stmt->bindParam(2, $cus_tel);
$stmt->bindParam(3, $manner);
$stmt->bindParam(4, $c_id);
try {
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows > 0) {
        echo 'ok';
    }
} catch (Exception $ex) {
    
}
?>