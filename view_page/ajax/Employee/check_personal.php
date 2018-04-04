<?php

include '../../../lib/connect.php';
$pcode = $_POST['pcode'];
$sql = 'SELECT * FROM t_employee WHERE Emp_PersonalCode = "' . $pcode . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->rowCount();
echo $result;
?>