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
        <title>Welcome To OneComputer</title>
    </head>
    <?php
    include '../lib/header_navbar.php';
    include '../lib/main_sidebar.php';
    ?>
    <div class="content-wrapper">
        <section class="content" style="height:1600px;">
            <div class="row">
                <div class="col-md-12">
                    <!--                    <div class="panel">
                                            <div class="box box-default">
                                                <div class="panel-body">        
                                                    <div class="content">
                                                        <div class="box-body">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->
                    <table class="table table-hover no-border" id="tableDetail">
                        <tr>
                            <td>
                                <h1 style="font-family: tahoma;"> ยินดีต้อนรับสู่ระบบจัดการร้าน OneComputer  </h1>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">
                                <img src="../img/onelogo.png" alt="" style="width:750px; height:380px;"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 24px; font-family: Tahoma; color: red; text-align: center;">
                                <span class="fa fa-warning"></span> หาก ระบบมีปัญหากรุณาติดต่อเจ้าหัวหน้าช่าง หรือเจ้าของร้าน
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>OneComputer Shop</strong>
    </footer>
    <!-- Bootstrap 3.3.6 -->
    <script src="../plugins/jQuery/jquery-3.1.1.min.js" type="text/javascript"></script>
    <!--<script src="../plugins/jQuery/jquery-2.2.3.min.js" type="text/javascript"></script>-->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!--<script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>-->
    <script src="../plugins/fastclick/fastclick.js" type="text/javascript"></script>
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    <script src="../dist/js/demo.js" type="text/javascript"></script>
    <script>
        $(function () {
            //alert('ยินดีต้อนรับเข้าสู่ระบบจัดการร้าน OneComputer ');
        });
    </script>
</body>
</html>
