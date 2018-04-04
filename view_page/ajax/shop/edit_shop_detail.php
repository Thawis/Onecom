<?php

include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));

if (is_uploaded_file($_FILES['edit_file_shop']['tmp_name'])) {
    $arr = explode(".", $_FILES['edit_file_shop']['name']);
    $extension = end($arr);
    $new_name = $dt->format("YmdHis") . "." . $extension;
    $sql = 'UPDATE t_shop '
            . 'SET Shop_Name = ? ,'
            . 'Shop_Address = ? ,'
            . 'Shop_Tel = ? ,'
            . 'Shop_Img = ? ';

    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(1, $_POST['edit_shop_name']);
    $stmt->bindParam(2, $_POST['edit_shop_address']);
    $stmt->bindParam(3, $_POST['edit_shop_tel']);
    $stmt->bindParam(4, $new_name);
    try {
        $stmt->execute();
        $path = "../../../img/shop/" . $new_name;
        move_uploaded_file($_FILES['edit_file_shop']['tmp_name'], $path);
        if ($_POST['edit_shop_img'] != "") {
            unlink("../../../img/shop/" . $_POST['edit_shop_img']);
        }
        echo "แก้ไขข้อมูลเรียบร้อย";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
} else {
    $sql = 'UPDATE t_shop '
            . 'SET Shop_Name = ? ,'
            . 'Shop_Address = ? ,'
            . 'Shop_Tel = ? ';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $_POST['edit_shop_name']);
    $stmt->bindParam(2, $_POST['edit_shop_address']);
    $stmt->bindParam(3, $_POST['edit_shop_tel']);
    try {
        $stmt->execute();
        echo "แก้ไขข้อมูลเรียบร้อย (ไม่มีรูป)";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}



//echo $empid . '-' . $empname . '-' . $empbd . '-' . $emptel . '-' . $empperson . '-' . $empaddress . '-' . $file . '-' . $gender . '-' . $picname;
?>