<?php
include '../../../lib/connect.php';
$pid = $_GET['pid'];
$sql = "SELECT * FROM t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE P_ID = '" . $pid . "'";
$stmt = $dbh->prepare($sql);
$stmt->execute();

while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $gname = $result['G_Name'];
    $sgname = $result['SG_Name'];
    $pname = $result['P_Name'];
    $price = $result['P_Price'];
    $brand = $result['B_ID'];
    $detail = $result['P_Detail'];
    $picname = $result['P_Img'];
    $sub = $result['SG_ID'];
}

$sql2 = "SELECT * FROM t_brand WHERE B_Status = '1'";
$stmt2 = $dbh->prepare($sql2);
$stmt2->execute();

$dd = '';
$dd .= '<select class="form-control select2" id="dd_brand" name="dd_brand" style="width:100%">';
while ($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    if ($brand == $result2['B_ID']) {
        $dd .= '<option selected="selected" value="' . $result2['B_ID'] . '">' . $result2['B_Name'] . '</option>';
    } else {
        $dd .= '<option value="' . $result2['B_ID'] . '">' . $result2['B_Name'] . '</option>';
    }
}
$dd .= '</select>';



echo '<tbody>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">รหัสสินค้า : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;"><input type="text" class="form-control" id="P_ID" name="P_ID" value="'.$pid.'" readonly=""/></td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"><input type="hidden" name="edit_pid" value="'.$pid.'"/></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">ประเภทสินค้าหลัก : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;"><input type="text" class="form-control" value="'.$gname.'" readonly=""/></td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">ประเภทสินค้ารอง : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;"><input type="text" class="form-control"  value="'.$sgname.'" readonly=""/></td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"><input type="hidden" name="edit_sub" value="'.$sub.'"/></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">ชื่อสินค้า : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;"><input type="text" class="form-control" id="P_Name" name="P_Name" value="'.$pname.'" required=""/></td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">ราคาสินค้า : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;"><input type="number" class="form-control" id="P_Price" name="P_Price" value="'.$price.'" required=""/></td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"></td>
                                        </tr>                                        
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">ยี่ห้อ : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;">'.$dd.'</td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">รายละเอียด : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;"><textarea class="form-control" id="P_Detail" name="P_Detail" rows="4" required="">'.$detail.'</textarea></td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">รูปภาพ : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;"><input type="file" class="form-control" id="file_product" name="file_product" accept="image/*"><input type="hidden" id="pic_name" name="pic_name" value="'.$picname.'" /> </td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"></td>
                                        </tr>
                                    </tbody>';

?>


