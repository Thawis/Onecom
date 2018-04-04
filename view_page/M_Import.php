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
        <!-- Select 2 -->
        <link href="../plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootsrap DatePicker-->
        <link href="../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
        <!-- Daterange picker -->
        <link href="../plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
        <title>รับเข้าสินค้าขาย</title>
        <!-- iCheck -->
        <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css"/>
        <!-- Custom CSS -->
        <style>
            .dataTables_filter{
                display: none;
            }
            #table-product td{
                vertical-align: middle;
                font-style: normal;
                font-size: 14px; 
                text-align: center;
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
            #table_sne td{
                vertical-align: middle;
                font-style: normal;
                font-size: 14px; 
                text-align: center;
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
            <h1>
                <span class="fa fa-cart-plus"></span> รับเข้าสินค้าขาย
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>รับเข้าสินค้า</li>
                <li class="active">รับเข้าสินค้าขาย</li>
            </ol>
        </section>
        <section class="content" style="height:1600px;">
            <div class="row">
                <div class="col-md-12">
                    <!--<div class="panel">-->
                    <div class="box box-default">
                        <div class="panel-body">        
                            <!--Content -->
                            <div class="content">
                                <div class="box-header with-border bg-green-gradient">
                                    <h3 class="box-title"><span class="fa fa-list-ul"></span> รายการข้อมูลนำเข้าสินค้า</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-responsive">
                                        <tbody>
                                            <tr style="font-size: 14px;">
                                                <td colspan="5" width="80%" style="vertical-align: middle; text-align: right;">รหัสรายการรับเข้าสินค้า : </td>
                                                <td width="20%" style="vertical-align: middle; text-align: center;"><input type="text" id="imp_id" name="imp_id" class="form-control" style="text-align:center;" readonly=""  required=""></td>
                                            </tr>
                                            <tr style="font-size: 14px;">
                                                <td width="15%" style="vertical-align: middle; text-align: right;">รหัสตัวแทนขายสินค้า : </td>
                                                <td width="10%" style="vertical-align: middle;"><input type="text" id="dealer_id" class="form-control" style="text-align:center;" readonly=""  required=""></td>
                                                <td width="5%"  style="vertical-align : middle; text-align: center;"><button class="btn bg-green-gradient btn-block" id="" data-toggle="modal" data-target="#ModalDealer"><span class="fa fa-search"></span></button></td>
                                                <td width="17%" style="vertical-align: middle; text-align: right;">เลขอ้างอิงใบรับเข้า : </td>
                                                <td width="18%" style="vertical-align: middle;"><input type="text" id="ref_import" class="form-control" style="text-align:center;" required=""></td>
                                                <td width="35%">
                                                    <button class="btn bg-green-gradient" id="deal_ok" style="width:150px;">ยืนยันรายการ</button>
                                                    <button class="btn bg-red-gradient" id="deal_cancel" style="width:150px;">ยกเลิกรายการ</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-body" id="box_import" hidden=""> <!-- hidden="" -->
                                    <table class="table table-responsive" id="">
                                        <tr style="font-size: 14px;">    
                                            <td width="10%" style="vertical-align: middle; text-align: right;">รหัสสินค้า : </td>
                                            <td width="10%" style="vertical-align: middle;"><input type="text" id="sp_id" class="form-control" style="text-align:center;" readonly=""  required=""></td>
                                            <td width="5%" style="vertical-align : middle; text-align: right"><button class="btn bg-green-gradient color-palette btn-block" id="findPro" data-toggle="modal" data-target="#ModalFind"><span class="fa fa-search"></span></button></td>
                                            <td width="10%" style="vertical-align: middle; text-align: right;">จำนวนรับเข้า : </td>
                                            <td width="10%" style="vertical-align: middle; text-align: center;"><input type="number" id="input_number" class="form-control" style="text-align:center;" required="" min="1" max="50"></td>
                                            <td width="10%" style="vertical-align: middle; text-align: right;">วันที่รับเข้า : </td>
                                            <td width="15%" style="vertical-align: middle; text-align: center;">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" id="datepicker" style="text-align:center;">
                                                </div>
                                            </td>
                                            <td width="15%" style="vertical-align: middle; text-align: center;">ระยะเวลาประกัน :</td>
                                            <td width="15%" style="vertical-align: middle; text-align: center;">
                                                <select class="form-control select2" id="ddlwar_date" style="width:100%">
                                                    <!--                                                    <option value="none">ไม่มีประกัน</option>
                                                                                                        <option value="+7 days">7วัน</option>
                                                                                                        <option value="+15 days">15วัน</option>
                                                                                                        <option value="+30 days">30วัน</option>
                                                                                                        <option value="+3 month">3เดือน</option>
                                                                                                        <option value="+6 month">6เดือน</option>
                                                                                                        <option value="+1 year">1ปี</option>
                                                                                                        <option value="+2 year">2ปี</option>
                                                                                                        <option value="+3 year">3ปี</option>
                                                                                                        <option value="+5 year">5ปี</option>
                                                                                                        <option value="L-T">L-T</option>-->
                                                </select>
                                            </td>                                                        
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="vertical-align: middle; text-align: right; font-style: normal; font-size: 14px; font-weight: bold;">
                                                เลือกประเภท :
                                            </td>
                                            <td colspan="2" style="vertical-align: middle; font-style: normal; font-size: 14px; font-weight: bold;">
<!--                                                <select class="form-control" id="dd_check_sn" style="text-align:center;">
                                                    <option value="none">-- เลือกประเภท --</option>
                                                    <option value="hsn">สินค้ามี Serial Number</option>
                                                    <option value="nsn">สินค้าไม่มี Serial Number</option>
                                                </select>-->
                                                <input type="radio" id="radio_hsn" name="typesn" value="hsn" class="minimal"> มี S/N
                                                <input type="radio" id="radio_nsn" name="typesn" value="nsn" class="minimal"> ไม่มี S/N                                                
                                            </td>
                                            <td colspan="3" style="vertical-align: middle; text-align: left;">
                                                <button class="btn bg-green-gradient" id="btn_num" style="width:150px;"><span class="fa fa-plus-square"></span> รับเข้า</button>
                                                <button class="btn bg-red-gradient" id="btn_clerimp" style="width:150px;"><span class="fa fa-recycle"></span> ล้างรายการ</button>
                                            </td>
                                        </tr>
                                    </table>
                                    <!--</div>-->
<!--                                    <table class="table table-responsive table-bordered">
                                        <tr class="bg-green-gradient" style="vertical-align: middle; font-style: normal; font-size: 14px; font-weight: bold;">
                                            <th width="10%" style="text-align:center;">ลำดับที่</th>
                                            <th width="10%" style="text-align:center;">รหัสสินค้า</th>
                                            <th width="20%" style="text-align:center;">ชื่อสินค้า</th>
                                            <th width="5%" style="text-align:center;">จำนวน</th>
                                            <th width="15%" style="text-align:center;">วันที่รับเข้าสินค้า</th> 
                                            <th width="15%" style="text-align:center;">ระยะเวลาประกัน</th>
                                            <th width="10%" style="text-align:center;">S/N</th>
                                            <th width="15%" style="text-align:center;"></th> 
                                        </tr>
                                    </table>-->
                                    <form class="Add_Punit" name="Add_Punit" id="Add_Punit" method="post" > <!--novalidate name="Add_Punit" id="Add_Punit"-->
                                        <input type="hidden" id="imp_id_send" name="imp_id_send" value=""/>
                                        <table class="table table-responsive table-bordered" id="dynamic_field">
                                            <thead>
                                                <tr class="bg-green-gradient" style="vertical-align: middle; font-style: normal; font-size: 14px; font-weight: bold;">
                                                    <th width="10%" style="text-align:center;">ลำดับที่</th>
                                                    <th width="10%" style="text-align:center;">รหัสสินค้า</th>
                                                    <th width="20%" style="text-align:center;">ชื่อสินค้า</th>
                                                    <th width="5%" style="text-align:center;">จำนวน</th>
                                                    <th width="15%" style="text-align:center;">วันที่รับเข้าสินค้า</th> 
                                                    <th width="15%" style="text-align:center;">ระยะเวลาประกัน</th>
                                                    <th width="10%" style="text-align:center;">S/N</th>
                                                    <th width="15%" style="text-align:center;"></th> 
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <div class="form-group" style="text-align: center;">
                                            <input type="hidden" id="dealer" name="dealer" value=""> <input type="hidden" id="ref" name="ref" value=""> <input type="hidden" id="Pname" name="Pname" value=""><input type="hidden" id="uid" name="uid" value=""/>
                                            <button type="submit" class="btn bg-green-gradient" id="btn_submit" disabled="" style="width:150px;">ยืนยันรับเข้า</button>
                                        </div>
                                    </form>
                                </div> <!-- box-body -->
                            </div>
                        </div>             
                    </div>
                    <!--</div> /.container-fluid -->
                </div>
            </div>
        </section>
    </div>
    <!-- modal find product -->
    <div class="modal fade" id="ModalFind" role="dialog" aria-labelledby="myModalLabel">
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
                                                <button class="btn bg-green-gradient" type="button" id="btntest">ค้นหา</button>
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
                                    <td width="15%" style="text-align:center;">รหัสสินค้า</td>
                                    <td width="30%" style="text-align:center;">ชื่อสินค้า</td>
                                    <td width="15%" style="text-align:center;">ยี่ห้อ</td>
                                    <td width="20%" style="text-align:center;">ประเภทสินค้า</td>
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
    <!-- modal dealer -->
    <div class="modal fade" id="ModalDealer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form-dealer">
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-family: Tahoma;"><span class="fa fa-user-secret"></span> ตัวแทนขายสินค้า</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-solid">
                            <div class="box-header bg-green-gradient">
                                <h3 class="box-title" style="font-style: normal; font-size: 19px;"><span class="fa fa-search"></span> ค้นหาตัวแทนขายสินค้า</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-hover">
                                    <tr>
                                        <td colspan="4" style="text-align: center;">
                                    <center><div class="input-group" style="width: 60%">
                                            <input type="text" id="txtSearch-dealer" class="form-control" placeholder="ค้นหาข้อมูล...">
                                            <span class="input-group-btn">
                                                <button class="btn bg-green-gradient" type="button" id="btntest">ค้นหา</button>
                                            </span>
                                        </div></center>
                                    </td>
                                    </tr>
                                </table>
                                <table id="table-dealer" class="table table-bordered table-hover table-responsive" >
                                    <thead>
                                        <tr class="bg-green-gradient" style="vertical-align: middle; font-style: normal; font-size: 14px; font-weight: bold;">
                                            <th width="10%" style="text-align:center;">ลำดับ</th>
                                            <th width="20%" style="text-align:center;">รหัสตัวแทนจำหน่าย</th>
                                            <th width="30%" style="text-align:left;">ชื่อ - นามสกุล</th>
                                            <th width="25%" style="text-align:center;">บริษัท</th>
                                            <th width="15%"></th>
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
    <!-- modal serialnumber -->
    <div class="modal fade" id="ModalSN" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_sn">
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-family: Tahoma;"><span class="fa fa-exclamation-circle"></span> กรุณากรอก Serial Number</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-body">
                            <table class="table table-responsive table-hover table-bordered" id="table_sn">
                                <thead>
                                    <tr class="bg-green-gradient">
                                        <td width="10%" style="font-weight: bold; vertical-align: middle; text-align: center;">ลำดับ</td>
                                        <td widht="20%" style="font-weight: bold; vertical-align: middle; text-align: center;">รหัสสินค้า</td>
                                        <td width="70%" style="font-weight: bold; vertical-align: middle; text-align: center;">Serial Number</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class=" btn bg-green-gradient">ยืนยัน</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal serialnumber detail -->
    <div class="modal fade" id="ModalSND" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="">
                    <input type="hidden" id="pid_snd" name="pidsnd" value=""/>
                    <div class="modal-header bg-aqua-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-family: Tahoma;"><span class="fa fa-info-circle"></span> รายละเอียด Serial Number</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-body">
                            <table class="table table-responsive table-hover table-bordered" id="table_snd">
                                <thead>
                                    <tr class="bg-aqua-gradient">
                                        <td width="10%" style="font-weight: bold; vertical-align: middle; text-align: center;">ลำดับ</td>
                                        <td widht="20%" style="font-weight: bold; vertical-align: middle; text-align: center;">รหัสสินค้า</td>
                                        <td width="70%" style="font-weight: bold; vertical-align: middle; text-align: center;">Serial Number</td>
                                    </tr>
                                </thead>
<!--                                <tbody>
                                </tbody>-->
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal serialnumber edit -->
    <div class="modal fade" id="ModalSNE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" id="pid_sne" name="pidsne" value=""/>
                <div class="modal-header bg-yellow-gradient">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="font-family: Tahoma;"><span class="fa fa-cog"></span> แก้ไข Serial Number</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <table class="table table-responsive table-hover table-bordered" id="table_sne">
                            <thead>
                                <tr class="bg-yellow-gradient">
                                    <td width="10%" style="font-weight: bold; vertical-align: middle; text-align: center;">ลำดับ</td>
                                    <td widht="20%" style="font-weight: bold; vertical-align: middle; text-align: center;">รหัสสินค้า</td>
                                    <td width="60%" style="font-weight: bold; vertical-align: middle; text-align: center;">Serial Number</td>
                                    <td width="10%" style="vertical-align: middle; text-align: center;"></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                </div>
                <form class="form-horizontal" id="">
                </form>
            </div>
        </div>
    </div>
    <!-- modal serialnumber addsn -->
    <div class="modal fade" id="ModalSN_2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form_sn_2">
                    <div class="modal-header bg-green-gradient">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="font-family: Tahoma;"><span class="fa fa-exclamation-circle"></span> กรุณากรอก Serial Number</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-body">
                            <input type="hidden" id="pid_addsn" name="pid_addsn" value=""/>
                            <table class="table table-responsive table-hover table-bordered" id="table_sn_2">
                                <thead>
                                    <tr>
                                        <td colspan="2" widht="90%" style="font-weight: bold; vertical-align: middle; text-align: right;">เพิ่ม S/N : </td>
                                        <td colspan="1" widht="10%" style="font-weight: bold; vertical-align: middle; text-align: right;"><button type="button" class="btn bg-green-gradient add_sn2"><span class="fa fa-plus"></span></button></td>
                                    </tr>
                                    <tr class="bg-green-gradient">
                                        <td widht="20%" style="font-weight: bold; vertical-align: middle; text-align: center;">รหัสสินค้า</td>
                                        <td width="70%" style="font-weight: bold; vertical-align: middle; text-align: center;">Serial Number</td>
                                        <td width="10%" style="font-weight: bold; vertical-align: middle; text-align: center;"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-green-gradient" id="btn_addsn2" disabled="">ยืนยัน</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                    </div>
                </form>
            </div>
        </div>
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
    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <!-- language DataTable-->
    <script src="script/global.js" type="text/javascript"></script>
    <script src="../plugins/datepicker/locales/bootstrap-datepicker.th.js" type="text/javascript"></script>
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
        var tableProduct;
        var tableDealer;
        var tableSNE;
        var typesn = 'hsn';
        var i = 0;
        var temp_i = 0;
        var temp_i2 = 0;
        var temp_i3 = 0;
        var all_sn = [];
        var apid = [];
        $(function () {
            clearTemp();
            setimp();
            load_ddlwar();
            //select2
            $('.select2').select2();
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            //Date picker
            $('#datepicker').datepicker({
                language: "th",
                autoclose: true,
                format: "yyyy-mm-dd"
            });
            $("#radio_hsn").iCheck('toggle');
            $('[name=typesn]').on('ifChanged', function () {
                if ($(this).is(':checked')) {
                    typesn = this.value;
                }
            });
            $('#datepicker').datepicker().datepicker('setDate', 'today');
            $('#btn_num').on('click', function () {
                var ddsn = typesn;
                var pid = $("#sp_id").val();
                var s = chk_imp();
                //console.log('ddsn : ',ddsn);

                if (ddsn === 'none') {
                    alert('กรุณาเลือกประเภท Serial Number');
                } else if (s === 'ok' && ddsn !== 'none') {

                    var r = confirm("เพิ่มจำนวนรับเข้า ใช่หรือไม่ ?");
                    if (r === true) {
                        var state = chkPid(pid);
                        if (state === 'ok') {
                            //$('#dd_check_sn').attr("disabled", true);
                            $('[name=typesn]').attr("disabled", true);
                            $('#ModalSN').modal('show');
                        } else {
                            alert('รายการสินค้านี้ถูกเลือกแล้ว');
                        }
                    }
                } else if (s === 'more') {
                    alert('กรุณากรอกจำนวนไม่เกิน 50 ชิ้น ต่อครั้ง');
                } else {
                    alert('กรุณากรอกข้อมูลให้ครบ');
                }
            });

            $('#btn_clerimp').on('click', function () {
                var r = confirm("ยืนยันการยกเลิกจำนวนรับเข้า");
                if (r === true) {
                    clear_import_detail();
                }
            });

            $('#deal_ok').on('click', function () {
                var dealer_id = $('#dealer_id').val();
                var ref_id = $('#ref_import').val();
                if (dealer_id === '' || ref_id === '') {
                    alert('กรุณากรอกข้อมูลให้ครบ');
                } else {
                    $('#box_import').removeAttr('hidden');
                    $('#deal_ok').attr('disabled', true);
                    $('#dealer').val(dealer_id);
                    $('#ref').val(ref_id);
                    $('#ref_import').attr('readonly', true);
                }
            });

            $('#deal_cancel').on('click', function () {
                var r = confirm("ยืนยันการยกเลิกข้อมูลการรับเข้า");
                if (r === true) {
                    clear_import_detail();
                    $("#radio_hsn").iCheck('toggle');
                    $('#box_import').attr("hidden", true);
                    $('#deal_ok').removeAttr("disabled");
                    $('#ref_import').removeAttr("readonly");
                    $('#dealer_id').val("");
                    $('#ref_import').val("");
                }
            });

            $('#ModalFind').on('shown.bs.modal', function () {
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
            $('#ModalDealer').on('shown.bs.modal', function () {
                $("#table-dealer").dataTable().fnDestroy();
                tableDealer = $("#table-dealer").DataTable({
                    "ajax": "ajax/import/select_dealer.php",
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
                        {"targets": 4, "orderable": false, "searchable": false}],
                    language: language,
                });
                $('#txtSearch-dealer').keyup(function () {
                    tableDealer.search(this.value).draw();
                });
            });
            $('#ModalSN').on('shown.bs.modal', function () {
                $('.myrows_sn').remove();
                var ddsn = typesn;
                var num = $('#input_number').val();
                var pid = $('#sp_id').val();
                setbox_sn(num, pid, ddsn);
            });
            $('#ModalSN_2').on('shown.bs.modal', function () {
                $('.myrows_sn2').remove();
                temp_i3 = 0;
                $('#btn_addsn2').attr('disabled', true);
            });
            $('#ModalSND').on('shown.bs.modal', function () {
                $("#table_snd > tbody").html("");
                var pid = $('#pid_snd').val();
                $.ajax({
                    url: "ajax/import/select_sn_detail.php",
                    type: "post",
                    dataType: "html",
                    //async: false,
                    data: {pid: pid},
                    success: function (data) {
                        //$('#table_snd').html(data);
                        $('#table_snd').append(data);
                    }
                });
            });
            $('#ModalSNE').on('shown.bs.modal', function () {
                var pid = $('#pid_sne').val();
                tableSNE = $("#table_sne").DataTable({
                    destroy: true,
                    ajax: {
                        url: "ajax/import/select_sn_edit.php",
                        type: "post",
                        data: {pid: pid}
                    },
                    "bInfo": false,
                    "paging": false,
                    "lengthChange": false,
                    "iDisplayLength": 15,
                    "searching": false,
                    "ordering": false,
                    "info": false,
                    "autoWidth": false,
                    language: language
                });
            });
            $('#form_sn').on('submit', function (e) {
                e.preventDefault();
                var pid = $('#sp_id').val();
                var num = $('#input_number').val();
                //var ddsn = $('#dd_check_sn').val();
                var ddsn = typesn;
                if (ddsn === 'hsn') {
                    var state = chk_sn_modal(num);
                    if (state === 'ok') {
                        $.ajax({
                            url: "ajax/import/insert_sn_temp.php",
                            method: "POST",
                            data: $('#form_sn').serialize(),
                            success: function (data) {
                                alert(data);
                                setbox_modal(num);
                                $('#ModalSN').modal('hide');
                                $('#btn_submit').removeAttr('disabled');
                                apid.push(pid);
                                $('#input_number').val("");
                                $('#sp_id').val("");
                                $('#ddlwar_date').val($('#ddlwar_date option:first-child').val()).trigger('change');
                            }
                        });
                    }
                } else if (ddsn === 'nsn') {
                    $.ajax({
                        url: "ajax/import/insert_sn_temp.php",
                        method: "POST",
                        data: $('#form_sn').serialize(),
                        success: function (data) {
                            alert(data);
                            setbox_modal(num);
                            $('#ModalSN').modal('hide');
                            $('#btn_submit').removeAttr('disabled');
                            apid.push(pid);
                            $('#input_number').val("");
                            $('#sp_id').val("");
                            $('#ddlwar_date').val($('#ddlwar_date option:first-child').val()).trigger('change');
                        }
                    });
                }
            });
            $('#form_sn_2').on('submit', function (e) {
                var pid = $('#pid_addsn').val();
                e.preventDefault();
                //var ddsn = $('#dd_check_sn').val();
                var ddsn = typesn;
                if (ddsn === 'hsn') {
                    var r = confirm("ยืนยันการเพิ่ม S/N");
                    if (r === true) {
                        $.ajax({
                            url: "ajax/import/insert_sn_temp2.php",
                            method: "POST",
                            dataType: "json",
                            data: $('#form_sn_2').serialize(),
                            success: function (data) {
                                alert(data.state);
                                $('.myrows_unit2').remove();
                                $('#btn_submit').removeAttr('disabled');
                                $('#input_number').val("");
                                $('#sp_id').val("");
                                $('#ModalSN_2').modal('hide');
                                $('input[name="' + pid + 'num"]').val(data.number);
                            }
                        });
                    }
                } else if (ddsn === 'nsn') {
                    var w = confirm("ยืนยันการเพิ่ม S/N");
                    if (w === true) {
                        $.ajax({
                            url: "ajax/import/insert_sn_temp2.php",
                            method: "POST",
                            dataType: "json",
                            data: $('#form_sn_2').serialize(),
                            success: function (data) {
                                alert(data.state);
                                $('.myrows_unit2').remove();
                                $('#btn_submit').removeAttr('disabled');
                                $('#input_number').val("");
                                $('#sp_id').val("");
                                $('#ModalSN_2').modal('hide');
                                $('input[name="' + pid + 'num"]').val(data.number);
                            }
                        });
                    }
                }
            });
            $(document).on('submit', 'form#Add_Punit', function (event) {
                event.preventDefault();
                var r = confirm("ยืนยันการรับเข้าสินค้า");
                if (r === true) {
                    //var ddsn = $('#dd_check_sn').val();
                    var ddsn = typesn;
                    if (ddsn === 'hsn') {
//                        all_sn.sort();
//                        var sn = [];
//                        for (var k = 0; k < all_sn.length - 1; k++) {
//                            if (all_sn[k + 1] === all_sn[k]) {
//                                sn.push(all_sn[k]);
//                            }
//                        }
//                        if (sn.length > 0) {
//                            alert('Serial Number " ' + sn + ' " ซ้ำ');
//                            console.log(sn);
//                        } else {
                        $.ajax({
                            url: "ajax/import/insert_unit.php",
                            method: "POST",
                            data: $('#Add_Punit').serialize(),
                            success: function (data)
                            {
                                if (data === 'ok') {
                                    alert('เพิ่มข้อมูลเรียบร้อย');
                                    location.reload();
//                                    setimp();
//                                    clear_import_detail();
//                                    $('#box_import').attr("hidden", true);
//                                    $('#deal_ok').removeAttr("disabled");
//                                    $('#ref_import').removeAttr("readonly");
//                                    $('#dealer_id').val("");
//                                    $('#ref_import').val("");
                                }
                            }
                        });
                        //}
                    } else if (ddsn === 'nsn') {
                        $.ajax({
                            url: "ajax/import/insert_unit.php",
                            method: "POST",
                            data: $('#Add_Punit').serialize(),
                            success: function (data)
                            {
                                if (data === 'ok') {
                                    alert('เพิ่มข้อมูลเรียบร้อย');
                                    location.reload();
                                }
                            }
                        });
                    }
                }
            });
            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                var temp = this.value;
                var r = confirm("ยืนยันการยกเลิกรายการ " + temp);
                if (r === true) {
                    $.ajax({
                        url: "ajax/import/remove_temp_sn_pid.php",
                        type: "post",
                        data: {pid: temp},
                        success: function (data) {
                            if (data === 'ok') {
                                apid = jQuery.grep(apid, function (value) {
                                    return value !== temp;
                                });
                                $('#row' + button_id + '').remove();
                                i--;
                                resetnum();
                            }
                        }
                    });
                }
            });
            $(document).on('click', '.btn_remove2', function () {
                //var button_id = $(this).attr("id");
                var temp = this.value;
                var r = confirm("ยืนยันการยกเลิกรายการ ");
                if (r === true) {
                    $('#row2' + temp + '').remove();
                    temp_i3--;
                    if (temp_i3 === 0) {
                        $('#btn_addsn2').attr("disabled", true);
                    }
                }
            });
            $(document).on('click', '.sn_detail', function () {
                $('#ModalSND').modal('show');
                $('#pid_snd').val(this.value);
            });
            $(document).on('click', '.btn_editsn', function () {
                $('#ModalSNE').modal('show');
                $('#pid_sne').val(this.value);
            });
            $(document).on('click', '.sn_remove', function () {
                var num = this.value;
                var pid = $('#pid_sne').val();
                var r = confirm("ยืนยันการยกเลิก S/N");
                if (r === true) {
                    $.ajax({
                        url: "ajax/import/remove_temp_sn_edit.php",
                        type: "post",
                        dataType: "json",
                        data: {num: num, pid: pid},
                        success: function (data) {
                            if (data.state === 'ok') {
                                tableSNE.ajax.reload(null, false);
                                //console.log(data.number);
                                $('input[name="' + pid + 'num"]').val(data.number);
                            }
                        }
                    });
                }
            });
            $(document).on('click', '.btn_addsn', function () {
                $('#ModalSN_2').modal('show');
                $('#pid_addsn').val(this.value);
            });
            $(document).on('click', '.add_sn2', function () {
                var pid = $('#pid_addsn').val();
                //var ddsn = $('#dd_check_sn').val();
                var ddsn = typesn;
                setbox_sn2(pid, ddsn);
            });
        });

        function loadAll() {
            $("#table-product").dataTable().fnDestroy();
            tableProduct = $("#table-product").DataTable({
                "ajax": "ajax/import/select_product.php",
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
                    {"targets": 5, "orderable": false, "searchable": false}],
                language: language
            });
        }
        function loadData(id, sub) {
            $("#table-product").dataTable().fnDestroy();
            tableProduct = $("#table-product").dataTable({
                //"destroy": true,
                ajax: {
                    url: "ajax/import/select_sg_product.php",
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
                    {"targets": 5, "orderable": false, "searchable": false}],
                language: language,
            });
        }
        function setPid(a, b, c) {
            $('#sp_id').val(a);
            $('#Pname').val(b);
            $('#uid').val(c);
        }
        ;
        function setD_id(dealer_id) {
            $('#dealer_id').val(dealer_id);
        }
        ;
        function setbox_modal(num) {
            var pid = $('#sp_id').val();
            var datewar = $('#datepicker').val();
            var timevalue = $('#ddlwar_date').val();
            var timetext = $('#ddlwar_date option:selected').text();
            var pname = $('#Pname').val();
            var uid = $('#uid').val();
            //var rows = 1;
            //while (rows <= num) {
            i++;
            temp_i++;
            //var tempsn = $('#temp_sn' + rows + '').val();
            var element = '<tr class="myrows_unit" id="row' + temp_i + '"><td width="10%" style="vertical-align: middle; text-align: center;">' + i + '</td>';
            element += '<td width="10%" style="vertical-align: middle; text-align: center;"><input type="text" name="P_ID[]" class="form-control" style="text-align: center;" readonly="" value="' + pid + '"/></td>';
            element += '<td width="20%" style="vertical-align: middle; text-align: center;"><input type="text" name="imp_Pname[]" class="form-control" style="text-align: center;" value="' + pname + '" readonly=""/><input type="hidden" name="imp_uid[]" value="' + uid + '"/></td>';
            element += '<td width="5%" style="vertical-align: middle; text-align: center;"><input type="text" name="' + pid + 'num" class="form-control" style="text-align: center;" value="' + num + '" readonly=""/></td>';
            element += '<td width="15%" style="vertical-align: middle; text-align: center;"><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right datewar" name="Datewar[]" style="text-align:center;" required="" value="' + datewar + '"></div></td>';
            element += '<td width="15%" style="vertical-align: middle; text-align: center;"><input type="text" name="Time_War[]" class="form-control" readonly="" style="text-align:center;"  value="' + timetext + '"/><input type="hidden" name="Option_War[]" value="' + timevalue + '"  /></td>';
            element += '<td width="10%" style="vertical-align: middle; text-align: center;"><button type="button" class="btn bg-aqua-gradient btn-block sn_detail" style="text-align: center;" value="' + pid + '">S/N</button></td>'
            element += '<td width="15%" style="vertical-align: middle; text-align:center;">';
            element += '<button type="button" class="btn bg-green-gradient btn_addsn" value="' + pid + '"><span class="fa fa-plus"></span></button> ';
            element += '<button type="button" class="btn bg-yellow-gradient btn_editsn" value="' + pid + '"><span class="fa fa-cog"></span></button> ';
            element += '<button type="button" class="btn bg-red-gradient btn_remove" name="remove" id="' + temp_i + '" value="' + pid + '"><span class="fa fa-close"></span></button>';
            element += '</td></tr>'
            $('#dynamic_field').append(element);
            //rows++;
            //}
            $('.datewar').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
        }
        ;
        function setbox_sn(num, pid, ddsn) {
            //console.log(num);
            var k = 1;
            if (ddsn === 'hsn') {
                while (k <= num) {
                    var element = '<tr class="myrows_sn">';
                    element += '<td width="10%" style="font-weight: bold; vertical-align: middle; text-align: center;">' + k + '</td>';
                    element += '<td width="20%"><input type="text" style="font-weight: bold; vertical-align: middle; text-align: center;" id="temp_pid" name="temp_pid" class="form-control" readonly="" value="' + pid + '"/></td>';
                    element += '<td width="70%" style="vertical-align: middle; text-align:center;"><input type="text" id="temp_sn' + k + '" name="temp_sn[]" class="form-control" required="" placeholder="Serial Number" style="text-align:center;" tabindex="' + k + '"/></td></tr>';
                    $('#table_sn').append(element);
                    k++;
                }
            } else if (ddsn === 'nsn') {
                while (k <= num) {
                    var element = '<tr class="myrows_sn">';
                    element += '<td width="10%" style="font-weight: bold; vertical-align: middle; text-align: center;">' + k + '</td>';
                    element += '<td width="20%"><input type="text" style="font-weight: bold; vertical-align: middle; text-align: center;" id="temp_pid" name="temp_pid" class="form-control" readonly="" value="' + pid + '"/></td>';
                    element += '<td width="70%" style="vertical-align: middle; text-align:center;"><input type="text" id="temp_sn' + k + '" name="temp_sn[]" class="form-control" required="" placeholder="Serial Number" style="text-align:center;" value="none" readonly=""/></td></tr>';
                    $('#table_sn').append(element);
                    k++;
                }
            }
        }
        ;
        function setbox_sn2(pid, ddsn) {
            var temp_index = 1;
            if (ddsn === 'hsn') {
                var element = '<tr class="myrows_sn2" id="row2' + temp_i2 + '">';
                element += '<td width="20%"><input type="text" style="font-weight: bold; vertical-align: middle; text-align: center;" id="temp_pid_2" name="temp_pid_2" class="form-control" readonly="" value="' + pid + '"/></td>';
                element += '<td width="70%" style="vertical-align: middle; text-align:center;"><input type="text" id="temp_sn2' + temp_i2 + '" name="temp_sn2[]" class="form-control" required="" placeholder="Serial Number" style="text-align:center;" tabindex="' + temp_index + '"/></td>';
                element += '<td width="10%" style="font-weight: bold; vertical-align: middle; text-align: center;"><button type="button" class="btn bg-red-gradient btn_remove2" value="' + temp_i2 + '"><span class="fa fa-close"></span></button></td></tr>';
                $('#table_sn_2').append(element);
                temp_i2++;
                temp_i3++;
                temp_index++;
            } else if (ddsn === 'nsn') {
                var element = '<tr class="myrows_sn2" id="row2' + temp_i2 + '">';
                element += '<td width="20%"><input type="text" style="font-weight: bold; vertical-align: middle; text-align: center;" id="temp_pid_2" name="temp_pid_2" class="form-control" readonly="" value="' + pid + '"/></td>';
                element += '<td width="70%" style="vertical-align: middle; text-align:center;"><input type="text" id="temp_sn2' + temp_i2 + '" name="temp_sn2[]" class="form-control" required="" readonly="" value="none" style="text-align:center;"/></td>';
                element += '<td width="10%" style="font-weight: bold; vertical-align: middle; text-align: center;"><button type="button" class="btn bg-red-gradient btn_remove2" value="' + temp_i2 + '"><span class="fa fa-close"></span></button></td></tr>';
                $('#table_sn_2').append(element);
                temp_i2++;
                temp_i3++;
            }
            $('#btn_addsn2').removeAttr("disabled");
        }
        ;
        function chk_imp() {
            var pid = $('#sp_id').val();
            var num = $('#input_number').val();
            var status;
            if (pid === '' || num === '') {
                status = 'not';
                return  status;
            } else if (num > 50) {
                status = 'more';
                return status;
            } else {
                status = 'ok';
                return  status;
            }
        }
        ;
        function chk_sn_modal(num) {
            var sn = [];
            var k = 1;
            var b = 1;
            while (k <= num) {
                var tempsn = $('#temp_sn' + k + '').val();
                sn.push(tempsn);
                k++;
            }
            //console.log(sn);
            var sns = sn.sort();
            var sna = [];
            for (var a = 0; a < sns.length - 1; a++) {
                if (sns[a + 1] === sns[a]) {
                    sna.push(sns[a]);
                }
            }
            //console.log(sna);
            if (sna.length > 0) {
                alert('Serial Number " ' + sna + ' " ซ้ำ');
                var status = 'not';
                return status;
            } else {
                var status = 'ok';
                while (b <= num) {
                    var tempsn = $('#temp_sn' + b + '').val();
                    all_sn.push(tempsn);
                    b++;
                }
                //console.log(all_sn);
                return status;
            }
        }
        ;
//        function chk_sn_modal(num) {
//            var sn = [];
//            var k = 1;
//            var b = 1;
//            while (k <= num) {
//                var tempsn = $('#temp_sn' + k + '').val();
//                sn.push(tempsn);
//                k++;
//            }
//            //console.log(sn);
//            var sns = sn.sort();
//            var sna = [];
//            for (var a = 0; a < sns.length - 1; a++) {
//                if (sns[a + 1] === sns[a]) {
//                    sna.push(sns[a]);
//                }
//            }
//            //console.log(sna);
//            if (sna.length > 0) {
//                alert('Serial Number " ' + sna + ' " ซ้ำ');
//                var status = 'not';
//                return status;
//            } else {
//                var status = 'ok';
//                while (b <= num) {
//                    var tempsn = $('#temp_sn' + b + '').val();
//                    all_sn.push(tempsn);
//                    b++;
//                }
//                //console.log(all_sn);
//                return status;
//            }
//        }
//        ;

        function clear_import_detail() {
            $('.myrows_unit').remove();
            $('#btn_submit').attr('disabled', true);
            //$('#dd_check_sn').val($('#dd_check_sn option:first').val());
            $("#radio_hsn").iCheck('toggle');
            $('#input_number').val("");
            $('#sp_id').val("");
            $('#datepicker').datepicker().datepicker('setDate', 'today');
            $('#ddlwar_date').val($('#ddlwar_date option:first-child').val()).trigger('change');
            //$('#dd_check_sn').removeAttr("disabled");
            $('[name=typesn]').removeAttr("disabled");
            $('#Add_Punit')[0].reset();
            i = 0;
            all_sn = [];
        }
        ;
        function resetnum() {
            var rowCount = $('#dynamic_field tr').length;
            var k = 1;
            var j = 1;
            while (k < rowCount) {
                $('#dynamic_field').find("tr").eq(k).find("td").eq(0).text(j);
                k++;
                j++;
            }
        }
        ;
        function setimp() {
            $.ajax({
                url: "ajax/import/set_imp_id.php",
                success: function (data) {
                    $('#imp_id').val(data);
                    $('#imp_id_send').val(data);
                }
            });
        }
        ;
        function chkPid(pid) {
            var spid = apid.sort();
            var state = "ok";
            for (var k = 0; k <= spid.length - 1; k++) {
                if (pid === spid[k]) {
                    state = spid[k];
                    break;
                }
            }
            return state;
        }
        ;
        function clearTemp() {
            $.ajax({
                url: "ajax/import/remove_temp_sn.php",
                success: function (data) {
                    console.log(data);
                }
            });
        }
        ;
        function load_ddlwar() {
            $.ajax({
                url: 'ajax/import/select_ddl_warranty.php',
                dataType: 'JSON',
                success: function (data) {
                    $('#ddlwar_date').empty();
                    $.each(data, function (key, val) {
                        $('#ddlwar_date').append('<option id="' + val.war + '" value="' + val.war + '">' + val.name + '</option>');
                    });
                }
            });
        }
        ;
    </script>
</body>
</html>
