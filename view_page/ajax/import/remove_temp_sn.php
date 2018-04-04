<?php

include '../../../lib/connect.php';
$sql = "Truncate table temp_unit_sn";
$stmt = $dbh->prepare($sql);
try {
    $stmt->execute();
    echo 'ok';
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>