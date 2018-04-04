<?php
session_start();
require_once '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';

$type = $_SESSION['R_claim_type'];
$datestart = $_SESSION['R_claim_start'];
$dateend = $_SESSION['R_claim_end'];
ob_start();
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");
$datethai = DateThai($today);
$datestart1 = DateThai($datestart);
$dateend1 = DateThai($dateend);
$num = 1;


if ($type == 'forshop') {
    $type1 = "สินค้าเคลมของร้าน";
} else if ($type == 'forcus') {
    $type1 = "ของลูกค้า";
} else if ($type == 'All') {
    $type1 = "ทั้งหมด";
}

$header = '<div style="text-align:center"><img src="../../img/onelogo.png" alt="" width="100px"></div>'
        . '<div style="text-align:center"><h3>ร้าน OneComputer</h3></div>'
        . '<table border="0"><tr><td align="left">รายงานการรับเคลมสินค้า ประเภท : ' . $type1 . ' ตั้งแต่วันที่ : ' . $datestart1 . ' ถึงวันที่ ' . $dateend1 . ' </td><td align="right">ออกรายงาน ณ วันที่ : ' . $datethai . ' </td></tr>'
        . '</table>';

if ($type == 'All') {
    //SELECT ClaimItem_ID,Claim_Date_Add,Claim_Date_C_Return,Dealer_ID,Cus_Name,Claim_Type,Claim_Manner,S_ID,ClaimItem_Name
    $sql = 'SELECT * FROM t_claim '
            . 'WHERE (Claim_Date_Add >= "' . $datestart . '" AND Claim_Date_Add <= "' . $dateend . '") AND Claim_Status != "0"';
} else {
    $sql = 'SELECT * FROM t_claim '
            . 'WHERE (Claim_Date_Add >= "' . $datestart . '" AND Claim_Date_Add <= "' . $dateend . '") AND Claim_Type = "' . $type . '" AND Claim_Status != "0"';
}
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
?>

<table border="1" repeat_header="1" id="tableClaim">
    <thead>
        <tr style="background-color: #cdf;">
            <td width="10%" style="text-align:center;">ลำดับ</td>
            <td width="15%" style="text-align:center;">เลขที่ใบเคลม</td>
            <td width="25%" style="text-align:center;">วันที่รับเคลม / วันที่ส่งคืน</td>
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
                if ($result['Claim_Status'] == '1') {
                    $status = 'รอส่งเคลม';
                    $date_add_return = 'วันที่รับเคลม : ' . DateThai($result['Claim_Date_Add']) . ' <br>'
                            . 'วันที่ส่งคืนลูกค้า : - ';
                } else if ($result['Claim_Status'] == '2') {
                    $status = 'ส่งเคลม';
                    $date_add_return = 'วันที่รับเคลม : ' . DateThai($result['Claim_Date_Add']) . ' <br>'
                            . 'วันที่ส่งคืนลูกค้า : - ';
                } else if ($result['Claim_Status'] == '3') {
                    $status = 'รอส่งคืนลูกค้า';
                    $date_add_return = 'วันที่รับเคลม : ' . DateThai($result['Claim_Date_Add']) . ' <br>'
                            . 'วันที่ส่งคืนลูกค้า : - ';
                } else if ($result['Claim_Status'] == '4') {
                    $status = 'ส่งคืนเรียบร้อย';
                    $date_add_return = 'วันที่รับเคลม : ' . DateThai($result['Claim_Date_Add']) . ' <br>'
                            . 'วันที่ส่งคืนลูกค้า : ' . DateThai($result['Claim_Date_C_Return']);
                }
                if ($result['Claim_Type'] == 'forshop') {
                    $typec = "สินค้าเคลมของร้าน";
                } else if ($result['Claim_Type'] == 'forcus') {
                    $typec = "ของลูกค้า";
                }

                $c_id = $result['ClaimItem_ID'];
                $detail = 'ชื่อสินค้า : ' . $result['ClaimItem_Name'] . '<br>'
                        . 'S/N : ' . $result['S_ID'] . '<br>'
                        . 'อาการเสีย : ' . $result['Claim_Manner'] . '<br>'
                        . 'ประเภทการเคลม : ' . $typec . '<br>'
                        . 'ชื่อลูกค้า : ' . $result['Cus_Name'] . '<br>'
                        . 'ตัวแทนที่ส่งเคลม : ' . $result['Dealer_ID'];
                ?>
                <tr>
                    <td width="10%"><?= $num; ?></td>
                    <td width="15%"><?= $c_id; ?></td>
                    <td width="25%" style="text-align: left;"><?= $date_add_return; ?></td>                                                    
                    <td width="35%" style="text-align: left;"><?= $detail; ?></td>
                    <td width="15%"><?= $status; ?></td>
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
$mpdf->SetTitle('รายงานการรับเคลมสินค้า');
$mpdf->SetSubject('รายงานการรับเคลมสินค้า');
$mpdf->defaultfooterline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetAutoFont();
// $mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);

$mpdf->Output('ClaimReport.pdf', 'I');
$dbh = null;
?>