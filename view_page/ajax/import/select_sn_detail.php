<?php

include '../../../lib/connect.php';
$pid = $_POST['pid'];
$sql = "SELECT * FROM temp_unit_sn WHERE P_ID ='" . $pid . "'";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$html = '<tbody>';
$num = 1;
while ($result = $stmt->fetch()) {
    $html .= '<tr><td width="10%" style="text-align:center; vertical-align: middle; text-align: center;">' . $num . '</td>';
    $html .= '<td widht="20%" style="text-align:center; vertical-align: middle; text-align: center;">' . $result['P_ID'] . '</td>';
    $html .= '<td width="70%" style="text-align:center; vertical-align: middle; text-align: center;">' . $result['S_ID'] . '</td></tr>';
    $num++;
}
$html .='</tbody>';
echo $html;
?>