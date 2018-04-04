<?php
session_start();
include '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';

//$emp = $_SESSION['R_repair_emp'];
//$emp_name = $_SESSION['R_repair_emp_name'];
$datestart = $_SESSION['R_repair_Start'];
$dateend = $_SESSION['R_repair_End'];

ob_start();
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");
$datethai = DateThai($today);
$datestart1 = DateThai($datestart);
$dateend1 = DateThai($dateend);
$num = 1;


$header = '<div style="text-align:center"><img src="../../img/onelogo.png" alt="" width="100px"></div>'
        . '<div style="text-align:center"><h3>ร้าน OneComputer</h3></div>'
        . '<table border="0"><tr><td colspan="2" align="center"><h4>รายงานสรุปงานซ่อม</h4></td></tr>'
        . '<tr><td align="left">ตั้งแต่วันที่ : ' . $datestart1 . ' ถึงวันที่ ' . $dateend1 . ' </td><td align="right">ออกรายงาน ณ วันที่ : ' . $datethai . ' </td></tr>'
        . '</table>';

$sql = 'SELECT Emp_ID,Emp_Name FROM t_employee WHERE Emp_Status = "1"';

$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
?>

<table border="1" repeat_header="1" id="tableSell">
    <thead>
        <tr style="background-color: #cdf;">
            <td width="10%" style="text-align:center;">ลำดับ</td>
            <td width="15%" style="text-align:center;">รหัสพนักงาน</td>
            <td width="30%" style="text-align:center;">รายละเอียดงานซ่อมปกติ</td>                                                    
            <td width="30%" style="text-align:center;">รายละเอียดงานซ่อมเคลม</td>
            <td width="15%" style="text-align:center;">ค่าซ่อม</td>
        </tr>
    </thead>
    <tbody>
        <?php if ($rows == 0) { ?>
            <tr>
                <td colspan="5" width="100%" class="small_font_c">ไม่พบข้อมูล</td>
            </tr>
            <?php
        } else if ($rows > 0) {
            while ($result = $stmt->fetch()) {
                $emp_id = $result['Emp_ID'];
                $emp_name = $result['Emp_Name'].'( '.$result['Emp_ID'].' )';
//                $sql_r = 'SELECT Emp_ID,COUNT(Item_ID),SUM(Repair_Total_Price) FROM t_repair_item '
//                        . 'WHERE Item_Status != "0" AND Emp_ID = "' . $emp_id . '" '
//                        . 'GROUP BY Emp_ID';

                $sql_r = 'SELECT Emp_ID,COUNT(Item_ID),SUM(Repair_Total_Price) FROM t_repair_item tri JOIN t_repair tr ON tri.R_ID = tr.R_ID '
                        . 'WHERE (R_DATE >= "'.$datestart.'" AND R_DATE <= "'.$dateend.'") AND Item_Status != "0" AND Emp_ID = "'.$emp_id.'" GROUP BY Emp_ID ';

                $stmt_r = $dbh->prepare($sql_r);
                $stmt_r->execute();
                $result_r = $stmt_r->fetch();

                if ($result_r['COUNT(Item_ID)'] == null) {
                    $num_r = '0 งาน';
                } else {
                    $num_r = $result_r['COUNT(Item_ID)'] . ' งาน';
                }
                $price_r = number_format($result_r['SUM(Repair_Total_Price)']) . ' บาท';

                $sql_rc = 'SELECT Emp_ID,COUNT(Item_ID) FROM t_repair_claim '
                        . 'WHERE (DATE_R >= "'.$datestart.'" AND DATE_R <= "'.$dateend.'") AND Repair_Claim_Status != "0" AND Emp_ID = "' . $emp_id . '" GROUP BY Emp_ID ';
                $stmt_rc = $dbh->prepare($sql_rc);
                $stmt_rc->execute();
                $result_rc = $stmt_rc->fetch();
                if ($result_rc['COUNT(Item_ID)'] == null) {
                    $num_rc = '0 งาน';
                } else {
                    $num_rc = $result_rc['COUNT(Item_ID)'] . ' งาน';
                }
                ?>
                <tr>
                    <td width="10%" style="text-align:center;"><?= $num; ?></td>
                    <td width="25%" style="text-align:left;"><?= $emp_name; ?></td>
                    <td width="25%" style="text-align:center;"><?= $num_r; ?></td>                                                    
                    <td width="25%" style="text-align:center;"><?= $num_rc; ?></td>
                    <td width="15%" style="text-align:right;"><?= $price_r; ?></td>
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
$mpdf->SetTitle('รายงานการสรุปงานซ่อม');
$mpdf->SetSubject('รายงานการสรุปงานซ่อม');
$mpdf->defaultfooterline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetAutoFont();
// $mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);

$mpdf->Output('RepairSummaryReport.pdf', 'I');
$dbh = null;
?>