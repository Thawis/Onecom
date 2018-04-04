<?php

include '../../../lib/connect.php';
$G_ID = $_POST['G_ID'];
$SG_ID = $_POST['SG_ID'];
$Name = $_POST['SG_Name'];
$action = $_POST['action'];
if ($action == "insert") {
    $sql = 'SELECT * FROM t_sub_group_product WHERE SG_ID = "' . $SG_ID . '" OR (G_ID = "' . $G_ID . '" AND SG_Name = "' . $Name . '")';
} else if ($action == "update") {
    $sql = 'SELECT * FROM t_sub_group_product WHERE G_ID = "' . $G_ID . '" AND SG_Name = "' . $Name . '"';
}
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
echo $rows;
?>