<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$item_id = $_POST['item_id'];
$sql = 'SELECT * FROM t_repair tr JOIN t_repair_item tri ON tr.R_ID = tri.R_ID JOIN t_customer tc ON tr.Customer_ID = tc.Customer_ID '
        . 'WHERE (tri.Item_Status = "1" OR tri.Item_Status = "2" OR tri.Item_Status = "3" OR tri.Item_Status = "4" OR tri.Item_Status = "0") AND tri.Item_ID = "' . $item_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();

$timeThai = DateThaiTime($result['R_DATE']);
$custel = getTel($result['Customer_Tel']);
echo '                              <tbody>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">เลขที่ใบรับซ่อม : </td>
                                            <td width="30%"><label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">' . $result['R_ID'] . '</label></td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">วันที่รับซ่อม : </td>
                                            <td width="30%">' . $timeThai . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ประเภทสินค้าซ่อม : </td>
                                            <td width="30%"><label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">' . $result['Type_Item'] . '</label>'
        . '                                 <input type="hidden" id="hidden_item_type" value="'.$result['Type_Item'].'"/></td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ชื่อสินค้าซ่อม : </td>
                                            <td width="30%"><label class="label bg-red-gradient" style="font-size: 12px; font-family: Tahoma;">' . $result['Item_Name'] . '</label></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">Serial Number : </td>
                                            <td width="30%">' . $result['Item_SN'] . '</td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">เลขที่สินค้าซ่อม : </td>
                                            <td width="30%">' . $result['Item_ID'] . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">อาการเสีย - สิ่งที่ให้ทำ : </td>
                                            <td width="30%">' . $result['Item_manner'] . '</td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">อุปกรณ์พ่วงต่อ : </td>
                                            <td width="30%">' . $result['Item_eqm'] . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ชื่อลูกค้า : </td>
                                            <td width="30%">' . $result['Customer_FullName'] . '</td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">เบอร์โทรศัพท์ : </td>
                                            <td width="30%">' . $custel . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ที่อยู่ : </td>
                                            <td colspan="3" width="30%">' . $result['Customer_Address'] . '</td>
                                        </tr>
                                    </tbody>';

function getTel($tel) {
    $f1 = substr($tel, 0, 3) . '-';
    $f2 = substr($tel, 3, 3) . '-';
    $f3 = substr($tel, 6, 4);
    return $f1 . $f2 . $f3;
}

;
?>

