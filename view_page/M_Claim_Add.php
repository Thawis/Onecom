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
        <!-- iCheck -->
        <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css"/>
        <!-- Select 2 -->
        <link href="../plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <title>รับเข้าสินค้าเคลม</title>
        <style>
            .dataTables_filter{
                display: none;
            }
            #tableClaim_wait thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableClaim_wait td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableClaim_OK thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableClaim_OK td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 12px; 
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
                font-size: 14px; 
                font-family: Tahoma;
                /*font-weight: bold;*/
            }
            #table-product td{
                vertical-align: middle;
                font-style: normal;
                font-size: 14px; 
                text-align: center;
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
                <span class="fa fa-sign-in"></span> รับเข้าสินค้าเคลม
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>รายการรับเข้า</li>
                <li class="active" >รับเข้าสินค้าเคลม</li>
            </ol>
        </section>
        <section class="content" style="height:1600px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title"></h3>
                        </div>    
                        <div class="content">
                            <div class="box-body">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#t_wait" data-toggle="tab"><i class="fa fa-list-alt"></i> รายการเคลมสินค้ารอรับเข้า</a></li>
                                    <li><a href="#t_success"  data-toggle="tab"><i class="fa fa-check-square-o"></i> รายการสินค้าเคลมเรียบร้อย</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="t_wait" class="tab-pane in active fade">
                                        <div class="col-md-12" style="margin-top:10px; margin-bottom: 10px;">                                            
                                            <div class="input-group center-block" style="width:50%;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="txt_findwar" name="txt_findwar" placeholder="ค้นหารายการเคลม ..." required="">
                                                    <div class="input-group-btn">
                                                        <button type="submit" class="btn bg-purple-gradient btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                        <table id="tableClaim_wait" class="table table-bordered table-hover">
                                            <thead>
                                                <tr  class="bg-purple-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 14px; font-weight: bold; font-family: Tahoma;">
                                                    <td width="10%">ลำดับ</td>
                                                    <td width="15%">เลขที่ใบเคลม</td>
                                                    <td width="25%">ชื่อสินค้า และ S/N</td>
                                                    <td width="20%">ตัวแทนขายที่ส่งเคลม</td>
                                                    <td width="15%">ประเภทของเคลม</td>
                                                    <td width="10%"></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div id="t_success" class="tab-pane">
                                        <div class="col-md-12" style="margin-top:10px;">                                            
                                            <div class="input-group center-block" style="width:50%;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="txtClaimList" name="txtClaimList" placeholder="ค้นหา : เลขที่ใบเคลม.. ชื่อลูกค้า..">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn bg-blue-gradient btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                        <table id="tableClaim_OK" class="table table-bordered table-hover">
                                            <thead>
                                                <tr  class="bg-blue-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                                    <td width="10%">ลำดับ</td>
                                                    <td width="15%">เลขที่ใบเคลม</td>
                                                    <td width="20%">ชื่อลูกค้า</td>
                                                    <td width="15%">สถานะ</td>
                                                    <td width="10%">รายละเอียด</td>
                                                    <td width="20%"></td>
                                                </tr>
                                            </thead>
                                        </table>
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
    <!-- /.content-wrapper -->
    <!-- Modal Item -->
    <div class="modal fade" id="Modal_ClaimItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_claim_i">
                    <div class="modal-header bg-blue-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-save"></span> รับเข้าสินค้าเคลม</h4>
                    </div>
                    <input type="hidden" id="hidden_name" value=""/>
                    <input type="hidden" id="hidden_sn" value=""/>
                    <input type="hidden" id="hidden_cid" value=""/>
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover" id="table_item">

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-blue-gradient">บันทึกข้อมูล</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal ETC -->
    <div class="modal fade" id="Modal_ETC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_etc">
                    <div class="modal-header bg-blue-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-save"></span> รับเข้าสินค้าเคลม</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover" id="">
                                    <tr>
                                        <td width="30%" class="font_1" style="vertical-align:middle;"> เลขที่ใบเคลม : </td>
                                        <td width="35%"><input type="text" class="form-control" id="etc_c_id" name="etc_c_id" value="" readonly=""/></td>
                                        <td width="15%"></td>
                                        <td width="20%"></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="font_1" style="vertical-align:middle;"> ชื่อสินค้า : </td>
                                        <td width="50%" colspan="2"><input type="text" class="form-control" id="etc_name_old" name="etc_name_old" value="" readonly=""/></td>
                                        <td width="20%"></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="font_1" style="vertical-align:middle;"> S/N (เก่า) : </td>
                                        <td width="50%" colspan="2"><input type="text" class="form-control" id="etc_sn_old" name="etc_sn_old" value="" readonly=""/></td>
                                        <td width="20%"></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="font_1" style="vertical-align:middle;"> ข้อเสนอ : </td>
                                        <td width="50%" colspan="2">
                                            <textarea class="form-control" id="etc_detail" name="etc_detail" rows="4" required=""></textarea>
                                        </td>
                                        <td width="20%"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-blue-gradient">บันทึกข้อมูล</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Detail -->
    <div class="modal fade" id="Modal_Detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="">
                    <div class="modal-header bg-aqua-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-info-circle"></span> รายละเอียดการเคลมสินค้า</h4>
                    </div>
                    <input type="hidden" id="detail_cid" value=""/>
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover" id="tableDetail">
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
    <!-- Modal ClaimItem Shop -->
    <div class="modal fade" id="Modal_ClaimItem_Shop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="import_item_claim">
                    <div class="modal-header bg-blue-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-save"></span> เข้าสินค้าเคลมของร้าน</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-default">
                            <input hidden=""/>
                            <div class="box-body">
                                <input type="hidden" id="ex_new_pid" name="ex_new_pid" value=""/>
                                <input type="hidden" id="ex_new_uid" name="ex_new_uid" value=""/>
                                <table class="table table-responsive table-hover" id="">
                                    <tbody>
                                        <tr>
                                            <td width="15%" class="font_1" style="vertical-align:middle;">เลขที่ใบเคลม : </td>
                                            <td width="35%"><input type="text" class="form-control" readonly="" id="ex_claim_id" name="ex_claim_id" value=""/></td>
                                            <td width="15%"></td>
                                            <td width="35%"></td>
                                        </tr>
                                        <tr>
                                            <td width="15%" class="font_1" style="vertical-align:middle;">ชื่อสินค้า (เก่า) : </td>
                                            <td width="35%"><input type="text" class="form-control" readonly="" id="ex_old_pname" name="ex_old_pname" value=""/></td>
                                            <td width="15%" class="font_1" style="vertical-align:middle;">S/N (เก่า) : </td>
                                            <td width="35%"><input type="text" class="form-control" readonly="" id="ex_old_sn" name="ex_old_sn" value=""/></td>
                                        </tr>
                                        <tr>
                                            <td width="15%" class="font_1" style="vertical-align:middle;">ชื่อสินค้า (ใหม่) : </td>
                                            <td width="35%"><input type="text" class="form-control" required="" id="ex_new_pname" name="ex_new_pname" value=""/></td>
                                            <td width="15%" class="font_1" style="vertical-align:middle;">S/N (ใหม่) : </td>
                                            <td width="35%"><input type="text" class="form-control" required="" id="ex_new_sn" name="ex_new_sn"/></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-blue-gradient">บันทึกรับเข้าสินค้า</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal find product -->
    <div class="modal fade" id="ModalFind" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form-find">
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-family: Tahoma;"><span class="fa fa-list"></span> รายการสินค้า</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-solid">
                            <div class="box-header bg-green-gradient">
                                <h3 class="box-title" style="font-style: normal; font-size: 19px;"><span class="fa fa-search"></span> ค้นหารายการสินค้า</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-hover">
                                    <tr>
                                        <td width="20%" style="vertical-align: middle; text-align: right;">ประเภทสินค้าหลัก : </td>
                                        <td width="30%" style="vertical-align: middle;"><select class="form-control select2" id="ddlgroup" style="width:100%"></select></td>
                                        <td width="20%" style="vertical-align: middle; text-align: right;">ประเภทสินค้าย่อย : </td>
                                        <td width="30%" style="vertical-align: middle;"><select class="form-control select2" id="ddlsubgroup" style="width:100%"></select></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: center;">
                                    <center><div class="input-group" style="width: 60%">
                                            <input type="text" id="txtSearch" class="form-control" placeholder="ค้นหาข้อมูล...">
                                            <span class="input-group-btn">
                                                <button class="btn bg-green-gradient" type="button" id="btntest">ค้นหา</button>
                                            </span>
                                        </div></center>
                                    </td>
                                    </tr>
                                </table>
                            </div>
                        </div>                   
                        <table id="table-product" class="table table-bordered table-hover table-responsive" >
                            <thead>
                                <tr class="bg-green-gradient" style="vertical-align: middle; font-style: normal; font-size: 14px; font-weight: bold;">
                                    <td width="10%" style="text-align:center;">ลำดับ</td>
                                    <td width="15%" style="text-align:center;">รหัสสินค้า</td>
                                    <td width="30%" style="text-align:center;">ชื่อสินค้า</td>
                                    <td width="15%" style="text-align:center;">ยี่ห้อ</td>
                                    <td width="20%" style="text-align:center;">ประเภทสินค้า</td>
                                    <td width="10%" style="text-align:center;"></td>
                                </tr>
                            </thead>
                        </table>         
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
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script src="script/global.js" type="text/javascript"></script>
    <script src="script/dateRange.js" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <script>
        var tableClaim_wait;
        var tableClaim_OK;
        var tableProduct;
        $(function () {
            $('.select2').select2();
            $('#txt_findwar').keyup(function () {
                tableClaim_wait.search(this.value).draw();
            });
            $('#txtClaimList').keyup(function () {
                tableClaim_OK.search(this.value).draw();
            });
            $('.btn_re_load').on('click', function () {
                location.reload();
            });
            tableClaim_wait = $("#tableClaim_wait").DataTable({
                "ajax": "ajax/claim_import/select_claim_wait.php",
                "scrollCollapse": true,
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                language: language,
                "columnDefs": [
                    {"targets": 0, "orderable": true, "searchable": false},
                    {"targets": 5, "orderable": false, "searchable": false}
                ]
            });
            tableClaim_OK = $("#tableClaim_OK").DataTable({
                "ajax": "ajax/claim_import/select_claim_ok.php",
                "scrollCollapse": true,
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                language: language,
                "columnDefs": [
                    {"targets": 0, "orderable": true, "searchable": false},
                    {"targets": 5, "orderable": false, "searchable": false}
                ]
            });
            $(document).on('click', '.btn_detail', function () {
                var cid = this.value;
                $('#detail_cid').val(cid);
                $('#Modal_Detail').modal('show');
            });
            $(document).on('click', '.btn_return', function () {
                var cid = this.value;
                var r = confirm("ยืนัยนการบันทึกข้อมูลการส่งคืนสินค้าเคลม");
                if (r === true) {
                    $.ajax({
                        url: "ajax/claim_import/return_claim.php",
                        type: "post",
                        data: {cid: cid},
                        success: function (rs) {
                            console.log(rs);
                            if (rs === "ok") {
                                alert("บันทึกข้อมูลการส่งคืนสินค้าเคลมเรียบร้อย");
                                tableClaim_OK.ajax.reload();
                            } else {
                                alert("ไม่สามารถบันทึกข้อมูลการส่งคืนสินค้าเคลมได้");
                            }
                        }
                    });
                }
            });
            $('#form_claim_i').on('submit', function (e) {
                e.preventDefault();
                var data = $('#form_claim_i').serialize();
                var r = confirm("ยืนยันการบันทึกข้อมูลรับเข้าสินค้าเคลม");
                if (r === true) {
                    $.ajax({
                        url: "ajax/claim_import/insert_item_claim.php",
                        type: "post",
                        data: data,
                        success: function (rs) {
                            if (rs === "ok") {
                                alert("บันทึกข้อมูลการรับเข้าสินค้าเคลมเรียบร้อย");
                                tableClaim_wait.ajax.reload();
                                tableClaim_OK.ajax.reload();
                                $('#Modal_ClaimItem').modal('hide');
                            } else {
                                alert("ไม่สามารถบันทึกข้อมูลการรับเข้าสินค้าเคลมได้");
                            }
                        }
                    });
                }
            });
            $('#import_item_claim').on('submit', function (e) {
                e.preventDefault();
                var data = $('#import_item_claim').serialize();
                var r = confirm("ยืนยันการบันทึกข้อมูลรับเข้าสินค้าเคลม");
                if (r === true) {
                    $.ajax({
                        url: "ajax/claim_import/insert_item_claim_shop.php",
                        type: "post",
                        data: data,
                        success: function (rs) {
                            if (rs === "ok") {
                                alert("บันทึกข้อมูลการรับเข้าสินค้าเคลมเรียบร้อย");
                                tableClaim_wait.ajax.reload();
                                tableClaim_OK.ajax.reload();
                                $('#Modal_ClaimItem_Shop').modal('hide');
                            } else {
                                alert("ไม่สามารถบันทึกข้อมูลการรับเข้าสินค้าเคลมได้");
                            }
                        }
                    });
                }
            });
            $('#form_etc').on('submit', function (e) {
                e.preventDefault();
                var data = $('#form_etc').serialize();
                var r = confirm("ยืนยันการบันทึกข้อมูลรับเข้าสินค้าเคลม");
                if (r === true) {
                    $.ajax({
                        url: "ajax/claim_import/insert_etc_claim.php",
                        type: "post",
                        data: data,
                        success: function (rs) {
                            if (rs === "ok") {
                                alert("บันทึกข้อมูลการรับเข้าสินค้าเคลมเรียบร้อย");
                                tableClaim_wait.ajax.reload();
                                tableClaim_OK.ajax.reload();
                                $('#Modal_ETC').modal('hide');
                            } else {
                                alert("ไม่สามารถบันทึกข้อมูลการรับเข้าสินค้าเคลมได้");
                            }
                        }
                    });
                }
            });
            $('#Modal_Detail').on('shown.bs.modal', function () {
                var cid = $('#detail_cid').val();
                $.ajax({
                    url: "ajax/claim_import/select_detail_cliam_all.php",
                    type: "post",
                    dataType: "html",
                    data: {cid: cid},
                    success: function (data) {
                        $('#tableDetail').html(data);
                    }
                });
            });
            $('#Modal_ClaimItem').on('shown.bs.modal', function () {
                var name = $('#hidden_name').val();
                var sn = $('#hidden_sn').val();
                var c_id = $('#hidden_cid').val();
                $.ajax({
                    url: "ajax/claim_import/select_detail.php",
                    type: "post",
                    dataType: "html",
                    data: {name: name, sn: sn, c_id: c_id},
                    success: function (data) {
                        $('#table_item').html(data);
                    }
                });
            });
            $('#ModalFind').on('shown.bs.modal', function () {
                loadAll();
                $('#txtSearch').keyup(function () {
                    tableProduct.search(this.value).draw();
                });
                //  LOAD Dropdown Group
                $.ajax({
                    url: 'ajax/Product/select_type_dropdown.php',
                    dataType: 'JSON',
                    success: function (data) {
                        $('#ddlgroup').empty();
                        $('#ddlsubgroup').empty();
                        $('#ddlsubgroup').append('<option id="All" value="All">All</option>');
                        $('#ddlgroup').append('<option id="All" value="All">All</option>');
                        $.each(data, function (key, val) {
                            $('#ddlgroup').append('<option id="' + val.id + '" value="' + val.id + '">' + val.name + '</option>');
                        });
                    }
                });
                // Dropdown Group Change
                $('#ddlgroup').on('change', function () {
                    $('#ddlsubgroup').empty();
                    var id = this.value;
                    $.ajax({
                        url: 'ajax/Product/select_type_dropdown.php',
                        type: "get",
                        data: {type: id},
                        dataType: 'JSON',
                        success: function (data) {
                            $('#ddlsubgroup').empty();
                            $('#ddlsubgroup').append('<option id="All" value="All">All</option>');
                            $.each(data, function (key, val) {
                                $('#ddlsubgroup').append('<option id="' + val.id + '" value="' + val.id + '">' + val.name + '</option>');
                            });
                        }
                    });
                    var sub = $('#ddlsubgroup').val();
                    loadData(id, sub);
                });
                // Dropdown SubGroup Change
                $('#ddlsubgroup').on('change', function () {
                    var sub = this.value;
                    var id = $('#ddlgroup').val();
                    loadData(id, sub);
                });
            });
        });

        function ClaimItem(item_name, sn, c_id) {
            $('#hidden_name').val(item_name);
            $('#hidden_sn').val(sn);
            $('#hidden_cid').val(c_id);
            $('#Modal_ClaimItem').modal('show');
        }
        ;
        function ClaimETC(item_name, sn, c_id) {
            $('#etc_name_old').val(item_name);
            $('#etc_sn_old').val(sn);
            $('#etc_c_id').val(c_id);
            $('#Modal_ETC').modal('show');
        }
        ;
        function ClaimEX(item_name, sn, c_id) {
            //console.log(item_name, sn, c_id);
            $('#ex_claim_id').val(c_id);
            $('#ex_old_pname').val(item_name);
            $('#ex_old_sn').val(sn);
            $('#ModalFind').modal('show');
        }
        ;
        function setPid(pid, pname, unitid) {
            //console.log(pid, pname, unitid);
            $('#ex_new_pname').val(pname);
            $('#ex_new_pid').val(pid);
            $('#ex_new_uid').val(unitid);
            $('#ex_new_sn').val('');
            $("body.sidebar-mini").removeAttr("style");
            $('#Modal_ClaimItem_Shop').modal('show');
        }
        ;
        function loadAll() {
            $("#table-product").dataTable().fnDestroy();
            tableProduct = $("#table-product").DataTable({
                "ajax": "ajax/import/select_product.php",
                "sScrollY": "450px",
                "bScrollCollapse": true,
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    {"targets": 5, "orderable": false, "searchable": false}],
                language: language
            });
        }
        ;
        function loadData(id, sub) {
            $("#table-product").dataTable().fnDestroy();
            tableProduct = $("#table-product").dataTable({
                //"destroy": true,
                ajax: {
                    url: "ajax/import/select_sg_product.php",
                    type: "get",
                    data: {id: id, sub: sub}
                },
                "sScrollY": "450px",
                "bScrollCollapse": true,
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    {"targets": 5, "orderable": false, "searchable": false}],
                language: language,
            });
        }
        ;
        function sendSMS(tel, mess, c_id) {
            var r = confirm("ยืนยันการส่งข้อความแจ้งเตือนสินค้าเคลม");
            if (r === true) {
                $.ajax({
                    url: "ajax/sms/check_credit_sms.php",
                    success: function (data) {
                        if (data === 'ok') {
                            $.ajax({
                                url: "ajax/sms/sms_send_repair.php",
                                type: "post",
                                data: {mess: mess, tel: tel},
                                success: function (data) {
                                    if (data === "ok") {
                                        updateSMS(tel, mess, c_id);
                                    } else {
                                        alert('ไม่สามารถส่ง sms ได้');
                                    }
                                }
                            });
                        } else {
                            alert('ไม่สามารถส่ง sms ได้');
                        }
                    }
                });
            }
        }
        ;
        function updateSMS(tel, mess, c_id) {
            $.ajax({
                url: "ajax/claim_import/insert_sms.php",
                type: "post",
                data: {tel: tel, mess: mess, c_id: c_id},
                success: function (data) {
                    if (data === "ok") {
                        alert("ส่ง SMS เรียบร้อย");
                    } else {
                        alert("ไม่สามารถส่ง SMS ได้")
                    }
                }
            });
        }
        ;

    </script>
</body>

</html>
