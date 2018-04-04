<?php

include '../../../lib/connect.php';
$dealer_id = $_POST['dealer_id'];
$cancel = "1";
$sql = 'UPDATE t_dealer SET Dealer_Status = ? WHERE Dealer_ID = ? ';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $cancel);
$stmt->bindParam(2, $dealer_id);
try {
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows > 0) {
        echo 'ok';
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>