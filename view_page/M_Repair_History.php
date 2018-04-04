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
        <title>ประวัติการซ่อม</title>
        <style>
            .dataTables_filter{
                display: none;
            }
            #tableRepair_Wait thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableRepair_Wait td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableRepair_Wait tbody td:nth-child(5){
                vertical-align:middle; 
                text-align: right; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableRepair_OK thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableRepair_OK td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableRepair_OK tbody td:nth-child(5){
                vertical-align:middle; 
                text-align: right; 
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
                <span class="fa fa-calendar-check-o"></span> ประวัติการซ่อม
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>งานซ่อม</li>
                <li class="active">ประวัติการซ่อม</li>
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
                                    <li class="active"><a href="#t_repair_wait" data-toggle="tab"><i class="fa fa-circle-o-notch"></i> รายการซ่อมที่ส่งคืนลูกค้า</a></li>
                                    <li><a href="#t_repair_ok"  data-toggle="tab"><i class="fa  fa-check-square-o"></i> รายการซ่อมที่เสร็จเรียบร้อยแล้ว</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="t_repair_wait" class="tab-pane in active fade">
                                        <div class="col-md-6" style="margin-top:10px;"></div>
                                        <div class="col-md-6" style="margin-top:10px;">                                            
                                            <div class="input-group pull-right" style="width:100%;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="txtSearch_wait" name="txtSearch_wait" placeholder="ค้นหา : เลขที่ใบรับซ่อม, เลขที่สินค้าซ่อม">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn bg-yellow-gradient btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                        <center><table id="tableRepair_Wait" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr  class="bg-yellow-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                                        <td width="8%">ลำดับ</td>
                                                        <td width="12%">เลขที่ใบรับซ่อม</td>
                                                        <td width="15%">เลขที่สินค้าซ่อม</td>
                                                        <td width="20%">ซ่อมโดย</td>
                                                        <td width="12%">ค่าใช้จ่าย</td>
                                                        <td width="13%">รายละเอียด</td>
                                                        <td width="20%"></td>
                                                        <td>ชื่อลูกค้า</td>
                                                        <td>ชื่อสินค้า</td>
                                                        <!--<td width="150px">การแจ้งเตือน</td>-->
                                                    </tr>
                                                </thead>
                                            </table></center>
                                    </div>
                                    <div id="t_repair_ok" class="tab-pane fade">
                                        <div class="col-md-6" style="margin-top:10px; margin-bottom: 2px;"></div>
                                        <div class="col-md-6" style="margin-top:10px; margin-bottom: 2px;">                                
                                            <div class="input-group pull-right" style="width:100%;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="txtSearch_OK" name="txtSearch_OK" placeholder="ค้นหา : เลขที่ใบรับซ่อม ...">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn bg-blue-gradient btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                        <center><table id="tableRepair_OK" class="table table-bordered table-responsive table-hover">
                                                <thead>
                                                    <tr  class="bg-blue-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                                        <td width="10%">ลำดับ</td>
                                                        <td width="15%">เลขที่ใบรับซ่อม</td>
                                                        <td width="15%">เลขที่สินค้าซ่อม</td>
                                                        <td width="20%">ซ่อมโดย</td>
                                                        <td width="15%">ค่าใช้จ่าย</td>
                                                        <td width="12%">รายละเอียด</td>
                                                        <td width="13%">ใบเสร็จซ่อม</td>
                                                        <td>ชื่อลูกค้า</td>
                                                        <td>ชื่อสินค้า</td>
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
        var tableWait;
        var tableOK;
        var tableItem;
        $(function () {
            $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
                $.each($.fn.dataTable.tables({visible: true, api: true}), function (_i, table) {
                    $(table).DataTable().columns.adjust();
                });
            });
            $('#txtSearch_wait').keyup(function () {
                tableWait.search(this.value).draw();
            });
            $('#txtSearch_OK').keyup(function () {
                tableOK.search(this.value).draw();
            });
            $(document).on('click', '.btn_re_load', function () {
                location.reload();
            });
            tableWait = $("#tableRepair_Wait").DataTable({
                "ajax": "ajax/repair_history/select_repair_wait.php",
                "bInfo": true,
                //"scrollX": "1850px",
                "scrollCollapse": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    {"targets": 0, "orderable": true, "searchable": false},
                    {"targets": 3, "orderable": false, "searchable": true},
                    {"targets": 4, "orderable": false, "searchable": true},
                    {"targets": 5, "orderable": false, "searchable": false},
                    {"targets": 6, "orderable": false, "searchable": false},
                    {"targets": 7, "visible": false, "searchable": true},
                    {"targets": 8, "visible": false, "searchable": true}],
                language: language
            });
            tableOK = $("#tableRepair_OK").DataTable({
                "ajax": "ajax/repair_history/select_repair_success.php",
                "bInfo": true,
                "scrollCollapse": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "columnDefs": [
                    {"targets": 0, "orderable": true, "searchable": false},
                    {"targets": 4, "orderable": false, "searchable": true},
                    {"targets": 5, "orderable": false, "searchable": false},
                    {"targets": 6, "orderable": false, "searchable": false},
                    {"targets": 7, "visible": false, "searchable": true},
                    {"targets": 8, "visible": false, "searchable": true}],
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
            $(document).on('click', '.btn_sms', function () {
                var r = confirm("ยืนยันการส่ง SMS แจ้งเตือนซ่อม");
                if (r === true) {
                    var item_id = this.value;
                    $.ajax({
                        url: "ajax/repair_history/select_word_send.php",
                        type: "post",
                        dataType: "json",
                        data: {item_id: item_id},
                        success: function (rs) {
                            //console.log(rs);
                            sms_send(rs.id, rs.mess, rs.tel, rs.sms);
                        }
                    });
                }
            });
            $(document).on('click', '.btn_return', function () {
                var item_id = this.value;
                var r = confirm("ยืนยันการส่งคืนสินค้าซ่อม");
                if (r === true) {
                    $.ajax({
                        url: "ajax/repair_history/repair_return_item.php",
                        type: "post",
                        data: {item_id: item_id},
                        success: function (data) {
                            console.log(data);
                            if (data === "ok") {
                                alert('ส่งคืนสินค้าซ่อมเรียบร้อย');
                                tableWait.ajax.reload();
                                tableOK.ajax.reload();
                                window.open("../report/repair/repair_bill.php", "_blank");
                            } else {
                                alert('ไม่สามารถส่งคืนสินค้าได้');
                            }
                        }
                    });
                }
            });
            $(document).on('click', '.btn_rbill', function () {
                var rid = this.value;
                $.ajax({
                    url: "ajax/repair_history/set_session_bill_rid.php",
                    type: "post",
                    data: {rid: rid},
                    success: function () {
                        window.open("../report/repair/repair_bill.php", "_blank");
                    }
                });
            });
        });
        function sms_send(id, mess, tel, sms) {
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
                                    update_stack(id, sms, tel, mess);
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
        ;
        function update_stack(id, sms, tel, mess) {
            $.ajax({
                url: "ajax/sms/sms_update_stack.php",
                type: "post",
                data: {id: id, sms: sms, tel: tel, mess: mess},
                success: function (data) {
                    console.log(data);
                    if (data === "ok") {
                        alert("ส่ง sms แจ้งเตือนซ่อมเรียบร้อย");
                        tableWait.ajax.reload();
                    }
                }
            });
        }
        ;
    </script>
</body>

</html>
