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
            'access_token' 	    	=> array('filter'=>FILTER_SANITIZE_STRING),
            'method' 	    	    => array('filter'=>FILTER_SANITIZE_STRING),
            'lang' 	    	        => array('filter'=>FILTER_SANITIZE_STRING),
            'dev' 	    	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),      
            'computerid'	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),
            'pagenumber'	    	=> array('filter'=>FILTER_SANITIZE_NUMBER_INT),
            'itemsperpage'	    	=> array('filter'=>FILTER_SANITIZE_NUMBER_INT)
        );
        $input = filter_input_array(INPUT_GET, $defs);

    break;

    case 'POST':
        // Insert computer and configuration data
        $defs = array(
            'access_token' 	    	=> array('filter'=>FILTER_SANITIZE_STRING),
            'method' 	    	    => array('filter'=>FILTER_SANITIZE_STRING),
            'lang' 	    	        => array('filter'=>FILTER_SANITIZE_STRING),
            'dev' 	    	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),      
            'computerid'	    	=> array('filter'=>FILTER_SANITIZE_NUMBER_INT),
            'componentid'	    	=> array('filter'=>FILTER_SANITIZE_NUMBER_INT),
            'description'	        => array('filter'=>FILTER_SANITIZE_STRING),
            'longdesc'	        	=> array('filter'=>FILTER_SANITIZE_STRING),
            'price'	            	=> array('filter'=>FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),
            'netprice'	           	=> array('filter'=>FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),
            'image'	              	=> array('filter'=>FILTER_SANITIZE_STRING)
        );
        if(empty($_POST)) {
            $data = json_decode(file_get_contents("php://input"), TRUE);
            $input = filter_var_array($data, $defs);
            if (isset($data['configuration'])) {
                $input['configuration'] = $data['configuration'];
            }
        } else {
            $input = filter_input_array(INPUT_POST, $defs);
            if (isset($_POST['configuration'])) {	
                $input['configuration'] = $_POST['configuration'];
            }
        }
    break;

    case 'PUT':
        // Update computer and configuration data
        $defs = array(
            'access_token' 	    	=> array('filter'=>FILTER_SANITIZE_STRING),
            'method' 	    	    => array('filter'=>FILTER_SANITIZE_STRING),
            'lang' 	    	        => array('filter'=>FILTER_SANITIZE_STRING),
            'dev' 	    	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),      
            'computerid'	    	=> array('filter'=>FILTER_SANITIZE_NUMBER_INT),
            'componentid'	    	=> array('filter'=>FILTER_SANITIZE_NUMBER_INT),
            'id'	    			=> array('filter'=>FILTER_SANITIZE_NUMBER_INT),
            'description'	        => array('filter'=>FILTER_SANITIZE_STRING),
            'longdesc'	        	=> array('filter'=>FILTER_SANITIZE_STRING),
            'price'	            	=> array('filter'=>FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),
            'netprice'	           	=> array('filter'=>FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),
            'image'	              	=> array('filter'=>FILTER_SANITIZE_STRING)
        );
        $data = json_decode(file_get_contents("php://input"), TRUE);
        $input = filter_var_array($data, $defs);
    break;

	case 'DELETE':
		// Delete computer and configuration data
		$defs = array(
            'access_token' 	    	=> array('filter'=>FILTER_SANITIZE_STRING),
            'method' 	    	    => array('filter'=>FILTER_SANITIZE_STRING),
			'lang' 	    	        => array('filter'=>FILTER_SANITIZE_STRING),
			'dev' 	    	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),      
			'computerid'	    	=> array('filter'=>FILTER_SANITIZE_NUMBER_INT),
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
require_once '../../class/computer.class.php';


// include db config class
$dbh = new DB_CONNECT($input['dev']);
$connection = $dbh->getDb();
$auth = new Auth($connection);
$computer = new Computer($connection);
$generic = new Generic();

switch($request_method)
{
	case 'GET':
		// Retrieve Component data
		// print json_encode($profile);
		// exit;

		// dealing with CRUD
		switch($input['method']) {
			
			case 'getComputer':
				if (isset($input['computerid'])
				) {
					//Read one
					$computer->computerid = $input['computerid'];
					$ret = $computer->getComputer();
					header('Content-Type: application/json');
					print json_encode($ret);
				} else {
					if (isset($input['pagenumber']) && isset($input['itemsperpage'])) {
						//Read all with pagination
						$ret = $computer->getComputersWithPagination($input['pagenumber'], $input['itemsperpage']);
						header('Content-Type: application/json');
						print json_encode($ret);
					} else {
						//Read all without pagination
						$ret = $computer->getComputers();
						header('Content-Type: application/json');
						print json_encode($ret);
					}
				} 
			break;

			case 'getAllComputers':
				//Read all without pagination
				$ret = $computer->getComputers();
				header('Content-Type: application/json');
				print json_encode($ret);

			break;

			case 'getComputerDetails':
				if (isset($input['computerid']))
				{
					//Read one
					$computer->computerid = $input['computerid'];
					$ret = $computer->getComputerDetails();
					header('Content-Type: application/json');
					print json_encode($ret);
				} 
			break;

			default:
				// Invalid Request Method
				header("HTTP/1.0 405 Method Not Allowed");
			break; 
		}
        
    break;

  	case 'POST':
		// Insert computer or configuration data

		// checking authorization_code
		$auth_code = $input['access_token'];
		$profile = $auth->ValidateAccessToken($auth_code);

		if (isset($profile[0]['email']) && $profile[0]['email']!="") {

			switch($input['method']) {
				case 'setComputer':
					if (isset($input['description']) && isset($input['longdesc']) && isset($input['price']) &&
					isset($input['netprice']) && isset($input['image']) 
					) {

						$computer->description = $input['description'];
						$computer->longdesc = $input['longdesc'];
						$computer->price = $input['price'];
						$computer->netprice = $input['netprice'];
                        $computer->image = $input['image'];
                        $computer->configuration = $input['configuration'];
                        $computer->setComputer();
                    
					} else {
						$computer->error['success'] = 1;
						$computer->error['message'] = "Input data are not correctly formatted.";
					}
				break;

				case 'setComputerDetails':
					if (isset($input['computerid']) && isset($input['componentid'])
					) {
						$computer->computerid = $input['computerid'];
						$computer->componentid = $input['componentid'];
						$computer->setComputerDetails();
					} else {
						$computer->error['success'] = 1;
						$computer->error['message'] = "Input data are not correctly formatted.";
					}
				break;


				default:
					// Invalid Request Method
					header("HTTP/1.0 405 Method Not Allowed");
					$computer->error['success'] = 1;
					$computer->error['message'] = "Method not allowed.";
				break;	
			}

		} else {
			$computer->error['success'] = 1;
			$computer->error['message'] = $profile['message'];
		}
		header('Content-Type: application/json');
		print json_encode($computer->error);
    break;

  	case 'PUT':
		// checking authorization_code
		$auth_code = $input['access_token'];
		$profile = $auth->ValidateAccessToken($auth_code);

		// Update Component data
		if (isset($profile[0]['email']) && $profile[0]['email']!="") {

			// dealing with CRUD
			switch($input['method']) {
				case 'updComputer':
					if (isset($input['description']) && isset($input['longdesc']) && isset($input['price']) &&
					isset($input['netprice']) && isset($input['image']) && isset($input['id'])
					) {
						$computer->id = $input['id'];
						$computer->description = $input['description'];
						$computer->longdesc = $input['longdesc'];
						$computer->price = $input['price'];
						$computer->netprice = $input['netprice'];
						$computer->image = $input['image'];
						$computer->updateComputer();
					} else {
						$computer->error['success'] = 1;
						$computer->error['message'] = "Input data are not correctly formatted.";
					}
				break;

				default:
					// Invalid Request Method
					header("HTTP/1.0 405 Method Not Allowed");
					$computer->error['success'] = 1;
					$computer->error['message'] = "Method not allowed.";
				break;	
			}
		

		} else {
			$computer->error['success'] = 1;
			$computer->error['message'] = $profile['message'];
		}
		header('Content-Type: application/json');
		print json_encode($computer->error);

    break;

  	case 'DELETE':
		// checking authorization_code
		$auth_code = $input['access_token'];
		$profile = $auth->ValidateAccessToken($auth_code);

		// Delete computer or computercomponents data
		// print json_encode($input);
		// exit;
		if (isset($profile[0]['email']) && $profile[0]['email']!="") {

            // dealing with CRUD
            switch($input['method']) {
                case 'delComputer':
                    if (isset($input['id'])
                    ) {
                        $computer->id = $input['id'];
                        $computer->deleteComputer();
                    } else {
                        $computer->error['success'] = 1;
                        $computer->error['message'] = "Input data are not correctly formatted.";
                    }
                break;
                    
                case 'delComputerDetails':
                    if (isset($input['computerid'])
                    ) {
                        $computer->computerid = $input['computerid'];
                        $computer->deleteComputerDetails();
                    } else {
                        $computer->error['success'] = 1;
                        $computer->error['message'] = "Input data are not correctly formatted.";
                    }
                break;

                default:
                    // Invalid Request Method
                    header("HTTP/1.0 405 Method Not Allowed");
                    $computer->error['success'] = 1;
                    $computer->error['message'] = "Method not allowed.";
                break;	
            }
		
		} else {
			$computer->error['success'] = 1;
			$computer->error['message'] = $profile['message'];
		}
		header('Content-Type: application/json');
		print json_encode($computer->error);
    break;

  	default:
		// Invalid Request Method
		header("HTTP/1.0 405 Method Not Allowed");
    break;
}
?>