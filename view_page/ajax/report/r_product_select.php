<?php
session_start();
include '../../../lib/connect.php';
$group = $_POST['group'];
$sub = $_POST['sub'];
$_SESSION['r_product_group'] = $group;
$_SESSION['r_product_sub'] = $sub;
$arr = array("data" => array());
$num = 1;
$sql = '';
if ($group == "All") {
    if ($sub == "All") {
        $sql = 'SELECT G_Name,SG_Name,P_Name,P_Price,P_Status,P_ID FROM t_group_product tg JOIN t_sub_group_product tsgp ON  tg.G_ID = tsgp.G_ID JOIN t_product tp ON tp.SG_ID = tsgp.SG_ID';
    } else {
        $sql = 'SELECT G_Name,SG_Name,P_Name,P_Price,P_Status,P_ID FROM t_group_product tg JOIN t_sub_group_product tsgp ON  tg.G_ID = tsgp.G_ID JOIN t_product tp ON tp.SG_ID = tsgp.SG_ID '
                . 'WHERE tsgp.SG_ID = "' . $sub . '"';
    }
} else if ($group != "All") {
    if ($sub == "All") {
        $sql = 'SELECT G_Name,SG_Name,P_Name,P_Price,P_Status,P_ID FROM t_group_product tg JOIN t_sub_group_product tsgp ON  tg.G_ID = tsgp.G_ID JOIN t_product tp ON tp.SG_ID = tsgp.SG_ID '
                . 'WHERE tg.G_ID = "' . $group . '"';
    } else if ($sub != "All") {
        $sql = 'SELECT G_Name,SG_Name,P_Name,P_Price,P_Status,P_ID FROM t_group_product tg JOIN t_sub_group_product tsgp ON  tg.G_ID = tsgp.G_ID JOIN t_product tp ON tp.SG_ID = tsgp.SG_ID '
                . 'WHERE tg.G_ID = "' . $group . '" AND tsgp.SG_ID = "' . $sub . '"';
    }
}
$stmt = $dbh->prepare($sql);
$stmt->execute();
while ($result = $stmt->fetch()) {
    $sql_u = 'SELECT * FROM t_product tp JOIN t_product_unit tpu ON tp.P_ID = tpu.P_ID '
            . 'WHERE tp.P_ID = "'.$result['P_ID'].'" AND tpu.PU_Status = "1"';
    $stmt_u = $dbh->prepare($sql_u);
    $stmt_u->execute();
    $row_u = $stmt_u->rowCount(); 
    if($result['P_Status']=="1"){
        $status = 'ปกติ';
    }  else {
        $status = 'ยกเลิก';
    }
    $type = 'ประเภทหลัก : '.$result['G_Name']. '<br> ประเภทรอง : '.$result['SG_Name'];
    $price = number_format($result['P_Price']).' บาท';    
    $arr['data'][] = array(
        $num,
        $result['P_ID'],
        $result['P_Name'],
        $type,
        $price,
        $status,
        $row_u
    );
    $num++;
}
echo json_encode($arr);
?>