<?php

include '../../../lib/connect.php';
$sql = "SELECT * FROM t_shop";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$rows = $stmt->rowCount();

if ($rows == 0) {
echo '                                          <tbody><tr>
                                                    <td colspan="3" width="100%"><button type="button" class="btn bg-green-gradient" id="add_shop" name="add_shop" style="font-family: Tahoma; font-size: 16px;"><span class="fa fa-plus-square"></span> เพิ่มข้อมูลร้าน</button></td>
                                                </tr></tbody>';  
} else if ($rows == 1) {
echo '                                          <tbody><tr>
                                                    <td colspan="3" width="100%"><button type="button" class="btn bg-yellow-gradient" id="edit_shop" name="edit_shop" style="font-family: Tahoma; font-size: 16px;"><span class="fa fa-pencil"></span> แก้ไขข้อมูลร้าน</button></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" width="100%" style="vertical-align: middle; text-align: center;">
                                                        <img src="../img/shop/'.$result['Shop_Img'].'" alt="" class="img-thumbnail" style="width:390px; height:190px;"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="100%" class="font_2">'.$result['Shop_Name'].'</td>
                                                </tr>
                                                <tr>
                                                    <td class="font_2">'.$result['Shop_Address'].'</td>
                                                </tr>
                                                <tr>
                                                    <td class="font_2">'.$result['Shop_Tel'].'</td>
                                                </tr></tbody>';
}
?>