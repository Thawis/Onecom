<?php
session_start();
require_once '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';
ob_start();
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");
//$datethai = DateThai($today);

$type = $_SESSION['R_SMS_Type'];
$datestart = $_SESSION['R_SMS_Start'];
$dateend = $_SESSION['R_SMS_End'];

$start = DateThai($datestart);
$end = DateThai($dateend);

if ($type == "All") {
    $show = 'ทั้งหมด';
} else if ($type == "Repair") {
    $show = 'การซ่อม';
} else if ($type == "Claim_NO") {
    $show = 'การเคลม';
}

$num = 1;
$header = '<div style="text-align:center"><img src="../../img/onelogo.png" alt="" width="100px"></div>'
        . '<div style="text-align:center"><h3>ร้าน OneComputer</h3></div>'
        . '<table border="0"><tr><td align="left">รายงานการแจ้งเตือน : ' . $show . ' </td><td align="right">ระหว่างวันที่ ' . $start . ' ถึงวันที่ ' . $end . '</td></tr></table>';


$sql = '';
if ($type == "All") {
    $sql = 'SELECT * FROM t_sms WHERE SMS_Time >= "' . $datestart . '" AND SMS_Time <= "' . $dateend . '"';
} else {
    $sql = 'SELECT * FROM t_sms WHERE SMS_List_id LIKE "%' . $type . '%" AND (SMS_Time >= "' . $datestart . '" AND SMS_Time <= "' . $dateend . '")';
}
$arr = array("data" => array());
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
?>
<table border="1" repeat_header="1">
    <thead>
        <tr>
            <th width="10%">ลำดับ</th>
            <th width="25%">รหัสรายการส่ง</th>
            <th width="25%">เวลาที่ส่ง</th>
            <th width="20%">ประเภท</th>
            <th width="20%">เบอร์ที่ส่ง</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($rows == 0) { ?>
            <tr>
                <td width="100%" colspan="5" style="text-align: center;">ไม่พบข้อมูล</td>
            </tr>
            <?php
        } else {
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $datethai = DateThaiTime($result['SMS_Time']);
                $tel = getTel($result['SMS_Tel_Send']);
                $needle = "Repair_NO";
                if (strpos($result['SMS_List_id'], $needle) !== false) {
                    $smsType = "แจ้งเตือนซ่อม";
                } else {
                    $smsType = "แจ้งเตือนเคลม";
                }
                ?>
                <tr>
                    <td width="10%" style="text-align: center;"><?= $num; ?></td>
                    <td width="25%" style="text-align: left;"><?= $result['SMS_List_id']; ?></td>
                    <td width="25%" style="text-align: center;"><?= $datethai; ?></td>
                    <td width="20%" style="text-align: center;"><?= $smsType; ?></td>
                    <td width="20%" style="text-align: center;"><?= $tel; ?></td>
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
$mpdf->SetTitle('รายงานการแจ้งเตือน');
$mpdf->SetSubject('รายงานการแจ้งเตือน');
$mpdf->defaultfooterline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetAutoFont();
// $mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);

$mpdf->Output('SMSReport.pdf', 'I');
$dbh = null;

function getTel($tel) {
    $f1 = substr($tel, 0, 3) . '-';
    $f2 = substr($tel, 3, 3) . '-';
    $f3 = substr($tel, 6, 4);
    return $f1 . $f2 . $f3;
}

;
?>