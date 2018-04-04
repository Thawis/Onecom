<?php

include '../../../lib/connect.php';
$c_id = $_POST['c_id'];
$cancel = "0";

$sql = "UPDATE t_claim SET Claim_Status = ? WHERE ClaimItem_ID = ? ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $cancel);
$stmt->bindParam(2, $c_id);

try {
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows > 0) {
        $sql_del = 'DELETE FROM temp_claim WHERE Claim_ID = "' . $c_id . '"';
        $stmt_del = $dbh->prepare($sql_del);
        $stmt_del->execute();
        echo 'ok';
    }
} catch (Exception $ex) {
    
}
?>