<?php
include '../../../lib/connect.php';
$import_id = $_POST['import_id'];
$sql = 'DELETE FROM t_import_detail WHERE Import_ID = "' . $import_id . '"';
$stmt = $dbh->prepare($sql);
try {
    $stmt->execute();
    echo "ยกเลิกรายการรับเข้าสินค้าขาย รหัส : ".$import_id." เรียบร้อย";
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>