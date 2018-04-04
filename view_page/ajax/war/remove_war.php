<?php

include '../../../lib/connect.php';
$numwar = $_POST['numwar'];
$sql = 'DELETE FROM t_warranty WHERE War_Number = "' . $numwar . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
if($rows > 0){
    echo 'ok';
}else{
    echo 'not';
}
?>