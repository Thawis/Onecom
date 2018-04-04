<?php

session_start();
$userType = $_SESSION['login_type'];
include '../../../lib/connect.php';
$id = $_GET['id'];
$sub = $_GET['sub'];
$sql;
$num2 = 1;
if (empty($_GET['sub'])) {
    if ($_GET['id'] == 'All') {
        //$sql = 'select * FROM t_sub_group_product tsgp JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE P_Status = "1"';
        //$sql = 'SELECT * FROM t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tp.P_Status = "1"';
        $sql = 'SELECT * FROM t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID';
    } else {
        //$sql = 'select * FROM t_sub_group_product tsgp JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tsgp.G_ID ="' . $id . '" AND P_Status = "1"';
        //$sql = 'SELECT * FROM t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tp.P_Status = "1" AND tsgp.G_ID ="' . $id . '"';
        $sql = 'SELECT * FROM t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tsgp.G_ID ="' . $id . '"';
    }
} else if (!empty($_GET['sub'])) {
    if ($_GET['sub'] == 'All') {
        //$sql = 'select * FROM t_sub_group_product tsgp JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tsgp.G_ID ="' . $id . '" AND P_Status = "1"';
        //$sql = 'SELECT * FROM t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tp.P_Status = "1" AND tsgp.G_ID ="' . $id . '"';
        $sql = 'SELECT * FROM t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tsgp.G_ID ="' . $id . '"';
    } else {
        //$sql = 'select * FROM t_sub_group_product tsgp JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tsgp.G_ID ="' . $id . '" AND tsgp.SG_ID ="'.$sub.'" AND P_Status = "1"';
        //$sql = 'SELECT * FROM t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tp.P_Status = "1" AND tsgp.G_ID ="' . $id . '" AND tsgp.SG_ID ="' . $sub . '"';
        $sql = 'SELECT * FROM t_group_product tgp JOIN t_sub_group_product tsgp on tgp.G_ID = tsgp.G_ID JOIN t_product tp on tp.SG_ID = tsgp.SG_ID JOIN t_brand tb on tp.B_ID = tb.B_ID WHERE tsgp.G_ID ="' . $id . '" AND tsgp.SG_ID ="' . $sub . '"';
    }
}



$stmt = $dbh->prepare($sql);
$stmt->execute();
$arr = array('data' => array());
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($userType == "user") {
//        $action = '<center><div class="btn-group">
//                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลสินค้า </button>
//                                            <ul id="listgroup" class="dropdown-menu">
//                                                <li><a data-toggle="modal" href="#ModalDetail" class="modal-group" onclick="setpid(\'' . $result['P_ID'] . '\')"><span class="fa fa-info-circle"></span> รายละเอียด</a></li>
//                                            </ul>
//                                        </div></center>';
        $action = '<button type="button" class="btn bg-aqua-gradient" onclick="setpid(\'' . $result['P_ID'] . '\')"><span class="fa fa-info-circle"></span></button> ';
    } else {
        if ($result['P_Status'] == "0") {
//            $action = '<center><div class="btn-group">
//                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลสินค้า </button>
//                                            <ul id="listgroup" class="dropdown-menu">
//                                                <li><a data-toggle="modal" href="#ModalEdit" class="modal-group" onclick="setedit(\'' . $result['P_ID'] . '\')"><span class="fa fa-gear"></span> แก้ไขข้อมูลสินค้า</a></li>
//                                                <li><a data-toggle="modal" href="#ModalDetail" class="modal-group" onclick="setpid(\'' . $result['P_ID'] . '\')"><span class="fa fa-info-circle"></span> รายละเอียด</a></li>
//                                                <li><a onclick="setopen(\'' . $result['P_ID'] . '\')"><span class="fa fa-check"></span> เปิดใช้งาน</a></li>
//                                            </ul>
//                                        </div></center>';
            $action = '<button type="button" class="btn bg-aqua-gradient" onclick="setpid(\'' . $result['P_ID'] . '\')"><span class="fa fa-info-circle"></span></button> '
//                    . '<button type="button" class="btn bg-yellow-gradient" onclick="setedit(\'' . $result['P_ID'] . '\')"><span class="fa fa-pencil"></span></button> '
                    . '<button type="button" class="btn bg-green-gradient" onclick="setopen(\'' . $result['P_ID'] . '\')"><span class="fa fa-circle-o"></span></button> '
                    . '<button type="button" class="btn bg-red-gradient" onclick="setremove(\'' . $result['P_ID'] . '\')"><span class="fa fa-warning"></span></button>';
        } else if ($result['P_Status'] == "1") {
//            $action = '<center><div class="btn-group">
//                                            <button type="button" class="btn bg-yellow color-palette btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลสินค้า </button>
//                                            <ul id="listgroup" class="dropdown-menu">
//                                                <li><a data-toggle="modal" href="#ModalEdit" class="modal-group" onclick="setedit(\'' . $result['P_ID'] . '\')"><span class="fa fa-gear"></span> แก้ไขข้อมูลสินค้า</a></li>
//                                                <li><a data-toggle="modal" href="#ModalDetail" class="modal-group" onclick="setpid(\'' . $result['P_ID'] . '\')"><span class="fa fa-info-circle"></span> รายละเอียด</a></li>
//                                                <li><a onclick="setcancel(\'' . $result['P_ID'] . '\')"><span class="fa fa-close"></span> ยกเลิกรายการสินค้า</a></li>
//                                            </ul>
//                                        </div></center>';
            $action = '<button type="button" class="btn bg-aqua-gradient" onclick="setpid(\'' . $result['P_ID'] . '\')"><span class="fa fa-info-circle"></span></button> '
                    . '<button type="button" class="btn bg-yellow-gradient" onclick="setedit(\'' . $result['P_ID'] . '\')"><span class="fa fa-pencil"></span></button> '
                    . '<button type="button" class="btn bg-red-gradient" onclick="setcancel(\'' . $result['P_ID'] . '\')"><span class="fa fa-close"></span></button>';
        }
    }

    $sql2 = 'SELECT COUNT(*) FROM t_product_unit WHERE P_ID = "' . $result['P_ID'] . '" AND PU_Status = "1" ';
    $stmt2 = $dbh->prepare($sql2);
    $stmt2->execute();
    //$num = $stmt2->rowCount();    
    $num = $stmt2->fetch();

    $status;
    if ($num['COUNT(*)'] > 0) {
        $nums = '<span class="label bg-green-gradient" style="font-size:12px;">' . $num['COUNT(*)'] . '</span>';
    } else {
        $nums = '<span class="label bg-red-gradient" style="font-size:12px;">' . $num['COUNT(*)'] . '</span>';
    }
    if ($result['P_Status'] == "0") {
        $status = '<span class="label bg-red-gradient" style="font-size:12px;">ยกเลิก</span>';
    } else if ($result['P_Status'] == "1") {
        $status = '<span class="label bg-green-gradient" style="font-size:12px;">ปกติ</span>';
    }

    $strnum = strlen($result['P_Name']);
    if ($strnum > 23) {
        $pname = substr($result['P_Name'], 0, 23) . '..';
    } else {
        $pname = $result['P_Name'];
    }
    $price = number_format($result['P_Price']) . ' บาท';
    $arr['data'][] = array(
        $num2,
        $result['P_ID'],
        $pname,
        $result['G_Name'],
        $result['B_Name'],
        $price,
        //$result['P_Price'],
        $status,
        $nums,
        $action,
    );
    $num2++;
}
echo json_encode($arr)
?>



