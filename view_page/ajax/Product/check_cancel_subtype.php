<?php
include '../../../lib/connect.php';
$SGID = $_POST['SGID'];
$action = $_POST['action'];
if($action == "cancel"){
    $sql = 'select tsgp.SG_ID , tpu.Unit_ID, tpu.P_ID,tp.P_ID, tp.P_Name from t_sub_group_product tsgp '
            . 'JOIN t_product tp on tp.SG_ID = tsgp.SG_ID '
            . 'JOIN t_product_unit tpu on tpu.P_ID = tp.P_ID '
            . 'WHERE tsgp.SG_ID = "' . $SGID . '" AND tpu.PU_Status = "1" ';
}else if($action == "remove"){
        $sql = 'select tsgp.SG_ID , tpu.Unit_ID, tpu.P_ID,tp.P_ID, tp.P_Name from t_sub_group_product tsgp '
            . 'JOIN t_product tp on tp.SG_ID = tsgp.SG_ID '
            . 'JOIN t_product_unit tpu on tpu.P_ID = tp.P_ID '
            . 'WHERE tsgp.SG_ID = "' . $SGID . '"';
}

$stmt = $dbh->prepare($sql);
try {
    $stmt->execute();
    $rows = $stmt->rowCount();
    if($rows==0){
        echo 'ok';
    }else{
        echo 'not';
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>