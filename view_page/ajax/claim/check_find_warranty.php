<?php

include '../../../lib/connect.php';
//$ord = $_POST['txt_findwar'];
$ord = str_replace(" ", "", $_POST['txt_findwar']);
$sql_ex = 'SELECT * FROM t_claim_exchange WHERE S_ID = "' . $ord . '" AND Ex_Status != "3" ORDER BY ORD_ID, Ex_Number DESC ';
$stmt_ex = $dbh->prepare($sql_ex);
$stmt_ex->execute();
$rows_ex = $stmt_ex->rowCount();
if ($rows_ex > 0) {
    echo $rows_ex;
} else if ($rows_ex == 0 || $rows_ex > 0) {
    $sql = 'SELECT P_Name,End_Warranty,End_Warranty_Shop,Date_Sell_Shop,S_ID,Unit_ID,ts.ORD_ID,Warranty'
            . ' FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID '
            . 'WHERE tsd.S_ID = "' . $ord . '" AND Unit_Status = "1" AND (DATE(End_Warranty_Shop) > DATE(NOW()) OR Warranty = "L-T") ';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rows = $stmt->rowCount();
    echo $rows;
}
?>