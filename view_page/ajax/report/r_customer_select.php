<?php

session_start();
include '../../../lib/connect.php';
$type = $_POST['type'];
$status = $_POST['status'];
$_SESSION['R_cus_type'] = $type;
$_SESSION['R_cus_status'] = $status;

$arr = array("data" => array());
$sql = '';
$num = 1;
if ($type == "All") {
    if ($status == "All") {
        $sql = 'SELECT * FROM t_customer';
    } else {
        $sql = 'SELECT * FROM t_customer WHERE Customer_Status = "' . $status . '"';
    }
} else if ($type != "All") {
    if ($status == "All" && $type == "company") {
        $sql = 'SELECT * FROM t_customer WHERE Customer_Surname = "' . $type . '"';
    } else if ($status == "All" & $type == "normal") {
        $sql = 'SELECT * FROM t_customer WHERE Customer_Surname != "company" ';
    } else if ($status != "ALL" && $type == "company") {
        $sql = 'SELECT * FROM t_customer WHERE Customer_Surname = "' . $type . '" AND Customer_Status = "' . $status . '"';
    } else if ($status != "ALL" && $type == "normal") {
        $sql = 'SELECT * FROM t_customer WHERE Customer_Surname != "company" AND Customer_Status = "' . $status . '"';
    } else {
        $sql = 'SELECT * FROM t_customer';
    }
}
$stmt = $dbh->prepare($sql);
$stmt->execute();
while ($result = $stmt->fetch()) {
    if ($result['Customer_Surname'] == "company") {
        $userType = 'บริษัท';
    } else if ($result['Customer_Surname'] != "company") {
        $userType = 'บุคคุลธรรมดา';
    }

    if ($result['Customer_Status'] == '1') {
        $userStatus = 'ปกติ';
    } else {
        $userStatus = 'ยกเลิก';
    }
    $tel = getTel($result['Customer_Tel']);
    $arr['data'][] = array(
        $num,
        $result['Customer_ID'],
        $result['Customer_FullName'],
        $userType,
        $userStatus,
        $tel
    );
    $num++;
}
echo json_encode($arr);

function getTel($tel) {
    $f1 = substr($tel, 0, 3) . '-';
    $f2 = substr($tel, 3, 3) . '-';
    $f3 = substr($tel, 6, 4);
    return $f1 . $f2 . $f3;
}

;
?>