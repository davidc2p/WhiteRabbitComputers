<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: PUT, POST, GET, DELETE");
header("Content-Type: application/json; charset=UTF-8");

$request_method=$_SERVER["REQUEST_METHOD"];

switch($request_method)
{
  //Testing pre-flight conditions
  case 'OPTIONS': {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header("Access-Control-Allow-Methods: PUT, POST, GET, DELETE");
    header("Content-Type: application/json; charset=UTF-8");
    return 200;
  }
  break;

  case 'GET':
    // Retrieve Component data
    $defs = array(
        'method' 	    	    => array('filter'=>FILTER_SANITIZE_STRING),
        'access_token' 	    	=> array('filter'=>FILTER_SANITIZE_STRING),
	    'lang' 	    	        => array('filter'=>FILTER_SANITIZE_STRING),
	    'dev' 	    	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),      
	    'id' 	      	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),      
        'type'	    		    => array('filter'=>FILTER_SANITIZE_STRING),
        'link'	    		    => array('filter'=>FILTER_SANITIZE_URL),
        'description'	        => array('filter'=>FILTER_SANITIZE_STRING),
        'pagenumber'	   		=> array('filter'=>FILTER_SANITIZE_NUMBER_INT),
        'itemsperpage'	    	=> array('filter'=>FILTER_SANITIZE_NUMBER_INT)
    );
    $input = filter_input_array(INPUT_GET, $defs);

  break;

  case 'POST':
    // Insert Component data
    $defs = array(
        'access_token' 	    	=> array('filter'=>FILTER_SANITIZE_STRING),
	    'lang' 	    	        => array('filter'=>FILTER_SANITIZE_STRING),
	    'dev' 	    	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),      
        'type'  	            => array('filter'=>FILTER_SANITIZE_STRING),
        'description'	        => array('filter'=>FILTER_SANITIZE_STRING),
        'cost'	            	=> array('filter'=>FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),
        'link'	            	=> array('filter'=>FILTER_SANITIZE_URL),  
        'image'	                => array('filter'=>FILTER_SANITIZE_STRING)
    );
    if(empty($_POST)) {
      $data = json_decode(file_get_contents("php://input"), TRUE);
      $input = filter_var_array($data, $defs);
    } else {
      $input = filter_input_array(INPUT_POST, $defs);	
    }
  break;

  case 'PUT':
    // Update Component data
    $defs = array(
        'access_token' 	    	=> array('filter'=>FILTER_SANITIZE_STRING),
	    'lang' 	    	        => array('filter'=>FILTER_SANITIZE_STRING),
	    'dev' 	    	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),      
        'id'	    			=> array('filter'=>FILTER_SANITIZE_NUMBER_INT),
        'type'  	            => array('filter'=>FILTER_SANITIZE_STRING),
        'description'	        => array('filter'=>FILTER_SANITIZE_STRING),
        'cost'	            	=> array('filter'=>FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),
        'link'	            	=> array('filter'=>FILTER_SANITIZE_URL),  
        'image'	                => array('filter'=>FILTER_SANITIZE_STRING)
    );
    $data = json_decode(file_get_contents("php://input"), TRUE);
    $input = filter_var_array($data, $defs);
  break;

  case 'DELETE':
    // Delete Component data
    $defs = array(
        'access_token' 	    	=> array('filter'=>FILTER_SANITIZE_STRING),
	    'lang' 	    	        => array('filter'=>FILTER_SANITIZE_STRING),
	    'dev' 	    	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),      
        'id'	    		    => array('filter'=>FILTER_SANITIZE_NUMBER_INT)
    );

    $input = filter_input_array(INPUT_GET, $defs);
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
require_once '../../class/component.class.php';


// include db config class
$dbh = new DB_CONNECT($input['dev']);
$connection = $dbh->getDb();
$auth = new Auth($connection);
$component = new Component($connection);
$generic = new Generic();

switch($request_method)
{
	case 'GET':
    // Retrieve Component data
    // print json_encode($profile);
    // exit;

    // dealing with CRUD
    if (!isset($input['method'])) {
        if (isset($input['id'])
        ) {
            //Read one
            $component->id = $input['id'];
            $ret = $component->getComponent();
            header('Content-Type: application/json');
            print json_encode($ret);
        } else {
            if (isset($input['pagenumber']) && isset($input['itemsperpage'])) {
                //Read all with pagination
                $component->type = $input['type'];
                $ret = $component->getComponentsWithPagination($input['pagenumber'], $input['itemsperpage']);
                header('Content-Type: application/json');
                print json_encode($ret);
            } else {
                //Read all without pagination
                $component->type = $input['type'];
                $ret = $component->getComponents();
                header('Content-Type: application/json');
                print json_encode($ret);
            }
      }
    } else {
      switch($input['method']) {
  
        case 'parseCost':
            if (isset($input['link'])
            ) {
                set_time_limit(120);

                $price = 0;
                
                try {
                    require('../../assets/simple_html_dom-master/simple_html_dom.php');

                    // get DOM from URL or file
                    $html = file_get_html( $input['link'], false, null, 0 );
                    //$html = file_get_html($input['link']);
                    
                    $counter = 0;
                    $found = false;
                    foreach($html->find('div.product-name') as $e) {
                        $text1 = strtoupper($e->outertext);
                        $text2 = strtoupper(trim($input['description']));
                        if (strpos($text1, $text2) > 0) {
                            $counter++;
                            $found = true;
                        } else {
                            if (!$found) {
                                $counter++;
                            }
                        }
                    }

                    $counter2=1; 
                    foreach($html->find('div.price-box') as $e) {
                        $tabprice = $e->find('span.price');
                        if ($counter2 == $counter) {
                            $price = substr($tabprice[0]->innertext, 0, strlen($tabprice[0]->innertext) - 2);
                            $price = str_replace(',', '.', $price);
                        }
                        $counter2++;
                    }
                }
                catch(Exception $e) {
                    $price = 0;
                }

/*
              $price = substr($taprice[$counter]->innertext, 0, strlen($taprice[$counter]->innertext) - 2);
              $price = str_replace(',', '.', $price);

              $sku = $html->find('div.sku');

              $strpos = strpos($html, $sku[0]->outertext);

              foreach($html->find('div.pricebox span.price') as $e) {
                if (strpos($html, $sku[0]->outertext) > $strpos && $price == 0) {
                  $price = substr($e->innertext, 0, strlen($e->innertext) - 2);
                  $price = str_replace(',', '.', $price);
                }
              }
*/
              $component->cost = array('id'=>$input['id'], 'link'=> $input['link'], 'costactual'=> (float)$price);

              header('Content-Type: application/json');
              print json_encode($component->cost);
          } 
        break;
  
        default:
          // Invalid Request Method
          header("HTTP/1.0 405 Method Not Allowed");
        break; 
      }
    }
 
    break;

  case 'POST':
    // Insert Component data

    // checking authorization_code
    $auth_code = $input['access_token'];
    $profile = $auth->ValidateAccessToken($auth_code);

    if (isset($profile[0]['email']) && $profile[0]['email']!="" && 
        isset($profile[0]['admin']) && $profile[0]['admin']=="1") {

      // dealing with CRUD
      if (isset($input['type']) && isset($input['description']) && isset($input['cost']) &&
          isset($input['link']) && isset($input['image']) 
      ) {
            $component->type = $input['type'];
            $component->description = $input['description'];
            $component->cost = $input['cost'];
            $component->link = $input['link'];
            $component->image = $input['image'];
            $component->setComponent();
      } else {
            $component->error['success'] = 1;
            $component->error['message'] = "Input data are not correctly formatted.";
      }

    } else {
        $component->error['success'] = 1;
        $component->error['message'] = $profile['message'];
    }
    header('Content-Type: application/json');
    print json_encode($component->error);
    break;

  case 'PUT':
    // checking authorization_code
    $auth_code = $input['access_token'];
    $profile = $auth->ValidateAccessToken($auth_code);

    // Update Component data
    if (isset($profile[0]['email']) && $profile[0]['email']!="" && 
        isset($profile[0]['admin']) && $profile[0]['admin']=="1") {

      // dealing with CRUD
      if (isset($input['type']) && isset($input['description']) && isset($input['cost']) &&
          isset($input['link']) && isset($input['image']) && isset($input['id'])
      ) {
            $component->id = $input['id'];
            $component->type = $input['type'];
            $component->description = $input['description'];
            $component->cost = $input['cost'];
            $component->link = $input['link'];
            $component->image = $input['image'];
            $component->updateComponent();
      } else {
            $component->error['success'] = 1;
            $component->error['message'] = "Input data are not correctly formatted.";
      }

    } else {
      $component->error['success'] = 1;
      $component->error['message'] = $profile['message'];
    }
    header('Content-Type: application/json');
    print json_encode($component->error);

    break;

  case 'DELETE':
    // checking authorization_code
    $auth_code = $input['access_token'];
    $profile = $auth->ValidateAccessToken($auth_code);

    // Delete Component data
    // print json_encode($input);
    // exit;
    if (isset($profile[0]['email']) && $profile[0]['email']!="" && 
       isset($profile[0]['admin']) && $profile[0]['admin']=="1") {

        // dealing with CRUD
        if (isset($input['id'])
        ) {
            $component->id = $input['id'];
            $component->deleteComponent();
        } else {
            $component->error['success'] = 1;
            $component->error['message'] = "Input data are not correctly formatted.";
        }

    } else {
        $component->error['success'] = 1;
        $component->error['message'] = $profile['message'];
    }
    header('Content-Type: application/json');
    print json_encode($component->error);
    break;

  default:
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    break;
}
?>