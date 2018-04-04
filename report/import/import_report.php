<?php
session_start();
require_once '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';

$type = $_SESSION['R_Import_type'];
$datestart = $_SESSION['R_Import_start'];
$dateend = $_SESSION['R_Import_end'];

ob_start();
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");
$datethai = DateThai($today);
$datestart1 = DateThai($datestart);
$dateend1 = DateThai($dateend);
$num = 1;

if ($type == 'sell') {
    $type1 = 'สินค้าสำหรับขาย';
} else if ($type == 're_sell') {
    $type1 = 'สินค้าเคลมขาย';
} else {
    $type1 = 'ทั้งหมด';
}


$header = '<div style="text-align:center"><img src="../../img/onelogo.png" alt="" width="100px"></div>'
        . '<div style="text-align:center"><h3>ร้าน OneComputer</h3></div>'
        . '<table border="0"><tr><td align="left">รายงานรับเข้าสินค้า ประเภท : ' . $type1 . ' ตั้งแต่วันที่ : ' . $datestart1 . ' ถึงวันที่ ' . $dateend1 . ' </td><td align="right">ออกรายงาน ณ วันที่ : ' . $datethai . ' </td></tr>'
        . '</table>';

if ($type == 'All') {
    $sql = 'SELECT tmd.Import_ID,tmd.Ref_Import_ID,tmd.Date_Import,tmd.Import_Type,tp.P_Name,tpu.Unit_ID,tpu.S_ID,te.Emp_Name,te.Emp_ID '
            . 'FROM t_import_detail tmd JOIN t_product_unit tpu ON tmd.Import_ID = tpu.Import_ID '
            . 'JOIN t_product tp ON tp.P_ID = tpu.P_ID '
            . 'JOIN t_employee te ON te.Emp_ID = tmd.Emp_ID '
            . 'WHERE (Date_Import >= "' . $datestart . '" AND Date_Import <= "' . $dateend . '")';
} else {
    $sql = 'SELECT tmd.Import_ID,tmd.Ref_Import_ID,tmd.Date_Import,tmd.Import_Type,tp.P_Name,tpu.Unit_ID,tpu.S_ID,te.Emp_Name,te.Emp_ID '
            . 'FROM t_import_detail tmd JOIN t_product_unit tpu ON tmd.Import_ID = tpu.Import_ID '
            . 'JOIN t_product tp ON tp.P_ID = tpu.P_ID '
            . 'JOIN t_employee te ON te.Emp_ID = tmd.Emp_ID '
            . 'WHERE (Date_Import >= "' . $datestart . '" AND Date_Import <= "' . $dateend . '") AND tmd.Import_Type = "' . $type . '"';
}

$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
?>

<table border="1" repeat_header="1" id="tableImport">
    <thead>
        <tr style="background-color: #cdf;">
            <td width="10%" style="text-align:center;">ลำดับ</td>
            <td width="15%" style="text-align:center;">รหัสรายการรับเข้า</td>
            <td width="15%" style="text-align:center;">รหัสที่อ้างอิง</td>
            <td width="15%" style="text-align:center;">วันที่รับเข้า</td>                                                    
            <td width="30%" style="text-align:center;">รายละเอียด</td>
            <td width="15%" style="text-align:center;">ประเภท</td>
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
                $datethai_s = DateThai($result['Date_Import']);

                if ($result['Import_Type'] == 'sell') {
                    $type1 = 'สินค้าสำหรับขาย';
                } else if ($result['Import_Type'] == 're_sell') {
                    $type1 = 'สินค้าเคลมขาย';
                }

                $detail = 'ชื่อสินค้า : ' . $result['P_Name'] . ' <br>'
                        . 'เลขที่สินค้า : ' . $result['Unit_ID'] . '<br>'
                        . 'S/N : ' . $result['S_ID'] . '<br>'
                        . 'รับเข้าโดย : ' . $result['Emp_Name'] . '(' . $result['Emp_ID'] . ')';
                ?>
                <tr>
                    <td width="10%"><?= $num; ?></td>
                    <td width="15%"><?= $result['Import_ID']; ?></td>
                    <td width="15%"><?= $result['Ref_Import_ID']; ?></td>
                    <td width="15%"><?= $datethai_s; ?></td>                                                    
                    <td width="30%" style="text-align: left;"><?= $detail; ?></td>
                    <td width="10%"><?= $type1; ?></td>
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
$mpdf->SetTitle('รายงานรับเข้าสินค้า');
$mpdf->SetSubject('รายงานรับเข้าสินค้า');
$mpdf->defaultfooterline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetAutoFont();
// $mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);

$mpdf->Output('ImportReport.pdf', 'I');
$dbh = null;
?>