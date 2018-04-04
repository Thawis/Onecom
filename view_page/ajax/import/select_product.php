<?php

include '../../../lib/connect.php';
//$sql = 'SELECT * FROM t_product tp JOIN t_brand tb on tp.B_ID = tb.B_ID';
$sql = 'select * from t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE P_Status = "1"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array('data' => array());
$num = 1;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $uid = $result['G_ID'].$result['SG_ID'];
    $action = '<center><button class="btn btn-warning btn-sm" id="btn_test" onclick="setPid(\''.$result['P_ID'].'\',\''.$result['P_Name'].'\',\''.$uid.'\')" data-dismiss="modal"><span class="fa fa-hand-pointer-o"></span> เลือก</button></center>';
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
?>

