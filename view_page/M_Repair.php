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
        <title>เพิ่มรายการรับซ่อม</title>
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
            #tableSell td:nth-child(4){
                text-align: right;
            }
            #tableDetail td{
                vertical-align: middle;
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableUnit td{
                vertical-align: middle;
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableUnit td:nth-child(1){
                text-align: center;
            }
            #tableUnit td:nth-child(5){
                text-align: center;
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
                <span class="fa fa-wrench"></span> เพิ่มรายการรับซ่อม
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>งานซ่อม</li>
                <li class="active">เพิ่มรายการรับซ่อม</li>
            </ol>
        </section>
        <section class="content" style="height:1600px;">
            <div class="row">
                <div class="col-md-12">                    
                    <div class="box box-default">
                        <div class="panel-body">
                            <div class="box-body">
                                <table class="table table-responsive no-border">
                                    <tbody>
                                        <tr>
                                            <td width="20%" style="text-align: right; vertical-align: middle;">เลขที่ใบรับซ่อม : </td>
                                            <td width="20%" style="text-align: center; vertical-align: middle;"><input type="text" class="form-control" style="text-align:center;" id="r_id" name="r_id" readonly=""/></td>
                                            <td width="20%" style="text-align: center; vertical-align: middle;"><button type="button" class="btn bg-green-gradient btn-block" id="btn_addItem" name="btn_addItem" data-toggle="modal" data-target="#ModalAddItem"><span class="fa fa-plus-square"></span> เพิ่มรายการซ่อม</button></td>       
                                            <td width="20%" style="text-align: center; vertical-align: middle;"><button type="button" class="btn bg-yellow-gradient btn-block" id="btn_editItem" name="btn_editItem" disabled=""><span class="fa fa-cog"></span> แก้ไขรายการซ่อม</button></td>
                                            <td width="20%" style="text-align: center; vertical-align: middle;">
                                                <button type="button" class="btn bg-aqua-gradient btn-block" id="btn_confirm" name="btn_confirm" disabled=""><span class="fa fa-check-circle-o"></span> ยืนยันการทำรายการ</button>
                                                <button type="button" class="btn bg-red-gradient btn-block" id="btn_save" name="btn_save" disabled="" style="display:none;"><span class="fa fa-print"></span> บันทึกรายการรับซ่อมและออกใบรับซ่อม</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>                                                                    
                            </div>
                            <div class="box-body" id="divCustomer" hidden=""> <!-- hidden="" -->
                                <form id="form_add_customer">
                                    <table class="table table-responsive table-bordered" id="tableCustomer" style="margin-bottom:15px;">
                                        <thead><tr class="bg-blue-gradient"><td colspan="5">ข้อมูลลูกค้า</td></tr></thead>
                                        <tbody>
                                            <tr>    
                                                <td width="25%" style="text-align:center; vertical-align: middle;">
                                                    <input type="radio" id="radio_cus" name="typecus" value="cusname" class="minimal"> นามลูกค้า
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
                            </div>
                            <div class="box-body">
                                <form id="addRepair">
                                    <input type="hidden" id="r_id_send" name="r_id_send" value=""/>
                                    <input type="hidden" id="cus_id_send" name="cus_id_send" value=""/>
                                    <table id="tableItemAdd" class="table table-bordered table-responsive">
                                        <thead>
                                            <tr class="bg-green-gradient" style="font-size: 16px;">
                                                <td width="10%" style="text-align:center;">ลำดับ</td>
                                                <td width="15%" style="text-align:center;">ประเภท</td>
                                                <td width="17%" style="text-align:center;">ชื่อของซ่อม</td>                                                    
                                                <td width="18%" style="text-align:center;">Serial Number</td>
                                                <td width="20%" style="text-align:center;">อาการเสีย & สิ่งที่ให้ทำ</td>
                                                <td width="15%" style="text-align:center;">อุปกรณ์พ่วงต่อ</td>
                                                <td width="5%"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
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
    <!-- /.content-wrapper -->
    <!-- ModalAddItem-->
    <div class="modal fade" id="ModalAddItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="AddItem">
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-wrench"></span> เพิ่มรายการซ่อม</h4>
                    </div>
                    <div class="modal-body">
                        <!--<div class="box box-default">-->
                        <div class="box-body">
                            <table class="table table-responsive table-hover " id="">
                                <tbody>
                                    <tr>
                                        <td width="25%" class="font_1" style="vertical-align:middle;">ประเภทของซ่อม : </td>
                                        <td colspan="2" width="50%">
                                            <select class="form-control" id="item_type" name="item_type" style="width:100%; text-align: center;">
                                                <option value="NoteBook">NoteBook</option>
                                                <option value="PC-Case">PC-Case</option>
                                                <option value="ETC">อื่น ๆ</option>
                                            </select>
                                        </td>
                                        <td width="25%"></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="font_1" style="vertical-align:middle;">ชื่อของซ่อม : </td>
                                        <td colspan="2" width="50%" style="vertical-align:middle;"><input type="text" id="item_name" name="item_name" class="form-control" required=""/></td>
                                        <td width="25%"></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="font_1" style="vertical-align:middle;">Serial Number : </td>
                                        <td colspan="2" width="50%" style="vertical-align:middle;"><input type="text" id="item_sn" name="item_sn" pattern="[A-Za-z0-9]{4,}" class="form-control" placeholder="Notebook จำเป็นต้องกรอกทุกครั้ง..."/></td>
                                        <td width="25%"></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="font_1" style="vertical-align:middle;">อาการเสีย & <br> สิ่งที่ให้ทำ : </td>
                                        <td colspan="3" width="75%" style="vertical-align:middle;"><textarea class="form-control" id="item_manner" name="item_manner" required="" rows="2"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="font_1" style="vertical-align:middle;">อุปรกณ์ต่อพ่วง : </td>
                                        <td width="20%" style="vertical-align:middle; text-align:center;">
                                            <input type="checkbox" id="chk_bag" name="eqm" value="กระเป๋า" class="minimal"> กระเป๋า
                                        </td>
                                        <td width="25%" style="vertical-align:middle; text-align: center;">
                                            <input type="checkbox" id="chk_ac" name="eqm" value="สายไฟ AC" class="minimal"> สายไฟ(AC)
                                        </td>
                                        <td width="30%" style="vertical-align:middle; text-align: center;">
                                            <input type="checkbox" id="chk_adapter" name="eqm" value="Adapter" class="minimal"> Adapter
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="font_1" style="vertical-align:middle;"></td>
                                        <td width="20%" style="vertical-align:middle; text-align:center;">
                                            <input type="checkbox" id="chk_usb" name="eqm" value="สายUSB" class="minimal"> USB
                                        </td>
                                        <td colspan="2" width="50%" style="vertical-align:middle; text-align: center;">
                                            <input type="text" class="form-control" id="eqm_etc" name="eqm_etc" placeholder="อื่น ๆ (ถ้ามี)" />                               
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--</div>-->                            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-green-gradient" id="" name="" >ยืนยัน</button>
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
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
        var i = 1;
        $(function () {
            set_rid();
            $("[data-mask]").inputmask();
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
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
                                $('#btn_save').removeAttr("disabled");
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
                                $('#cus_id_send').val(data.cus_id);
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
                                $('#btn_save').removeAttr("disabled");
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
                                $('#cus_id_send').val(data.cus_id);
                            }
                        }
                    });
                } else {
                    alert("กรุณากรอกข้อมูลให้ครบ");
                }
            });
            $('#btn_clearCustomer').on('click', function () {
                $('#radio_cus').iCheck('uncheck');
                $('#radio_company').iCheck('uncheck');
                $('#btn_save').attr("disabled", true);
                clearCustomer();
            });
            $('#ModalAddItem').on('shown.bs.modal', function () {
                $('input[name="eqm"]').iCheck('uncheck');
                $('#AddItem')[0].reset();

            });
            $('#AddItem').on('submit', function (e) {
                e.preventDefault();
                var element = '';
                var itemType = $('#item_type').val();
                var name = $('#item_name').val();
                var sn = $('#item_sn').val();
                var manner = $('#item_manner').val();
                var eqm = '';
                $('input[name="eqm"]:checked').each(function () {
                    eqm += this.value + ',';
                });
                eqm += $('#eqm_etc').val();
                if (itemType === 'NoteBook') {
                    if (sn === '') {
                        alert('กรุณากรอก S/N ของเครื่อง');
                    } else {
                        var r = confirm("ยืนยันการเพิ่มรายการซ่อม");
                        if (r === true) {
                            //console.log(itemType, name, sn, manner, eqm);
                            element += '<tr id ="row' + i + '"><td width="10%" style="text-align:center; vertical-align: middle;">' + i + '</td>';
                            element += '<td width="15%" style="text-align:center; vertical-align: middle;"><input type="text" id="type_send[]" name="type_send[]" class="form-control" readonly="" required="" value="' + itemType + '"/></td>';
                            element += '<td width="17%" style="text-align:center; vertical-align: middle;"><input type="text" id="name_send[]" name="name_send[]" class="form-control" readonly="" required="" value="' + name + '"/></td>';
                            element += '<td width="18%" style="text-align:center; vertical-align: middle;"><input type="text" id="sn_send[]" name="sn_send[]" class="form-control" readonly="" required="" placeholder="Serial Number" value="' + sn + '" /></td>';
                            element += '<td width="20%" style="text-align:center; vertical-align: middle;"><textarea id="manner_send[]" name="manner_send[]" class="form-control" readonly="" required="" rows="2">' + manner + '</textarea></td>';
                            element += '<td width="15%" style="text-align:center; vertical-align: middle;"><textarea id="eqm_send[]" name="eqm_send[]" class="form-control" readonly="" required="" rows="2">' + eqm + '</textarea></td>';
                            element += '<td width="5%" style="text-align:center; vertical-align: middle;"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"><span class="fa fa-close"></span></button></td>';
                            $('#tableItemAdd').append(element);
                            i++;
                            $('#ModalAddItem').modal('hide');
                        }
                    }
                } else {
                    var r = confirm("ยืนยันการเพิ่มรายการซ่อม");
                    if (r === true) {
                        //console.log(itemType, name, sn, manner, eqm);
                        element += '<tr id ="row' + i + '"><td width="10%" style="text-align:center; vertical-align: middle;">' + i + '</td>';
                        element += '<td width="15%" style="text-align:center; vertical-align: middle;"><input type="text" id="type_send[]" name="type_send[]" class="form-control" readonly="" required="" value="' + itemType + '"/></td>';
                        element += '<td width="17%" style="text-align:center; vertical-align: middle;"><input type="text" id="name_send[]" name="name_send[]" class="form-control" readonly="" required="" value="' + name + '"/></td>';
                        element += '<td width="18%" style="text-align:center; vertical-align: middle;"><input type="text" id="sn_send[]" name="sn_send[]" class="form-control" readonly="" required="" placeholder="Serial Number" value="' + sn + '" /></td>';
                        element += '<td width="20%" style="text-align:center; vertical-align: middle;"><textarea id="manner_send[]" name="manner_send[]" class="form-control" readonly="" required="" rows="2">' + manner + '</textarea></td>';
                        element += '<td width="15%" style="text-align:center; vertical-align: middle;"><textarea id="eqm_send[]" name="eqm_send[]" class="form-control" readonly="" required="" rows="2">' + eqm + '</textarea></td>';
                        element += '<td width="5%" style="text-align:center; vertical-align: middle;"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"><span class="fa fa-close"></span></button></td>';
                        $('#tableItemAdd').append(element);
                        i++;
                        $('#ModalAddItem').modal('hide');
                    }
                }
                if (i > 1) {
                    $('#btn_confirm').removeAttr('disabled');
                }
            });
            $('#btn_editItem').on('click', function () {
                $('#radio_cus').iCheck('uncheck');
                $('#radio_company').iCheck('uncheck');
                clearCustomer();
                $('#divCustomer').attr("hidden", true);
                $('[name=remove]').removeAttr('disabled');
                $('#btn_editItem').attr('disabled', true);
                $('#btn_save').css('display', 'none');
                $('#btn_confirm').removeAttr("style");
                $('#btn_addItem').removeAttr('disabled');
            });
            $('#btn_confirm').on('click', function () {
                $('#divCustomer').removeAttr('hidden');
                $('#btn_editItem').removeAttr("disabled");
                $('#btn_addItem').attr("disabled", true);
                $('#btn_confirm').css("display", "none");
                $('[name=remove]').attr("disabled", true);
                $('#btn_save').removeAttr("style");
            });
            $('#btn_save').on('click', function () {
                var r = confirm("ยืนยันการเพิ่มรายการรับซ่อม");
                if (r === true) {
                    $.ajax({
                        url: "ajax/repair/insert_repair.php",
                        method: "post",
                        data: $('#addRepair').serialize(),
                        success: function (data)
                        {
                            if (data === 'ok') {
                                alert('เพิ่มข้อมูลรายการรับซ่อมเรียบร้อย');
                                window.open("../report/repair/addrepair_bill.php", "_blank");
                                location.reload();
                            }
                        }
                    });
                }
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
                            $('#btn_addCustomer').attr("disabled", true);
                            var r = confirm('ท่านต้องการบันทึกรายการรับซ่อม และ ออกใบรับซ่อมหรือไม่');
                            if (r === true) {
                                $('#btn_save').removeAttr('disabled');
                                $('#btn_save').click();
                            } else {
                                $('#btn_save').removeAttr('disabled');
                            }
                        }
                    });
                }
            });
            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                var r = confirm("ยืนยันการยกเลิกสินค้าซ่อม");
                if (r === true) {
                    $('#row' + button_id + '').remove();
                    i--;
                    if (i <= 1) {
                        $('#btn_confirm').attr("disabled", true);
                    }
                    resetnum();
                }
            });
        });
        function resetnum() {
            var rowCount = $('#tableItemAdd tr').length;
            var k = 0;
            var j = 1;
            while (k < rowCount) {
                k++;
                $('#tableItemAdd').find("tr").eq(k).find("td").eq(0).text(j);
                j++;
            }
        }
        ;
        function set_rid() {
            $.ajax({
                url: "ajax/repair/set_repair_id.php",
                success: function (data) {
                    $('#r_id').val(data);
                    $('#r_id_send').val(data);
                }
            });
        }
        ;
        function setform(custype) {
            if (custype === 'cusname') {
                clearCustomer();
                $('#cus_name_td').text("ชื่อ - นามสกุล : ");
                $('#cus_name').attr("placeholder", "ชื่อลูกค้า ...");
                $('#cus_surname').attr("placeholder", "นามสกุลลูกค้า ...");
                $('#cus_name').removeAttr("readonly");
                $('#cus_surname').removeAttr("readonly");
                $('#find_cus').removeAttr("disabled");
                $('#btn_save').attr("disabled", true);
            } else if (custype === 'cuscompany') {
                clearCustomer();
                $('#cus_name_td').text("ประเภท-ชื่อบริษัท : ");
                $('#cus_name').attr("placeholder", "บริษัท จำกัด,ห้างหุ้นส่วน,ฯลฯ...");
                $('#cus_surname').attr("placeholder", "");
                $('#cus_name').removeAttr("readonly");
                $('#cus_surname').attr("readonly", true);
                $('#find_cus').removeAttr("disabled");
                $('#btn_save').attr("disabled", true);
            }
        }
        ;
        function clearCustomer() {
            $('#cus_name_td').text("ชื่อ - นามสกุล : ");
            $('#cus_name').attr("placeholder", "ชื่อลูกค้า ...");
            $('#cus_surname').attr("placeholder", "นามสกุลลูกค้า ...");
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
            $('#btn_addCustomer').attr("disabled", true);
        }
        ;


    </script>
</body>

</html>
