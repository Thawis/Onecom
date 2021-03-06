<?php
include '../lib/connect.php';
include '../lib/check_login.php';
$emp_id = $_SESSION['login_id'];
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme Style-->
        <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome -->
        <link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Ionicons -->
        <link href="../plugins/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
        <!-- Skin-->
        <link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"/>
        <!-- DataTable -->
        <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
        <!-- daterange picker -->
        <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
        <title>เพิ่มข้อมูลพนักงาน</title>
        <style>
            .dataTables_filter{
                display: none;
            }
            #table_add td{
                vertical-align: middle;
                font-style: normal;
                font-family: Tahoma;
                font-size: 16px; 
                /*text-align: center;*/
            }
        </style>
    </head>
    <?php
    include '../lib/header_navbar.php';
    include '../lib/main_sidebar.php';
    ?>
    <!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                <span class="fa fa-pencil"></span> แก้ไขข้อมูลส่วนตัว
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>ตั้งค่าระบบ</li>
                <li class="active">เพิ่มข้อมูลพนักงาน</li>
            </ol>
        </section>
        <section class="content" style="height:1080px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header bg-yellow-gradient">
                            <h3 class="box-title" style="font-style: normal; font-size: 19px;"><span class="fa fa-pencil"></span> แก้ไขข้อมูลส่วนตัว</h3>
                        </div>
                        <div class="box-body">
                            <form class="form-horizontal" id="form-addemp">
                                <input type="hidden" id="emp_id_h" name="emp_id_h" value="<?= $emp_id; ?>"/>
                                <input type="hidden" id="emp_pic_h" name="emp_pic_h" value=""/>
                                <table class="table table-responsive table-hover" id="table_add">
                                    <tr style="vertical-align:middle;">
                                        <td style="width:30%; text-align: right; vertical-align:middle;">เปลี่ยนรหัสผ่าน : </td>
                                        <td style="width:40%; vertical-align:middle;">
                                            <button type="button" class="btn bg-yellow-gradient" id="Change_Pass"><span class="fa fa-pencil-square"></span> เปลี่ยนรหัสผ่าน</button>                
                                        </td>
                                        <td style="width:30%;"></td>
                                    </tr>
                                    <tr style="vertical-align:middle;">
                                        <td style="width:30%; text-align: right; vertical-align:middle;">รูปภาพ : </td>
                                        <td style="width:40%; vertical-align:middle;">
                                            <input type="file" class="form-control" id="file_emp" name="file_emp" accept="image/*">                 
                                        </td>
                                        <td style="width:30%;"></td>
                                    </tr>
                                    <tr style="vertical-align:middle;">
                                        <td style="width:30%; text-align: right; vertical-align:middle;">EmpID : </td>
                                        <td style="width:40%; vertical-align:middle;">
                                            <input type="text" class="form-control" id="emp_id" name="emp_id" value="" required="" readonly>                  
                                        </td>
                                        <td style="width:30%;"></td>
                                    </tr>
                                    <tr style="vertical-align:middle;">
                                        <td style="width:30%; text-align: right; vertical-align:middle;">ชื่อ-นามสกุล : </td>
                                        <td style="width:40%; vertical-align:middle;">
                                            <input type="text" class="form-control" id="emp_name" name="emp_name" required>             
                                        </td>
                                        <td style="width:30%;"></td>
                                    </tr>
                                    <tr style="vertical-align:middle;">
                                        <td style="width:30%; text-align: right; vertical-align:middle;">เพศ : </td>
                                        <td style="width:40%; vertical-align:middle;">
                                            <select class="form-control" id="emp_gender" name="emp_gender">
                                                <option selected value="ชาย">ชาย</option>
                                                <option value="หญิง">หญิง</option>
                                            </select>            
                                        </td>
                                        <td style="width:30%;"></td>
                                    </tr>
                                    <tr style="vertical-align:middle;">
                                        <td style="width:30%; text-align: right; vertical-align:middle;">วันเกิด : </td>
                                        <td style="width:40%; vertical-align:middle;">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" required>
                                            </div>         
                                        </td>
                                        <td style="width:30%;"></td>
                                    </tr>
                                    <tr style="vertical-align:middle;">
                                        <td style="width:30%; text-align: right; vertical-align:middle;">ที่อยู่ : </td>
                                        <td style="width:40%; vertical-align:middle;">
                                            <textarea class="form-control" id="emp_address" name="emp_address" rows="3" required ></textarea>
                                        </td>
                                        <td style="width:30%;"></td>
                                    </tr>
                                    <tr style="vertical-align:middle;">
                                        <td style="width:30%; text-align: right; vertical-align:middle;">เบอร์โทรศัพท์ : </td>
                                        <td style="width:40%; vertical-align:middle;">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                                <input type="text" class="form-control" id="emp_tel" name="emp_tel" data-inputmask='"mask": "999-999-9999"' data-mask required>
                                            </div>
                                        </td>
                                        <td style="width:30%;"></td>
                                    </tr>
                                    <tr style="vertical-align:middle;">
                                        <td colspan="3" style="vertical-align:middle; text-align: center;">
                                            <button type="submit" class="btn bg-yellow-gradient">แก้ไขข้อมูล</button>
                                            <button type="button" class="btn bg-red-gradient" id="btn_clear">ยกเลิก</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div> 
    <!-- /.content -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>OneComputer Shop</strong>
    </footer>
    <!-- Send -->
    <div class="modal fade" id="ModalPass" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-yellow-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-cog"></span> แก้ไขรหัสผ่าน</h4>
                </div>
                <form class="form-horizontal" id="form_repass">
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover no-border" id="">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle; text-align: right;"> รหัสผ่านใหม่ : </td>
                                            <td width="60%"><input type="password" id="pass_1" name="pass_1" pattern="[A-Za-z0-9]{4,}" class="form-control" value="" required="" placeholder="กรุณากรอก password ตั้งแต่ 4 ตัวอักษรขึ้นไป"/></td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle; text-align: right;"> ยืนยันรหัสผ่าน : </td>
                                            <td width="60%"><input type="password" id="pass_2" name="pass_2" pattern="[A-Za-z0-9]{4,}" class="form-control" value="" required="" placeholder="กรุณากรอก password ตั้งแต่ 4 ตัวอักษรขึ้นไป"/></td>
                                            <td width="10%"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-yellow-gradient">แก้ไขรหัสผ่าน</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>    
    <!-- /.content-wrapper -->
    <!-- Bootstrap 3.3.6 -->
    <script src="../plugins/jQuery/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!--<script src="../plugins/fastclick/fastclick.js" type="text/javascript"></script>-->
    <!-- InputMask -->
    <script src="../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="../plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    <script src="../dist/js/demo.js" type="text/javascript"></script>      
    <script src="../plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="script/global.js" type="text/javascript"></script>
    <script src="../plugins/datepicker/locales/bootstrap-datepicker.th.js" type="text/javascript"></script>
    <script>
        $(function () {
            loadData();
            $('#datepicker').datepicker({
                language: "th",
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $("[data-mask]").inputmask();
            $('#form-addemp').on('submit', function (event) {
                event.preventDefault();
                var data = new FormData(this);
                var r = confirm("ยืนยันการแก้ไขข้อมูล");
                if (r === true) {
                    $.ajax({
                        url: 'ajax/profile/edit_profile.php',
                        type: 'post',
                        data: data,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            alert(data);
                            location.reload();
                        }
                    });
                }
            });
            $('#form_repass').on('submit', function (e) {
                e.preventDefault();
                var p1 = $('#pass_1').val();
                var p2 = $('#pass_2').val();
                var eid = $('#emp_id_h').val();
                if (p1 === p2) {
                    var r = confirm("ยืนยันการแก้ไขรหัสผ่าน");
                    if (r === true) {
                        $.ajax({
                            url: "ajax/profile/update_password.php",
                            type: "post",
                            data: {pass: p1, eid: eid},
                            success: function (rs) {
                                console.log(rs);
                                if(rs==="ok"){
                                    alert("แก้ไขรหัสผ่านเรียบร้อย");
                                    $('#ModalPass').modal('hide');
                                }else{
                                    alert("ไม่สามารถแก้ไขรหัสผ่านได้");
                                }
                            }
                        });
                    }
                } else {
                    alert('Password ไม่ตรงกัน !');
                }
            });

            $('#Change_Pass').on('click', function () {
                $('#pass_1').val("");
                $('#pass_2').val("");
                $('#ModalPass').modal('show');
            });
            $('#btn_clear').on('click', function () {
                location.reload();
            });
        });
        function loadData() {
            var eid = $('#emp_id_h').val();
            $.ajax({
                url: "ajax/profile/select_data_emp.php",
                type: "post",
                dataType: "json",
                data: {eid: eid},
                success: function (rs) {
                    $('#emp_id').val(rs.id);
                    $('#emp_name').val(rs.name);
                    $('#emp_gender').val(rs.gender);
                    $('#datepicker').val(rs.bd);
                    $('#emp_address').val(rs.address);
                    $('#emp_tel').val(rs.tel);
                    $('#emp_pic_h').val(rs.pic);
                }
            });
        }
        ;
    </script>
</body>
</html>
