<?php

include '../../../lib/connect.php';
$item_id = $_POST['item_id'];
$sql = 'SELECT * FROM t_repair_case WHERE Item_ID = "' . $item_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch()) {
    if ($result['Repair_Type'] == "Menu") {
        $type = '<label class="label bg-blue-gradient" stlye="font-size: 14px; font-family: Tahoma;">ซ่อมตามรายการ</label>';
        $action = '<button type="button" class="btn bg-red-gradient btn_remove_list" value="' . $result['Case_Number'] . '"><span class="fa fa-close"></span></button>';
    } else if ($result['Repair_Type'] == "Sell") {
        $type = '<label class="label bg-green-gradient" stlye="font-size: 14px; font-family: Tahoma;">ขายสินค้าเพื่อซ่อม</label>';
        $action = '<button type="button" class="btn bg-aqua-gradient btn_detail_sell" value="'.$result['Ref_ID_Sell'].'"><span class="fa fa-info-circle"></span></button> '
                . '<button type="button" class="btn bg-red-gradient btn_remove_list_sell" value="' . $result['Ref_ID_Sell'] . '"><span class="fa fa-close"></span></button>';
    } else if ($result['Repair_Type'] == "Custom") {
        $type = '<label class="label bg-red-gradient" stlye="font-size: 14px; font-family: Tahoma;">ซ่อมที่ไม่มีในรายการ</label>';
        $action = '<button type="button" class="btn bg-red-gradient btn_remove_list" value="' . $result['Case_Number'] . '"><span class="fa fa-close"></span></button>';
    }

    $arr['data'][] = array(
        $num,
        $result['Service_Menu'],
        $result['Service_Price'],
        $result['Service_Detail'],
        $type,
        $result['Repair_Warranty'],
        $result['Ref_ID_Sell'],
        $action
    );
    $num++;
}
echo json_encode($arr);
?>