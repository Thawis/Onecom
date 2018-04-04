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
        <title>รายการรับซ่อมในประกัน</title>
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
            #tableRepair_R thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableRepair_R td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableRepair_F thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableRepair_F td{
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
                <span class="fa fa-exclamation-triangle"></span> รายการรับซ่อมในประกัน
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>งานซ่อม</li>
                <li class="active">รายการรับซ่อมในประกัน</li>
            </ol>
        </section>
        <section class="content" style="height:1700px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title"></h3>
                        </div>    
                        <div class="content">
                            <div class="box-body">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#t_repair_list" data-toggle="tab"><i class="fa fa-list-alt"></i> รายการซ่อมสินค้าที่มีประกัน</a></li>
                                    <li><a href="#t_repair_list_R"  data-toggle="tab"><i class="fa fa-bolt"></i> รายการซ่อมสินค้ามีประกันที่รับมา</a></li>
                                    <li><a href="#t_repair_list_F"  data-toggle="tab"><i class="fa fa-list-ul"></i> รายการซ่อมสินค้ามีประกันที่เสร็จแล้ว</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="t_repair_list" class="tab-pane in active fade">
                                        <div class="col-md-6" style="margin-top:10px;">
                                            <button type="button" class="btn bg-green-gradient btn_re_load"><span class="fa fa-refresh"> รีเฟรช</span></button>
                                        </div>
                                        <div class="col-md-6" style="margin-top:10px;">                                            
                                            <div class="input-group pull-right" style="width:100%;">
                                                <form id="find_claim">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="txtSearch_list" name="txtSearch_list" placeholder="ค้นหา : เลขที่ใบรับซ่อม, เลขที่สินค้าซ่อม" required="">
                                                        <div class="input-group-btn">
                                                            <button type="submit" class="btn bg-green-gradient" id="find_repair" name="find_repair"><span class="fa fa-search"></span> ค้นหา</button> 
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>                                           
                                        </div>
                                        <table id="tableRepairList" class="table table-bordered table-hover">
                                            <thead>
                                                <tr  class="bg-green-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                                    <td width="10%">ลำดับ</td>
                                                    <td width="15%">เลขที่ใบรับซ่อม</td>
                                                    <td width="15%">เลขที่สินค้าซ่อม</td>
                                                    <td width="20%">ชื่อลูกค้า</td>
                                                    <td width="15%">วันที่หมดประกัน</td>
                                                    <td width="15%">รายละเอียด</td>
                                                    <td width="10%">รับซ่อม</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div id="t_repair_list_R" class="tab-pane fade">
                                        <div class="col-md-6" style="margin-top:10px; margin-bottom: 2px;"></div>
                                        <div class="col-md-6" style="margin-top:10px; margin-bottom: 2px;">                                
                                            <div class="input-group pull-right" style="width:100%;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="txtSearch_R" name="txtSearch_R" placeholder="ค้นหา : เลขที่ใบรับซ่อม ...">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn bg-yellow-gradient btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                        <center><table id="tableRepair_R" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr  class="bg-yellow-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                                        <td width="8%">ลำดับ</td>
                                                        <td width="15%">เลขที่สินค้าซ่อม</td>
                                                        <td width="17%">ชื่อลูกค้า</td>
                                                        <td width="20%">ซ่อมโดย</td>
                                                        <td width="12%">สถานะ</td>
                                                        <td width="10%">รายละเอียด</td>
                                                        <td width="18%"></td>
                                                    </tr>
                                                </thead>
                                            </table></center>
                                    </div>
                                    <div id="t_repair_list_F" class="tab-pane fade">
                                        <div class="col-md-6" style="margin-top:10px; margin-bottom: 2px;">
                                        </div>
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
                                        <center><table id="tableRepair_F" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr  class="bg-blue-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                                        <td width="10%">ลำดับ</td>
                                                        <td width="20%">เลขที่รับซ่อมเคลม</td>
                                                        <td width="20%">เลขที่สินค้าซ่อม</td>
<!--                                                        <td width="200px">วันที่รับเข้า</td>
                                                        <td width="200px">วันที่ส่งคืน</td>-->
                                                        <td width="20%">ชื่อลูกค้า</td>
                                                        <td width="20%">ซ่อมโดย</td>
                                                        <td width="10%">รายละเอียด</td>
                                                    </tr>
                                                </thead>
                                            </table></center>
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
    <div class="modal fade" id="Detail_Claim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="">
                    <div class="modal-header bg-blue-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-save"></span> รายละเอียดบันทึกข้อมูลการซ่อมเคลม</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive" id="tableAdd_Claim">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">บันทึกรายละเอียดซ่อม : </td>
                                            <td width="60%"><textarea class="form-control" id="claim_detail" name="claim_detail" rows="3" readonly=""></textarea></td>
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
    <!-- Modal Add -->
    <div class="modal fade" id="Add_Claim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_add_claim">
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-plus"></span> เพิ่มรายการซ่อมเคลม</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive" id="tableAdd_Claim">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">เลขที่สินค้าซ่อม : </td>
                                            <td width="60%"><input type="text" class="form-control" id="add_cid" name="add_cid" readonly=""></td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">รายการซ่อมประกัน : </td>
                                            <td width="60%"><input type="text" class="form-control" id="add_c_manner" name="add_c_manner" readonly=""></td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">อาการเสีย : </td>
                                            <td width="70%"><input type="text" class="form-control" id="add_manner" name="add_manner" required=""></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-green-gradient">รับซ่อมสินค้าประกัน</button>
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
        var tableRepair_R;
        var tableRepair_F;
        $(function () {
            $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
                $.each($.fn.dataTable.tables({visible: true, api: true}), function (_i, table) {
                    $(table).DataTable().columns.adjust();
                });
            });
//            $('#txtSearch_list').keyup(function () {
//                tableList.search(this.value).draw();
//            });
            $('#txtSearch_R').keyup(function () {
                tableRepair_R.search(this.value).draw();
            });
            $('#txtSearch_detail').keyup(function () {
                tableRepair_F.search(this.value).draw();
            });
            $(document).on('click', '.btn_re_load', function () {
                location.reload();
            });
            $('#find_claim').on('submit', function (e) {
                e.preventDefault();
                var r_id = $('#txtSearch_list').val();
                $.ajax({
                    url: "ajax/repair_claim/find_repair.php",
                    type: "post",
                    data: {rid: r_id},
                    success: function (rs) {
                        if (rs !== '0') {
                            alert('พบข้อมูลการประกัน ' + rs + ' รายการ');
                            find_claim(r_id);
                        } else {
                            alert('ไม่พบข้อมูลการประกัน');
                            $('#txtSearch_list').val('');
                        }
                    }
                });
            });
            tableList = $("#tableRepairList").DataTable({
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
            tableRepair_R = $("#tableRepair_R").DataTable({
                "ajax": "ajax/repair_claim/select_repair_war_all.php",
                "scrollCollapse": true,
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "columnDefs": [
                    {"targets": 0, "orderable": true, "searchable": false},
                    {"targets": 5, "orderable": false, "searchable": false},
                    {"targets": 6, "orderable": false, "searchable": false}],
                language: language
            });
            tableRepair_F = $("#tableRepair_F").DataTable({
                "ajax": "ajax/repair_claim/select_repair_success.php",
                "scrollCollapse": true,
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "columnDefs": [
                    {"targets": 0, "orderable": true, "searchable": false},
                    {"targets": 3, "orderable": false, "searchable": true},
                    {"targets": 4, "orderable": false, "searchable": true},
                    {"targets": 5, "orderable": false, "searchable": false}],
                language: language
            });
            $(document).on('click', '.btn_detail_claim', function () {
                var detail = this.value;
                $('#claim_detail').val('');
                $('#claim_detail').val(detail);
                $('#Detail_Claim').modal('show');
            });
            //add claim
//            $(document).on('click', '.btn_add_claim', function () {
//                var item_id = this.value;
//                $('#add_cid').val(item_id);
//                $('#add_manner').val('');
//                $('#Add_Claim').modal('show');
//            });
            $('#form_add_claim').on('submit', function (e) {
                e.preventDefault();
                var item_id = $('#add_cid').val();
                var item_manner = $('#add_manner').val();
                var add_c_manner = $('#add_c_manner').val();
                var r = confirm("ยืนยันการับซ่อมสินค้าประกัน");
                if (r === true) {
                    $.ajax({
                        url: "ajax/repair_claim/check_claim.php",
                        type: "post",
                        data: {item_id: item_id,manner:add_c_manner},
                        success: function (data) {
                            if (data === "ok") {
                                $.ajax({
                                    url: "ajax/repair_claim/insert_repair_war.php",
                                    type: "post",
                                    data: {item_id: item_id, item_manner: item_manner},
                                    success: function (data) {
                                        if (data === "ok") {
                                            alert("เพิ่มรายการซ่อมสินค้าประกันเรียบร้อย");
                                            tableRepair_R.ajax.reload();
                                            $('#Add_Claim').modal('hide');
                                        } else {
                                            alert('ไม่สามารถเพิ่มข้อมูลได้');
                                        }
                                    }
                                });
                            } else if (data === "not") {
                                alert("รายการซ่อมสินค้าประกันนี้ถูกรับเข้าแล้ว");
                                $('#Add_Claim').modal('hide');
                            }
                        }
                    });
                }
            });

            //=========================================SMS========================================
            $(document).on('click', '.btn_sms', function () {
                var r = confirm("ยืนยันการส่ง SMS แจ้งเตือนซ่อม");
                if (r === true) {
                    var item_id = this.value;
                    $.ajax({
                        url: "ajax/repair_claim/select_word_send.php",
                        type: "post",
                        dataType: "json",
                        data: {item_id: item_id},
                        success: function (rs) {
                            //console.log(rs);
                            sms_send(rs.id, rs.mess, rs.tel, rs.c_id);
                        }
                    });
                }
            });
            $(document).on('click', '.btn_return', function () {
                var c_id = this.value;
                var r = confirm("ยืนยันการส่งคืนสินค้าซ่อม");
                if (r === true) {
                    $.ajax({
                        url: "ajax/repair_claim/repair_return_item.php",
                        type: "post",
                        data: {c_id: c_id},
                        success: function (data) {
                            //console.log(data);
                            if (data === "ok") {
                                alert('ส่งคืนสินค้าซ่อมเรียบร้อย');
                                tableRepair_R.ajax.reload();
                                tableRepair_F.ajax.reload();
                            } else {
                                alert('ไม่สามารถส่งคืนสินค้าได้');
                            }
                        }
                    });
                }
            });
        });
        function find_claim(rid) {
            tableList = $("#tableRepairList").DataTable({
                destroy: true,
                ajax: {
                    url: "ajax/repair_claim/select_repair_war.php",
                    type: "post",
                    //data:$('#form_find_war').serialize()
                    data: {rid: rid}
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
        }
        ;
        function sms_send(id, mess, tel, c_id) {
            $.ajax({
                url: "ajax/sms/check_credit_sms.php",
                success: function (data) {
                    if (data === 'ok') {
                        $.ajax({
                            url: "ajax/sms/sms_send_repair.php",
                            type: "post",
                            data: {mess: mess, tel: tel},
                            success: function (data) {
                                //console.log(data);
                                if (data === "ok") {
                                    update_stack(id, c_id, tel, mess);
                                } else {
                                    alert('ไม่สามารถส่ง update stack sms ได้');
                                }
                            }
                        });
                    } else {
                        alert('ไม่สามารถส่ง sms ได้ Credit ไม่พอ');
                    }
                }
            });
        }
        ;
        function update_stack(id, c_id, tel, mess) {
            $.ajax({
                url: "ajax/sms/insert_log_sms.php",
                type: "post",
                data: {id: id, c_id: c_id, tel: tel, mess: mess},
                success: function (data) {
                    console.log(data);
                    if (data === "ok") {
                        alert("ส่ง sms แจ้งเตือนซ่อมเรียบร้อย");
                        tableRepair_R.ajax.reload();
                    }
                }
            });
        }
        ;
        function setAddClaim(ser, c_id) {
            $('#add_cid').val(c_id);
            $('#add_c_manner').val(ser);
            $('#add_manner').val('');
            $('#Add_Claim').modal('show');
        }
        ;
    </script>
</body>

</html>
