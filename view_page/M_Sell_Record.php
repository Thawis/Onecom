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
        <title>ประวัติการขายสินค้า</title>
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
                font-size: 12px; 
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
                <span class="fa fa-calendar-check-o"></span> ประวัติการขายสินค้า
                <!--<small></small>-->
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href=M_SellProduct.php>การขายสินค้า</a></li>
                <li class="active">ประวัติการขายสินค้า</li>
            </ol>
        </section>
        <section class="content" style="height:1600px;">
            <div class="row">
                <div class="col-md-12">                    
                    <div class="box box-default">
                        <div class="panel-body">
                            <div class="box-body">
                                <table class="table table-responsive">
                                    <tbody>
                                        <tr>
                                            <td width="20%"></td>
                                            <td width="20%" style="text-align: center; vertical-align: middle;"><button type="button" id="filter_sell" class="btn bg-green-gradient btn-block" data-toggle="modal" data-target="#ModalFilter"><span class="fa fa-filter"> ตัวกรองข้อมูล</span></button></td>
                                            <td width="40%">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="txtSearch" name="txtSearch" placeholder="ค้นหา : เลขที่ใบเสร็จ, วันที่ขาย, ขายโดย, ราคารวม">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn bg-green-gradient" id="findPro" name="findPro"><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="20%"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--Data Table -->
                                <table id="tableSell" class="table table-bordered table-hover table-responsive">
                                    <thead>
                                        <tr class="bg-green-gradient" style="font-size: 16px;">
                                            <td width="10%" style="text-align:center;">ลำดับ</td>
                                            <td width="20%" style="text-align:center;">เลขที่ใบเสร็จ</td>
                                            <td width="20%" style="text-align:center;">วันที่ขาย</td>                                                    
                                            <td width="15%" style="text-align:center;">ราคารวมสุทธิ</td>
                                            <td width="10%" style="text-align:center;">ขายโดย</td>
                                            <td width="10%" style="text-align:center;">ประเภทขาย</td>
                                            <td width="15%"></td>
                                        </tr>
                                    </thead>
                                </table>                                                                      
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
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-info-circle"></span> รายละเอียดรายการขาย</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="modal_ord_id" value=""/>
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover" id="tableDetail">
                                </table>
                            </div>
                            <div class="box-body">
                                <table class="table table-responsive table-hover table-bordered" id="tableUnit">
                                    <thead>
                                        <tr class="bg-green-gradient" style="text-align:center;">
                                            <td width="10%">ลำดับ</td>
                                            <td width="15%">เลขที่สินค้า</td>
                                            <td width="30%">รายละเอียดเบื้องต้น</td>                                           
                                            <td width="30%">วันที่หมดประกัน</td>
                                            <td width="15%">ราคา</td>
                                        </tr>   
                                    </thead>
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
    <!-- Modal Filter-->
    <div class="modal fade" id="ModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formFilterSell">
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-filter"></span> ตัวกรองข้อมูล</h4>
                    </div>
                    <div class="modal-body">
                        <!--<div class="box box-default">-->
                        <div class="box-body">
                            <table class="table table-responsive table-hover" id="">
                                <tbody>
                                    <tr>
                                        <td width="25%" class="font_1" style="vertical-align:middle;">ค้นหาด้วย : </td>
                                        <td colspan="2" width="50%" style="vertical-align:middle;"><input type="text" id="f_sn" name="f_sn" class="form-control" placeholder="เลขที่สินค้า หรือ SerialNumber"/></td>
                                        <td width="25%"></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="font_1" style="vertical-align:middle;">ประเภทการขาย : </td>
                                        <td width="20%" style="vertical-align:middle; text-align:center;">
                                            <input type="radio" id="radio_all" name="typesell" value="all" class="minimal"> ทั้งหมด
                                        </td>
                                        <td width="25%" style="vertical-align:middle; text-align: center;">
                                            <input type="radio" id="radio_sell" name="typesell" value="sell" class="minimal"> ขายสินค้าปกติ
                                        </td>
                                        <td width="30%" style="vertical-align:middle; text-align: center;">
                                            <input type="radio" id="radio_repair" name="typesell" value="repair" class="minimal"> ขายสินค้าเพื่อซ่อม
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="font_1" style="vertical-align:middle;">ช่วงเวลาที่ขาย : </td>
                                        <td colspan="3" width="75%" style="vertical-align:middle;">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="reservation" name="reservation">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--</div>-->                            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-green-gradient" id="btn_filter" name="btn_filter" >ตกลง</button>
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
        var tableSell;
        var tableUnit;
        var sellType = 'all';
        $(function () {
            $('#txtSearch').keyup(function () {
                tableSell.search(this.value).draw();
            });
            loadAll();
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            //Date range picker
            $('#reservation').daterangepicker({
                "locale": {
                    "format": "YYYY-MM-DD",
                    "separator": " - ",
                    "applyLabel": "ตกลง",
                    "cancelLabel": "ยกเลิก",
                    "fromLabel": "จาก",
                    "toLabel": "ถึง",
                    "customRangeLabel": "กำหนดเอง",
                    "daysOfWeek": [
                        "อา",
                        "จ.",
                        "อ.",
                        "พ.",
                        "พฤ.",
                        "ศ.",
                        "ส."
                    ],
                    "monthNames": [
                        "มกราคม",
                        "กุมพาพันธ์",
                        "มีนาคม",
                        "เมษายน",
                        "พฤษภาคม",
                        "มิถุนายน",
                        "กรกฎาคม",
                        "สิงหาคม",
                        "กันยายน",
                        "ตุลาคม",
                        "พฤศจิกายน",
                        "ธันวาคม"
                    ],
                    "firstDay": 1
                }
            });
            $('#ModalDetail').on('shown.bs.modal', function () {
                var id = $('#modal_ord_id').val();
                $.ajax({
                    url: "ajax/sell/select_sell_detail.php",
                    type: "post",
                    dataType: "html",
                    data: {ord_id: id},
                    success: function (data) {
                        $('#tableDetail').html(data);
                    }
                });
                //$("#tableUnit").dataTable().fnDestroy();
                tableUnit = $('#tableUnit').DataTable({
                    destroy: true,
                    ajax: {
                        url: "ajax/sell/select_sell_unit.php",
                        type: "post",
                        data: {ord_id: id}
                    },
                    "bInfo": true,
                    "paging": true,
                    "lengthChange": false,
                    "iDisplayLength": 15,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    language: language,
                    "columnDefs": [
                        {"targets": 1, "orderable": false, "searchable": false},
                        {"targets": 2, "orderable": false, "searchable": false},
                        {"targets": 3, "orderable": false, "searchable": false}
                    ]
                });

            });
            $('#findPro').on('click', function () {
                location.reload();
            });
            $('#ModalFilter').on('shown.bs.modal', function () {
                $('#f_sn').val("");
                $('#reservation').val("");
                $("#radio_all").iCheck('toggle');
                $('[name=typesell]').on('ifChanged', function () {
                    if ($(this).is(':checked')) {
                        sellType = this.value;
                    }
                });
            });

            $('#formFilterSell').on('submit', function (e) {
                e.preventDefault();
                filterTable();
                $('#ModalFilter').modal('hide');
            });
        });
        function CancelSell(a) {
            var r = confirm("ยืนยันการยกเลิกรายการขาย");
            if (r === true) {
                $.ajax({
                    url: "ajax/sell/cancel_sell.php",
                    type: "post",
                    data: {ord_id: a},
                    success: function (data) {
                        if (data === "success") {
                            alert("ยกเลิกรายการขายรหัส : " + a + " เรียบร้อย");
                            tableSell.ajax.reload(null, false);
                        }
                    }
                });
            }
        }
        ;
        function DetailSell(a) {
            $('#modal_ord_id').val(a);
        }
        ;
        function DetailBill(a) {
            $.ajax({
                url: "ajax/sell/set_session_ord.php",
                type: "post",
                data: {ord: a},
                success: function (data) {
                    console.log(data);
                }
            });
            window.location.href = "M_Sell_Bill.php";
        }
        ;
        function loadAll() {
            //$("#tableSell").dataTable().fnDestroy();
            tableSell = $('#tableSell').DataTable({
                destroy: true,
                "ajax": "ajax/sell/select_sell_record.php",
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                //"sDom": '<"top"lf>t<"bottom"ip><"clear">',
                "autoWidth": false,
                language: language,
                "columnDefs": [
                    {"targets": 4, "orderable": false, "searchable": true},
                    {"targets": 5, "orderable": false, "searchable": false},
                    {"targets": 6, "orderable": false, "searchable": false},
                    //{"targets": [1], "visible": false, "searchable": true}
                ]
            });
        }
        ;
        function filterTable() {
            var unit_sn = $('#f_sn').val();
//            var selltype = $('[name=typesell]').val();
            var reservation = $('#reservation').val();
            console.log(unit_sn, sellType, reservation);
            $('#tableSell').dataTable().fnDestroy();
            tableSell = $('#tableSell').DataTable({
                ajax: {
                    url: "ajax/sell/filter_sell_record.php",
                    type: "post",
                    //data:$('#formFilterSell').serialize()
                    data: {f_sn: unit_sn, typesell: sellType, reservation: reservation}
                },
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                language: language,
                "columnDefs": [
                    {"targets": 4, "orderable": false, "searchable": true},
                    {"targets": 5, "orderable": false, "searchable": false},
                    {"targets": 6, "orderable": false, "searchable": false},
                ]
            });
//                $.ajax({
//                    url: "ajax/sell/filter_sell_record.php",
//                    type: "post",
//                    data: $('#formFilterSell').serialize(),
//                    success: function (data) {
//                        console.log(data);
//                    }
//                });
        }
        ;

    </script>
</body>
</html>
