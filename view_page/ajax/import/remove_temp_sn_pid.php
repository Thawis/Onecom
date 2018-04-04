<?php
include '../../../lib/connect.php';
$pid = $_POST['pid'];
$sql = "DELETE FROM temp_unit_sn WHERE P_ID = '".$pid."'";
$stmt = $dbh->prepare($sql);
try {
    $stmt->execute();
    echo 'ok';
} catch (Exception $ex) {
    $ex->getMessage();    
}
?>