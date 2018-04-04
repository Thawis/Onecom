<?php

include '../../../lib/connect.php';
$number = count($_POST['temp_sn']);
$record = 0;
if ($number > 0) {
    for ($i = 0; $i < $number; $i++) {
//        $str .= $_POST['temp_pid'] . ',';
//        $str .= $_POST['temp_sn'][$i] . ',';
        $sql = "INSERT INTO temp_unit_sn SET P_ID = ?, S_ID = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $_POST['temp_pid']);
        $stmt->bindParam(2, $_POST['temp_sn'][$i]);
        try {
            $stmt->execute();
            $record++;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    if ($record > 0){
        echo 'เพิ่มข้อมูลเรียบร้อย';
    }
}
?>