<?php
//
//include '../../lib/connect.php';
//$sql = "SELECT * FROM t_product_unit WHERE Unit_ID ='P08_q1vVTh'";
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$result = $stmt->fetch();
//
////echo $result["Warranty"];
//
//if ($result["Warranty"] == " 3ปี") {
//    echo "+3 year";
//} else {
//    echo "ez";
//}
?>
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
                text-align: center;
                vertical-align: middle;
            }
            .font_1{
                text-align: right;
                font-family: Tahoma, Verdana, Segoe, sans-serif;
                font-size: 16px;
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
                <!--<li>จัดการสินค้า</li>-->
                <li class="active">ขายสินค้า</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="box box-default">
                            <div class="panel-body">        
                                <div class="content">          
                                    <div class="box-body">
                                        <table class="table table-responsive table-hover">
                                            <tbody>
                                                <tr>               
                                                    <td width="10%" style="vertical-align: middle; text-align:right;">เลขที่ : </td>
                                                    <td width="20%" style="vertical-align: middle; text-align:center;"><input type="text" class="form-control" id="ORD_ID" name="ORD_ID" value="" readonly=""/></td>
                                                    <td width="10%" style="vertical-align: middle; text-align:right;">เลขที่สินค้า : </td>
                                                    <td width="35%" style="vertical-align: middle; text-align:center;">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="unit_id" name="unit_id">
                                                            <div class="input-group-btn">
                                                                <button type="button" class="btn bg-green-gradient" id="findPro" name="findPro"><span class="fa fa-search"></span> ค้นหา</button> 
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td width="25%"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-header bg-green-gradient">
                                        <h3 class="box-title" style="font-style: normal; font-size: 19px;"><span class="fa fa-cart-plus"></span> รายการสินค้า</h3>
                                    </div>
                                    <div class="box-body">
                                        <form id="form_add_customer">
                                            <table class="table table-responsive table-bordered" id="tableCustomer" style="margin-bottom:15px;" hidden="">
                                                <thead><tr class="bg-blue-gradient"><td colspan="5">ข้อมูลลูกค้า</td></tr></thead>
                                                <tbody>
                                                    <tr>    
                                                        <td width="25%" style="text-align:center; vertical-align: middle;">                                                   
                                                            <input type="radio" id="radio_money" name="typecus" value="money" class="minimal"> เงินสด
                                                            <input type="radio" id="radio_cus" name="typecus" value="cusname" class="minimal"> นามลูกค้า
                                                        </td>  
                                                        <td width="15%" class="font_1" style="vertical-align: middle;">ชื่อ - นามสกุล : </td>
                                                        <td width="25%"><input type="text" id="cus_name" name="cus_name" class="form-control" placeholder="ชื่อลูกค้า ..." required="" readonly=""/></td>
                                                        <td width="25%"><input type="text" id="cus_surname" name="cus_surname" class="form-control" placeholder="นามสกุลลูกค้า ..." required="" readonly=""/></td>
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
                                                        <td colspan="2" width="30%" style="text-align:right; font-weight: bold; vertical-align:middle;">เงินรวม : </td>
                                                        <td width="20%" style="vertical-align:middle;"><input type="text" class="form-control" style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 18px;" id="total_price" name="total_price" value="" readonly=""/></td>
                                                        <td width="10%" style="text-align:center; font-weight: bold; vertical-align:middle;"> บาท </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table class="table table-responsive talbe-hover table-bordered" id="tableSell">
                                                <thead>
                                                    <tr style="text-align:center; font-weight: bold;">
                                                        <td width="10%">ลำดับ</td>
                                                        <td width="20%">รหัสสินค้า</td>
                                                        <td width="25%">ชื่อสินค้า</td>
                                                        <td width="15%">ระยะเวลาประกัน</td>
                                                        <td width="20%">ราคาสินค้า</td>
                                                        <td width="10%"></td>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </form>
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
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <!-- language DataTable-->
    <script src="script/global.js" type="text/javascript"></script>
    <script>
        var tableSell;
        var i = 1;
        var unit = [];
        var total_money = 0;
        $(function () {
            setORD();
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
                if (name !== '' && surname !== '') {
                    $.ajax({
                        url: "ajax/sell/find_customer.php",
                        type: "post",
                        dataType: "json",
                        data: {cus_name: name, cus_surname: surname},
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
                    alert("กรุณากรอก ชื่อ และ นามสกุล");
                }
            });
            $('#findPro').on('click', function () {
                var unit_id = $('#unit_id').val();
//                unit.push(unit_id);
                var state = chkUnit(unit_id);
                if (state === "ok") {
                    $.ajax({
                        url: "ajax/sell/find_product.php",
                        type: "post",
                        dataType: "json",
                        data: {unit_id: unit_id},
                        success: function (rs) {
                            var element = '';
                            //if (rs.price === null && rs.war === null && rs.pname === null && rs.unit_id === null) {
                            if (rs.rows === 0) {
                                unit = jQuery.grep(unit, function (value) {
                                    return value !== unit_id;
                                });
                                alert("ไม่พบข้อมูลสินค้า");
                            } else {
                                element += '<tr id="row' + i + '" style="text-align:center;"><td>' + i + '</td><td><input type="text" style="text-align:center;" name="Unit_ID[]" class="form-control" value="' + rs.unit_id + '" readonly=""/></td>';
                                element += '<td><input type="text" style="text-align:center;" name="Pname[]" class="form-control" value="' + rs.pname + '" readonly=""/></td>';
                                element += '<td><input type="text" style="text-align:center;" name="Warranty[]" class="form-control" value="' + rs.war + '" readonly=""/></td>';
                                element += '<td><input type="text" style="text-align:center;" name="P_Price[]" class="form-control" value="' + rs.price + '" readonly=""/></td>';
                                element += '<td><button type="button" onclick="removeInput(\'' + rs.unit_id + '\',\'' + rs.price + '\')" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button>';
                                element += '<input type="hidden" name="pid_send[]" value="'+ rs.pid +'"/>';
                                element += '<input type="hidden" name="endwar_send[]" value="'+ rs.end_war +'"/>';
                                element += '<input type="hidden" name="sid_send[]" value="'+ rs.s_id +'"/>';
                                element += '<input type="hidden" name="dateR_send[]" value="'+ rs.dateR +'"/>';
                                element += '<input type="hidden" name="dateE_send[]" value="'+ rs.dateE +'"/>';
                                element += '</td></tr>';
                                $('#tableSell').append(element);
                                i++;
                                total_money += parseInt(rs.price);
                                temp_money = ReplaceNumberWithCommas(total_money);
                                $('#total_price').val(temp_money);
                                $('#unit_id').val("");
                            }
                        }
                    });
                } else {
                    alert("รหัสสินค้า : " + state + " ถูกเลือกแล้ว");
                }
            });
            $('#btn_confirm').on('click', function () {
                if (total_money <= 0) {
                    alert("โปรดเลือกรายการสินค้า");
                } else {
                    $('#tableCustomer').removeAttr("hidden");
                    $('[name=remove]').attr("disabled", true);
                    $('#findPro').attr("disabled", true);
                    $('#btn_confirm').css("display", "none");
                    $('#btn_savesale').removeAttr("style");
                    $('#total_price_send').val(total_money);
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
                            var r = confirm('ท่านต้องการบันทึกรายการ และ ออกใบเสร็จรับเงินหรือไม่');
                            if (r === true) {
                                $('#btn_savesale').click();
                            }
                        }
                    });
                }
            });

            $('#btn_savesale').on('click', function () {
                $.ajax({
                    url: "ajax/sell/insert_sell.php",
                    method: "post",
                    data: $('#addGG').serialize(),
                    success: function (data)
                    {
                        if(data === "ok"){
                            alert("บันทึกการขายเรียบร้อย");
                            window.location.replace("M_Sell_Bill.php");
                        }
                    }
                });
            });
            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
                i--;
                resetnum();
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
            unit.push(unit_id);
            var state = "ok";
            for (var k = 0; k < sunit.length - 1; k++) {
                if (unit_id === sunit[k]) {
                    state = sunit[k];
                    break;
                }
            }
            console.log(state);
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
            } else if (custype === 'cusname') {
                $('#cus_name').removeAttr("readonly");
                $('#cus_surname').removeAttr("readonly");
                $('#find_cus').removeAttr("disabled");
                $('#btn_savesale').attr("disabled", true);
            }
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

    </script>
</body>
</html>
