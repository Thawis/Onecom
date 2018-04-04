<?php

session_start();
if (!empty($_SESSION['login_id']) && !empty($_SESSION['login_type'])) {
    if ($_SESSION['login_type'] == "admin" || $_SESSION['login_type'] == "user" || $_SESSION['login_type'] == "root") {
        $id = $_SESSION['login_id'];
        $sql = 'SELECT * FROM t_employee WHERE Emp_ID = "' . $id . '"';
        $stmt = $dbh->prepare($sql);
        try {
            $stmt->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        $rows = $stmt->fetch();
        $Ename = $rows['Emp_Name'];
        $Eid = $rows['Emp_ID'];
        $ImgName = $rows['Emp_Img'];

        if ($_SESSION['login_type'] == "root") {
            $emp_type_show = "เจ้าของร้าน";
        } else if ($_SESSION['login_type'] == "admin") {
            $emp_type_show = "หัวหน้าช่าง";
        } else {
            $emp_type_show = "ช่างซ่อมทั่วไป";
        }
    } else {
        header("location: ../index.php");
    }
} else if (empty($_SESSION['login_id']) || empty($_SESSION['login_type'])) {
    session_destroy();
    header("location: ../index.php");
}
?>