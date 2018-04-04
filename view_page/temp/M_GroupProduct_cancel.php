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
        <title>การจัดการประเภทสินค้า - ยี่ห้อ</title>
        <style>
            #table-group td{
                vertical-align: middle;
            }
            #table-group tr:nth-child(even){
                background-color: #dddddd;
            }
        </style>

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="Index.php" class="logo" style="background-color: #000000;"><span class="logo-lg"><img src="../img/onelogo.png" alt="" style="width:120px; height:50px;"/></span></a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" style="background-color: #000000;">
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">                            
                            <li class="dropdown user user-menu">                   
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="hidden-xs"> Welcome :  </span>
                                    <span class="hidden-xs"><?php echo $Eid; ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">      
                        <div class="user-panel">
                            <div class="pull-left image">
                                <img src="../img/employee/<?php echo $ImgName; ?>" class="img-circle" alt="User Image">
                            </div>
                            <div class="pull-left info">
                                <p><?php echo $Ename ?></p>
                                <i class="fa fa-circle text-success"></i> Online<br>   
                                <a href="#"><i class="fa fa-user" style='margin-top: 5px;'></i> User Profile</a>
                            </div>
                        </div>

                        <?php include '../lib/sidemenu.php'; ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            <!-- =============================================== -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <!-- Main content -->
                <section class="content-header">
                    <h1>
                        Management Product Type & Brand
                        <small>การจัดการประเภทสินค้า & ยี่ห้อ</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">การจัดการประเภทสินค้า - ยี่ห้อ</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">        
                                    <!--Data Table -->
                                    <div class="content">
                                        <!--<div class="panel panel-primary">-->
                                        <!--<div class="panel-heading"></div>-->
                                        <div class="col-md-12">
                                            <form class="navbar-form navbar-right">
                                                <button type="button" class="btn bg-green-active" data-toggle="modal" data-target="#ModalGroup" ><span style="margin-bottom: 3px;"><span class="fa fa-user-plus"></span> เพิ่มข้อมูลประเภทสินค้า</span></button>                                                         
                                                <button type="button" class="btn bg-red-active" data-toggle="modal" data-target="#ModalSub" ><span style="margin-bottom: 3px;"><span class="fa fa-user-plus"></span> เพิ่มข้อมูลประเภทสินค้าย่อย</span></button> 
                                                <button type="button" class="btn bg-yellow-active" data-toggle="modal" data-target="#ModalBrand" ><span style="margin-bottom: 3px;"><span class="fa fa-user-plus"></span> เพิ่มข้อยี่ห้อสินค้า</span></button> 
                                            </form>
                                        </div>
                                        <div class="panel-body">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="active"><a href="#t_type" data-toggle="tab"><i class="glyphicon glyphicon-king"></i> ประเภทสินค้า</a></li>
                                                <li><a href="#t_stype"  data-toggle="tab"><i class="glyphicon glyphicon-queen"></i> ประเภทสินค้าย่อย</a></li>
                                                <li><a href="#t_brand"  data-toggle="tab"><i class="glyphicon glyphicon-comment"></i> ยี่ห้อสินค้า</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="t_type" class="tab-pane in active">
                                                    <table id="table-group" class="table table-bordered table-hover table-responsive" >
                                                        <thead>
                                                            <tr class="bg-teal-active color-palette" style="color: white;">
                                                                <th width="25%">รหัสประเภทสินค้า</th>
                                                                <th width="45%">ชื่อประเภทสินค้า</th>
                                                                <th width="30%"></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div id="t_stype" class="tab-pane">
                                                    <table id="table-subgroup" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr class="bg-teal-active color-palette" style="color: white;">
                                                                <th width="20%">รหัสประเภทสินค้าย่อย</th>
                                                                <th width="25%">ชื่อประเภทสินค้าย่อย</th>
                                                                <th width="25%">ประเภทสินค้าหลัก</th>
                                                                <th width="30%"></th>
                                                            </tr>
                                                        </thead>
                                                    </table>  
                                                </div>
                                                <div id="t_brand" class="tab-pane">
                                                    <table id="table-brand" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr class="bg-teal-active color-palette" style="color: white;">
                                                                <th width="25%">รหัสยี่ห้อสินค้า</th>
                                                                <th width="45%">ชื่อยี่ห้อสินค้า</th>
                                                                <th width="30%"></th>
                                                            </tr>
                                                        </thead>
                                                    </table>  
                                                </div>
                                            </div>
                                        </div>
                                        <!--</div>-->                                 
                                    </div>
                                </div><!-- /.container-fluid -->
                            </div>
                        </div>
                    </div>
                </section>
                <center><div class="btn-group">
                        <button type="button" class="btn bg-aqua-active color-palette btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-chevron-circle-down"></span>  จัดการข้อมูลประเภทสินค้า </button>
                        <ul id="listgroup" class="dropdown-menu">
                            <li><a href="#"><span class="fa fa-desktop"></span> รายละเอียดประเภทสินค้า</a></li>
                            <li><a href="#"><span class="fa fa-gear"></span> แก้ไขข้อมูลประเภทสินค้า</a></li>
                            <li><a href="#"><span class="fa fa-close"></span> ยกเลิกประเภทสินค้า</a></li>
                        </ul>
                    </div></center>
            </div> 
            <!-- /.content -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0
                </div>
                <strong>OneComputer Shop</strong>
            </footer>
        </div>
        <!--Modal Group-->
        <div class="modal fade" id="ModalGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" id="form-addGroup">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">เพิ่มประเภทสินค้า</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">รหัสประเภทสินค้า</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="Group_Id" name="Group_Id" placeholder="" required="" readonly> <!--disabled=""-->
                                        </div>
                                        <label for="" class="col-sm-5 control-label"></label>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">ชื่อประเภทสินค้า</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="Group_Name" name="Group_Name" placeholder="" required="">
                                        </div>
                                        <label for="" class="col-sm-1 control-label"></label>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="action" name="action" value="" >
                            <button type="submit" class="btn btn-success">บันทึก</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Modal Sub Group-->
        <div class="modal fade" id="ModalSub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" id="form-Sub">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">เพิ่มประเภทสินค้าย่อย</h4>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">รหัสประเภทสินค้าย่อย</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="Sub_Id" name="Sub_Id" placeholder="" required="" value="" readonly> <!--disabled=""-->
                                        </div>
                                        <label for="" class="col-sm-4 control-label"></label>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">ประเภทสินค้าหลัก</label>
                                        <div class="col-sm-5">
                                            <!--<input type="text" class="form-control" id="Sub_Name" name="Sub_Name" placeholder="" required="">-->
                                            <div class="form-group" style="margin-left:1px;">
                                                <select class="form-control" id="DDgroup" name="DDgroup">
                                                </select>
                                            </div>
                                        </div>
                                        <label for="" class="col-sm-3 control-label"></label>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">ชื่อประเภทสินค้าย่อย</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="Sub_Name" name="Sub_Name" placeholder="" required="" value=""> <!--disabled=""-->
                                        </div>
                                        <label for="" class="col-sm-4 control-label"></label>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="action" name="action" value="" >
                            <button type="submit" class="btn btn-success">บันทึก</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Modal Brand-->
        <div class="modal fade" id="ModalBrand" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" id="form-addBrand">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">เพิ่มยี่ห้อสินค้า</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">รหัสยี่ห้อสินค้า</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="Brand_Id" name="Brand_Id" placeholder="" required="" value="" readonly> <!--disabled=""-->
                                        </div>
                                        <label for="" class="col-sm-5 control-label"></label>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">ชื่อยี่ห้อสินค้า</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="Brand_Name" name="Brand_Name" placeholder="" required="">
                                        </div>
                                        <label for="" class="col-sm-1 control-label"></label>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="action" name="action" value="" >
                            <button type="submit" class="btn btn-success">บันทึก</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Modal Group Edit-->
        <div class="modal fade" id="ModalGroup-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" id="form-addGroup-">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">เพิ่มประเภทสินค้า</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">รหัสประเภทสินค้า</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="Group_Id-edit" name="Group_Id" placeholder="" required="" readonly> <!--disabled=""-->
                                        </div>
                                        <label for="" class="col-sm-5 control-label"></label>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">ชื่อประเภทสินค้า</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="Group_Name-edit" name="Group_Name" placeholder="" required="">
                                        </div>
                                        <label for="" class="col-sm-1 control-label"></label>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="action" name="action" value="" >
                            <button type="submit" class="btn btn-success">บันทึก</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>                   
                        </div>
                    </form>
                </div>
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
    <script>
        var tableGroup;
        var tableBrand;
        var tableSub;
        var editid;
        $(function () {
            $(document).on('click', '#listgroup li', function () {
                var id = event.target.id;
                editid = id;
                //alert(event.target.id);
                alert(editid);
            });

            tableGroup = $("#table-group").DataTable({
                "ajax": "ajax/Product/select_group.php",
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 20,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": false,
            });
//              --Add Group--
            $('#form-addGroup').on('submit', function () {
                var data = $('#form-addGroup').serialize();
                $.ajax({
                    url: 'ajax/Product/insert_update_type.php',
                    type: 'post',
                    data: data,
                    success: function () {
                        tableGroup.ajax.reload(null, false);
                        $('#ModalGroup')[0].reset();
                        $('#ModalGroup').modal('hide');
                    }
                });
            });
//              --Add Sub--                
            $('#form-Sub').on('submit', function () {
                var data = $('#form-Sub').serialize();
                $.ajax({
                    url: 'ajax/Product/insert_update_subtype.php',
                    type: 'post',
                    data: data,
                    success: function () {
                        tableSub.ajax.reload(null, false);
                        $('#ModalSub')[0].reset();
                        $('#ModalSub').modal('hide');
                    }
                });
            });
//              -- Add Brand --
            $('#form-addBrand').on('submit', function () {
                var data = $('#form-addBrand').serialize();
                $.ajax({
                    url: 'ajax/Product/insert_update_brand.php',
                    type: 'post',
                    data: data,
                    success: function () {
                        tableBrand.ajax.reload(null, false);
                        $('#ModalBrand')[0].reset();
                        $('#ModalBrand').modal('hide');
                    }
                });
            });

            tableSub = $("#table-subgroup").DataTable({
                "ajax": "ajax/Product/select_subgroup.php",
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": false,
            });

            tableBrand = $("#table-brand").DataTable({
                "ajax": "ajax/Product/select_brand.php",
                "paging": true,
                "lengthChange": false,
                "iDisplayLength": 30,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": false,
            });

            $('#ModalGroup').on('shown.bs.modal', function () {
                var type = "Group";
                //$('#Group_Name').val("");
                $.ajax({
                    url: "ajax/Product/select_idtype.php",
                    type: "get",
                    async: true,
                    data: {type: type},
                    success: function (data) {
                        $('#Group_Id').val(data);
                    }
                });
            });

            $('#ModalSub').on('shown.bs.modal', function () {
                var type = "Sub";
                $.ajax({
                    url: "ajax/Product/select_idtype.php",
                    type: "get",
                    async: true,
                    data: {type: type},
                    success: function (data) {
                        $('#Sub_Id').val(data);
                    }
                });
                $.ajax({
                    url: 'ajax/Product/select_type_dropdown.php',
                    dataType: 'JSON',
                    success: function (data) {
                        $.each(data, function (key, val) {
                            $('#DDgroup').append('<option id="' + val.id + '" value="' + val.id + '">' + val.name + '</option>');
                        })
                    }
                });
            });

            $('#ModalBrand').on('shown.bs.modal', function () {
                var type = "Brand";
                //$('#Brand_Name').val("");
                $.ajax({
                    url: "ajax/Product/select_idtype.php",
                    type: "get",
                    async: true,
                    data: {type: type},
                    success: function (data) {
                        $('#Brand_Id').val(data);
                    }
                });
            });
        });
    </script>
</body>
</html>
