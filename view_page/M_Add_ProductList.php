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
        <title>เพิ่มรายการสินค้า</title>
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
            .dataTables_filter{
                display: none;
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
            <h1><span class="fa fa-plus-square"></span> เพิ่มรายการสินค้า</h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li class="">จัดการสินค้า</li>
                <li class="active">เพิ่มรายการสินค้า</li>
            </ol>
        </section>
        <section class="content" style="height:1080px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="panel-body">        
                            <!--<div class="connet">-->
                            <div id="show_alert" hidden="">
                                <div class="alert alert-success alert-dismissible" id="alert_success">
                                    <h4><i class="icon fa fa-check"></i>เพิ่มรายการสินค้าเรียบร้อย</h4>ทำการเพิ่มข้อมูลรายการสินค้าเรียบร้อยสามารถเข้า <a href="M_Product_List.php">ดูรายการสินค้าได้</a>
                                </div>
                            </div>
                            <div class="box-body">
                                <form class="form-horizontal" id="form-addProduct">
                                    <table class="table table-hover table-responsive">
                                        <tbody>
                                            <tr>
                                                <td width="30%" style="vertical-align:middle; text-align: right;"> รูปสินค้า :</td>
                                                <td colspan="3" width="30%" style="vertical-align:middle; text-align: left;"><input type="file" class="form-control" id="file_pro" name="file_pro" accept="image/*"></td>
                                                <td width="10%"></td>
                                                <td width="10%"></td>
                                                <td width="20%"></td>
                                            </tr>
                                            <tr>
                                                <td width="30%" style="vertical-align:middle; text-align: right;"> รหัสสินค้า :</td>
                                                <td colspan="2" width="20%" style="vertical-align:middle; text-align: left;"><input type="text" class="form-control" id="Product_Id" name="Product_Id" placeholder="" required="" value="" readonly=""/></td>
                                                <td width="10%"></td>
                                                <td width="10%"></td>
                                                <td width="10%"></td>
                                                <td width="20%"></td>
                                            </tr>
                                            <tr> 
                                                <td width="30%" style="vertical-align:middle; text-align: right;"> ประเภทสินค้าหลัก :</td>
                                                <td colspan="3" width="30%" style="vertical-align:middle; text-align: left;">
                                                    <select class="form-control select2" id="DDgroup" name="DDgroup" required="">
                                                    </select>
                                                </td>
                                                <td width="10%"></td>
                                                <td width="10%"></td>
                                                <td width="20%"></td>
                                            </tr>
                                            <tr style="vertical-align:middle;"> 
                                                <td width="30%" style="vertical-align:middle; text-align: right;"> ประเภทสินค้ารอง :</td>
                                                <td colspan="3" width="30%" style="vertical-align:middle; text-align: left;">
                                                    <select class="form-control select2" id="DDsub" name="DDsub" required="">
                                                    </select>
                                                </td>
                                                <td width="10%"></td>
                                                <td width="10%"></td>
                                                <td width="20%"></td>
                                            </tr>
                                            <tr style="vertical-align:middle;"> 
                                                <td width="30%" style="vertical-align:middle; text-align: right;"> ยี่ห้อ :</td>
                                                <td colspan="3" width="30%" style="vertical-align:middle; text-align: left;">
                                                    <select class="form-control select2" id="DDbrand" name="DDbrand" required="">
                                                    </select>
                                                </td>
                                                <td width="10%"></td>
                                                <td width="10%"></td>
                                                <td width="20%"></td>
                                            </tr>
                                            <tr style="vertical-align:middle;"> 
                                                <td width="30%" style="vertical-align:middle; text-align: right;"> ชื่อสินค้า :</td>
                                                <td colspan="3" width="30%" style="vertical-align:middle; text-align: left;">
                                                    <input type="text" class="form-control" id="P_Name" name="P_Name" placeholder="" required="" value="">
                                                </td>
                                                <td width="10%"></td>
                                                <td width="10%"></td>
                                                <td width="20%"></td>
                                            </tr>
                                            <tr style="vertical-align:middle;"> 
                                                <td width="30%" style="vertical-align:middle; text-align: right;"> ราคาสินค้า :</td>
                                                <td colspan="3" width="30%" style="vertical-align:middle; text-align: left;">
                                                    <input type="number" class="form-control" id="P_Price" name="P_Price" placeholder="" required="" value="">
                                                </td>
                                                <td width="10%"></td>
                                                <td width="10%"></td>
                                                <td width="20%"></td>
                                            </tr>
                                            <tr style="vertical-align:middle;"> 
                                                <td width="30%" style="vertical-align:middle; text-align: right;"> รายละเอียดสินค้า :</td>
                                                <td colspan="5" width="50%" style="vertical-align:middle; text-align: left;">
                                                    <textarea class="form-control" id="P_Detail" name="P_Detail" rows="3" placeholder="รายละเอียดสินค้า...." required=""></textarea>
                                                <td width="20%"></td>
                                            </tr>
                                            <tr style="vertical-align:middle;"> 
                                                <td width="30%" style="vertical-align:middle; text-align: right;"></td>
                                                <td colspan="4" width="40%" style="vertical-align:middle; text-align: center;">
                                                    <button type="submit" class="btn btn-success">บันทึก</button>
                                                    <button type="button" class="btn btn-danger" id="btn_cancel" >ยกเลิก</button>
                                                </td>
                                                <td width="10%"></td>
                                                <td width="20%"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <!--</div>-->
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
        $(function () {
            $('.select2').select2();
            loadAll();
            $('#form-addProduct').on('submit', function (event) {
                event.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    url: "ajax/Product/check_add_product.php",
                    type: "post",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function (rs) {
                        if (rs === "0") {
                            var r = confirm("ยืนยันการเพิ่มข้อมูลรายการสินค้า");
                            if (r === true) {
                                $.ajax({
                                    url: 'ajax/Product/insert_product.php',
                                    type: 'post',
                                    data: data,
                                    contentType: false,
                                    processData: false,
                                    success: function () {
                                        alert('เพิ่มข้อมูลเรียบร้อย');
                                        show_success();
                                        clear_form();
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
        $('#btn_cancel').on('click', function () {
            clear_form();
        });
        function loadSub(type) {
            $('#DDsub').empty();
            $.ajax({
                url: 'ajax/Product/select_type_dropdown.php',
                type: "get",
                data: {type: type},
                dataType: 'JSON',
                success: function (data) {
                    $('#DDsub').empty();
                    $.each(data, function (key, val) {
                        $('#DDsub').append('<option id="' + val.id + '" value="' + val.id + '">' + val.name + '</option>');
                    });
                }
            });
        }
        function loadAll() {
            var type = "Product";
            $.ajax({
                url: "ajax/Product/select_idtype.php",
                type: "get",
                async: true,
                data: {type: type},
                success: function (data) {
                    $('#Product_Id').val(data);
                }
            });
            $('#DDgroup').empty();
            $.ajax({
                url: 'ajax/Product/select_type_dropdown.php',
                dataType: 'JSON',
                success: function (data) {
                    $.each(data, function (key, val) {
                        $('#DDgroup').append('<option id="' + val.id + '" value="' + val.id + '">' + val.name + '</option>');
                    })
                    var type = $('#DDgroup').val();
                    loadSub(type);
                }
            });
            $.ajax({
                url: 'ajax/Product/select_brand_dropdown.php',
                dataType: 'JSON',
                success: function (data) {
                    $('#DDbrand').empty();
                    $.each(data, function (key, val) {
                        $('#DDbrand').append('<option id="' + val.id + '" value="' + val.id + '">' + val.name + '</option>');
                    })
                }
            });
            $('#DDgroup').change(function () {
                var type = "";
                $("#DDgroup option:selected").each(function () {
                    type += $(this).val() + " ";
                    loadSub(type);
                });
            });
        }
        ;

        function show_success() {
//            var element = '<div class="alert alert-success alert-dismissible" id="alert_success">';
//            element += '<h4><i class="icon fa fa-check"></i>เพิ่มรายการสินค้าเรียบร้อย</h4>ทำการเพิ่มข้อมูลรายการสินค้าเรียบร้อยสามารถเข้า';
//            element += '<a href="M_Product_List.php">ดูรายการสินค้าได้</a></div>';
//            $('#show_alert').append(element);
            $('#show_alert').removeAttr("hidden", true);
        }
        ;
        function clear_form() {
            $('#file_pro').val('');
            $('#P_Name').val('');
            $('#P_Price').val('');
            $('#P_Detail').val('');
            loadAll();
        }
        ;
    </script>
</body>
</html>
