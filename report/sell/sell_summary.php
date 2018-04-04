<?php
session_start();
include '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';

$type = $_SESSION['R_Sell_Type'];
$datestart = $_SESSION['R_Sell_Start'];
$dateend = $_SESSION['R_Sell_End'];
//$sell_total = $_SESSION['R_Sell_Total'];
ob_start();
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");
$datethai = DateThai($today);
$datestart1 = DateThai($datestart);
$dateend1 = DateThai($dateend);
$num = 1;

if ($type == 'sell') {
    $type1 = 'ขายปกติ';
} else if ($type == 'repair') {
    $type1 = 'ขายซ่อม';
} else {
    $type1 = 'ทั้งหมด';
}

$sql_total = 'SELECT SUM(P_Price) FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID '
        . 'WHERE (Date_Sell >= "' . $datestart . '" AND Date_Sell <= "' . $dateend . '")';
$stmt_total = $dbh->prepare($sql_total);
$stmt_total->execute();
$result_total = $stmt_total->fetch();
$sell_total = number_format($result_total['SUM(P_Price)']).' บาท';

$header = '<div style="text-align:center"><img src="../../img/onelogo.png" alt="" width="100px"></div>'
        . '<div style="text-align:center"><h3>ร้าน OneComputer</h3></div>'
        . '<table border="0"><tr><td colspan="2" align="center"><h4>รายงานสรุปการขาย</h4></td></tr>'
        . '<tr><td align="left">ตั้งแต่วันที่ : ' . $datestart1 . ' ถึงวันที่ ' . $dateend1 . ' </td><td align="right">ออกรายงาน ณ วันที่ : ' . $datethai . ' </td></tr>'
        . '<tr><td align="left"></td><td align="right">ยอดขายรวม : ' . $sell_total . ' </td></tr></table>';


$sql = 'SELECT P_ID,P_Name,SUM(P_Price),COUNT(P_Name) FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID '
        . 'WHERE (Date_Sell >= "'.$datestart.'" AND Date_Sell <= "'.$dateend.'") '
        . 'GROUP BY P_Name ORDER BY Count(P_Name) desc';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
?>

<table border="1" repeat_header="1" id="tableSell">
    <thead>
        <tr style="background-color: #cdf;">
            <td width="15%" style="text-align:center;">ลำดับ</td>
            <td width="15%" style="text-align:center;">รหัสสินค้า</td>
            <td width="30%" style="text-align:center;">ชื่อสินค้า</td> 
            <td width="20%" style="text-align:center;">ยอดขาย (ชิ้น)</td>                                                    
            <td width="20%" style="text-align:center;">ยอดเงินรวม</td>
        </tr>
    </thead>
    <tbody>
        <?php if ($rows == 0) { ?>
            <tr>
                <td colspan="6" width="100%" class="small_font_c">ไม่พบข้อมูล</td>
            </tr>
            <?php
        } else if ($rows > 0) {
            while ($result = $stmt->fetch()) {
                $p_id = $result['P_ID'];
                $p_name = $result['P_Name'];
                $num_p = $result['COUNT(P_Name)'];
                $total_p = number_format($result['SUM(P_Price)']).' บาท';
                ?>
                <tr>
                    <td width="15%"><?= $num; ?></td>
                    <td width="15%"><?= $p_id; ?></td>
                    <td width="30%" style="text-align: left;"><?= $p_name; ?></td>                                                    
                    <td width="20%"><?= $num_p; ?></td>
                    <td width="20%" style="text-align: right;"><?= $total_p; ?></td>
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
$stylesheet = file_get_contents('style2.css');
ob_end_clean();
$mpdf = new mPDF('th', 'A4', '0', '', '20', '20', '55', '15'); //A4-L
// header.
$mpdf->defaultheaderfontsize = 10; /* in pts */
$mpdf->defaultheaderfontstyle = null; /* blank, B, I, or BI */
$mpdf->defaultheaderline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetHTMLHeader($header);
$mpdf->SetFooter('{PAGENO} / {nb}');
$mpdf->SetTitle('รายงานรายการขาย');
$mpdf->SetSubject('รายงานรายการขาย');
$mpdf->defaultfooterline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetAutoFont();
// $mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);

$mpdf->Output('SellListReport.pdf', 'I');
$dbh = null;
?>