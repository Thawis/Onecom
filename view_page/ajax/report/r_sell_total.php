<?php
session_start();
include '../../../lib/connect.php';
require '../../../lib/getDate_TH.php';
$type = $_POST['type'];
$datestart = substr($_POST['todate'], 0, 10);
$dateend = substr($_POST['todate'], 13, 10).' 23:00:00';
//echo 'type : ' . $type . ' start : ' . $datestart . ' end : ' . $dateend;

if ($type == 'All') {
    $sql = 'SELECT SUM(P_Price) '
            . 'FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID '
            . 'JOIN t_employee te ON ts.Emp_ID = te.Emp_ID '
            . 'WHERE (Date_Sell >= "' . $datestart . '" AND Date_Sell <= "' . $dateend . '")';
} else {
    $sql = 'SELECT SUM(P_Price) '
            . 'FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID '
            . 'JOIN t_employee te ON ts.Emp_ID = te.Emp_ID '
            . 'WHERE (Date_Sell >= "' . $datestart . '" AND Date_Sell <= "' . $dateend . '") AND ORD_Type = "' . $type . '"';
}

$num = 1;
$arr = array("data" => array());
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$total = number_format($result['SUM(P_Price)']).' บาท';
$_SESSION['R_Sell_Total'] = $total;
echo $total;
?>