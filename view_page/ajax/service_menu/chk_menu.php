<?php

include '../../../lib/connect.php';
if (!empty($_POST['ser_action'])) {
    if ($_POST['ser_action'] == "add") {
        $sql = 'SELECT * FROM t_service_menu WHERE Service_ID = "' . $_POST['serid'] . '" OR (Service_Menu = "' . $_POST['sername'] . '" AND Service_Type = "' . $_POST['sertype'] . '")';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if ($rows == 0) {
            echo 'ok';
        } else {
            echo 'not';
        }
    }
} else {
    //echo $_POST['e_serid'],$_POST['e_sername'],$_POST['e_serprice'],$_POST['e_sertype'];
    $sql = 'SELECT * FROM t_service_menu WHERE Service_ID = "' . $_POST['e_serid'] . '" AND Service_Menu = "' . $_POST['e_sername'] . '" AND Service_Type = "' . $_POST['e_sertype'] . '"';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows >= 1) {
        echo 'ok';
    } else {
        $sql1 = 'SELECT * FROM t_service_menu WHERE Service_Menu = "' . $_POST['e_sername'] . '" AND Service_Type = "' . $_POST['e_sertype'] . '"';
        $stmt1 = $dbh->prepare($sql1);
        $stmt1->execute();
        $rows1 = $stmt1->rowCount();
        if ($rows1 == 0) {
            echo 'ok';
        } else {
            echo 'not';
        }
    }
}
?>