<?php
include '../lib/connect.php';
include '../lib/check_login.php';
if (empty($_GET)) {
    header("location:M_Mywork.php");
}
//echo $_GET['item_id'];
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
        <!-- iCheck -->
        <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css"/>
        <!-- Select 2 -->
        <link href="../plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <title>บันทึกรายการซ่อม</title>
        <style>
            .dataTables_filter{
                display: none;
            }
            #repair_detail thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #repair_detail td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableDetail thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma; 
            }
            #tableDetail td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma; 
            }
            #repair_list td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableUnit td{
                vertical-align:middle; 
                text-align:center;
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableSell thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            .font_1{
                text-align: right;
                font-size: 14px;
                font-family: Tahoma;
                font-weight: bold;
            }
            .font_2{
                text-align: center;
                font-size: 12px;
                font-family: Tahoma;
                font-weight: bold;
            }
            .font_3{
                text-align: center;
                font-size: 6px;
                font-family: Tahoma;
                font-weight: bold;
            }
        </style>
    </head>
    <?php
    include '../lib/header_navbar.php';
    include '../lib/main_sidebar.php';
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content-header">
            <h1>
                <span class="fa fa-info-circle"></span> บันทึกรายการซ่อมเลขที่สินค้าซ่อม : <label><?= $_GET['item_id']; ?> </label>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="M_MyWork.php">งานซ่อมของฉัน</a></li>
                <li class="active">บันทึกรายการซ่อม</li>
            </ol>
        </section>
        <section class="content" style="height:2000px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header bg-purple-gradient">
                            <h3 class="box-title">รายละเอียดสินค้าซ่อมเลขที่ : <label><?= $_GET['item_id']; ?></label></h3>
                        </div>    
                        <div class="content">
                            <div class="box-body">
                                <input type="hidden" id="hidden_item_id" value="<?= $_GET['item_id']; ?>"/>
                                <input type="hidden" id="hidden_item_id_cus" value="<?= $_GET['item_id']; ?>"/>
                                <table class="table table-hover table-responsive" id="repair_detail">
                                </table>
                            </div>
                            <div class="box-body">
                                <table class="table table-hover table-responsive no-border">
                                    <tbody>
                                        <tr>
                                            <td width="30%" style="text-align:center; vertical-align: middle;">
                                                <div class="btn-group">
                                                    <button type="button" class="btn bg-green-gradient dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-plus-square"></span> เพิ่มงานซ่อมสินค้า</button>
                                                    <ul id="listgroup" class="dropdown-menu">
                                                        <li><a data-toggle="modal" href="#Menu" class="modal-group"><span class="fa fa-list"></span> งานซ่อมตามรายการ</a></li>
                                                        <li><a data-toggle="modal" href="#Sell" class="modal-group"><span class="fa fa-cart-plus"></span> ขายสินค้าเพื่อซ่อม</a></li>
                                                        <li><a data-toggle="modal" href="#Custom" class="modal-group"><span class="fa fa-plus-square-o"></span> งานซ่อมที่ไม่มีในรายการ</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td width="40%">
                                                <div class="input-group" style="width:100%;">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="txtSearch_list" name="txtSearch_list" placeholder="ค้นหา : รายการที่ทำ, ข้อมูลการซ่อม ฯลฯ">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn bg-purple-gradient" id="" name=""><span class="fa fa-search"></span> ค้นหา</button> 
                                                        </div>
                                                    </div>
                                                </div>  
                                            </td>
                                            <td width="30%" style="text-align:center; vertical-align: middle;"><button type="button" id="btn_confirm_repair" name="btn_confirm_repair" class="btn bg-blue-gradient" disabled=""><span class="fa fa-check"></span> ยืนยันการซ่อมสินค้า</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-body">
                                <center><table class="table table-bordered" id="repair_list">
                                        <thead>
                                            <tr class="bg-purple-gradient" style="text-align:center;">
                                                <td width="100px">ลำดับ</td>
                                                <td width="250px">รายการที่ทำ</td>
                                                <td width="150px">ค่าใช้จ่าย</td>
                                                <td width="300px">รายละเอียด</td>
                                                <td width="200px;">ประเภทรายการซ่อม</td>
                                                <td width="150px;">ระยะเวลาประกัน</td>
                                                <td width="200px">เลขที่ใบเสร็จขาย</td>
                                                <td width="200px"></td>
                                            </tr>
                                        </thead>
                                    </table></center>
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
    <!-- Menu -->
    <div class="modal fade" id="Menu" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_repair_menu">
                    <div class="modal-header bg-blue-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-list"></span> งานซ่อมตามรายการ</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="repair_menu_id" name="repair_menu_id" value="<?= $_GET['item_id']; ?>"/>
                        <input type="hidden" id="repair_menu_type" name="repair_menu_type" value="Menu"/>
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover table-bordered" id="">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align: middle;">รายการซ่อม : </td>
                                            <td width="40%" style="vertical-align: middle;"><select class="form-control select2" id="ddl_menu" style="width:100%" required=""></select></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align: middle;">ราคา : </td>
                                            <td width="40%" style="vertical-align: middle;"><input type="number" class="form-control" id="repair_menu_price" name="repair_menu_price" readonly="" required=""></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align: middle;">ระยะเวลาประกัน : </td>
                                            <td width="40%" style="vertical-align: middle;">
                                                <select class="form-control select2" id="ddl_menu_war" style="width:100%" required="">
                                                    <option value="">กรุณาเลือกรายการ</option>
                                                    <option value="ไม่มี">ไม่มี</option>
                                                    <option value="7 วัน">7 วัน</option>
                                                    <option value="1 เดือน">1 เดือน</option>
                                                    <option value="3 เดือน">3 เดือน</option>
                                                </select>
                                            </td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align: middle;">รายละเอียด(ถ้ามี) : </td>
                                            <td colspan="2" width="70%" style="vertical-align: middle;"><textarea class="form-control" style="width:450px;" id="repair_menu_detail" name="repair_menu_detail" placeholder=" รายละเอียดการซ่อม . . . . ." ></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-blue-gradient">เพิ่มข้อมูล</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Sell -->
    <div class="modal fade" id="Sell" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_repair_sell">
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-cart-plus"></span> ขายสินค้าเพื่อซ่อม</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="repair_sell_id" name="repair_sell_id" value="<?= $_GET['item_id']; ?>"/>
                        <input type="hidden" id="repair_sell_type" name="repair_sell_type" value="Sell"/>
                        <input type="hidden" id="repair_sell_total" name="repair_sell_total" value=""/>
                        <input type="hidden" id="repair_sell_cus" name="repair_sell_cus" value=""/>
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover table-bordered" id="">
                                    <tbody>
                                        <tr>
                                            <td width="15%" class="font_1" style="vertical-align:middle;"> เลขที่ใบสั่งซื้อ : </td>
                                            <td width="25%" class="font_1" style="vertical-align:middle;"><input type="text" id="repair_sell_ord_id" name="repair_sell_ord_id" class="form-control font_2" readonly=""></td>
                                            <td width="15%" class="font_1" style="vertical-align:middle;">เลขที่สินค้า : </td>
                                            <td width="30%" class="font_1" style="vertical-align:middle;"><input type="text" id="unit_id_find" name="unit_id_find" class="form-control font_2"></td>
                                            <td width="15%" class="font_1" style="vertical-align:middle;">
                                                <button type="button" id="findPro" name="findPro" class="btn bg-green-gradient btn-block">
                                                    <span class="fa fa-search-plus"></span> ค้นหาสินค้า
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-body">
                                <table class="table table-responsive table-bordered" id="tableSell">
                                    <thead>
                                        <tr class="bg-green-gradient">
                                            <td width="25%" class="font_2">เลขที่สินค้า</td>
                                            <td width="20%" class="font_2">ชื่อสินค้า</td>
                                            <td width="25%" class="font_2">S/N</td>
                                            <td width="15%" class="font_2">ราคา</td>
                                            <td width="10%" class="font_2">ประกัน</td>
                                            <td width="5%" class="font_2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-green-gradient">เพิ่มข้อมูล</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Custom -->
    <div class="modal fade" id="Custom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_repair_custom">
                    <div class="modal-header bg-red-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-plus-square-o"></span> งานซ่อมที่ไม่มีในรายการ</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <input type="hidden" id="repair_custom_id" name="repair_custom_id" value="<?= $_GET['item_id']; ?>"/>
                                <input type="hidden" id="repair_custom_type" name="repair_custom_type" value="Custom"/>
                                <table class="table table-responsive table-hover table-bordered" id="">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align: middle;">รายการซ่อม : </td>
                                            <td width="40%" style="vertical-align: middle;"><input type="text" id="repair_custom_name" name="repair_custom_name" class="form-control" required="" placeholder="รายการที่ซ่อม . . ."></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align: middle;">ราคา : </td>
                                            <td width="40%" style="vertical-align: middle;"><input type="number" class="form-control" id="repair_custom_price" name="repair_custom_price" min="50" required=""></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align: middle;">ระยะเวลาประกัน : </td>
                                            <td width="40%" style="vertical-align: middle;">
                                                <select class="form-control select2" id="ddl_custom_war" style="width:100%" required="">
                                                    <option value="">กรุณาเลือกรายการ</option>
                                                    <option value="ไม่มี">ไม่มี</option>
                                                    <option value="7 วัน">7 วัน</option>
                                                    <option value="1 เดือน">1 เดือน</option>
                                                    <option value="3 เดือน">3 เดือน</option>
                                                </select>
                                            </td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align: middle;">รายละเอียด(ถ้ามี) : </td>
                                            <td colspan="2" width="70%" style="vertical-align: middle;"><textarea class="form-control" style="width:450px;" id="repair_custom_detail" name="repair_custom_detail" placeholder=" รายละเอียดการซ่อม . . . . ." ></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-red-gradient">เพิ่มข้อมูล</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Detail -->
    <div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="">
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-info-circle"></span> รายละเอียดรายการขาย</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="modal_ord_id" value=""/>
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover table-bordered" id="tableDetail">
                                </table>
                            </div>
                            <div class="box-body">
                                <table class="table table-responsive table-hover table-bordered" id="tableUnit">
                                    <thead>
                                        <tr class="bg-green-gradient" style="text-align:center;">
                                            <td width="10%">ลำดับ</td>
                                            <td width="15%">เลขที่สินค้า</td>
                                            <td width="30%">รายละเอียดเบื้องต้น</td>                                           
                                            <td width="30%">วันที่หมดประกัน</td>
                                            <td width="15%">ราคา</td>
                                        </tr>   
                                    </thead>
                                </table>
                            </div>
                        </div>                            
                    </div>
                    <div class="modal-footer">
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
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script src="script/global.js" type="text/javascript"></script>
    <script src="script/dateRange.js" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <script>
        var tableList;
        var tableUnit;
        var i = 1;
        var unit = [];
        var total_money = 0;
        $(function () {
            chk_confirm();

            $('.select2').select2();
            $('#txtSearch_list').keyup(function () {
                tableList.search(this.value).draw();
            });
            setCus();
            loadDetail();
            var item_id_table = $('#hidden_item_id').val();
            tableList = $("#repair_list").DataTable({
                ajax: {
                    url: "ajax/mywork/select_repair_list_table.php",
                    type: "post",
                    data: {item_id: item_id_table}
                },
                "bInfo": true,
                "scrollX": "1550px",
                "scrollCollapse": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 20,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    {"targets": 0, "orderable": true, "searchable": false},
                    {"targets": 1, "orderable": false, "searchable": true},
                    {"targets": 2, "orderable": true, "searchable": false},
                    {"targets": 3, "orderable": false, "searchable": false},
                    {"targets": 6, "orderable": true, "searchable": true},
                    {"targets": 7, "orderable": false, "searchable": false}],
                language: language
            });
            $('#Menu').on('shown.bs.modal', function () {
                $('#repair_menu_price').val("");
                $('#repair_menu_detail').val("");
                $('#ddl_menu_war').val($('#mylist option:first-child').val()).trigger('change');
                var itemtype = $('#hidden_item_type').val();
                $.ajax({
                    url: 'ajax/mywork/select_service_menu.php',
                    type: 'post',
                    data: {itemtype: itemtype},
                    dataType: 'JSON',
                    success: function (data) {
                        $('#ddl_menu').empty();
                        $('#ddl_menu').append('<option id="" value="">กรุณาเลือกรายการ</option>');
                        $.each(data, function (key, val) {
                            $('#ddl_menu').append('<option id="' + val.id + '" value="' + val.id + '">' + val.name + '</option>');
                        });
                    }
                });
                $('#ddl_menu').on('change', function () {
                    var price = this.value;
                    $('#repair_menu_price').val(price);
                });
            });
            $('#form_repair_menu').on('submit', function (e) {
                e.preventDefault();
                var type = "Menu";
                var ser_price = $('#repair_menu_price').val();
                var ser_name = $("#ddl_menu option:selected").text();
                var item_id = $('#repair_menu_id').val();
                var war = $('#ddl_menu_war').val();
                var detail = $('#repair_menu_detail').val();
                var r = confirm("ยืนยันการเพิ่มข้อมูลการซ่อม");
                if (r === true) {
                    $.ajax({
                        url: "ajax/mywork/insert_repair_list.php",
                        type: "post",
                        data: {item_id: item_id, type: type, name: ser_name, price: ser_price, detail: detail, war: war},
                        success: function (data) {
                            if (data === "ok") {
                                alert("เพิ่มข้อมูลการซ่อมเรียบร้อย");
                                $('#Menu').modal('hide');
                                tableList.ajax.reload();
                                chk_confirm();
                            } else {
                                alert(data);
                            }
                        }
                    });
                }
            });
            $('#Sell').on('shown.bs.modal', function () {
                setORD();
                i = 1;
                unit = [];
                total_money = 0;
                $('#repair_sell_total').val(total_money);
                $('.sell_rows').remove();
                $('#unit_id_find').val("");
            });
            $('#form_repair_sell').on('submit', function (e) {
                e.preventDefault();
                if (total_money === 0) {
                    alert('กรุณาเลือกสินค้า');
                } else {
                    var r = confirm("ยืนยันการเพิ่มข้อมูล");
                    if (r === true) {
                        $.ajax({
                            url: "ajax/mywork/insert_repair_list_sell.php",
                            method: "post",
                            data: $('#form_repair_sell').serialize(),
                            success: function (data) {
                                if (data === "ok") {
                                    alert("เพิ่มรายการซ่อมขายเรียบร้อย");
                                    tableList.ajax.reload();
                                    chk_confirm();
                                    $('#Sell').modal('hide');
                                } else {
                                    alert(data);
                                }
                            }
                        });
                    }
                }
            });
            $('#Custom').on('shown.bs.modal', function () {
                $('#repair_custom_price').val("");
                $('#repair_custom_detail').val("");
                $('#repair_custom_name').val("");
                $('#ddl_custom_war').val($('#mylist option:first-child').val()).trigger('change');
            });
            $('#form_repair_custom').on('submit', function (e) {
                e.preventDefault();
                var item_id = $('#repair_custom_id').val();
                var type = $('#repair_custom_type').val();
                var ser_name = $('#repair_custom_name').val();
                var ser_price = $('#repair_custom_price').val();
                var war = $('#ddl_custom_war').val();
                var detail = $('#repair_custom_detail').val();
                var r = confirm("ยืนยันการเพิ่มข้อมูลการซ่อม");
                if (r === true) {
                    $.ajax({
                        url: "ajax/mywork/insert_repair_list.php",
                        type: "post",
                        data: {item_id: item_id, type: type, name: ser_name, price: ser_price, detail: detail, war: war},
                        success: function (data) {
                            if (data === "ok") {
                                alert("เพิ่มข้อมูลการซ่อมเรียบร้อย");
                                $('#Custom').modal('hide');
                                tableList.ajax.reload();
                                chk_confirm();
                            } else {
                                alert(data);
                            }
                        }
                    });
                }

            });
            $('#btn_confirm_repair').on('click', function () {
                var item_id = $('#hidden_item_id').val();
                var r = confirm("ยืนยันการบันทึกรายการซ่อม");
                if (r === true) {
                    $.ajax({
                        url: "ajax/mywork/confirm_repair.php",
                        type: "post",
                        data: {item_id: item_id},
                        success: function (data) {
                            console.log(data);
                            if (data === 'ok') {
                                alert("บันทึกข้อมูลรายการซ่อมเรียบร้อย");
                                window.location.replace("M_Mywork.php");
                            } else {
                                alert("ไม่สามารถยกเลิกข้อมูลซ่อมได้");
                            }
                        }

                    });
                }
            });
            $(document).on('click', '.btn_remove_list', function () {
                var casenum = this.value;
                var r = confirm("ยืนยันการยกเลิกข้อมูลซ่อม");
                if (r === true) {
                    $.ajax({
                        url: "ajax/mywork/remove_repair_list.php",
                        type: "post",
                        data: {casenum: casenum},
                        success: function (data) {
                            if (data === 'ok') {
                                alert("ยกเลิกข้อมูลซ่อมเรียบร้อย");
                                tableList.ajax.reload();
                                chk_confirm();
                            } else {
                                alert("ไม่สามารถยกเลิกข้อมูลซ่อมได้");
                            }
                        }

                    });
                }
            });
            $(document).on('click', '.btn_remove_list_sell', function () {
                var ref_id = this.value;
                //alert(ref_id);
                var r = confirm("ยืนยันการยกเลิกข้อมูลซ่อม");
                if (r === true) {
                    $.ajax({
                        url: "ajax/mywork/remove_repair_list_sell.php",
                        type: "post",
                        data: {ref_id: ref_id},
                        success: function (data) {
                            console.log(data);
                            if (data === 'success') {
                                alert("ยกเลิกข้อมูลซ่อมเรียบร้อย");
                                tableList.ajax.reload();
                                chk_confirm();
                            } else {
                                alert("ไม่สามารถยกเลิกข้อมูลซ่อมได้");
                            }
                        }

                    });
                }
            });
            $('#ModalDetail').on('shown.bs.modal', function () {
                var id = $('#modal_ord_id').val();
                $.ajax({
                    url: "ajax/sell/select_sell_detail.php",
                    type: "post",
                    dataType: "html",
                    data: {ord_id: id},
                    success: function (data) {
                        $('#tableDetail').html(data);
                    }
                });
                tableUnit = $('#tableUnit').DataTable({
                    destroy: true,
                    ajax: {
                        url: "ajax/sell/select_sell_unit.php",
                        type: "post",
                        data: {ord_id: id}
                    },
                    "bInfo": true,
                    "paging": true,
                    "scrollX": "1080px",
                    "scrollCollapse": true,
                    "lengthChange": false,
                    "iDisplayLength": 15,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    language: language,
                    "columnDefs": [
                        {"targets": 1, "orderable": false, "searchable": false},
                        {"targets": 2, "orderable": false, "searchable": false},
                        {"targets": 3, "orderable": false, "searchable": false}
                    ]
                });
            });
            $(document).on('click', '.btn_detail_sell', function () {
                var ref_id = this.value;
                $('#modal_ord_id').val(ref_id);
                $('#ModalDetail').modal('show');
            });

            //================================================ FIND PRODUCT ================================================
            $(document).on('click', '#findPro', function () {
                var unit_id = $('#unit_id_find').val();
                var state = chkUnit(unit_id);
                if (state === "ok") {
                    $.ajax({
                        url: "ajax/sell/find_product.php",
                        type: "post",
                        dataType: "json",
                        data: {unit_id: unit_id},
                        success: function (rs) {
                            var element = '';
                            if (rs.rows === 0) {
                                unit = jQuery.grep(unit, function (value) {
                                    return value !== unit_id;
                                });
                                $('#unit_id_find').val("");
                                alert("ไม่พบข้อมูลสินค้า");
                            } else {
                                element += '<tr id="row' + i + '" class="sell_rows" style="text-align:center;"><td><input type="text" style="text-align:center;" name="Unit_ID[]" class="form-control font_3" value="' + rs.unit_id + '" readonly=""/></td>';
                                element += '<td><input type="text" style="text-align:center;" name="Pname[]" class="form-control font_3" value="' + rs.pname + '" readonly=""/></td>';
                                element += '<td><input type="text" style="text-align:center;" name="sid_send[]" class="form-control font_3" value="' + rs.s_id + '" readonly=""/></td>';
                                element += '<td><input type="text" style="text-align:center;" name="P_Price[]" class="form-control font_3" value="' + rs.price + '" readonly=""/></td>';
                                element += '<td><input type="text" style="text-align:center;" name="Warranty[]" class="form-control font_3" value="' + rs.war + '" readonly=""/></td>';
                                element += '<td><button type="button" onclick="removeInput(\'' + rs.unit_id + '\',\'' + rs.price + '\')" name="remove" id="' + i + '" class="btn bg-red-gradient btn_remove"><span class="fa fa-close"></span></button>';
                                element += '<input type="hidden" name="pid_send[]" value="' + rs.pid + '"/>';
                                element += '<input type="hidden" name="endwar_send[]" value="' + rs.end_war + '"/>';
                                element += '<input type="hidden" name="dateR_send[]" value="' + rs.dateR + '"/>';
                                element += '<input type="hidden" name="dateE_send[]" value="' + rs.dateE + '"/>';
                                element += '</td></tr>';
                                $('#tableSell').append(element);
                                i++;
                                total_money += parseInt(rs.price);
                                $('#repair_sell_total').val(total_money);
                                //$('#unit_id').val("");
                                $('#unit_id_find').val("");
                            }
                        }
                    });
                } else {
                    alert("รหัสสินค้า : " + state + " ถูกเลือกแล้ว");
                    $('#unit_id_find').val("");
                }
            });
            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        });
        function loadDetail() {
            var item_id = $('#hidden_item_id').val();
            $.ajax({
                url: "ajax/mywork/select_repair_detail.php",
                type: "post",
                dataType: "html",
                data: {item_id: item_id},
                success: function (data) {
                    $('#repair_detail').html(data);
                }
            });
        }
        ;
        function chk_confirm() {
            var item_id = $('#hidden_item_id').val();
            $.ajax({
                url: "ajax/mywork/check_confirm.php",
                type: "post",
                data: {item_id: item_id},
                success: function (data) {
                    var num = parseInt(data);
                    if (num > 0) {
                        $('#btn_confirm_repair').removeAttr("disabled");
                    } else if (num === 0) {
                        $('#btn_confirm_repair').attr("disabled", true);
                    }
                }
            });
        }
        ;
        function setCus() {
            var item_id = $('#hidden_item_id').val();
            $.ajax({
                url: "ajax/mywork/find_customer.php",
                type: "post",
                data: {item_id: item_id},
                success: function (data) {
                    $('#repair_sell_cus').val(data);
                }
            });
        }
        ;
        function setORD() {
            $.ajax({
                url: "ajax/sell/set_ord_id.php",
                success: function (data) {
                    $('#repair_sell_ord_id').val(data);
                }
            });
        }
        ;
        function chkUnit(unit_id) {
            var sunit = unit.sort();
            unit.push(unit_id);
            var state = "ok";
            for (var k = 0; k < sunit.length - 1; k++) {
                if (unit_id === sunit[k]) {
                    state = sunit[k];
                    break;
                }
            }
            //console.log(state);
            return state;
        }
        ;
        function removeInput(unit_id, price) {
            total_money = total_money - parseInt(price);
            $('#repair_sell_total').val(total_money);
            unit = jQuery.grep(unit, function (value) {
                return value !== unit_id;
            });
        }
        ;
    </script>
</body>

</html>
