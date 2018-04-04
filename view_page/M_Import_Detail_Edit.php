<?php
include '../lib/connect.php';
include '../lib/check_login.php';
$import_id = $_GET['import_id'];
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
        <title>แก้ไขรายการรับเข้าสินค้า</title>
        <!-- Custom CSS -->
        <style>
            #tableUnitEdit td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
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
                <span class="fa fa-list-alt"></span> แก้ไขรายการนำเข้าสินค้ารหัส <?php echo $_GET['import_id']; ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="M_Import_List.php">รายการนำเข้าสินค้า</a></li>
                <li class="active">แก้ไขรายการรับเข้า</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"></h3>
                        </div>    
                        <div class="content">
                            <input type="hidden" id="import_id" value="<?php echo $import_id ?>"/>
                            <div class="box-body">
                                <table id="tableImport" class="table table-bordered table-hover"></table>
                            </div>
                            <div class="box-body">
                                <table id="tableUnitEdit" class="table table-bordered table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <td width="10%">ลำดับ</td>
                                            <td width="15%">Unit ID</td>
                                            <td width="20%">Serial Number</td>
                                            <td width="15%">วันที่รับเข้า</td>
                                            <td width="15%">วันที่หมดประกัน</td>
                                            <td width="10%">ระยะเวลาประกัน</td>
                                            <td width="20%"></td>
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
        var tableUnitEdit;
        $(function () {
            var import_id = $('#import_id').val();
            $.ajax({
                url: "ajax/import/select_edit_import_detail.php",
                type: "post",
                dataType: "html",
                data: {import_id: import_id},
                success: function (data) {
                    $('#tableImport').html(data);
                }
            });

            $("#tableUnitEdit").dataTable().fnDestroy();
            tableUnitEdit = $('#tableUnitEdit').DataTable({
                ajax: {
                    url: "ajax/import/select_edit_import_unit.php",
                    type: "post",
                    data: {import_id: import_id}
                },
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 15,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                language: language,
                "columnDefs": [
                    {"targets": 6, "orderable": false, "searchable": false},
                ],
            });
        });
    </script>
</body>
</html>