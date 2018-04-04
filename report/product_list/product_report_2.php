<?php
session_start();
require_once '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';

$group = $_SESSION['r_product_group'];
$sub = $_SESSION['r_product_sub'];

ob_start();
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");
$datethai = DateThai($today);
$num = 1;

if ($group != "All") {
    $sql_g = 'SELECT G_Name From t_group_product WHERE G_ID = "' . $group . '"';
    $stmt_g = $dbh->prepare($sql_g);
    $stmt_g->execute();
    $result_g = $stmt_g->fetch();
    $g_type = $result_g['G_Name'];
} else if ($group == "All") {
    $g_type = "ทั้งหมด";
}

if ($sub != "All") {
    $sql_s = 'SELECT SG_Name From t_sub_group_product WHERE SG_ID = "' . $sub . '"';
    $stmt_s = $dbh->prepare($sql_s);
    $stmt_s->execute();
    $result_s = $stmt_s->fetch();
    $s_type = $result_s['SG_Name'];
} else if ($sub == "All") {
    $s_type = "ทั้งหมด";
}


$header = '<div style="text-align:center"><img src="../../img/onelogo.png" alt="" width="100px"></div>'
        . '<div style="text-align:center"><h3>ร้าน OneComputer</h3></div>'
        . '<table border="0"><tr><td align="left">รายงานสินค้า ประเภทหลัก : ' . $g_type . ' ประเภทรอง : ' . $s_type . '</td><td align="right">ออกรายงาน ณ วันที่ : ' . $datethai . ' </td></tr></table>';

$sql = '';
if ($group == "All") {
    if ($sub == "All") {
        $sql = 'SELECT G_Name,SG_Name,P_Name,P_Price,P_Status,P_ID FROM t_group_product tg JOIN t_sub_group_product tsgp ON  tg.G_ID = tsgp.G_ID JOIN t_product tp ON tp.SG_ID = tsgp.SG_ID';
    } else {
        $sql = 'SELECT G_Name,SG_Name,P_Name,P_Price,P_Status,P_ID FROM t_group_product tg JOIN t_sub_group_product tsgp ON  tg.G_ID = tsgp.G_ID JOIN t_product tp ON tp.SG_ID = tsgp.SG_ID '
                . 'WHERE tsgp.SG_ID = "' . $sub . '"';
    }
} else if ($group != "All") {
    if ($sub == "All") {
        $sql = 'SELECT G_Name,SG_Name,P_Name,P_Price,P_Status,P_ID FROM t_group_product tg JOIN t_sub_group_product tsgp ON  tg.G_ID = tsgp.G_ID JOIN t_product tp ON tp.SG_ID = tsgp.SG_ID '
                . 'WHERE tg.G_ID = "' . $group . '"';
    } else if ($sub != "All") {
        $sql = 'SELECT G_Name,SG_Name,P_Name,P_Price,P_Status,P_ID FROM t_group_product tg JOIN t_sub_group_product tsgp ON  tg.G_ID = tsgp.G_ID JOIN t_product tp ON tp.SG_ID = tsgp.SG_ID '
                . 'WHERE tg.G_ID = "' . $group . '" AND tsgp.SG_ID = "' . $sub . '"';
    }
}
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
?>
<table border="1" repeat_header="1">
    <thead>
        <tr>
            <th width="10%">ลำดับ</th>
            <th width="10%">รหัสสินค้า</th>
            <th width="25%">ชื่อสินค้า</th>
            <th width="25%">ประเภทสินค้า</th>
            <th width="10%">ราคา</th>
            <th width="10%">สถานะ</th>
            <th width="10%">คงเหลือ</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($rows == 0) { ?>
            <tr>
                <td colspan="7" width="100%" class="small_font_c">ไม่พบข้อมูล</td>
            </tr>
            <?php
        } else if ($rows > 0) {
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $sql_u = 'SELECT * FROM t_product tp JOIN t_product_unit tpu ON tp.P_ID = tpu.P_ID '
                        . 'WHERE tp.P_ID = "' . $result['P_ID'] . '" AND tpu.PU_Status = "1"';
                $stmt_u = $dbh->prepare($sql_u);
                $stmt_u->execute();
                $row_u = $stmt_u->rowCount();
                if ($result['P_Status'] == "1") {
                    $status = 'ปกติ';
                } else {
                    $status = 'ยกเลิก';
                }
                $type = 'ประเภทหลัก : ' . $result['G_Name'] . '<br> ประเภทรอง : ' . $result['SG_Name'];
                $price = number_format($result['P_Price']) . ' บาท';
                ?>
                <tr>
                    <td width="10%" class="small_font_c"><?= $num; ?></td>
                    <td width="10%" class="small_font_c"><?= $result['P_ID']; ?></td>
                    <td width="20%" class="small_font_l"><?= $result['P_Name']; ?></td>
                    <td width="25%" class="small_font_l"><?= $type; ?></td>
                    <td width="15%" class="small_font_r"><?= $price; ?></td>
                    <td width="10%" class="small_font_c"><?= $status; ?></td>
                    <td width="10%" class="small_font_c"><?= $row_u; ?></td>
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