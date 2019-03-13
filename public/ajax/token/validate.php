<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");

$request_method=$_SERVER["REQUEST_METHOD"];

$defs = array(
    'access_token' 	  => array('filter'=>FILTER_SANITIZE_STRING),
    'dev' 	    	    => array('filter'=>FILTER_SANITIZE_NUMBER_INT)
);

switch($request_method)
{
  case 'OPTIONS': {
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
      header("Access-Control-Allow-Methods: PUT, POST, GET");
      header("Content-Type: application/json; charset=UTF-8");
      return 200;
  }
  break;

  case 'GET':
    // Retrieve External api param
    $input = filter_input_array(INPUT_GET, $defs);

  break;

  case 'POST':
    // Insert External api param
    $input = filter_input_array(INPUT_POST, $defs);	

  break;

  case 'PUT':
    // Update External api param
    parse_str(file_get_contents("php://input"), $post_vars);
    $input = filter_var_array($post_vars, $defs);
  break;

  case 'DELETE':
    // Delete External api param
    parse_str(file_get_contents("php://input"), $post_vars);
    $input = filter_var_array($post_vars, $defs);	
  break;

  default:
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    exit;
    break;
}
// include database and object files
require_once '../../db/db_connect.php';
require_once '../../class/generic.class.php';
require_once '../../class/auth.class.php';

// include db config class
$dbh = new DB_CONNECT($input['dev']);
$connection = $dbh->getDb();
$auth = new Auth($connection);
$generic = new Generic();

// checking authorization_code
$auth_code = $input['access_token'];

$user = $auth->ValidateAccessToken($auth_code);

// print json_encode($user);
// exit;
if (isset($user[0]['email'])) {
    $ret = array();
    $ret['success'] = 0;
    $ret['message'] = 'Token is valid';
} else {
    $ret = array();
    $ret['success'] = 1;
    if (isset($user['message'])) {
        $ret['message'] = $user['message'];
    } else {
        $ret['message'] = 'Error';
    }
}

header('Content-Type: application/json');
print json_encode($ret);
?>