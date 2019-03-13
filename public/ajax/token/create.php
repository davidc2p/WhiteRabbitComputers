<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");

$request_method=$_SERVER["REQUEST_METHOD"];

$defs = array(
    'access_token' 	    => array('filter'=>FILTER_SANITIZE_STRING),
	  'client_id'	        => array('filter'=>FILTER_SANITIZE_STRING),
	  'client_secret'	    => array('filter'=>FILTER_SANITIZE_STRING),
	  'lang' 	    	      => array('filter'=>FILTER_SANITIZE_STRING),
    'dev' 	    	      => array('filter'=>FILTER_SANITIZE_NUMBER_INT)
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
    $data = json_decode(file_get_contents("php://input"), TRUE);
    $input = filter_var_array($data, $defs);

  break;

  case 'DELETE':
    // Delete External api param
    $data = json_decode(file_get_contents("php://input"), TRUE);
    $input = filter_var_array($data, $defs);	
  break;

  default:
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    exit;
    break;
}
// include database and object files
require_once '../../db/db_config.php';
require_once '../../db/db_connect.php';
require_once '../../class/generic.class.php';
require_once '../../class/auth.class.php';


$input['grant_type'] = 'client_credentials';
$input['client_secret'] = 'thisismysecret';


// include db config class
$dbh = new DB_CONNECT($input['dev']);
$connection = $dbh->getDb();
$auth = new Auth($connection);
$generic = new Generic();

// checking authorization_code
$auth_code = $input['access_token'];

$profile = $auth->ValidateAccessToken($auth_code);

// print json_encode($profile);
// exit;
if (isset($profile['message']) && $profile['message'] == 'Token has expired') {

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, APIPATH."oauth2/token.php");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $input);     
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $auth_resp = curl_exec ($curl);

    curl_close ($curl);

    print $auth_resp;
} else {
    $ret = array();
    $ret['success'] = 1;
    if(isset($profile['id'])) {
        $ret['message'] = 'Current token is still valid';    
    } elseif ($profile['message']) {
        $ret['message'] = $profile['message'];
    } else {
        $ret['message'] = 'Error';
    }
    
    header('Content-Type: application/json');
    print json_encode($ret);
}
?>