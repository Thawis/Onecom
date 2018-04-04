<?php

include '../../../lib/connect.php';
$pid = $_POST['P_ID'];
$action = $_POST['action'];
//$sql = 'select * from t_product JOIN t_product_unit on t_product.P_ID = t_product_unit.P_ID WHERE t_product.P_ID = "' . $pid . '" AND t_product_unit.P_ID = "' . $pid . '"';

if ($action == "cancel") {
    $sql = 'select * from t_product JOIN t_product_unit on t_product.P_ID = t_product_unit.P_ID WHERE t_product.P_ID = "' . $pid . '" AND t_product_unit.P_ID = "' . $pid . '" AND PU_Status = "1"';
}else if($action == "remove"){
    $sql = 'select * from t_product JOIN t_product_unit on t_product.P_ID = t_product_unit.P_ID WHERE t_product.P_ID = "' . $pid . '" AND t_product_unit.P_ID = "' . $pid . '"';
}
$stmt = $dbh->prepare($sql);
try {
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows == 0) {
        echo 'ok';
    } else {
        echo 'not';
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>