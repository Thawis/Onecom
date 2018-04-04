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
        <!-- iCheck -->
        <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css"/>
        <!-- DataTable -->
        <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
        <!-- daterange picker -->
        <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
        <!-- Select 2 -->
        <link href="../plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <title>รายละเอียดข้อมูลร้าน</title>
        <!-- Custom CSS -->
        <style>
            #tableShop td{
                vertical-align: middle;
            }
            .font_1{
                text-align: right;
                font-family: Tahoma, Verdana, Segoe, sans-serif;
                font-size: 16px;
                vertical-align: middle;
                font-style: normal;
                font-weight: bold;
            }
            .font_2{
                text-align: center;
                font-family: Tahoma, Verdana, Segoe, sans-serif;
                font-size: 16px;
                vertical-align: middle;
                font-style: normal;
                font-weight: bold;
            }
            #tableDetail td{
                vertical-align: middle;
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
            <h1><span class="fa fa-info-circle"></span> รายละเอียดข้อมูลร้าน</h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <!--<li>จัดการสินค้า</li>-->
                <li>จัดการข้อมูลร้าน</li>
                <li class="active">รายละเอียดข้อมูลร้าน</li>
            </ol>
        </section>
        <section class="content" style="height:1600px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="box box-default">
                            <div class="panel-body">        
                                <div class="content">
                                    <div class="box-body">
                                        <table class="table table-hover no-border" id="tableDetail">
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
    <!-- Modal Detail -->
    <div class="modal fade" id="ModalShop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_addshop">
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-plus-square"></span> เพิ่มข้อมูลร้าน</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-bordered" id="tableShop">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="font_1">LOGO ร้าน : </td>
                                            <td width="40%"><input type="file" class="form-control" id="file_shop" name="file_shop" accept="image/*"/></td>
                                            <td width="30%"></td> 
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1">ชื่อร้าน : </td>
                                            <td width="40%"><input type="text" class="form-control" id="shop_name" name="shop_name" required=""></td>
                                            <td width="30%"></td> 
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1">ที่อยู่ : </td>
                                            <td width="70%" colspan="2"><textarea rows="3" class="form-control" id="shop_address" name="shop_address" required=""></textarea></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1">เบอร์โทรศัพท์ : </td>
                                            <td width="40%"><input type="text" class="form-control" id="shop_tel" name="shop_tel" data-inputmask='"mask": "99-999-9999"' data-mask required="" ></td>
                                            <td width="30%"></td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-green-gradient">เพิ่มข้อมูลร้าน</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    <div class="modal fade" id="ModalShopEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_editshop">
                    <div class="modal-header bg-yellow-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-pencil"></span> แก้ไขข้อมูลร้าน</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <input type="hidden" id="edit_shop_img" name="edit_shop_img" value=""/> 
                                <table class="table table-responsive table-bordered" id="tableShop">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="font_1">LOGO ร้าน : </td>
                                            <td width="40%"><input type="file" class="form-control" id="edit_file_shop" name="edit_file_shop" accept="image/*"/></td>
                                            <td width="30%"></td> 
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1">ชื่อร้าน : </td>
                                            <td width="40%"><input type="text" class="form-control" id="edit_shop_name" name="edit_shop_name" required=""></td>
                                            <td width="30%"></td> 
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1">ที่อยู่ : </td>
                                            <td width="70%" colspan="2"><textarea rows="3" class="form-control" id="edit_shop_address" name="edit_shop_address" required=""></textarea></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1">เบอร์โทรศัพท์ : </td>
                                            <td width="40%"><input type="text" class="form-control" id="edit_shop_tel" name="edit_shop_tel" data-inputmask='"mask": "99-999-9999"' data-mask="" required="" ></td>
                                            <td width="30%"></td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-yellow-gradient">แก้ไขข้อมูลร้าน</button>
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
    <!-- iCheck -->
    <script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- language DataTable-->
    <script src="script/global.js" type="text/javascript"></script>
    <script>
        $(function () {
            loadData();
            $("[data-mask]").inputmask();
            $(document).on('click', '#add_shop', function () {
                $('#ModalShop').modal('show');
            });
            $(document).on('click', '#edit_shop', function () {
                $('#ModalShopEdit').modal('show');
            });
            $('#ModalShopEdit').on('shown.bs.modal',function(){
                $.ajax({
                   url:"ajax/shop/load_edit_shop_detail.php",
                   dataType:'JSON',
                   success: function(rs){
                        //console.log(rs);
                        $('#edit_shop_name').val(rs.name);
                        $('#edit_shop_address').val(rs.address);
                        $('#edit_shop_tel').val(rs.tel);
                        $('#edit_shop_img').val(rs.img);
                   }
                });
            });
            $('#form_addshop').on('submit', function (e) {
                e.preventDefault();
                var data = new FormData(this);
                var r = confirm("ยืนยันการเพิ่มข้อมูลร้าน");
                if (r === true) {
                    $.ajax({
                        url: "ajax/shop/insert_shop.php",
                        type: "post",
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
            $('#form_editshop').on('submit', function (e) {
                e.preventDefault();
                var data = new FormData(this);
                var r = confirm("ยืนยันการเพิ่มข้อมูลร้าน");
                if (r === true) {
                    $.ajax({
                        url: "ajax/shop/edit_shop_detail.php",
                        type: "post",
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
        });
        function loadData() {
            $.ajax({
                url: "ajax/shop/select_shop_detail.php",
                dataType: "html",
                success: function (data) {
                    $('#tableDetail').html(data);
                }
            });
        }
        ;
    </script>
</body>
</html>
