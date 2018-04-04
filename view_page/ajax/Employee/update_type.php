<?php

include '../../../lib/connect.php';
$type = $_POST['type'];
$id = $_POST['id'];

if ($type == "admin") {
    $sql = 'UPDATE t_employee SET Emp_Type = "admin" WHERE Emp_ID = "' . $id . '"';
} else if ($type == "user") {
    $sql = 'UPDATE t_employee SET Emp_Type = "user" WHERE Emp_ID = "' . $id . '"';
}

$stmt = $dbh->prepare($sql);
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