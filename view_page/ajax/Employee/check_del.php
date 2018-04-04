<?php

include '../../../lib/connect.php';
$id = $_GET['eid'];
$sql = 'SELECT * FROM t_logfile WHERE Emp_ID = "' . $id . '"';
$stmt = $dbh->prepare($sql);
try {
    $stmt->execute();
    $rows = $stmt->rowCount();
    echo $rows;
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>