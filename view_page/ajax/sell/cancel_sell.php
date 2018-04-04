<?php

include '../../../lib/connect.php';
$ord_id = $_POST['ord_id'];
$sql = 'SELECT * FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID WHERE ts.ORD_ID = "' . $ord_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$state = "";
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $cancel = "1";
    $sql2 = "UPDATE t_product_unit SET PU_Status = ? WHERE Unit_ID = ? ";
    $stmt2 = $dbh->prepare($sql2);
    $stmt2->bindParam(1, $cancel);
    $stmt2->bindParam(2, $result['Unit_ID']);
    try {
        $stmt2->execute();
        $state = "ok";
    } catch (Exception $ex) {
        echo $ex->getMessage();
        $state = "not";
    }
}

if ($state == "ok") {
    $sql3 = "DELETE FROM t_sell WHERE ORD_ID = ? ";
    $stmt3 = $dbh->prepare($sql3);
    $stmt3->bindParam(1, $ord_id);
    try {
        $stmt3->execute();
        echo "success";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
?>