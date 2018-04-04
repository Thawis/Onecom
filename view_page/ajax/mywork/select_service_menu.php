<?php

include '../../../lib/connect.php';
//$type = $_POST['itemtype'];
if (isset($_POST['itemtype'])) {
    $type = $_POST['itemtype'];
} else {
    $type = 'null';
}
if ($type == "NoteBook") {
    $sql = 'SELECT * FROM t_service_menu WHERE Service_Type != "PC" AND Service_Status = "1" ORDER BY Service_Menu ASC';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $arr = array();
    $i = 0;
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $arr[$i]["id"] = $result['Service_Price'];
        $arr[$i]["name"] = $result['Service_Menu'];
        $i++;
    }
    echo json_encode($arr);
} else if ($type == "PC-Case") {
    $sql = 'SELECT * FROM t_service_menu WHERE Service_Type != "NB" AND Service_Status = "1" ORDER BY Service_Menu ASC';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $arr = array();
    $i = 0;
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $arr[$i]["id"] = $result['Service_Price'];
        $arr[$i]["name"] = $result['Service_Menu'];
        $i++;
    }
    echo json_encode($arr);
} else {
    $sql = 'SELECT * FROM t_service_menu WHERE Service_Type = "All" AND Service_Status = "1" ORDER BY Service_Menu ASC';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $arr = array();
    $i = 0;
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $arr[$i]["id"] = $result['Service_Price'];
        $arr[$i]["name"] = $result['Service_Menu'];
        $i++;
    }
    echo json_encode($arr);
}
?>