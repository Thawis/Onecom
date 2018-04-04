<?php

include '../../../lib/connect.php';
$sql = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_service_menu"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();

if ($result['AUTO_INCREMENT'] <= 9) {
    echo 'Ser_0'.$result['AUTO_INCREMENT'];
}  else {
    echo 'Ser_'.$result['AUTO_INCREMENT'];
}
?>