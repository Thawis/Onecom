<?php
session_start();
include '../../../lib/connect.php';
require '../../../lib/getDate_TH.php';
$type = $_POST['type'];
$datestart = substr($_POST['todate'], 0, 10);
$dateend = substr($_POST['todate'], 13, 10).' 23:00:00';

$_SESSION['R_Sell_Type'] = $type;
$_SESSION['R_Sell_Start'] = $datestart;
$_SESSION['R_Sell_End'] = $dateend;
//echo 'type : ' . $type . ' start : ' . $datestart . ' end : ' . $dateend;

if ($type == 'All') {
    $sql = 'SELECT ts.ORD_ID,Date_Sell,P_Name,P_Price,Unit_ID,S_ID,te.Emp_ID,S_ID,ORD_Type,te.Emp_Name '
            . 'FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID '
            . 'JOIN t_employee te ON ts.Emp_ID = te.Emp_ID '
            . 'WHERE (Date_Sell >= "' . $datestart . '" AND Date_Sell <= "' . $dateend . '")';
} else {
    $sql = 'SELECT ts.ORD_ID,Date_Sell,P_Name,P_Price,Unit_ID,S_ID,te.Emp_ID,S_ID,ORD_Type,te.Emp_Name '
            . 'FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID '
            . 'JOIN t_employee te ON ts.Emp_ID = te.Emp_ID '
            . 'WHERE (Date_Sell >= "' . $datestart . '" AND Date_Sell <= "' . $dateend . '") AND ORD_Type = "' . $type . '"';
}

$num = 1;
$arr = array("data" => array());
$stmt = $dbh->prepare($sql);
$stmt->execute();
while ($result = $stmt->fetch()) {
    $datethai = DateThaiTime($result['Date_Sell']);
    $Price = number_format($result['P_Price']).' บาท';
    
    if($result['ORD_Type']=='sell'){
        $type = 'ขายปกติ';
    }else if($result['ORD_Type']=='repair'){
        $type = 'ขายซ่อม';
    }
    
    $detail = 'ชื่อสินค้า : '.$result['P_Name'].' <br>'
            . 'เลขที่สินค้า : '.$result['Unit_ID'].'<br>'
            . 'S/N : '.$result['S_ID'].'<br>'
            . 'ขายโดย : '.$result['Emp_Name'].' ( '.$result['Emp_ID'].' )';
    
    $arr['data'][] = array(
        $num,
        $result['ORD_ID'],
        $datethai,
        $detail,
        $Price,
        $type
    );
    $num++;
}
echo json_encode($arr);
?>