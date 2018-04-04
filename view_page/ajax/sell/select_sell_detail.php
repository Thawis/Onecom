<?php

include '../../../lib/connect.php';
include '../../../lib/getDate_TH.php';
$ord_id = $_POST['ord_id'];
//$sql = "SELECT * FROM t_sell WHERE ORD_ID = '" . $ord_id . "' AND ORD_Status = '1'";
$sql = "SELECT ORD_ID,Date_Sell,Total_Money,ORD_Type,te.Emp_ID,Emp_Name,tc.Customer_ID,Customer_Address,Customer_FullName "
        . "FROM t_sell ts JOIN t_customer tc ON ts.Customer_ID = tc.Customer_ID JOIN t_employee te ON ts.Emp_ID = te.Emp_ID "
        . "WHERE ORD_ID = '" . $ord_id . "' AND ORD_Status = '1'";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();

$totalprice = number_format($result['Total_Money']) . " บาท";
$datesell = DateThaiTime($result['Date_Sell']);
if ($result['ORD_Type'] == "sell") {
    $type = '<span class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">ขายปกติ</span>';
} else if ($result['ORD_Type'] == 'repair') {
    $type = '<span class="label bg-blue-gradient" style="font-size: 12px; font-family: Tahoma;">ซ่อมขาย</span>';
}
echo '                              <tbody>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">เลขที่ใบเสร็จ : </td>
                                            <td width="30%">' . $result['ORD_ID'] . '</td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">วัน - เวลาที่ขาย : </td>
                                            <td width="30%">' . $datesell . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ราคารวมสุทธิ : </td>
                                            <td width="30%">' . $totalprice . '</td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ประเภทการขาย : </td>
                                            <td width="30%">' . $type . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ลูกค้า : </td>
                                            <td width="30%">' . $result['Customer_FullName'] . '</td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ขายโดย : </td>
                                            <td width="30%">' . $result['Emp_Name'] . ' ( ' . $result['Emp_ID'] . ' )</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ที่อยู่ : </td>
                                            <td colspan="3" width="30%">' . $result['Customer_Address'] . '</td>
                                        </tr>
                                    </tbody>';
?>