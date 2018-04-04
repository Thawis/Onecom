<?php

if ($_SESSION['login_type'] == 'user') {
    header("location:Index.php");
}
?>