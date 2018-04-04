<?php
include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); 
if (is_uploaded_file($_FILES['file_shop']['tmp_name'])) {
	$arr = explode(".", $_FILES['file_shop']['name']);	
	$extension = end($arr);  
	$new_name = $dt->format("YmdHis"). "." . $extension;   
	$path = "../../../img/shop/" . $new_name;  	
	move_uploaded_file($_FILES['file_shop']['tmp_name'], $path);
	$file = $new_name;
} else {
    $file = "";
}
if ($_POST) {
    $sql = "INSERT INTO t_shop SET Shop_Name = ?, Shop_Address = ?, Shop_Tel = ?, Shop_Img = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $_POST['shop_name']);
    $stmt->bindParam(2, $_POST['shop_address']);
    $stmt->bindParam(3, $_POST['shop_tel']);
    $stmt->bindParam(4, $new_name);
    try{
        $stmt->execute();
        echo "เพิ่มข้อมูลร้านเรียบร้อย";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
    
}
?>