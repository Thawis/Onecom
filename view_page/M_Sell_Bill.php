<?php
include '../lib/connect.php';
include '../lib/check_login.php';
if (empty($_SESSION['ord_id_bill'])) {
    header("location:M_Sell.php");
} else {
    $ord_id_session = $_SESSION['ord_id_bill'];
}
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
        <!-- iCheck -->
        <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css"/>
        <!-- DataTable -->
        <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
        <!-- daterange picker -->
        <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
        <!-- Select 2 -->
        <link href="../plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <title>ใบเสร็จรับเงิน</title>
        <!-- Custom CSS -->
        <style>
            .dataTables_filter{
                display: none;
            }
            #tableSell td{
                text-align: center;
                vertical-align: middle;
            }
            .font_1{
                vertical-align: middle;
                text-align: right;
                font-family: Tahoma, Verdana, Segoe, sans-serif;
                font-size: 16px;
            }
            .font_2{
                vertical-align: middle;
                text-align: center;
                font-family: Tahoma, Verdana, Segoe, sans-serif;
                font-size: 16px;
            }
            .b3{
                font-weight: bold;
            }
            .font_3{
                vertical-align: middle;
                text-align: left;
                font-family: Tahoma, Verdana, Segoe, sans-serif;
                font-size: 16px;
            }
            .font_4{
                vertical-align: middle;
                text-align: center;
                font-family: Tahoma, Verdana, Segoe, sans-serif;
                font-size: 14px;
            }
            #sellDetail td{
                vertical-align: middle;
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
            <h1><span class="fa fa-file-text-o"></span> ใบเสร็จรับเงิน</h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="M_Sell_Record.php">ประวัติการขาย</a></li>
                <li class="active">ใบเสร็จรับเงิน</li>
            </ol>
        </section>
        <section class="content" style="height:1600px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="box box-default">
                            <div class="panel-body">        
                                <div class="content">          
                                    <div class="box-header bg-blue-gradient">
                                        <h3 class="box-title" style="font-style: normal; font-size: 19px; font-family: Tahoma;"><span class="fa fa-file-text-o"></span> ใบเสร็จรับเงิน เลขที่ : <label id="lbl_ord_id"><?= $ord_id_session; ?></label></h3>
                                    </div>
                                    <div class="box-body">
                                        <input type="hidden" id="ord_id" name="ord_id" value="<?= $ord_id_session ?>"/>
                                        <table class="table no-border" id="shop_logo" style="margin-bottom:10px;">
                                        </table>
                                        <table class="table no-border" id="cus_detail" style="margin-bottom: 10px;">
                                        </table>
                                        <table class="table table-responsive table-bordered" id="sellDetail">
                                            <tbody>
                                                <tr class="bg-black-gradient">
                                                    <td width="10%" class="font_2 b3">ลำดับที่</td>
                                                    <td width="25%" class="font_2 b3">ชื่อสินค้า</td>
                                                    <td width="35%" class="font_2 b3">S/N</td>
                                                    <td width="15%" class="font_2 b3">ประกัน</td>
                                                    <td width="20%" class="font_2 b3">ราคา</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="col-mg-12" style="text-align:center; margin-top: 15px;"><button type="button" class="btn bg-red-gradient" id="btn_print"><span class="fa fa-print"></span> พิมพ์ใบเสร็จ</button></div>
                                    </div>
                                </div>
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
    <!-- iCheck -->
    <script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- language DataTable-->
    <script src="script/global.js" type="text/javascript"></script>
    <script>
        $(function () {
            loadLogo();
            loadCus();
            loadDetail();
            $('#btn_print').on('click', function () {
                window.open("../report/bill_sell/bill_sell.php", "_blank");
            });
        });
        function loadLogo() {
            $.ajax({
                url: "ajax/sell_bill/select_head.php",
                dataType: "html",
                success: function (data) {
                    $('#shop_logo').html(data);
                }
            });
        }
        ;
        function loadCus() {
            var ord_id = $('#ord_id').val();
            $.ajax({
                url: "ajax/sell_bill/select_customer.php",
                type: "post",
                dataType: "html",
                data: {ord_id: ord_id},
                success: function (data) {
                    $('#cus_detail').html(data);
                }
            });
        }
        ;
        function loadDetail() {
            var ord_id = $('#ord_id').val();
            $.ajax({
                url: "ajax/sell_bill/select_sell_detail.php",
                type: "post",
                dataType: "html",
                data: {ord_id: ord_id},
                success: function (data) {
                    $('#sellDetail').append(data);
                }
            });
        }
    </script>
</body>
</html>
