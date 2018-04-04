<?php

include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
//$today = $dt->format("YmdHis");
if (is_uploaded_file($_FILES['file_emp']['tmp_name'])) {
    $arr = explode(".", $_FILES['file_emp']['name']);
    $extension = end($arr);
    $new_name = $dt->format("YmdHis") . "." . $extension;
    $path = "../../../img/employee/" . $new_name;
    move_uploaded_file($_FILES['file_emp']['tmp_name'], $path);
    $file = $new_name;
    //echo $file;
} else {
    $file = "";
    //echo $file;
}
$pass = "onecomputer";
$option = [
    'cost' => 12,
    'salt' => md5('varis209')
];
$hash = password_hash($pass, PASSWORD_DEFAULT, $option);
$tel = str_replace("-", "", $_POST['emp_tel']);
$sql = "INSERT INTO t_employee"
        . " SET Emp_ID = ?,"
        . "Emp_Name = ?,"
        . "Emp_Address = ?,"
        . "Emp_Tel = ?,"
        . "Emp_Birthday = ?,"
        . "Emp_PersonalCode = ?,"
        . "Emp_Pass = ?,"
        . "Emp_Type = ?,"
        . "Emp_Status = ?,"
        . "Emp_Gender = ?,"
        . "Emp_Img = ?";
$type = "user";
$status = "1";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $_POST['emp_id']);
$stmt->bindParam(2, $_POST['emp_name']);
$stmt->bindParam(3, $_POST['emp_address']);
$stmt->bindParam(4, $tel);
$stmt->bindParam(5, $_POST['datepicker']);
$stmt->bindParam(6, $_POST['emp_pcode']);
$stmt->bindParam(7, $hash);
$stmt->bindParam(8, $type);
$stmt->bindParam(9, $status);
$stmt->bindParam(10, $_POST['emp_gender']);
$stmt->bindParam(11, $file);
try {
    $stmt->execute();
    echo "เพิ่มข้อมูลพนักงานเรียบร้อย";
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>