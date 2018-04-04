<?php
session_start();
echo $_POST['uid'];
$_SESSION['unit_id_print'] = $_POST['uid'];
?>