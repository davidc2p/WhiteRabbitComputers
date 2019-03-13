<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");

require_once '../db/db_config.php';

// array for JSON response
$response = array();

//Access_token
if (isset($_GET['access_token']))
{
	$_SESSION['access_token'] = filter_var($_GET['access_token'], FILTER_SANITIZE_STRING);

  // information registered
	$response["success"] = 0;
	$response["message"] = "Context sucessfully registered.";
}
else
{
    $email = filter_var($_GET['email'], FILTER_VALIDATE_EMAIL);

    //Getting Access token
    $data=array(
        'grant_type'    => 'client_credentials',
        'client_id'     => $email, 
        'client_secret' => 'thisismysecret'
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"http://127.0.0.1:8080/vue/WhiteRabbitComputers/public/oauth2/token.php");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);       
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $auth_resp = curl_exec ($curl);

    curl_close ($curl);

    $auth = json_decode($auth_resp, true); 

    if (isset($auth['access_token'])) {
        $_SESSION['access_token'] = $auth['access_token'];
    }
}


//Authenticate indicator
if (isset($_GET['authenticate']))
{
	$_SESSION['authenticate'] = filter_var($_GET['authenticate'], FILTER_VALIDATE_BOOLEAN);

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

//User name
if (isset($_GET['name']))
{
	$_SESSION['name'] = filter_var($_GET['name'], FILTER_SANITIZE_STRING);

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

//uid
if (isset($_GET['uid']))
{
	$_SESSION['uid'] = filter_var($_GET['uid'], FILTER_SANITIZE_STRING);

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

//email
if (isset($_GET['email']))
{
	$_SESSION['email'] = filter_var($_GET['email'], FILTER_VALIDATE_EMAIL);

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


//creationdate
if (isset($_GET['creationdate']))
{
	$_SESSION['creationdate'] = filter_var($_GET['creationdate'], FILTER_SANITIZE_STRING);

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

//admin
if (isset($_GET['admin']))
{
	$_SESSION['admin'] = filter_var($_GET['admin'], FILTER_SANITIZE_NUMBER_INT);

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

//webpath
if (null !== WEBPATH) {
	$_SESSION["webpath"] = WEBPATH;
} else {
  $_SESSION["webpath"] = null;
}

print json_encode($response);