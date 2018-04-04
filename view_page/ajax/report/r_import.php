<?php

session_start();
include '../../../lib/connect.php';
require '../../../lib/getDate_TH.php';

$type = $_POST['type'];
$datestart = substr($_POST['todate'], 0, 10);
$dateend = substr($_POST['todate'], 13, 10);

$_SESSION['R_Import_type'] = $type;
$_SESSION['R_Import_start'] = $datestart;
$_SESSION['R_Import_end'] = $dateend;
if ($type == 'All') {
    $sql = 'SELECT tmd.Import_ID,tmd.Ref_Import_ID,tmd.Date_Import,tmd.Import_Type,tp.P_Name,tpu.Unit_ID,tpu.S_ID,te.Emp_Name,te.Emp_ID '
            . 'FROM t_import_detail tmd JOIN t_product_unit tpu ON tmd.Import_ID = tpu.Import_ID '
            . 'JOIN t_product tp ON tp.P_ID = tpu.P_ID '
            . 'JOIN t_employee te ON te.Emp_ID = tmd.Emp_ID '
            . 'WHERE (Date_Import >= "'.$datestart.'" AND Date_Import <= "'.$dateend.'")';
} else {
    $sql = 'SELECT tmd.Import_ID,tmd.Ref_Import_ID,tmd.Date_Import,tmd.Import_Type,tp.P_Name,tpu.Unit_ID,tpu.S_ID,te.Emp_Name,te.Emp_ID '
            . 'FROM t_import_detail tmd JOIN t_product_unit tpu ON tmd.Import_ID = tpu.Import_ID '
            . 'JOIN t_product tp ON tp.P_ID = tpu.P_ID '
            . 'JOIN t_employee te ON te.Emp_ID = tmd.Emp_ID '
            . 'WHERE (Date_Import >= "'.$datestart.'" AND Date_Import <= "'.$dateend.'") AND tmd.Import_Type = "' . $type . '"';
}
//    echo $sql;
$num = 1;
$arr = array("data" => array());
$stmt = $dbh->prepare($sql);
$stmt->execute();
while ($result = $stmt->fetch()) {
    $datethai = DateThai($result['Date_Import']);

    if ($result['Import_Type'] == 'sell') {
        $type1 = 'สินค้าสำหรับขาย';
    } else if ($result['Import_Type'] == 're_sell') {
        $type1 = 'สินค้าเคลมขาย';
    }

    $detail = 'ชื่อสินค้า : ' . $result['P_Name'] . ' <br>'
            . 'เลขที่สินค้า : ' . $result['Unit_ID'] . '<br>'
            . 'S/N : ' . $result['S_ID'] . '<br>'
            . 'รับเข้าโดย : ' . $result['Emp_Name'] . ' ( ' . $result['Emp_ID'] . ' )';

    $arr['data'][] = array(
        $num,
        $result['Import_ID'],
        $result['Ref_Import_ID'],
        $datethai,
        $detail,
        $type1
    );
    $num++;
}
echo json_encode($arr);
?>