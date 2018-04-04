<?php

include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
//$today = $dt->format("Y-m-d");
$today2 = $dt->format("ym");
$sql = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_repair"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();

$num = $result['AUTO_INCREMENT'];
//if($num<10){
//        echo 'Repair_NO_000'.$num;
//}else if($num<100){
//        echo 'Repair_NO_00'.$num;
//}else if($num<1000){
//        echo 'Repair_NO_0'.$num;
//}else{
//    echo 'Repair_NO_'.$num;
//}

if ($num < 10) {
    echo 'RPN' . $today2 . '-NO-0000' . $num;
} else if ($num < 100) {
    echo 'RPN' . $today2 . '-NO-000' . $num;
} else if ($num < 1000) {
    echo 'RPN' . $today2 . '-NO-00' . $num;
} else if ($num < 10000) {
    echo 'RPN' . $today2 . '-NO-0' . $num;
} else {
    echo 'RPN' . $today2 . '-NO-' . $num;
}
?>