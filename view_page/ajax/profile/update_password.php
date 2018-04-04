<?php

include '../../../lib/connect.php';
$pass = $_POST['pass'];
$eid = $_POST['eid'];


$option = [
    'cost' => 12,
    'salt' => md5('varis209')
];
$hash = password_hash($pass, PASSWORD_DEFAULT, $option);


$sql = 'UPDATE t_employee SET Emp_Pass = ? WHERE Emp_ID = ?';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1,$hash);
$stmt->bindParam(2,$eid);
$stmt->execute();
$rows = $stmt->rowCount();

if($rows > 0){
    echo 'ok';
}else{
    echo 'not';
}
?>