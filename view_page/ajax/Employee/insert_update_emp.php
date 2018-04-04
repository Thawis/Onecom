<?php

include '../../../lib/connect.php';

$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); 
//$today = $dt->format("YmdHis");
if (is_uploaded_file($_FILES['file_emp']['tmp_name'])) {
	$arr = explode(".", $_FILES['file_emp']['name']);	
	$extension = end($arr);  
	$new_name = $dt->format("YmdHis"). "." . $extension;   
	$path = "../../../img/employee/" . $new_name;  	
	move_uploaded_file($_FILES['file_emp']['tmp_name'], $path);
	$file = $new_name;
        //echo $file;
        
} else {
    $file = "-";
    //echo $file;
}
$pass = $_POST['emp_pass'];
$option = [
    'cost' => 12,
    'salt' => md5('varis209')
];
$hash = password_hash($pass, PASSWORD_DEFAULT, $option);
    $sql = "INSERT INTO t_employee"
            ." SET Emp_ID = ?,"
            ."Emp_Name = ?,"
            ."Emp_Address = ?,"
            ."Emp_Tel = ?,"
            //."Emp_Birthday = ?,"
            ."Emp_PersonalCode = ?,"
            ."Emp_Pass = ?,"
            ."Emp_Type = ?,"
            ."Emp_Status = ?,"
            ."Emp_Gender = ?,"
            ."Emp_Img = ?";
    
    $status = "1";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $_POST['emp_id']);
    $stmt->bindParam(2, $_POST['emp_name']);
    $stmt->bindParam(3, $_POST['emp_address']);
    $stmt->bindParam(4, $_POST['emp_tel']);
    //$stmt->bindParam(5, $_POST['datepicker']);
    $stmt->bindParam(5, $_POST['emp_pcode']);
    $stmt->bindParam(6, $hash);
    $stmt->bindParam(7, $_POST['emp_type']);
    $stmt->bindParam(8, $status);
    $stmt->bindParam(9, $_POST['emp_gender']);
    $stmt->bindParam(10, $file);
    $stmt->execute();    
    
//echo $_POST['emp_type'];
//echo $status;

?>