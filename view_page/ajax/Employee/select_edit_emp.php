<?php
include '../../../lib/connect.php';
$eid = $_GET['eid'];
$sql ='select * from t_employee where Emp_ID = "'.$eid.'"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $Ename = $result['Emp_Name'];
    $Ebd = $result['Emp_Birthday'];
    $Etel = $result['Emp_Tel'];
    $Eperson = $result['Emp_PersonalCode'];
    $Eaddress = $result['Emp_Address'];
    $gender = $result['Emp_Gender'];    
    $picname = $result['Emp_Img'];
}
$sex = '';
if($gender=='ชาย'){
    $sex ='<select class="form-control" id="edit_emp_gender" name="edit_emp_gender">
                <option selected="selected" value="ชาย">ชาย</option>
                <option value="หญิง">หญิง</option>
            </select>';
}else if($gender=='หญิง'){
    $sex ='<select class="form-control" id="edit_emp_gender" name="edit_emp_gender">
                <option value="ชาย">ชาย</option>
                <option selected="selected" value="หญิง">หญิง</option>
            </select>';    
}


echo '<tbody>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">รหัสพนักงาน : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;"><input type="text" class="form-control" id="edit_emp_id" name="edit_emp_id" value="'.$eid.'" readonly=""/></td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">ชื่อนามสกุล : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;"><input type="text" class="form-control" id="edit_emp_name" name="edit_emp_name" value="'.$Ename.'" required=""/></td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">เพศ : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;">'.$sex.'</td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">วัน/เดือน/ปีเกิด : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;"><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right datewar" id="datepicker" name="edit_emp_bd" value="'.$Ebd.'"></div></td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">เบอร์โทรศัพท์ : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;"><div class="input-group"><div class="input-group-addon"><i class="fa fa-phone"></i></div><input type="text" required="" id="edit_emp_tel" name="edit_emp_tel" class="form-control" data-inputmask="&quot;mask&quot;: &quot;999-999-9999&quot;" data-mask="" value="'.$Etel.'"></div></td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">รหัสบัตรประชาชน : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;"><input type="text" class="form-control" id="edit_emp_personal" name="edit_emp_personal" value="'.$Eperson.'" required="" /></td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">ที่อยู่ : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;"><textarea class="form-control" id="edit_emp_address" name="edit_emp_address" rows="4" required="">'.$Eaddress.'</textarea></td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">รูปภาพ : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;"><input type="file" class="form-control" id="file_emp" name="file_emp" accept="image/*"><input type="hidden" id="pic_name" name="pic_name" value="'.$picname.'" /> </td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="vertical-align: middle; text-align: right;">รีเซ็ตรหัสผ่าน : </td>
                                            <td width="40%" style="vertical-align: middle; text-align: left; font-weight: bold;"><button type="button" id="reset_pass" class="btn btn-danger"><span class="fa fa-refresh"></span> รีเซ็ต</button></td>
                                            <td width="30%" style="vertical-align: middle; text-align: right;"></td>
                                        </tr>
                                    </tbody>';
?>