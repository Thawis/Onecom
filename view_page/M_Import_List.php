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
        <!-- Select 2 -->
        <link href="../plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootsrap DatePicker-->
        <link href="../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
        <!-- Daterange picker -->
        <link href="../plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
        <title>รายการนำเข้าสินค้า</title>
        <!-- Custom CSS -->
        <style>
            .dataTables_filter{
                display: none;
            }
            #tableImport td{
                vertical-align: middle;
                font-family: Tahoma;
                font-style: normal;
                font-size: 14px; 
                text-align: center;
            }
            #tableDetail td{
                vertical-align: middle;
                font-family: Tahoma;
                font-style: normal;
                font-size: 14px; 
            }
            #table-unit td{
                vertical-align: middle;
                font-family: Tahoma;
                font-style: normal;
                font-size: 12px; 
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
                <span class="fa fa-list-alt"></span> รายการรับเข้าสินค้า
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">รายการรับเข้าสินค้า</li>
            </ol>
        </section>
        <section class="content" style="height:1600px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"></h3>
                        </div>    
                        <div class="content">
                            <div class="box-body">
                                <!--                                <div class="col-md-6" style="margin-top:10px;">
                                                                    <button type="button" id="filter_sell" class="btn bg-teal-active color-palette" data-toggle="modal" data-target="#ModalFilter"><span class="fa fa-filter"> ตัวกรองข้อมูล</span></button>
                                                                </div>-->
                                <div class="col-md-12" style="margin-top:10px;">                                            
                                    <div class="input-group center-block" style="width:50%;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="txtSearch_list" name="txtSearch_list" placeholder="ค้นหา : รหัสรายการรับเข้าสินค้า, รหัสอ้างอิงรับเข้าสินค้า">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn bg-teal-active color-palette" id="btn_refresh" name="btn_refresh"><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                            </div>
                                        </div>
                                    </div>                                           
                                </div>
                                <table id="tableImport" class="table table-bordered table-hover">
                                    <thead>
                                        <tr  class="bg-teal-active color-palette" style="vertical-align: middle; font-weight: bold;">
                                            <td width="10%">ลำดับ</td>
                                            <td width="20%">รหัสรายการรับเข้าสินค้า</td>
                                            <td width="20%">รหัสอ้างอิงรับเข้าสินค้า</td>
                                            <td width="20%">วันที่รับเข้า</td>
                                            <td width="15%">ประเภทรับเข้า</td>
                                            <td width="15%"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
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
    <!-- Modal Import Detail -->
    <div class="modal fade" id="ModalImportDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form-detail">
                    <div class="modal-header bg-teal-active color-palette">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-info-circle"></span> รายละเอียดการรับเข้าสินค้า</h4>
                    </div>
                    <!--style="height:1600px;"-->
                    <div class="modal-body">  
                        <input type="hidden" id="import_id"/>
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-hover table-responsive" id="tableDetail" style="margin-bottom:15px;">
                                </table>
                                <table class="table table-bordered table-hover table-responsive" id="table-unit">
                                    <thead>
                                        <tr class="bg-teal-active color-palette" style="vertical-align: middle; text-align:center; font-style: normal; font-size: 14px; font-weight: bold;">
                                            <td width="100px">ลำดับ</td>
                                            <td width="150px">เลขที่สินค้า</td>
                                            <td width="300px">ชื่อสินค้า</td>
                                            <td width="250px">S/N</td>
                                            <td width="150px">วันที่รับเข้า</td>
                                            <td width="200px">วันที่หมดประกัน</td>
                                            <td width="200px">ระยะเวลาประกัน</td>
                                            <td width="100px">สถานะ</td>
                                        </tr>
                                    </thead>
                                </table> 
                            </div>
                        </div>                           
                    </div>
                    <div class="modal-footer">
                        <!--<input type="hidden" id="action-sub" name="action" value="" >-->
                        <!--<button type="submit" class="btn btn-success">บันทึก</button>-->
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
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
    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <!-- language DataTable-->
    <script src="script/global.js" type="text/javascript"></script>
    <script>
        var tableImport;
        var tableUnitImport;
        $(function () {
            $('#txtSearch_list').keyup(function () {
                tableImport.search(this.value).draw();
            });
            $('#btn_refresh').on('click', function () {
                location.reload();
            });
            tableImport = $("#tableImport").DataTable({
                "ajax": "ajax/import/select_import.php",
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                //"sDom": '<"top"lf>t<"bottom"ip><"clear">',
                "columnDefs": [
                    {"targets": 3, "orderable": true, "searchable": false},
                    {"targets": 4, "orderable": true, "searchable": false},
                    {"targets": 5, "orderable": false, "searchable": false},
                    {"targets": 6, "visible": false, "searchable": true},
                    {"targets": 7, "visible": false, "searchable": true}],
                language: language
            });

            $('#ModalImportDetail').on('shown.bs.modal', function () {
                var import_id = $('#import_id').val();
                $.ajax({
                    url: "ajax/import/select_import_detail.php",
                    type: "post",
                    dataType: "html",
                    data: {import_id: import_id},
                    success: function (data) {
                        $('#tableDetail').html(data);
                    }
                });
                tableUnitImport = $('#table-unit').DataTable({
                    destroy: true,
                    ajax: {
                        url: "ajax/import/select_import_unit.php",
                        type: "post",
                        data: {import_id: import_id}
                    },
                    scrollX: "1450px",
                    scrollCollapse: true,
                    "bInfo": true,
                    "paging": true,
                    "lengthChange": false,
                    "iDisplayLength": 15,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    language: language
                });
            });

        });
        function DetailImport(a) {
            $('#import_id').val(a);
        }
        function SendReport(a) {
            $.ajax({
                url: "ajax/import/set_session_unit_id.php",
                type: "post",
                data: {uid: a},
                success: function (data) {
                    console.log(data);
                }
            });
            //window.location.href = "M_Sell_Bill.php";
            window.open("../report/import/unit_id.php", "_blank");
        }
        ;
        function CancelImport(a) {
            $.ajax({
                url: "ajax/import/check_unit.php",
                type: "post",
                data: {import_id: a},
                success: function (data) {
                    if (data === "0") {
                        var r = confirm("ยืนยันการยกเลิกรายการรับเข้าสินค้าขาย รหัส : " + a);
                        if (r === true) {
                            $.ajax({
                                url: "ajax/import/remove_import_list.php",
                                type: "post",
                                data: {import_id: a},
                                success: function (data) {
                                    alert(data);
                                    tableImport.ajax.reload(null, false);
                                }
                            });
                        }
                    } else {
                        alert("ไม่สามารถยกเลิกรายการรับเข้าเลขที่ : " + a + " ได้");
                    }
                }
            });

        }
        ;

    </script>
</body>
</html>