<?php
include '../lib/connect.php';
include '../lib/check_login.php';
include '../lib/lock_page_user.php';
$userType = $_SESSION['login_type'];
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
        <title>การจัดการข้อมูลพนักงาน</title>
        <style>
            .dataTables_filter{
                display: none;
            }
            #table-emp td{
                vertical-align: middle;
                font-style: normal;
                font-size: 16px; 
                text-align: center;
            }
            #table-emp td:nth-child(3){
                text-align: left;
            }
            #table-emp-cancel td{
                vertical-align: middle;
                font-style: normal;
                font-size: 16px; 
                text-align: center;
            }
            #table-user-type td{
                vertical-align: middle;
                font-style: normal;
                font-size: 16px; 
                text-align: center; 
            }
            #table-emp-cancel td:nth-child(3){
                text-align: left;
            }
            #tableDetail td{
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
                <span class="fa fa-user-circle-o"></span> จัดการข้อมูลพนักงาน
                <!--<small></small>-->
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">จัดการข้อมูลพนักงาน</li>
            </ol>
        </section>
        <section class="content" style="height:1600px;">
            <div class="row">
                <div class="col-md-12">                    
                    <div class="box box-default">
                        <!--                        <div class="box-header with-border">
                                                    <h3 class="box-title" style="font-style: normal; font-size: 19px;"><span class="fa fa-user-circle-o"></span> ข้อมูลพนักงาน</h3>
                                                </div>-->
                        <div class="panel-body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#t_user" data-toggle="tab"><i class="fa fa-user"></i> ข้อมูลพนักงาน</a></li>
                                <li><a href="#t_user_cancel" data-toggle="tab"><i class="fa fa-user-times"></i> ระงับการใช้งาน</a></li>
                                <?php if ($userType == "root") { ?>
                                    <li><a href="#t_user_type" data-toggle="tab"><i class="fa fa-pencil"></i> แก้ไขตำแหน่ง</a></li>
                                <?php } ?>                  
                            </ul>
                            <div class="tab-content">
                                <div id="t_user" class="tab-pane in active fade">
                                    <center><div class="box-body" style="width:90%;">
                                            <table class="table no-border">
                                                <tbody>
                                                    <tr style="vertical-align: middle;"><td colspan="6">  
                                                <center>
                                                    <div class="input-group" style="width:50%;"> 
                                                        <input type="text" id="txtSearch" class="form-control" placeholder="ค้นหาข้อมูล...">
                                                        <span class="input-group-btn"><button class="btn bg-blue-gradient" type="button" id="btntest"><span class='fa fa-search'></span> ค้นหา</button></span>
                                                    </div>
                                                </center>
                                                </td></tr></tbody>
                                            </table>
                                            <!--Data Table -->
                                            <table id="table-emp" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr class="bg-blue-gradient" style="font-size: 16px;">
                                                        <td width="10%" style="text-align:center;">ลำดับ</td>
                                                        <td width="15%" style="text-align:center;">รหัสพนักงาน</td>
                                                        <td width="25%" style="text-align:left;">ชื่อ-นามสกุล</td>                                                    
                                                        <td width="15%" style="text-align:center;">เพศ</td>
                                                        <td width="15%" style="text-align:center;">ตำแหน่ง</td>
                                                        <!--<td width="15%" style="text-align:center;">สถานะ</td>-->
                                                        <td width="20%" style="text-align:center;"></td>
                                                    </tr>
                                                </thead>
                                            </table>                                                                      
                                        </div></center>
                                </div>
                                <div  id="t_user_cancel" class="tab-pane fade" cellspacing="0" width="100%">
                                    <center><div class="box-body" style="width:90%;">
                                            <table class="table no-border">
                                                <tbody>
                                                    <tr style="vertical-align: middle;"><td colspan="6">  
                                                <center>
                                                    <div class="input-group" style="width:50%;"> 
                                                        <input type="text" id="txtSearch-cancel" class="form-control" placeholder="ค้นหาข้อมูล...">
                                                        <span class="input-group-btn"><button class="btn bg-red-gradient" type="button" id="btntest"><span class='fa fa-search'></span> ค้นหา</button></span>
                                                    </div>
                                                </center>
                                                </td></tr></tbody>
                                            </table>
                                            <!--Data Table -->
                                            <table id="table-emp-cancel" class="table table-bordered table-responsive table-hover">
                                                <thead>
                                                    <tr class="bg-red-gradient" style="font-size: 16px;">
                                                        <td width="10%" style="text-align:center;">ลำดับ</td>
                                                        <td width="15%" style="text-align:center;">รหัสพนักงาน</td>
                                                        <td width="30%" style="text-align:left;">ชื่อ-นามสกุล</td>                                                    
                                                        <td width="15%" style="text-align:center;">ตำแหน่ง</td>
                                                        <td width="15%" style="text-align:center;"></td>
                                                        <td width="15%" style="text-align:center;"></td>
                                                    </tr>
                                                </thead>
                                            </table>                                                                      
                                        </div></center>
                                </div>
                                <?php if ($userType == "root") { ?>
                                    <div  id="t_user_type" class="tab-pane fade" cellspacing="0" width="100%">
                                        <center><div class="box-body" style="width:90%;">
                                                <table class="table no-border">
                                                    <tbody>
                                                        <tr style="vertical-align: middle;"><td colspan="6">  
                                                    <center>
                                                        <div class="input-group" style="width:50%;"> 
                                                            <input type="text" id="txtSearch-type" class="form-control" placeholder="ค้นหาข้อมูล...">
                                                            <span class="input-group-btn"><button class="btn bg-yellow-gradient" type="button" id="btntest"><span class='fa fa-search'></span> ค้นหา</button></span>
                                                        </div>
                                                    </center>
                                                    </td></tr></tbody>
                                                </table>
                                                <table id="table-user-type" class="table table-bordered table-responsive table-hover">
                                                    <thead>
                                                        <tr class="bg-yellow-gradient" style="font-size: 16px;">
                                                            <td width="10%" style="text-align:center;">ลำดับ</td>
                                                            <td width="15%" style="text-align:center;">รหัสพนักงาน</td>
                                                            <td width="30%" style="text-align:left;">ชื่อ-นามสกุล</td>                                                    
                                                            <td width="15%" style="text-align:center;">ตำแหน่ง</td>
                                                            <td width="15%" style="text-align:center;">สถานะ</td>
                                                            <td width="15%" style="text-align:center;"></td>
                                                        </tr>
                                                    </thead>
                                                </table>                                                                      
                                            </div></center>
                                    </div>
                                <?php } ?>
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
                    <div class="modal-header bg-blue-gradient">
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-info-circle"></span> รายละเอียดข้อมูลพนักงาน</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="modal_emp_id"/>
                        <div class="box-body no-border">
                            <table class="table table-responsive" id="tableDetail">
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
    <!-- Modal Edit-->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form-edit">
                    <div class="modal-header bg-yellow-gradient">
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-pencil"></span> แก้ไขข้อมูลพนักงาน</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_emp_id"/>
                        <div class="box box-default">
                            <div class="box-body no-border">
                                <table class="table table-responsive table-hover" id="tableEdit">
                                </table>
                            </div>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-yellow-gradient" id="btn_edit" name="btn_edit" > แก้ไขข้อมูล</button>
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
    <script src="script/global.js" type="text/javascript"></script>
    <script>
        var TableEmp;
        var TableEmpCancel;
        var TableType;
        $(function () {
            $('#txtSearch').keyup(function () {
                TableEmp.search(this.value).draw();
            });
            $('#txtSearch-cancel').keyup(function () {
                TableEmpCancel.search(this.value).draw();
            });
            $('#txtSearch-type').keyup(function () {
                TableType.search(this.value).draw();
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
                $.each($.fn.dataTable.tables({visible: true, api: true}), function (_i, table) {
                    $(table).DataTable().columns.adjust();
                });
            });
            TableEmp = $("#table-emp").DataTable({
                "ajax": "ajax/Employee/select_employee.php",
                "bInfo": false,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                language: language,
                "columnDefs": [
                    {"targets": 5, "orderable": false, "searchable": false}
                ]
            });
            TableEmpCancel = $("#table-emp-cancel").DataTable({
                "ajax": "ajax/Employee/select_cancel_emp.php",
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false,
                "paging": true,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                language: language,
                "columnDefs": [
                    {"targets": 4, "orderable": false, "searchable": false},
                    {"targets": 5, "orderable": false, "searchable": false}
                ]
            });
            TableType = $("#table-user-type").DataTable({
                "ajax": "ajax/Employee/select_edit_type.php",
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false,
                "paging": true,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                language: language,
                "columnDefs": [
                    {"targets": 5, "orderable": false, "searchable": false}
                ]
            });

            $('#ModalDetail').on('shown.bs.modal', function () {
                var eid = $('#modal_emp_id').val();
                $.ajax({
                    url: "ajax/Employee/select_detail_emp.php",
                    type: "get",
                    dataType: "html",
                    //async: false,
                    data: {eid: eid},
                    success: function (data) {
                        $('#tableDetail').html(data);
                    }
                });
            });

            $('#ModalEdit').on('shown.bs.modal', function () {
                var eid = $('#edit_emp_id').val();
                //console.log(eid);
                $.ajax({
                    url: "ajax/Employee/select_edit_emp.php",
                    type: "get",
                    dataType: "html",
                    //async: false,
                    data: {eid: eid},
                    success: function (data) {
                        $('#tableEdit').html(data);
                        $('.datewar').datepicker({
                            autoclose: true,
                            format: 'yyyy-mm-dd'
                        });
                        $('#reset_pass').on('click', function () {
                            confirm_reset(eid);
                        });
                        $('#edit_emp_tel').inputmask();
                    }
                });
            });
            $('#form-edit').on('submit', function (event) {
                event.preventDefault();
                var data = new FormData(this);
                var r = confirm("ยืนยันการแก้ไขข้อมูล");
                if (r === true) {
                    $.ajax({
                        url: 'ajax/Employee/edit_emp.php',
                        type: 'post',
                        data: data,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            alert(data);
                            location.reload();
                        }
                    });
                }
            });
            $(document).on('click', '.btn_a', function () {
                var emp_id = this.value;
                var type = "admin";
                var r = confirm("ยืนยันการแก้ไขตำแหน่ง");
                if (r === true) {
                    $.ajax({
                        url: "ajax/Employee/update_type.php",
                        type: "post",
                        data: {type: type, id: emp_id},
                        success: function (data) {
                            if (data === "ok") {
                                alert("แก้ไขตำแหน่งเรียบร้อย");
                                TableType.ajax.reload();
                                TableEmp.ajax.reload();
                            }
                        }
                    });
                }
            });
            $(document).on('click', '.btn_u', function () {
                var emp_id = this.value;
                var type = "user";
                var r = confirm("ยืนยันการแก้ไขตำแหน่ง");
                if (r === true) {
                    $.ajax({
                        url: "ajax/Employee/update_type.php",
                        type: "post",
                        data: {type: type, id: emp_id},
                        success: function (data) {
                            if (data === "ok") {
                                alert("แก้ไขตำแหน่งเรียบร้อย");
                                TableType.ajax.reload();
                                TableEmp.ajax.reload();
                            }
                        }
                    });
                }
            });
        });
        function setid(empid) {
            $('#modal_emp_id').val(empid);
            $('#edit_emp_id').val(empid);
        }
        ;
        function confirm_reset(eid) {
            var r = confirm("ยืนยันการรีเซ็ตรหัสผ่าน");
            var state = 'reset';
            if (r === true) {
                $.ajax({
                    url: "ajax/Employee/reset_pass.php",
                    type: "get",
                    //dataType: "html",
                    //async: false,
                    data: {eid: eid, state: state},
                    success: function (data) {
                        alert(data);
                    }
                });
            } else {
            }
        }
        ;
        function banemp(eid) {
            var r = confirm("ยืนยันการระงับใช้งาน");
            var state = 'ban';
            if (r === true) {
                $.ajax({
                    url: "ajax/Employee/reset_pass.php",
                    type: "get",
                    //dataType: "html",
                    //async: false,
                    data: {eid: eid, state: state},
                    success: function (data) {
                        alert(data);
                        //loadTable();
                        //$("#table-emp").dataTable().fnDestroy();
                        TableEmp.ajax.reload(null, false);
                        TableEmpCancel.ajax.reload(null, false);
                    }
                });
            } else {
            }
        }
        ;

        function return_emp(emp_id) {
            //console.log(emp_id);
            var action = 'return';
            var r = confirm('ยืนยันการเปิดใช้งาน');
            if (r === true) {
                $.ajax({
                    url: "ajax/Employee/delete_return_emp.php",
                    type: "get",
                    data: {eid: emp_id, action: action},
                    success: function (data) {
                        alert(data);
                        TableEmpCancel.ajax.reload(null, false);
                        TableEmp.ajax.reload(null, false);
                        TableType.ajax.reload();
                    }
                });
            }
        }
        ;

        function clear_emp(emp_id) {
            //console.log(emp_id);
            var action = 'delete';
            var r = confirm("ยืนยันการลบข้อมูล");
            if (r === true) {
                $.ajax({
                    url: "ajax/Employee/check_del.php",
                    type: "get",
                    data: {eid: emp_id},
                    success: function (data) {
                        if (data === "0") {
                            $.ajax({
                                url: "ajax/Employee/delete_return_emp.php",
                                type: "get",
                                data: {eid: emp_id, action: action},
                                success: function (data) {
                                    //console.log(data);
                                    alert(data);
                                    TableEmpCancel.ajax.reload(null, false);
                                    TableEmp.ajax.reload(null, false);
                                    TableType.ajax.reload();
                                }
                            });
                        } else {
                            alert("ไม่สามารถลบข้อมูลได้");
                        }
                    }
                });
            }
        }
        ;

//        function loadTable() {
//            $("#table-emp").dataTable().fnDestroy();
//            TableEmp = $("#table-emp").DataTable({
//                "ajax": "ajax/Employee/select_employee.php",
//                "bInfo": false,
//                "scrollY": "450px",
//                "scrollCollapse": true,
//                "paging": true,
//                "lengthChange": false,
//                "iDisplayLength": 20,
//                "searching": true,
//                "ordering": true,
//                "info": true,
//                "autoWidth": false,
//                language: language,
//                "columnDefs": [
//                    {"targets": 5, "orderable": false, "searchable": false}
//                ],
//            });
//
//            $("#table-emp-cancel").dataTable().fnDestroy();
//            TableEmpCancel = $("#table-emp-cancel").DataTable({
//                //"ajax": "ajax/Employee/select_employee.php",
//                "bInfo": false,
//                "scrollY": "450px",
//                "scrollCollapse": true,
//                "paging": true,
//                "lengthChange": false,
//                "iDisplayLength": 20,
//                "searching": true,
//                "ordering": true,
//                "info": true,
//                "autoWidth": false,
//                language: language,
//                "columnDefs": [
//                    {"targets": 5, "orderable": false, "searchable": false}
//                ],
//            });
//        };
    </script>
</body>
</html>
