<?php
$addrCollect = $_POST ['addrCollect'];
$latlngCollect = $_POST['latlngCollect'];
$addrDest = $_POST ['addrDest'];
$latlngDest = $_POST ['latlngDest'];
$dateCollect = $_POST ['dateCollect'];
$timeCollect = $_POST ['timeCollect'];
$dateReturn = $_POST ['dateReturn'];
$timeReturn = $_POST ['timeReturn'];
$psnNumber = $_POST ['psnNumber'];
$busType = $_POST ['busType'];
$jourType = $_POST ['jourType'];
$contactName = $_POST ['contactName'];
$contactEmail = $_POST ['contactEmail'];
$mobileNumber = $_POST ['mobileNumber'];
$companyName = $_POST ['companyName'];
$notes = $_POST ['notes'];
$jourType = $_POST ['jourType'];
$ways = $_POST ['ways'];
$extrapoints = $_POST['extrapoint'];
$extralatlng = $_POST['extraLatlng'];
$km = $_POST['km'];
$hr = $_POST['hr'];

require_once '../lib/db/Database.class.php';

$db = new Database ();
$args = array (
		'date_collect' => date ( 'Y-m-d', strtotime ( $dateCollect ) ),
		'time_collect' => date ( 'Y-m-d H:i', strtotime ( $timeCollect ) ),
		'date_return' => date ( 'Y-m-d', strtotime ( $dateReturn ) ),
		'time_return' => date ( 'Y-m-d H:i', strtotime ( $timeReturn ) ),
		'psn_number' => trim($psnNumber),
		'bus_type' => $busType,
		'journey_type' => $jourType,
		'contact_name' => trim($contactName),
		'contact_email' => trim($contactEmail),
		'mobile_number' => trim($mobileNumber),
		'company_name' => trim($companyName),
		'notes' => trim($notes),
		'ways' => $ways,
		'order_status' => 0,
		'order_time' => date ( 'Y-m-d H:i:s', time () ),
		'kilometers'=>$km,
		'total_time'=>$hr
);
//insert order
$db->insertByMark ( "t_order", $args );
$orderId = $db->lastId();
$directions = array();
$directions[] = array('order_id'=>$orderId,'latlng'=>$latlngCollect,'address'=>$addrCollect,'type'=>0,'order'=>1);
$index = 0;
for (; $index<count($extrapoints);$index++){
	if(empty($extralatlng[$index])){
		continue;
	}
	$directions[] = array('order_id'=>$orderId,'latlng'=>$extralatlng[$index],'address'=>$extrapoints[$index],'type'=>1,'order'=>($index+2));
}
$directions[] = array('order_id'=>$orderId,'latlng'=>$latlngDest,'address'=>$addrDest,'type'=>2,'order'=>($index+2));
//insert direction points
foreach ($directions as $direct){
	$db->insertByMark('t_directions', $direct);
}

echo "Order success. we will send quotation to you by email.";
notifyClient ( $args );
notifyCompany ( $args );

function notifyClient($args) {
	require_once './Email.php';
	$email = new Email ();
	$toname = $args ['contact_name'];
	$fromname = 'XXXX';
	$from = 'xxx@xxx.com.au';
	$to = $args ['contact_email'];
	$sent = $email->to ( $to, $toname )->from ( $from, $fromname )->subject ( 'xxxxxxxxx' )->message ( 'xxxxxxxxxxxxxxxxx.' )->send ();
	if(!$sent){
		echo $email->error();
	}
}
function notifyCompany($args) {
	require_once './Email.php';
	$email = new Email ();
	$name = 'XXX';
	$addr = 'xxx@xxx.com.au';
	session_start ();
	$_SESSION ['orderinfo'] = $args;
	$sent = $email->to ( $addr, $name )->from ( $addr, $name )->subject ( 'xxxxxxxx.' )->message ( function () {
		return file_get_contents ( '../companymessage.php' );
	} )->send ();
	if(!$sent){
		echo $email->error();
	}
}

?>
