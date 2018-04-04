<?php

include '../../../lib/connect.php';
$import_id = $_POST['import_id'];
$sql = 'SELECT * FROM t_product_unit WHERE Import_ID = "' . $import_id . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array('data' => array());
$num = 1;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span>จัดการรับเข้าสินค้า</button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a data-toggle="modal" href="#ModalImportDetail" class="modal-group"  onclick="DetailImport(\'' . $result['Unit_ID'] . '\');" ><span class="fa fa-info-circle"></span> แก้ไขรายละเอียด</a></li>
                                                <li><a href="M_Import_Detail_Edit.php?import_id='.$result['Unit_ID'].'"><span class="fa fa-gear"></span> แก้ไขการรับเข้าสินค้า</a></li>
                                                <li><a onclick="CancelImport(\'' . $result['Unit_ID'] . '\');" ><span class="fa fa-close"></span> ยกเลิกการรับเข้าสินค้า</a></li>
                                            </ul>
                                        </div></center>';
    
    
    $arr['data'][] = array(
        $num,
        $result['Unit_ID'],
        $result['S_ID'],
        $result['Date_Receive'],
        $result['End_Warranty'],
        $result['Warranty'],
        $action
    );
    $num++;
}
echo json_encode($arr);
?>