<?php

session_start();
$emp = $_POST['emp'];
$emp_name =$_POST['emp_name'];
$datestart = substr($_POST['todate'], 0, 10);
$dateend = substr($_POST['todate'], 13, 10) . ' 23:00:00';

$_SESSION['R_repair_emp'] = $emp;
$_SESSION['R_repair_emp_name'] = $emp_name;
$_SESSION['R_repair_Start'] = $datestart;
$_SESSION['R_repair_End'] = $dateend;

?>