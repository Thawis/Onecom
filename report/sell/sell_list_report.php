<?php
session_start();
require_once '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';

$type = $_SESSION['R_Sell_Type'];
$datestart = $_SESSION['R_Sell_Start'];
$dateend = $_SESSION['R_Sell_End'];
$sell_total = $_SESSION['R_Sell_Total'];
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


$header = '<div style="text-align:center"><img src="../../img/onelogo.png" alt="" width="100px"></div>'
        . '<div style="text-align:center"><h3>ร้าน OneComputer</h3></div>'
        . '<table border="0"><tr><td align="left">รายงานขาย ประเภท : ' . $type1 . ' ตั้งแต่วันที่ : ' . $datestart1 . ' ถึงวันที่ ' . $dateend1 . ' </td><td align="right">ออกรายงาน ณ วันที่ : ' . $datethai . ' </td></tr>'
        . '<tr><td align="left"></td><td align="right">ยอดขายรวม : ' . $sell_total . ' </td></tr></table>';

if ($type == 'All') {
    $sql = 'SELECT ts.ORD_ID,Date_Sell,P_Name,P_Price,Unit_ID,S_ID,te.Emp_ID,S_ID,ORD_Type,te.Emp_Name '
            . 'FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID '
            . 'JOIN t_employee te ON ts.Emp_ID = te.Emp_ID '
            . 'WHERE (Date_Sell >= "' . $datestart . '" AND Date_Sell <= "' . $dateend . '")';
} else {
    $sql = 'SELECT ts.ORD_ID,Date_Sell,P_Name,P_Price,Unit_ID,S_ID,te.Emp_ID,S_ID,ORD_Type,te.Emp_Name '
            . 'FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID '
            . 'JOIN t_employee te ON ts.Emp_ID = te.Emp_ID '
            . 'WHERE (Date_Sell >= "' . $datestart . '" AND Date_Sell <= "' . $dateend . '") AND ORD_Type = "' . $type . '"';
}
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
?>

<table border="1" repeat_header="1" id="tableSell">
    <thead>
        <tr style="background-color: #cdf;">
            <td width="5%" style="text-align:center;">ลำดับ</td>
            <td width="15%" style="text-align:center;">เลขที่ใบเสร็จ</td>
            <td width="20%" style="text-align:center;">วันที่ขาย</td>                                                    
            <td width="25%" style="text-align:center;">รายละเอียด</td>
            <td width="15%" style="text-align:center;">ราคา</td>
            <td width="10%" style="text-align:center;">ประเภท</td>
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
                $datethai_s = DateThaiTime($result['Date_Sell']);
                $Price = number_format($result['P_Price']) . ' บาท';

                if ($result['ORD_Type'] == 'sell') {
                    $type = 'ขายปกติ';
                } else if ($result['ORD_Type'] == 'repair') {
                    $type = 'ขายซ่อม';
                }

                $detail = 'ชื่อสินค้า : ' . $result['P_Name'] . ' <br>'
                        . 'เลขที่สินค้า : ' . $result['Unit_ID'] . '<br>'
                        . 'S/N : ' . $result['S_ID'] . '<br>'
                        . 'ขายโดย : ' . $result['Emp_Name'] . ' ( ' . $result['Emp_ID'] . ' )';
                ?>
                <tr>
                    <td width="10%"><?= $num; ?></td>
                    <td width="15%"><?= $result['ORD_ID']; ?></td>
                    <td width="20%"><?= $datethai_s; ?></td>                                                    
                    <td width="35%" style="text-align: left;"><?= $detail; ?></td>
                    <td width="15%" style="text-align: right;"><?= $Price; ?></td>
                    <td width="10%"><?= $type; ?></td>
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
$mpdf = new mPDF('th', 'A4', '0', '', '20', '20', '50', '15'); //A4-L
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