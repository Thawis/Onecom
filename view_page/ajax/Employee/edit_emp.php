<?php

include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$empid = $_POST['edit_emp_id'];
$empname = $_POST['edit_emp_name'];
$empbd = $_POST['edit_emp_bd'];
$tel = $_POST['edit_emp_tel'];
$empperson = $_POST['edit_emp_personal'];
$empaddress = $_POST['edit_emp_address'];
$gender = $_POST['edit_emp_gender'];
$picname = $_POST['pic_name'];

$emptel = str_replace("-", "", $tel);

if (is_uploaded_file($_FILES['file_emp']['tmp_name'])) {
    $arr = explode(".", $_FILES['file_emp']['name']);
    $extension = end($arr);
    $new_name = $dt->format("YmdHis") . "." . $extension;


    $sql = 'UPDATE t_employee '
            . 'SET Emp_Name = ? ,'
            . 'Emp_Gender = ? ,'
            . 'Emp_Birthday = ? ,'
            . 'Emp_Tel = ? ,'
            . 'Emp_PersonalCode = ? ,'
            . 'Emp_Address = ? ,'
            . 'Emp_Img = ? '
            . 'WHERE Emp_ID = ? ';

    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(1, $empname);
    $stmt->bindParam(2, $gender);
    $stmt->bindParam(3, $empbd);
    $stmt->bindParam(4, $emptel);
    $stmt->bindParam(5, $empperson);
    $stmt->bindParam(6, $empaddress);
    $stmt->bindParam(7, $new_name);
    $stmt->bindParam(8, $empid);

    try {
        $stmt->execute();
        $path = "../../../img/employee/" . $new_name;
        move_uploaded_file($_FILES['file_emp']['tmp_name'], $path);
        if ($picname != "") {
            unlink("../../../img/employee/" . $picname);
        }
        echo "แก้ไขข้อมูลเรียบร้อย";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
} else {
    $sql = 'UPDATE t_employee '
            . 'SET Emp_Name = ? ,'
            . 'Emp_Gender = ? ,'
            . 'Emp_Birthday = ? ,'
            . 'Emp_Tel = ? ,'
            . 'Emp_PersonalCode = ? ,'
            . 'Emp_Address = ? '
            . 'WHERE Emp_ID = ? ';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $empname);
    $stmt->bindParam(2, $gender);
    $stmt->bindParam(3, $empbd);
    $stmt->bindParam(4, $emptel);
    $stmt->bindParam(5, $empperson);
    $stmt->bindParam(6, $empaddress);
    $stmt->bindParam(7, $empid);
    try {
        $stmt->execute();
        echo "แก้ไขข้อมูลเรียบร้อย";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}



//echo $empid . '-' . $empname . '-' . $empbd . '-' . $emptel . '-' . $empperson . '-' . $empaddress . '-' . $file . '-' . $gender . '-' . $picname;
?>