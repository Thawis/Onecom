<?php

include '../../../lib/connect.php';
$dummy = "";
$status = '1';
$cancel = '0';
//if ($_POST) {
//    $test = $_POST['action-group'];
//    echo $test;
if ($_POST['action'] == 'insert') { // INSERT
    //$sql = "INSERT INTO t_group_product VALUES(?,?,?,?)";
    $sql = "INSERT INTO t_group_product SET G_ID = ? , G_Name = ? , G_Status = ? ";
} else if ($_POST['action'] == 'update') {  // UPDATE
    $sql = "UPDATE t_group_product"
            . " SET G_Name = ?"
            . " WHERE G_ID = ?";
} else if ($_POST['action'] == 'cancel') {
    $sql = "UPDATE t_group_product"
            . " SET G_Status = ?"
            . " WHERE G_ID = ?";
} else if ($_POST['action'] == 'open') {
    $sql = "UPDATE t_group_product"
            . " SET G_Status = ?"
            . " WHERE G_ID = ?";
} else if ($_POST['action'] == 'remove') {
    $sql = "DELETE FROM t_group_product WHERE G_ID = ?";
}

$stmt = $dbh->prepare($sql);

if ($_POST['action'] == 'insert') {
    //$stmt->bindParam(1, $dummy);
    $stmt->bindParam(1, $_POST['Group_Id']);
    $stmt->bindParam(2, $_POST['Group_Name']);
    $stmt->bindParam(3, $status);
    try {
        $stmt->execute();
        echo 'เพิ่มข้อมูลเรียบร้อย';
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
} else if ($_POST['action'] == 'update') {
    $stmt->bindParam(1, $_POST['Group_Name_edit']);
    $stmt->bindParam(2, $_POST['Group_ID_edit']);
    try {
        $stmt->execute();
        echo 'แก้ไขข้อมูลเรียบร้อย';
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
} else if ($_POST['action'] == 'cancel') {
    $stmt->bindParam(1, $cancel);
    $stmt->bindParam(2, $_POST['Cancel_Id']);

    try {
        $stmt->execute();
        $state = cancel($_POST['Cancel_Id'], $dbh);
        if ($state == 'ok') {
            echo "ยกเลิกการใช้งานเรียบร้อย";
        } else {
            echo "ll";
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
    $stmt->execute();
} else if ($_POST['action'] == 'open') {
    $stmt->bindParam(1, $status);
    $stmt->bindParam(2, $_POST['Open_Id']);
    try {
        $stmt->execute();
        $state = open($_POST['Open_Id'], $dbh);
        if ($state == 'ok') {
            echo "เปิดใช้งานเรียบร้อย";
        } else {
            echo "ll";
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
} else if($_POST['action']== 'remove'){
    $stmt->bindParam(1,$_POST['Remove_Id']);
    try {
        $stmt->execute();
        echo "ลบข้อมูลออกจากระบบเรียบร้อย";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

function cancel($gid, $dbh) {
    $sql = 'UPDATE t_group_product JOIN t_sub_group_product ON t_group_product.G_ID = t_sub_group_product.G_ID JOIN t_product ON t_sub_group_product.SG_ID = t_product.SG_ID '
            . 'SET t_group_product.G_Status = "0", t_sub_group_product.SG_Status = "0", t_product.P_Status = "0" '
            . 'WHERE t_group_product.G_ID = "' . $gid . '" AND t_sub_group_product.G_ID = "' . $gid . '"';
    $stmt = $dbh->prepare($sql);
    try {
        $stmt->execute();
        $state = 'ok';
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

    if ($state == 'ok') {
        $sql1 = 'UPDATE t_group_product JOIN t_sub_group_product ON t_group_product.G_ID = t_sub_group_product.G_ID '
                . 'SET t_group_product.G_Status = "0", t_sub_group_product.SG_Status = "0" '
                . 'WHERE t_group_product.G_ID = "' . $gid . '" AND t_sub_group_product.G_ID = "' . $gid . '"';
        $stmt1 = $dbh->prepare($sql1);
        try {
            $stmt1->execute();
            $state1 = 'ok';
            return $state1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}

function open($gid, $dbh) {
    $sql = 'UPDATE t_group_product JOIN t_sub_group_product ON t_group_product.G_ID = t_sub_group_product.G_ID JOIN t_product ON t_sub_group_product.SG_ID = t_product.SG_ID '
            . 'SET t_group_product.G_Status = "1", t_sub_group_product.SG_Status = "0", t_product.P_Status = "1" '
            . 'WHERE t_group_product.G_ID = "' . $gid . '" AND t_sub_group_product.G_ID = "' . $gid . '"';
    $stmt = $dbh->prepare($sql);
    try {
        $stmt->execute();
        $state = 'ok';
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

    if ($state == 'ok') {
        $sql1 = 'UPDATE t_group_product JOIN t_sub_group_product ON t_group_product.G_ID = t_sub_group_product.G_ID '
                . 'SET t_group_product.G_Status = "1", t_sub_group_product.SG_Status = "1" '
                . 'WHERE t_group_product.G_ID = "' . $gid . '" AND t_sub_group_product.G_ID = "' . $gid . '"';
        $stmt1 = $dbh->prepare($sql1);
        try {
            $stmt1->execute();
            $state1 = 'ok';
            return $state1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
?>

