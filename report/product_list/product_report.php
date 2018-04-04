<?php
session_start();
require_once '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';
ob_start();
//$ORD_ID = $_SESSION['ord_id_bill'];
//echo $ORD_ID;
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");
$datethai = DateThai($today);
$num = 1;
$header = '<div style="text-align:center"><img src="../../img/onelogo.png" alt="" width="100px"></div>'
        . '<div style="text-align:center"><h3>ร้าน OneComputer</h3></div>'
        . '<table border="0"><tr><td align="left">รายงานรายการสินค้าทั้งหมด</td><td align="right">ประจำวันที่ ' . $datethai . ' </td></tr></table>';
$sql = "select * from t_product ORDER BY P_Number";
$stmt = $dbh->prepare($sql);
$stmt->execute();
?>
<table border="1" repeat_header="1">
    <thead>
        <tr>
            <th width="10%">ลำดับ</th>
            <th width="15%">รหัสสินค้า</th>
            <th width="50%">ชื่อสินค้า</th>
            <th width="15%">ราคา</th>
            <th width="10%">สถานะ</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td width="10%"><?= $num; ?></td>
                <td width="15%"><?= $result['P_ID'] ?></td>
                <td width="50%"><?= $result['P_Name'] ?></td>
                <td width="15%"><?= $result['P_Price'] ?></td>
                <td width="10%"><?= $result['P_Status'] ?></td>
            </tr>
            <?php
            $num++;
        }
        ?>
    </tbody>
</table>



<?php
//$html = ob_get_contents();        //เก็บค่า html ไว้ใน $html 
//ob_end_clean();
//$pdf = new mPDF('th', 'A4', '0', '');   //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
//$pdf->SetHTMLHeader($header);
//$pdf->SetTitle('ใบเสร็จรับเงิน');
//$pdf->SetSubject('ใบเสร็จรับเงิน2');
//$pdf->SetAutoFont();
////$pdf->SetDisplayMode('fullpage');
//$pdf->WriteHTML($html, 2);
//$pdf->Output("mpdf/mypdf1.pdf", "I");         // เก็บไฟล์ html ที่แปลงแล้วไว้ใน MyPDF/MyPDF.pdf ถ้าต้องการให้แสด
$html = ob_get_contents();
$stylesheet = file_get_contents('style.css');
ob_end_clean();
$mpdf = new mPDF('th', 'A4', '0', '', '20', '20', '48', '15'); //A4-L
// header.
$mpdf->defaultheaderfontsize = 10; /* in pts */
$mpdf->defaultheaderfontstyle = null; /* blank, B, I, or BI */
$mpdf->defaultheaderline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetHTMLHeader($header);
$mpdf->SetFooter('{PAGENO} / {nb}');
$mpdf->SetTitle('รายงานรายการสินค้า');
$mpdf->SetSubject('รายงานรายการสินค้า');
$mpdf->defaultfooterline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetAutoFont();
// $mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);

$mpdf->Output('menuReport.pdf', 'I');
$dbh = null;
?>