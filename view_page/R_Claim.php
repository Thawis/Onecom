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
        <title>รายงานการรับเคลมสินค้า</title>
        <style>
            .dataTables_filter{
                display: none;
            }
            #tableClaim thead td{
                vertical-align: middle;
                font-style: normal;
                font-size: 14px; 
                text-align: center;
            }
            #tableClaim tbody td{
                vertical-align: middle;
                font-style: normal;
                font-size: 12px; 
                text-align: center;
            }
            #tableClaim tbody td:nth-child(3){
                vertical-align: middle;
                font-style: normal;
                font-size: 12px; 
                text-align: left;
            }
            #tableClaim tbody td:nth-child(4){
                vertical-align: middle;
                font-style: normal;
                font-size: 12px; 
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
                <span class="fa fa-file-text-o"></span> รายงานการรับเคลมสินค้า
                <!--<small></small>-->
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>ออกรายงาน</li>
                <li class="active">รายงานการรับเคลมสินค้า</li>
            </ol>
        </section>
        <section class="content" style="height:1600px;">
            <div class="row">
                <div class="col-md-12">                    
                    <div class="box box-default">
                        <div class="box-body">
                            <form id="emp_customer">
                                <table class="table no-border table-responsive">
                                    <tbody>
                                        <tr>
                                            <td width="20%" style="vertical-align: middle; text-align: right; font-weight: bold;">ช่วงเวลารับเคลมสินค้า : </td>
                                            <td width="25%"style="vertical-align: middle;">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-clock-o"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" id="reservation" name="reservation">
                                                </div>
                                            </td>
                                            <td width="20%" style="vertical-align: middle; text-align: right; font-weight: bold;">ประเภทการรับเคลม : </td>
                                            <td width="15%" style="vertical-align: middle;">
                                                <select class="form-control" id="ddl_claimtype" name="ddl_claimtype" style="width:100%" required="">
                                                    <option value="All">ทั้งหมด</option>
                                                    <option value="forshop">สินค้าเคลมของร้าน</option>
                                                    <option value="forcus">สินค้าเคลมของลูกค้า</option>
                                                </select>
                                            </td>
                                            <td width="20%" style="vertical-align: middle;"> 
                                                <button type="button" class="btn bg-blue-gradient" id="btnfind"><span class="fa fa-search"></span> ค้นหา</button> 
                                                <button type="button" class="btn bg-red-gradient" id="btnprint"><span class="fa fa-print"></span> ออกรายงาน</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <!--Data Table -->
                            <table id="tableClaim" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr class="bg-blue-gradient" style="font-size: 16px;">
                                        <td width="10%" style="text-align:center;">ลำดับ</td>
                                        <td width="15%" style="text-align:center;">เลขที่ใบเคลม</td>
                                        <td width="25%" style="text-align:center;">วันที่รับเคลม / วันที่ส่งคืน</td>
                                        <td width="35%" style="text-align:center;">รายละเอียด</td>                                                    
                                        <td width="15%" style="text-align:center;">สถานะ</td>
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
    <script src="script/dateRange2.js" type="text/javascript"></script>
    <script>
        var tableClaim;
        $(function () {
            tableClaim = $("#tableClaim").DataTable({
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
                var reservation = $('#reservation').val();
                var type = $('#ddl_claimtype').val();
//                $.ajax({
//                    url: "ajax/report/r_claim.php",
//                    type: "post",
//                    data: {type: type, todate: reservation},
//                    success: function (rs) {
//                        console.log(rs);
//                    }
//                });

                tableClaim = $("#tableClaim").DataTable({
                    destroy: true,
                    ajax: {
                        url: "ajax/report/r_claim.php",
                        type: "post",
                        data: {type: type, todate: reservation}
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
                window.open("../report/cliam/claim_report.php", "_blank");
            });
        });
    </script>
</body>
</html>
