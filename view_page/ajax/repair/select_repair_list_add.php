<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
session_start();
$type = $_SESSION['login_type'];
//$sql = "SELECT * FROM t_repair ORDER BY Number DESC ";
$sql = "SELECT R_ID,R_DATE,A_Emp_ID,Emp_Name FROM t_repair tr JOIN t_employee te ON tr.A_Emp_ID = te.Emp_ID ORDER BY Number DESC ";
$arr = array("data" => array());
$num = 1;
$stmt = $dbh->prepare($sql);
$stmt->execute();

while ($result = $stmt->fetch()) {
    $datethai = DateThai($result['R_DATE']);
    if ($type == "admin" || $type == "root") {
        $action = '<button type="button" class="btn bg-aqua-gradient btn_detail_add" value="' . $result['R_ID'] . '" style="font-size: 12px; font-family: Tahoma;"><span class="fa fa-info-circle"></span> รายละเอียด </button> '
                . '<button type="button" class="btn bg-red-gradient btn_cancel_add" value="' . $result['R_ID'] . '" style="font-size: 12px; font-family: Tahoma;"><span class="fa fa-close"></span> ยกเลิกรายการ </button> '
                . '<button type="button" class="btn bg-yellow-gradient btn_rbill" value="' . $result['R_ID'] . '" style="font-size: 12px; font-family: Tahoma;"><span class="fa fa-print"></span> ใบรับซ่อม </button>';
    } else if ($type == "user") {
        $action = '<button type="button" class="btn bg-aqua-gradient btn_detail_add" value="' . $result['R_ID'] . '" style="font-size: 12px; font-family: Tahoma;"><span class="fa fa-info-circle"></span> รายละเอียด </button> '
                . '<button type="button" class="btn bg-yellow-gradient btn_rbill" value="' . $result['R_ID'] . '" style="font-size: 12px; font-family: Tahoma;"><span class="fa fa-print"></span> ใบรับซ่อม </button>';
    }
    $name = $result['Emp_Name'].' ('.$result['A_Emp_ID'].')';
    $arr['data'][] = array(
        $num,
        $result['R_ID'],
        $datethai,
        //$result['A_Emp_ID'],
        $name,
        $action,
    );
    $num++;
}
echo json_encode($arr);
?>