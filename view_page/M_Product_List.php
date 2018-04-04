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
        <!-- Select 2 -->
        <link href="../plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <title>จัดการายการสินค้า</title>
        <!-- Custom CSS -->
        <style>
            #table-product td{
                vertical-align: middle;
                font-style: normal;
                font-size: 14px; 
                text-align: center;
            }
            #table-product th{
                text-align: center;
            }
            #table-unit td{
                vertical-align: middle;
                font-style: normal;
                font-size: 14px; 
                text-align: center;
            }
            .dataTables_filter{
                display: none;
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
            <h1><span class="fa fa-list-alt"></span> รายการสินค้า</h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>จัดการสินค้า</li>
                <li class="active">รายการสินค้า</li>
            </ol>
        </section>
        <section class="content" style="height:1750px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="box box-default">
                            <div class="panel-body">        
                                <div class="content">          
                                    <div class="box-header bg-green-gradient">
                                        <h3 class="box-title" style="font-family: Tahoma; font-style: normal; font-size: 19px;"><span class="fa fa-search"></span> ค้นหารายการสินค้า</h3>
                                    </div>
                                    <div class="box-body">
                                        <table class="table table-responsive">
                                            <tr>
                                                <td width="15%" style="text-align: right; vertical-align: middle;">ประเภทสินค้าหลัก : </td>
                                                <td width="35%" style="vertical-align: middle;"><select class="form-control select2" id="ddlgroup"></select></td>
                                                <td width="15%" style="text-align: right; vertical-align: middle;">ประเภทสินค้ารอง : </td>
                                                <td width="35%" style="vertical-align: middle;"><select class="form-control select2" id="ddlsubgroup"></select></td>                                                
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="vertical-align: middle;">
                                            <center>
                                                <div class="input-group" style="width: 50%;">
                                                    <input type="text" id="txtSearch" class="form-control" placeholder="ค้นหาข้อมูล...">
                                                    <span class="input-group-btn">
                                                        <button class="btn bg-green-gradient" type="button" id="btn_refresh"><span class="fa fa-refresh"></span> รีเฟรช</button>
                                                    </span>
                                                </div>                                              
                                            </center>
                                            </td>
                                            </tr>
                                        </table>
                                        <table id="table-product" class="table table-bordered table-hover table-responsive" >
                                            <thead>
                                                <tr class="bg-green-gradient"style="vertical-align: middle; font-family: Tahoma; font-style: normal; font-size: 14px; font-weight: bold; text-align: center;">
                                                    <td width="100px">ลำดับ</td>
                                                    <td width="150px">รหัสสินค้า</td>
                                                    <td width="250px">ชื่อสินค้า</td>
                                                    <td width="150px">ประเภทหลัก</td>
                                                    <td width="150px">ยี่ห้อ</td>
                                                    <td width="150px">ราคา</td>
                                                    <td width="150px">สถานะ</td>
                                                    <td width="150px">ยอดคงเหลือ</td>
                                                    <td width="150px"></td>
                                                </tr>
                                            </thead>
                                        </table> 
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
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
    <!-- Modal Detail -->
    <div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form-find">
                    <div class="modal-header bg-aqua-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-info-circle"></span> รายละเอียดสินค้า</h4>
                    </div>
                    <!--style="height:1600px;"-->
                    <div class="modal-body">  
                        <input type="hidden" id="pid_detail"/>
                        <table class="table table-responsive table-hover" id="tableDetail">
                        </table>
                        <div class="col-md-12" style="margin-top:10px; margin-bottom: 10px;">                                            
                            <div class="input-group center-block" style="width:50%;">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="txt_unit" name="txt_unit" placeholder="ค้นหาสินค้า ...">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn bg-aqua-gradient" id="" name=""><span class="fa fa-search"></span> ค้นหา</button> 
                                    </div>
                                </div>
                            </div>                                           
                        </div>
                        <table class="table table-bordered table-hover table-responsive" id="table-unit">
                            <thead>
                                <tr class="bg-aqua-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 14px; font-weight: bold;">
                                    <td width="10%">ลำดับ</td>
                                    <td width="25%">Serial Number</td>
                                    <td width="20%">Unit_ID</td>
                                    <td width="15%">ระยะเวลาประกัน</td>
                                    <td width="15%">วันที่รับเข้า</td>
                                    <td width="15%">วันที่หมดประกัน</td>
                                </tr>
                            </thead>
                        </table>         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    <div class="modal fade" id="ModalEdit" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!-- form edit -->
                <form class="form-horizontal" id="form-edit"> 
                    <div class="modal-header bg-yellow-active color-palette">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-list"></span> แก้ไขข้อมูลสินค้า</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_product_id"/>
                        <div class="box box-default">
                            <div class="box-body no-border">
                                <table class="table table-responsive table-hover" id="tableEdit">
                                </table>
                            </div>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning" id="btn_edit" name="btn_edit" > แก้ไขข้อมูล</button>
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
    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <!-- language DataTable-->
    <script src="script/global.js" type="text/javascript"></script>
    <script>
        var tableProduct;
        var tableUnit;
        var element;
        $(function () {
            loadAll();
            $('#txtSearch').keyup(function () {
                tableProduct.search(this.value).draw();
            });
            $('#txt_unit').keyup(function () {
                tableUnit.search(this.value).draw();
            });
            $('.select2').select2();
//  LOAD Dropdown Group
            $.ajax({
                url: 'ajax/Product/select_type_dropdown.php',
                dataType: 'JSON',
                success: function (data) {
                    $('#ddlgroup').append('<option id="All" value="All">All</option>');
                    $.each(data, function (key, val) {
                        $('#ddlgroup').append('<option id="' + val.id + '" value="' + val.id + '">' + val.name + '</option>');
                    });
                }
            });
            $('#btn_refresh').on('click', function () {
                location.reload();
            });
// SET Dropdown SubGroup
            $('#ddlsubgroup').append('<option id="All" value="All">All</option>');
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
// Modal Detail 
            $('#ModalDetail').on('shown.bs.modal', function () {
                var pid = $('#pid_detail').val();
                $.ajax({
                    url: "ajax/Product/select_Detail.php",
                    type: "get",
                    dataType: "html",
                    //async: false,
                    data: {pid: pid},
                    success: function (data) {
                        $('#tableDetail').html(data);
                    }
                });
                //$("#table-unit").dataTable().fnDestroy();
                tableUnit = $("#table-unit").DataTable({
                    destroy: true,
                    ajax: {
                        url: "ajax/Product/select_unit.php",
                        type: "get",
                        data: {id: pid}
                    },
                    "bInfo": true,
                    "sScrollY": "250px",
                    "sScrollX": "1080px",
                    "bScrollCollapse": true,
                    "paging": true,
                    "lengthChange": false,
                    "iDisplayLength": 20,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    language: language,
                });
            });

            $('#ModalEdit').on('shown.bs.modal', function () {
                var id = $('#edit_product_id').val();
                $.ajax({
                    url: "ajax/Product/select_edit_product.php",
                    type: "get",
                    dataType: "html",
                    data: {pid: id},
                    success: function (data) {
                        $('#tableEdit').html(data);
                        $('.select2').select2();
                    }
                });
            });

            $('#form-edit').on('submit', function (e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    url: "ajax/Product/check_edit_product.php",
                    type: "post",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function (rs) {
                        //console.log(rs);
                        if (rs === 'ok') {
                            var r = confirm("ยืนยันการแก้ไขข้อมูล");
                            if (r === true) {
                                $.ajax({
                                    url: "ajax/Product/edit_product_detail.php",
                                    type: "post",
                                    data: data,
                                    contentType: false,
                                    processData: false,
                                    success: function (data) {
                                        alert(data);
                                        $('#ModalEdit').modal('hide');
                                        tableProduct.ajax.reload(null, false);
                                    }
                                });
                            }
                        } else {
                            alert("รายการสินค้านี้มีอยู่ในระบบแล้ว");
                        }
                    }
                });
            });
        });
        function loadAll() {
            tableProduct = $("#table-product").DataTable({
                "ajax": "ajax/Product/select_all_product.php",
                "scrollX": "1400px",
                "scrollCollapse": true,
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    {"targets": 2, "orderable": false},
                    {"targets": 6, "orderable": true, "searchable": true},
                    {"targets": 7, "orderable": true, "searchable": true},
                    {"targets": 8, "orderable": false, "searchable": false}],
                language: language
            });
        }
        function loadData(id, sub) {
            $("#table-product").dataTable().fnDestroy();
            tableProduct = $("#table-product").DataTable({
                ajax: {
                    url: "ajax/Product/select_sg_product.php",
                    type: "get",
                    data: {id: id, sub: sub}
                },
                "scrollX": "1400px",
                "scrollCollapse": true,
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    {"targets": 2, "orderable": false},
                    {"targets": 6, "orderable": true, "searchable": true},
                    {"targets": 7, "orderable": true, "searchable": true},
                    {"targets": 8, "orderable": false, "searchable": false}],
                language: language
            });
        }
        ;
//        $(document).on('keyup', '#txtSearch', function () {
//            var a = this.value;
//            tableProduct.search(this.value).draw();
//            //alert(this.value);
//        });

        //            language: {
        //                search: "_INPUT_",
        //                searchPlaceholder: "Search..."
        //            }
        function setpid(a) {
            $('#pid_detail').val(a);
            $('#ModalDetail').modal("show");
        }
        ;
        function setedit(a) {
            $('#edit_product_id').val(a);
            $('#ModalEdit').modal("show");
        }
        function setcancel(a) {
            var action = "cancel";
            $.ajax({
                url: "ajax/Product/check_cancel_product.php",
                type: "post",
                data: {P_ID: a, action: action},
                success: function (data) {
                    //console.log(data);
                    if (data === 'ok') {
                        var r = confirm("ยืนยันการยกเลิกข้อมูลสินค้า");
                        if (r === true) {
                            $.ajax({
                                url: "ajax/Product/delete_return_product.php",
                                type: "post",
                                data: {P_ID: a, action: action},
                                success: function (data) {
                                    alert(data);
                                    tableProduct.ajax.reload(null, false);
                                }
                            });
                        }
                    } else {
                        alert("มีสินค้าคงเหลือ!! ไม่สามารถยกเลิกข้อมูลรายการสินค้าได้");
                    }
                }
            });
        }
        function setremove(a) {
            var action = "remove";
            $.ajax({
                url: "ajax/Product/check_cancel_product.php",
                type: "post",
                data: {P_ID: a, action: action},
                success: function (data) {
                    if (data === 'ok') {
                        var r = confirm("ยืนยันการลบข้อมูลสินค้า");
                        if (r === true) {
                            $.ajax({
                                url: "ajax/Product/delete_return_product.php",
                                type: "post",
                                data: {P_ID: a, action: action},
                                success: function (data) {
                                    alert(data);
                                    tableProduct.ajax.reload(null, false);
                                }
                            });
                        }
                    } else {
                        alert("รายการสินค้านี้ได้ถูกใช้งานแล้ว ไม่สามารถลบได้");
                    }
                }
            });
        }
        function setopen(a) {
            var r = confirm("ยืนยันการเปิดใช้งานรายการสินค้า");
            if (r === true) {
                $.ajax({
                    url: "ajax/Product/open_product.php",
                    type: "post",
                    data: {P_ID: a},
                    success: function (data) {
                        alert(data);
                        tableProduct.ajax.reload(null, false);
                    }
                });
            }
        }
        ;
    </script>
</body>
</html>
