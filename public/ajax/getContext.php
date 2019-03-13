<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");

require_once '../db/db_config.php';
require_once '../class/generic.class.php';
//require_once './model.class.php';

// array for JSON response
$response = array();

//access_token
if (isset($_SESSION['access_token'])) {
	$response["access_token"] = filter_var($_SESSION['access_token'], FILTER_SANITIZE_STRING);
} else {
  $response["access_token"] = null;
}
//creationdate
if (isset($_SESSION['creationdate'])) {
	$response["creationdate"] = filter_var($_SESSION['creationdate'], FILTER_SANITIZE_STRING);
} else {
  $response["creationdate"] = null;
}
//name
if (isset($_SESSION['name'])) {
	$response["name"] = filter_var($_SESSION['name'], FILTER_SANITIZE_STRING);
} else {
  $response["name"] = null;
}
//email
if (isset($_SESSION['email'])) {
	$response["email"] = filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL);
} else {
  $response["email"] = null;
}
//admin
if (isset($_SESSION['admin'])) {
	$response["admin"] = filter_var($_SESSION['admin'], FILTER_SANITIZE_NUMBER_INT);
} else {
  $response["admin"] = null;
}
//authenticate
if (isset($_SESSION['authenticate'])) {
	$response["authenticate"] = filter_var($_SESSION['authenticate'], FILTER_VALIDATE_BOOLEAN);
} else {
  $response["authenticate"] = null;
}
//uid
if (isset($_SESSION['uid'])) {
	$response["uid"] = filter_var($_SESSION['uid'], FILTER_SANITIZE_STRING);
} else {
  $response["uid"] = null;
}
//webpath
if (null !== WEBPATH) {
	$response["webpath"] = WEBPATH;
} else {
  $response["webpath"] = null;
}

print json_encode($response);