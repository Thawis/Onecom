<?php
include '../../../lib/connect.php';
$serid = $_POST['serid'];
$sername = $_POST['sername'];
$price = $_POST['serprice'];
$type = $_POST['sertype'];
$status = "1";
$sql = 'INSERT INTO t_service_menu SET Service_ID = ?, Service_Menu = ?, Service_Price = ?, Service_Type = ?, Service_Status = ? ';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1,$serid);
$stmt->bindParam(2,$sername);
$stmt->bindParam(3,$price);
$stmt->bindParam(4,$type);
$stmt->bindParam(5,$status);
$stmt->execute();
$rows = $stmt->rowCount();
if($rows>0){
    echo 'เพิ่มมูลรายการบริการเรียบร้อย';
}else{
    echo 'ไม่สามารถเพิ่มข้อมูลรายการบริการได้';
}
?>