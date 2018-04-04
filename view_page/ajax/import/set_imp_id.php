<?php

include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
//$today = $dt->format("Ymd");
$today = $dt->format("ym");
$sql = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "onecomputer" AND TABLE_NAME = "t_import_detail"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$num = $result['AUTO_INCREMENT'];
//echo 'Import_'.$today.'_NO_'.$result['AUTO_INCREMENT'];

if ($num < 10) {
    echo 'IMP' . $today . '-NO-0000' . $num;
} else if ($num < 100) {
    echo 'IMP' . $today . '-NO-000' . $num;
} else if ($num < 1000) {
    echo 'IMP' . $today . '-NO-00' . $num;
} else if ($num < 10000) {
    echo 'IMP' . $today . '-NO-0' . $num;
} else {
    echo 'IMP' . $today . '-NO-' . $num;
}
?>