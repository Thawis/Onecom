<?php
include '../lib/connect.php';
include '../lib/check_login.php';
include '../lib/lock_page_user.php';
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
        <!-- Select 2 -->
        <link href="../plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <title>รายงานการซ่อม</title>
        <style>
            .dataTables_filter{
                display: none;
            }
            #tableSMS td{
                vertical-align: middle;
                font-style: normal;
                font-size: 16px; 
                text-align: center;
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
                <span class="fa fa-file-text-o"></span> รายงานการแจ้งเตือน
                <!--<small></small>-->
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>ออกรายงาน</li>
                <li class="active">รายงานการแจ้งเตือน</li>
            </ol>
        </section>
        <section class="content" style="height:1600px;">
            <div class="row">
                <div class="col-md-12">                    
                    <div class="box box-default">
                        <div class="box-body">
                            <table class="table no-border table-responsive">
                                <tbody>
                                    <tr>
                                        <td width="20%" style="vertical-align: middle; text-align: right; font-weight: bold;">ช่วงเวลารับซ่อม : </td>
                                        <td width="25%"style="vertical-align: middle;">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="reservation" name="reservation">
                                            </div>
                                        </td>
                                        <td width="20%" style="vertical-align: middle; text-align: right; font-weight: bold;">รายชื่อพนักงาน : </td>
                                        <td colspan="2" style="vertical-align: middle;">
                                            <select class="form-control select2" id="ddl_emp" name="ddl_emp" style="width:100%" required=""></select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-responsive table-hover">
                                <tbody>
                                    <tr>
                                        <td width="13%"></td>
                                        <td width="25%" style="vertical-align: middle; text-align: center;"><button type="button" class="btn bg-aqua-gradient" id="btn_repair"><span class="fa fa-print" ></span> ออกรายงานซ่อมปกติ</button></td>
                                        <td width="25%" style="vertical-align: middle; text-align: center;"><button type="button" class="btn bg-orange" id="btn_repair_claim"><span class="fa fa-print" ></span> ออกรายงานซ่อมเคลม</button></td>
                                        <!--<td width="25%" style="vertical-align: middle; text-align: center;"><button type="button" class="btn bg-green-gradient" id="btn_daily"><span class="fa fa-print" ></span> ออกรายงานซ่อมรายวัน</button></td>-->
                                        <td width="25%" style="vertical-align: middle; text-align: center;"><button type="button" class="btn bg-blue-gradient" id="btn_summary"><span class="fa fa-print" ></span> ออกรายงานสรุปซ่อม</button></td> 
                                        <td width="12%"></td>
                                    </tr>
                                </tbody>
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
    <script src="script/dateRange2.js" type="text/javascript"></script>
    <script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <script>
        var tableSMS;
        $(function () {
            $('.select2').select2();
            load_emp();
            tableSMS = $("#tableSMS").DataTable({
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
            $('#btn_repair').on('click', function () {
                var reservation = $('#reservation').val();
                var emp = $('#ddl_emp').val();
                var emp_name = $("#ddl_emp option:selected").text();
                $.ajax({
                    url: "ajax/report/r_repair_session.php",
                    type: "post",
                    data: {emp: emp, todate: reservation, emp_name: emp_name},
                    success: function () {
                        window.open("../report/repair/repair_report_n.php", "_blank");
                    }
                });
            });
            $('#btn_repair_claim').on('click', function () {
                var reservation = $('#reservation').val();
                var emp = $('#ddl_emp').val();
                var emp_name = $("#ddl_emp option:selected").text();
                $.ajax({
                    url: "ajax/report/r_repair_session.php",
                    type: "post",
                    data: {emp: emp, todate: reservation, emp_name: emp_name},
                    success: function () {
                        window.open("../report/repair/repair_report_c.php", "_blank");
                    }
                });
            });
            $('#btn_summary').on('click', function () {
                var reservation = $('#reservation').val();
                var emp = $('#ddl_emp').val();
                var emp_name = $("#ddl_emp option:selected").text();
                $.ajax({
                    url: "ajax/report/r_repair_session.php",
                    type: "post",
                    data: {emp: emp, todate: reservation, emp_name: emp_name},
                    success: function () {
                        window.open("../report/repair/repair_summary.php", "_blank");
                    }
                });
            });
        });
        function load_emp() {
            $.ajax({
                url: 'ajax/report/r_repair_select_emp.php',
                type: 'post',
                dataType: 'JSON',
                success: function (data) {
                    $('#ddl_emp').empty();
                    $('#ddl_emp').append('<option id="" value="All">เลือกพนักงานทั้งหมด</option>');
                    $.each(data, function (key, val) {
                        $('#ddl_emp').append('<option id="' + val.id + '" value="' + val.id + '">' + val.name + '</option>');
                    });
                }
            });
        }
        ;
    </script>
</body>
</html>
