<?php

include '../../../lib/connect.php';
$unit_id = $_POST['unit_id'];
$sql = 'SELECT * FROM t_product tp JOIN t_product_unit tpu ON tp.P_ID = tpu.P_ID WHERE tpu.Unit_ID = "' . $unit_id . '" AND tp.P_Status = "1" AND tpu.PU_Status = "1"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$End_War = EndDate($result["Warranty"]);
    $data = array(
        "rows" => $rows,
        "pid" => $result['P_ID'],
        "unit_id" => $result['Unit_ID'],
        "pname" => $result['P_Name'],
        "war" => $result['Warranty'],
        "price" => $result['P_Price'],
        "s_id" => $result['S_ID'],
        "dateR" => $result['Date_Receive'],
        "dateE" => $result['End_Warranty'],
        "end_war" => $End_War,
    );
echo json_encode($data);

function EndDate($warranty) {
    $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
    $today = $dt->format("Y-m-d H:i:s");
    if ($warranty == "7วัน") {
        $End_War = date('Y-m-d', strtotime($today . " +7 days"));
        return $End_War;
    } else if ($warranty == "15วัน") {
        $End_War = date('Y-m-d', strtotime($today . " +15 days"));
        return $End_War;
    } else if ($warranty == "30วัน") {
        $End_War = date('Y-m-d', strtotime($today . " +30 days"));
        return $End_War;
    } else if ($warranty == "3เดือน") {
        $End_War = date('Y-m-d', strtotime($today . " +3 month"));
        return $End_War;
    } else if ($warranty == "6เดือน") {
        $End_War = date('Y-m-d', strtotime($today . " +6 month"));
        return $End_War;
    } else if ($warranty == "1ปี") {
        $End_War = date('Y-m-d', strtotime($today . " +1 year"));
        return $End_War;
    } else if ($warranty == "2ปี") {
        $End_War = date('Y-m-d', strtotime($today . " +2 year"));
        return $End_War;
    } else if ($warranty == "3ปี") {
        $End_War = date('Y-m-d', strtotime($today . " +3 year"));
        return $End_War;
    } else if ($warranty == "5ปี") {
        $End_War = date('Y-m-d', strtotime($today . " +5 year"));
        return $End_War;
    }
}
?>