<?php
include '../../../lib/connect.php';
$sql = "SELECT * FROM t_shop";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();

echo '                                      <tbody>
                                                <tr>
                                                    <td colspan="3" width="100%" style="vertical-align: middle; text-align: center;">
                                                        <img src="../img/shop/'.$result['Shop_Img'].'" alt="" class="img-thumbnail" style="width:210px; height:110px;"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:center; font-size: 20px; font-family: Tahoma; font-weight: bold;">'.$result['Shop_Name'].'</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:center; font-size: 16px; font-family: Tahoma; font-weight: bold;">'.$result['Shop_Address'].'</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:center; font-size: 16px; font-family: Tahoma; font-weight: bold;">Tel. '.$result['Shop_Tel'].'</td>
                                                </tr>
                                                <tr>
                                                <td colspan="3" style="text-align:center; font-size: 24px; font-family: Tahoma; font-weight:bold; background-color:#D0CAA7;">ใบเสร็จรับเงิน</td>
                                                </tr>
                                            </tbody>'
?>