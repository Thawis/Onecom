<?php

include '../../../lib/connect.php';
$ord_id = $_POST['ord_id'];
$sql = "SELECT * FROM t_sell_detail WHERE ORD_ID = '" . $ord_id . "' AND (Unit_Status = '1' OR Unit_Status = '3')";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array('data' => array());
$num = 1;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $dealer = "<label class='label bg-blue-gradient' style='font-size:10px; font-family:Tahoma;'>หมดประกัน(ตัวแทนขาย)</label>";
    $shop = "<label class='label bg-yellow-gradient' style='font-size:10px; font-family:Tahoma;'>หมดประกัน(ร้าน)</label>";
    $name = $result['P_Name'] . "<br>S/N : " . $result['S_ID'] . "<br>ประกัน : " . $result['Warranty'];
    $war = $dealer." : ".$result['End_Warranty']."<br><br> "
            .$shop." : ".$result['End_Warranty_Shop'];
    $price = number_format($result['P_Price']);
    $arr['data'][] = array(
        $num,
        $result['Unit_ID'],
        $name,
        $war,
        $price,
    );
    $num++;
}
echo json_encode($arr);
?>