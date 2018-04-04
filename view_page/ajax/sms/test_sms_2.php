<?php
require_once('function.php');
//$date1 = date("Ymd:Hi");
//$tz = 'Europe/London';
//$timestamp = time();
//$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
//$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
//echo $dt->format('d.m.Y, H:i:s');
$dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); 
$today = $dt->format("Ymd:Hi");
//echo $today;

$url = "http://www.sbuysms.com/api.php";
$username = 'varis209';
$password = 'thaweethong';
$msisdn = '0846776905';
$message = 'HI BOOM';
$sender = 'SBUYSMS';
$ScheduledDelivery = '20170818:1949';

//$param = "command=send&username=$username&password=$password&msisdn=$msisdn&message=$message&sender=$sender&ScheduledDelivery=$ScheduledDelivery";
$param = "command=balance&username=$username&password=$password";
$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
$result = curl_exec ($ch);
curl_close ($ch);

$xml = xml($result);
//$count = count($xml['SBUYSMS']['QUEUE']);
//if($count > 0){
//	$count_pass = 0;
//	$count_fail = 0;
//	$used_credit = 0;
//	for($i=0;$i<$count;$i++){
//		if($xml['SBUYSMS']['QUEUE'][$i]['Status'] == 1){
//            //$Transaction = $xml['SBUYSMS']['QUEUE'][$i]['Transaction'];
//            //$Msisdn = $xml['SBUYSMS']['QUEUE'][$i]['Msisdn'];
//            //$UsedCredit = $xml['SBUYSMS']['QUEUE'][$i]['UsedCredit'];
//            //$used_credit += $UsedCredit;
//			$count_pass++;
//        }else{
//			$count_fail++;
//		}
//	}
//
//	if($count_pass > 0){
//        echo "สามารถส่งออกได้จำนวน $count_pass หมายเลข, ใช้เครดิตทั้งหมด $used_credit เครดิต";
//    }
//	if($count_fail > 0){
//        echo "ไม่สามารถส่งออกได้จำนวน $count_fail หมายเลข";
//    }
//}else{
//    echo $xml['SBUYSMS']['Detail'];
//}
$credit = $xml['SBUYSMS']['Credit'];
$exp = $xml['SBUYSMS']['Expire'];
$status = $xml['SBUYSMS']['Status'];
echo 'เครดิตคงเหลือ : '.$credit.' วันหมดอายุ : '.$exp.'สถานะ : '.$status;

//http://www.sbuysms.com/api.php?command=send&username=varis209&password=thaweethong&msisdn=0846776905&message=%E0%B8%97%E0%B8%94%E0%B8%AA%E0%B8%AD%E0%B8%9A%E0%B8%88%E0%B9%89%E0%B8%B2&sender=SBUYSMS&ScheduledDelivery=20170818:2000
?>