<?php

include '../../../lib/connect.php';
$number = count($_POST['temp_sn2']);
$record = 0;
$pid = $_POST['temp_pid_2'];
if ($number > 0) {
    for ($i = 0; $i < $number; $i++) {
        $sql = "INSERT INTO temp_unit_sn SET P_ID = ?, S_ID = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $_POST['temp_pid_2']);
        $stmt->bindParam(2, $_POST['temp_sn2'][$i]);
        try {
            $stmt->execute();
            $record++;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    if ($record > 0) {
        $sql2 = 'SELECT COUNT(*) FROM temp_unit_sn WHERE P_ID = "' . $pid . '"';
        $stmt2 = $dbh->prepare($sql2);
        $stmt2->execute();
        $result = $stmt2->fetch();
        $state = 'เพิ่มข้อมูลเรียบร้อย';
        $arr = array(
            "state" => $state,
            "number" => $result['COUNT(*)']
        );
        echo json_encode($arr);
    }
} else {
    echo 'กรุณากรอกข้อมูล';
}
?>