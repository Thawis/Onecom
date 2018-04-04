<?php

require_once('function.php');
$url = "http://www.sbuysms.com/api.php";
$username = 'varis209';
$password = 'thaweethong';
$param = "command=balance&username=$username&password=$password";
$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
$result = curl_exec($ch);
curl_close($ch);
$xml = xml($result);

$credit = $xml['SBUYSMS']['Credit'];
//$exp = $xml['SBUYSMS']['Expire'];
$status = $xml['SBUYSMS']['Status'];

if($status == 1 && $credit >= 5){
    echo 'ok';
}

//echo 'เครดิตคงเหลือ : '.$credit.' วันหมดอายุ : '.$exp.'สถานะ : '.$status;



?>