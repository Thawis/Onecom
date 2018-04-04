<?php

include '../../../lib/connect.php';

if (isset($_GET['type'])) {
    $type = $_GET['type'];
} else {
    $type = 'null';
}
if ($type == "Group") {
    //$sql = 'SELECT MAX(G_Number) FROM t_group_product';
    $sql = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_group_product"';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    if ($result['AUTO_INCREMENT'] > 9) {
        //$result2 = $result['MAX(G_Number)'] + 1;
        echo 'G' . $result['AUTO_INCREMENT'];
    } else {
        //$result2 = $result['MAX(G_Number)'] + 1;
        echo 'G0' . $result['AUTO_INCREMENT'];
    }
} else if ($type == "Sub") {
    //$sql = 'SELECT MAX(SG_Number) FROM t_sub_group_product';
    $sql = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_sub_group_product"';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    if ($result['AUTO_INCREMENT'] > 9) {
        //$result2 = $result['AUTO_INCREMENT'] + 1;
        echo 'SG' . $result['AUTO_INCREMENT'];
    } else {
        //$result2 = $result['MAX(SG_Number)'] + 1;
        echo 'SG0' . $result['AUTO_INCREMENT'];
    }
} else if ($type == "Brand") {
    //$sql = 'SELECT MAX(B_Number) FROM t_brand';
    $sql = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_brand"';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    if ($result['AUTO_INCREMENT'] > 9) {
        //$result2 = $result['MAX(B_Number)'] + 1;
        echo 'B' . $result['AUTO_INCREMENT'];
    } else {
        //$result2 = $result['AUTO_INCREMENT'] + 1;
        echo 'B0' . $result['AUTO_INCREMENT'];
    }
}else if($type == "Product"){
    //$sql = 'SELECT MAX(P_Number) FROM t_product';
    $sql ='SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_product"';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    if ($result['AUTO_INCREMENT'] > 9) {
        echo 'P'.$result['AUTO_INCREMENT'];
    } else {
        echo 'P0'.$result['AUTO_INCREMENT'];
    } 
}
?>