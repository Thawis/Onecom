<?php
session_start();
include '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';
require_once '../../lib/convert_tel.php';
require_once '../../lib/convert_money.php';
if (empty($_SESSION['ord_id_bill'])) {
    header("location:../../view_page/M_Sell.php");
} else {
    $ord_id_session = $_SESSION['ord_id_bill'];
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
        . '<div style="text-align:center; font-size: 16px; font-family: Tahoma; font-weight:bold; margin-top:5px; background-color:#D0CAA7; height:35px;"><div style="margin-top:10px;">ใบเสร็จรับเงิน</div></div>';


$sql_cus = 'SELECT Customer_FullName,Customer_Address,ts.ORD_ID,ts.Date_Sell,Customer_Tel FROM t_sell ts JOIN t_customer tc ON ts.Customer_ID = tc.Customer_ID WHERE ts.ORD_ID = "' . $ord_id_session . '"';
$stmt_cus = $dbh->prepare($sql_cus);
$stmt_cus->execute();
$result_cus = $stmt_cus->fetch();
$thai_date = DateThaiTime($result_cus['Date_Sell']);
$tel_cus = getTel($result_cus['Customer_Tel']);
$cus_name_new = $result_cus['Customer_FullName'];
?>

<table border="0" repeat_header="1">
    <tbody>
        <tr>
            <td width="15%" class="font_1" style="font-weight: bold;">วันที่ : </td>
            <td width="30%" class="font_2" style="background-color: #dddddd;"><?= $thai_date ?></td>
            <td width="25%" class="font_1" style="font-weight: bold;">เลขที่ใบเสร็จรับเงิน : </td>
            <td width="30%" class="font_2" style="background-color: #dddddd;"><?= $result_cus['ORD_ID']; ?></td>
        </tr>
        <tr>
            <td width="15%" class="font_1" style="font-weight: bold;">เลขที่ : </td>
            <td width="30%" class="font_2" > - </td>
            <td width="25%" class="font_1" style="font-weight: bold;">เลขประจำตัวผู้เสียภาษี : </td>
            <td width="30%" class="font_2" > - </td>
        </tr>
        <tr>
            <td width="15%" class="font_1" style="font-weight: bold;">ชื่อลูกค้า : </td>
            <td width="30%" class="font_3" style="background-color: #dddddd;"><?= $result_cus['Customer_FullName']; ?></td>
            <td width="25%" class="font_1" style="font-weight: bold;">เบอร์โทรศัพท์ : </td>
            <td width="30%" class="font_3" style="background-color: #dddddd;"><?= $tel_cus; ?></td>
        </tr>
        <tr>
            <td width="15%" class="font_1" style="font-weight: bold;">ที่อยู่ : </td>
            <td width="85%" colspan="3" class="font_3"><?= $result_cus['Customer_Address']; ?></td>
        </tr>
    </tbody>
</table>

<?php
$sql_detail = 'SELECT ts.ORD_ID,P_Name,S_ID,Unit_ID,Warranty,P_Price,Total_Money,te.Emp_ID,te.Emp_Name '
        . 'FROM t_sell ts JOIN t_sell_detail tsd ON ts.ORD_ID = tsd.ORD_ID JOIN t_employee te ON te.Emp_ID = ts.Emp_ID WHERE ts.ORD_ID = "' . $ord_id_session . '"';
$stmt_detail = $dbh->prepare($sql_detail);
$stmt_detail->execute();
$num = 1;
$emp_id = "";
$emp_name = "";
$total = "";
?>
<table border="1" repeat_header="1" id="sellDetail" style="margin-top: 15px;">
    <tbody>
        <tr style="background-color: #dddddd;">
            <td width="10%" class="font_2 b3">ลำดับที่</td>
            <td width="30%" class="font_2 b3">ชื่อสินค้า</td>
            <td width="33%" class="font_2 b3">S/N</td>
            <td width="12%" class="font_2 b3">ประกัน</td>
            <td width="15%" class="font_2 b3">ราคา</td>
        </tr>
        <?php
        while ($result_detail = $stmt_detail->fetch()) {
            $emp_id = $result_detail['Emp_ID'];
            //$emp_name = $result_detail['Emp_Name'];
            $total = number_format($result_detail['Total_Money'], 2);
            $price = number_format($result_detail['P_Price'], 2);
            $pricethai = convert($total);
            $emp_name = $result_detail['Emp_Name'] . '( ' . $result_detail['Emp_ID'] . ' )';
            ?>        
            <tr style="margin: 5px;">
                <td width="10%" class="font_4" style="margin: 5px;"><?= $num; ?></td>
                <td width="30%" class="font_3" style="margin: 5px;"><?= $result_detail['P_Name']; ?></td>
                <td width="33%" class="font_4" style="text-align: left;"><?php echo 'S/N : ' . $result_detail['S_ID']; ?></td>
                <td width="12%" class="font_4" style="margin: 5px;"><?= $result_detail['Warranty']; ?></td>
                <td width="15%" class="font_1" style="margin: 5px;"><?= $price . ' บาท'; ?></td>
            </tr>
            <?php
            $num++;
        }
        ?>
        <tr style="background-color:#dddddd;">
            <td colspan="3" class="font_4 b3"><?= '( ' . $pricethai . ' )'; ?></td>
            <td width="12%" class="font_4 b3" style="text-align:right;">ราคารวม : </td>
            <td width="15%" class="font_1 b3"><?= $total . ' บาท'; ?></td>
        </tr>
        <tr>
            <td colspan="5" style="height: 75px;" class="font_4">หมายเหตุ :: อุปกรณ์ชำรุด แตก หัก บุบ ไหม้ บิ่น งอ เบี้ยว ร้าว หล่น ทะลุ มีรอยขูดขีดที่แผงวงจร <br> อุปกรณ์บางส่วนหลุดหายไป เช่น จอ, Body เครื่อง, ปุ่มกดต่าง ๆ ถือว่า สิ้นสุดการรับประกัน **</td>
        </tr>
        <tr>
            <td colspan="2" style="height: 95px;" class="font_4">
                ................................................... <br>
                ผู้รับเงิน :  <?= $emp_name; ?>
            </td>
            <td colspan="3" style="height: 95px;" class="font_4">
                .................................................................. <br>
                ผู้รับสินค้า : (.............................................)

            </td>
        </tr>

    </tbody>
</table>
<!--<p class="font_4" style="text-align: left; color: red; font-size: 8px">หมายเหตุ :: อุปกรณ์ชำรุด แตก หัก บุบ ไหม้ บิ่น งอ เบี้ยว ร้าว หล่น ทะลุ มีรอยขูดขีดที่แผงวงจร อุปกรณ์บางส่วนหลุดหายไป เช่น จอ, Body เครื่อง, ปุ่มกดต่าง ๆ ถือว่า สิ้นสุดการรับประกัน **</p>-->
<!--                <tr style="background-color:#dddddd;">
    <td colspan="2" class="font_4 b3" style="text-align:right;">ผู้รับเงิน : </td>
    <td width="35%" class="font_4 b3"></td>
    <td width="15%" class="font_4 b3" style="text-align:right;">ราคารวม : </td>
    <td width="20%" class="font_4 b3"></td>
</tr>-->
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
$mpdf->SetTitle('ใบเสร็จรับเงิน');
$mpdf->SetSubject('ใบเสร็จรับเงิน');
$mpdf->defaultfooterline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetAutoFont();
// $mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);

$mpdf->Output('bill.pdf', 'I');
$dbh = null;
?>