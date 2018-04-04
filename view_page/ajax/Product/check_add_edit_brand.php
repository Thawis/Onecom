<?php

include '../../../lib/connect.php';
$id = $_POST['Brand_Id'];
$name = $_POST['Brand_Name'];
$sql = 'SELECT * FROM t_brand WHERE B_ID = "' . $id . '" OR B_Name = "' . $name . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
echo $rows;
?>