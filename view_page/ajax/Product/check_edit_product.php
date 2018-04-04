<?php

include '../../../lib/connect.php';
$sub = $_POST['edit_sub'];
$name = $_POST['P_Name'];
$brand = $_POST['dd_brand'];
$pid = $_POST['edit_pid'];

//$sql = 'SELECT * FROM t_product WHERE SG_ID = "' . $sub . '" AND B_ID = "' . $brand . '" AND P_Name = "' . $name . '"';

$sql = 'SELECT * FROM t_product WHERE P_ID = "' . $pid . '" AND SG_ID = "' . $sub . '" AND B_ID = "' . $brand . '" AND P_Name = "' . $name . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
//echo $rows;
if ($rows == 1) {
    echo 'ok';
} else if ($rows == 0) {
    $sql_1 = 'SELECT * FROM t_product WHERE SG_ID = "' . $sub . '" AND B_ID = "' . $brand . '" AND P_Name = "' . $name . '"';
    $stmt_1 = $dbh->prepare($sql_1);
    $stmt_1->execute();
    $rows_1 = $stmt_1->rowCount();
    if ($rows_1 == 0) {
        echo 'ok';
    } else {
        echo 'not';
    }
} else {
    echo 'not';
}
?>