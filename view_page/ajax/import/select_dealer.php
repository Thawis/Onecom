<?php
include '../../../lib/connect.php';
$sql = 'SELECT * FROM t_dealer WHERE Dealer_Status = "1"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array('data' => array());
$num = 1;
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $action = '<center><button class="btn btn-warning btn-sm" id="btn_deal" onclick="setD_id(\''.$result['Dealer_ID'].'\')" data-dismiss="modal"><span class="fa fa-hand-pointer-o"></span> เลือก</button></center>';
    
        $arr['data'][] = array(
        $num,
        $result['Dealer_ID'],
        $result['Dealer_Name'],
        $result['Dealer_Company'],
        $action,
    );
        $num++;
}
echo json_encode($arr);
?>