<?php

include '../../../lib/connect.php';
$status = '1';
$cancel = '0';
if ($_POST) {
    if ($_POST['action_brand'] == 'insert') {
        //$sql = "INSERT INTO t_brand VALUES(?,?,?,?)";
         $sql = "INSERT INTO t_brand SET B_ID = ? , B_Name = ? , B_Status = ? ";
    } else if ($_POST['action_brand'] == 'update') {
        $sql = "UPDATE t_brand"
                . " SET B_Name = ?"
                . " WHERE B_ID = ?";
    } else if ($_POST['action_brand'] == 'cancel') {
        $sql = "UPDATE t_brand"
                . " SET B_Status = ?"
                . " WHERE B_ID = ?";
    } else if ($_POST['action_brand'] == 'open') {
        $sql = "UPDATE t_brand"
                . " SET B_Status = ?"
                . " WHERE B_ID = ?";
    } else if ($_POST['action_brand'] == 'remove') {
        $sql = 'DELETE FROM t_brand WHERE B_ID = ? ';
    }

    $stmt = $dbh->prepare($sql);

    if ($_POST['action_brand'] == 'insert') {
        $stmt->bindParam(1, $_POST['Brand_Id']);
        $stmt->bindParam(2, $_POST['Brand_Name']);
        $stmt->bindParam(3, $status);
        try{
            $stmt->execute();
            echo 'เพิ่มข้อมูลยี่ห้อสินค้าเรียบร้อย';
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        
    } else if ($_POST['action_brand'] == 'update') {
        $stmt->bindParam(1, $_POST['Brand_Name-edit']);
        $stmt->bindParam(2, $_POST['Brand_Id-edit']);
        try {
            $stmt->execute();
            echo 'แก้ไขข้อมูลเรียบร้อย';
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    } else if ($_POST['action_brand'] == 'cancel') {
        $stmt->bindParam(1, $cancel);
        $stmt->bindParam(2, $_POST['Cancel_Id_Brand']);
        try {
            $stmt->execute();
            echo 'ยกเลิกการใช้งานยี่ห้อเรียบร้อย';
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    } else if ($_POST['action_brand'] == 'open') {
        $stmt->bindParam(1, $status);
        $stmt->bindParam(2, $_POST['Open_Id_Brand']);
        try {
            $stmt->execute();
            echo 'เปิดการใช้งานยี่ห้อเรียบร้อย';
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    } else if ($_POST['action_brand'] == 'remove') {
        $stmt->bindParam(1, $_POST['Remove_Id_Brand']);
        try{
            $stmt->execute();
            echo 'ลบยี่ห้อ ออกจากระบบเรียบร้อย';
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
?>

