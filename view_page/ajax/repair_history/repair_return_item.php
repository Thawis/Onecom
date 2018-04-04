<?php
session_start();
$_SESSION['Repair_ID_Bill'] = $_POST['item_id'];
include '../../../lib/connect.php';
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d H:i:s");
$end = '4';
$item_id = $_POST['item_id'];
$sql = 'SELECT * FROM t_repair_case WHERE Item_ID = "' . $item_id . '" AND (Repair_Warranty != "ไม่มี" AND Repair_Warranty != "ตามใบเสร็จ")';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
if ($rows == 0) {
    $sql_u = "UPDATE t_repair_item SET Item_Status = ? WHERE Item_ID = ? ";
    $stmt_u = $dbh->prepare($sql_u);
    $stmt_u->bindParam(1, $end);
    $stmt_u->bindParam(2, $item_id);
    try {
        $stmt_u->execute();
        $rows_u = $stmt_u->rowCount();
        if ($rows_u > 0) {
            $sql_i = 'INSERT INTO t_return_item SET Ref_ID_Return = ?, ReturnItem_Time = ? ';
            $stmt_i = $dbh->prepare($sql_i);
            $stmt_i->bindParam(1, $item_id);
            $stmt_i->bindParam(2, $today);
            try {
                $stmt_i->execute();
                $rows_i = $stmt_i->rowCount();
                if ($rows_i > 0) {
                    echo 'ok';
                }
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
} else {
    while ($result = $stmt->fetch()) {
        $end_w = EndDate($result['Repair_Warranty']);
        $sql_wu = 'UPDATE t_repair_case SET Repair_EndWar = ? WHERE Case_Number = ? ';
        $stmt_wu = $dbh->prepare($sql_wu);
        $stmt_wu->bindParam(1, $end_w);
        $stmt_wu->bindParam(2, $result['Case_Number']);
        try {
            $stmt_wu->execute();
            $rows_wu = $stmt_wu->rowCount();
            if ($rows_wu > 0) {
                $state = "ok";
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    if ($state == "ok") {
        $sql_u = "UPDATE t_repair_item SET Item_Status = ? WHERE Item_ID = ? ";
        $stmt_u = $dbh->prepare($sql_u);
        $stmt_u->bindParam(1, $end);
        $stmt_u->bindParam(2, $item_id);
        try {
            $stmt_u->execute();
            $rows_u = $stmt_u->rowCount();
            if ($rows_u > 0) {
                $sql_i = 'INSERT INTO t_return_item SET Ref_ID_Return = ?, ReturnItem_Time = ? ';
                $stmt_i = $dbh->prepare($sql_i);
                $stmt_i->bindParam(1, $item_id);
                $stmt_i->bindParam(2, $today);
                try {
                    $stmt_i->execute();
                    $rows_i = $stmt_i->rowCount();
                    if ($rows_i > 0) {
                        echo 'ok';
                    }
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }else{
        echo 'not';
    }
}

function EndDate($warranty) {
    $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
    $today = $dt->format("Y-m-d H:i:s");
    if ($warranty == "7 วัน") {
        $End_War = date('Y-m-d', strtotime($today . " +7 days"));
        return $End_War;
    } else if ($warranty == "1 เดือน") {
        $End_War = date('Y-m-d', strtotime($today . " +1 month"));
        return $End_War;
    } else if ($warranty == "3 เดือน") {
        $End_War = date('Y-m-d', strtotime($today . " +3 month"));
        return $End_War;
    }
}

?>