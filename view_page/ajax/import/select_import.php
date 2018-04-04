<?php

session_start();
$loginType = $_SESSION['login_type'];
include '../../../lib/connect.php';
$num = 1;
$sql = 'SELECT * FROM t_import_detail ORDER BY Number DESC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array('data' => array());
while ($result = $stmt->fetch()) {
    if ($loginType == 'admin' || $loginType == 'root') {
        $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span> จัดการรับเข้าสินค้า</button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalImportDetail" class="modal-group"  onclick="DetailImport(\'' . $result['Import_ID'] . '\');" ><span class="fa fa-info-circle"></span> รายละเอียดรับเข้าสินค้า</a></li>
                                                <li><a href="#" onclick="SendReport(\'' . $result['Import_ID'] . '\');" ><span class="fa fa-clone"></span> พิมพ์เลขที่สินค้า</a></li>     
                                                <li><a href="#" onclick="CancelImport(\'' . $result['Import_ID'] . '\');" ><span class="fa fa-close"></span> ยกเลิกการรับเข้าสินค้า</a></li>
                                            </ul>
                                        </div></center>';
    } else {
        $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span> จัดการรับเข้าสินค้า</button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalImportDetail" class="modal-group" onclick="DetailImport(\'' . $result['Import_ID'] . '\');" ><span class="fa fa-info-circle"></span> รายละเอียดรับเข้าสินค้า</a></li>
                                                <li><a href="#" onclick="SendReport(\'' . $result['Import_ID'] . '\');" ><span class="fa fa-clone"></span> พิมพ์เลขที่สินค้า</a></li>    
                                            </ul>
                                        </div></center>';
    }

    if ($result['Import_Type'] == 'sell') {
        $type = '<label class="label label-success" style="font-family: Tahoma; font-size: 12px;">สินค้าสำหรับขาย</label>';
    } else {
        $type = '<label class="label label-primary" style="font-family: Tahoma; font-size: 12px;">สินค้าเคลมขาย</label>';
    }
    $fullday = DateThai($result['Date_Import']);
    $sql_sn ='SELECT Unit_ID,S_ID FROM t_product_unit WHERE Import_ID = "'.$result['Import_ID'].'";';
    $stmt_sn = $dbh->prepare($sql_sn);
    $stmt_sn->execute();
    
    $new_sn = '';
    $new_unit = '';
    while ($result_sn = $stmt_sn->fetch()){
        $new_sn .= ' '.$result_sn['S_ID'].' ';
        $new_unit .= ' '.$result_sn['Unit_ID'];
    }
       
    $arr['data'][] = array(
        $num,
        $result['Import_ID'],
        $result['Ref_Import_ID'],
        $fullday,
        $type,
        $action,
        $new_sn,
        $new_unit
    );
    $num++;
}
echo json_encode($arr);

//function setday($days) {
//    $year = substr('2017-08-03', 0, 4);
//    $month = substr('2017-08-03', 5, 2);
//    $day = substr('2017-08-03', 8, 2);
//    $fullday = $day . '-' . $month . '-' . $year;
//    return $fullday;
//}

function DateThai($strDate) {
    $strYear = date("Y", strtotime($strDate));
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
//		$strHour= date("H",strtotime($strDate));
//		$strMinute= date("i",strtotime($strDate));
//		$strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear"; //$strHour:$strMinute";
}

?>