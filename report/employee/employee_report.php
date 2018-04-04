<?php
session_start();
require_once '../../lib/connect.php';
require_once '../../lib/getDate_TH.php';
require_once '../../mpdf/mpdf.php';
$type = $_SESSION['R_emp_type'];
$status = $_SESSION['R_emp_status'];
ob_start();
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$today = $dt->format("Y-m-d");
$datethai = DateThai($today);
$num = 1;

if ($type == 'All') {
    $r_type = 'ทุกตำแหน่ง';
} else if ($type != 'All') {
    if ($type == 'admin') {
        $r_type = 'หัวหน้าช่าง';
    } else if ($type == 'user') {
        $r_type = 'ช่างซ่อมทั่วไป';
    }
}

if ($status == 'All') {
    $r_status = 'ทุกสถานะ';
} else if ($status == '1') {
    $r_status = 'ปกติ';
} else if ($status == '0') {
    $r_status = 'ยกเลิก';
}

$header = '<div style="text-align:center"><img src="../../img/onelogo.png" alt="" width="100px"></div>'
        . '<div style="text-align:center"><h3>ร้าน OneComputer</h3></div>'
        . '<table border="0"><tr><td align="left">รายงานข้อมูลรายชื่อพนักงาน ตำแหน่ง : ' . $r_type . ' สถานะ : ' . $r_status . '</td><td align="right">ออกรายงาน ณ วันที่ : ' . $datethai . ' </td></tr></table>';

$sql = '';
$num = 1;
if ($type == "All") {
    if ($status == "All") {
        $sql = 'SELECT * FROM t_employee';
    } else {
        $sql = 'SELECT * FROM t_employee WHERE Emp_Status = "' . $status . '"';
    }
} else if ($type != "All") {
    if ($status == "All") {
        $sql = 'SELECT * FROM t_employee WHERE Emp_Type = "' . $type . '"';
    } else {
        $sql = 'SELECT * FROM t_employee WHERE Emp_Status = "' . $status . '" AND Emp_Type = "' . $type . '"';
    }
}
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->rowCount();
?>
<table border="1" repeat_header="1">
    <thead>
        <tr>
            <th width="10%" style="text-align:center;">ลำดับ</th>
            <th width="15%" style="text-align:center;">รหัสพนักงาน</th>
            <th width="25%" style="text-align:center;">ชื่อ-นามสกุล</th>                                                    
            <th width="15%" style="text-align:center;">เพศ</th>
            <th width="20%" style="text-align:center;">ตำแหน่ง</th>
            <th width="15%" style="text-align:center;">สถานะ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($rows == 0) {
            ?>
            <tr>
                <td colspan="6" class="font_2">ไม่พบข้อมูล</td>
            </tr>
            <?php
        } else {
            while ($result = $stmt->fetch()) {
                if ($result['Emp_Type'] == "root") {
                    $userType = 'เจ้าของร้าน';
                } else if ($result['Emp_Type'] == "admin") {
                    $userType = 'หัวหน้าช่าง';
                } else if ($result['Emp_Type'] == "user") {
                    $userType = 'ช่างซ่อมทั่วไป';
                }

                if ($result['Emp_Status'] == '1') {
                    $userStatus = 'ปกติ';
                } else {
                    $userStatus = 'ยกเลิก';
                }
                ?>
                <tr>
                    <td width="10%" class="font_2"><?= $num; ?></td>
                    <td width="15%" class="font_2"><?= $result['Emp_ID']; ?></td>
                    <td width="25%" class="font_3"><?= $result['Emp_Name']; ?></td>
                    <td width="15%" class="font_2"><?= $result['Emp_Gender']; ?></td>
                    <td width="20%" class="font_2"><?= $userType; ?></td>
                    <td width="15%" class="font_2"><?= $userStatus; ?></td>
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
$mpdf->SetTitle('รายงานข้อมูลรายชื่อพนักงาน');
$mpdf->SetSubject('รายงานข้อมูลรายชื่อพนักงาน');
$mpdf->defaultfooterline = 0;    /* 1 to include line below header/above footer */
$mpdf->SetAutoFont();
// $mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);

$mpdf->Output('EmployeeReport.pdf', 'I');
$dbh = null;
?>