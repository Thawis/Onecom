<?php
$dsn = 'mysql:host=localhost;dbname=onecomputer';
//$dsn = 'mysql:host=localhost;dbname=onecomputer3';
$username = 'root';
$password = '';
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8',);

try{
$dbh = new PDO($dsn,$username,$password,$options); 
} catch (Exception $ex) {
    echo $ex->getMessage();    
}
?>