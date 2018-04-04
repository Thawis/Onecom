<?php

include '../../../lib/connect.php';
$sql = "SELECT * FROM t_shop";
$stmt = $dbh->prepare($sql);
$stmt->execute();
//$rows = $stmt->rowCount();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
    $data = array(
        "name" => $result['Shop_Name'],
        "address" => $result['Shop_Address'],
        "tel" => $result['Shop_Tel'],
        "img" => $result['Shop_Img']
    );
echo json_encode($data);
?>