<?php

include '../../../lib/connect.php';
include '../../../lib/getDate_TH.php';
session_start();
$loginType = $_SESSION['login_type'];
$unit_sn = $_POST['f_sn'];
$typesell = $_POST['typesell'];
$datestart = substr($_POST['reservation'], 0, 10);
$dateend = substr($_POST['reservation'], 13, 10) . ' 23:00:00';
$arr = array("data" => array());
//$arr = array();
$num = 1;
$sql = '';
if ($unit_sn == "") {
    if ($typesell == "all") {
        $sql = "SELECT	* FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID"
                . " WHERE ((ORD_Status = '1') AND (Date_Sell >= '" . $datestart . "' AND Date_Sell <= '" . $dateend . "'))"
                . " GROUP BY ts.ORD_ID"
                . " ORDER BY ts.Number DESC";
    } else {
        $sql = "SELECT	* FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID"
                . " WHERE ((ORD_Status = '1' AND ts.ORD_Type = '" . $typesell . "') AND (Date_Sell >= '" . $datestart . "' AND Date_Sell <= '" . $dateend . "'))"
                . " GROUP BY ts.ORD_ID"
                . " ORDER BY ts.Number DESC";
    }
} else {
    if ($typesell == "all") {
        $sql = "SELECT	* FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID"
                . " WHERE ((ORD_Status = '1') AND (Date_Sell >= '" . $datestart . "' AND Date_Sell <= '" . $dateend . "'))"
                . " AND (S_ID = '" . $unit_sn . "' OR Unit_ID = '" . $unit_sn . "')"
                . " GROUP BY ts.ORD_ID"
                . " ORDER BY ts.Number DESC";
    } else {
        $sql = "SELECT	* FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID "
                . "WHERE ((ORD_Status = '1'  AND ts.ORD_Type = '" . $typesell . "') AND (Date_Sell >= '" . $datestart . "' AND Date_Sell <= '" . $dateend . "'))"
                . " AND (S_ID = '" . $unit_sn . "' OR Unit_ID = '" . $unit_sn . "')"
                . " GROUP BY ts.ORD_ID"
                . " ORDER BY ts.Number DESC";
    }
}
$stmt = $dbh->prepare($sql);
$stmt->execute();

while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $dateSell = DateThaiTime($result['Date_Sell']);
    $TotalMoney = number_format($result['Total_Money']) . " บาท";
    if ($loginType == "root" || $loginType == "admin") {
        if (strtotime($result["Date_Sell"]) > strtotime('-7 day')) {
            $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span> จัดการรายการขาย</button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalDetail" class="modal-group"  onclick="DetailSell(\'' . $result['ORD_ID'] . '\');" ><span class="fa fa-info-circle"></span> รายละเอียดการขาย</a></li>
                                                <li><a data-toggle="modal" href="#ModalDetail" class="modal-group"  onclick="DetailBill(\'' . $result['ORD_ID'] . '\');" ><span class="fa fa-file-text-o"></span> ใบเสร็จรับเงิน</a></li>
                                                <li><a href="#" onclick="CancelSell(\'' . $result['ORD_ID'] . '\');" ><span class="fa fa-close"></span> ยกเลิกการขาย</a></li>
                                            </ul>
                                        </div></center>';
        } else {
            $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span> จัดการรายการขาย</button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalDetail" class="modal-group"  onclick="DetailSell(\'' . $result['ORD_ID'] . '\');" ><span class="fa fa-info-circle"></span> รายละเอียดการขาย</a></li>
                                                <li><a data-toggle="modal" href="#ModalDetail" class="modal-group"  onclick="DetailBill(\'' . $result['ORD_ID'] . '\');" ><span class="fa fa-file-text-o"></span> ใบเสร็จรับเงิน</a></li>
                                            </ul>
                                        </div></center>';
        }
    } else if ($loginType == "user") {
        $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span> จัดการรายการขาย</button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalDetail" class="modal-group"  onclick="DetailSell(\'' . $result['ORD_ID'] . '\');" ><span class="fa fa-info-circle"></span> รายละเอียดการขาย</a></li>
                                                <li><a data-toggle="modal" href="#ModalDetail" class="modal-group"  onclick="DetailBill(\'' . $result['ORD_ID'] . '\');" ><span class="fa fa-file-text-o"></span> ใบเสร็จรับเงิน</a></li>
                                            </ul>
                                        </div></center>';
    }
    if ($result['ORD_Type'] == 'sell') {
        $type = '<span class="label bg-green-gradient" style="font-size: 12px; font-family: Tahoma;">ขายปกติ</span>';
    } else {
        $type = '<span class="label bg-blue-gradient" style="font-size: 12px; font-family: Tahoma;">ซ่อมขาย</span>';
    }
    $arr['data'][] = array(
        $num,
        $result['ORD_ID'],
        //$result['Date_Sell'],
        $dateSell,
        $TotalMoney,
        $result['Emp_ID'],
        $type,
        $action,
    );
    $num++;
}
echo json_encode($arr);
?>