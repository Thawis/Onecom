<?php

include '../../../lib/connect.php';
require_once '../../../lib/getDate_TH.php';
require_once '../../../lib/convert_tel.php';
$eid = $_GET['eid'];
$sql = 'SELECT * FROM t_employee WHERE Emp_ID ="' . $eid . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();

while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $Pic = $result["Emp_Img"];
    $Emp_id = $result["Emp_ID"];
    $Ename = $result["Emp_Name"];
    $Birthday = DateThai($result["Emp_Birthday"]);
    $Address = $result["Emp_Address"];
    $Tel = getTel($result["Emp_Tel"]);
    $Personal = $result["Emp_PersonalCode"];
    $Sex = $result["Emp_Gender"];
    $position = $result['Emp_Type'];
    if ($position == 'admin') {
        $type = '<span class="label bg-blue-gradient" style="width:100px; font-size:14px; font-family:Tahoma;">หัวหน้าช่าง</span>';
    } else if ($position == 'root') {
        $type = '<span class="label bg-green-gradient" style="width:100px; font-size:14px; font-family:Tahoma;">เจ้าของร้าน</span>';
    } else {
        $type = '<span class="label bg-yellow-gradient" style="width:100px; font-size:14px; font-family:Tahoma;">ช่างซ่อมทั่วไป</span>';
    }
}

if ($Pic != null) {
    $Epic = '../img/employee/' . $Pic;
} else {
    $Epic = "../img/employee/noimg.png";
}
echo '                          <tbody>
                                    <tr>
                                        <td width="30%" rowspan="8" style="vertical-align: middle; text-align: center;">
                                            <img src="' . $Epic . '" alt="" class="img-thumbnail" style="width:200px; height:260px;" />
                                        </td>
                                        <td width="20%" style="vertical-align: middle; text-align: right; font-weight: bold;">รหัสพนักงาน : </td>
                                        <td width="35%" style="vertical-align: middle; text-align: left;"><label class="label bg-aqua-gradient" style="font-size:14px; font-family:Tahoma;">' . $Emp_id . '</td>
                                        <td width="15%" style="vertical-align: middle; text-align: right;"></td>
                                    </tr>

                                    <tr>
                                        <td width="20%" style="vertical-align: middle; text-align: right; font-weight: bold;">ชื่อ-นามสกุล : </td>
                                        <td width="35%" style="vertical-align: middle; text-align: left;">' . $Ename . '</td>
                                        <td width="15%" style="vertical-align: middle; text-align: right;"></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="vertical-align: middle; text-align: right; font-weight: bold;">ตำแหน่ง : </td>
                                        <td width="35%" style="vertical-align: middle; text-align: left;">' . $type . '</td>
                                        <td width="15%" style="vertical-align: middle; text-align: right;"></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="vertical-align: middle; text-align: right; font-weight: bold;">เพศ : </td>
                                        <td width="35%" style="vertical-align: middle; text-align: left;">' . $Sex . '</td>
                                        <td width="15%" style="vertical-align: middle; text-align: right;"></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="vertical-align: middle; text-align: right; font-weight: bold;">วันเกิด : </td>
                                        <td width="35%" style="vertical-align: middle; text-align: left;">' . $Birthday . '</td>
                                        <td width="15%" style="vertical-align: middle; text-align: right;"></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="vertical-align: middle; text-align: right; font-weight: bold;">รหัสบัตรประชาชน : </td>
                                        <td width="35%" style="vertical-align: middle; text-align: left;">' . $Personal . '</td>
                                        <td width="15%" style="vertical-align: middle; text-align: right;"></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="vertical-align: middle; text-align: right; font-weight: bold;">เบอร์โทรศัพท์ : </td>
                                        <td width="35%" style="vertical-align: middle; text-align: left;">' . $Tel . '</td>
                                        <td width="15%" style="vertical-align: middle; text-align: right;"></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="vertical-align: middle; text-align: right; font-weight: bold;">ที่อยู่ : </td>
                                        <td width="50%" colspan="2" style="vertical-align: middle; text-align: left;">' . $Address . '</td>
                                    </tr>
                                </tbody>'
?>