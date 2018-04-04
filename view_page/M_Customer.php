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
        <title>จัดการข้อมูลลูกค้า</title>
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
            .font_1{
                text-align: right;
                font-family: Tahoma;
                font-size: 14px;
                font-weight: bold;
            }
            .font_2{
                font-family: Tahoma;
                font-size: 14px;
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
                <span class="fa fa-user"></span> จัดการข้อมูลลูกค้า
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>ตั้งค่าระบบ</li>
                <li class="active">จัดการข้อมูลลูกค้า</li>
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
                                <!--<div class="col-md-6" style="margin-top:10px;"></div>-->
                                <div class="col-md-12" style="margin-top:10px;">                                            
                                    <div class="input-group center-block" style="width:50%;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="txtSearch_list" name="txtSearch_list" placeholder="ค้นหา : รายชื่อลูกค้า">
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
                                            <td width="15%">รหัสลูกค้า</td>
                                            <td width="20%">ชื่อลูกค้า</td>
                                            <td width="15%">ประเภท</td>
                                            <td width="10%">สถานะ</td>
                                            <td width="15%">รายละเอียด</td>
                                            <td width="15%"></td>
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
    <div class="modal fade" id="ModalEdit_P" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="edit_p">
                    <div class="modal-header bg-yellow-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-pencil"></span> แก้ไขข้อมูลลูกค้า</h4>
                    </div>
                    <div class="modal-body">
                        <!--<input type="hidden" id="modal_add_item_id" name="modal_add_item_id" value=""/>-->
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover table-bordered no-border" id="">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">รหัสลูกค้า : </td>
                                            <td width="40%"><input type="text" class="form-control" id="cus_id" name="cus_id" value="" required="" readonly=""/></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">ชื่อลูกค้า : </td>
                                            <td width="40%"><input type="text" class="form-control" id="cus_name" name="cus_name" value="" required=""/></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">นามสกุล : </td>
                                            <td width="40%"><input type="text" class="form-control" id="cus_surname" name="cus_surname" value="" required=""/></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">เบอร์โทรศัพท์ : </td>
                                            <td width="40%">
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                                    <input type="text" class="form-control" id="cus_tel" name="cus_tel" data-inputmask='"mask": "999-999-9999"' data-mask required=""/>
                                                </div>
                                            </td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">ที่อยู่ : </td>
                                            <td width="40%">
                                                <textarea class="form-control" id="cus_address" name="cus_address" rows="3" value="" required=""></textarea>
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
    <!-- Modal Edit C -->
    <div class="modal fade" id="ModalEdit_C" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="edit_c">
                    <div class="modal-header bg-yellow-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-pencil"></span> แก้ไขข้อมูลลูกค้า</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover table-bordered no-border" id="">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">รหัสลูกค้า : </td>
                                            <td width="40%"><input type="text" class="form-control" id="ccus_id" name="ccus_id" value="" required="" readonly=""/></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">ชื่อลูกค้า : </td>
                                            <td width="40%"><input type="text" class="form-control" id="ccus_name" name="ccus_name" value="" required=""/></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">เบอร์โทรศัพท์ : </td>
                                            <td width="40%">
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                                    <input type="text" class="form-control" id="ccus_tel" name="ccus_tel" data-inputmask='"mask": "999-999-9999"' data-mask required=""/>
                                                </div>
                                            </td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">ที่อยู่ : </td>
                                            <td width="40%">
                                                <textarea class="form-control" id="ccus_address" name="ccus_address" rows="3" value="" required=""></textarea>
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
    <!-- Detail -->
    <div class="modal fade" id="P_Detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="">
                    <div class="modal-header bg-aqua-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-user"></span> รายละเอียดข้อมูลลูกค้า</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="cus_id_h" name="cus_id_h" value=""/>
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive" id="tableDetail_C">
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
        $(function () {
            $("[data-mask]").inputmask();
            $('#txtSearch_list').keyup(function () {
                tableList.search(this.value).draw();
            });
            $(document).on('click', '.btn_re_load', function () {
                location.reload();
            });
            tableList = $("#tableRepairList").DataTable({
                "ajax": "ajax/customer/select_customer.php",
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
                    {"targets": 6, "orderable": false, "searchable": false}
                ],
                language: language
            });
            $(document).on('click', '.btn_cancel', function () {
                var s = 'cancel';
                var cusid = this.value;
                var r = confirm("ยืนยันการยกเลิกข้อมูลลูกค้า");
                if (r === true) {
                    $.ajax({
                        url: "ajax/customer/open_cancel_customer.php",
                        type: "post",
                        data: {state: s, cusid: cusid},
                        success: function (e) {
                            alert(e);
                            tableList.ajax.reload();
                        }
                    });
                }
            });
            $('#P_Detail').on('shown.bs.modal', function () {
                var cusid = $('#cus_id_h').val();
                $.ajax({
                    url: "ajax/customer/select_detail_c.php",
                    type: "post",
                    dataType: "html",
                    data: {cusid: cusid},
                    success: function (data) {
                        $('#tableDetail_C').html(data);
                    }
                });
            });
            $('#edit_p').on('submit', function (e) {
                e.preventDefault();
                var data = $('#edit_p').serialize();
                var r = confirm("ยืนยันการแก้ไขข้อมูลลูกค้า");
                if (r === true) {
                    $.ajax({
                        url: "ajax/customer/edit_customer_p.php",
                        type: "post",
                        data: data,
                        success: function (rs) {
                            alert(rs);
                            tableList.ajax.reload();
                            $('#ModalEdit_P').modal('hide');
                        }
                    });
                }
            });
            $('#edit_c').on('submit', function (e) {
                e.preventDefault();
                var data = $('#edit_c').serialize();
                var r = confirm("ยืนยันการแก้ไขข้อมูลลูกค้า");
                if (r === true) {
                    $.ajax({
                        url: "ajax/customer/edit_customer_c.php",
                        type: "post",
                        data: data,
                        success: function (rs) {
                            alert(rs);
                            tableList.ajax.reload();
                            $('#ModalEdit_C').modal('hide');
                        }
                    });
                }
            });
            $(document).on('click', '.btn_open', function () {
                var s = 'open';
                var cusid = this.value;
                var r = confirm("ยืนยันการเปิดใช้ข้อมูลลูกค้า");
                if (r === true) {
                    $.ajax({
                        url: "ajax/customer/open_cancel_customer.php",
                        type: "post",
                        data: {state: s, cusid: cusid},
                        success: function (e) {
                            alert(e);
                            tableList.ajax.reload();
                        }
                    });
                }
            });
            $(document).on('click', '.btn_detail', function () {
                var cusid = this.value;
                $('#cus_id_h').val(cusid);
                $('#P_Detail').modal('show');
            });
            $(document).on('click', '.btn_edit_c', function () {
                var cusid = this.value;
                $.ajax({
                    url: "ajax/customer/select_edit_customer.php",
                    type: "post",
                    dataType: "json",
                    data: {cusid: cusid},
                    success: function (rs) {
                        $('#ccus_id').val(rs.id);
                        $('#ccus_name').val(rs.fname);
                        $('#ccus_tel').val(rs.tel);
                        $('#ccus_address').val(rs.address);
                    }
                });
                $('#ModalEdit_C').modal('show');
            });
            $(document).on('click', '.btn_edit_p', function () {
                var cusid = this.value;
                $.ajax({
                    url: "ajax/customer/select_edit_customer.php",
                    type: "post",
                    dataType: "json",
                    data: {cusid: cusid},
                    success: function (rs) {
                        $('#cus_id').val(rs.id);
                        $('#cus_name').val(rs.fname);
                        $('#cus_surname').val(rs.sname);
                        $('#cus_tel').val(rs.tel);
                        $('#cus_address').val(rs.address);
                    }
                });
                $('#ModalEdit_P').modal('show');
            });
        });
    </script>
</body>

</html>
