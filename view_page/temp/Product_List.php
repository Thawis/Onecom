<?php
include '../lib/connect.php';
session_start();
if (empty($_GET['sub'])) {
    $Sub = 'null';
} else
    $Sub = $_GET['sub'];

if ($_SESSION['login_type'] == "user") {
    session_destroy();
    header("location: ../index.php");
} else if (!isset($_SESSION['login_id']) && empty($_SESSION['login_id'])) {
    header("location: ../index.php");
} else {
    $id = $_SESSION['login_id'];
    $sql = 'SELECT * FROM t_employee';
    $stmt = $dbh->prepare($sql);
    try {
        $stmt->execute();
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
    $rows = $stmt->fetch();
    $Ename = $rows['Emp_Name'];
    $Eid = $rows['Emp_ID'];
    $ImgName = $rows['Emp_Img'];
}
?>



<html>
    <head>
        <?php include '../lib/connect.php'; ?>
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
        <title>Product List</title>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="#" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>ONE</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>OneComputer</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-info-sign"></span> เพิ่มรายการ <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a data-toggle="modal" href="#ModalProduct" class="modal-group"><span class="glyphicon glyphicon-plus"></span>รายการสินค้า</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            <li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-success">4</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 4 messages</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li><!-- start message -->
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Support Team
                                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <!-- end message -->
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">See All Messages</a></li>
                                </ul>
                            </li>
                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning">10</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 10 notifications</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">View all</a></li>
                                </ul>
                            </li>
                            <!-- Tasks: style can be found in dropdown.less -->
                            <li class="dropdown tasks-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-flag-o"></i>
                                    <span class="label label-danger">9</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 9 tasks</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li><!-- Task item -->
                                                <a href="#">
                                                    <h3>
                                                        Design some buttons
                                                        <small class="pull-right">20%</small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">20% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- end task item -->
                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <a href="#">View all tasks</a>
                                    </li>
                                </ul>
                            </li>
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
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <?php
                    $sql = 'SELECT * FROM t_group_product';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();
                    ?>
                    <input type="hidden" id="Subgroup" name="Subgroup" value="<?= $Sub; ?>">
                    <ul class="sidebar-menu">
                        <li class="header">ProductList</li>
                        <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                            <li class="treeview"><a href="#"><i class="fa"></i> <?php echo $result['G_Name']; ?></a>
                                <?php
                                $group = $result['G_ID'];
                                $sql2 = 'SELECT * FROM t_sub_group_product WHERE G_ID ="' . $group . '"';
                                $stmt2 = $dbh->prepare($sql2);
                                $stmt2->execute();
                                while ($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <ul class="treeview-menu show">  
                                        <li><a href="Product_List.php?sub=<?= $result2['SG_ID']; ?>"><i class="fa fa-minus"></i><?php echo $result2['SG_Name']; ?></a></li>
                                    </ul>
                                <?php } $stmt2 = null; ?>
                            </li>
                            <?php
                        }
                        $dbh = null;
                        $stmt = null;
                        ?>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            <!-- =============================================== -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>All Product</h1>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">ProductList</h3>
                                </div>
                                <div class="box-body">
                                    <table id="table-product" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5%">รหัสสินค้า</th>
                                                <th width="20%">ชื่อสินค้า</th>
                                                <th width="10%">ยี่ห้อ</th>
                                                <th width="10%">ราคาสินค้า</th>
                                                <th width="25%">รายละเอียด</th>
                                                <th width="25%"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div><!-- /.content-wrapper -->

            <footer class="main-footer">
            </footer>
            <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <div class="modal fade" id="ModalProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" id="form-addProduct">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">เพิ่มรายการสินค้า</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">รหัสสินค้า</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="Product_Id" name="Product_Id" placeholder="" required="" value="" readonly> <!--disabled=""-->
                                        </div>
                                        <label for="" class="col-sm-4 control-label"></label>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">ประเภทสินค้าหลัก</label>
                                        <div class="col-sm-5">
                                            <div class="form-group" style="margin-left:1px;">
                                                <select class="form-control" id="DDgroup" name="DDgroup">
                                                </select>
                                            </div>
                                        </div>
                                        <label for="" class="col-sm-3 control-label"></label>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">ประเภทสินค้ารอง</label>
                                        <div class="col-sm-5">
                                            <div class="form-group" style="margin-left:1px;">
                                                <select class="form-control" id="DDsub" name="DDsub">
                                                </select>
                                            </div>
                                        </div>
                                        <label for="" class="col-sm-3 control-label"></label>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">ยี่ห้อ</label>
                                        <div class="col-sm-5">
                                            <div class="form-group" style="margin-left:1px;">
                                                <select class="form-control" id="DDbrand" name="DDbrand">
                                                </select>
                                            </div>
                                        </div>
                                        <label for="" class="col-sm-3 control-label"></label>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">ชื่อสินค้า</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="P_Name" name="P_Name" placeholder="" required="" value=""> <!--disabled=""-->
                                        </div>
                                        <label for="" class="col-sm-2 control-label"></label>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">ราคาสินค้า</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="P_Price" name="P_Price" placeholder="" required="" value=""> <!--disabled=""-->
                                        </div>
                                        <label for="" class="col-sm-4 control-label"></label>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">รายละเอียด</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" id="P_Detail" name="P_Detail" rows="3" placeholder="รายละเอียดสินค้า...." required=""></textarea>
                                        </div>
                                        <label for="" class="col-sm-2 control-label"></label>                                        
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
            var datatable;
            $(function () {
                var id = $('#Subgroup').val();
                if (id == 'null') {
                    loadAll();
                } else {
                    loadData(id);
                }

                $('#ModalProduct').on('shown.bs.modal', function () {
                    var type = "Product";
                    //$('#Group_Name').val("");
                    $.ajax({
                        url: "ajax/Product/select_idtype.php",
                        type: "get",
                        async: true,
                        data: {type: type},
                        success: function (data) {
                            $('#Product_Id').val(data);
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


                    $.ajax({
                        url: 'ajax/Product/select_brand_dropdown.php',
                        dataType: 'JSON',
                        success: function (data) {
                            $.each(data, function (key, val) {
                                $('#DDbrand').append('<option id="' + val.id + '" value="' + val.id + '">' + val.name + '</option>');
                            })
                        }
                    });
                });

                $('#DDgroup').change(function () {
                    var type = "";
                    $("#DDgroup option:selected").each(function () {
                        type += $(this).val() + " ";
                        loadSub(type);
                    });
                });

                $('#form-addProduct').on('submit', function () {
                    var data = $('#form-addProduct').serialize();
                    $.ajax({
                        url: 'ajax/Product/insert_product.php',
                        type: 'post',
                        data: data,
                        success: function () {
                            tableBrand.ajax.reload(null, false);
                            $('#ModalProduct')[0].reset();
                            $('#ModalProduct').modal('hide');
                            loadAll();
                        }
                    });
                });

            });



            function loadData(id) {
                datatable = $('#table-product').DataTable({
                    ajax: {
                        url: "ajax/Product/select_sg_product.php",
                        type: "get",
                        data: {id: id}
                    },
                    "paging": true,
                    "lengthChange": false,
                    "iDisplayLength": 30,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "columnDefs": [
                        {"targets": 5, "orderable": false, "searchable": false}
                    ],
                });
            }
            function loadAll() {
                datatable = $("#table-product").DataTable({
                    "ajax": "ajax/Product/select_all_product.php",
                    "paging": true,
                    "lengthChange": false,
                    "iDisplayLength": 30,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "columnDefs": [
                        {"targets": 5, "orderable": false, "searchable": false}
                    ],
                });
            }

            function loadSub(type) {
                $('#DDsub').empty();
                $.ajax({
                    url: 'ajax/Product/select_type_dropdown.php',
                    type: "get",
                    data: {type: type},
                    dataType: 'JSON',
                    success: function (data) {

                        $.each(data, function (key, val) {
                            $('#DDsub').append('<option id="' + val.id + '" value="' + val.id + '">' + val.name + '</option>');
                        });
                    }
                });
            }

        </script>

    </body>
</html>
