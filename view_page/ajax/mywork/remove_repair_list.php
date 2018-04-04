<?php
include '../../../lib/connect.php';
$case_num = $_POST['casenum'];
$sql = 'DELETE FROM t_repair_case WHERE Case_Number = "' . $case_num . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
if($rows > 0){
    echo 'ok';
}else if($rows == 0){
    echo 'not';
}
?>