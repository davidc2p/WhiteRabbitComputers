<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");

// array for JSON response
$response = array();

//Access_token
if (isset($_GET['access_token']) && isset($_SESSION['access_token']))
{
	$_SESSION['access_token'] = filter_var($_GET['access_token'], FILTER_SANITIZE_STRING);

  // information registered
	$response["success"] = 0;
	$response["message"] = "Context sucessfully registered.";
}
else
{
	// Error registered
	$response["success"] = 1;
	$response["message"] = "An error has occurred while setting context.";
}

print json_encode($response);