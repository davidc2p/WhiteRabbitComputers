<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");

require_once '../class/computer.class.php';

// array for JSON response
$response = array();
$ret = array();	

// include db config class
require_once '../db/db_config.php';
require_once '../db/db_connect.php';
$dbh = new DB_CONNECT($dev=1);
$connection = $dbh->getDb();

$computer = new Computer($connection);


//computerid
if (isset($_GET['computerid']))
{
	$computer->computerid = filter_var($_GET['computerid'], FILTER_SANITIZE_NUMBER_INT);	

	$ret = $computer->getComputerDetails();

	if (isset($ret['success']) && $ret['success'] != 0) {
		$response["success"] = $ret['success'];
		$response["message"] = $ret["message"];
	} 
}
else
{
	// Error registered
	$response["success"] = 1;
	$response["message"] = "An error has occurred while fetching computer details.";
}
$result = array(); 
if (!empty($ret))
	$result = $ret;
else
	$result = $response;

print json_encode($result);
?>