<?php

include '../../../lib/connect.php';
session_start();
$type = $_SESSION['login_type'];
$item_id = $_POST['item_id'];
$sql = 'SELECT * FROM t_repair_item WHERE Item_ID = "' . $item_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();

if ($type == "admin" || $type == "root") {
    if ($result['Item_Status'] == "0") {
        $action = '<button type="button" style="font-size: 12px; font-family: Tahoma;" class="btn bg-green-gradient btn_open_item" value="' . $result['Item_ID'] . '"><span class="fa fa-refresh"> เปิดรับซ่อมสินค้า</span></button>';
    } else {
        $action = '<button type="button" style="font-size: 12px; font-family: Tahoma;" class="btn bg-green-gradient btn_open_item" value="' . $result['Item_ID'] . '" disabled=""><span class="fa fa-refresh"> เปิดรับซ่อมสินค้า</span></button>';
    }
} else if ($type == "user") {
    $action = '<button type="button" style="font-size: 12px; font-family: Tahoma;" class="btn bg-green-gradient btn_open_item" value="' . $result['Item_ID'] . '" disabled=""><span class="fa fa-refresh"> เปิดรับซ่อมสินค้า</span></button>';
}


echo '                              <tbody>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">เลขที่สินค้าซ่อม : </td>
                                            <td width="30%"><label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">' . $result['Item_ID'] . '</label>
                                            <input type="hidden" id="fedit_itemid" name="fedit_itemid" value="' . $result['Item_ID'] . '"/></td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ประเภทสินค้าซ่อม : </td>
                                            <td width="30%"><label class="label bg-yellow-gradient" style="font-size: 12px; font-family: Tahoma;">' . $result['Type_Item'] . '</label>
                                            <input type="hidden" id="fedit_typeitem" name="fedit_typeitem" value="' . $result['Type_Item'] . '"/></td></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">Serial Number : </td>
                                            <td width="30%"><input type="text" id="fedit_sn" name="fedit_sn" class="form-control" style="font-size: 12px; font-family: Tahoma;"  value="' . $result['Item_SN'] . '"/></td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ชื่อสินค้าซ่อม : </td>
                                            <td width="30%"><input type="text" id="fedit_name" name="fedit_name" class="form-control" style="font-size: 12px; font-family: Tahoma;" required="" value="' . $result['Item_Name'] . '"/></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">อาการเสีย - สิ่งที่ให้ทำ : </td>
                                            <td width="30%"><input type="text" id="fedit_manner" name="fedit_manner" class="form-control" style="font-size: 12px; font-family: Tahoma;" required="" value="' . $result['Item_manner'] . '"/></td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">แก้ไขสถานะ : </td>
                                            <td width="30%">' . $action . '</td>
                                        </tr>
                                    </tbody>';
?>