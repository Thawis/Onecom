<?php
include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$pid = $_POST['P_ID'];
$price = $_POST['P_Price'];
$pname = $_POST['P_Name'];
$brand = $_POST['dd_brand'];
$detail = $_POST['P_Detail'];
$picname = $_POST['pic_name'];

if (is_uploaded_file($_FILES['file_product']['tmp_name'])) {
    $arr = explode(".", $_FILES['file_product']['name']);
    $extension = end($arr);
    $new_name = $dt->format("YmdHis") . "." . $extension;

    $sql = 'UPDATE t_product '
            . 'SET P_Name = ?,'
            . 'P_Price = ? ,'
            . 'P_Detail = ?,'
            . 'B_ID = ? ,'
            . 'P_Img = ? '
            . 'WHERE P_ID = ? ';
    
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $pname);
    $stmt->bindParam(2, $price);
    $stmt->bindParam(3, $detail);
    $stmt->bindParam(4, $brand);
    $stmt->bindParam(5, $new_name);
    $stmt->bindParam(6, $pid);
    try {
        $stmt->execute();
        $path = "../../../img/product/" . $new_name;
        move_uploaded_file($_FILES['file_product']['tmp_name'], $path);
        if ($picname != "") {
            unlink("../../../img/product/" . $picname);
        }
        echo "แก้ไขข้อมูลเรียบร้อย";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
} else {
    $sql = 'UPDATE t_product SET P_Name = ?, P_Price = ?, P_Detail = ?, B_ID = ? WHERE P_ID = ? ';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $pname);
    $stmt->bindParam(2, $price);
    $stmt->bindParam(3, $detail);
    $stmt->bindParam(4, $brand);
    $stmt->bindParam(5, $pid);
    try {
        $stmt->execute();
        echo "แก้ไขข้อมูลเรียบร้อย";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
?>