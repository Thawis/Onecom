<?php

include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); 
if (is_uploaded_file($_FILES['file_pro']['tmp_name'])) {
	$arr = explode(".", $_FILES['file_pro']['name']);	
	$extension = end($arr);  
	$new_name = $dt->format("YmdHis"). "." . $extension;   
	$path = "../../../img/product/" . $new_name;  	
	move_uploaded_file($_FILES['file_pro']['tmp_name'], $path);
	$file = $new_name;
        //echo $file;
        
} else {
    $file = "";
    //echo $file;
}

$status = '1';

if ($_POST) {
    $sql = "INSERT INTO t_product VALUES(?,?,?,?,?,?,?,?,?)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $dummy);
    $stmt->bindParam(2, $_POST['Product_Id']);
    $stmt->bindParam(3, $_POST['P_Name']);
    $stmt->bindParam(4, $_POST['P_Price']);
    $stmt->bindParam(5, $_POST['DDbrand']);
    $stmt->bindParam(6, $_POST['P_Detail']);
    $stmt->bindParam(7, $_POST['DDsub']);
    $stmt->bindParam(8, $status);
    $stmt->bindParam(9, $file);
    $stmt->execute();
}
?>