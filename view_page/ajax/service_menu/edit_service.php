<?php
include '../../../lib/connect.php';
$serid = $_POST['e_serid'];
$sername = $_POST['e_sername'];
$price = $_POST['e_serprice'];
$type = $_POST['e_sertype'];

$sql = 'UPDATE t_service_menu SET Service_Menu = ?, Service_Price = ?, Service_Type = ? WHERE Service_ID = ?';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1,$sername);
$stmt->bindParam(2,$price);
$stmt->bindParam(3,$type);
$stmt->bindParam(4,$serid);
$stmt->execute();
$rows = $stmt->rowCount();
if($rows>0){
    echo 'แก้ไขข้อมูลรายการบริการเรียบร้อย';
}else{
    echo 'ไม่สามารถแก้ไขข้อมูลรายการบริการได้';
}
?>