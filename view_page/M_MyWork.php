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
        <title>งานซ่อมของฉัน</title>
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
            #tableClaim thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableClaim td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableRepairDetail tbody td:nth-child(5){
                text-align: right;
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
                <span class="fa fa-gavel"></span> งานซ่อมของฉัน
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>งานซ่อม</li>
                <li class="active">งานซ่อมของฉัน</li>
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
                                    <li class="active"><a href="#t_repair_list" data-toggle="tab"><i class="fa fa-list-alt"></i> รายการงานอยู่ระหว่างซ่อมของฉัน</a></li>
                                    <li><a href="#t_repair_claim"  data-toggle="tab"><i class="fa fa-bolt"></i> รายการงานซ่อมเคลมของฉัน</a></li>
                                    <li><a href="#t_repair_detail"  data-toggle="tab"><i class="fa fa-list-ul"></i> รายการงานซ่อมที่เสร็จแล้วของฉัน</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="t_repair_list" class="tab-pane in active fade">
                                        <div class="col-md-6" style="margin-top:10px;"></div>
                                        <div class="col-md-6" style="margin-top:10px;">                                            
                                            <div class="input-group pull-right" style="width:100%;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="txtSearch_list" name="txtSearch_list" placeholder="ค้นหา : เลขที่ใบรับซ่อม, เลขที่สินค้าซ่อม">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn bg-purple-gradient btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                        <table id="tableRepairList" class="table table-bordered table-hover">
                                            <thead>
                                                <tr  class="bg-purple-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                                    <td width="10%">ลำดับ</td>
                                                    <td width="15%">เลขที่สินค้าซ่อม</td>
                                                    <td width="10%">ประเภทสินค้า</td>
                                                    <td width="20%">ชื่อสินค้า</td>
                                                    <td width="25%">อาการเสีย & สิ่งที่ให้ทำ </td>
                                                    <td width="15%">วันที่รับซ่อม</td>
                                                    <td width="10%"></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div id="t_repair_claim" class="tab-pane fade">
                                        <div class="col-md-6" style="margin-top:10px;"></div>
                                        <div class="col-md-6" style="margin-top:10px;">                                            
                                            <div class="input-group pull-right" style="width:100%;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="txtSearch_claim" name="txtSearch_claim" placeholder="ค้นหา :เลขที่รับซ่อมเคลม.. เลขที่สินค้าซ่อม..">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn bg-yellow-gradient btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                        <table id="tableClaim" class="table table-bordered table-hover">
                                            <thead>
                                                <tr  class="bg-yellow-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                                    <td width="10%">ลำดับ</td>
                                                    <td width="15%">เลขที่รับซ่อมเคลม</td>
                                                    <td width="15%">เลขที่สินค้าซ่อม</td>
                                                    <td width="15%">รายละเอียด</td>
                                                    <td width="15">สถานะ</td>
                                                    <td width="20%">อาการเสีย & สิ่งที่ให้ทำ </td>
                                                    <td width="10%"></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div id="t_repair_detail" class="tab-pane fade">
                                        <div class="col-md-6" style="margin-top:10px; margin-bottom: 2px;"></div>
                                        <div class="col-md-6" style="margin-top:10px; margin-bottom: 2px;">                                
                                            <div class="input-group pull-right" style="width:100%;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="txtSearch_detail" name="txtSearch_detail" placeholder="ค้นหา : เลขที่ใบรับซ่อม ...">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn bg-blue-gradient btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                        <table id="tableRepairDetail" class="table table-bordered table-hover">
                                            <thead>
                                                <tr  class="bg-blue-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                                    <td width="10%">ลำดับ</td>
                                                    <td width="15%">เลขที่ใบรับซ่อม</td>
                                                    <td width="15%">เลขที่สินค้าซ่อม</td>
                                                    <td width="15%">วันที่รับซ่อม</td>
                                                    <td width="15%">ค่าใช้จ่ายรวม</td>
                                                    <td width="15%">สถานะ</td>
                                                    <td width="15%">รายละเอียด</td>
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
    <!-- Modal Detail Edit-->
    <div class="modal fade" id="Add_Claim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_add_claim">
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-save"></span> บันทึกข้อมูลการซ่อมเคลม</h4>
                    </div>
                    <div class="modal-body">
                        <!--<input type="hidden" id="modal_add_item_id" name="modal_add_item_id" value=""/>-->
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover" id="tableAdd_Claim">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">เลขที่รับซ่อมเคลม : </td>
                                            <td width="40%"><input type="text" class="form-control" id="claim_id" name="claim_id" required="" readonly="" /></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">บันทึกรายละเอียดซ่อม : </td>
                                            <td width="40%"><textarea class="form-control" id="claim_detail" name="claim_detail" rows="3" required=""e></textarea></td>
                                            <td width="30%"></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-green-gradient">บันทึกข้อมูล</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- detail -->
    <div class="modal fade" id="Detail_Claim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_add_claim">
                    <div class="modal-header bg-blue-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-save"></span> รายละเอียดบันทึกข้อมูลการซ่อมเคลม</h4>
                    </div>
                    <div class="modal-body">
                        <!--<input type="hidden" id="modal_add_item_id" name="modal_add_item_id" value=""/>-->
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover" id="tableAdd_Claim">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">บันทึกรายละเอียดซ่อม : </td>
                                            <td width="60%"><textarea class="form-control" id="claim_detail2" name="claim_detail2" rows="3" readonly=""></textarea></td>
                                            <td width="10%"></td>
                                        </tr>
                                    </tbody>
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
    <script>
        var tableList;
        var tableDetail;
        var tableItem;
        var tableItemClaim;
        $(function () {
            $('#txtSearch_list').keyup(function () {
                tableList.search(this.value).draw();
            });
            $('#txtSearch_detail').keyup(function () {
                tableDetail.search(this.value).draw();
            });
            $('#txtSearch_claim').keyup(function () {
                tableItemClaim.search(this.value).draw();
            });
            $(document).on('click', '.btn_re_load', function () {
                location.reload();
            });
            tableList = $("#tableRepairList").DataTable({
                "ajax": "ajax/mywork/select_repair_list.php",
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
            tableItemClaim = $("#tableClaim").DataTable({
                "ajax": "ajax/mywork/select_repair_claim.php",
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
                    {"targets": 3, "orderable": false, "searchable": false},
                    {"targets": 6, "orderable": false, "searchable": false}],
                language: language
            });
            tableDetail = $("#tableRepairDetail").DataTable({
                "ajax": "ajax/mywork/select_repair_list_add.php",
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
                    {"targets": 4, "orderable": true, "searchable": false},
                    {"targets": 6, "orderable": false, "searchable": false}],
                language: language
            });
            $(document).on('click', '.btn_cancel_add', function () {
                var item_id = this.value;
                var r = confirm("ยืนยันการยกเลิกบันทึกการซ่อม");
                if (r === true) {
                    $.ajax({
                        url: "ajax/mywork/cancel_repair_success.php",
                        type: "post",
                        data: {item_id: item_id},
                        success: function (data) {
                            if (data === 'ok') {
                                alert('ยกเลิกบันทึการซ่อมเรียบร้อย');
                                tableDetail.ajax.reload();
                                tableList.ajax.reload();
                            }
                        }
                    });
                }
            });
            $('#form_add_claim').on('submit', function (e) {
                e.preventDefault();
                var data = $('#form_add_claim').serialize();
                var r = confirm("ยืนยันการบันทึกข้อมูล");
                if (r === true) {
                    $.ajax({
                        url: "ajax/mywork/update_repair_claim.php",
                        type: "post",
                        data: data,
                        success: function (rs) {
                            if (rs === "ok") {
                                alert('บันทึกข้อมูลการซ่อมเรียบร้อย');
                                $('#Add_Claim').modal('hide');
                                tableItemClaim.ajax.reload();
                            } else {
                                alert('ไม่สามารถบันทึกข้อมูลการซ่อมได้ : ' + rs);
                            }
                        }
                    });
                }
            });
            $(document).on('click', '.btn_detail_claim', function () {
                var detail = this.value;
                $('#claim_detail2').val('');
                $('#claim_detail2').val(detail);
                $('#Detail_Claim').modal('show');
            });
            $(document).on('click', '.btn_add_claim', function () {
                var claim_id = this.value;
                $('#claim_id').val(claim_id);
                $('#claim_detail').val("");
                $('#Add_Claim').modal('show');
            });
            $(document).on('click', '.btn_cancel_claim', function () {
                var claim_id = this.value;
                var r = confirm("ยืนยันการยกเลิกบันทึกข้อมูล");
                if (r === true) {
                    $.ajax({
                        url: "ajax/mywork/update_repair_claim_cancel.php",
                        type: "post",
                        data: {claim_id: claim_id},
                        success: function (rs) {
                            if (rs === "ok") {
                                alert('ยกเลิกบันทึกข้อมูลการซ่อมเรียบร้อย');
                                tableItemClaim.ajax.reload();
                            } else {
                                alert('ไม่สามารถยกเลิกบันทึกข้อมูลการซ่อมได้ : ' + rs);
                            }
                        }
                    });
                }
            });
        });
        function setCancel(a) {
            var r = confirm("ยืนยันการยกเลิกซ่อมสินค้าเลขที่ : " + a);
            if (r === true) {
                $.ajax({
                    url: "ajax/repair/cancel_repair_item.php",
                    type: "post",
                    data: {item_id: a},
                    success: function (data) {
                        if (data === "ok") {
                            alert("ยกเลิกการรับซ่อมสินค้าเรียบร้อย");
                            tableDetail.ajax.reload();
                            tableList.ajax.reload();
                        } else if (data !== "ok") {
                            alert("ไม่สามารถยกเลิกการรับซ่อมสินค้าได้");
                        }
                    }
                });
            }
        }
        ;
        function setCancel2(a) {
            var r = confirm("ยืนยันการยกเลิกซ่อมสินค้าเลขที่ : " + a);
            if (r === true) {
                $.ajax({
                    url: "ajax/mywork/cancel_repair_item_sell.php",
                    type: "post",
                    data: {item_id: a},
                    success: function (data) {
                        console.log(data);
                        if (data === "ok") {
                            alert("ยกเลิกการรับซ่อมสินค้าเรียบร้อย");
                            tableDetail.ajax.reload();
                            tableList.ajax.reload();
                        } else if (data !== "ok") {
                            alert("ไม่สามารถยกเลิกการรับซ่อมสินค้าได้");
                        }
                    }
                });
            }
        }
        ;
    </script>
</body>

</html>
