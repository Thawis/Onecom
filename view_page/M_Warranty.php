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
        <title>จัดการระยะเวลาประกัน</title>
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
                <span class="fa fa-calendar"></span> จัดการระยะเวลาประกัน
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>ตั้งค่าระบบ</li>
                <li class="active">จัดการระยะเวลาประกัน</li>
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
                                <div class="col-md-6" style="margin-top:10px;"><button type="button" id="add_ser" class="btn bg-green-gradient"><span class="fa fa-plus"></span> เพิ่มระยะเวลาประกัน</button></div>
                                <div class="col-md-6" style="margin-top:10px;">                                            
                                    <div class="input-group pull-right" style="width:100%;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="txtSearch_list" name="txtSearch_list" placeholder="ค้นหา : ช่วงเวลาประกัน">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn bg-purple-gradient btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                            </div>
                                        </div>
                                    </div>                                           
                                </div>
                                <table id="tableRepairList" class="table table-bordered table-hover">
                                    <thead>
                                        <tr  class="bg-purple-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                            <td width="20%">ลำดับ</td>
                                            <td width="30%">ระยะเวลาประกัน</td>
                                            <td width="30%">สถานะ</td>
                                            <td width="20%"></td>
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
    <!-- Modal Add -->
    <div class="modal fade" id="AddWar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="add_war">
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-plus"></span> เพิ่มระยะเวลาประกัน</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <!--<input type="hidden" id="ser_action" name="ser_action" value="add"/>-->
                                <table class="table table-responsive" id="">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">ระยะเวลาประกัน : </td>
                                            <td width="40%"><input type="number" class="form-control" id="numwar" name="numwar" required="" min="1" max="50" placeholder="ระยะเวลาเช่น วัน เดือน ปี"/></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;">ช่วงเวลา : </td>
                                            <td width="40%">
                                                <select class="form-control" id="wartype" name="wartype" style="width:100%" required="">
                                                    <option value="day">วัน</option>
                                                    <option value="month">เดือน</option>
                                                    <option value="year">ปี</option>
                                                </select>
                                            </td>
                                            <td width="30%"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-green-gradient">เพิ่มข้อมูล</button>
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
            $('#txtSearch_list').keyup(function () {
                tableList.search(this.value).draw();
            });
            $(document).on('click', '.btn_re_load', function () {
                location.reload();
            });
            tableList = $("#tableRepairList").DataTable({
                "ajax": "ajax/war/select_war.php",
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
                    {"targets": 3, "orderable": false, "searchable": false}],
                language: language
            });
            $('#add_ser').on('click', function () {
//                set_id();
//                $('#sername').val("");
//                $('#serprice').val("");
                $('#numwar').val('');
                $('#wartype').val($('#wartype option:first').val());
                $('#AddWar').modal('show');
            });
            $('#add_war').on('submit', function (e) {
                e.preventDefault();
                var time = $('#numwar').val();
                var wartype = $('#wartype').val();
                if (wartype === 'day') {
                    if (time <= 30) {
                        add_war(time, wartype);
                    } else {
                        alert('กรุณากรอกวันที่ไม่เกิน 30 วัน');
                    }
                } else if (wartype === 'month') {
                    if (time <= 12) {
                        add_war(time, wartype);
                    } else {
                        alert('กรุณากรอกเดือนไม่เกิน 12 เดือน');
                    }
                } else if (wartype === 'year') {
                    if (time <= 10) {
                        add_war(time, wartype);
                    } else {
                        alert('กรุณากรอกปีไม่เกิน 10 ปี');
                    }
                }
                //var data = $('#add_service').serialize();
            });
        });
        function remove_menu(a) {
            var r = confirm('ยืนยันการลบระยะเวลาประกัน');
            if (r === true) {
                $.ajax({
                    url: "ajax/war/remove_war.php",
                    type: "post",
                    data: {numwar: a},
                    success: function (rs) {
                        if (rs === 'ok') {
                            alert('ลบระยะเวลาเคลมประกันเรียบร้อย');
                            tableList.ajax.reload();
                        } else {
                            alert('ลบระยะเวลาเคลมประกันไม่สำเร็จ');
                        }
                    }
                });
            }
        }
        ;

        function add_war(numwar, wartype) {
            console.log(numwar, wartype);
            var r = confirm("ยืนยันการเพิ่มระยะเวลาประกัน");
            if (r === true) {
                $.ajax({
                    url: "ajax/war/insert_war.php",
                    type: "post",
                    data: {numwar: numwar, wartype: wartype},
                    success: function (data) {
                        if (data === 'ok') {
                            alert('เพิ่มระยะเวลาประกันเรียบร้อย');
                            tableList.ajax.reload();
                            $('#AddWar').modal('hide');
                        } else {
                            alert('ไม่สามารถเพิ่มระยะเวลาประกันได้');
                        }

                    }
                });
            }
        }
        ;
    </script>
</body>

</html>
