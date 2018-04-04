<?php

include '../../../lib/connect.php';
$GID = $_POST['GID'];
$action = $_POST['action'];

if ($action == "cancel") {
    $sql = 'select tpu.Unit_ID from t_group_product tgp '
            . 'JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID '
            . 'JOIN t_product tp on tp.SG_ID = tsgp.SG_ID '
            . 'JOIN t_product_unit tpu on tpu.P_ID = tp.P_ID '
            . 'WHERE tgp.G_ID = "' . $GID . '" AND tsgp.G_ID = "' . $GID . '" AND tpu.PU_Status = "1"';
} else if ($action == "remove") {
    $sql = 'select tpu.Unit_ID from t_group_product tgp '
            . 'JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID '
            . 'JOIN t_product tp on tp.SG_ID = tsgp.SG_ID '
            . 'JOIN t_product_unit tpu on tpu.P_ID = tp.P_ID '
            . 'WHERE tgp.G_ID = "' . $GID . '" AND tsgp.G_ID = "' . $GID . '"';
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