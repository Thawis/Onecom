<?php
include '../lib/connect.php';
include '../lib/check_login.php';
include '../lib/lock_page_user.php';
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
        <title>การเข้าใช้งานระบบ</title>
        <!-- Custom Css-->
        <style>
            #table-log{
                text-align: center;
                font-family: Tahoma;
                font-size: 14px;
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
    <div class="content-wrapper">
        <section class="content-header">
            <h1><span class="fa fa-eye"></span> บันทึกการเข้าใช้งานระบบ</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> หน้าหลัก</a></li>
                <li>การตั้งค่าระบบ</li>
                <li class="active">การเข้าใช้งานระบบ</li>
            </ol>
        </section>
        <section class="content" style="height:1300px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <div class="box box-default">
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
                                        <input type="text" class="form-control" id="txtLog" name="txtLog" placeholder="ค้นหา : วัน - เวลา, กิจกรรม, ชื่อพนักงาน ... ฯลฯ">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn bg-blue-gradient btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                        </div>
                                    </div>
                                </div>                                           
                            </div>
                            <div class="box-body">
                                <table id="table-log" class="table table-bordered table-hover table-responsive">
                                    <thead>
                                        <tr class="bg-blue-gradient">
                                            <td width="10%">ลำดับ</td>
                                            <td width="25%">ชื่อพนักงาน</td>                                                   
                                            <td width="20%">วันที่</td>
                                            <td width="15%">เวลา</td>
                                            <td width="15%">ตำแหน่ง</td> 
                                            <td width="15%">กิจกรรม</td>
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
<script src="script/global.js" type="text/javascript"></script>
<script>
    var Tablelog;
    $(function () {
        $('#txtLog').keyup(function () {
            Tablelog.search(this.value).draw();
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
            Tablelog = $('#table-log').DataTable({
                destroy: true,
                ajax: {
                    url: "ajax/log/date_log.php",
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
        Tablelog = $("#table-log").DataTable({
            "ajax": "ajax/log/select_log_all.php",
            "scrollCollapse": true,
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

</script>
</body>
</html>
