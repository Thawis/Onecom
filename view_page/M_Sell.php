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
        <title>ขายสินค้า</title>
        <!-- Custom CSS -->
        <style>
            .dataTables_filter{
                display: none;
            }
            #tableSell td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #table_1 td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-weight: bold;
                font-family: Tahoma;
            }
            .font_1{
                text-align: right;
                font-family: Tahoma, Verdana, Segoe, sans-serif;
                font-size: 16px;
            }
            #table-product td{
                vertical-align: middle;
                font-style: normal;
                font-size: 14px; 
                text-align: center;
            }
            body {
                padding: 0; margin: 0;
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
            <h1><span class="fa fa-list-alt"></span> ขายสินค้า</h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">ขายสินค้า</li>
            </ol>
        </section>
        <section class="content" style="height:1600px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">        
                        <div class="content">          
                            <div class="box-header bg-green-gradient">
                                <h3 class="box-title" style="font-style: normal; font-size: 19px;"><span class="fa fa-list-alt"></span> รายละเอียดการขายสินค้า</h3>
                            </div>
                            <div class="box-body">
                                <form>
                                    <table class="table table-responsive no-border" id="table_1">
                                        <tbody>
                                            <tr>
                                                <td width="15%" style="vertical-align: middle; text-align:right;">เลขที่ใบเสร็จ : </td>
                                                <td width="30%" style="vertical-align: middle; text-align:center;"><input type="text" class="form-control" style="text-align:center; font-size: 14px; font-family: Tahoma;" id="ORD_ID" name="ORD_ID" value="" readonly=""/></td>
                                                <td width="15%" style="vertical-align: middle; text-align:right;"></td>
                                                <td width="20%" style="vertical-align: middle; text-align:right;">ค้นหาสินค้า : </td>
                                                <td width="20%" style="vertical-align: middle; text-align:right;"><button type="button" id="select_product" class="btn bg-green-gradient" data-toggle="modal" data-target="#ModalProduct"><span class="fa fa-search"></span> ค้นหา</button> 
                                                    <button type="button" id="btn_refresh" class="btn bg-yellow-gradient"><span class="fa fa-refresh"></span> รีเฟรช</button></td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                                <form id="form_add_customer">
                                    <table class="table table-responsive table-bordered" id="tableCustomer" style="margin-bottom:15px;" hidden="" > <!-- hidden="" -->
                                        <thead><tr class="bg-blue-gradient"><td colspan="5">ข้อมูลลูกค้า</td></tr></thead>
                                        <tbody>
                                            <tr>    
                                                <td width="25%" style="text-align:center; vertical-align: middle;">                                                   
                                                    <input type="radio" id="radio_money" name="typecus" value="money" class="minimal"> เงินสด
                                                    <input type="radio" id="radio_cus" name="typecus" value="cusname" class="minimal"> นามลูกค้า <br>
                                                    <input type="radio" id="radio_company" name="typecus" value="cuscompany" class="minimal"> บริษัท
                                                </td>  
                                                <td width="15%" class="font_1" style="vertical-align: middle;" id="cus_name_td">ชื่อ - นามสกุล : </td>
                                                <td width="25%"><input type="text" id="cus_name" name="cus_name" class="form-control" placeholder="ชื่อลูกค้า ..." required="" readonly=""/></td>
                                                <td width="25%"><input type="text" id="cus_surname" name="cus_surname" class="form-control" placeholder="นามสกุลลูกค้า ..." readonly=""/></td>
                                                <td width="10%"><button type="button" id="find_cus" class="btn bg-blue-gradient btn-block" disabled=""><span class="fa fa-search"></span> ค้นหา</button></td>                                                
                                            </tr>
                                            <tr>
                                                <td width="25%" class="font_1" style="vertical-align: middle;"> รหัสลูกค้า : </td>
                                                <td width="15%"><input type="text" id="cus_id" name="cus_id" class="form-control" readonly="" required=""/></td>
                                                <td width="25%" class="font_1" style="vertical-align: middle;">เบอร์โทรศัพท์ : </td>
                                                <td width="25%">                                                
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                                        <input type="text" class="form-control" id="cus_tel" name="cus_tel" data-inputmask='"mask": "999-999-9999"' data-mask required="" readonly="">
                                                    </div></td>
                                                <td width="10%" rowspan="2" class="font_1" style="vertical-align:middle;">
                                                    <button type="submit" id="btn_addCustomer" class="btn bg-green-gradient btn-block" disabled=""><span class="fa fa-user-plus"></span> เพิ่มข้อมูลลูกค้า</button>
                                                    <button type="button" id="btn_clearCustomer" class="btn bg-red-gradient btn-block"><span class="fa fa-close"></span> ยกเลิก</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="25%" class="font_1" style="vertical-align: middle;"> ที่อยู่ : </td>
                                                <td colspan="3" width="65%"><textarea id="cus_address" name="cus_address" class="form-control" rows="3" readonly="" required=""></textarea></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                                <form name="addGG" id="addGG">
                                    <input type="hidden" id="ord_id_send" name="ord_id_send" value="">
                                    <input type="hidden" id="cus_id_send" name="cus_id_send" value="">
                                    <input type="hidden" id="total_price_send" name="total_price_send" value="">
                                    <table class="table table-responsive talbe-hover table-bordered">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" width="40%" style="text-align:right; font-weight: bold; vertical-align:middle;">
                                                    <button type="button" id="btn_savesale" class="btn bg-red-gradient btn-block" style="display:none;" disabled=""><span class="fa fa-print"></span> บันทึกรายการขาย ออกใบเสร็จรับเงิน</button>
                                                    <button type="button" id="btn_confirm" class="btn bg-aqua-gradient btn-block"><span class="fa fa-check-square"></span> ยืนยันการทำรายการ</button>
                                                </td>
                                                <td colspan="2" width="30%" style="text-align:right; font-weight: bold; vertical-align:middle;">เงินสุทธิ : </td>
                                                <td width="20%" style="vertical-align:middle;"><input type="text" class="form-control" style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 18px;" id="total_price" name="total_price" value="" readonly=""/></td>
                                                <td width="10%" style="text-align:center; font-weight: bold; vertical-align:middle;"> บาท </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-responsive talbe-hover table-bordered" id="tableSell">
                                        <thead>
                                            <tr class="bg-light-blue-gradient"style="text-align:center;">
                                                <td width="8%">ลำดับ</td>
                                                <td width="10%">รหัสสินค้า</td>
                                                <td width="30%">ชื่อสินค้า</td>
                                                <td width="7%">จำนวน</td>
                                                <td width="15%">ราคาสินค้า</td>
                                                <td width="15%">ราคารวม</td>
                                                <td width="15%"></td>
                                            </tr>
                                        </thead>
                                        <tbody id="sell_body">
                                        </tbody>
                                    </table>
                                </form>
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
    <!-- modal find product -->
    <div class="modal fade" id="ModalProduct" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form-find">
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-family: Tahoma;"><span class="fa fa-list"></span> รายการสินค้า</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-solid">
                            <div class="box-header bg-green-gradient">
                                <h3 class="box-title" style="font-style: normal; font-size: 19px;"><span class="fa fa-search"></span> ค้นหารายการสินค้า</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-hover">
                                    <tr>
                                        <td width="20%" style="vertical-align: middle; text-align: right;">ประเภทสินค้าหลัก : </td>
                                        <td width="30%" style="vertical-align: middle;"><select class="form-control select2" id="ddlgroup" style="width:100%"></select></td>
                                        <td width="20%" style="vertical-align: middle; text-align: right;">ประเภทสินค้าย่อย : </td>
                                        <td width="30%" style="vertical-align: middle;"><select class="form-control select2" id="ddlsubgroup" style="width:100%"></select></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: center;">
                                    <center><div class="input-group" style="width: 60%">
                                            <input type="text" id="txtSearch" class="form-control" placeholder="ค้นหาข้อมูล...">
                                            <span class="input-group-btn">
                                                <button class="btn bg-green-gradient" type="button" id="btntest"><span class="fa fa-search"></span>ค้นหา</button>
                                            </span>
                                        </div></center>
                                    </td>
                                    </tr>
                                </table>
                            </div>
                        </div>                   
                        <table id="table-product" class="table table-bordered table-hover table-responsive" >
                            <thead>
                                <tr class="bg-green-gradient" style="vertical-align: middle; font-style: normal; font-size: 14px; font-weight: bold;">
                                    <td width="10%" style="text-align:center;">ลำดับ</td>
                                    <td width="10%" style="text-align:center;">รหัสสินค้า</td>
                                    <td width="25%" style="text-align:center;">ชื่อสินค้า</td>
                                    <td width="15%" style="text-align:center;">ประเภทสินค้า</td>
                                    <td width="15%" style="text-align:center;">สถานะ</td>
                                    <td width="15%" style="text-align:center;">ยอดคงเหลือ</td>
                                    <td width="10%" style="text-align:center;"></td>
                                </tr>
                            </thead>
                        </table>         
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="action-sub" name="action" value="" >
                        <!--<button type="submit" class="btn btn-success">บันทึก</button>-->
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal input detail -->
    <div class="modal fade" id="ModalProductDetail" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_pdetail">
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-family: Tahoma;"><span class="fa fa-info"></span> กรุณากรอกข้อมูลรายการ</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-default">
                            <div class="box-header bg-green-gradient">
                                <h3 class="box-title" style="font-style: normal; font-size: 19px;">รายการสินค้า <label id="lblpid" style="font-style: normal; font-size: 19px;"></label></h3>
                            </div>
                            <div class="box-body">
                                <input type="hidden" id="select_name" name="select_name" value=""/>
                                <input type="hidden" id="select_pid" name="select_pid" value=""/>
                                <input type="hidden" id="select_count" name="select_count" value=""/>
                                <table class="table table-hover">
                                    <tr>
                                        <td width="30%" style="vertical-align: middle; text-align: right;">ราคาสินค้าต่อชิ้น : </td>
                                        <td width="50%" style="vertical-align: middle;"><input type="number" style="text-align:center;" class="form-control" id="select_price" name="select_price" readonly="" required="" value=""/></td>
                                        <td width="20%" style="vertical-align: middle; text-align: left;"> บาท</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="vertical-align: middle; text-align: right;">จำนวน : </td>
                                        <td width="50%" style="vertical-align: middle;"><input type="number" style="text-align:center;" class="form-control" id="select_num" name="select_num" min="1" required=""/></td>
                                        <td width="20%" style="vertical-align: middle; text-align: right;"></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="vertical-align: middle; text-align: right;">ราคารวม : </td>
                                        <td width="50%" style="vertical-align: middle;"><input type="number" style="text-align:center;" class="form-control" id="select_total" name="select_total" min="1" readonly="" required=""/></td>
                                        <td width="20%" style="vertical-align: middle; text-align: left;"> บาท</td>
                                    </tr>
                                </table>
                            </div>
                        </div>                          
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-green-gradient" id="btn_numset">ยืนยัน</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal input edit -->
    <div class="modal fade" id="ModalProductEdit" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_pedit">
                    <div class="modal-header bg-yellow-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-family: Tahoma;"><span class="fa fa-pencil"></span> แก้ไขจำนวนสินค้า</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-default">
                            <div class="box-header bg-yellow-gradient">
                                <h3 class="box-title" style="font-style: normal; font-size: 19px;">รายการสินค้า <label id="Elblpid" style="font-style: normal; font-size: 19px;"></label></h3>
                            </div>
                            <div class="box-body">
                                <input type="hidden" id="select_epid" name="select_epid" value=""/>
                                <input type="hidden" id="select_ecount" name="select_ecount" value=""/>
                                <input type="hidden" id="temp_etotal" value=""/>
                                <table class="table table-hover">
                                    <tr>
                                        <td width="30%" style="vertical-align: middle; text-align: right;">ราคาสินค้าต่อชิ้น : </td>
                                        <td width="50%" style="vertical-align: middle;"><input type="number" style="text-align:center;" class="form-control" id="select_eprice" name="select_eprice" readonly="" required="" value=""/></td>
                                        <td width="20%" style="vertical-align: middle; text-align: left;"> บาท</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="vertical-align: middle; text-align: right;">จำนวน : </td>
                                        <td width="50%" style="vertical-align: middle;"><input type="number" style="text-align:center;" class="form-control" id="select_enum" name="select_enum" min="1" required=""/></td>
                                        <td width="20%" style="vertical-align: middle; text-align: right;"></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="vertical-align: middle; text-align: right;">ราคารวม : </td>
                                        <td width="50%" style="vertical-align: middle;"><input type="number" style="text-align:center;" class="form-control" id="select_etotal" name="select_etotal" min="1" readonly="" required=""/></td>
                                        <td width="20%" style="vertical-align: middle; text-align: left;"> บาท</td>
                                    </tr>
                                </table>
                            </div>
                        </div>                          
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning" id="btn_numset">แก้ไข</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal finish -->
    <div class="modal fade" id="ModalEndSell" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_endsell">
                    <div class="modal-header bg-aqua-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-family: Tahoma;"><span class="fa fa-money"></span> รายการชำระเงิน</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-default">
                            <div class="box-body">
                                <table class="table table-hover">
                                    <tr>
                                        <td width="30%" style="vertical-align: middle; text-align: right;">ราคาสุทธิ : </td>
                                        <td width="50%" style="vertical-align: middle;"><input type="number" style="text-align:center;" class="form-control" id="f_total" readonly="" required="" value=""/></td>
                                        <td width="20%" style="vertical-align: middle; text-align: left;"> บาท</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="vertical-align: middle; text-align: right;">จำนวนเงินรับ : </td>
                                        <td width="50%" style="vertical-align: middle;"><input type="number" style="text-align:center;" class="form-control" id="f_receive" min="1" required=""/></td>
                                        <td width="20%" style="vertical-align: middle; text-align: right;"></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="vertical-align: middle; text-align: right;">เงินทอน : </td>
                                        <td width="50%" style="vertical-align: middle;"><input type="number" style="text-align:center;" class="form-control" id="f_change" readonly="" required=""/></td>
                                        <td width="20%" style="vertical-align: middle; text-align: left;"> บาท</td>
                                    </tr>
                                </table>
                            </div>
                        </div>                          
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-aqua-gradient" id="confirm_money" disabled="">ยืนยันชำระเงิน</button>
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
        var tableSell;
        var i = 1;
        var temp_i = 1;
        var unit = [];
        var total_money = 0;
        $(function () {
            setORD();
            $('#btn_refresh').on('click', function () {
                location.reload();
            });
            $('.select2').select2();
            $("[data-mask]").inputmask();
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            $('#total_price').val(total_money);
            $('[name=typecus]').on('ifChanged', function () {
                if ($(this).is(':checked')) {
                    var custype = this.value;
                    setform(custype);
                }
            });
            $('#find_cus').on('click', function () {
                var name = $('#cus_name').val();
                var surname = $('#cus_surname').val();
                var typec = $('input[name=typecus]:checked').val();
                console.log(typec);
                if (typec === 'cusname' && name !== '' && surname !== '') {
                    //alert(typec);
                    $.ajax({
                        url: "ajax/sell/find_customer.php",
                        type: "post",
                        dataType: "json",
                        data: {cus_name: name, cus_surname: surname, typec: typec},
                        success: function (data) {
                            var rows = parseInt(data.rows);
                            if (rows === 0) {
                                alert("ไม่พบข้อมูลลูกค้า");
                                var r = confirm("ต้องการเพิ่มข้อมูลลูกค้าใหม่หรือไม่ ? ");
                                if (r === true) {
                                    $('#cus_name').attr("readonly", true);
                                    $('#cus_surname').attr("readonly", true);
                                    $('#cus_id').val(data.cus_id);
                                    $('#cus_tel').removeAttr("readonly");
                                    $('#cus_address').removeAttr("readonly");
                                    $('#btn_addCustomer').removeAttr("disabled");
                                    $('#find_cus').attr("disabled", true);
                                } else {
                                    $("#radio_money").iCheck('toggle');
                                }
                            } else {
                                $('#btn_savesale').removeAttr("disabled");
                                $('#cus_name').attr("readonly", true);
                                $('#cus_surname').attr("readonly", true);
                                $('#cus_tel').attr("readonly", true);
                                $('#cus_address').attr("readonly", true);
                                $('#cus_id').val(data.cus_id);
                                $('#cus_id_send').val(data.cus_id);
                                $('#cus_tel').val(data.cus_tel);
                                $('#cus_address').val(data.cus_address);
                                $('#find_cus').attr("disabled", true);
                                $('#btn_addCustomer').attr("disabled", true);
                            }
                        }
                    });
                } else if (typec === "cuscompany" && name !== '') {
                    //alert(typec);
                    $.ajax({
                        url: "ajax/sell/find_customer.php",
                        type: "post",
                        dataType: "json",
                        data: {cus_name: name, cus_surname: surname, typec: typec},
                        success: function (data) {
                            var rows = parseInt(data.rows);
                            if (rows === 0) {
                                alert("ไม่พบข้อมูลลูกค้า");
                                var r = confirm("ต้องการเพิ่มข้อมูลลูกค้าใหม่หรือไม่ ? ");
                                if (r === true) {
                                    $('#cus_name').attr("readonly", true);
                                    $('#cus_surname').attr("readonly", true);
                                    $('#cus_id').val(data.cus_id);
                                    $('#cus_tel').removeAttr("readonly");
                                    $('#cus_address').removeAttr("readonly");
                                    $('#btn_addCustomer').removeAttr("disabled");
                                    $('#find_cus').attr("disabled", true);
                                } else {
                                    $("#radio_money").iCheck('toggle');
                                }
                            } else {
                                $('#btn_savesale').removeAttr("disabled");
                                $('#cus_name').attr("readonly", true);
                                $('#cus_surname').attr("readonly", true);
                                $('#cus_tel').attr("readonly", true);
                                $('#cus_address').attr("readonly", true);
                                $('#cus_id').val(data.cus_id);
                                $('#cus_id_send').val(data.cus_id);
                                $('#cus_tel').val(data.cus_tel);
                                $('#cus_address').val(data.cus_address);
                                $('#find_cus').attr("disabled", true);
                                $('#btn_addCustomer').attr("disabled", true);
                            }
                        }
                    });
                } else {
                    alert("กรุณากรอกข้อมูลให้ครบ");
                }
            });
            $('#btn_confirm').on('click', function () {
                if (total_money <= 0) {
                    alert("โปรดเลือกรายการสินค้า");
                } else {
                    var r = confirm('ยืนยันการทำรายการขายสินค้า :: หากยืนยันการขายสินค้าแล้วจะไม่สามารถแก้ไขรายการขายได้ !');
                    if (r === true) {
                        $('#tableCustomer').removeAttr("hidden");
                        $('[name=remove]').attr("disabled", true);
                        $('[name=edit]').attr("disabled", true);
                        $('#select_product').attr("disabled", true);
                        $('#btn_confirm').css("display", "none");
                        $('#btn_savesale').removeAttr("style");
                        $('#total_price_send').val(total_money);
                    }
                }
            });
            $('#btn_clearCustomer').on('click', function () {
                $("#radio_money").iCheck('toggle');
                clearCustomer();
            });
            $('#form_add_customer').on('submit', function (event) {
                event.preventDefault();
                var r = confirm("ยืนยันการเพิ่มข้อมูลพนักงาน");
                if (r === true) {
                    $.ajax({
                        url: "ajax/sell/insert_customer.php",
                        method: "POST",
                        data: $('#form_add_customer').serialize(),
                        success: function (data)
                        {
                            alert(data);
                            var id = $('#cus_id').val();
                            $('#cus_id_send').val(id);
                            $('#cus_tel').attr("readonly", true);
                            $('#cus_address').attr("readonly", true);
                            $('#btn_savesale').removeAttr("disabled");
                            $('#btn_addCustomer').attr("disabled", true);
                            var r = confirm('ท่านต้องการบันทึกรายการ และ ออกใบเสร็จรับเงินหรือไม่');
                            if (r === true) {
                                $('#btn_savesale').click();
                            }
                        }
                    });
                }
            });
            $('#btn_savesale').on('click', function () {
                $('#ModalEndSell').modal('show');
                $('#f_total').val(total_money);
                $('#f_receive').val("");
                $('#f_change').val("");
            });
            $("#f_receive").keyup(function () {
                var total = parseInt($('#f_total').val());
                var r_money = parseInt($('#f_receive').val());
                var change = r_money - total;
                $('#f_change').val(change);
                if (r_money >= total) {
                    $('#confirm_money').removeAttr("disabled");
                } else {
                    $('#confirm_money').attr("disabled", true);
                }
            });
            $("#f_receive").bind('keyup mouseup', function () {
                var total = parseInt($('#f_total').val());
                var r_money = parseInt($('#f_receive').val());
                var change = r_money - total;
                $('#f_change').val(change);
                if (r_money >= total) {
                    $('#confirm_money').removeAttr("disabled");
                } else {
                    $('#confirm_money').attr("disabled", true);
                }
            });
            $('#form_endsell').on('submit', function (e) {
                e.preventDefault(e);
                var change = $('#f_change').val();
                var r = confirm("ยืนยันการทำรายการขาย");
                if (r === true) {
                    $.ajax({
                        url: "ajax/sell/insert_sell.php",
                        method: "post",
                        data: $('#addGG').serialize(),
                        success: function (data)
                        {
                            //alert(data);
                            if (data === "ok") {
                                alert("บันทึกการขายเรียบร้อย เงินทอน : " + change + " บาท");
                                ////window.location.replace("");
                                $('#ModalEndSell').modal('hide');
                                //location.reload();
                                //window.open("M_Sell_Bill.php", "_blank");
                                window.location.href = "M_Sell_Bill.php";
                            }
                        }
                    });
                }
            });
            $('#ModalProduct').on('shown.bs.modal', function () {
                loadAll();
                $('#txtSearch').keyup(function () {
                    tableProduct.search(this.value).draw();
                });
                //  LOAD Dropdown Group
                $.ajax({
                    url: 'ajax/Product/select_type_dropdown.php',
                    dataType: 'JSON',
                    success: function (data) {
                        $('#ddlgroup').empty();
                        $('#ddlsubgroup').empty();
                        $('#ddlsubgroup').append('<option id="All" value="All">All</option>');
                        $('#ddlgroup').append('<option id="All" value="All">All</option>');
                        $.each(data, function (key, val) {
                            $('#ddlgroup').append('<option id="' + val.id + '" value="' + val.id + '">' + val.name + '</option>');
                        });
                    }
                });
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
                            $('#ddlsubgroup').empty();
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
            });

            $('#ModalProductDetail').on('shown.bs.modal', function () {
                $('#select_num').val("");
                $('#select_total').val("");
            });
            $('#ModalProductEdit').on('shown.bs.modal', function () {

            });
            $('#form_pdetail').on('submit', function (e) {
                e.preventDefault();
                var num = parseInt($('#select_num').val());
                var count = parseInt($('#select_count').val());
                var total = $('#select_total').val();
                var pname = $('#select_name').val();
                var pid = $('#select_pid').val();
                var price = $('#select_price').val();
                if (num > count) {
                    alert("สินค้ามีไม่เพียงพอ");
                } else {
                    setBox(num, count, total, pname, pid, price);
                    total_money += parseInt(total);
                    var com_money = ReplaceNumberWithCommas(total_money);
                    $('#total_price').val(com_money);
                    unit.push(pid);
                    unit.push(pid);
                    //console.log(unit);
                    $('#ModalProductDetail').modal("hide");
                }
            });
            $('#form_pedit').on('submit', function (e) {
                e.preventDefault();
                var num = parseInt($('#select_enum').val());
                var count = parseInt($('#select_ecount').val());
                var total = $('#select_etotal').val();
                var temp_total = $('#temp_etotal').val();
                var pid = $('#select_epid').val();
                //var price = $('#select_eprice').val();
                if (num > count) {
                    alert("สินค้ามีไม่เพียงพอ");
                } else {
                    //console.log(num, count, total, pid, price,temp_total);
                    //alert("ผ่าน");
                    total_money = total_money - parseInt(temp_total);
                    total_money += parseInt(total);
                    $('#' + pid + '_num').val(num);
                    $('#' + pid + '_total').val(total);
                    var com_money = ReplaceNumberWithCommas(total_money);
                    $('#total_price').val(com_money);
                    $('#ModalProductEdit').modal('hide');
                }
            });
            $("#select_num").keyup(function () {
                var count = parseInt($('#select_count').val());
                var num = parseInt($('#select_num').val());
                if(num>count){
                    alert('สินค้าไม่เพียงพอ');
                }
                var price = parseInt($('#select_price').val());
                var total = num * price;
                $('#select_total').val(total);
                //console.log(total);
            });
            $("#select_num").bind('keyup mouseup', function () {
//                var count = parseInt($('#select_count').val());
//                console.log(count);
                var num = parseInt($('#select_num').val());
                var price = parseInt($('#select_price').val());
                var total = num * price;
                $('#select_total').val(total);
                //console.log(total);
            });
            $("#select_enum").keyup(function () {
                var num = parseInt($('#select_enum').val());
                var price = parseInt($('#select_eprice').val());
                var total = num * price;
                $('#select_etotal').val(total);
                //console.log(total);
            });
            $("#select_enum").bind('keyup mouseup', function () {
                var num = parseInt($('#select_enum').val());
                var price = parseInt($('#select_eprice').val());
                var total = num * price;
                $('#select_etotal').val(total);
                //console.log(total);
            });
            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                var pid = $(this).attr("value");
                var total = $('#' + pid + '_total').val();
                var r = confirm("ยืนยันการยกเลิกรายการ " + pid);
                if (r === true) {
                    total_money -= parseInt(total);
                    $('#rows' + button_id + '').remove();
                    i--;
                    resetnum();
                    unit = jQuery.grep(unit, function (value) {
                        return value !== pid;
                    });
                    //console.log(unit);
                    var com_money = ReplaceNumberWithCommas(total_money);
                    $('#total_price').val(com_money);
                }
            });
            $(document).on('click', '.btn_edit', function () {
                var button_id = $(this).attr("id");
                //alert(button_id);
                var num = $('#' + button_id + '_num').val();
                var total = $('#' + button_id + '_total').val();
                var price = $('#' + button_id + '_price').val();
                var count = $(this).attr("value");
                //console.log(num, total, price, count);
                $('#Elblpid').text(button_id);
                $('#select_epid').val(button_id);
                $('#select_ecount').val(count);
                $('#select_eprice').val(price);
                $('#select_enum').val(num);
                $('#select_etotal').val(total);
                $('#temp_etotal').val(total);
                $('#ModalProductEdit').modal("show");
            });
        });
//      ======================== FUNCTION ========================
        function resetnum() {
            var rowCount = $('#tableSell tr').length;
            var k = 0;
            var j = 1;
            while (k < rowCount) {
                k++;
                $('#tableSell').find("tr").eq(k).find("td").eq(0).text(j);
                j++;
            }
        }
        ;
        function setORD() {
            $.ajax({
                url: "ajax/sell/set_ord_id.php",
                success: function (data) {
                    $('#ORD_ID').val(data);
                    $('#ord_id_send').val(data);
                }
            });
        }
        ;
        function chkUnit(unit_id) {
            var sunit = unit.sort();
//            console.log("sunit :" + sunit);
//            console.log("pid:" + unit_id);
            //unit.push(unit_id);
            var state = "ok";
            for (var k = 0; k < sunit.length - 1; k++) {
                if (unit_id === sunit[k]) {
                    state = sunit[k];
                    break;
                    //return false;
                }
            }
            //console.log(state);
            return state;
        }
        ;
        function removeInput(unit_id, price) {
            total_money = total_money - parseInt(price);
            temp_money = ReplaceNumberWithCommas(total_money);
            $('#total_price').val(temp_money);
            unit = jQuery.grep(unit, function (value) {
                return value !== unit_id;
            });
        }
        ;

        function ReplaceNumberWithCommas(yourNumber) {
            //Seperates the components of the number
            var components = yourNumber.toString().split(".");
            //Comma-fies the first part
            components [0] = components [0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            //Combines the two sections
            return components.join(".");
        }
        ;
        function setform(custype) {
            if (custype === 'money') {
                clearCustomer();
                $('#cus_id_send').val("เงินสด");
                $('#cus_name_td').text("ชื่อ - นามสกุล : ");
                $('#cus_name').attr("placeholder", "ชื่อลูกค้า ...");
                $('#cus_surname').attr("placeholder", "นามสกุลลูกค้า ...");
            } else if (custype === 'cusname') {
                clearCustomer();
                $('#cus_name_td').text("ชื่อ - นามสกุล : ");
                $('#cus_name').attr("placeholder", "ชื่อลูกค้า ...");
                $('#cus_surname').attr("placeholder", "นามสกุลลูกค้า ...");
                $('#cus_name').removeAttr("readonly");
                $('#cus_surname').removeAttr("readonly");
                $('#find_cus').removeAttr("disabled");
                $('#btn_savesale').attr("disabled", true);
            } else if (custype === 'cuscompany') {
                clearCustomer();
                $('#cus_name_td').text("ประเภท-ชื่อบริษัท : ");
                $('#cus_name').attr("placeholder", "บริษัท จำกัด,ห้างหุ้นส่วน,ฯลฯ...");
                $('#cus_surname').attr("placeholder", "");
                $('#cus_name').removeAttr("readonly");
                $('#cus_surname').attr("readonly", true);
                //$('#cus_surname').val("company");
                $('#find_cus').removeAttr("disabled");
                $('#btn_savesale').attr("disabled", true);
            }
        }
        ;
        function setBox(num, count, total, pname, pid, price) {
            var element = '';
            element += '<tr id="rows' + temp_i + '">';
            element += '<td>' + i + '</td>';
            element += '<td><input type="text" style="text-align:center;" name="p_id[]" id="' + pid + '_id" class="form-control" readonly="" required="" value="' + pid + '"></td>';
            element += '<td><input type="text" name="p_name[]" id="' + pid + '_name" class="form-control" readonly="" required="" value="' + pname + '"></td>';
            element += '<td><input type="text" style="text-align:center;" name="p_num[]" id="' + pid + '_num" class="form-control" readonly="" required="" value="' + num + '"></td>';
            element += '<td><input type="text" style="text-align:right;" name="p_price[]" id="' + pid + '_price" class="form-control" readonly="" required="" value="' + price + '"></td>';
            element += '<td><input type="text" style="text-align:right;" name="p_tprice[]" id="' + pid + '_total" class="form-control" readonly="" required="" value="' + total + '"></td>';
            element += '<td><button type="button" name="edit" id="' + pid + '" class="btn bg-yellow-gradient btn_edit" value="' + count + '"><span class="fa fa-pencil"></span></button>';
            element += ' <button type="button" name="remove" id="' + temp_i + '" class="btn bg-red-gradient btn_remove" value="' + pid + '"><span class="fa fa-close"></span></button></td></tr>';
            i++;
            temp_i++;
            //$('#sell_body').html(element);
            $('#tableSell').append(element);
        }
        ;
        function clearCustomer() {
            $('#cus_name').val("");
            $('#cus_surname').val("");
            $('#cus_id').val("");
            $('#cus_tel').val("");
            $('#cus_address').val("");
            $('#cus_name').attr("readonly", true);
            $('#cus_surname').attr("readonly", true);
            $('#cus_id').attr("readonly", true);
            $('#cus_tel').attr("readonly", true);
            $('#cus_address').attr("readonly", true);
            $('#find_cus').attr("disabled", true);
            $('#addCustomer').attr("disabled", true);
            $('#btn_savesale').removeAttr("disabled");
            $('#btn_addCustomer').attr("disabled", true);
        }
        ;
        function loadAll() {
            tableProduct = $("#table-product").DataTable({
                "destroy": true,
                "ajax": "ajax/sell/select_product.php",
                "sScrollY": "450px",
                "bScrollCollapse": true,
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    {"targets": 6, "orderable": false, "searchable": false}],
                language: language
            });
        }
        ;
        function loadData(id, sub) {
            tableProduct = $("#table-product").dataTable({
                "destroy": true,
                ajax: {
                    url: "ajax/sell/select_sg_product.php",
                    type: "get",
                    data: {id: id, sub: sub}
                },
                "sScrollY": "450px",
                "bScrollCollapse": true,
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    {"targets": 6, "orderable": false, "searchable": false}],
                language: language
            });
        }
        ;
        function setSell(pid, pname, count, price) {
            var state = chkUnit(pid);
            //console.log('state:' + state);
            if (state === "ok") {
                $("body.sidebar-mini").removeAttr("style");
                $('#ModalProduct').modal('hide');
                $('#ModalProductDetail').modal('show');
                $('#select_price').val(price);
                $('#select_count').val(count);
                $('#select_pid').val(pid);
                $('#select_name').val(pname);
                $('#lblpid').text(pid);
                //console.log('unit setSell :' + unit);
            } else {
                alert("รายการสินค้านี้ได้ถูกเลือกแล้ว");
            }

        }
        ;
    </script>
</body>
</html>
