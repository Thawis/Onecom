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
        <title>จัดการเมนูซ่อมสินค้า</title>
        <style>
            .dataTables_filter{
                display: none;
            }
            #tableSMS thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableSMS td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 12px; 
                font-family: Tahoma;
            }
        </style>
    </head>
    <?php
    include '../lib/header_navbar.php';
    include '../lib/main_sidebar.php';
    ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <span class="fa fa-commenting-o"></span> การแจ้งเตือน SMS
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"> การแจ้งเตือน SMS </li>
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
                                <div class="col-md-12">
                                    <button class="btn bg-green-gradient" id="chk_sms"><span class="fa fa-mail-forward"></span> ไปที่ SBUYSMS.COM </button>
                                    <div class="input-group pull-right"><label class="label bg-green-gradient" id="lblStatus" style="font-size:12px; font-family: Tahoma; text-align: left;"></label></div>
                                </div>
                                <div class="col-md-6" style="margin-top:10px;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="reservation">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top:10px;">
                                    <div class="input-group pull-right" style="width:100%;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="txtSearch_list" name="txtSearch_list" placeholder="ค้นหา : เลขที่ใบรับซ่อม, เลขที่สินค้าซ่อม">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn bg-orange-active btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                            </div>
                                        </div>
                                    </div>    
                                </div> 
                                <table id="tableSMS" class="table table-bordered table-hover">
                                    <thead>
                                        <tr  class="bg-orange-active" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                            <td width="10%">ลำดับ</td>
                                            <td width="20%">รหัสเมนูซ่อม</td> 
                                            <td width="20%">เวลาที่ส่ง</td>
                                            <td width="15%">เบอร์โทร</td>
                                            <td width="35%">ข้อความ</td>
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
        var tableSMS;
//        var tableDetail;
//        var tableItem;
//        var tableItemClaim;
        $(function () {
            chk_sms_status();
            $('#txtSearch_list').keyup(function () {
                tableSMS.search(this.value).draw();
            });
            $(document).on('click', '.btn_re_load', function () {
                location.reload();
            });
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
            $('#reservation').on('apply.daterangepicker', function () {
                var s = $('#reservation').val();
                tableSMS = $('#tableSMS').DataTable({
                    destroy: true,
                    ajax: {
                        url: "ajax/sms_list/date_sms.php",
                        type: "post",
                        data: {reservation: s}
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
                        {"targets": 0, "orderable": true, "searchable": false},
                    ]
                });
            });
            tableSMS = $("#tableSMS").DataTable({
                "ajax": "ajax/sms_list/select_sms.php",
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    {"targets": 0, "orderable": true, "searchable": false}],
                language: language
            });
            $('#chk_sms').on('click', function () {
                window.open("http://www.sbuysms.com/", "_blank");
            });
        });

        function chk_sms_status() {
            $.ajax({
                url: "ajax/sms/check_sms.php",
                dataType: "json",
                success: function (rs) {
                    var mess = "SMS : " + rs.status + " ยอด Credit คงเหลือ : " + rs.credit + " หมดอายุวันที่ : " + rs.exp;
                    $('#lblStatus').text(mess);
                }
            });
        }
        ;
    </script>
</body>

</html>
