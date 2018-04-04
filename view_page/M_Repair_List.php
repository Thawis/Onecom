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
        <title>รายการงานซ่อม</title>
        <style>
            .dataTables_filter{
                display: none;
            }
            #tableRepairList thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableRepairList td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableRepairDetail thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableRepairDetail td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableCancel thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableCancel td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableItem thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableItem td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableDetail td{
                vertical-align:middle; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableDetailAdd td{
                vertical-align:middle; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableEditItem td{
                vertical-align:middle; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            .font_1{
                text-align: right;
                font-size: 14px;
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
                <span class="fa fa-list-alt"></span> รายการงานซ่อม
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>งานซ่อม</li>
                <li class="active">รายการงานซ่อม</li>
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
                                    <li class="active"><a href="#t_repair_list" data-toggle="tab"><i class="fa fa-list-alt"></i> รายการงานซ่อมปกติ</a></li>
                                    <li><a href="#t_repair_detail"  data-toggle="tab"><i class="fa fa-list-ul"></i> รายละเอียดรับซ่อม</a></li>
                                    <?php if ($_SESSION['login_type'] == "admin" || $_SESSION['login_type'] == "root") { ?>
                                        <li><a href="#t_repair_cancel"  data-toggle="tab"><i class="fa fa-close"></i> รายการซ่อมที่ยกเลิก</a></li>
                                    <?php } ?>
                                </ul>
                                <div class="tab-content">
                                    <div id="t_repair_list" class="tab-pane in active fade">
                                        <div class="col-md-6" style="margin-top:10px;">
<!--                                            <button type="button" id="filter_sell" class="btn bg-green-gradient" data-toggle="modal" data-target="#ModalFilter"><span class="fa fa-filter"> ตัวกรองข้อมูล</span></button>-->
                                        </div>
                                        <div class="col-md-6" style="margin-top:10px;">                                            
                                            <div class="input-group pull-right" style="width:100%;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="txtSearch_list" name="txtSearch_list" placeholder="ค้นหา : เลขที่ใบรับซ่อม, เลขที่สินค้าซ่อม">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn bg-green-gradient btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                        <table id="tableRepairList" class="table table-bordered table-hover">
                                            <thead>
                                                <tr  class="bg-green-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                                    <td width="10%">ลำดับ</td>
                                                    <td width="15%">เลขที่ใบรับซ่อม</td>
                                                    <td width="15%">เลขที่สินค้าซ่อม</td>
                                                    <td width="15%">วันที่รับซ่อม</td>
                                                    <td width="20%">เพิ่มโดย</td>
                                                    <td width="12%">สถานะ</td>
                                                    <td width="13%">รายละเอียด</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div id="t_repair_detail" class="tab-pane fade">
                                        <div class="col-md-6" style="margin-top:10px; margin-bottom: 2px;">
<!--                                            <button type="button" id="filter_sell" class="btn bg-green-gradient" data-toggle="modal" data-target="#ModalFilter"><span class="fa fa-filter"> ตัวกรองข้อมูล</span></button>-->
                                        </div>
                                        <div class="col-md-6" style="margin-top:10px; margin-bottom: 2px;">                                
                                            <div class="input-group pull-right" style="width:100%;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="txtSearch_detail" name="txtSearch_detail" placeholder="ค้นหา : เลขที่ใบรับซ่อม ...">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn bg-green-gradient btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                        <table id="tableRepairDetail" class="table table-bordered table-hover">
                                            <thead>
                                                <tr  class="bg-green-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                                    <td width="10%">ลำดับ</td>
                                                    <td width="20%">เลขที่ใบรับซ่อม</td>
                                                    <td width="15%">วันที่รับซ่อม</td>
                                                    <td width="20%">เพิ่มโดย</td>
                                                    <td width="35%"></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <?php if ($_SESSION['login_type'] == "admin" || $_SESSION['login_type'] == "root") { ?>
                                        <div id="t_repair_cancel" class="tab-pane fade">
                                            <div class="col-md-6" style="margin-top:10px; margin-bottom: 2px;">
    <!--                                            <button type="button" id="filter_sell" class="btn bg-green-gradient" data-toggle="modal" data-target="#ModalFilter"><span class="fa fa-filter"> ตัวกรองข้อมูล</span></button>-->
                                            </div>
                                            <div class="col-md-6" style="margin-top:10px; margin-bottom: 2px;">                                
                                                <div class="input-group pull-right" style="width:100%;">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="txtSearch_cancel" name="txtSearch_cancel" placeholder="ค้นหา : เลขที่ใบรับซ่อม ...">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn bg-red-gradient btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                                        </div>
                                                    </div>
                                                </div>                                           
                                            </div>
                                            <table id="tableCancel" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr  class="bg-red-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                                        <td width="10%">ลำดับ</td>
                                                        <td width="15%">เลขที่ใบรับซ่อม</td>
                                                        <td width="15%">เลขที่สินค้าซ่อม</td>
                                                        <td width="15%">วันที่รับซ่อม</td>
                                                        <td width="20%">เพิ่มโดย</td>
                                                        <td width="12%">สถานะ</td>
                                                        <td width="13%"></td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    <?php } ?>
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
    <!-- Modal Detail -->
    <div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="">
                    <div class="modal-header bg-aqua-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-info-circle"></span> รายละเอียดงานซ่อม</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="modal_item_id" value=""/>
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
    <!-- Modal Detail ADD-->
    <div class="modal fade" id="ModalDetailAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="">
                    <div class="modal-header bg-aqua-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-info-circle"></span> รายละเอียดรายการรับซ่อม</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="modal_rid" value=""/>
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover" id="tableDetailAdd">
                                </table>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table table-responsive table-hover table-bordered" id="tableItem">
                                <thead>
                                    <tr class="bg-aqua-gradient" style="text-align:center;">
                                        <!--<td width="10%">ลำดับ</td>-->
                                        <td width="15%">เลขที่สินค้าซ่อม</td>
                                        <td width="15%">ชื่อสินค้า</td>
                                        <td width="15%">S/N</td>
                                        <td width="20%">อาการเสีย &<br> สิ่งที่ให้ทำ</td>                                           
                                        <td width="15%">สถานะ</td>
                                        <td width="20%"></td>
                                    </tr>   
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Detail Edit-->
    <div class="modal fade" id="ModalDetailEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_edit_item">
                    <div class="modal-header bg-yellow-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-pencil"></span> แก้ไขรายละเอียดสินค้าซ่อม</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="modal_edit_item_id" value=""/>
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover" id="tableEditItem">
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-yellow-gradient">แก้ไขข้อมูล</button>
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
    <script>
        var tableList;
        var tableDetail;
        var tableItem;
        var tableCancel;
        $(function () {
            $('#txtSearch_list').keyup(function () {
                tableList.search(this.value).draw();
            });
            $('#txtSearch_detail').keyup(function () {
                tableDetail.search(this.value).draw();
            });
            $('#txtSearch_cancel').keyup(function () {
                tableCancel.search(this.value).draw();
            });
            $(document).on('click', '.btn_re_load', function () {
                location.reload();
            });
            tableList = $("#tableRepairList").DataTable({
                "ajax": "ajax/repair/select_repair_list.php",
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    {"targets": 0, "orderable": true, "searchable": false},
                    {"targets": 4, "orderable": true, "searchable": true},
                    {"targets": 6, "orderable": false, "searchable": false}],
                language: language
            });
            tableDetail = $("#tableRepairDetail").DataTable({
                "ajax": "ajax/repair/select_repair_list_add.php",
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    {"targets": 0, "orderable": true, "searchable": false},
                    {"targets": 4, "orderable": false, "searchable": false}],
                language: language
            });
            tableCancel = $("#tableCancel").DataTable({
                "ajax": "ajax/repair/select_repair_list_cancel_table.php",
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    {"targets": 0, "orderable": true, "searchable": false},
                    {"targets": 5, "orderable": false, "searchable": false},
                    {"targets": 6, "orderable": false, "searchable": false}],
                language: language
            });
            $('#form_edit_item').on('submit', function (e) {
                e.preventDefault();
                var item_id = $('#fedit_itemid').val();
                var type_item = $('#fedit_typeitem').val();
                var sn = $('#fedit_sn').val();
                if (type_item === 'NoteBook') {
                    if (sn === "") {
                        alert("สินค้าซ่อมประเภท NoteBook ต้องใส่ SerialNumber ทุกครั้ง");
                    } else {
                        var r = confirm("ยืนยันการแก้ไขข้อมูลสินค้าซ่อมเลขที่ : " + item_id);
                        if (r === true) {
                            $.ajax({
                                url: "ajax/repair/edit_repair_item.php",
                                method: "POST",
                                data: $('#form_edit_item').serialize(),
                                success: function (data) {
                                    if (data === "ok") {
                                        alert("แก้ไขข้อมูลสินค้าซ่อมเรียบร้อย");
                                        tableDetail.ajax.reload();
                                        tableList.ajax.reload();
                                        tableItem.ajax.reload();
                                        $('#ModalDetailEdit').modal("hide");
                                    } else {
                                        alert("ไม่สามารถแก้ไขข้อมูลสินค้าซ่อมได้");
                                    }
                                }
                            });
                        }
                    }
                } else {
                    var r = confirm("ยืนยันการแก้ไขข้อมูลสินค้าซ่อมเลขที่ : " + item_id);
                    if (r === true) {
                        $.ajax({
                            url: "ajax/repair/edit_repair_item.php",
                            method: "POST",
                            data: $('#form_edit_item').serialize(),
                            success: function (data) {
                                if (data === "ok") {
                                    alert("แก้ไขข้อมูลสินค้าซ่อมเรียบร้อย");
                                    tableDetail.ajax.reload();
                                    tableList.ajax.reload();
                                    tableItem.ajax.reload();
                                    $('#ModalDetailEdit').modal("hide");
                                } else {
                                    alert("ไม่สามารถแก้ไขข้อมูลสินค้าซ่อมได้");
                                }
                            }
                        });
                    }
                }
            });

            $('#ModalDetail').on('shown.bs.modal', function () {
                var item_id = $('#modal_item_id').val();
                $.ajax({
                    url: "ajax/repair/select_repair_detail.php",
                    type: "post",
                    dataType: "html",
                    data: {item_id: item_id},
                    success: function (data) {
                        $('#tableDetail').html(data);
                    }
                });
            });
            $('#ModalDetailAdd').on('shown.bs.modal', function () {
                var r_id = $('#modal_rid').val();
                $.ajax({
                    url: "ajax/repair/select_repair_detail_add.php",
                    type: "post",
                    dataType: "html",
                    data: {r_id: r_id},
                    success: function (data) {
                        $('#tableDetailAdd').html(data);
                    }
                });
                tableItem = $('#tableItem').DataTable({
                    destroy: true,
                    ajax: {
                        url: "ajax/repair/select_repair_item_table.php",
                        type: "post",
                        data: {r_id: r_id}
                    },
                    "bInfo": true,
                    "paging": true,
                    "lengthChange": false,
                    "iDisplayLength": 15,
                    "searching": false,
                    "ordering": false,
                    "info": true,
                    "autoWidth": false,
                    language: language
                });
            });
            $('#ModalDetailEdit').on('shown.bs.modal', function () {
                var item_id = $('#modal_edit_item_id').val();
                $.ajax({
                    url: "ajax/repair/select_repair_detail_edit.php",
                    type: "post",
                    dataType: "html",
                    data: {item_id: item_id},
                    success: function (data) {
                        $('#tableEditItem').html(data);
                    }
                });
            });
            $(document).on('click', '.btn_detail_add', function () {
                $('#ModalDetailAdd').modal('show');
                $('#modal_rid').val(this.value);
            });
            $(document).on('click', '.btn_cancel_add', function () {
                var r_id = this.value;
                var r = confirm("ยืนยันการยกเลิกรายการรับซ่อมที่เลขที่ : " + r_id);
                if (r === true) {
                    $.ajax({
                        url: "ajax/repair/remove_repair_list.php",
                        type: "post",
                        data: {r_id: r_id},
                        success: function (data) {
                            if (data === "ok") {
                                alert("ยกเลิกรายการรับซ่อมเรียบร้อย");
                                tableDetail.ajax.reload();
                                tableList.ajax.reload();
                                tableCancel.ajax.reload();
                            } else if (data === "not") {
                                alert("ไม่สามารถยกเลิกรายการได้ :: เนื่องจากสินค้าในรายการรับเข้าได้อยู่ในระหว่างซ่อม ซ่อมเสร็จแล้ว หรือ ส่งคืนแล้ว");
                            }
                        }
                    });
                }
            });
            $(document).on('click', '.btn_addrepair', function () {
                var item_id = this.value;
                var r = confirm("ยืนยันการรับงานซ่อมเลขที่สินค้าซ่อม");
                if (r === true) {
                    $.ajax({
                        url: "ajax/repair/add_item_repair.php",
                        type: "post",
                        data: {item_id: item_id},
                        success: function (data) {
                            if (data === "ok") {
                                alert("รับงานซ่อมเลขที่สินค้าซ่อม : " + item_id + " เรียบร้อย");
                                tableList.ajax.reload();
                                $('#ModalDetail').modal("hide");
                            }
                        }
                    });
                }
            });
            $(document).on('click', '.btn_rdetail', function () {
                $('#ModalDetail').modal('show');
                $('#modal_item_id').val(this.value);
            });
            $(document).on('click', '.btn_detail_item', function () {
                $('#ModalDetailAdd').modal('hide');
                $("body.sidebar-mini").removeAttr("style");
                $('#modal_item_id').val(this.value);
                $('#ModalDetail').modal('show');
            });
            $(document).on('click', '.btn_edit_item', function () {
                $('#ModalDetailAdd').modal('hide');
                $("body.sidebar-mini").removeAttr("style");
                $('#modal_edit_item_id').val(this.value);
                $('#ModalDetailEdit').modal('show');
            });
            $(document).on('click', '.btn_open_item', function () {
                var item_id = this.value;
                var r = confirm("ยืนยันการเปิดรับซ่อมสินค้าเลขที่ : " + item_id);
                if (r === true) {
                    $.ajax({
                        url: "ajax/repair/open_repair_item.php",
                        type: "post",
                        data: {item_id: item_id},
                        success: function (data) {
                            if (data === "ok") {
                                alert("เปิดรับซ่อมสินค้าเรียบร้อย");
                                tableDetail.ajax.reload();
                                tableList.ajax.reload();
                                tableCancel.ajax.reload();
                                tableItem.ajax.reload();
                                $('#ModalDetailEdit').modal('hide');
                            } else if (data !== "ok") {
                                alert("ไม่สามารถเปิดการรับซ่อมสินค้าได้");
                            }
                        }
                    });
                }
            });
            $(document).on('click', '.btn_open_cancel', function () {
                var item_id = this.value;
                var r = confirm("ยืนยันการเปิดรับซ่อมสินค้าเลขที่ : " + item_id);
                if (r === true) {
                    $.ajax({
                        url: "ajax/repair/open_repair_item.php",
                        type: "post",
                        data: {item_id: item_id},
                        success: function (data) {
                            if (data === "ok") {
                                alert("เปิดรับซ่อมสินค้าเรียบร้อย");
                                tableDetail.ajax.reload();
                                tableList.ajax.reload();
                                tableCancel.ajax.reload();
                            } else if (data !== "ok") {
                                alert("ไม่สามารถเปิดการรับซ่อมสินค้าได้");
                            }
                        }
                    });
                }
            });
            $(document).on('click', '.btn_cancel_item', function () {
                var item_id = this.value;
                var r = confirm("ยืนยันการยกเลิกซ่อมสินค้าเลขที่ : " + item_id);
                if (r === true) {
                    $.ajax({
                        url: "ajax/repair/cancel_repair_item.php",
                        type: "post",
                        data: {item_id: item_id},
                        success: function (data) {
                            if (data === "ok") {
                                alert("ยกเลิกการรับซ่อมสินค้าเรียบร้อย");
                                tableDetail.ajax.reload();
                                tableList.ajax.reload();
                                tableItem.ajax.reload();
                                tableCancel.ajax.reload();
                            } else if (data !== "ok") {
                                alert("ไม่สามารถยกเลิกการรับซ่อมสินค้าได้");
                            }
                        }
                    });
                }
            });
            $(document).on('click', '.btn_rbill', function () {
                var rid = this.value;
                $.ajax({
                    url: "ajax/repair/set_session_rid.php",
                    type: "post",
                    data: {rid: rid},
                    success: function () {
                        window.open("../report/repair/addrepair_bill.php", "_blank");
                    }
                });
            });
        });
    </script>
</body>

</html>
