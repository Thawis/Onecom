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
        <title>จัดการเมนูซ่อมสินค้า</title>
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
                <span class="fa fa-navicon"></span> จัดการเมนูซ่อมสินค้า
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>ตั้งค่าระบบ</li>
                <li class="active">จัดการเมนูซ่อมสินค้า</li>
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
                                <div class="col-md-6" style="margin-top:10px;"><button type="button" id="add_ser" class="btn bg-green-gradient"><span class="fa fa-plus"></span> เพิ่มรายการบริการ</button></div>
                                <div class="col-md-6" style="margin-top:10px;">                                            
                                    <div class="input-group pull-right" style="width:100%;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="txtSearch_list" name="txtSearch_list" placeholder="ค้นหา : เมนูซ่อม, ราคา, ฯลฯ">
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
                                            <td width="15%">รหัสเมนูซ่อม</td>
                                            <td width="20%">เมนูซ่อม</td>
                                            <td width="15%">ราคา</td>
                                            <td width="15%">ประเภท</td>
                                            <td width="15%">สถานะ</td>
                                            <td width="10%"></td>
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
    <!-- Modal Detail Edit-->
    <div class="modal fade" id="EditService" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="edit_service">
                    <div class="modal-header bg-yellow-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-pencil"></span> แก้ไขรายการบริการ</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <!--<input type="hidden" id="action_eser" name="action_eser" value="edit"/>-->
                                <table class="table table-responsive">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">รหัสรายการบริการ : </td>
                                            <td width="40%"><input type="text" class="form-control" id="e_serid" name="e_serid" required="" readonly="" /></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">ชื่อบริการ : </td>
                                            <td colspan="2"><input type="text" class="form-control" id="e_sername" name="e_sername" required=""/></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">ราคา : </td>
                                            <td width="40%"><input type="number" class="form-control" id="e_serprice" name="e_serprice" required="" min="50"/></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">ประเภทบริการ : </td>
                                            <td width="40%">
                                                <select class="form-control" id="e_sertype" name="e_sertype" style="width:100%" required="">
                                                    <option value="All">ทั้งหมด</option>
                                                    <option value="PC">PC</option>
                                                    <option value="NB">NoteBook</option>
                                                </select>
                                            </td>
                                            <td width="30%"></td>
                                        </tr>
                                    </tbody>
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
    <!-- Modal Add -->
    <div class="modal fade" id="AddService" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="add_service">
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-plus"></span> เพิ่มรายการบริการ</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <input type="hidden" id="ser_action" name="ser_action" value="add"/>
                                <table class="table table-responsive" id="">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">รหัสรายการบริการ : </td>
                                            <td width="40%"><input type="text" class="form-control" id="serid" name="serid" required="" readonly="" /></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">ชื่อบริการ : </td>
                                            <td colspan="2"><input type="text" class="form-control" id="sername" name="sername" required=""/></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">ราคา : </td>
                                            <td width="40%"><input type="number" class="form-control" id="serprice" name="serprice" required="" min="50"/></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">ประเภทบริการ : </td>
                                            <td width="40%">
                                                <select class="form-control" id="sertype" name="sertype" style="width:100%" required="">
                                                    <option value="All">ทั้งหมด</option>
                                                    <option value="PC">PC</option>
                                                    <option value="NB">NoteBook</option>
                                                </select>
                                            </td>
                                            <td width="30%"></td>
                                        </tr>
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
        $(function () {
            $('#txtSearch_list').keyup(function () {
                tableList.search(this.value).draw();
            });
            $(document).on('click', '.btn_re_load', function () {
                location.reload();
            });
            tableList = $("#tableRepairList").DataTable({
                "ajax": "ajax/service_menu/select_menu.php",
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
            $('#add_ser').on('click', function () {
                set_id();
                $('#sername').val("");
                $('#serprice').val("");
                $('#sertype').val("All");
                $('#AddService').modal('show');
            });
            $('#add_service').on('submit', function (e) {
                e.preventDefault();
                var data = $('#add_service').serialize();
                $.ajax({
                    url: "ajax/service_menu/chk_menu.php",
                    type: "post",
                    data: data,
                    success: function (rs) {
                        if (rs === "ok") {
                            var r = confirm("ยืนยันการเพิ่มข้อมูลรายการบริการ");
                            if (r === true) {
                                $.ajax({
                                    url: "ajax/service_menu/insert_menu.php",
                                    type: "post",
                                    data: data,
                                    success: function (data) {
                                        alert(data);
                                        tableList.ajax.reload();
                                        $('#AddService').modal('hide');
                                    }
                                });
                            }
                        } else {
                            alert('รายการบริการนี้ถูกมีอยู่ในระบบแล้ว');
                        }
                    }
                });
            });
            $('#edit_service').on('submit', function (e) {
                e.preventDefault();
                var data = $('#edit_service').serialize();
                $.ajax({
                    url: "ajax/service_menu/chk_menu.php",
                    type: "post",
                    data: data,
                    success: function (rs) {
                        if (rs === 'ok') {
                            var r = confirm("ยืนยันการแก้ไขข้อมูลรายการบริการ");
                            if (r === true) {
                                $.ajax({
                                    url: "ajax/service_menu/edit_service.php",
                                    type: "post",
                                    data: data,
                                    success: function (data) {
                                        alert(data);
                                        tableList.ajax.reload();
                                        $('#EditService').modal('hide');
                                    }
                                });
                            }
                        } else {
                            alert('ไม่สามารถแก้ไขข้อมูลกรายการบริการได้');
                        }
                    }
                });
            });
        });
        function edit_menu(a) {
            $.ajax({
                url: "ajax/service_menu/select_edit_service.php",
                type: "post",
                dataType: "json",
                data: {serid: a},
                success: function (rs) {
                    $('#e_serid').val(rs.id);
                    $('#e_sername').val(rs.name);
                    $('#e_serprice').val(rs.price);
                    $('#e_sertype').val(rs.type);
                }
            });
            $('#EditService').modal('show');
        }
        ;
        function open_menu(a) {
            var state = "open";
            var r = confirm("ยืนยันการเปิดใช้งานรายการบริการนี้");
            if (r === true) {
                $.ajax({
                    url: "ajax/service_menu/update_service.php",
                    type: "post",
                    data: {state: state, sid: a},
                    success: function (rs) {
                        alert(rs);
                        tableList.ajax.reload();
                    }
                });
            }
        }
        ;
        function cancel_menu(a) {
            var state = "cancel";
            var r = confirm("ยืนยันการยกเลิกใช้งานรายการบริการนี้");
            if (r === true) {
                $.ajax({
                    url: "ajax/service_menu/update_service.php",
                    type: "post",
                    data: {state: state, sid: a},
                    success: function (rs) {
                        alert(rs);
                        tableList.ajax.reload();
                    }
                });
            }
        }
        ;
        function remove_menu(a) {
            var r = confirm('ยืนยันการลบรายการบริการ');
            if (r === true) {
                $.ajax({
                    url: "ajax/service_menu/remove_menu.php",
                    type: "post",
                    data: {serid: a},
                    success: function (rs) {
                        alert(rs);
                        tableList.ajax.reload();
                    }
                });
            }
        }
        ;
        function set_id() {
            $.ajax({
                url: "ajax/service_menu/set_serid.php",
                success: function (data) {
                    $('#serid').val(data);
                }
            });
        }
        ;
    </script>
</body>

</html>
