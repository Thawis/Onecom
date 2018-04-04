<?php

require_once('function.php');

$url = "http://www.sbuysms.com/api.php";
//varis1994

$username = 'varis209';
$password = 'thaweethong';
$msisdn = $_POST['tel'];
$message = $_POST['mess'];
$sender = 'SBUYSMS';
$ScheduledDelivery = '';
$param = "command=send&username=$username&password=$password&msisdn=$msisdn&message=$message&sender=$sender&ScheduledDelivery=$ScheduledDelivery";
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
$count = count($xml['SBUYSMS']['QUEUE']);
if ($count > 0) {
    $count_pass = 0;
    $count_fail = 0;
    $used_credit = 0;
    for ($i = 0; $i < $count; $i++) {
        if ($xml['SBUYSMS']['QUEUE'][$i]['Status'] == 1) {
            //$Transaction = $xml['SBUYSMS']['QUEUE'][$i]['Transaction'];
            //$Msisdn = $xml['SBUYSMS']['QUEUE'][$i]['Msisdn'];
            //$UsedCredit = $xml['SBUYSMS']['QUEUE'][$i]['UsedCredit'];
            //$used_credit += $UsedCredit;
            $count_pass++;
        } else {
            $count_fail++;
        }
    }
    if ($count_pass > 0) {
        echo 'ok';
    }
    if ($count_fail > 0) {
        echo 'not';
        //echo "ไม่สามารถส่งออกได้จำนวน $count_fail หมายเลข";
    }
} else {
    echo $xml['SBUYSMS']['Detail'];
}

//$credit = $xml['SBUYSMS']['Credit'];
//$exp = $xml['SBUYSMS']['Expire'];
//$status = $xml['SBUYSMS']['Status'];
//echo 'เครดิตคงเหลือ : '.$credit.' วันหมดอายุ : '.$exp.'สถานะ : '.$status;




function get_smstime() {
    $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
    $today = $dt->format("Ymd:Hi");
    $today_test = $dt->format("Ymd");
    $today_1 = $dt->format("Ymd:");
    $today_2 = $dt->format("Ymd:H");
    $day_send = '';
    $h = substr($today, 9, 2);
    $m = substr($today, 11, 2);
    $hi = (int) $h;
    $mi = (int) $m;
    if ($mi <= 5) {
        $day_send = $today_2 . '05';
    } else if ($mi <= 10) {
        $day_send = $today_2 . '10';
    } else if ($mi <= 15) {
        $day_send = $today_2 . '15';
    } else if ($mi <= 20) {
        $day_send = $today_2 . '20';
    } else if ($mi <= 25) {
        $day_send = $today_2 . '25';
    } else if ($mi <= 30) {
        $day_send = $today_2 . '30';
    } else if ($mi <= 35) {
        $day_send = $today_2 . '35';
    } else if ($mi <= 40) {
        $day_send = $today_2 . '40';
    } else if ($mi <= 45) {
        $day_send = $today_2 . '45';
    } else if ($mi <= 50) {
        $day_send = $today_2 . '50';
    } else if ($mi <= 55) {
        $day_send = $today_2 . '55';
    } else if ($mi <= 60) {
        if ($hi < 23) {
            $h2 = $hi + 1;
            $day_send = $today_1 . $h2 . '00';
        } else if ($hi == 23) {
            $End_War = date('Ymd', strtotime($today_test . " +1 days"));
            $day_send = $End_War . ':0100';
        }
    }
    return $day_send;
}

?>