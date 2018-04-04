<html>
    <head>
        <?php
        ?>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme Style-->
        <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Skin-->
        <link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"/>
        <!-- DataTalbe-->
        <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
        <title>Product Type</title>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="#" class="logo" style="background-color: #000000;">
                    <span class="logo-lg"><img src="../img/onelogo.png" alt="" style="width:120px; height:50px;"/></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" style="background-color: #000000;">
                    <ul class="nav navbar-nav" style="background-color: #000000;">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-info-sign"></span> เพิ่มรายการ <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a data-toggle="modal" href="#ModalGroup" class="modal-group"><span class="glyphicon glyphicon-plus"></span> เพิ่มประเภทสินค้า</a></li>
                                <li><a data-toggle="modal" href="#ModalSub"><span class="glyphicon glyphicon-plus"></span> เพิ่มประเภทสินค้าย่อย</a></li>
                                <li><a data-toggle="modal" href="#ModalBrand"><span class="glyphicon glyphicon-plus"></span> เพิ่มรายการยี่ห้อสินค้า</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="navbar-custom-menu" style="background-color: #000000;">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                    <span class="hidden-xs">Alexander Pierce</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                        <p>
                                            Alexander Pierce - Web Developer
                                            <small>Member since Nov. 2012</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                        <div class="row">
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Followers</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Sales</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Friends</a>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- =============================================== -->
            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
<!--                 sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
<!--                     sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                                <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                            </ul>
                        </li>
                        <li><a href="../../documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
                    </ul>
                </section>
                 <!--/.sidebar--> 
            </aside>
            <!-- =============================================== -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>ประเภทสินค้า</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Examples</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="panel panel-primary">
                                <div class="panel-heading"> ประเภทสินค้า </div>
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
                                                    <tr>
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
                                                    <tr>
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
                                                    <tr>
                                                        <th width="25%">รหัสยี่ห้อสินค้า</th>
                                                        <th width="45%">ชื่อยี่ห้อสินค้า</th>
                                                        <th width="30%"></th>
                                                    </tr>
                                                </thead>
                                            </table>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.3.8
                </div>
                <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
                reserved.
            </footer>
            <div class="control-sidebar-bg"></div>
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
        <!-- Bootstrap 3.3.6 -->
        <!--<script src="../plugins/jQuery/jquery-2.2.3.min.js" type="text/javascript"></script>-->
        <script src="../plugins/jQuery/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../plugins/fastclick/fastclick.js" type="text/javascript"></script>
        <script src="../dist/js/app.js" type="text/javascript"></script>
        <script src="../dist/js/demo.js" type="text/javascript"></script>
        <script src="../plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="../plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <script>
            var tableGroup;
            var tableBrand;
            var tableSub;
            $(function () {
                tableGroup = $("#table-group").DataTable({
                    "ajax": "ajax/Product/select_group.php",
                    "paging": true,
                    "lengthChange": false,
                    "iDisplayLength": 30,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "columnDefs": [
                        {"targets": 2, "orderable": false, "searchable": false}
                    ],
                });
//                $('.modal-group').on('click',function(){||});
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
//                $(document).on('submit', '#form-addGroup', function (event) {
//                    event.preventDefault();
//                    var data = $(this).serializeArray();
//                    $.ajax({
//                        url: 'ajax/Product/insert_update_type.php',
//                        type: 'post',
//                        dataType: 'html',
//                        data: data,
//                        success: function () {
//                            //alert(ds);
//                            tableBrand.ajax.reload(null, false);
//                            $('#ModalGroup')[0].reset();
//                            $('#ModalGroup').modal('hide');
//                        }
//                    });
//                });


                tableSub = $("#table-subgroup").DataTable({
                    "ajax": "ajax/Product/select_subgroup.php",
                    "paging": true,
                    "lengthChange": false,
                    "iDisplayLength": 30,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "columnDefs": [
                        {"targets": 3, "orderable": false, "searchable": false}
                    ],
                });

                tableBrand = $("#table-brand").DataTable({
                    "ajax": "ajax/Product/select_brand.php",
                    "paging": true,
                    "lengthChange": false,
                    "iDisplayLength": 30,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "columnDefs": [
                        {"targets": 2, "orderable": false, "searchable": false}
                    ],
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


