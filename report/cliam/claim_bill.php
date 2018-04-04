<?php
session_start();
include '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';
if (empty($_SESSION['Claim_ID'])) {
    header("location:../../view_page/M_Claim.php");
} else {
    $c_id_session = $_SESSION['Claim_ID'];
}
ob_start();

$sql_head = "SELECT * FROM t_shop";
$stmt_head = $dbh->prepare($sql_head);
$stmt_head->execute();
$result_head = $stmt_head->fetch();
$header = '<div style="text-align:center"><img src="../../img/shop/' . $result_head['Shop_Img'] . '" style="width:210px; height:110px;"></div>'
        . '<div style="text-align:center; font-size: 16px; font-family: Tahoma; font-weight: bold; margin-top:5px;">' . $result_head['Shop_Name'] . '</div>'
        . '<div style="text-align:center; font-size: 14px; font-family: Tahoma; font-weight: bold; margin-top:5px;">' . $result_head['Shop_Address'] . '</div>'
        . '<div style="text-align:center; font-size: 14px; font-family: Tahoma; font-weight: bold; margin-top:5px;">Tel. ' . $result_head['Shop_Tel'] . '</div>'
        . '<div style="text-align:center; font-size: 16px; font-family: Tahoma; font-weight:bold; margin-top:5px; background-color:#6BE6F4; height:35px;"><div style="margin-top:10px;">ใบรับเคลมสินค้า</div></div>';

$sql = 'SELECT * FROM t_claim WHERE ClaimItem_ID = "' . $c_id_session . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();

$thai_date = DateThai($result['Claim_Date_Add']);
$tel = getTel($result['Cus_Tel']);
?>
<table border="0" repeat_header="1">
    <tbody>
        <tr>
            <td width="20%" class="font_1" style="font-weight: bold;">วันที่รับเคลม : </td>
            <td width="25%" class="font_2" style="background-color: #dddddd;"><?= $thai_date ?></td>
            <td width="25%" class="font_1" style="font-weight: bold;">เลขที่ใบเคลมสินค้า : </td>
            <td width="30%" class="font_2" style="background-color: #dddddd;"><?= $result['ClaimItem_ID']; ?></td>
        </tr>
        <tr>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td width="20%" class="font_1" style="font-weight: bold;">ชื่อสินค้า : </td>
            <td width="25%" class="font_2" style="background-color: #dddddd;"><?= $result['ClaimItem_Name']; ?></td>
            <td width="25%" class="font_1" style="font-weight: bold;">SerialNumber : </td>
            <td width="30%" class="font_2" style="background-color: #dddddd;"><?= $result['S_ID']; ?></td>
        </tr>
        <tr>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td width="20%" class="font_1" style="font-weight: bold;">ชื่อผู้เคลมสินค้า : </td>
            <td width="25%" class="font_2" style="background-color: #dddddd;"><?= $result['Cus_Name']; ?></td>
            <td width="25%" class="font_1" style="font-weight: bold;">เบอร์ติดต่อ</td>
            <td width="30%" class="font_2" style="background-color: #dddddd;"><?= $tel; ?></td>
        </tr>
        <tr>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td width="20%" class="font_1" style="font-weight: bold;">อาการเสีย : </td>
            <td width="75%" colspan="3" class="font_3" style="background-color: #dddddd;"><?= $result['Claim_Manner']; ?></td>
        </tr>
    </tbody>
</table>
<p class="font_4" style="text-align: center; color: red; font-size: 8px">หมายเหตุ :: โปรดเก็บแสดงเอกสารใบรับเคลมนี้ เมื่อมารับสินค้าเคลม **</p>
<?php
$html = ob_get_contents();
$stylesheet = file_get_contents('style.css');
ob_end_clean();
$mpdf = new mPDF('th', 'A4', '0', 'Tahoma', '20', '20', '75', '15'); //A4-L
// header.
$mpdf->defaultheaderfontsize = 10; /* in pts */
$mpdf->defaultheaderfontstyle = null; /* blank, B, I, or BI */
$mpdf->defaultheaderline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetHTMLHeader($header);
$mpdf->SetFooter('{PAGENO} / {nb}');
$mpdf->SetTitle('ใบรับเคลสินค้า');
$mpdf->SetSubject('ใบรับเคลมสินค้า');
$mpdf->defaultfooterline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetAutoFont();
// $mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);

$mpdf->Output('bill.pdf', 'I');
$dbh = null;

function getTel($tel) {
    $f1 = substr($tel, 0, 3) . '-';
    $f2 = substr($tel, 3, 3) . '-';
    $f3 = substr($tel, 6, 4);
    return $f1 . $f2 . $f3;
}

;
?>