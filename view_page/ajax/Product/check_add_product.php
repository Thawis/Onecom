<?php
include '../../../lib/connect.php';
$sub = $_POST['DDsub'];
$name = $_POST['P_Name'];
$brand = $_POST['DDbrand'];
$sql = 'SELECT * FROM t_product WHERE SG_ID = "'.$sub.'" AND B_ID = "'.$brand.'" AND P_Name = "'.$name.'"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
echo $rows;
?>