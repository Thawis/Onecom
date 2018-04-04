<?php

include '../../../lib/connect.php';
$bid = $_POST['B_ID'];
$sql ='select * from t_brand JOIN t_product on t_brand.B_ID = t_product.B_ID WHERE t_brand.B_ID ="'.$bid.'" AND t_product.B_ID = "'.$bid.'"';
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