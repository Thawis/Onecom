<?php

include '../../../lib/connect.php';
$eid = $_GET['eid'];
$state = $_GET['state'];

if ($state == 'reset') {
    $pass = 'onecomputer';
    $option = [
        'cost' => 12,
        'salt' => md5('varis209')];
    $hash = password_hash($pass, PASSWORD_DEFAULT, $option);
    $sql = "UPDATE t_employee"
            . " SET Emp_Pass = ?"
            . " WHERE Emp_ID = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $hash);
    $stmt->bindParam(2, $eid);
    try {
        $stmt->execute();
        echo "รีเซ็ตรหัสผ่านเรียบร้อย";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
} else if ($state == 'ban') {
    $status = '0';
    $sql = "UPDATE t_employee"
            . " SET Emp_Status = ?"
            . " WHERE Emp_ID = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $status);
    $stmt->bindParam(2, $eid);
    try {
        $stmt->execute();
        echo "ระงับการใช้งานเรียบร้อย";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
?>