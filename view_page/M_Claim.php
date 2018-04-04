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
        <!-- Select 2 -->
        <link href="../plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <title>รายการเคลมสินค้า</title>
        <style>
            .dataTables_filter{
                display: none;
            }
            #tableClaim thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableClaim td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableClaimList thead td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma;
            }
            #tableClaimList td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            .font_1{
                text-align: right; 
                font-size: 12px; 
                font-family: Tahoma;
                font-weight: bold;
            }
            .font_2{
                text-align: center; 
                font-size: 12px; 
                font-family: Tahoma;
            }
            #tableDealerSend td{
                vertical-align:middle; 
                text-align: center; 
                font-size: 14px; 
                font-family: Tahoma; 
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
                <span class="fa fa-truck"></span> รายการเคลมสินค้า
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li class="active" >รายการเคลม</li>
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
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#t_warranty" data-toggle="tab"><i class="fa fa-list-alt"></i> ค้นหารายการขายสินค้าที่มีประกัน</a></li>
                                    <li><a href="#t_claim_list"  data-toggle="tab"><i class="fa fa-bolt"></i> รายการสินค้าเคลม</a></li>
                                    <li><a href="#t_dealer_send"  data-toggle="tab"><i class="fa fa-truck"></i> รายการเคลมสินค้าส่งตัวแทน</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="t_warranty" class="tab-pane in active fade">
                                        <form id="form_find_war">
                                            <div class="col-md-6" style="margin-top:15px; margin-bottom: 10px; text-align: right;">
                                                <b>โปรดใส่ Serial Number :</b>
                                            </div>
                                            <div class="col-md-6" style="margin-top:10px; margin-bottom: 10px;">                                            
                                                <div class="input-group pull-right" style="width:100%;">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="txt_findwar" name="txt_findwar" placeholder="โปรดใส่ Serial Number" required="">
                                                        <div class="input-group-btn">
                                                            <button type="submit" class="btn bg-purple-gradient" id="" name=""><span class="fa fa-search"></span> ค้นหา</button> 
                                                        </div>
                                                    </div>
                                                </div>                                           
                                            </div>
                                        </form>
                                        <table id="tableClaim" class="table table-bordered table-hover">
                                            <thead>
                                                <tr  class="bg-purple-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 14px; font-weight: bold; font-family: Tahoma;">
                                                    <td width="100px">ลำดับ</td>
                                                    <td width="250px">ชื่อสินค้า</td>
<!--                                                    <td width="200px">หมดประกัน - ร้าน</td>
                                                    <td width="200px">หมดประกัน - ตัวแทน</td>-->
                                                    <td width="250px">S/N </td>
<!--                                                    <td width="250px">วันที่ขาย </td>-->
                                                    <td width="200px">เงื่อนไข</td>
                                                    <td width="200px">รายละเอียด</td>
                                                    <td width="100px"></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div id="t_claim_list" class="tab-pane">
                                        <div class="col-md-6" style="margin-top:10px;"></div>
                                        <div class="col-md-6" style="margin-top:10px;">                                            
                                            <div class="input-group pull-right" style="width:100%;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="txtClaimList" name="txtClaimList" placeholder="ค้นหา : เลขที่ใบเคลม.. ชื่อลูกค้า..">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn bg-aqua-gradient btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                        <table id="tableClaimList" class="table table-bordered table-hover">
                                            <thead>
                                                <tr  class="bg-aqua-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                                    <td width="10%">ลำดับ</td>
                                                    <td width="15%">เลขที่ใบเคลม</td>
                                                    <td width="20%">ชื่อลูกค้า</td>
                                                    <td width="10%">สถานะ</td>
                                                    <td width="15%">ประเภท</td>
                                                    <td width="10%">รายละเอียด</td>
                                                    <td width="20%"></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div id="t_dealer_send" class="tab-pane">
                                        <div class="col-md-6" style="margin-top:10px;"></div>
                                        <div class="col-md-6" style="margin-top:10px;">                                            
                                            <div class="input-group pull-right" style="width:100%;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="text_dealer" name="text_dealer" placeholder="ค้นหา : เลขที่ใบเคลมสินค้า...">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn bg-blue-gradient btn_re_load" id="" name=""><span class="fa fa-refresh"></span> รีเฟรช</button> 
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                        <table id="tableDealerSend" class="table table-bordered table-hover">
                                            <thead>
                                                <tr  class="bg-blue-gradient" style="vertical-align: middle; text-align: center; font-style: normal; font-size: 16px; font-weight: bold;">
                                                    <td width="10%">ลำดับ</td>
                                                    <td width="20%">เลขที่ใบเคลม</td>
                                                    <td width="25%">ตัวแทนขายที่ส่งเคลม</td>
                                                    <td width="25%">วันที่ส่งเคลม</td>
                                                    <td width="20%"></td>
                                                </tr>
                                            </thead>
                                        </table>
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
    <!-- Modal ex-->
    <div class="modal fade" id="Modal_Ex_Claim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_ex_claim">
                    <div class="modal-header bg-teal-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-save"></span> บันทึกเปลี่ยนเคลมสินค้า</h4>
                    </div>
                    <input type="hidden" id="ord_id" value=""/> <input type="hidden" id="unit_id" value=""/>
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover" id="tableEx_Claim">
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-teal-gradient">บันทึกข้อมูล</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal ex-->
    <div class="modal fade" id="Modal_Ex_Claim_2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_ex_claim_2">
                    <div class="modal-header bg-teal-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-save"></span> บันทึกเปลี่ยนเคลมสินค้า</h4>
                    </div>
                    <input type="hidden" id="ord_id_2" value=""/> <input type="hidden" id="unit_id_2" value=""/>
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover" id="tableEx_Claim_2">
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-teal-gradient">บันทึกข้อมูล</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal add -->
    <div class="modal fade" id="Modal_Add_Claim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_add_claim">
                    <div class="modal-header bg-blue-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-save"></span> บันทึกรับเคลม</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover" id="tableAdd_Claim">
                                    <tbody>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">เลขที่ขายสินค้า : </td>
                                            <td width="25%"><input type="text" class="form-control" id="ac_ord_id" name="ac_ord_id" value="" required="" readonly="" /></td>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">เลขที่สินค้า : </td>
                                            <td width="35%" colspan="2"><input type="text" class="form-control" id="ac_unit_id" name="ac_unit_id" value="" required="" readonly="" /></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">ชื่อสินค้า : </td>
                                            <td width="45%" colspan="2"><input type="text" class="form-control" id="ac_pname" name="ac_pname" readonly="" required="" value="" /></td>
                                            <td width="25%"></td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">S/N  : </td>
                                            <td colspan="2" width="45%"><input type="text" class="form-control" id="ac_sn" name="ac_sn" value="" required="" readonly="" /></td>
                                            <td width="25%"></td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">อาการเสีย - ชำรุด : </td>
                                            <td colspan="2" width="45%"><input type="text" class="form-control" id="ac_manner" name="ac_manner" value="" required="" /></td>
                                            <td width="25%"></td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">ชื่อ - นามสกุล ลูกค้า : </td>
                                            <td colspan="2"width="45%"><input type="text" class="form-control" id="ac_cusname" name="ac_cusname" value="" required=""/></td>
                                            <td width="25%"></td>
                                            <td width="10%"></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" class="font_1" style="vertical-align:middle;">เบอร์โทรศัพท์ : </td>
                                            <td width="25%"><input type="text" style="text-align:center;" class="form-control" id="ac_custel" name="ac_custel" data-inputmask='"mask": "999-999-9999"' data-mask required=""></td>
                                            <td width="20%"></td>
                                            <td width="25%"></td>
                                            <td width="10%"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-blue-gradient">บันทึกข้อมูล</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Detail Claim -->
    <div class="modal fade" id="Modal_Detail_Claim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-aqua-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-info-circle"></span> รายละเอียดการเคลมสินค้า</h4>
                </div>
                <input type="hidden" id="hidden_c_id" value="">
                <div class="modal-body">
                    <div class="box box-default">
                        <div class="box-body">
                            <table class="table table-responsive table-hover" id="tableDetail_Claim">
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Claim -->
    <div class="modal fade" id="Modal_Edit_Claim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-yellow-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-pencil"></span> แก้ไขรายการเคลมสินค้า</h4>
                </div>
                <form class="form-horizontal" id="form_edit_claim">
                    <input type="hidden" id="hidden_c_id_edit" name="hidden_c_id_edit" value="">
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover" id="">
                                    <tr>
                                        <td width="30%" class="font_1" style="vertical-align:middle;">อาการเสีย - ชำรุด : </td>
                                        <td width="40%"><input type="text" class="form-control" id="edit_manner" name="edit_manner" value="" required="" style="text-align:center" /></td>
                                        <td width="30%"></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="font_1" style="vertical-align:middle;">ชื่อ - นามสกุล ลูกค้า : </td>
                                        <td width="40%"><input type="text" class="form-control" id="edit_cusname" name="edit_cusname" value="" required="" style="text-align:center"/></td>
                                        <td width="30%"></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="font_1" style="vertical-align:middle;">เบอร์โทรศัพท์ : </td>
                                        <td width="40%"><input type="text" style="text-align:center;" class="form-control" id="edit_custel" name="edit_custel" data-inputmask='"mask": "999-999-9999"' data-mask required=""></td>
                                        <td width="30%"></td>
                                    </tr>
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
    <!-- Send -->
    <div class="modal fade" id="Modal_Send" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-green-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-truck"></span> ส่งเคลมสินค้า</h4>
                </div>
                <form class="form-horizontal" id="form_send">
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <table class="table table-responsive table-hover" id="">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;"> รายชื่อตัวแทนขาย : </td>
                                            <td width="40%"><select class="form-control select2" id="ddl_dealer" name="ddl_dealer" style="width:100%" required=""></select></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="font_1" style="vertical-align:middle;"> เลขที่ใบเคลม : </td>
                                            <td width="40%"><input type="text" id="send_cid" name="send_cid"  class="form-control" value="" required="" readonly=""/></td>
                                            <td width="30%"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-green-gradient">ยืนยันส่งเคลมสินค้า</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Detail Claim normal -->
    <div class="modal fade" id="modal_dcn" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-aqua-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-info-circle"></span> รายละเอียดสินค้าเคลม</h4>
                </div>
                <form class="form-horizontal" id="">
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <input type="hidden" id="detail_normal" value=""/>
                                <table class="table table-responsive table-hover" id="table_dcn">
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!--<button type="submit" class="btn bg-green-gradient">ยืนยันส่งเคลมสินค้า</button>-->
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Detail Claim ex -->
    <div class="modal fade" id="modal_dcex" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-aqua-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="font-variant: small-caps;"><span class="fa fa-info-circle"></span> รายละเอียดสินค้าเคลม</h4>
                </div>
                <form class="form-horizontal" id="">
                    <div class="modal-body">
                        <div class="box box-default">
                            <div class="box-body">
                                <input type="hidden" id="detail_ex" value=""/>
                                <table class="table table-responsive table-hover" id="table_dcex">
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!--<button type="submit" class="btn bg-green-gradient">ยืนยันส่งเคลมสินค้า</button>-->
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
    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <script>
        var tableClaim;
        var tableClaimList;
        var tableDealer;
        $(function () {
            $('#txtClaimList').keyup(function () {
                tableClaimList.search(this.value).draw();
            });
            $(document).on('click', '.btn_re_load', function () {
                location.reload();
            });
            $('.select2').select2();
            $("[data-mask]").inputmask();
            tableClaim = $("#tableClaim").DataTable({
                //"ajax": "",
                //"scrollX": "1650px",
                "scrollCollapse": true,
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                language: language
            });
            tableClaimList = $("#tableClaimList").DataTable({
                "ajax": "ajax/claim/select_claim_list.php",
                "scrollCollapse": true,
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
                    {"targets": 4, "orderable": false, "searchable": false},
                    {"targets": 5, "orderable": false, "searchable": false},
                    {"targets": 6, "orderable": false, "searchable": false}
                ]
            });
            tableDealer = $("#tableDealerSend").DataTable({
                "ajax": "ajax/claim/select_send_table.php",
                "scrollCollapse": true,
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
                    {"targets": 4, "orderable": false, "searchable": false}
                ]
            });
            $('#form_find_war').on('submit', function (e) {
                e.preventDefault();
                var ord = $('#txt_findwar').val();
                $.ajax({
                    url: "ajax/claim/check_find_warranty.php",
                    type: "post",
                    data: {txt_findwar: ord},
                    success: function (rs) {
                        if (rs !== "0") {
                            alert('พบข้อมูลการประกัน ' + rs + ' รายการ');
                            find_claim(ord);
                            $('#txt_findwar').val('');
                        } else {
                            alert('ไม่พบข้อมูลการประกันสินค้า');
                            $('#txt_findwar').val('');
                        }
                    }
                });
            });
            $('#Modal_Ex_Claim').on('shown.bs.modal', function () {
                var ord_id = $('#ord_id').val();
                var unit_id = $('#unit_id').val();
                $.ajax({
                    url: "ajax/claim/select_unit_detail.php",
                    type: "post",
                    dataType: "html",
                    data: {ord_id: ord_id, unit_id: unit_id},
                    success: function (sw) {
                        $('#tableEx_Claim').html(sw);
                    }
                });
            });
            $('#Modal_Ex_Claim_2').on('shown.bs.modal', function () {
                var ord_id = $('#ord_id_2').val();
                var unit_id = $('#unit_id_2').val();
                $.ajax({
                    url: "ajax/claim/select_unit_detail_2.php",
                    type: "post",
                    dataType: "html",
                    data: {ord_id: ord_id, unit_id: unit_id},
                    success: function (sw) {
                        $('#tableEx_Claim_2').html(sw);
                    }
                });
            });
            $('#modal_dcn').on('shown.bs.modal', function () {
                var number = $('#detail_normal').val();
                $.ajax({
                    url: "ajax/claim/select_detail_claim_normal.php",
                    type: "post",
                    dataType: "html",
                    data: {number: number},
                    success: function (rs) {
                        //console.log(rs);
                        $('#table_dcn').html(rs);
                    }
                });
            });
            $('#modal_dcex').on('shown.bs.modal', function () {
                var number = $('#detail_ex').val();
                $.ajax({
                    url: "ajax/claim/select_detail_claim_ex.php",
                    type: "post",
                    dataType: "html",
                    data: {number: number},
                    success: function (rs) {
                        $('#table_dcex').html(rs);
                    }
                });
            });
            $('#Modal_Add_Claim').on('shown.bs.modal', function () {
                $('#ac_manner').val('');
                $('#ac_cusname').val('');
                $('#ac_custel').val('');
            });
            $('#form_add_claim').on('submit', function (e) {
                e.preventDefault();
                var name = $("#ac_pname").val();
                var sn = $("#ac_sn").val();
                var data = $('#form_add_claim').serialize();
                $.ajax({
                    url: "ajax/claim/check_claim_list.php",
                    type: "post",
                    data: {name: name, sn: sn},
                    success: function (rs) {
                        if (rs === "0") {
                            var r = confirm('ยืนยันการบันทึกข้อมูลรายการรับเคลม');
                            if (r === true) {
                                $.ajax({
                                    url: "ajax/claim/insert_claim_ac.php",
                                    type: "post",
                                    data: data,
                                    success: function (data) {
                                        console.log(data);
                                        if (data === 'ok') {
                                            alert('บันทึกข้อมูลรายการรับเคลมเรียบร้อย');
                                            window.open("../report/cliam/claim_bill.php", "_blank");
                                            location.reload();
                                        } else {
                                            alert('ไม่สามารถบันทึกข้อมูลได้');
                                        }
                                    }
                                });
                            }
                        } else {
                            alert('รายการเคลมสินค้าได้ถูกเพิ่มแล้ว');
                        }
                    }
                });
            });
            $('#form_ex_claim').on('submit', function (e) {
                e.preventDefault();
                var r = confirm('ยืนยันการบันทึกข้อมูลเคลมแลกเปลี่ยน');
                if (r === true) {
                    var data = $('#form_ex_claim').serialize();
                    $.ajax({
                        url: "ajax/claim/insert_claim_ex.php",
                        type: "post",
                        data: data,
                        success: function (data) {
                            alert(data);
                            location.reload();
                        }
                    });
                }
            });
            $('#form_ex_claim_2').on('submit', function (e) {
                e.preventDefault();
                var r = confirm('ยืนยันการบันทึกข้อมูลเคลมแลกเปลี่ยน');
                if (r === true) {
                    var data = $('#form_ex_claim_2').serialize();
                    $.ajax({
                        url: "ajax/claim/insert_claim_ex_2.php",
                        type: "post",
                        data: data,
                        success: function (data) {
                            alert(data);
                            location.reload();
                        }
                    });
                }
            });
            $('#form_edit_claim').on('submit', function (e) {
                e.preventDefault();
                var data = $('#form_edit_claim').serialize();
                var r = confirm('ยืนยันการแก้ไขข้อมูลการเคลม');
                if (r === true) {
                    $.ajax({
                        url: "ajax/claim/edit_claim.php",
                        type: "post",
                        data: data,
                        success: function (data) {
                            if (data === 'ok') {
                                alert('แก้ไขรายการเคลมเรียบร้อย');
                                tableClaimList.ajax.reload();
                                $('#Modal_Edit_Claim').modal('hide');
                            } else {
                                alert('ไม่สามารถแก้ไขรายการได้');
                            }
                        }
                    });
                }
            });
            $('#form_send').on('submit', function (e) {
                e.preventDefault();
                var data = $('#form_send').serialize();
                var r = confirm('ยืนยันการส่งสินค้าเคลมให้ตัวแทนขาย');
                if (r === true) {
                    $.ajax({
                        url: "ajax/claim/send_dealer.php",
                        type: "post",
                        data: data,
                        success: function (data) {
                            console.log(data);
                            if (data === "ok") {
                                alert("บันทึกการส่งเคลมสินค้าให้ตัวแทนขายเรียบร้อย");
                                tableClaimList.ajax.reload();
                                tableDealer.ajax.reload();
                                $('#Modal_Send').modal('hide');
                            }
                        }
                    });
                }
            });
            $(document).on('click', '.btn_cancel_send', function () {
                var c_id = this.value;
                var r = confirm("ยืนยันการยกเลิกการส่งเคลมสินค้า");
                if (r === true) {
                    $.ajax({
                        url: "ajax/claim/cancel_send.php",
                        type: "post",
                        data: {c_id: c_id},
                        success: function (data) {
                            if (data === "ok") {
                                alert("ยกเลิกข้อมูลการส่งเคลมสินค้าเรียบร้อย");
                                tableClaimList.ajax.reload();
                                tableDealer.ajax.reload();
                            } else {
                                alert("ไม่สามารถยกเลิกข้อมูลการส่งเคลมสินค้าเรียบร้อย");
                            }
                        }
                    });
                }
            });
            $(document).on('click', '#findpro', function () {
                var unit_id = $('#ex_unit_id_new').val();
                $.ajax({
                    url: "ajax/claim/find_product.php",
                    type: "post",
                    dataType: "json",
                    data: {unit_id: unit_id},
                    success: function (rs) {
                        if (rs.rows === 0) {
                            alert('ไม่พบข้อมูล');
                            $('#ex_sn_new').val("");
                            $('#ex_pname').val("");
                        } else {
                            $('#ex_sn_new').val(rs.s_id);
                            $('#ex_pname').val(rs.pname);
                        }
                    }
                });
            });
            $('#Modal_Detail_Claim').on('shown.bs.modal', function () {
                var c_id = $('#hidden_c_id').val();
                $.ajax({
                    url: "ajax/claim/select_detail_cliam.php",
                    type: "post",
                    dataType: "html",
                    data: {c_id: c_id},
                    success: function (rs) {
                        $('#tableDetail_Claim').html(rs);
                    }
                });
            });
            $('#Modal_Edit_Claim').on('shown.bs.modal', function () {
                var c_id = $('#hidden_c_id_edit').val();
                $.ajax({
                    url: "ajax/claim/find_claim_edit.php",
                    type: "post",
                    dataType: "json",
                    data: {c_id: c_id},
                    success: function (rs) {
                        if (rs.rows === 0) {
                            $('#edit_manner').val("");
                            $('#edit_cusname').val("");
                            $('#edit_custel').val("");
                        } else {
                            $('#edit_manner').val(rs.manner);
                            $('#edit_cusname').val(rs.name);
                            $('#edit_custel').val(rs.tel);
                        }
                    }
                });
            });
            $('#Modal_Send').on('shown.bs.modal', function () {
                //var cid = $("#send_cid").val();
                $.ajax({
                    url: 'ajax/claim/select_dealer_ddl.php',
                    type: 'post',
                    dataType: 'JSON',
                    success: function (data) {
                        $('#ddl_dealer').empty();
                        $('#ddl_dealer').append('<option id="" value="">โปรดเลือกตัวแทนขาย</option>');
                        $.each(data, function (key, val) {
                            $('#ddl_dealer').append('<option id="' + val.id + '" value="' + val.id + '">' + val.name + '</option>');
                        });
                    }
                });
            });
            $(document).on('click', '.btn_c_detail', function () {
                var c_id = this.value;
                $('#hidden_c_id').val(c_id);
                $('#Modal_Detail_Claim').modal('show');
            });
            $(document).on('click', '.btn_send', function () {
                var cid = this.value;
                $('#send_cid').val(cid);
                $('#Modal_Send').modal('show');
            });
            $(document).on('click', '.btn_edit_c', function () {
                var c_id = this.value;
                $('#hidden_c_id_edit').val(c_id);
                $('#Modal_Edit_Claim').modal('show');
            });
            $(document).on('click', '.btn_cancel_c', function () {
                var c_id = this.value;
                var r = confirm("ยืนยันการยกเลิกรายการรับเคลม");
                if (r === true) {
                    $.ajax({
                        url: "ajax/claim/cancel_claim.php",
                        type: "post",
                        data: {c_id: c_id},
                        success: function (data) {
                            if (data === 'ok') {
                                alert('ยกเลิกรายการเคลมเรียบร้อย');
                                tableClaimList.ajax.reload();
                            } else {
                                alert('ไม่สามารถแก้ไขรายการได้');
                            }
                        }
                    });
                }
            });
            $(document).on('click', '.btn_c_bill', function () {
                var cid = this.value;
                $.ajax({
                    url: "ajax/claim/set_session_c.php",
                    type: "post",
                    data: {cid: cid},
                    success: function (data) {
                        window.open("../report/cliam/claim_bill.php", "_blank");
                        //console.log(data)
                    }
                });
            });
        });
        function claim_ex_id(ord_id, unit_id, pname) {
            console.log(pname);
            $('#ord_id').val(ord_id);
            $('#unit_id').val(unit_id);
            $('#Modal_Ex_Claim').modal('show');
        }
        ;
        function claim_ex_id_2(ord_id, unit_id, pname) {
            console.log(pname);
            $('#ord_id_2').val(ord_id);
            $('#unit_id_2').val(unit_id);
            $('#Modal_Ex_Claim_2').modal('show');
        }
        ;
        function claim_add(ord_id, unit_id, pname, sid) {
            console.log(ord_id, unit_id);
            $('#ac_ord_id').val(ord_id);
            $('#ac_unit_id').val(unit_id);
            $('#ac_pname').val(pname);
            $('#ac_sn').val(sid);
            $('#Modal_Add_Claim').modal('show');
        }
        ;
        function find_claim(ord) {
            tableClaim = $('#tableClaim').DataTable({
                destroy: true,
                ajax: {
                    url: "ajax/claim/find_warranty.php",
                    type: "post",
                    data: {txt_findwar: ord}
                },
                //"scrollX": "1650px",
                "scrollCollapse": true,
                "bInfo": true,
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                language: language
            });
        }
        ;
        function show_detail(number) {
            //ord_id,unit_id,p_name,s_id,number
            //console.log(number);
            $('#detail_normal').val(number);
            $('#modal_dcn').modal('show');
        }
        ;
        function show_detail_ex(ex_number) {
            //ord_id,unit_id,p_name,s_id,ex_number
            //console.log('ex ', ex_number);
            $('#detail_ex').val(ex_number);
            $('#modal_dcex').modal('show');
        }
        ;
    </script>
</body>

</html>
