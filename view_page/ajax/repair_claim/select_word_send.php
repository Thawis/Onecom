<?php

include '../../../lib/connect.php';
//$item_id = "Repair_NO_0009item_10";
$item_id = $_POST['item_id'];
$sql = 'SELECT Customer_Name,Customer_Tel,Repair_Claim_ID FROM t_repair_claim trc JOIN t_customer tc ON trc.Customer_ID = tc.Customer_ID '
        . 'WHERE Repair_Claim_ID = "' . $item_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();

//$message = "ถึงคุณ : " . $result['Customer_Name'] . "ข้อความจาก ร้าน OneComputer สินค้าซ่อมใบรับซ่อมที่ : " . $result['R_ID'] . " สินค้าซ่อม : " . $result['Item_Name'] . " ได้ซ่อมเสร็จแล้ว มีค่าใช้จ่าย "
//        . "ทั้งหมด " . $result['Repair_Total_Price'] . " บาท";

$message = "จาก OneComputer ถึงคุณ : " . $result['Customer_Name'] . " สินค้าซ่อมเคลมเสร็จเรียบร้อยแล้ว";

$data = array(
    "id" => $item_id,
    "mess" => $message,
    "tel" => $result['Customer_Tel'],
    "c_id" => $result['Repair_Claim_ID']
);
echo json_encode($data);
?>