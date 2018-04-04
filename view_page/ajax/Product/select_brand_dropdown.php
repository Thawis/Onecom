<?php
include '../../../lib/connect.php';
//if (isset($_GET['type'])) {
//    $type = $_GET['type'];
//} else {
//    $type = 'null';
//}
//if ($type == 'null') {
    $sql = 'SELECT * FROM t_brand WHERE B_Status = "1"';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $arr = array();
    $i = 0;
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $arr[$i]["id"] = $result['B_ID'];
        $arr[$i]["name"] = $result['B_Name'];
        $i++;
    }
    echo json_encode($arr);
//} else {
//    $sql = 'SELECT * FROM t_sub_group_product WHERE G_ID="' . $type . '"';
//    $stmt = $dbh->prepare($sql);
//    $stmt->execute();
//    $arr = array();
//    $i = 0;
//    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
//        $arr[$i]["id"] = $result['SG_ID'];
//        $arr[$i]["name"] = $result['SG_Name'];
//        $i++;
//    }
//    echo json_encode($arr);
//}
?>