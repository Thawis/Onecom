<?php
include '../lib/connect.php';
include '../lib/check_login.php';
include '../lib/lock_page_user.php';
//$userType = $_SESSION['login_type'];
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
        <title>รายงานข้อมูลพนักงาน</title>
        <style>
            .dataTables_filter{
                display: none;
            }
            #table-emp td{
                vertical-align: middle;
                font-style: normal;
                font-size: 16px; 
                text-align: center;
            }
            #table-emp td:nth-child(3){
                text-align: left;
            }
            #table-emp-cancel td{
                vertical-align: middle;
                font-style: normal;
                font-size: 16px; 
                text-align: center;
            }
            #table-user-type td{
                vertical-align: middle;
                font-style: normal;
                font-size: 16px; 
                text-align: center; 
            }
            #table-emp-cancel td:nth-child(3){
                text-align: left;
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
                <span class="fa fa-file-text-o"></span> รายงานพนักงาน
                <!--<small></small>-->
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>ออกรายงาน</li>
                <li class="active">รายงานพนักงาน</li>
            </ol>
        </section>
        <section class="content" style="height:1600px;">
            <div class="row">
                <div class="col-md-12">                    
                    <div class="box box-default">
                        <div class="box-body">
                            <form id="emp_find">
                                <table class="table no-border table-responsive">
                                    <tbody>
                                        <tr>
                                            <td width="15%" style="vertical-align: middle; text-align: right; font-weight: bold;">ตำแหน่ง : </td>
                                            <td width="20%"style="vertical-align: middle;">
                                                <select class="form-control" id="ddl_emptype" name="ddl_emptype" style="width:100%" required="">
                                                    <option value="All">ทั้งหมด</option>
                                                    <option value="admin">หัวหน้าช่าง</option>
                                                    <option value="user">ช่างซ่อมทั่วไป</option>
                                                </select>
                                            </td>
                                            <td width="15%" style="vertical-align: middle; text-align: right; font-weight: bold;">สถานะ : </td>
                                            <td width="20%" style="vertical-align: middle;">
                                                <select class="form-control" id="ddl_empstatus" name="ddl_empstatus" style="width:100%" required="">
                                                    <option value="All">ทั้งหมด</option>
                                                    <option value="1">ปกติ</option>
                                                    <option value="0">ยกเลิก</option>
                                                </select>
                                            </td>
                                            <td width="30%" style="vertical-align: middle;"> 
                                                <button type="button" class="btn bg-blue-gradient" id="btnfind"><span class="fa fa-search"></span> ค้นหา</button> 
                                                <button type="button" class="btn bg-red-gradient" id="btnprint"><span class="fa fa-print"></span> ออกรายงาน</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <!--Data Table -->
                            <table id="table-emp" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr class="bg-blue-gradient" style="font-size: 16px;">
                                        <td width="10%" style="text-align:center;">ลำดับ</td>
                                        <td width="15%" style="text-align:center;">รหัสพนักงาน</td>
                                        <td width="25%" style="text-align:left;">ชื่อ-นามสกุล</td>                                                    
                                        <td width="15%" style="text-align:center;">เพศ</td>
                                        <td width="15%" style="text-align:center;">ตำแหน่ง</td>
                                        <td width="20%" style="text-align:center;">สถานะ</td>
                                    </tr>
                                </thead>
                            </table>                                                                      
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
    <script>
        var TableEmp;
        $(function () {
            TableEmp = $("#table-emp").DataTable({
                //"ajax": "ajax/Employee/select_employee.php",
                "bInfo": false,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                language: language
            });
            $('#btnfind').on('click', function () {
                var type = $('#ddl_emptype').val();
                var status = $('#ddl_empstatus').val();
                //console.log(type, status);
                TableEmp = $('#table-emp').DataTable({
                    destroy: true,
                    ajax: {
                        url: "ajax/report/r_emp_select.php",
                        type: "post",
                        data: {type: type, status: status}
                    },
                    "bInfo": true,
                    "paging": true,
                    "lengthChange": false,
                    "iDisplayLength": 30,
                    "searching": false,
                    "ordering": false,
                    "info": true,
                    "autoWidth": false,
                    language: language
                });
            });
            $('#btnprint').on('click', function () {
                window.open("../report/employee/employee_report.php", "_blank");
            });
        });
    </script>
</body>
</html>
