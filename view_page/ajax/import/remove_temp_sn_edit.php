<?php

include '../../../lib/connect.php';
$num = $_POST['num'];
$pid = $_POST['pid'];
$sql = "DELETE FROM temp_unit_sn WHERE Number = '" . $num . "'";
$stmt = $dbh->prepare($sql);

try {
    $stmt->execute();
    $state = "ok";
    $sql2 = 'SELECT COUNT(*) FROM temp_unit_sn WHERE P_ID = "' . $pid . '"';
    $stmt2 = $dbh->prepare($sql2);
    $stmt2->execute();
    $result = $stmt2->fetch();
    $arr = array(
        "state" => $state,
        "number" => $result['COUNT(*)']
    );
    echo json_encode($arr);
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>