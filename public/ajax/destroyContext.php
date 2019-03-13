<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");

// array for JSON response
$response = array();

//Access_token
unset($_SESSION['authenticate']);
unset($_SESSION['name']);
unset($_SESSION['uid']);
unset($_SESSION['email']);
unset($_SESSION['creationdate']);
unset($_SESSION['admin']);
unset($_SESSION['origin']);
unset($_SESSION['access_token']);
//Google
unset($_SESSION['id_token_token']);
session_unset();
session_destroy();

// information registered
$response["success"] = 0;
$response["message"] = "Context sucessfully destroyed.";


print json_encode($response);
?>