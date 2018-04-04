<?php
include '../lib/connect.php';
include '../lib/check_login.php';
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
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content-header">
            <h1>
                <span class="fa fa-user-plus"></span> เพิ่มข้อมูลพนักงาน
                <!--<small></small>-->
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
                        <div class="box-header bg-green-gradient">
                            <h3 class="box-title" style="font-style: normal; font-size: 19px;"><span class="fa fa-user-plus"></span> เพิ่มข้อมูลพนักงาน</h3>
                        </div>
                        <div class="box-body">
                            <form class="form-horizontal" id="form-addemp">
                                <table class="table table-responsive table-hover" id="table_add">
                                    <tr style="vertical-align:middle;">
                                        <td style="width:30%; text-align: right; vertical-align:middle;">รูปภาพ : </td>
                                        <td style="width:40%; vertical-align:middle;">
                                            <input type="file" class="form-control" id="file_emp" name="file_emp">                 
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
                                        <td style="width:30%; text-align: right; vertical-align:middle;">รหัสประจำตัวบัตรประชาชน : </td>
                                        <td style="width:40%; vertical-align:middle;">
                                            <input type="number" id="Pcode" class="form-control" id="emp_pcode" name="emp_pcode"  onKeyPress="if (this.value.length == 13)
                                                        return false;" required="">        
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
                                        <td colspan="3" style="vertical-align:middle;">
                                    <center>
                                        <button type="submit" class="btn bg-green-gradient">บันทึก</button>
                                        <button type="button" class="btn bg-red-gradient" id="btn_clear">ยกเลิก</button>
                                    </center>
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
                                                    $('#datepicker').datepicker({
                                                        language: "th",
                                                        autoclose: true,
                                                        format: 'yyyy-mm-dd'
                                                    });
                                                    $("[data-mask]").inputmask();
                                                    setid();
                                                    $('#form-addemp').on('submit', function (event) {
                                                        event.preventDefault();
                                                        var data = new FormData(this);
                                                        var pcode = $('#Pcode').val();
                                                        var r = confirm("ยืนยันการเพิ่มข้อมูลพนักงาน");
                                                        if (r === true) {
                                                            $.ajax({
                                                                url: "ajax/Employee/check_personal.php",
                                                                type: "post",
                                                                data: {pcode: pcode},
                                                                success: function (rs) {
                                                                    var rows = parseInt(rs);
                                                                    if (rows === 0) {
                                                                        //var r = confirm("ยืนยันการเพิ่มข้อมูลพนักงาน");
                                                                        //if (r === true) {
                                                                            $.ajax({
                                                                                url: 'ajax/Employee/insert_emp.php',
                                                                                type: 'post',
                                                                                data: data,
                                                                                contentType: false,
                                                                                processData: false,
                                                                                success: function (rs1) {
                                                                                    alert(rs1);
                                                                                    location.reload();
                                                                                }
                                                                            });
                                                                        //}
                                                                    } else if (rows > 0) {
                                                                        alert("ข้อมูลพนักงานนี้ได้ถูกเพิ่มแล้ว");
                                                                    }
                                                                }
                                                            });
                                                        }
                                                    });
                                                    $('#btn_clear').on('click', function () {
                                                        location.reload();
                                                    });
                                                });
                                                function setid() {
                                                    $.ajax({
                                                        url: "ajax/Employee/select_id.php",
                                                        success: function (data) {
                                                            $('#emp_id').val(data);
                                                        }
                                                    });
                                                }
                                                ;
                                                //var data = $('#form-addemp').serialize();
                                                //var formData = new FormData(this);
    </script>
</body>
</html>
