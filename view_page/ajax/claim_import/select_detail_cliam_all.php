<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$cid = $_POST['cid'];
$sql = 'SELECT * From t_claim tc JOIN t_claim_detail tdc ON tc.ClaimItem_ID = tdc.ClaimItem_ID '
        . 'JOIN t_dealer td ON tc.Dealer_ID = td.Dealer_ID '
        . 'WHERE tc.ClaimItem_ID = "' . $cid . '" ';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();

$date_add = DateThai($result['Claim_Date_Add']);
$date_send = DateThai($result['Claim_Date_Send']);
$date_return_d = DateThai($result['Claim_Date_D_Return']);
if ($result['Claim_Date_C_Return'] == "" || $result['Claim_Date_C_Return'] == "0000-00-00") {
    $date_return_c = "ยังไม่ได้ส่งคืน";
} else {
    $date_return_c = DateThai($result['Claim_Date_C_Return']);
}
$dealer = $result['Dealer_Name'] . ' ( ' . $result['Dealer_Company'] . ' )';
$tel = getTel($result['Cus_Tel']);

$sql_sms = 'SELECT SMS_List_id From t_sms WHERE SMS_List_id = "' . $cid . '"';
$stmt_sms = $dbh->prepare($sql_sms);
$stmt_sms->execute();
$rows_sms = $stmt_sms->rowCount();
echo '                                 <tbody>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">เลขที่ใบเคลม : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;"><label class="label bg-green-gradient" stlye="font-size:14px; font-family:Tahoma;">' . $cid . '</label></td>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">วันที่รับเคลม : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $date_add . '</td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">ชื่อลูกค้า : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $result['Cus_Name'] . '</td>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">เบอร์โทรศัพท์ : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $tel . '</td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">อาการเสีย : </td>
                                            <td width="70%" colspan="3" class="font_2" style="vertical-align:middle;">' . $result['Claim_Manner'] . '</td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">ตัวแทนขายที่ส่งเคลม : </td>
                                            <td width="70%" colspan="3" class="font_2" style="vertical-align:middle;">' . $dealer . '</td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">วันที่ส่งเคลม : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $date_send . '</td>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">วันที่รับกลับมา : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $date_return_d . '</td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">วันที่ส่งคืนลูกค้า : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $date_return_c . '</td>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">การแจ้งเตือนผ่าน SMS : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">'.$rows_sms.' ครั้ง</td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">รายละเอียดการเคลม : </td>
                                            <td width="70%" colspan="3" class="font_2" style="vertical-align:middle;">' . $result['Claim_Detail'] . '</td>
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

