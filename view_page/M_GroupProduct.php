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
        <title>การจัดการประเภทสินค้า - ยี่ห้อ</title>
        <style>
            #table-group td{
                vertical-align: middle;
                font-style: normal;
                font-size: 14px; 
                text-align: center;
            }
            #table-subgroup td{
                vertical-align: middle;
                font-style: normal;
                font-size: 14px; 
                text-align: center;               
            }
            #table-brand td{
                vertical-align: middle;
                font-style: normal;
                font-size: 14px; 
                text-align: center;
            }
            .dataTables_filter{
                display: none;
            }
            /*            #table-group tr:nth-child(even){
                            background-color: #dddddd;
                        }*/
        </style>
        <!--sidebar-collapse-->
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
                <span class="fa fa-th-large"></span> จัดการประเภทสินค้า - ยี่ห้อ
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">จัดการประเภทสินค้า - ยี่ห้อ</li>
            </ol>
        </section>
        <section class="content" style="height:1600px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"> </h3>
                        </div>
                        <div class="panel-body">        
                            <div class="col-md-12">
                                <div class="btn-group" style="margin-bottom: 15px;">
                                    <button type="button" class="btn bg-green-gradient dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-plus-square"></span>  เพิ่มรายการประเภทสินค้า</button>
                                    <ul id="listgroup" class="dropdown-menu">
                                        <li><a data-toggle="modal" href="#ModalGroup" class="modal-group"><span class="glyphicon glyphicon-king"></span> ประเภทสินค้าหลัก</a></li>
                                        <li><a data-toggle="modal" href="#ModalSub" class="modal-group"><span class="glyphicon glyphicon-queen"></span> ประเภทสินค้าย่อย</a></li>
                                        <li><a data-toggle="modal" href="#ModalBrand" class="modal-group"><span class="glyphicon glyphicon-comment"></span> ยี่ห้อสินค้า</a></li>
                                    </ul>
                                </div>
                            </div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#t_type" data-toggle="tab"><i class="glyphicon glyphicon-king"></i> ประเภทสินค้า</a></li>
                                <li><a href="#t_stype"  data-toggle="tab"><i class="glyphicon glyphicon-queen"></i> ประเภทสินค้าย่อย</a></li>
                                <li><a href="#t_brand"  data-toggle="tab"><i class="glyphicon glyphicon-comment"></i> ยี่ห้อสินค้า</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="t_type" class="tab-pane in active fade">
                                    <div class="col-md-12" style="margin:15px;">
                                        <center>
                                            <div class="input-group" style="width: 50%;">
                                                <input type="text" id="findGroup" class="form-control" placeholder="ค้นหาข้อมูล...">
                                                <span class="input-group-btn">
                                                    <button class="btn bg-green-gradient btn_re" type="button" id="btntest"><span class="fa fa-refresh"></span> รีเฟรช</button>
                                                </span>
                                            </div>                                              
                                        </center>
                                    </div>
                                    <table id="table-group" class="table table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr class="bg-green-gradient" style="vertical-align: middle; text-align: center; font-weight: bold; font-size: 16px;">
                                                <td width="10%">ลำดับ</td>
                                                <td width="20%">รหัสประเภทสินค้า</td>
                                                <td width="30%">ชื่อประเภทสินค้า</td>
                                                <td width="15%">สถานะ</td>
                                                <td width="25%"></td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div id="t_stype" class="tab-pane fade">
                                    <div class="col-md-12" style="margin:15px;">
                                        <center>
                                            <div class="input-group" style="width: 50%;">
                                                <input type="text" id="findSub" class="form-control" placeholder="ค้นหาข้อมูล...">
                                                <span class="input-group-btn">
                                                    <button class="btn bg-yellow-gradient btn_re" type="button" id="btntest"><span class="fa fa-refresh"></span> รีเฟรช</button>
                                                </span>
                                            </div>                                              
                                        </center>
                                    </div>
                                    <table id="table-subgroup" class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="bg-yellow-gradient" style="vertical-align: middle; text-align: center; font-weight: bold; font-size: 16px;">
                                                <td width="10%">ลำดับ</td>
                                                <td width="20%">รหัสประเภทสินค้าย่อย</td>
                                                <td width="20%">ชื่อประเภทสินค้าย่อย</td>
                                                <td width="20%">ประเภทสินค้าหลัก</td>
                                                <td width="15%">สถานะ</td>
                                                <td width="15%"></td>
                                            </tr>
                                        </thead>
                                    </table>  
                                </div>
                                <div id="t_brand" class="tab-pane fade">
                                    <div class="col-md-12" style="margin:15px;">
                                        <center>
                                            <div class="input-group" style="width: 50%;">
                                                <input type="text" id="findBrand" class="form-control" placeholder="ค้นหาข้อมูล...">
                                                <span class="input-group-btn">
                                                    <button class="btn bg-blue-gradient btn_re" type="button" id=""><span class="fa fa-refresh"></span> รีเฟรช</button>
                                                </span>
                                            </div>                                              
                                        </center>
                                    </div>
                                    <table id="table-brand" class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="bg-blue-gradient" style="vertical-align: middle; text-align: center; font-weight: bold; font-size: 16px;">
                                                <td width="10%">ลำดับ</td>
                                                <td width="25%">รหัสยี่ห้อสินค้า</td>
                                                <td width="25%">ชื่อยี่ห้อสินค้า</td>
                                                <td width="15%">สถานะ</td>
                                                <td width="30%"></td>
                                            </tr>
                                        </thead>
                                    </table>  
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
</div>
<!--Modal Group-->
<?php include '../lib/modal_group.php'; ?>
<!--Modal Sub-->
<?php include '../lib/modal_sub.php'; ?>
<!--Modal Brand -->
<?php include '../lib/modal_brand.php' ?>
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
<!-- Select2 -->
<script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>
<script src="script/global.js" type="text/javascript"></script>
<script>
    var tableGroup;
    var tableBrand;
    var tableSub;
    $(function () {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
            $.each($.fn.dataTable.tables({visible: true, api: true}), function (_i, table) {
                $(table).DataTable().columns.adjust();
            });
        });
        $(document).on('click', '.btn_re', function () {
            location.reload();
        });
        $('#findGroup').keyup(function () {
            tableGroup.search(this.value).draw();
        });
        $('#findSub').keyup(function () {
            tableSub.search(this.value).draw();
        });
        $('#findBrand').keyup(function () {
            tableBrand.search(this.value).draw();
        });
        tableGroup = $("#table-group").DataTable({
            "ajax": "ajax/Product/select_group.php",
            "bInfo": true,
            "paging": true,
            "lengthChange": false,
            "iDisplayLength": 30,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "columnDefs": [
                {"targets": 4, "orderable": false, "searchable": false}],
            language: language,
        });
        tableSub = $("#table-subgroup").DataTable({
            "ajax": "ajax/Product/select_subgroup.php",
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
        tableBrand = $("#table-brand").DataTable({
            "ajax": "ajax/Product/select_brand.php",
            "bInfo": true,
            "paging": true,
            "lengthChange": false,
            "iDisplayLength": 30,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "columnDefs": [
                {"targets": 4, "orderable": false, "searchable": false}],
            language: language,
        });
        //              --Add Group--
        $('#form-addGroup').on('submit', function (e) {
            e.preventDefault();
            var Group_Id = $('#Group_Id').val();
            var Group_Name = $('#Group_Name').val();
            var action = 'insert';
            $.ajax({
                url: "ajax/Product/check_add_edit_group.php",
                type: "post",
                data: {G_ID: Group_Id, G_Name: Group_Name},
                success: function (rs) {
                    if (rs === "0") {
                        var r = confirm("ยืนยันการเพิ่มข้อมูล");
                        if (r === true) {
                            $.ajax({
                                url: 'ajax/Product/insert_update_type.php',
                                type: 'post',
                                data: {action: action, Group_Id: Group_Id, Group_Name: Group_Name},
                                success: function (data) {
                                    alert(data);
                                    $('#Group_Name').val('');
                                    $('#ModalGroup').modal('hide');
                                    tableGroup.ajax.reload(null, false);
                                }
                            });
                        }
                    } else {
                        alert("ประเภทสินค้าหลักนี้ได้ถูกเพิ่มแล้ว");
                    }
                }
            });
        });
        //              --Group edit--
        $('#form-edit-group').on('submit', function (e) {
            e.preventDefault();
            var GID = $('#Group_Id-edit').val();
            var Gname = $('#Group_Name-edit').val();
            var action = 'update';
            $.ajax({
                url: "ajax/Product/check_add_edit_group.php",
                type: "post",
                data: {G_ID: GID, G_Name: Gname},
                success: function (rs) {
                    if (rs === "1") {
                        var r = confirm("ยืนยันการแก้ไขข้อมูล");
                        if (r === true) {
                            $.ajax({
                                url: 'ajax/Product/insert_update_type.php',
                                type: 'post',
                                data: {action: action, Group_ID_edit: GID, Group_Name_edit: Gname},
                                success: function (data) {
                                    alert(data);
                                    $('#ModalGroup-edit').modal('hide');
                                    tableGroup.ajax.reload(null, false);
                                    tableSub.ajax.reload(null, false);
                                }
                            });
                        }
                    } else {
                        alert("ประเภทสินค้าหลักนี้มีอยู่แล้ว");
                    }
                }
            });
        });
        //              --Add Sub--                
        $('#form-Sub').on('submit', function (e) {
            e.preventDefault();
            var SGID = $('#Sub_Id').val();
            var GID = $('#DDgroup').val();
            var SGName = $('#Sub_Name').val();
            var action = 'insert';
            $.ajax({
                url: "ajax/Product/check_add_edit_sub.php",
                type: "post",
                data: {action: action, G_ID: GID, SG_ID: SGID, SG_Name: SGName},
                success: function (rs) {
                    if (rs === "0") {
                        var r = confirm("ยืนยันการเพิ่มข้อมูล");
                        if (r === true) {
                            $.ajax({
                                url: 'ajax/Product/insert_update_subtype.php',
                                type: 'post',
                                data: {action: action, Sub_Id: SGID, DDgroup: GID, Sub_Name: SGName},
                                success: function (data) {
                                    alert(data);
                                    tableGroup.ajax.reload(null, false);
                                    tableSub.ajax.reload(null, false);
                                    $('#Sub_Name').val('');
                                    $('#ModalSub').modal('hide');
                                }
                            });
                        }
                    } else {
                        alert("ประเภทสินค้ารองนี้มีอยู่แล้ว");
                    }
                }
            });
        });
        //              --Edit Sub--            
        $('#form-Sub-edit').on('submit', function (e) {
            e.preventDefault();
            var SGID = $('#Sub_Id-edit').val();
            var GID = $('#DDgroup-edit').val();
            var SGName = $('#Sub_Name-edit').val();
            var action = 'update';
            $.ajax({
                url: "ajax/Product/check_add_edit_sub.php",
                type: "post",
                data: {action: action, G_ID: GID, SG_ID: SGID, SG_Name: SGName},
                success: function (rs) {
                    if (rs === "0") {
                        var r = confirm("ยืนยันการแก้ไขข้อมูล");
                        if (r === true) {
                            $.ajax({
                                url: 'ajax/Product/insert_update_subtype.php',
                                type: 'post',
                                data: {action: action, Sub_Id: SGID, DDgroup: GID, Sub_Name: SGName},
                                success: function (data) {
                                    alert(data);
                                    $('#ModalSub-edit').modal('hide');
                                    tableGroup.ajax.reload(null, false);
                                    tableSub.ajax.reload(null, false);
                                }
                            });
                        }
                    } else {
                        alert("ประเภทสินค้ารองนี้มีอยู่แล้ว");
                    }
                }
            });

        });
        //              -- Add Brand --
        $('#form-addBrand').on('submit', function (e) {
            e.preventDefault();
            var data = $('#form-addBrand').serialize();
            var b_id = $('#Brand_Id').val();
            var b_name = $('#Brand_Name').val();
            $.ajax({
                url: "ajax/Product/check_add_edit_brand.php",
                type: "post",
                data: {Brand_Id: b_id, Brand_Name: b_name},
                success: function (rs) {
                    if (rs === "0") {
                        var r = confirm("ยืนยันการเพิ่มข้อมูลยี่ห้อสินค้า");
                        if (r === true) {
                            $.ajax({
                                url: 'ajax/Product/insert_update_brand.php',
                                type: 'post',
                                data: data,
                                success: function (data) {
                                    alert(data);
                                    tableBrand.ajax.reload(null, false);
                                    tableSub.ajax.reload(null, false);
                                    tableGroup.ajax.reload(null, false);
                                    $('#ModalBrand').modal('hide');
                                }
                            });
                        }
                    } else {
                        alert("ยี่ห้อสินค้านี้มีอยู่แล้ว");
                    }
                }
            });
        });
//              -- Edit Brand --
        $('#form-brand-edit').on('submit', function (e) {
            e.preventDefault();
            var data = $('#form-brand-edit').serialize();
            var b_id = $('#Brand_Id-edit').val();
            var b_name = $('#Brand_Name-edit').val();
            $.ajax({
                url: "ajax/Product/check_add_edit_brand.php",
                type: "post",
                data: {Brand_Id: b_id, Brand_Name: b_name},
                success: function (rs) {
                    if (rs === "1") {
                        var r = confirm("ยืนยันการแก้ไขข้อมูลยี่ห้อสินค้า");
                        if (r === true) {
                            $.ajax({
                                url: 'ajax/Product/insert_update_brand.php',
                                type: 'post',
                                data: data,
                                success: function (data) {
                                    alert(data);
                                    tableBrand.ajax.reload(null, false);
                                    tableSub.ajax.reload(null, false);
                                    tableGroup.ajax.reload(null, false);
                                    $('#ModalBrand-edit').modal('hide');
                                }
                            });
                        }
                    } else {
                        alert('ยี่ห้อสินค้านี้มีอยู่แล้ว');
                    }
                }
            });
        });
        $('#ModalGroup').on('shown.bs.modal', function () {
            $('#Group_Name').val("");
            var type = "Group";
            $.ajax({
                url: "ajax/Product/select_idtype.php",
                type: "get",
                async: true,
                data: {type: type},
                success: function (data) {
                    $('#Group_Id').val(data);
                }
            });
        });
        $('#ModalSub').on('shown.bs.modal', function () {
            $('#Sub_Name').val("");
            var type = "Sub";
            $.ajax({
                url: "ajax/Product/select_idtype.php",
                type: "get",
                async: true,
                data: {type: type},
                success: function (data) {
                    $('#Sub_Id').val(data);
                }
            });
            $.ajax({
                url: 'ajax/Product/select_type_dropdown.php',
                dataType: 'JSON',
                success: function (data) {
                    $('.select2').select2();
                    $('#DDgroup').empty();
                    $.each(data, function (key, val) {
                        $('#DDgroup').append('<option id="' + val.id + '" value="' + val.id + '">' + val.name + '</option>');
                    })
                }
            });
        });
        $('#ModalBrand').on('shown.bs.modal', function () {
            $('#Brand_Name').val("");
            var type = "Brand";
            $.ajax({
                url: "ajax/Product/select_idtype.php",
                type: "get",
                async: true,
                data: {type: type},
                success: function (data) {
                    $('#Brand_Id').val(data);
                }
            });
        });
    });

    function EditGroup(a, b) {
        $('#Group_Id-edit').val(a);
        $('#Group_Name-edit').val(b);
    }
    ;
    function CancelGroup(a) {
        var action = "cancel";
        $.ajax({
            url: "ajax/Product/check_cancel_type.php",
            type: "post",
            data: {GID: a, action: action},
            success: function (data) {
                if (data === 'ok') {
                    var r = confirm("ยืนยันการยกเลิกใช้งานประเภทสินค้าหลัก");
                    var action = "cancel";
                    if (r === true) {
                        $.ajax({
                            url: "ajax/Product/insert_update_type.php",
                            type: "post",
                            data: {Cancel_Id: a, action: action},
                            success: function (data) {
                                alert(data);
                                tableGroup.ajax.reload(null, false);
                                tableSub.ajax.reload(null, false);
                            }
                        });
                    }
                } else {
                    alert("มีสินค้าคงเหลือ ไม่สามารถยกเลิกงานประเภทสินค้าหลักได้");
                }
            }
        });
    }
    ;
    function RemoveGroup(a) {
        var action = "remove";
        $.ajax({
            url: "ajax/Product/check_cancel_type.php",
            type: "post",
            data: {GID: a, action: action},
            success: function (data) {
                if (data === 'ok') {
                    var r = confirm("ยืนยันการลบประเภทสินค้าหลักออกจากระบบ");
                    var action = "remove";
                    if (r === true) {
                        $.ajax({
                            url: "ajax/Product/insert_update_type.php",
                            type: "post",
                            data: {Remove_Id: a, action: action},
                            success: function (data) {
                                alert(data);
                                tableGroup.ajax.reload(null, false);
                                tableSub.ajax.reload(null, false);
                            }
                        });
                    }
                } else {
                    alert("ไม่สามารถลบประเภทได้ : เนื่องจากได้มีการใช้งานประเภทสินค้านี้แล้ว");
                }
            }
        });
    }
    ;

    function OpenGroup(a) {
        var r = confirm("ยืนยันการเปิดใช้งานประเภทสินค้าหลัก");
        var action = "open";
        if (r === true) {
            $.ajax({
                url: "ajax/Product/insert_update_type.php",
                type: "post",
                data: {Open_Id: a, action: action},
                success: function (data) {
                    alert(data);
                    tableGroup.ajax.reload(null, false);
                    tableSub.ajax.reload(null, false);
                }
            });
        }
    }
    ;

    function EditSub(a, b, c) {
        $('#Sub_Id-edit').val(a);
        $('#Sub_Name-edit').val(b);
        $.ajax({
            url: 'ajax/Product/select_type_dropdown.php',
            dataType: 'JSON',
            success: function (data) {
                $('.select2').select2();
                $('#DDgroup-edit').empty();
                $.each(data, function (key, val) {
                    $('#DDgroup-edit').append('<option id="' + val.id + '" value="' + val.id + '">' + val.name + '</option>');
                })
                $("#DDgroup-edit").val(c).trigger('change');
            }
        });
    }
    ;

    function OpenSub(a) {
        var r = confirm("ยืนยันการเปิดใช้งานประเภทสินค้ารอง");
        var action = "open";
        //console.log(a);
        if (r === true) {
            $.ajax({
                url: "ajax/Product/insert_update_subtype.php",
                type: "post",
                data: {Open_Id: a, action: action},
                success: function (data) {
                    alert(data);
                    tableGroup.ajax.reload(null, false);
                    tableSub.ajax.reload(null, false);
                }
            });
        }
    }
    ;

    function CancelSub(a) {
        var action = "cancel";
        $.ajax({
            url: "ajax/Product/check_cancel_subtype.php",
            type: "post",
            data: {SGID: a, action: action},
            success: function (data) {
                if (data === 'ok') {
                    var r = confirm("ยืนยันการยกเลิกใช้งานประเภทสินค้ารอง");
                    var action = "cancel";
                    if (r === true) {
                        $.ajax({
                            url: "ajax/Product/insert_update_subtype.php",
                            type: "post",
                            data: {Cancel_Id: a, action: action},
                            success: function (data) {
                                alert(data);
                                tableGroup.ajax.reload(null, false);
                                tableSub.ajax.reload(null, false);
                            }
                        });
                    }
                } else {
                    alert("มีสินค้าคงเหลือ ไม่สามารถยกเลิกประเภทได้");
                }
            }
        });
    }
    ;

    function RemoveSub(a) {
        var action = "remove";
        $.ajax({
            url: "ajax/Product/check_cancel_subtype.php",
            type: "post",
            data: {SGID: a, action: action},
            success: function (data) {
                if (data === 'ok') {
                    var r = confirm("ยืนยันลบประเภทสินค้ารองออกจากระบบ");
                    var action = "remove";
                    if (r === true) {
                        $.ajax({
                            url: "ajax/Product/insert_update_subtype.php",
                            type: "post",
                            data: {Remove_Id: a, action: action},
                            success: function (data) {
                                alert(data);
                                tableGroup.ajax.reload(null, false);
                                tableSub.ajax.reload(null, false);
                            }
                        });
                    }
                } else {
                    alert("ไม่สามารถลบประเภทรองได้ : เนื่องจากได้มีการใช้งานประเภทสินค้ารองนี้แล้ว");
                }
            }
        });
    }
    ;

    function EditBrand(a, b) {
        $('#Brand_Id-edit').val(a);
        $('#Brand_Name-edit').val(b);
    }
    ;
    function OpenBrand(a) {
        var r = confirm("ยืนยันการเปิดใช้งานยี่ห้อ");
        if (r === true) {
            var action = 'open';
            $.ajax({
                url: "ajax/Product/insert_update_brand.php",
                type: "post",
                data: {action_brand: action, Open_Id_Brand: a},
                success: function (data) {
                    alert(data);
                    tableBrand.ajax.reload(null, false);
                }
            });
        }
    }
    ;
    function CancelBrand(a) {
        $.ajax({
            url: "ajax/Product/check_cancel_brand.php",
            type: "post",
            data: {B_ID: a},
            success: function (data) {
                if (data === 'ok') {
                    var r = confirm("ยืนยันการยกเลิกการใช้งานยี่ห้อ");
                    var action = "cancel";
                    if (r === true) {
                        $.ajax({
                            url: "ajax/Product/insert_update_brand.php",
                            type: "post",
                            data: {Cancel_Id_Brand: a, action_brand: action},
                            success: function (data) {
                                alert(data);
                                tableBrand.ajax.reload(null, false);
                            }
                        });
                    }
                } else {
                    alert("รายการยี่ห้อนี้ยังมีสินค้าที่ใช้งานอยู่ ! ไม่สามารถยกเลิกการใช้ได้");
                }
            }
        });
    }
    ;
    function RemoveBrand(a) {
        $.ajax({
            url: "ajax/Product/check_cancel_brand.php",
            type: "post",
            data: {B_ID: a},
            success: function (data) {
                if (data === 'ok') {
                    var r = confirm("ยืนยันการระงับการใช้งานยี่ห้อ");
                    var action = "remove";
                    if (r === true) {
                        $.ajax({
                            url: "ajax/Product/insert_update_brand.php",
                            type: "post",
                            data: {Remove_Id_Brand: a, action_brand: action},
                            success: function (data) {
                                alert(data);
                                tableBrand.ajax.reload(null, false);
                            }
                        });
                    }
                } else {
                    alert("รายการยี่ห้อนี้ยังมีสินค้าที่ใช้งานอยู่ ! ไม่สามารถระงับการใช้ได้");
                }
            }
        });
    }
    ;

</script>
</body>
</html>
