<!DOCTYPE html>
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
                <h1>Welcome</h1>
                <form class="form" action="login_checker.php" method="post">
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

        <script src="bootstrap/js/index.js" type="text/javascript"></script>
    </body>

</html>

