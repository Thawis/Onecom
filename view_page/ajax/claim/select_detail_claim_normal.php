<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$sql = 'SELECT * FROM t_sell_detail WHERE Number = "' . $_POST['number'] . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();

if ($result['End_Warranty_Shop'] == "0000-00-00" && $result['End_Warranty'] == "0000-00-00") {
    $date_sell = DateThai($result['Date_Sell_Shop']);
    $date_shop = "-";
    $date_dealer = "-";
} else {
    $date_sell = DateThai($result['Date_Sell_Shop']);
    $date_shop = DateThai($result['End_Warranty_Shop']);
    $date_dealer = DateThai($result['End_Warranty']);
}
echo '                              <tbody>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">ชื่อสินค้า : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $result['P_Name'] . '</td>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">เลขที่สินค้า : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $result['Unit_ID'] . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">S/N : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $result['S_ID'] . '</td>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">วันที่ขายสินค้า : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;"><label class="label bg-green-gradient font_2">' . $date_sell . '</label></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">วันที่หมดประกันร้าน : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;"><label class="label bg-yellow-gradient font_2">' . $date_shop . '</label></td>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">วันที่หมดประกันตัวแทน : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;"><label class="label bg-blue-gradient font_2">' . $date_dealer . '</label></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">ระยะเวลาประกัน : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;"><label class="label bg-red-gradient font_2">' . $result['Warranty'] . '</label></td>
                                            <td width="20%" class="font_1" style="vertical-align:middle;"></td>
                                            <td width="25%"></td>
                                        </tr>
                                    </tbody>';
?>