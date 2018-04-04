<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$ord_id = $_POST['ord_id'];
$sql = 'SELECT ts.ORD_ID,P_Name,S_ID,Unit_ID,Warranty,P_Price,Total_Money,te.Emp_ID,te.Emp_Name '
        . 'FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID JOIN t_employee te ON te.Emp_ID = ts.Emp_ID WHERE ts.ORD_ID = "' . $ord_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$html = '<tbody>';
$num = 1;
$emp_id = "";
$emp_name = "";
$total = "";
while ($result = $stmt->fetch()) {
    $emp_id = $result['Emp_ID'];
    $emp_name = $result['Emp_Name'];
    $total = number_format($result['Total_Money']);
    $price = number_format($result['P_Price']);
    $html .= '                                      <tr><td width="10%" class="font_4">' . $num . '</td>
                                                    <td width="25%" class="font_4">' . $result['P_Name'] . '</td>
                                                    <td width="35%" class="font_4" style="text-align:left;">เลขที่สินค้า : ' . $result['Unit_ID'] . '</br>S/N : ' . $result['S_ID'] . '</td>
                                                    <td width="15%" class="font_4">' . $result['Warranty'] . '</td>
                                                    <td width="20%" class="font_4">' . $price . ' บาท</td></tr>';
    $num++;
}
$html .= '<tr style="background-color:#D0D0CD;">'
        . '<td colspan="2" class="font_4 b3" style="text-align:right;">ผู้รับเงิน : </td>'
        . '<td width="35%" class="font_4 b3">' . $emp_name . ' (' . $emp_id . ')</td>'
        . '<td width="15%" class="font_4 b3" style="text-align:right;">ราคารวม : </td>'
        . '<td width="20%" class="font_4 b3">' . $total . ' บาท</td>'
        . '</tr>';
$html .= '</tbody>';
echo $html;
?>