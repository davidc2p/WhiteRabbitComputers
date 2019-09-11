<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");

$request_method=$_SERVER["REQUEST_METHOD"];

switch($request_method)
{
  //Testing pre-flight conditions
  case 'OPTIONS': {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header("Access-Control-Allow-Methods: PUT, POST, GET");
        header("Content-Type: application/json; charset=UTF-8");
        return 200;
    }
  break;

  case 'GET':
    // Get OrderInfo data
    $defs = array(
        'method' 	    	      => array('filter'=>FILTER_SANITIZE_STRING),
        'access_token' 	    	=> array('filter'=>FILTER_SANITIZE_STRING),
	      'lang' 	    	        => array('filter'=>FILTER_SANITIZE_STRING),
	      'dev' 	    	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),
        'orderinfoid'	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),
        'pagenumber'	    	  => array('filter'=>FILTER_SANITIZE_NUMBER_INT),
        'itemsperpage'	    	=> array('filter'=>FILTER_SANITIZE_NUMBER_INT),
        'status'    	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT)
    );
    $input = filter_input_array(INPUT_GET, $defs);

  break;

  case 'POST':
    // Post OrderInfo data
    $defs = array(
        'method' 	    	      => array('filter'=>FILTER_SANITIZE_STRING), 
        'access_token' 	    	=> array('filter'=>FILTER_SANITIZE_STRING),
	      'lang' 	    	        => array('filter'=>FILTER_SANITIZE_STRING),
	      'dev' 	    	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),
        'orderinfoid'	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),
        'computerid'  	    	=> array('filter'=>FILTER_SANITIZE_NUMBER_INT),
        'computerdesc'  	    => array('filter'=>FILTER_SANITIZE_STRING),
        'computercost'  	    => array('filter'=>FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),
        'computerprice'  	    => array('filter'=>FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),
        'computerqtd'  	      => array('filter'=>FILTER_SANITIZE_NUMBER_INT),
        'computervatprice'  	=> array('filter'=>FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),
        'computertotalprice'  => array('filter'=>FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),
        'email'  	    	      => array('filter'=>FILTER_VALIDATE_EMAIL),
        'taxnumber'  	      	=> array('filter'=>FILTER_SANITIZE_STRING),
        'phonenumber'  	    	=> array('filter'=>FILTER_SANITIZE_STRING),
        'deliveryname'  	    => array('filter'=>FILTER_SANITIZE_STRING),
        'deliverystreet'  	  => array('filter'=>FILTER_SANITIZE_STRING),
        'deliveryzipcode'  	  => array('filter'=>FILTER_SANITIZE_STRING),
        'deliverycity'  	    => array('filter'=>FILTER_SANITIZE_STRING),
        'invoicename'  	      => array('filter'=>FILTER_SANITIZE_STRING),
        'invoicestreet'  	    => array('filter'=>FILTER_SANITIZE_STRING),
        'invoicezipcode'  	  => array('filter'=>FILTER_SANITIZE_STRING),
        'invoicecity'  	      => array('filter'=>FILTER_SANITIZE_STRING),
        'status'  	          => array('filter'=>FILTER_SANITIZE_NUMBER_INT)
    );

    if(empty($_POST)) {
        $data = json_decode(file_get_contents("php://input"), TRUE);
        $input = filter_var_array($data, $defs);
    } else {
        $input = filter_input_array(INPUT_POST, $defs);	
    }

  break;

  case 'PUT':
    // Update OrderInfo data
    $defs = array(
        'access_token' 	    	=> array('filter'=>FILTER_SANITIZE_STRING),
        'method' 	    	    => array('filter'=>FILTER_SANITIZE_STRING),
        'lang' 	    	        => array('filter'=>FILTER_SANITIZE_STRING),
        'dev' 	    	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),      
        'orderinfoid'	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),
        'status'  	            => array('filter'=>FILTER_SANITIZE_NUMBER_INT)
    );
    $data = json_decode(file_get_contents("php://input"), TRUE);
    $input = filter_var_array($data, $defs);
  break;

  case 'DELETE':
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    exit;
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
require_once '../../class/orderinfo.class.php';
require_once '../../class/auth.class.php';
require_once '../../assets/PHPMailer/PHPMailerAutoload.php';


// include db config class
$dbh = new DB_CONNECT($input['dev']);
$connection = $dbh->getDb();
$auth = new Auth($connection);
$generic = new Generic();
$orderinfo = new OrderInfo($connection);

// checking authorization_code
$auth_code = $input['access_token'];
$profile = $auth->ValidateAccessToken($auth_code);

switch($request_method)
{
	case 'GET':
    if (!isset($input['method'])) {
        if (isset($profile[0]['email']) && $profile[0]['email']!="" && 
            isset($profile[0]['admin']) && $profile[0]['admin']=="1") {
            if (isset($input['orderinfoid'])
            ) {
                //Read one
                $orderinfo->orderinfoid = $input['orderinfoid'];
                $ret = $orderinfo->getOrderInfo();
                header('Content-Type: application/json');
                print json_encode($ret);
            } else {
                if (isset($input['pagenumber']) && isset($input['itemsperpage'])) {
                    //Read all with pagination
                    $orderinfo->status = $input['status'];
                    $ret = $orderinfo->getOrderInfoWithPagination($input['pagenumber'], $input['itemsperpage']);
                    header('Content-Type: application/json');
                    print json_encode($ret);
                } else {
                    //Read all without pagination
                    $orderinfo->status = $input['status'];
                    $ret = $orderinfo->getAllOrderInfo();
                    header('Content-Type: application/json');
                    print json_encode($ret);
                }
            }
        } else {
            // Invalid Credencials
            $orderinfo->error['success'] = 1;
            $orderinfo->error['message'] = 'Invalid Credencials';

            header('Content-Type: application/json');
            print json_encode($orderinfo->error);
        }
    } else {
      switch ($input['method']) {

        case 'getOrderInfo':
            if (isset($profile[0]['email']) && $profile[0]['email']!="" && 
                isset($profile[0]['admin']) && $profile[0]['admin']=="1") {
    
                if (isset($input['id'])) {
                    $orderinfo->id = $input['id'];
                    $ret = $orderinfo->getOrderInfo();  
                    
                    header('Content-Type: application/json');
                    print json_encode($ret);        
                
                } else {
                    $orderinfo->error['success'] = 1;
                    $orderinfo->error['message'] = 'Ocorreu um erro na consulta das encomendas.';

                    header('Content-Type: application/json');
                    print json_encode($orderinfo->error);
                }

            } else {
                // Invalid Credencials
                $orderinfo->error['success'] = 1;
                $orderinfo->error['message'] = 'Invalid Credencials';
    
                header('Content-Type: application/json');
                print json_encode($orderinfo->error);
            }

        break;

        case 'getAllOrderInfo':
          
            if (isset($profile[0]['email']) && $profile[0]['email']!="" && 
                isset($profile[0]['admin']) && $profile[0]['admin']=="1") {
            
                $ret = $orderinfo->getAllOrderInfo($input['status']);  

                header('Content-Type: application/json');
                print json_encode($ret);  

            } else {
                // Invalid Credencials
                $orderinfo->error['success'] = 1;
                $orderinfo->error['message'] = 'Invalid Credencials';

                header('Content-Type: application/json');
                print json_encode($orderinfo->error);
            }   
          

        break;

        case 'getAllOrderInfoByEmail':
          
            if (isset($profile[0]['email']) && $profile[0]['email']!="") {
              if (isset($input['pagenumber']) && isset($input['itemsperpage'])) {
                  //Read all with pagination
                  $ret = $orderinfo->getOrderInfoByEmailWithPagination($profile[0]['email'], $input['pagenumber'], $input['itemsperpage']);
                  header('Content-Type: application/json');
                  print json_encode($ret);
              } else {
                  //Read all without pagination
                  $ret = $orderinfo->getAllOrderInfoByEmail($profile[0]['email']);  

                  header('Content-Type: application/json');
                  print json_encode($ret);  
              }


            } else {
                // Invalid Credencials
                $orderinfo->error['success'] = 1;
                $orderinfo->error['message'] = 'Invalid Credencials';

                header('Content-Type: application/json');
                print json_encode($orderinfo->error);
            }   
          

        break;

        case 'getOrderInfoDetails':
        
            if (isset($profile[0]['email']) && $profile[0]['email']!="" && 
                isset($profile[0]['admin']) && $profile[0]['admin']=="1") {

                $orderinfo->orderinfoid = $input['orderinfoid'];
                $ret = $orderinfo->getOrderInfoDetails();  
                
                header('Content-Type: application/json');
                print json_encode($ret);  
            
            } else {
                // Invalid Credencials
                $orderinfo->error['success'] = 1;
                $orderinfo->error['message'] = 'Invalid Credencials';

                header('Content-Type: application/json');
                print json_encode($orderinfo->error);
            }         

        break;


        default:
          // Invalid Request Method
          $orderinfo->error['success'] = 1;
          $orderinfo->error['message'] = 'Invalid Transaction';

          header('Content-Type: application/json');
          print json_encode($orderinfo->error);
        break;
      }
    }
    break;

  case 'POST':

    switch ($input['method']) {

      case 'setOrderInfo':

        //Dados da encomenda
        $orderinfo->computerid = filter_var($input['orderinfo']['computerid'], FILTER_SANITIZE_NUMBER_INT);	
        $orderinfo->computerdesc = filter_var($input['orderinfo']['computerdesc'], FILTER_SANITIZE_STRING);
        $orderinfo->computercost = filter_var($input['orderinfo']['computercost'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
        $orderinfo->computerprice = filter_var($input['orderinfo']['computerprice'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
        $orderinfo->computerqtd = filter_var($input['orderinfo']['computerqtd'], FILTER_SANITIZE_NUMBER_INT);	
        $orderinfo->computervatprice = filter_var($input['orderinfo']['computervatprice'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
        $orderinfo->computertotalprice = filter_var($input['orderinfo']['computertotalprice'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	

        $orderinfo->email = filter_var($input['orderinfo']['customer']['email'], FILTER_VALIDATE_EMAIL);
        $orderinfo->taxnumber = filter_var($input['orderinfo']['customer']['taxnumber'], FILTER_SANITIZE_STRING);
        $orderinfo->phonenumber = filter_var($input['orderinfo']['customer']['phonenumber'], FILTER_SANITIZE_STRING);
        $orderinfo->deliveryname = filter_var($input['orderinfo']['customer']['delivery']['name'], FILTER_SANITIZE_STRING);
        $orderinfo->deliverystreet = filter_var($input['orderinfo']['customer']['delivery']['address'], FILTER_SANITIZE_STRING);
        $orderinfo->deliveryzipcode = filter_var($input['orderinfo']['customer']['delivery']['zip'], FILTER_SANITIZE_STRING);
        $orderinfo->deliverycity = filter_var($input['orderinfo']['customer']['delivery']['city'], FILTER_SANITIZE_STRING);
        $orderinfo->invoicename = filter_var($input['orderinfo']['customer']['invoice']['name'], FILTER_SANITIZE_STRING);
        $orderinfo->invoicestreet = filter_var($input['orderinfo']['customer']['invoice']['address'], FILTER_SANITIZE_STRING);
        $orderinfo->invoicezipcode = filter_var($input['orderinfo']['customer']['invoice']['zip'], FILTER_SANITIZE_STRING);
        $orderinfo->invoicecity = filter_var($input['orderinfo']['customer']['invoice']['city'], FILTER_SANITIZE_STRING);
        $orderinfo->setOrderInfo();

        header('Content-Type: application/json');
        print json_encode($orderinfo->error);
      break;


      default:
        // Invalid Request Method
        $orderinfo->error['success'] = 1;
        $orderinfo->error['message'] = 'Invalid Transaction';

        header('Content-Type: application/json');
        print json_encode($orderinfo->error);
      break;
    }
    break;

  case 'PUT':
    switch ($input['method']) { 

      case 'updOrderInfoStatus':

            if (isset($profile[0]['email']) && $profile[0]['email']!="" && 
                isset($profile[0]['admin']) && $profile[0]['admin']=="1") {

                //Status da encomenda
                $orderinfo->orderinfoid = $input['orderinfoid'];	
                $orderinfo->status = $input['status'];	

                $orderinfo->updOrderInfoStatus();

                header('Content-Type: application/json');
                print json_encode($orderinfo->error);

            } else {
                // Invalid Credencials
                $orderinfo->error['success'] = 1;
                $orderinfo->error['message'] = 'Invalid Credencials';

                header('Content-Type: application/json');
                print json_encode($orderinfo->error);
            }       
      break;


      default:
        // Invalid Request Method
        $orderinfo->error['success'] = 1;
        $orderinfo->error['message'] = 'Invalid Transaction';

        header('Content-Type: application/json');
        print json_encode($orderinfo->error);
      break;
    }
    break;    

  case 'DELETE':
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    break;
    

  default:
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    break;
}
?>