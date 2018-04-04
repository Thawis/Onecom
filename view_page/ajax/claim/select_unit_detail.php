<?php

include '../../../lib/connect.php';
$ord_id = $_POST['ord_id'];
$unit_id = $_POST['unit_id'];
$sql = 'SELECT * FROM t_sell_detail WHERE ORD_ID = "' . $ord_id . '" AND Unit_ID = "' . $unit_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
echo '                                  <tbody>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">เลขที่ขายสินค้า : </td>
                                            <td width="25%"><input type="text" class="form-control" id="ex_ord_id" name="ex_ord_id" value="' . $result['ORD_ID'] . '" required="" readonly="" /></td>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">เลขที่สินค้า(เก่า) : </td>
                                            <td width="35%" colspan="2"><input type="text" class="form-control" id="ex_unit_id_old" name="ex_unit_id_old" value="' . $result['Unit_ID'] . '" required="" readonly="" /></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">S/N (เก่า) : </td>
                                            <td colspan="2" width="45%"><input type="text" class="form-control" id="ex_sn_old" name="ex_sn_old" value="' . $result['S_ID'] . '" required="" readonly="" /></td>
                                            <td width="25%"></td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">ชื่อสินค้า (เก่า) : </td>
                                            <td colspan="2" width="45%"><input type="text" class="form-control" id="ex_pname_old" name="ex_pname_old" value="' . $result['P_Name'] . '" required="" readonly="" /></td>
                                            <td width="25%"></td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">อาการเสีย - ชำรุด : </td>
                                            <td colspan="2" width="45%"><input type="text" class="form-control" id="ex_manner" name="ex_manner" value="" required="" /></td>
                                            <td width="25%"></td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">เลขที่สินค้า(ใหม่) : </td>
                                            <td width="25%"><input type="text" class="form-control" id="ex_unit_id_new" name="ex_unit_id_new" value="" required=""/></td>
                                            <td width="20%" class="" style="vertical-align:middle;"><button type="button" class="btn bg-green-gradient" id="findpro"><span class="fa fa-search"></span></button></td>
                                            <td width="25%"></td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">S/N (ใหม่) : </td>
                                            <td width="45%" colspan="2"><input type="text" class="form-control" id="ex_sn_new" name="ex_sn_new" value="" required=""/></td>
                                            <td width="25%"></td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">ชื่อสินค้า : </td>
                                            <td width="45%" colspan="2"><input type="text" class="form-control" id="ex_pname" name="ex_pname" required="" value="" /></td>
                                            <td width="25%"></td>
                                            <td width="10%"></td>
                                        </tr></tbody>
                                        <input type="hidden" name="ex_end_war" value="' . $result['End_Warranty'] . '"/> '
 . '<input type="hidden" name="ex_end_war_shop" value="' . $result['End_Warranty_Shop'] . '"/> '
 . '<input type="hidden" name="ex_date_sell_shop" value="' . $result['Date_Sell_Shop'] . '"/> '
 . '<input type="hidden" name="ex_warranty" value="' . $result['Warranty'] . '"/>';
?>