<?php
session_start();
include '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';

//echo $_SESSION['Repair_ID'];
if (empty($_SESSION['Repair_ID_Bill'])) {
    header("location:../../view_page/M_Repair_History.php");
} else {
    $ir_id_session = $_SESSION['Repair_ID_Bill'];
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


//$sql_cus = 'SELECT * FROM t_repair tr JOIN t_customer tc ON tr.Customer_ID = tc.Customer_ID WHERE R_ID = "' . $r_id_session . '"';
$sql_cus = 'SELECT ReturnItem_Time,Customer_FullName,tri.Item_ID,Customer_Address,Repair_Total_Price FROM t_repair tr JOIN t_repair_item tri ON tr.R_ID = tri.R_ID '
        . 'JOIN t_customer tc ON tc.Customer_ID = tr.Customer_ID '
        . 'JOIN t_return_item trt ON trt.Ref_ID_Return = tri.Item_ID '
        . 'WHERE tri.Item_ID = "' . $ir_id_session . '"';
$stmt_cus = $dbh->prepare($sql_cus);
$stmt_cus->execute();
$result_cus = $stmt_cus->fetch();
$thai_date = DateThaiTime($result_cus['ReturnItem_Time']);
$totalPrice = number_format($result_cus['Repair_Total_Price']);
?>


<table border="0" repeat_header="1">
    <tbody>
        <tr>
            <td width="15%" class="font_1" style="font-weight: bold;">วันที่ : </td>
            <td width="30%" class="font_2" style="background-color: #dddddd;"><?= $thai_date ?></td>
            <td width="25%" class="font_1" style="font-weight: bold;">เลขที่สินค้าซ่อม : </td>
            <td width="30%" class="font_2" style="background-color: #dddddd;"><?= $result_cus['Item_ID']; ?></td>
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
$num = 1;
$sql_r = 'SELECT Service_Detail,Service_Menu,Service_Price,Repair_Warranty,Repair_EndWar FROM t_repair_item tri JOIN t_repair_case trc ON tri.Item_ID = trc.Item_ID '
        . 'WHERE tri.Item_ID = "' . $ir_id_session . '" AND trc.Ref_ID_Sell IS NULL';
$stmt_r = $dbh->prepare($sql_r);
$stmt_r->execute();
$rows_r = $stmt_r->rowCount();
?>
<table border="1" repeat_header="1" id="sellDetail" style="margin-top: 15px;">
    <tbody>
        <tr style="background-color: #dddddd;">
            <td width="10%" class="font_2 b3">ลำดับที่</td>
            <td width="30%" class="font_2 b3">รายการซ่อมสินค้า</td>
            <td width="40%" class="font_2 b3">รายละเอียด</td>
            <td width="20%" class="font_2 b3">ราคา</td>
        </tr>
        <?php
        if ($rows_r > 0) {
            while ($result_r = $stmt_r->fetch()) {
                $name = $result_r['Service_Menu'];
                $price = number_format($result_r['Service_Price']) . ' บาท';
                $mess = 'ระยะเวลาประกัน : ' . $result_r['Repair_Warranty'] . '<br> '
                        . 'รายละเอียดเพิ่มเติม : ' . $result_r['Service_Detail'];
                ?>        
                <tr style="margin: 10px;">
                    <td width="10%" class="font_4" style="margin: 5px;"><?= $num; ?></td>
                    <td width="30%" class="font_4" style="margin: 5px;"><?= $name; ?></td>
                    <td width="40%" class="font_4" style="text-align: left;"><?= $mess; ?></td>
                    <td width="20%" class="font_4" style="margin: 5px;"><?= $price; ?></td>
                </tr>
                <?php
                $num++;
            }
        }
        ?>
        <?php
        $sql_rs = 'SELECT Service_Detail,Service_Menu,Service_Price,Repair_Warranty,Repair_EndWar,Ref_ID_Sell,Warranty,End_Warranty_Shop,P_Name,S_ID '
                . 'FROM t_repair_item tri JOIN t_repair_case trc ON tri.Item_ID = trc.Item_ID '
                . 'JOIN t_sell_detail tsd ON tsd.ORD_ID = trc.Ref_ID_Sell '
                . 'WHERE tri.Item_ID = "' . $ir_id_session . '" AND trc.Ref_ID_Sell IS NOT NULL';
        $stmt_rs = $dbh->prepare($sql_rs);
        $stmt_rs->execute();
        $rows_rs = $stmt_rs->rowCount();
        if ($rows_rs > 0) {
            while ($result_rs = $stmt_rs->fetch()) {
                $ord_id = $result_rs['Ref_ID_Sell'];
                $name = $result_rs['Service_Menu'];
                $price = number_format($result_rs['Service_Price']) . ' บาท';
                $mess = 'ชื่อสินค้า : ' . $result_rs['P_Name'] . '<br>'
                        . 'S/N : '.$result_rs['S_ID'].'<br>'
                        . 'ระยะเวลาประกัน : ' . $result_rs['Warranty'] . '<br> ';
                ?>
                <tr style="margin: 10px;">
                    <td width="10%" class="font_4" style="margin: 5px;"><?= $num; ?></td>
                    <td width="30%" class="font_4" style="margin: 5px;"><?= $name; ?></td>
                    <td width="40%" class="font_4" style="text-align: left;"><?= $mess; ?></td>
                    <td width="20%" class="font_4" style="margin: 5px;"><?= $price; ?></td>
                </tr>
                <?php
                $num++;
            }
        }
$emp_id = $_SESSION['login_id'];
$sqle = 'SELECT * FROM t_employee WHERE Emp_ID = "'.$emp_id.'"';
$stmte = $dbh->prepare($sqle);
$stmte->execute();
$result_e = $stmte->fetch();
        ?>
        <tr style="background-color:#dddddd;">
            <td colspan="3" class="font_4 b3" style="text-align:right;">ผู้รับเงิน : <?=$result_e['Emp_Name'];?> (<?=$result_e['Emp_ID']?>)<label style="text-align: right"> ราคารวม :</label></td>
            <td width="20%" class="font_4 b3"><?= $totalPrice. ' บาท'; ?></td>
        </tr>
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

