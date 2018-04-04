<?php

include '../../../lib/connect.php';
$dummy = "";
$status = '1';
$cancel = '0';
if ($_POST) {
//    $test = $_POST['action-group'];
//    echo $test;
    if ($_POST['action'] == 'insert') { // INSERT
        //$sql = "INSERT INTO t_sub_group_product VALUES(?,?,?,?,?)";
        $sql = "INSERT INTO t_sub_group_product SET SG_ID = ? , SG_Name = ? , G_ID = ? , SG_Status = ? ";
    } else if ($_POST['action'] == 'update') {  // UPDATE
        $sql = "UPDATE t_sub_group_product"
                . " SET SG_Name = ?,"
                . " G_ID = ?"
                . " WHERE SG_ID = ?";
    } else if ($_POST['action'] == 'cancel') {
        $sql = "UPDATE t_sub_group_product"
                . " SET SG_Status = ?"
                . " WHERE SG_ID = ?";
    } else if ($_POST['action'] == 'open') {
        $sql = "UPDATE t_sub_group_product"
                . " SET SG_Status = ?"
                . " WHERE SG_ID = ?";
    } else if ($_POST['action'] == 'remove') {
        $sql = "DELETE FROM t_sub_group_product WHERE SG_ID = ?";        
    }

    $stmt = $dbh->prepare($sql);

    if ($_POST['action'] == 'insert') {
        $stmt->bindParam(1, $_POST['Sub_Id']);
        $stmt->bindParam(2, $_POST['Sub_Name']);
        $stmt->bindParam(3, $_POST['DDgroup']);
        $stmt->bindParam(4, $status);
        try {
            $stmt->execute();
            echo 'เพิ่มข้อมูลเรียบร้อย';
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    } else if ($_POST['action'] == 'update') {
        $stmt->bindParam(1, $_POST['Sub_Name']);
        $stmt->bindParam(2, $_POST['DDgroup']);
        $stmt->bindParam(3, $_POST['Sub_Id']);
        try {
            $stmt->execute();
            echo "แก้ไขข้อมูลเรียบร้อย";
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    } else if ($_POST['action'] == 'cancel') {
        $stmt->bindParam(1, $cancel);
        $stmt->bindParam(2, $_POST['Cancel_Id']);
        try {
            $stmt->execute();
            $state = cancel_sub($_POST['Cancel_Id'], $dbh);
            if ($state == 'ok') {
                echo "ยกเลิกการใช้งานเรียบร้อย";
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    } else if ($_POST['action'] == 'open') {
        $stmt->bindParam(1, $status);
        $stmt->bindParam(2, $_POST['Open_Id']);
        try {
            $stmt->execute();
            $state = open_sub($_POST['Open_Id'], $dbh);
            if ($state == 'ok') {
                echo "เปิดการใช้งานเรียบร้อย";
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    } else if ($_POST['action'] == 'remove'){
        $stmt->bindParam(1,$_POST['Remove_Id']);
            echo "ลบข้อมูลออกจากระบบเรียบร้อย";
        try {
            $stmt->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}

function cancel_sub($SGID, $dbh) {
    $sql = "UPDATE t_sub_group_product JOIN t_product ON t_sub_group_product.SG_ID = t_product.SG_ID "
            . "SET t_sub_group_product.SG_Status = '0', t_product.P_Status = '0' "
            . "WHERE t_sub_group_product.SG_ID = ? AND t_product.SG_ID = ? ";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $SGID);
    $stmt->bindParam(2, $SGID);
    try {
        $stmt->execute();
        $state = 'ok';
        return $state;
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

function open_sub($SGID, $dbh) {
    $sql = "UPDATE t_sub_group_product JOIN t_product ON t_sub_group_product.SG_ID = t_product.SG_ID "
            . "SET t_sub_group_product.SG_Status = '1', t_product.P_Status = '1' "
            . "WHERE t_sub_group_product.SG_ID = ? AND t_product.SG_ID = ? ";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $SGID);
    $stmt->bindParam(2, $SGID);
    try {
        $stmt->execute();
        $state = 'ok';
        return $state;
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

?>