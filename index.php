<!DOCTYPE html>
<?php
session_start();
if (!empty($_SESSION['login_id']) && !empty($_SESSION['login_type'])) {
    //header("location: view_page/M_Logout.php");
    header("location: view_page/index.php");
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Welcome</title>
        <link href="bootstrap/css/index.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <h1>One Computer</h1>
                <!--<form class="form" action="login_checker.php" method="post">-->
                <form class="form" id="form_login">
                    <input type="text" placeholder="Username" id="username" name="username" required="">
                    <input type="password" placeholder="Password" id="password" name="password" required="">
                    <button type="submit" id="login-button">Login</button>
                </form>
            </div>
            <ul class="bg-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <script src="plugins/jQuery/jquery-3.1.1.min.js" type="text/javascript"></script>
        <!--<script src="bootstrap/js/index.js" type="text/javascript"></script>-->
        <script>
            $(function () {
                $('#form_login').on('submit', function (e) {
                    e.preventDefault();
                    var data = $('#form_login').serialize();
                    $.ajax({
                        url: "login_check_2.php",
                        type: "post",
                        data: data,
                        success: function (data) {
                            if (data === "ok") {
//                                $('form').fadeOut(500);
//                                $('.wrapper').addClass('form-success');
                                alert('ยินดีต้อนรับเข้าสู่ระบบ');
                                window.location.replace("view_page/Index.php");
                            } else {
                                alert('ไม่สามารถเข้าสู่ระบบได้');
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>

