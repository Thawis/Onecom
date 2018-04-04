<?php

session_start();
//include '../../../lib/connect.php';
$type = $_POST['type'];
$datestart = substr($_POST['todate'], 0, 10);
$dateend = substr($_POST['todate'], 13, 10) . ' 23:00:00';

$_SESSION['R_Sell_Type'] = $type;
$_SESSION['R_Sell_Start'] = $datestart;
$_SESSION['R_Sell_End'] = $dateend;

//$sql_total = 'SELECT SUM(P_Price) FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID '
//        . 'WHERE (Date_Sell >= "' . $datestart . '" AND Date_Sell <= "' . $dateend . '")';
//$stmt_total = $dbh->prepare($sql_total);
//$stmt_total->execute();
//$result_total = $stmt_total->fetch();
//$_SESSION['R_Sell_Total'] = $result_total['SUM(P_Price)'];


echo 'ok';
?>