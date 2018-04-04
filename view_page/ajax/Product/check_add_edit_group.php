<?php

include '../../../lib/connect.php';
$gid = $_POST['G_ID'];
$name = $_POST['G_Name'];
$sql = 'SELECT * FROM t_group_product WHERE G_ID = "' . $gid . '" OR G_Name = "' . $name . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
echo $rows;
?>