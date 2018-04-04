<?php

include '../../../lib/connect.php';
$id = $_GET['id'];
$sub = $_GET['sub'];
$sql;
$num = 1;
if (empty($_GET['sub'])) {
    if ($_GET['id'] == 'All') {
        $sql = 'select P_ID,P_Name,P_Price,G_Name,tgp.G_ID,tsgp.SG_ID from t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE P_Status = "1"';
    } else {
        $sql = 'select P_ID,P_Name,P_Price,G_Name,tgp.G_ID,tsgp.SG_ID from t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tsgp.G_ID ="' . $id . '" AND P_Status = "1"';
    }
} else if (!empty($_GET['sub'])) {
    if ($_GET['sub'] == 'All') {
        $sql = 'select P_ID,P_Name,P_Price,G_Name,tgp.G_ID,tsgp.SG_ID from t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tsgp.G_ID ="' . $id . '" AND P_Status = "1"';
    } else {
        $sql = 'select P_ID,P_Name,P_Price,G_Name,tgp.G_ID,tsgp.SG_ID from t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tsgp.G_ID ="' . $id . '" AND tsgp.SG_ID ="' . $sub . '" AND P_Status = "1"';
    }
}

$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array('data' => array());
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $sql2 = 'select PU_Status from t_product_unit tpu JOIN t_product tp on tp.P_ID = tpu.P_ID WHERE tp.P_ID = "' . $result["P_ID"] . '" AND PU_Status ="1"';
    $stmt2 = $dbh->prepare($sql2);
    $stmt2->execute();
    $count = $stmt2->rowCount();
    //$uid = $result['G_ID'] . $result['SG_ID'];
    if ($count > 0) {
        $status = "<span class='label bg-green-gradient' style='font-size:12px; font-family:Tahoma;'>พร้อมจำหน่าย</span>";
        $action = '<center><button type="button" class="btn bg-yellow-gradient btn-sm" id="btn_test" onclick="setSell(\'' . $result['P_ID'] . '\',\'' . $result['P_Name'] . '\',\'' . $count . '\',\''.$result['P_Price'].'\')"><span class="fa fa-hand-pointer-o"></span> เลือก</button></center>';
    } else if ($count <= 0) {
        $status = "<span class='label bg-red-gradient' style='font-size:12px; font-family:Tahoma;'>ไม่มีสินค้า</span>";
        $action = '<center><button type="button" class="btn bg-yellow-gradient btn-sm" id="btn_test" onclick="setSell(\'' . $result['P_ID'] . '\',\'' . $result['P_Name'] . '\',\'' . $count . '\',\''.$result['P_Price'].'\')" disabled=""><span class="fa fa-hand-pointer-o"></span> เลือก</button></center>';
    }
    $arr['data'][] = array(
        $num,
        $result['P_ID'],
        $result['P_Name'],
        $result['G_Name'],
        $status,
        $count,
        $action,
    );
    $num++;
}
echo json_encode($arr);


//if (!empty($arr)) {
//    echo json_encode($arr);
//}else {
//    $return_error = array(
//        'message' => 'No records found'
//    );
//    echo json_encode($result_error);
//}
//echo json_encode($result_error);
//else{
//  echo 'null';  
//}
?>



