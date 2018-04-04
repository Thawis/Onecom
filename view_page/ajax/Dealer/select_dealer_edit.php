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
    $tel = $result["Dealer_Tel"];
}

list($name,$surname)=explode(" ",$dealer_name);

$sex = '';
if ($gender == 'ชาย') {
    $sex = '<select class="form-control" id="edit_dealer_gender" name="edit_dealer_gender">
                <option selected="selected" value="ชาย">ชาย</option>
                <option value="หญิง">หญิง</option>
            </select>';
} else if ($gender == 'หญิง') {
    $sex = '<select class="form-control" id="edit_dealer_gender" name="edit_dealer_gender">
                <option value="ชาย">ชาย</option>
                <option selected="selected" value="หญิง">หญิง</option>
            </select>';
}

echo '                              <tbody>
                                        <tr>
                                            <td width="20%" style="text-align:right; vertical-align:middle; font-weight: bold;">รหัสตัวแทน : </td>
                                            <td width="30%"><input type="text" class="form-control" id="edit_dealer_id" name="edit_dealer_id" value="' . $dealer . '" readonly=""/></td>
                                            <td width="20%" style="text-align:right; vertical-align:middle; font-weight: bold;">ชื่อบริษัท : </td>
                                            <td width="30%"><input type="text" class="form-control" id="edit_dealer_company" name="edit_dealer_company" value="' . $dealer_company . '" required=""/></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; vertical-align:middle; font-weight: bold;">ชื่อ : </td>
                                            <td width="30%"><input type="text" class="form-control" id="edit_dealer_name" name="edit_dealer_name" value="' . $name . '" required=""/></td>
                                            <td width="20%" style="text-align:right; vertical-align:middle; font-weight: bold;">ชื่อนามสกุล : </td>
                                            <td width="30%"><input type="text" class="form-control" id="edit_dealer_surname" name="edit_dealer_surname" value="' . $surname . '" required=""/></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; vertical-align:middle; font-weight: bold;">เพศ : </td>
                                            <td width="30%">' . $sex . '</td>
                                            <td width="20%" style="text-align:right; vertical-align:middle; font-weight: bold;">เบอร์โทรศัพท์ : </td>
                                            <td width="30%"><div class="input-group"><div class="input-group-addon"><i class="fa fa-phone"></i></div><input type="text" required="" id="edit_dealer_tel" name="edit_dealer_tel" class="form-control" data-inputmask="&quot;mask&quot;: &quot;999-999-9999&quot;" data-mask="" value="' . $tel . '"></div></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; vertical-align:middle; font-weight: bold;">ที่ตั้งบริษัท : </td>
                                            <td colspan="3" width="30%"><textarea class="form-control" id="edit_dealer_address" name="edit_dealer_address" rows="3" required="">' . $Address . '</textarea></td>
                                        </tr>
                                    </tbody>';
?>