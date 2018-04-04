<?php
session_start();
include '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';

//echo $_SESSION['Repair_ID'];
if (empty($_SESSION['Repair_ID'])) {
    header("location:../../view_page/M_Repair.php");
} else {
    $r_id_session = $_SESSION['Repair_ID'];
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
        . '<div style="text-align:center; font-size: 16px; font-family: Tahoma; font-weight:bold; margin-top:5px; background-color:#FF8700; height:35px;"><div style="margin-top:10px;">ใบรับซ่อมสินค้า</div></div>';


$sql_cus = 'SELECT * FROM t_repair tr JOIN t_customer tc ON tr.Customer_ID = tc.Customer_ID WHERE R_ID = "' . $r_id_session . '"';
$stmt_cus = $dbh->prepare($sql_cus);
$stmt_cus->execute();
$result_cus = $stmt_cus->fetch();
$thai_date = DateThaiTime($result_cus['R_DATE']);
?>


<table border="0" repeat_header="1">
    <tbody>
        <tr>
            <td width="15%" class="font_1" style="font-weight: bold;">วันที่ : </td>
            <td width="30%" class="font_2" style="background-color: #dddddd;"><?= $thai_date ?></td>
            <td width="25%" class="font_1" style="font-weight: bold;">เลขที่ใบรับซ่อม : </td>
            <td width="30%" class="font_2" style="background-color: #dddddd;"><?= $result_cus['R_ID']; ?></td>
        </tr>
        <tr>
            <td width="15%" class="font_1" style="font-weight: bold;">ชื่อลูกค้า : </td>
            <td width="30%" class="font_2"><?= $result_cus['Customer_FullName']; ?></td>
            <td width="25%" class="font_1" style="font-weight: bold;"></td>
            <td width="30%" class="font_2"></td>
        </tr>
        <tr>
            <td width="15%" class="font_1" style="font-weight: bold;">ที่อยู่ : </td>
            <td width="85%" colspan="3" class="font_3" style="background-color: #dddddd;"><?= $result_cus['Customer_Address']; ?></td>
        </tr>
    </tbody>
</table>

<?php
$sql_detail = 'SELECT * FROM t_repair tr JOIN t_repair_item tri ON tr.R_ID = tri.R_ID WHERE tr.R_ID = "' . $r_id_session . '"';
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
            <td width="35%" class="font_2 b3">ชื่อสินค้า</td>
            <td width="55%" class="font_2 b3">รายละเอียด</td>
        </tr>
        <?php
        while ($result_detail = $stmt_detail->fetch()) {
            $mess = "เลขที่สินค้าซ่อม : " . $result_detail['Item_ID'] . "<br>"
                    . "อาการเสีย & สิ่งที่ให้ทำ : " . $result_detail['Item_manner'] . "<br>"
                    . "ประเภทสินค้า : " . $result_detail['Type_Item'] . "<br>"
                    . "S/N สินค้า (ถ้ามี) : " . $result_detail['Item_SN'];
            $name = $result_detail['Item_Name'];
            ?>        
            <tr style="margin: 10px;">
                <td width="10%" class="font_4" style="margin: 5px;"><?= $num; ?></td>
                <td width="35%" class="font_4" style="margin: 5px;"><?= $name; ?></td>
                <td width="55%" colspan="3" class="font_4" style="text-align: left;"><?= $mess; ?></td>
            </tr>
            <?php
            $num++;
        }
        ?>
    </tbody>
</table>

<p class="font_4" style="text-align: left; color: red; font-size: 8px">หมายเหตุ :: ทางร้านข้อสงวนสิทธิ์ การรักษาข้อมูลของลูกค้า หากมีกรณีข้อมูลสูญหาย โปรดเก็บข้อมูลสำคัญไว้ใน Drive:D เป็นต้น**</p>
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
$mpdf->SetTitle('ใบรับซ่อมสินค้า');
$mpdf->SetSubject('ใบรับซ่อมสินค้า');
$mpdf->defaultfooterline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetAutoFont();
// $mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);

$mpdf->Output('bill.pdf', 'I');
$dbh = null;
?>

