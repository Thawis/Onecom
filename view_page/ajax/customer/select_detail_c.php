<?php

include '../../../lib/connect.php';
$cusid = $_POST['cusid'];
$sql = 'SELECT * FROM t_customer WHERE Customer_ID = "' . $cusid . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$tel = getTel($result['Customer_Tel']);
if ($result['Customer_Status'] == "1") {
    $status = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma">ปกติ</label>';
} else {
    $status = '<label class="label bg-red-gradient" style="font-size:12px; font-family:Tahoma">ยกเลิก</label>';
}

echo '                                  <tbody>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">รหัสลูกค้า : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $result['Customer_ID'] . '</td>
                                            <td width="20%" class="font_1" style="vertical-align:middle">ชื่อลูกค้า : </td>
                                            <td width="25%" colspan="2" class="font_2" style="vertical-align:middle;">' . $result['Customer_FullName'] . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">เบอร์โทรศัพท์ : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $tel . '</td>
                                            <td width="20%" class="font_1" style="vertical-align:middle">สถานะ : </td>
                                            <td width="25%" class="" style="vertical-align:middle;">' . $status . '</td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">ที่อยู่ : </td>
                                            <td width="70%" colspan="3" class="font_2" style="vertical-align:middle;">' . $result['Customer_Address'] . '</td>
                                            <td width="10%"></td>
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