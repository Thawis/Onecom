<?php
include '../lib/connect.php';
include '../lib/check_login.php';
include '../lib/lock_page_user.php'
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
        <title>จัดการข้อมูลตัวแทนขายสินค้า</title>
        <style>
            .dataTables_filter{
                display: none;
            }
            #table-dealer td{
                vertical-align: middle;
                font-style: normal;
                font-size: 14px; 
                text-align: center;
            }
            #table-dealer td:nth-child(3){
                text-align: left;
            }
            #table-dealer td:nth-child(4){
                text-align: left;
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
    <div class="content-wrapper">
        <section class="content-header">
            <h1><span class="fa fa-user-circle"></span> จัดการข้อมูลตัวแทนขายสินค้า</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">จัดการข้อมูลตัวแทนขายสินค้า</li>
            </ol>
        </section>
        <section class="content" style="height:1600px;">
            <div class="row">
                <div class="col-md-12">                    
                    <div class="box box-default">
                        <div class="panel-body">
                            <div class="box-body">
                                <table class="table no-border">
                                    <tbody>
                                        <tr style="vertical-align: middle;">
                                            <td width="20%"></td>
                                            <td>  
                                                <div class="input-group" style="width:100%;"> 
                                                    <input type="text" id="txtSearch" class="form-control" placeholder="ค้นหาข้อมูล...">
                                                    <span class="input-group-btn"><button class="btn bg-blue-gradient btn_reload" type="button" id="btntest"><span class='fa fa-refresh'></span> รีเฟรช</button></span>
                                                </div>
                                            </td>
                                            <td width="20%"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table id="table-dealer" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                                    <thead>
                                        <tr class="bg-blue-gradient" style="font-size: 14px; font-family: Tahoma;">
                                            <td width="10%" style="text-align:center;">ลำดับ</td>
                                            <td width="15%" style="text-align:center;">รหัสตัวแทน</td>
                                            <td width="20%" style="text-align:left;">ชื่อ-นามสกุล</td>                                                    
                                            <td width="20%" style="text-align:left;">ชื่อบริษัท</td>
                                            <td width="15%" style="text-align:center;">เบอร์โทรศัพท์</td>
                                            <td width="10%" style="text-align:center;">สถานะ</td>
                                            <td width="10%" style="text-align:center;"></td>
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
    <!-- Modal Detail -->
    <div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="">
                    <div class="modal-header bg-aqua-gradient">
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-user"></span> รายละเอียดข้อมูลตัวแทนขาย</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="modal_dealer_id"/>
                        <div class="box box-default">
                            <div class="box-body no-border">
                                <table class="table table-responsive table-hover" id="tableDetail">
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
    <!-- Modal Edit-->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form-edit">
                    <div class="modal-header bg-yellow-gradient">
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-pencil"></span> แก้ไขข้อมูลตัวแทนจำขาย</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_dealer_id"/>
                        <input type="hidden" id="dealer_action" name="dealer_action" value="edit"/>
                        <div class="box box-default">
                            <div class="box-body no-border">
                                <table class="table table-responsive table-hover" id="tableEdit">
                                </table>
                            </div>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-yellow-gradient" id="btn_edit" name="btn_edit" > แก้ไขข้อมูล</button>
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
    <script>
        var TableDealer;
        var TableEmpCancel;
        $(function () {
            $('#txtSearch').keyup(function () {
                TableDealer.search(this.value).draw();
            });
            $('.btn_reload').on('click', function () {
                location.reload();
            });
            TableDealer = $("#table-dealer").DataTable({
                "ajax": "ajax/dealer/select_dealer.php",
                "bInfo": false,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                language: language,
                "columnDefs": [
                    {"targets": 6, "orderable": false, "searchable": false}
                ]
            });

            $('#ModalDetail').on('shown.bs.modal', function () {
                var dealer_id = $('#modal_dealer_id').val();
                $.ajax({
                    url: "ajax/dealer/select_dealer_detail.php",
                    type: "post",
                    dataType: "html",
                    data: {dealer_id: dealer_id},
                    success: function (data) {
                        $('#tableDetail').html(data);
                    }
                });
            });
            $('#ModalEdit').on('shown.bs.modal', function () {
                var dealer_id = $('#edit_dealer_id').val();
                //console.log(dealer_id);
                $.ajax({
                    url: "ajax/Dealer/select_dealer_edit.php",
                    type: "post",
                    dataType: "html",
                    data: {dealer_id: dealer_id},
                    success: function (data) {
                        $('#tableEdit').html(data);
                        $('#edit_dealer_tel').inputmask();
                    }
                });
            });
            $('#form-edit').on('submit', function (event) {
                event.preventDefault();
                var data = $('#form-edit').serialize();
                $.ajax({
                    url: "ajax/Dealer/chk_dealer.php",
                    type: "post",
                    data: data,
                    success: function (rs) {
                        if (rs === 'ok') {
                            var r = confirm("ยืนยันการแก้ไขข้อมูล");
                            if (r === true) {
                                $.ajax({
                                    url: 'ajax/Dealer/update_dealer.php',
                                    type: 'post',
                                    data: data,
                                    success: function (rs) {
                                        if (rs === "ok") {
                                            alert("แก้ไขข้อมูลตัวเรียบร้อย");
                                            TableDealer.ajax.reload();
                                            $('#ModalEdit').modal('hide');
                                        } else {
                                            alert("ไม่สามารถแก้ไขข้อมูลตัวแทนได้");
                                        }
                                    }
                                });
                            }
                        } else {
                            alert('ไม่สามารถแก้ไขข้อมูลได้');
                        }
                    }
                });
            });
        });

        function setid(dealer_id) {
            $('#modal_dealer_id').val(dealer_id);
            $('#edit_dealer_id').val(dealer_id);
        }
        ;
        function cancel_dealer(dealer_id) {
            var r = confirm("ยืนยันการยกเลิกตัวแทน");
            if (r === true) {
                $.ajax({
                    url: "ajax/Dealer/cancel_dealer.php",
                    type: "post",
                    data: {dealer_id: dealer_id},
                    success: function (data) {
                        if (data === "ok") {
                            alert("ยกเลิกตัวแทนเรียบร้อย");
                            TableDealer.ajax.reload(null, false);
                        } else {
                            alert("ไม่สามารถยกเลิกตัวแทนได้");
                        }
                    }
                });
            }
        }
        ;
        function open_dealer(dealer_id) {
            var r = confirm("ยืนยันการเปิดใช้ตัวแทน");
            if (r === true) {
                $.ajax({
                    url: "ajax/Dealer/open_dealer.php",
                    type: "post",
                    data: {dealer_id: dealer_id},
                    success: function (data) {
                        if (data === "ok") {
                            alert("เปิดใช้ตัวแทนเรียบร้อย");
                            TableDealer.ajax.reload(null, false);
                        } else {
                            alert("ไม่สามารถเปิดใช้ตัวแทนได้");
                        }
                    }
                });
            }
        }
        ;
    </script>
</body>
</html>
