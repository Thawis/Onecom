<?php

include '../../../lib/connect.php';
$eid = $_POST['eid'];
$sql = 'SELECT * FROM t_employee WHERE Emp_ID = "' . $eid . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();


$data = array(
    "id" => $result['Emp_ID'],
    "name" => $result['Emp_Name'],
    "gender" => $result['Emp_Gender'],
    "bd" => $result['Emp_Birthday'],
    "address"=>$result['Emp_Address'],
    "tel"=> $result['Emp_Tel'],
    "pic"=> $result['Emp_Img']
);
echo json_encode($data);
?>