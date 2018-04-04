<?php

include '../../../lib/connect.php';
include '../../../lib/getDate_TH.php';
session_start();
$loginType = $_SESSION['login_type'];
$sql = "SELECT * FROM t_sell WHERE ORD_Status = '1' ORDER BY Number DESC";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
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
    //$date1 = substr($result['Date_Sell'], 0, 10);
    $arr['data'][] = array(
        $num,
        $result['ORD_ID'],
        //$result['Date_Sell'],
        $dateSell,
        $TotalMoney,
        $result['Emp_ID'],
        $type,
        $action
    );
    $num++;
}
echo json_encode($arr);
?>