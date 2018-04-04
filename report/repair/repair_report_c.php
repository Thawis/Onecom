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
} else {
    $emp1 = $emp_name;
}

$header = '<div style="text-align:center"><img src="../../img/onelogo.png" alt="" width="100px"></div>'
        . '<div style="text-align:center"><h3>ร้าน OneComputer</h3></div>'
        . '<table border="0"><tr><td colspan="2" align="center"><h4>รายงานซ่อมเคลมของ : ' . $emp1 . '</h4></td></tr>'
        . '<tr><td align="left">ตั้งแต่วันที่ : ' . $datestart1 . ' ถึงวันที่ ' . $dateend1 . ' </td><td align="right">ออกรายงาน ณ วันที่ : ' . $datethai . ' </td></tr>'
        . '</table>';

if ($emp == 'All') {
    $sql = 'SELECT Date_R,tri.Item_Name,tri.Type_Item,tri.Item_SN,trc.Item_manner,trc.Emp_ID,Repair_Claim_ID,trc.Item_ID,trc.Repair_Claim_Status,trc.Item_Detail '
            . 'FROM t_repair_claim trc JOIN t_repair_item tri ON trc.Item_ID = tri.Item_ID '
            . 'WHERE (Date_R >= "' . $datestart . '" AND Date_R <= "' . $dateend . '") AND Repair_Claim_Status != "0"';
} else {
    $sql = 'SELECT Date_R,tri.Item_Name,tri.Type_Item,tri.Item_SN,trc.Item_manner,trc.Emp_ID,Repair_Claim_ID,trc.Item_ID,trc.Repair_Claim_Status,trc.Item_Detail '
            . 'FROM t_repair_claim trc JOIN t_repair_item tri ON trc.Item_ID = tri.Item_ID '
            . 'WHERE (Date_R >= "' . $datestart . '" AND Date_R <= "' . $dateend . '") AND trc.Emp_ID = "' . $emp . '" AND Repair_Claim_Status != "0"';
}
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
?>

<table border="1" repeat_header="1" id="tableSell">
    <thead>
        <tr style="background-color: #cdf;">
            <td width="10%" style="text-align:center;">ลำดับ</td>
            <td width="20%" style="text-align:center;">เลขที่ใบซ่อมเคลม/เลขที่สินค้า</td>
            <td width="20%" style="text-align:center;">วันที่รับซ่อม</td>                                                    
            <td width="35%" style="text-align:center;">รายละเอียด</td>
            <td width="15%" style="text-align:center;">สถานะ</td>
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
                $datethai_s = DateThai($result['Date_R']);
                $detail = 'ชื่อสินค้า : ' . $result['Item_Name'] . '<br>'
                        . 'ประเภท : ' . $result['Type_Item'] . '<br>'
                        . 'S/N : ' . $result['Item_SN'] . '<br>'
                        . 'อาการเสีย : ' . $result['Item_manner'] . '<br>'
                        . 'บันทึกการแก้ไข : ' . $result['Item_Detail'] . '<br>'
                        . 'ซ่อมโดย : ' . $result['Emp_ID'];
                $rid = 'เลขที่ใบซ่อม : ' . $result['Repair_Claim_ID'] . '<br>'
                        . 'เลขที่สินค้า : ' . $result['Item_ID'];
                if ($result['Repair_Claim_Status'] == '1') {
                    $r_status = 'รอซ่อม';
                } else if ($result['Repair_Claim_Status'] == '2') {
                    $r_status = 'อยู่ระหว่างซ่อม';
                } else if ($result['Repair_Claim_Status'] == '3') {
                    $r_status = 'ซ่อมเรียบร้อย';
                } else if ($result['Repair_Claim_Status'] == '4') {
                    $r_status = 'ส่งคืนเรียบร้อย';
                }
                ?>
                <tr>
                    <td width="10%" style="text-align:center;"><?= $num; ?></td>
                    <td width="20%" style="text-align:left;"><?= $rid; ?></td>
                    <td width="20%" style="text-align:center;"><?= $datethai_s; ?></td>                                                    
                    <td width="35%" style="text-align:left;"><?= $detail; ?></td>
                    <td width="15%" style="text-align:center;"><?= $r_status; ?></td>
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
$mpdf = new mPDF('th', 'A4', '0', '', '20', '20', '50', '15'); //A4-L
// header.
$mpdf->defaultheaderfontsize = 10; /* in pts */
$mpdf->defaultheaderfontstyle = null; /* blank, B, I, or BI */
$mpdf->defaultheaderline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetHTMLHeader($header);
$mpdf->SetFooter('{PAGENO} / {nb}');
$mpdf->SetTitle('รายงานการซ่อมเคลม');
$mpdf->SetSubject('รายงานการซ่อมเคลม');
$mpdf->defaultfooterline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetAutoFont();
// $mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);

$mpdf->Output('RepairClaimReport.pdf', 'I');
$dbh = null;
?>