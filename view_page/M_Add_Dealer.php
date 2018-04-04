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
        <title>เพิ่มข้อมูลตัวแทนขายสินค้า</title>
        <style>
            .dataTables_filter{
                display: none;
            }
            #table-emp td{
                vertical-align: middle;
                font-style: normal;
                font-size: 14px; 
                text-align: center;
            }
            /*            #table-emp tr:nth-child(even){
                            background-color: #dddddd;
                        }*/
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
            <h1>
                <span class="fa fa-user-secret"></span> ข้อมูลตัวแทนขายสินค้า
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">ข้อมูลตัวแทนขายสินค้า</li>
            </ol>
        </section>
        <section class="content" style="height:1080px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="content">
                            <div class="box-header bg-green-gradient">
                                <h3 class="box-title" style="font-style: normal; font-size: 19px;"><span class="fa fa-user-plus"></span> เพิ่มข้อมูลตัวแทนขายสินค้า</h3>
                            </div>
                            <div class="box-body">
                                <form class="form-horizontal" id="form-dealer">
                                    <input type="hidden" id="dealer_action" name="dealer_action" value="add"/>
                                    <table class="table table-responsive">
                                        <tr style="vertical-align:middle;">
                                            <td style="width:30%; text-align: right; vertical-align:middle;">รหัสตัวแทนขายสินค้า : </td>
                                            <td style="width:40%; vertical-align:middle;">
                                                <input type="text" class="form-control" id="dealer_id" name="dealer_id" required="" readonly>                  
                                            </td>
                                            <td style="width:30%;"></td>
                                        </tr>
                                        <tr style="vertical-align:middle;">
                                            <td style="width:30%; text-align: right; vertical-align:middle;">ชื่อ : </td>
                                            <td style="width:40%; vertical-align:middle;">
                                                <input type="text" class="form-control" id="dealer_name" name="dealer_name" value="" required="">
                                            </td>
                                            <td style="width:30%;"></td>
                                        </tr>
                                        <tr style="vertical-align:middle;">
                                            <td style="width:30%; text-align: right; vertical-align:middle;">นามสกุล : </td>
                                            <td style="width:40%; vertical-align:middle;">
                                                <input type="text" class="form-control" id="delaer_surname" name="dealer_surname" value="" required="">
                                            </td>
                                            <td style="width:30%;"></td>
                                        </tr>
                                        <tr style="vertical-align:middle;">
                                            <td style="width:30%; text-align: right; vertical-align:middle;">ชื่อบริษัท : </td>
                                            <td style="width:40%; vertical-align:middle;">
                                                <input type="text" class="form-control" id="dealer_company" name="dealer_company" value="" required="">
                                            </td>
                                            <td style="width:30%;"></td>
                                        </tr>
                                        <tr style="vertical-align:middle;">
                                            <td style="width:30%; text-align: right; vertical-align:middle;">เพศ : </td>
                                            <td style="width:40%; vertical-align:middle;">
                                                <select class="form-control" id="dealer_gender" name="dealer_gender">
                                                    <option selected value="ชาย">ชาย</option>
                                                    <option value="หญิง">หญิง</option>
                                                </select>            
                                            </td>
                                            <td style="width:30%;"></td>
                                        </tr>
                                        <tr style="vertical-align:middle;">
                                            <td style="width:30%; text-align: right; vertical-align:middle;">ที่ตั้งบริษัท : </td>
                                            <td style="width:40%; vertical-align:middle;">
                                                <textarea class="form-control" id="dealer_address" name="dealer_address" rows="3" required ></textarea>
                                            </td>
                                            <td style="width:30%;"></td>
                                        </tr>
                                        <tr style="vertical-align:middle;">
                                            <td style="width:30%; text-align: right; vertical-align:middle;">เบอร์โทรศัพท์ : </td>
                                            <td style="width:40%; vertical-align:middle;">
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                                    <input type="text" class="form-control" id="dealer_tel" name="dealer_tel" data-inputmask='"mask": "999-999-9999"' data-mask required>
                                                </div>
                                            </td>
                                            <td style="width:30%;"></td>
                                        </tr>
                                        <tr style="vertical-align:middle;">
                                            <td colspan="3" style="text-align:center;">
                                                <button type="submit" class="btn bg-green-gradient">บันทึก</button>
                                                <button type="button" id="btn_clear" class="btn bg-red-gradient">ยกเลิก</button>    
                                            </td>
                                        </tr>
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
        $(function () {
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });
            //Set Datamask;
            $("[data-mask]").inputmask();
            //set emp_id
            setid();
            $('#form-dealer').on('submit', function (event) {
                event.preventDefault();
                var data = $('#form-dealer').serialize();
                $.ajax({
                    url: "ajax/Dealer/chk_dealer.php",
                    type: "post",
                    data: data,
                    success: function (rs) {
                        if (rs === "ok") {
                            var r = confirm('ยืนยันการเพิ่มข้อมูลตัวแทนขายสินค้า');
                            if (r === true) {
                                $.ajax({
                                    url: 'ajax/Dealer/insert_dealer.php',
                                    type: 'post',
                                    data: data,
                                    success: function (data) {
                                        alert(data);
                                        setid();
                                        clear_dealer();
                                    }
                                });
                            }
                        } else {
                            alert('ข้อมูลตัวแทนขายสินค้านี้มีอยู่ในระบบแล้ว');
                        }
                    }
                });
            });
            $('#btn_clear').on('click', function () {
                clear_dealer();
            });
        }
        );
        function setid() {
            $.ajax({
                url: "ajax/Dealer/select_id_dealer.php",
                success: function (data) {
                    $('#dealer_id').val(data);
                }
            });
        }
        ;
        function clear_dealer() {
            $('#dealer_name').val("");
            $('#delaer_surname').val("");
            $('#dealer_company').val("");
            $('#dealer_address').val("");
            $('#dealer_tel').val("");
            $('#dealer_gender').val($('#dealer_gender option:first').val());
        }
        ;
    </script>
</body>
</html>
