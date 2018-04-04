<?php

include '../../../lib/connect.php';
$pid = $_GET['pid'];
$sql = 'select * from t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tp.P_ID = "' . $pid . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $pic = $result["P_Img"];
    $p_id = $result["P_ID"];
    $pname = $result["P_Name"];
    $group = $result["G_Name"];
    $sub = $result["SG_Name"];
    $brand = $result["B_Name"];
    $price = number_format($result["P_Price"]);
    $detail = $result["P_Detail"];
}
if($pic!=null){
    $epic = '../img/product/'.$pic;
}else{
    $epic = "../img/product/p_noimg.png";
}
echo '                                 <tbody>
                                        <tr>
                                            <td colspan="5"width="100%" style="vertical-align: middle; text-align: center;">
                                                <img src="'.$epic.'" alt="" class="img-thumbnail" style="width:220px; height:150px;"/> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">รหัสสินค้า : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;"><label class="label bg-green-gradient" stlye="font-size:14px; font-family:Tahoma;">' . $p_id . '</label></td>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">ชื่อสินค้า : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $pname . '</td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">ประเภทสินค้าหลัก : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $group . '</td>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">ประเภทสินค้ารอง : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $sub . '</td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">ยี่ห้อ : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $brand . '</td>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">ราคา : </td>
                                            <td width="25%" class="font_2" style="vertical-align:middle;">' . $price. ' บาท </td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">รายละเอียด : </td>
                                            <td width="70%" colspan="3" class="font_2" style="vertical-align:middle;"><textarea class="form-control" rows="4" required="" readonly="">'.$detail.'</textarea></td>
                                            <td width="10%"></td>
                                        </tr></tbody>';
?>

