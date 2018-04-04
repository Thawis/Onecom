<?php

include '../../../lib/connect.php';
$dealer_id = $_POST['dealer_id'];
$sql = 'SELECT * FROM t_dealer WHERE Dealer_ID ="' . $dealer_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();

while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $dealer = $result["Dealer_ID"];
    $dealer_name = $result["Dealer_Name"];
    $Address = $result["Dealer_Address"];
    $dealer_company = $result["Dealer_Company"];
    $status = $result["Dealer_Status"];
    $gender = $result["Dealer_Gender"];
    $tel = getTel($result["Dealer_Tel"]);
}

if($status == "1"){
    $status_1 = '<label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">ปกติ</label>';
}else{
    $status_1 = '<label class="label bg-red-gradient" style="font-size: 12px; font-family: Tahoma;">ยกเลิก</label>';
}

echo '                              <tbody>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">รหัสตัวแทน : </td>
                                            <td width="30%"><label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">' . $dealer . '</label></td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ชื่อตัวแทน : </td>
                                            <td width="30%">' . $dealer_name . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ชื่อบริษัท : </td>
                                            <td width="30%">' . $dealer_company . '</td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">สถานะ : </td>
                                            <td width="30%">' . $status_1 . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">เพศ : </td>
                                            <td width="30%">' . $gender . '</td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">เบอร์โทรศัพท์ : </td>
                                            <td width="30%">' . $tel . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ที่ตั้งบริษัท : </td>
                                            <td colspan="3" width="30%"><textarea class="form-control" rows="3" readonly="">'.$Address.'</textarea></td>
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