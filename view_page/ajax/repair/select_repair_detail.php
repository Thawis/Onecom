<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
$item_id = $_POST['item_id'];
$sql = 'SELECT * FROM t_repair tr JOIN t_repair_item tri ON tr.R_ID = tri.R_ID JOIN t_customer tc ON tr.Customer_ID = tc.Customer_ID '
        . 'WHERE (tri.Item_Status = "1" OR tri.Item_Status = "2" OR tri.Item_Status = "3" OR tri.Item_Status = "4" OR tri.Item_Status = "0") AND tri.Item_ID = "' . $item_id . '"';
//$sql = 'SELECT * FROM t_repair tr JOIN t_repair_item tri ON tr.R_ID = tri.R_ID JOIN t_customer tc ON tr.Customer_ID = tc.Customer_ID '
//        . 'JOIN t_employee te ON te.Emp_ID = tri.Emp_ID '
//        . 'WHERE (tri.Item_Status = "1" OR tri.Item_Status = "2" OR tri.Item_Status = "3" OR tri.Item_Status = "4" OR tri.Item_Status = "0") AND tri.Item_ID = "' . $item_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();

$timeThai = DateThaiTime($result['R_DATE']);
$custel = getTel($result['Customer_Tel']);
if ($result['Emp_ID'] == NULL && $result['Item_Status'] == "0") {
    $emp = '<button type="button" class="btn bg-green-gradient btn_addrepair" style="font-size: 12px; font-family: Tahoma; text-align:center;" value="' . $result['Item_ID'] . '" disabled="">'
            . '<span class="fa fa-hand-o-right"></span> รับงานซ่อม </button>';
} else if ($result['Emp_ID'] == NULL) {
    $emp = '<button type="button" class="btn bg-green-gradient btn_addrepair" style="font-size: 12px; font-family: Tahoma; text-align:center;" value="' . $result['Item_ID'] . '">'
            . '<span class="fa fa-hand-o-right"></span> รับงานซ่อม </button>';
} else {
    $sql_emp = 'SELECT Emp_Name FROM t_employee WHERE Emp_ID = "' . $result['Emp_ID'] . '"';
    $stmt_emp = $dbh->prepare($sql_emp);
    $stmt_emp->execute();
    $rows_emp = $stmt_emp->rowCount();
    $result_emp = $stmt_emp->fetch();
    if ($rows_emp > 0) {
        $emp = '<label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;"> ' . $result_emp['Emp_Name'] . ' (' . $result['Emp_ID'] . ') </label>';
    } else {
        $emp = '<label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;"> ' . $result['Emp_ID'] . ' </label>';
    }
}
if ($result['Item_Status'] == "0") {
    $status = '<label class="label bg-red-gradient" style="font-size: 12px; font-family: Tahoma;">ยกเลิกซ่อม</label>';
} else if ($result['Item_Status'] == "1") {
    $status = '<label class="label label-warning" style="font-size: 12px; font-family: Tahoma;">รอซ่อม</label>';
} else if ($result['Item_Status'] == "2") {
    $status = '<label class="label label-primary" style="font-size: 12px; font-family: Tahoma;">อยู่ระหว่างซ่อม</label>';
} else if ($result['Item_Status'] == "3") {
    $status = '<label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">ซ่อมเรียบร้อย</label>';
} else if ($result['Item_Status'] == "4") {
    $status = '<label class="label bg-aqua-gradient" style="font-size: 12px; font-family: Tahoma;">ส่งคืนเรียบร้อย</label>';
}

echo '                              <tbody>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">เลขที่ใบรับซ่อม : </td>
                                            <td width="30%"><label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">' . $result['R_ID'] . '</label></td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">วันที่รับซ่อม : </td>
                                            <td width="30%">' . $timeThai . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ประเภทสินค้าซ่อม : </td>
                                            <td width="30%"><label class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">' . $result['Type_Item'] . '</label></td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ชื่อสินค้าซ่อม : </td>
                                            <td width="30%">' . $result['Item_Name'] . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">Serial Number : </td>
                                            <td width="30%">' . $result['Item_SN'] . '</td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">เลขที่สินค้าซ่อม : </td>
                                            <td width="30%">' . $result['Item_ID'] . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">อาการเสีย - สิ่งที่ให้ทำ : </td>
                                            <td width="30%">' . $result['Item_manner'] . '</td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">อุปกรณ์พ่วงต่อ : </td>
                                            <td width="30%">' . $result['Item_eqm'] . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">สถานะ : </td>
                                            <td width="30%">' . $status . '</td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ผู้รับงาน : </td>
                                            <td width="30%">' . $emp . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ชื่อลูกค้า : </td>
                                            <td width="30%">' . $result['Customer_FullName'] . '</td>
                                            <td width="20%" style="text-align:right; font-weight: bold;">เบอร์โทรศัพท์ : </td>
                                            <td width="30%">' . $custel . '</td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="text-align:right; font-weight: bold;">ที่อยู่ : </td>
                                            <td colspan="3" width="30%">' . $result['Customer_Address'] . '</td>
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

