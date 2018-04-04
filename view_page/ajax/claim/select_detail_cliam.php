<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$c_id = $_POST['c_id'];
$sql = 'SELECT * FROM t_claim WHERE ClaimItem_ID = "' . $c_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$tel = getTel($result['Cus_Tel']);
$date_claim = DateThai($result['Claim_Date_Add']);

echo '<tbody>
    <tr>
        <td width="20%" class="font_1" style="vertical-align:middle;">เลขที่ใบเคลมสินค้า : </td>
        <td width="25%"><input type="text" class="form-control" value="' . $result['ClaimItem_ID'] . '" required="" readonly="" /></td>
        <td width="20%" class="font_1" style="vertical-align:middle;">วันที่รับเคลม : </td>
        <td width="35%" colspan="2"><input type="text" class="form-control" value="' . $date_claim . '" required="" readonly="" /></td>
    </tr>
    <tr>
        <td width="20%" class="font_1" style="vertical-align:middle;">ชื่อสินค้า : </td>
        <td width="45%" colspan="2"><input type="text" class="form-control" readonly="" required="" value="'.$result['ClaimItem_Name'].'" /></td>
        <td width="25%"></td>
        <td width="10%"></td>
    </tr>
    <tr>
        <td width="20%" class="font_1" style="vertical-align:middle;">S/N  : </td>
        <td colspan="2" width="45%"><input type="text" class="form-control"  value="' . $result['S_ID'] . '" required="" readonly="" /></td>
        <td width="25%"></td>
        <td width="10%"></td>
    </tr>
    <tr>
        <td width="20%" class="font_1" style="vertical-align:middle;">อาการเสีย - ชำรุด : </td>
        <td colspan="2" width="45%"><input type="text" class="form-control" value="' . $result['Claim_Manner'] . '" readonly="" required="" /></td>
        <td width="25%"></td>
        <td width="10%"></td>
    </tr>
    <tr>
        <td width="20%" class="font_1" style="vertical-align:middle;">ชื่อ - นามสกุล ลูกค้า : </td>
        <td colspan="2"width="45%"><input type="text" class="form-control" value="' . $result['Cus_Name'] . '"  readonly="" required=""/></td>
        <td width="25%"></td>
        <td width="10%"></td>
    </tr>
    <tr>
        <td width="20%" class="font_1" style="vertical-align:middle;">เบอร์โทรศัพท์ : </td>
        <td width="25%"><input type="text" style="text-align:center;" class="form-control" value="' . $tel . '" readonly=""></td>
        <td width="20%"></td>
        <td width="25%"></td>
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

