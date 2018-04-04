<?php

include '../../../lib/connect.php';
if ($_POST['dealer_action'] == "add") {
    $name = str_replace(" ", "", $_POST['dealer_name']);
    $surname = str_replace(" ", "", $_POST['dealer_surname']);
    $fullname = $name . ' ' . $surname;
    $sql = 'SELECT * FROM t_dealer WHERE Dealer_ID = "' . $_POST['dealer_id'] . '" OR (Dealer_Name = "' . $fullname . '" AND Dealer_Company = "' . $_POST['dealer_company'] . '")';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows == 0) {
        echo 'ok';
    } else {
        echo 'not';
    }
} else if ($_POST['dealer_action'] == "edit") {
    $name = str_replace(" ", "", $_POST['edit_dealer_name']);
    $surname = str_replace(" ", "", $_POST['edit_dealer_surname']);
    $fullname = $name . ' ' . $surname;
    //echo $fullname,$_POST['edit_dealer_id'],$_POST['edit_dealer_company'];
    $sql = 'SELECT * FROM t_dealer WHERE Dealer_ID = "' . $_POST['edit_dealer_id'] . '" AND Dealer_Name = "' . $fullname . '" AND Dealer_Company = "' . $_POST['edit_dealer_company'] . '"';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rows = $stmt->rowCount();
    if ($rows >= 1) {
        echo 'ok';
    } else {
        $sql1 = 'SELECT * FROM t_dealer WHERE Dealer_Name = "' . $fullname . '" AND Dealer_Company = "' . $_POST['edit_dealer_company'] . '"';
        $stmt1 = $dbh->prepare($sql1);
        $stmt1->execute();
        $rows1 = $stmt1->rowCount();
        if($rows1 == 0){
            echo 'ok';
        }else{
            echo 'not';
        }
    }
}
?>