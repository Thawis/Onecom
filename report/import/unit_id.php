<?php
session_start();
include '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';
if (empty($_SESSION['unit_id_print'])) {
    header("location:../../view_page/M_Import_List.php");
} else {
    $imp_id = $_SESSION['unit_id_print'];
}
ob_start();
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");
$datethai = DateThai($today);
$num = 1;
$header = '<div style="text-align:center"><img src="../../img/onelogo.png" alt="" width="100px"></div>'
        . '<div style="text-align:center"><h3>ร้าน OneComputer</h3></div>'
        . '<table border="0"><tr><td align="left">เลขที่รับเข้าที่ : ' . $imp_id . '</td><td align="right">พิมพ์เมื่อวันที่ประจำวันที่ ' . $datethai . ' </td></tr></table>';
$sql = "SELECT S_ID,tp.P_Name,Unit_ID,tp.P_ID FROM t_product_unit tpu JOIN t_product tp ON tpu.P_ID = tp.P_ID WHERE Import_ID = '" . $imp_id . "'";
$stmt = $dbh->prepare($sql);
$stmt->execute();
?>
<table border="1" repeat_header="1">
    <thead>
        <tr>
            <th width="10%">ลำดับ</th>
            <th width="15%">รหัสสินค้า</th>
            <th width="25%">ชื่อสินค้า</th>
            <th width="25%">S/N</th>
            <th width="25%">เลขที่สินค้า</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td width="10%" class="font_4"><?= $num; ?></td>
                <td width="15%" class="font_4"><?= $result['P_ID'] ?></td>
                <td width="25%" class="font_4"><?= $result['P_Name'] ?></td>
                <td width="25%" class="font_4">S/N : <?= $result['S_ID'] ?></td>
                <td width="25%" class="font_4"><?= $result['Unit_ID'] ?></td>
            </tr>
            <?php
            $num++;
        }
        ?>
    </tbody>
</table>

<?php
$html = ob_get_contents();
$stylesheet = file_get_contents('style.css');
ob_end_clean();
$mpdf = new mPDF('th', 'A4', '0', 'Tahoma', '20', '20', '45', '15'); //A4-L
// header.
$mpdf->defaultheaderfontsize = 10; /* in pts */
$mpdf->defaultheaderfontstyle = null; /* blank, B, I, or BI */
$mpdf->defaultheaderline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetHTMLHeader($header);
$mpdf->SetFooter('{PAGENO} / {nb}');
$mpdf->SetTitle('ใบเลขที่สินค้า');
$mpdf->SetSubject('ใบเลขที่สินค้า');
$mpdf->defaultfooterline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetAutoFont();
// $mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);

$mpdf->Output('bill.pdf', 'I');
$dbh = null;
?>