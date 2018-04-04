<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$ord_id = $_POST['ord_id'];
$sql = 'SELECT Customer_FullName,Customer_Address,ts.ORD_ID,ts.Date_Sell FROM t_sell ts JOIN t_customer tc ON ts.Customer_ID = tc.Customer_ID WHERE ts.ORD_ID = "' . $ord_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$thai_date = DateThaiTime($result['Date_Sell']);
echo '                                      <tbody>
                                                <tr>
                                                    <td width="10%" class="font_1" style="font-weight: bold;">วันที่ : </td>
                                                    <td width="40%" class="font_2">' . $thai_date . '</td>
                                                    <td width="20%" class="font_1" style="font-weight: bold;">เลขที่ใบเสร็จรับเงิน : </td>
                                                    <td width="30%" class="font_2">' . $result['ORD_ID'] . '</td>
                                                </tr>
                                                <tr>
                                                    <td width="10%" class="font_1" style="font-weight: bold;">ชื่อลูกค้า : </td>
                                                    <td width="40%" class="font_2">' . $result['Customer_FullName'] . '</td>
                                                    <td width="20%" class="font_1" style="font-weight: bold;"></td>
                                                    <td width="30%" class="font_2"></td>
                                                </tr>
                                                <tr>
                                                    <td width="10%" class="font_1" style="font-weight: bold;">ที่อยู่ : </td>
                                                    <td width="90%" colspan="3" class="font_3">' . $result['Customer_Address'] . '</td>
                                                </tr>
                                            </tbody>'
?>