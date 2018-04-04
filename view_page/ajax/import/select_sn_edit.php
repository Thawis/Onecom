<?php

include '../../../lib/connect.php';
$pid = $_POST['pid'];
$sql = "SELECT * FROM temp_unit_sn WHERE P_ID ='" . $pid . "'";
$stmt = $dbh->prepare($sql);
$stmt->execute();
//$html = '<tbody>';
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch()) {
//    $html .= '<tr><td width="10%" style="text-align:center; vertical-align: middle; text-align: center;">' . $num . '</td>';
//    $html .= '<td widht="20%" style="text-align:center; vertical-align: middle; text-align: center;">' . $result['P_ID'] . '</td>';
//    $html .= '<td width="60%" style="text-align:center; vertical-align: middle; text-align: center;">' . $result['S_ID'] . '</td>';
//    $html .= '<td width="10%" style="text-align:center; vertical-align: middle; text-align: center;"><button type="button" class="btn bg-red-gradient sn_remove" value="'.$result['Number'].'" style="text-align:center;"><span class="fa fa-close"></span></button></td></tr>';
//    $num++;
    $button = '<button type="button" class="btn bg-red-gradient sn_remove" value="'.$result['Number'].'" style="text-align:center;"><span class="fa fa-close"></span></button>';
    $arr['data'][] = array(
        $num,
        $result['P_ID'],
        $result['S_ID'],
        $button
    );
    $num++;
}
//$html .='</tbody>';
echo json_encode($arr);
?>