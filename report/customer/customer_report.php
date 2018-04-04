<?php
session_start();
require_once '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';
$type = $_SESSION['R_cus_type'];
$status = $_SESSION['R_cus_status'];
ob_start();
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");
$datethai = DateThai($today);
$num = 1;
if ($type == 'All') {
    $r_type = 'ทุกตำแหน่ง';
} else if ($type != 'All') {
    if ($type == 'normal') {
        $r_type = 'บุคคุลธรรมดา';
    } else if ($type == 'company') {
        $r_type = 'บริษัท';
    }
}
if ($status == 'All') {
    $r_status = 'ทุกสถานะ';
} else if ($status == '1') {
    $r_status = 'ปกติ';
} else if ($status == '0') {
    $r_status = 'ยกเลิก';
}

$header = '<div style="text-align:center"><img src="../../img/onelogo.png" alt="" width="100px"></div>'
        . '<div style="text-align:center"><h3>ร้าน OneComputer</h3></div>'
        . '<table border="0"><tr><td align="left">รายงานข้อมูลรายชื่อลูกค้า ประเภท : ' . $r_type . ' สถานะ : ' . $r_status . '</td><td align="right">ออกรายงาน ณ วันที่ : ' . $datethai . ' </td></tr></table>';

$sql = '';
$num = 1;
if ($type == "All") {
    if ($status == "All") {
        $sql = 'SELECT * FROM t_customer';
    } else {
        $sql = 'SELECT * FROM t_customer WHERE Customer_Status = "' . $status . '"';
    }
} else if ($type != "All") {
    if ($status == "All" && $type == "company") {
        $sql = 'SELECT * FROM t_customer WHERE Customer_Surname = "' . $type . '"';
    } else if ($status == "All" & $type == "normal") {
        $sql = 'SELECT * FROM t_customer WHERE Customer_Surname != "company" ';
    } else if ($status != "ALL" && $type == "company") {
        $sql = 'SELECT * FROM t_customer WHERE Customer_Surname = "' . $type . '" AND Customer_Status = "' . $status . '"';
    } else if ($status != "ALL" && $type == "normal") {
        $sql = 'SELECT * FROM t_customer WHERE Customer_Surname != "company" AND Customer_Status = "' . $status . '"';
    } else {
        $sql = 'SELECT * FROM t_customer';
    }
}
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
?>
<table border="1" repeat_header="1">
    <thead>
        <tr>
            <th width="10%" style="text-align:center;">ลำดับ</th>
            <th width="15%" style="text-align:center;">รหัสลูกค้า</th>
            <th width="30%" style="text-align:left;">ชื่อลูกค้า</th>                                                    
            <th width="15%" style="text-align:center;">ประเภท</th>
            <th width="10%" style="text-align:center;">สถานะ</th>
            <th width="20%" style="text-align:center;">เบอร์ติดต่อ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($rows == 0) {
            ?>
            <tr>
                <td colspan="6" class="font_2">ไม่พบข้อมูล</td>
            </tr>
            <?php
        } else {
            while ($result = $stmt->fetch()) {
                if ($result['Customer_Surname'] == "company") {
                    $userType = 'บริษัท';
                } else if ($result['Customer_Surname'] != "company") {
                    $userType = 'บุคคุลธรรมดา';
                }

                if ($result['Customer_Status'] == '1') {
                    $userStatus = 'ปกติ';
                } else {
                    $userStatus = 'ยกเลิก';
                }
                $tel = getTel($result['Customer_Tel']);
                ?>
                <tr>
                    <td width="10%" class="font_2"><?= $num; ?></td>
                    <td width="15%" class="font_2"><?= $result['Customer_ID']; ?></td>
                    <td width="30%" class="font_2" style="text-align: left;"><?= $result['Customer_FullName']; ?></td>
                    <td width="15%" class="font_2"><?= $userType; ?></td>
                    <td width="10%" class="font_2"><?= $userStatus; ?></td>
                    <td width="20%" class="font_2"><?= $tel; ?></td>
                </tr>
                <?php
                $num++;
            }
        }
        ?>
    </tbody>
</table>



<?php
$html = ob_get_contents();
$stylesheet = file_get_contents('style.css');
ob_end_clean();
$mpdf = new mPDF('th', 'A4', '0', '', '20', '20', '45', '15'); //A4-L
// header.
$mpdf->defaultheaderfontsize = 10; /* in pts */
$mpdf->defaultheaderfontstyle = null; /* blank, B, I, or BI */
$mpdf->defaultheaderline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetHTMLHeader($header);
$mpdf->SetFooter('{PAGENO} / {nb}');
$mpdf->SetTitle('รายงานข้อมูลรายชื่อลูกค้า');
$mpdf->SetSubject('รายงานข้อมูลรายชื่อลูกค้า');
$mpdf->defaultfooterline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetAutoFont();
// $mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);

$mpdf->Output('CustomerReport.pdf', 'I');
$dbh = null;

function getTel($tel) {
    $f1 = substr($tel, 0, 3) . '-';
    $f2 = substr($tel, 3, 3) . '-';
    $f3 = substr($tel, 6, 4);
    return $f1 . $f2 . $f3;
}

;
?>