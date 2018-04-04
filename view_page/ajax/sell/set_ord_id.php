<?php

$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
//$today = $dt->format("Ymd");
$today = $dt->format("ym");
//echo 'ORD_'.$today;
include '../../../lib/connect.php';
$sql = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_sell"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$num = $result['AUTO_INCREMENT'];
//echo "ORD_N".$num."_".$today;
//echo "ORD_".$today."_NO_".$num;

if ($num < 10) {
    echo 'ORD' . $today . '-NO-0000' . $num;
} else if ($num < 100) {
    echo 'ORD' . $today . '-NO-000' . $num;
} else if ($num < 1000) {
    echo 'ORD' . $today . '-NO-00' . $num;
} else if ($num < 10000) {
    echo 'ORD' . $today . '-NO-0' . $num;
} else {
    echo 'ORD' . $today . '-NO-' . $num;
}
?>