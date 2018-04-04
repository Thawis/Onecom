<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';

//$ord = $_POST['txt_findwar'];
$ord = str_replace(" ", "", $_POST['txt_findwar']);
$num = 1;
$arr = array("data" => array());
$sql_ex = 'SELECT * FROM t_claim_exchange WHERE S_ID = "' . $ord . '" AND Ex_Status != "3" ORDER BY ORD_ID, Ex_Number DESC ';
$stmt_ex = $dbh->prepare($sql_ex);
$stmt_ex->execute();
$rows_ex = $stmt_ex->rowCount();
if ($rows_ex > 0) {
    while ($result_ex = $stmt_ex->fetch()) {
        if (strtotime($result_ex["Date_Sell_Shop"]) > strtotime('-7 day')) {
            if ($result_ex['End_Warranty'] == '0000-00-00' && $result_ex['End_Warranty_Shop'] == '0000-00-00') {
                $date_end = 'L-T';
                $date_end_shop = 'L-T';
                $con = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma;"> ขายอยู่ในช่วง 7 วัน</label>';
                $action = '<button type="button" class="btn bg-blue-gradient btn_ex_claim" onclick="claim_ex_id_2(\'' . $result_ex['ORD_ID'] . '\',\'' . $result_ex['Unit_ID_New'] . '\',\'' . $result_ex['P_Name'] . '\')" >รับเคลม</button>';
            } else {
                $date_end = DateThai($result_ex['End_Warranty']);
                $date_end_shop = DateThai($result_ex['End_Warranty_Shop']);
                $con = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma;"> ขายอยู่ในช่วง 7 วัน</label>';
                $action = '<button type="button" class="btn bg-blue-gradient" onclick="claim_ex_id_2(\'' . $result_ex['ORD_ID'] . '\',\'' . $result_ex['Unit_ID_New'] . '\',\'' . $result_ex['P_Name'] . '\')" >รับเคลม</button>';
            }
        } else {
            if ($result_ex['End_Warranty'] == '0000-00-00' && $result_ex['End_Warranty_Shop'] == '0000-00-00') {
                $date_end = 'L-T';
                $date_end_shop = 'L-T';
                $con = '<label class="label bg-red-gradient" style="font-size:12px; font-family:Tahoma;"> ขายเกินช่วง 7 วัน</label>';
                $action = '<button type="button" class="btn bg-blue-gradient btn_add_claim" onclick="claim_add(\'' . $result_ex['ORD_ID'] . '\',\'' . $result_ex['Unit_ID_New'] . '\',\'' . $result_ex['P_Name'] . '\',\'' . $result_ex['S_ID'] . '\')" >รับเคลม</button>';
            } else {
                $date_end = DateThai($result_ex['End_Warranty']);
                $date_end_shop = DateThai($result_ex['End_Warranty_Shop']);
                $con = '<label class="label bg-red-gradient" style="font-size:12px; font-family:Tahoma;"> ขายเกินช่วง 7 วัน</label>';
                $action = '<button type="button" class="btn bg-blue-gradient btn_add_claim" onclick="claim_add(\'' . $result_ex['ORD_ID'] . '\',\'' . $result_ex['Unit_ID_New'] . '\',\'' . $result_ex['P_Name'] . '\',\'' . $result_ex['S_ID'] . '\')" >รับเคลม</button>';
            }
        }
        //$detail = '<button type="button" class="btn bg-blue-gradient btn_show_detail" onclick="show_detail_ex(\'' . $result_ex['ORD_ID'] . '\',\'' . $result_ex['Unit_ID_New'] . '\',\''.$result_ex['P_Name'].'\',\''.$result_ex['S_ID'].'\',\''.$result_ex['Ex_Number'].'\')"><span class="fa fa-info-circle"></span> รายละเอียด</button>';
        $detail = '<button type="button" class="btn bg-aqua-gradient btn_show_detail" onclick="show_detail_ex(\'' . $result_ex['Ex_Number'] . '\')"><span class="fa fa-info-circle"></span> รายละเอียด</button>';
        $type = '<label class="label bg-red-gradient" style="font-size:12px; font-family:Tahoma;">สินค้าเคลม</label>';
        $date_sell = DateThai($result_ex['Date_Sell_Shop']);
        $arr['data'][] = array(
            $num,
            $result_ex['P_Name'],
            //$date_end_shop,
            //$date_end,
            $result_ex['S_ID'],
            //$date_sell,
            $con,
            //$type,
            $detail,
            $action
        );
        $num++;
    }
} else if ($rows_ex == 0 || $rows_ex > 0) {
    $sql = 'SELECT P_Name,End_Warranty,End_Warranty_Shop,Date_Sell_Shop,S_ID,Unit_ID,ts.ORD_ID,Warranty,tsd.Number'
            . ' FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID '
            . 'WHERE tsd.S_ID = "' . $ord . '" AND Unit_Status = "1" AND (DATE(End_Warranty_Shop) > DATE(NOW()) OR Warranty = "L-T") ';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    while ($result = $stmt->fetch()) {

        if (strtotime($result["Date_Sell_Shop"]) > strtotime('-7 day')) {
            if ($result['End_Warranty'] == '0000-00-00' && $result['End_Warranty_Shop'] == '0000-00-00') {
                $date_end = 'L-T';
                $date_end_shop = 'L-T';
                $con = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma;"> ขายอยู่ในช่วง 7 วัน</label>';
                $action = '<button type="button" class="btn bg-blue-gradient btn_ex_claim" onclick="claim_ex_id(\'' . $result['ORD_ID'] . '\',\'' . $result['Unit_ID'] . '\',\''.$result['P_Name'].'\')" >รับเคลม</button>';
            } else {
                $date_end = DateThai($result['End_Warranty']);
                $date_end_shop = DateThai($result['End_Warranty_Shop']);
                $con = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma;"> ขายอยู่ในช่วง 7 วัน</label>';
                $action = '<button type="button" class="btn bg-blue-gradient" onclick="claim_ex_id(\'' . $result['ORD_ID'] . '\',\'' . $result['Unit_ID'] . '\',\''.$result['P_Name'].'\')" >รับเคลม</button>';
            }
        } else {
            if ($result['End_Warranty'] == '0000-00-00' && $result['End_Warranty_Shop'] == '0000-00-00') {
                $date_end = 'L-T';
                $date_end_shop = 'L-T';
                $con = '<label class="label bg-red-gradient" style="font-size:12px; font-family:Tahoma;"> ขายเกินช่วง 7 วัน</label>';
                $action = '<button type="button" class="btn bg-blue-gradient btn_add_claim" onclick="claim_add(\'' . $result['ORD_ID'] . '\',\'' . $result['Unit_ID'] . '\',\'' . $result['P_Name'] . '\',\'' . $result['S_ID'] . '\')">รับเคลม</button>';
            } else {
                $date_end = DateThai($result['End_Warranty']);
                $date_end_shop = DateThai($result['End_Warranty_Shop']);
                $con = '<label class="label bg-red-gradient" style="font-size:12px; font-family:Tahoma;"> ขายเกินช่วง 7 วัน</label>';
                $action = '<button type="button" class="btn bg-blue-gradient btn_add_claim" onclick="claim_add(\'' . $result['ORD_ID'] . '\',\'' . $result['Unit_ID'] . '\',\'' . $result['P_Name'] . '\',\'' . $result['S_ID'] . '\')">รับเคลม</button>';
            }
        }
        //$detail = '<button type="button" class="btn bg-blue-gradient btn_show_detail" onclick="show_detail(\'' . $result['ORD_ID'] . '\',\'' . $result['Unit_ID'] . '\',\''.$result['P_Name'].'\',\''.$result['S_ID'].'\',\''.$result['Number'].'\')"><span class="fa fa-info-circle"></span> รายละเอียด</button>';
        $detail = '<button type="button" class="btn bg-aqua-gradient btn_show_detail" onclick="show_detail(\'' . $result['Number'] . '\')"><span class="fa fa-info-circle"></span> รายละเอียด</button>';
        $type = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma;">สินค้าขาย</label>';
        $date_sell = DateThai($result['Date_Sell_Shop']);

        $arr['data'][] = array(
            $num,
            $result['P_Name'],
            //$date_end_shop,
            //$date_end,
            $result['S_ID'],
            //$date_sell,
            $con,
            $detail,
            $action
        );
        $num++;
    }
}

echo json_encode($arr);
?>