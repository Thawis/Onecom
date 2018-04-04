<?php

include '../lib/connect.php';
session_start();
$id = $_SESSION['login_id'];
$type = $_SESSION['login_type'];
$S_id = session_id();
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y/m/d");
$time = $dt->format("H:i");
$event = 'logout';

$sql = 'INSERT INTO t_logfile VALUES(?,?,?,?,?,?,?)';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $dummy);
$stmt->bindParam(2, $id);
$stmt->bindParam(3, $type);
$stmt->bindParam(4, $today);
$stmt->bindParam(5, $time);
$stmt->bindParam(6, $event);
$stmt->bindParam(7, $S_id);
try {
    $stmt->execute();
} catch (Exception $ex) {
    echo $ex->getMessage();
}


session_destroy();
header("location: ../index.php");
?>