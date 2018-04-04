<?php
include '../../../lib/connect.php';
$eid = $_GET['eid'];
$action = $_GET['action'];
$status = 1;

if($action == 'delete'){
    $sql = 'DELETE FROM t_employee WHERE Emp_ID = "'.$eid.'"';
    $stmt = $dbh->prepare($sql);
    try {
        $stmt->execute();
        echo 'ลบข้อมูล '.$eid.' ออกจากระบบเรียบร้อย';
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}else if($action == 'return'){
    $sql = 'UPDATE t_employee '
            .'SET Emp_Status = ? '
            .'WHERE Emp_ID = ? ';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1,$status);
    $stmt->bindParam(2,$eid);
    
    try {
        $stmt->execute();
        echo 'เปิดใช้งาน '.$eid.' เรียบร้อย';
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
    
}
?>