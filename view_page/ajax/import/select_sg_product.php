<?php

include '../../../lib/connect.php';
$id = $_GET['id'];
$sub = $_GET['sub'];
$sql;
$num = 1;

//if (empty($_GET['sub'])) {
//    if ($_GET['id'] == 'All') {
//        $sql = 'select * FROM t_sub_group_product tsgp JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID';
//    } else {
//        $sql = 'select * FROM t_sub_group_product tsgp JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tsgp.G_ID ="' . $id . '"';
//    }
//} else if (!empty($_GET['sub'])) {
//    if ($_GET['sub'] == 'All') {
//        $sql = 'select * FROM t_sub_group_product tsgp JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tsgp.G_ID ="' . $id . '"';
//    } else {
//        $sql = 'select * FROM t_sub_group_product tsgp JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tsgp.G_ID ="' . $id . '" AND tsgp.SG_ID ="' . $sub . '"';
//    }
//}


if (empty($_GET['sub'])) {
    if ($_GET['id'] == 'All') {
        $sql = 'select * from t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE P_Status = "1"';
    } else {
        $sql = 'select * from t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tsgp.G_ID ="' . $id . '" AND P_Status = "1"';
    }
} else if (!empty($_GET['sub'])) {
    if ($_GET['sub'] == 'All') {
        $sql = 'select * from t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tsgp.G_ID ="' . $id . '" AND P_Status = "1"';
    } else {
        $sql = 'select * from t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tsgp.G_ID ="' . $id . '" AND tsgp.SG_ID ="' . $sub . '" AND P_Status = "1"';
    }
}

$stmt = $dbh->prepare($sql);
$stmt->execute();
//$arr = array();
$arr = array('data' => array());
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $uid = $result['G_ID'] . $result['SG_ID'];
    $action = '<center><button class="btn btn-warning btn-sm" id="btn_test" onclick="setPid(\'' . $result['P_ID'] . '\',\'' . $result['P_Name'] . '\',\''.$uid.'\')" data-dismiss="modal"><span class="fa fa-hand-pointer-o"></span> เลือก</button></center>';

    $arr['data'][] = array(
        $num,
        $result['P_ID'],
        $result['P_Name'],
        $result['B_Name'],
        $result['G_Name'],
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



