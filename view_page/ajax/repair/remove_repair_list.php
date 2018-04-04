<?php
include '../../../lib/connect.php';
$rid = $_POST['r_id'];
$sql = 'SELECT Item_Name,Item_Status FROM t_repair tr JOIN t_repair_item tri ON tr.R_ID = tri.R_ID WHERE tr.R_ID = "'.$rid.'" AND (Item_Status = "2" OR Item_Status = "3" OR Item_Status = "4")';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
if($rows == 0){
    $sql_r = 'DELETE FROM t_repair WHERE R_ID = "' . $rid . '"';
    $stmt_r = $dbh->prepare($sql_r);
    try {
        $stmt_r->execute();
        echo "ok";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }     
}else{
    echo "not";
}
?>