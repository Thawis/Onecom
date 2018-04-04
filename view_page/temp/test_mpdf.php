<?php

session_start();
require_once '../lib/connect.php';
require_once '../lib/getDate_TH.php';
require_once 'mpdf/mpdf.php';
//$ORD_ID = $_SESSION['ord_id_bill'];
//echo $ORD_ID;
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");
$datethai = DateThai($today);
$header = '<table border="1">
	<tr>
		<td align="left">รายงานรายการสินค้าทั้งหมด</td>
		<td align="right">ประจำวันที่ ' . $datethai . ' </td>
	</tr>
</table>';


$html = ob_get_contents();        //เก็บค่า html ไว้ใน $html 
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', '');   //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetHTMLHeader($header);
$pdf->SetTitle('ใบเสร็จรับเงิน');
$pdf->SetSubject('ใบเสร็จรับเงิน2');
$pdf->SetAutoFont();
//$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output("mpdf/mypdf1.pdf", "I");         // เก็บไฟล์ html ที่แปลงแล้วไว้ใน MyPDF/MyPDF.pdf ถ้าต้องการให้แสด
?>