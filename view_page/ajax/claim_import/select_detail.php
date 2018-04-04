<?php

include '../../../lib/connect.php';
$name = $_POST['name'];
$sn = $_POST['sn'];
$cid = $_POST['c_id'];

//$sql_1 = 'SELECT * FROM t_claim WHERE ClaimItem_ID = "' . $cid . '"';
$sql_1 = 'SELECT * FROM t_claim_exchange WHERE P_Name = "' . $name . '" AND S_ID = "' . $sn . '"';
$stmt_1 = $dbh->prepare($sql_1);
$stmt_1->execute();
//$result_1 = $stmt_1->fetch();
$rows_1 = $stmt_1->rowCount();
if ($rows_1 > 0) {
    $sql_2 = 'SELECT * FROM t_claim_exchange WHERE P_Name = "' . $name . '" AND S_ID = "' . $sn . '"';
    $stmt_2 = $dbh->prepare($sql_2);
    $stmt_2->execute();
    $result2 = $stmt_2->fetch();
    echo '                              <tbody>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;"> เลขที่ใบเคลม : </td>
                                            <td width="35%"><input type="text" class="form-control" id="item_c_id" name="item_c_id" value="' . $cid . '" readonly=""/></td>
                                            <td width="15%"></td>
                                            <td width="20%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;"> ชื่อสินค้า : </td>
                                            <td width="50%" colspan="2"><input type="text" class="form-control" id="item_name_old" name="item_name_old" value="' . $result2['P_Name'] . '" readonly=""/></td>
                                            <td width="20%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;"> S/N (เก่า) : </td>
                                            <td width="50%" colspan="2"><input type="text" class="form-control" id="item_sn_old" name="item_sn_old" value="' . $result2['S_ID'] . '" readonly=""/></td>
                                            <td width="20%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;"> วันที่หมดประกัน : </td>
                                            <td width="35%"><input type="text" class="form-control" id="item_endshop" name="item_endshop" value="' . $result2['End_Warranty_Shop'] . '" readonly=""/></td>
                                            <td width="15%"></td>
                                            <td width="20%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;"> ชื่อสินค้าใหม่ : </td>
                                            <td width="35%"><input type="text" class="form-control" id="item_name_new" name="item_name_new" value="" required=""/></td>
                                            <td width="15%"></td>
                                            <td width="20%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;"> S/N (ใหม่) : </td>
                                            <td width="50%" colspan="2"><input type="text" class="form-control" id="item_sn_new" name="item_sn_new" value="" required=""/></td>
                                            <td width="20%"></td>
                                            <input type="hidden" name="e_war" value="' . $result2['End_Warranty'] . '"/>
                                            <input type="hidden" name="date_s" value="' . $result2['Date_Sell_Shop'] . '"/>
                                            <input type="hidden" name="war" value="' . $result2['Warranty'] . '"/>
                                        </tr>
                                    </tbody>';
} else if ($rows_1 == 0) {
    $sql = 'SELECT * FROM t_sell_detail WHERE P_Name = "' . $name . '" AND S_ID = "' . $sn . '"';
    $stmt = $dbh->prepare($sql);
    try {
        $stmt->execute();
        $result = $stmt->fetch();
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

    echo '                              <tbody>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;"> เลขที่ใบเคลม : </td>
                                            <td width="35%"><input type="text" class="form-control" id="item_c_id" name="item_c_id" value="' . $cid . '" readonly=""/></td>
                                            <td width="15%"></td>
                                            <td width="20%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;"> ชื่อสินค้า : </td>
                                            <td width="50%" colspan="2"><input type="text" class="form-control" id="item_name_old" name="item_name_old" value="' . $result['P_Name'] . '" readonly=""/></td>
                                            <td width="20%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;"> S/N (เก่า) : </td>
                                            <td width="50%" colspan="2"><input type="text" class="form-control" id="item_sn_old" name="item_sn_old" value="' . $result['S_ID'] . '" readonly=""/></td>
                                            <td width="20%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;"> วันที่หมดประกัน : </td>
                                            <td width="35%"><input type="text" class="form-control" id="item_endshop" name="item_endshop" value="' . $result['End_Warranty_Shop'] . '" readonly=""/></td>
                                            <td width="15%"></td>
                                            <td width="20%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;"> ชื่อสินค้าใหม่ : </td>
                                            <td width="35%"><input type="text" class="form-control" id="item_name_new" name="item_name_new" value="" required=""/></td>
                                            <td width="15%"></td>
                                            <td width="20%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;"> S/N (ใหม่) : </td>
                                            <td width="50%" colspan="2"><input type="text" class="form-control" id="item_sn_new" name="item_sn_new" value="" required=""/></td>
                                            <td width="20%"></td>
                                            <input type="hidden" name="e_war" value="' . $result['End_Warranty'] . '"/>
                                            <input type="hidden" name="date_s" value="' . $result['Date_Sell_Shop'] . '"/>
                                            <input type="hidden" name="war" value="' . $result['Warranty'] . '"/>
                                        </tr>
                                    </tbody>';
}
?>