<?php

include '../../../lib/connect.php';
$unit_id = $_POST['unit_id'];
$sql = 'SELECT * FROM t_product tp JOIN t_product_unit tpu ON tp.P_ID = tpu.P_ID WHERE tpu.Unit_ID = "' . $unit_id . '" AND tp.P_Status = "1" AND tpu.PU_Status = "1"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$data = array(
    "rows" => $rows,
    "unit_id" => $result['Unit_ID'],
    "pname" => $result['P_Name'],
    "s_id" => $result['S_ID'],
);
echo json_encode($data);
?>