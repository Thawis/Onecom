<?php
session_start();
include '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';

$emp = $_SESSION['R_repair_emp'];
$emp_name = $_SESSION['R_repair_emp_name'];
$datestart = $_SESSION['R_repair_Start'];
$dateend = $_SESSION['R_repair_End'];

ob_start();
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");
$datethai = DateThai($today);
$datestart1 = DateThai($datestart);
$dateend1 = DateThai($dateend);
$num = 1;

if ($emp == 'All') {
    $emp1 = 'ทั้งหมด';
    $sql_total = 'SELECT SUM(Repair_Total_Price) FROM t_repair_item tri JOIN t_repair tr ON tri.R_ID = tr.R_ID '
            . 'WHERE (R_Date >= "' . $datestart . '" AND R_Date <= "' . $dateend . '") AND tri.Item_Status != "0"';
} else {
    $emp1 = $emp_name;
    $sql_total = 'SELECT SUM(Repair_Total_Price) FROM t_repair_item tri JOIN t_repair tr ON tri.R_ID = tr.R_ID '
            . 'WHERE (R_Date >= "' . $datestart . '" AND R_Date <= "' . $dateend . '") AND tri.Emp_ID = "' . $emp . '" AND tri.Item_Status != "0"';
}

$stmt_total = $dbh->prepare($sql_total);
$stmt_total->execute();
$result_total = $stmt_total->fetch();
$repair_total = number_format($result_total['SUM(Repair_Total_Price)']) . ' บาท';
$header = '<div style="text-align:center"><img src="../../img/onelogo.png" alt="" width="100px"></div>'
        . '<div style="text-align:center"><h3>ร้าน OneComputer</h3></div>'
        . '<table border="0"><tr><td colspan="2" align="center"><h4>รายงานซ่อมปกติของ : ' . $emp1 . '</h4></td></tr>'
        . '<tr><td align="left">ตั้งแต่วันที่ : ' . $datestart1 . ' ถึงวันที่ ' . $dateend1 . ' </td><td align="right">ออกรายงาน ณ วันที่ : ' . $datethai . ' </td></tr>'
        . '<tr><td align="left"></td><td align="right">ค่าซ่อมรวม : ' . $repair_total . ' </td></tr></table>';

if ($emp == 'All') {
    $sql = 'SELECT Item_ID,tr.R_ID,Item_Name,Type_Item,Item_SN,Item_manner,Item_Status,tri.Emp_ID,Repair_Total_Price,tr.R_DATE FROM t_repair_item tri JOIN t_repair tr ON tri.R_ID = tr.R_ID '
            . 'WHERE (R_Date >= "' . $datestart . '" AND R_Date <= "' . $dateend . '") AND tri.Item_Status != "0"';
} else {
    $sql = 'SELECT Item_ID,tr.R_ID,Item_Name,Type_Item,Item_SN,Item_manner,Item_Status,tri.Emp_ID,Repair_Total_Price,tr.R_DATE FROM t_repair_item tri JOIN t_repair tr ON tri.R_ID = tr.R_ID '
            . 'WHERE (R_Date >= "' . $datestart . '" AND R_Date <= "' . $dateend . '") AND tri.Emp_ID = "' . $emp . '" AND tri.Item_Status != "0"';
}
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
?>

<table border="1" repeat_header="1" id="tableSell">
    <thead>
        <tr style="background-color: #cdf;">
            <td width="5%" style="text-align:center;">ลำดับ</td>
            <td width="20%" style="text-align:center;">เลขที่ใบซ่อม/เลขที่สินค้า</td>
            <td width="15%" style="text-align:center;">วันที่รับซ่อม</td>                                                    
            <td width="30%" style="text-align:center;">รายละเอียด</td>
            <td width="15%" style="text-align:center;">สถานะ</td>
            <td width="15%" style="text-align:center;">ค่าซ่อม</td>
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
                $datethai_s = DateThai($result['R_DATE']);
                $price = number_format($result['Repair_Total_Price']) . ' บาท';
                $detail = 'ชื่อสินค้า : ' . $result['Item_Name'] . '<br>'
                        . 'ประเภท : ' . $result['Type_Item'] . '<br>'
                        . 'S/N : ' . $result['Item_SN'] . '<br>'
                        . 'อาการเสีย : ' . $result['Item_manner'] . '<br>'
                        . 'ซ่อมโดย : ' . $result['Emp_ID'];
                $rid = 'เลขที่ใบซ่อม : ' . $result['R_ID'] . '<br>'
                        . 'เลขที่สินค้า : ' . $result['Item_ID'];
                if ($result['Item_Status'] == '1') {
                    $r_status = 'รอซ่อม';
                } else if ($result['Item_Status'] == '2') {
                    $r_status = 'อยู่ระหว่างซ่อม';
                } else if ($result['Item_Status'] == '3') {
                    $r_status = 'ซ่อมเรียบร้อย';
                } else if ($result['Item_Status'] == '4') {
                    $r_status = 'ส่งคืนเรียบร้อย';
                }
                ?>
                <tr>
                    <td width="5%" style="text-align:center;"><?= $num; ?></td>
                    <td width="20%" style="text-align:left;"><?= $rid; ?></td>
                    <td width="15%" style="text-align:center;"><?= $datethai_s; ?></td>                                                    
                    <td width="30%" style="text-align:left;"><?= $detail; ?></td>
                    <td width="15%" style="text-align:center;"><?= $r_status; ?></td>
                    <td width="15%" style="text-align:right;"><?= $price; ?></td>
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
$mpdf->SetTitle('รายงานการซ่อมปกติ');
$mpdf->SetSubject('รายงานการซ่อมปกติ');
$mpdf->defaultfooterline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetAutoFont();
// $mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);

$mpdf->Output('RepairReport.pdf', 'I');
$dbh = null;
?>