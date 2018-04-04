<?php
include '../../../lib/connect.php';
$Import_id = $_POST['import_id'];
$sql = "SELECT tid.Import_ID, tid.Date_Import, tid.Ref_Import_ID, tid.Import_Type, te.Emp_ID, te.Emp_Name, td.Dealer_ID, td.Dealer_Company "
        . "FROM t_import_detail tid JOIN t_employee te ON tid.Emp_ID = te.Emp_ID JOIN t_dealer td ON td.Dealer_ID = tid.Dealer_ID "
        . "WHERE tid.Import_ID = '".$Import_id."'";
$stmt = $dbh->prepare($sql);
$stmt->execute();
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $ref = $result['Ref_Import_ID'];
    $date_import = $result['Date_Import'];
    $emp_name = $result['Emp_Name'];
    $emp_id = $result['Emp_ID'];
    $import_type = $result['Import_Type'];
    $dealer_id = $result['Dealer_ID'];
    $dealer_company_name = $result['Dealer_Company'];
}
$type = '';
if($import_type == "sell"){
    $type = '<label class="label label-success" style="font-family:Tahoma; font-size: 14px;"> สินค้าสำหรับขาย </label>';
}else{
    $type = '';
}

echo '<tbody>
                                        <tr">
                                            <td width="20%" style="vertical-align: middle; text-align:right;">รหัสรายการรับเข้าสินค้า : </td>
                                            <td width="25%" style="vertical-align: middle;">'.$Import_id.'</td>
                                            <td width="20%" style="vertical-align: middle; text-align:right;">รหัสอ้างอิงรับเข้าสินค้า : </td>
                                            <td width="35%" style="vertical-align: middle;">'.$ref.'</td>
                                        </tr>
                                        <tr">
                                            <td width="20%" style="vertical-align: middle; text-align:right;">วันที่รับเข้าสินค้า : </td>
                                            <td width="25%" style="vertical-align: middle;">'.$date_import.'</td>
                                            <td width="20%" style="vertical-align: middle; text-align:right;">รับเข้าโดย : </td>
                                            <td width="35%">'.$emp_name.' ('.$emp_id.')</td>
                                        </tr>
                                        <tr">
                                            <td width="20%" style="vertical-align: middle; text-align:right;">จากตัวแทนขายสินค้า : </td>
                                            <td width="25%" style="vertical-align: middle;">'.$dealer_company_name.' ('.$dealer_id.')</td>
                                            <td width="20%" style="vertical-align: middle; text-align:right;">ประเภทการรับเข้าสินค้า : </td>
                                            <td width="35%" style="vertical-align: middle;">'.$type.'</td>
                                        </tr>
                                    </tbody>';

?>