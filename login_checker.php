<?php

include 'lib/connect.php';
$user = $_POST['username'];
$pass = $_POST['password'];
$option = [
    'cost' => 12,
    'salt' => md5('varis209')
];
$hash = password_hash($pass, PASSWORD_DEFAULT, $option);
$sql = "SELECT * FROM t_employee WHERE Emp_ID='" . $user . "'AND Emp_Pass='" . $hash . "'";
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $dbh->prepare($sql);
try {
    $stmt->execute();
} catch (Exception $ex) {
    echo $ex->getMessage();
}
$rows = $stmt->fetch();


session_start();
$S_id = session_id();
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y/m/d");
$time = $dt->format("H:i");
$empid = $rows['Emp_ID'];
$empType = $rows['Emp_Type'];
$event = 'login';
$name = $rows['Emp_Name'];


if (password_verify($pass, $rows['Emp_Pass'])) {
    if ($rows['Emp_Type'] == 'admin' and $rows['Emp_Status'] == 1) {
        $sql2 = 'INSERT INTO t_logfile VALUES(?,?,?,?,?,?,?)';
        $stmt = $dbh->prepare($sql2);
        $stmt->bindParam(1, $dummy);
        $stmt->bindParam(2, $empid);
        $stmt->bindParam(3, $empType);
        $stmt->bindParam(4, $today);
        $stmt->bindParam(5, $time);
        $stmt->bindParam(6, $event);
        $stmt->bindParam(7, $S_id);
        try {
            $stmt->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        $_SESSION['login_id'] = $user;
        $_SESSION['login_type'] = $empType;
        header("location: view_page/Index.php");
    } else if ($rows['Emp_Type'] == 'user' && $rows['Emp_Status'] == 1) {
        $sql2 = 'INSERT INTO t_logfile VALUES(?,?,?,?,?,?,?)';
        $stmt = $dbh->prepare($sql2);
        $stmt->bindParam(1, $dummy);
        $stmt->bindParam(2, $empid);
        $stmt->bindParam(3, $empType);
        $stmt->bindParam(4, $today);
        $stmt->bindParam(5, $time);
        $stmt->bindParam(6, $event);
        $stmt->bindParam(7, $S_id);
        try {
            $stmt->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        $_SESSION['login_id'] = $user;
        $_SESSION['login_type'] = $empType;
        header("location: view_page/Index.php");
    } else if ($rows['Emp_Type'] == 'root' && $rows['Emp_Status'] == 1) {
        $sql2 = 'INSERT INTO t_logfile VALUES(?,?,?,?,?,?,?)';
        $stmt = $dbh->prepare($sql2);
        $stmt->bindParam(1, $dummy);
        $stmt->bindParam(2, $empid);
        $stmt->bindParam(3, $empType);
        $stmt->bindParam(4, $today);
        $stmt->bindParam(5, $time);
        $stmt->bindParam(6, $event);
        $stmt->bindParam(7, $S_id);
        try {
            $stmt->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        $_SESSION['login_id'] = $user;
        $_SESSION['login_type'] = $empType;
        header("location: view_page/Index.php");
    } else {
        header("location: index.php");
    }
} else {
    header("location: index.php");
}
?>