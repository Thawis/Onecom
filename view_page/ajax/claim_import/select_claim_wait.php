<?php

include '../../../lib/connect.php';
$sql = 'SELECT * FROM t_claim tc JOIN t_dealer td ON tc.Dealer_ID = td.Dealer_ID WHERE Claim_Status = "2" ORDER BY Number_Claim DESC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array("data" => array());
$num = 1;
while ($result = $stmt->fetch()) {
    if ($result['Claim_Type'] == "forshop") {
        $c_type = '<label class="label bg-green-gradient" style="font-size:12px; font-family:Tahoma;">สินค้าเคลมของร้าน</label>';
    } else if ($result['Claim_Type'] == "forcus") {
        $c_type = '<label class="label bg-blue-gradient" style="font-size:12px; font-family:Tahoma;">ของลูกค้า</label>';
    }

    if ($result['Claim_Type'] == "forshop") {
        $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-green-gradient btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-chevron-circle-down"></span> รับเคลม</button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a href="#" onclick="ClaimEX(\'' . $result['ClaimItem_Name'] . '\',\'' . $result['S_ID'] . '\',\'' . $result['ClaimItem_ID'] . '\')"><span class="fa fa-plus"></span> รับเข้าสินค้า</a></li>
                                            </ul>
                                        </div></center>';
    } else if ($result['Claim_Type'] == "forcus") {
        $action = '<center><div class="btn-group">
                                            <button type="button" class="btn bg-green-gradient btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-chevron-circle-down"></span> รับเคลม</button>
                                            <ul id="listgroup" class="dropdown-menu">
                                                <li><a href="#" onclick="ClaimItem(\'' . $result['ClaimItem_Name'] . '\',\'' . $result['S_ID'] . '\',\'' . $result['ClaimItem_ID'] . '\')"><span class="fa fa-cube"></span> รับสินค้า</a></li>
                                                <li><a href="#" onclick="ClaimETC(\'' . $result['ClaimItem_Name'] . '\',\'' . $result['S_ID'] . '\',\'' . $result['ClaimItem_ID'] . '\')"><span class="fa fa-commenting"></span> ข้อเสนออื่น</a></li>
                                            </ul>
                                        </div></center>';
    }


    //$detail = '<button type="button" class="btn bg-aqua-gradient btn_detail" style="font-size:12px; font-family:Tahoma;" value="' . $result['ClaimItem_ID'] . '"><span class="fa fa-info-circle"></span> รายละเอียดเคลม</button>';
    $name_sn = $result['ClaimItem_Name'] . '<br>S/N : ' . $result['S_ID'];
    $arr['data'][] = array(
        $num,
        $result['ClaimItem_ID'],
        $name_sn,
        $result['Dealer_Company'],
        $c_type,
        $action,
    );
    $num++;
}
echo json_encode($arr);
?>