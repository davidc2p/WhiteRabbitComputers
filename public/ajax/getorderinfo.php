<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");

require_once '../class/orderinfo.class.php';

// array for JSON response
$response = array();
$ret = array();	

// include db config class
require_once '../db/db_config.php';
require_once '../db/db_connect.php';
$dbh = new DB_CONNECT($dev=1);
$connection = $dbh->getDb();

$orderinfo = new OrderInfo($connection);


//orderinfoid
if (isset($_GET['orderinfoid']))
{
	$orderinfo->orderinfoid = filter_var($_GET['orderinfoid'], FILTER_SANITIZE_NUMBER_INT);	

	$ret = $orderinfo->getOrderInfo();

	if (isset($ret['success']) && $ret['success'] != 0) {
		$response["success"] = $ret['success'];
		$response["message"] = $ret["message"];
	} 
}
else
{
	// Error registered
	$response["success"] = 1;
	$response["message"] = "An error has occurred while fetching order infos.";
}
$result = array(); 
if (!empty($ret))
	$result = $ret;
else
	$result = $response;

print json_encode($result);
?>