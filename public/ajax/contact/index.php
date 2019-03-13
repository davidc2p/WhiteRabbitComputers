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
        header("Access-Control-Allow-Methods: POST, GET");
        header("Content-Type: application/json; charset=UTF-8");
        return 200;
    }
  break;

  case 'GET':
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    exit;
  break;

  case 'POST':
    // Post register data
    $defs = array(
      'method' 	    	      => array('filter'=>FILTER_SANITIZE_STRING),
      'access_token' 	    	=> array('filter'=>FILTER_SANITIZE_STRING),
	    'lang' 	    	        => array('filter'=>FILTER_SANITIZE_STRING),
	    'dev' 	    	        => array('filter'=>FILTER_SANITIZE_NUMBER_INT),
      'contactName'   	    => array('filter'=>FILTER_SANITIZE_STRING),
	    'contactEmail'	      => array('filter'=>FILTER_VALIDATE_EMAIL),
	    'contactSubject'		  => array('filter'=>FILTER_SANITIZE_STRING),
	    'contactMessage'		  => array('filter'=>FILTER_SANITIZE_STRING)
    );

    if(empty($_POST)) {
      $data = json_decode(file_get_contents("php://input"), TRUE);
      $input = filter_var_array($data, $defs);
    } else {
      $input = filter_input_array(INPUT_POST, $defs);	
    }

  break;

  case 'PUT':
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    exit;
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
require_once '../../class/contact.class.php';
require_once '../../assets/PHPMailer/PHPMailerAutoload.php';


// include db config class
$dbh = new DB_CONNECT($input['dev']);
$connection = $dbh->getDb();
$generic = new Generic();
$contact = new Contact($connection);

//$contact = array('error' => array('success' => 0, 'message' => ''));

switch($request_method)
{
	case 'GET':
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    break;

  case 'POST':
    switch ($input['method']) {

      case 'send':

        // Insert data into newly created user account
        $contact->email = $input['contactEmail'];
        $contact->name = $input['contactName'];
        $contact->subject = $input['contactSubject'];
        $contact->message = $input['contactMessage'];
        $contact->setContact();

        if (isset($contact->error['success']) && $contact->error['success']==0) {
          if (isset($input['contactName']) && isset($input['contactEmail']) && isset($input['contactSubject']) && isset($input['contactMessage'])) {

              //Create a new PHPMailer instance
              $mail = new PHPMailer();
              $mail->CharSet = 'UTF-8';
              //Set who the message is to be sent from
              $mail->setFrom('account@whiterabbitcomputers.com', 'WhiteRabbitComputers');
              //Set who the message is to be sent to
              $mail->addAddress('account@whiterabbitcomputers.com', 'WhiteRabbitComputers');
              $mail->AddCC('dadomingues@gmail.com', 'David Domingues');
              //Set the subject line
              $mail->Subject = 'Pedido de '.$input['contactName'].'. Assunto: '.$input['contactAssunto'];
              //Read an HTML message body from an external file, convert referenced images to embedded,
              //convert HTML into a basic plain-text alternative body
              $mail->MsgHTML('Name:<br/>'.$input['contactName'].'<br/>Email:<br/>'.$input['contactEmail'].'<br/>Assunto:<br/>'.$input['contactSubject'].'<br/>Message:<br/>'.$input['contactMessage']);
              //Replace the plain text body with one created manually
              $mail->AltBody = 'Name: '.$input['contactName'].' Email: '.$input['contactEmail'].' Assunto: '.$input['contactSubject'].' Message: '.$input['contactMessage'];

              //send the message, check for errors
              if (!$mail->send()) {
                $contact->error['success'] = 1;
                $contact->error['message'] = "Mailer Error: " . $mail->ErrorInfo;
              } else {
                $contact->error['success'] = 0;
                $contact->error['message'] =  "Message sent!";
              }
          } else {
            $contact->error['success'] = 1;
            $contact->error['message'] = 'Ocorreu um erro no envio do contacto.';
          }
        } else {
            $contact->error['success'] = 1;
            $contact->error['message'] = 'Ocorreu um erro na gravação do contacto.';
        }

        header('Content-Type: application/json');
        print json_encode($contact->error);
      break;


      default:
        // Invalid Request Method
        $contact->error['success'] = 1;
        $contact->error['message'] = 'Invalid Transaction';

        header('Content-Type: application/json');
        print json_encode($contact->error);
      break;
    }
    break;

  case 'PUT':
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
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