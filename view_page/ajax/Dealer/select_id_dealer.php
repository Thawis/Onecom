<?php
include '../../../lib/connect.php';
$sql ='SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_dealer"';
$stmt = $dbh->prepare($sql);
try {
    $stmt->execute();
    $result = $stmt->fetch();
    if($result['AUTO_INCREMENT'] > 9){
        echo 'dealer_'.$result['AUTO_INCREMENT'];
    }else{
        echo 'dealer_0'.$result['AUTO_INCREMENT'];
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>