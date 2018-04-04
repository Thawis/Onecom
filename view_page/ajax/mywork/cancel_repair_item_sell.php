<?php

include '../../../lib/connect.php';
$item_id = $_POST['item_id'];
$sql_f_ord = 'SELECT * FROM t_repair_case WHERE Item_ID = "' . $item_id . '" AND Ref_ID_Sell != ""';
$stmt_f_ord = $dbh->prepare($sql_f_ord);
$stmt_f_ord->execute();
$rows_f = $stmt_f_ord->rowCount();

$emp_id_i = "";
$cancel_i = "";
$status_i = "0";

if ($rows_f == 0) {
    $sql_r = "DELETE FROM t_repair_case WHERE Item_ID = ? ";
    $stmt_r = $dbh->prepare($sql_r);
    $stmt_r->bindParam(1, $item_id);
    $stmt_r->execute();
    $rows_r = $stmt_r->rowCount();
    if ($rows_r >= 0) {
        $sql_i = "UPDATE t_repair_item SET Emp_ID = ?, Item_Status = ? WHERE Item_ID = ?";
        $stmt_i = $dbh->prepare($sql_i);
        $stmt_i->bindParam(1, $emp_id_i);
        $stmt_i->bindParam(2, $status_i);
        $stmt_i->bindParam(3, $item_id);
        try {
            $stmt_i->execute();
            echo "ok";
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
} else if ($rows_f > 0) {
    $record = 0;
    while ($result = $stmt_f_ord->fetch()) {
        $ord_id = $result['Ref_ID_Sell'];
        $sql = 'SELECT * FROM t_sell_detail WHERE ORD_ID = "' . $ord_id . '"';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $state = "";
        while ($result = $stmt->fetch()) {
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
                //echo "success";
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
        $record++;
    }
    if ($record > 0) {
        $sql_r = "DELETE FROM t_repair_case WHERE Item_ID = ? ";
        $stmt_r = $dbh->prepare($sql_r);
        $stmt_r->bindParam(1, $item_id);
        $stmt_r->execute();
        $rows_r = $stmt_r->rowCount();
        if ($rows_r >= 0) {
            $sql_i = "UPDATE t_repair_item SET Emp_ID = ?, Item_Status = ? WHERE Item_ID = ?";
            $stmt_i = $dbh->prepare($sql_i);
            $stmt_i->bindParam(1, $emp_id_i);
            $stmt_i->bindParam(2, $status_i);
            $stmt_i->bindParam(3, $item_id);
            try {
                $stmt_i->execute();
                echo "ok";
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
    }
}
?>