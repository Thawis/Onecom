<?php

include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$empid = $_POST['emp_id'];
$empname = $_POST['emp_name'];
$empbd = $_POST['datepicker'];
$tel = $_POST['emp_tel'];
$empaddress = $_POST['emp_address'];
$gender = $_POST['emp_gender'];
$picname = $_POST['emp_pic_h'];
$emptel = str_replace("-", "", $tel);


//echo $empid,$empname,$empbd,$emptel,$picname,$empaddress,$gender;



if (is_uploaded_file($_FILES['file_emp']['tmp_name'])) {
    $arr = explode(".", $_FILES['file_emp']['name']);
    $extension = end($arr);
    $new_name = $dt->format("YmdHis") . "." . $extension;

    $sql = 'UPDATE t_employee '
            . 'SET Emp_Name = ? ,'
            . 'Emp_Gender = ? ,'
            . 'Emp_Birthday = ? ,'
            . 'Emp_Tel = ? ,'
            . 'Emp_Address = ? ,'
            . 'Emp_Img = ? '
            . 'WHERE Emp_ID = ? ';

    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(1, $empname);
    $stmt->bindParam(2, $gender);
    $stmt->bindParam(3, $empbd);
    $stmt->bindParam(4, $emptel);
    $stmt->bindParam(5, $empaddress);
    $stmt->bindParam(6, $new_name);
    $stmt->bindParam(7, $empid);

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
            . 'Emp_Address = ? '
            . 'WHERE Emp_ID = ? ';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $empname);
    $stmt->bindParam(2, $gender);
    $stmt->bindParam(3, $empbd);
    $stmt->bindParam(4, $emptel);
    $stmt->bindParam(5, $empaddress);
    $stmt->bindParam(6, $empid);
    try {
        $stmt->execute();
        echo "แก้ไขข้อมูลเรียบร้อย";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}



//echo $empid . '-' . $empname . '-' . $empbd . '-' . $emptel . '-' . $empperson . '-' . $empaddress . '-' . $file . '-' . $gender . '-' . $picname;
?>