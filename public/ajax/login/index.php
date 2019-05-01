<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: PUT, POST, GET");
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
    // Retrieve External api param
    $defs = array(
        'method' 	    	=> array('filter'=>FILTER_SANITIZE_STRING),
        'access_token' 	    => array('filter'=>FILTER_SANITIZE_STRING),
	    'lang' 	    	    => array('filter'=>FILTER_SANITIZE_STRING),
	    'dev' 	    	    => array('filter'=>FILTER_SANITIZE_NUMBER_INT),      
        'email'     	    => FILTER_VALIDATE_EMAIL,
        'password'		    => array('filter'=>FILTER_SANITIZE_STRING),
        'uid' 	    	    => array('filter'=>FILTER_SANITIZE_STRING)
    );
    $input = filter_input_array(INPUT_GET, $defs);
  break;

  case 'POST':
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    exit;

  break;

  case 'PUT':
    // Update Timesheet
    $defs = array(
      'method'       	    => array('filter'=>FILTER_SANITIZE_STRING),
      'access_token' 	 	=> array('filter'=>FILTER_SANITIZE_STRING),
      'lang' 	    	    => array('filter'=>FILTER_SANITIZE_STRING),
      'dev' 	    	    => array('filter'=>FILTER_SANITIZE_NUMBER_INT),    
      'email'     	        => FILTER_VALIDATE_EMAIL,
      'password'		    => array('filter'=>FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW),
      'uid' 	    	    => array('filter'=>FILTER_SANITIZE_STRING)
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
require_once '../../db/db_config.php';
require_once '../../db/db_connect.php';
require_once '../../class/generic.class.php';
require_once '../../class/user.class.php';
require_once '../../class/auth.class.php';
require_once '../../assets/PHPMailer/PHPMailerAutoload.php';

// include db config class
$dbh = new DB_CONNECT($input['dev']);
$connection = $dbh->getDb();
$user = new User($connection);
$auth = new Auth($connection);
$generic = new Generic();

switch($request_method)
{
	case 'GET':
    // Login data
    // print json_encode($input);
    // exit;
    // Get method
    switch ($input['method']) {
      case 'resendEmail':
        //email
        if (isset($input['email'])) {

          $ret = $user->getUser($input['email']);

          //send email
          if (isset($ret[0]['name']) && isset($ret[0]['uid']) ) {
            $message = '
<table>
    <tr>
        <td>
            Caro(a) Senhor(a) '.$ret[0]['name'].'
            <br/><br/>Este email foi enviado em substituição do email original de confirmação de abertura da sua conta. Por favor, faça clique no botão abaixo para confirmar.
            <br/><br/>

            <div>
            <!--[if mso]>
            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://www.whiterabbitcomputers.com/AccountConfirmation/'.$ret[0]['uid'].'" style="height:40px;v-text-anchor:middle;width:300px;" arcsize="10%" stroke="f" fillcolor="#E5C41A">
                <w:anchorlock/>
                <center style="color: black;font-family:sans-serif;font-size:16px;font-weight:bold;">
                    Finalizar o registo
                </center>
            </v:roundrect>
            <![endif]-->
            <![if !mso]>
            <table cellspacing="0" cellpadding="0"> <tr> 
            <td align="center" width="300" height="40" bgcolor="#E5C41A" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">
                <a href="https://www.whiterabbitcomputers.com/AccountConfirmation/'.$ret[0]['uid'].'" style="font-size:16px; font-weight: bold; font-family:sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block">
                <span style="color: black;">
                    Finalizar o registo
                </span>
                </a>
            </td> 
            </tr> </table> 
            <![endif]>
            </div>
        </td>
    </tr>
</table>';

            //Create a new PHPMailer instance 
            $mail = new PHPMailer();
            $mail->CharSet = 'UTF-8';
            //Set who the message is to be sent from
            $mail->setFrom('account@whiterabbitcomputers.com', 'WhiteRabbitComputers');
            //Set who the message is to be sent to
            $mail->addAddress($ret[0]['email'], $ret[0]['name']);
            $mail->AddBCC('dadomingues@gmail.com', 'David Domingues');
            //Set the subject line
            $mail->Subject = 'Reenvio do pedido de confirmação de abertura de conta.';
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            
            $CompleteMessage = $generic->encapsulateMessage($message);

            $mail->MsgHTML($CompleteMessage);
            //Replace the plain text body with one created manually
            $mail->AltBody = 'Link: '.'https://www.whiterabbitcomputers.com/AccountConfirmation/'.$ret[0]['uid'];

            //send the message, check for errors
            if (!$mail->send()) {
              $user->error['success'] = 1;
              $user->error['message'] = 'Erro no envio do email.';
            } else {
              $user->error['success'] = 0;
              $user->error['message'] = 'O pedido de confirmação da sua conta foi reenviado para o email indicado.';
            }

            $ret = $user->error;
          }

        } else {
          // Error registered
          $ret["success"] = 1;
          $ret["message"] = "An error has occurred while fetching user data.";
        }

        header('Content-Type: application/json');
        print json_encode($ret);
      break;

      case 'getUser':
        //email
        if (isset($_GET['email'])) {
          $email = filter_var($_GET['email'], FILTER_VALIDATE_EMAIL);	

          $ret = $user->getUser($email);

        } else {
          // Error registered
          $ret["success"] = 1;
          $ret["message"] = "An error has occurred while fetching user data.";
        }

        header('Content-Type: application/json');
        print json_encode($ret);
      break;

      case 'prelogin':
        //email
        if (isset($input['email'])) {
          $user->email = $input['email'];	
          $ret = $user->setNewSecret();

          $strong  = true;
          $salt = openssl_random_pseudo_bytes(256, $strong);
          $iv = openssl_random_pseudo_bytes(16, $strong);
          
          $key = $ret['secret']; 
          $iterations = 999; //same as js encrypting 
          $cypherkey = hash_pbkdf2("sha512", $key, $salt, $iterations, 64);
          $enc = openssl_encrypt('Gracadiogo', 'aes-256-cbc', hex2bin($cypherkey), true, $iv);
          $dec = openssl_decrypt($enc, 'aes-256-cbc', hex2bin($cypherkey), true, $iv);

          $ret['salt'] = bin2hex($salt);
          $ret['iv'] = bin2hex($iv);

        } else {
          // Error registered
          $ret["success"] = 1;
          $ret["message"] = "An error has occurred while fetching user data.";
        }

        header('Content-Type: application/json');
        print json_encode($ret);
      break;

      case 'login':
        $user->email = $input['email'];	
        $ret = $user->getUser($user->email);

        $key = $ret[0]['secret'];
// $str = "12345678";

        $jsondata = json_decode($_GET['password'], true);
        try {
            $ciphertext = hex2bin($jsondata["ciphertext"]);
            $salt = hex2bin($jsondata["salt"]);
            $iv  = hex2bin($jsondata["iv"]);          
        } catch(Exception $e) { return null; }

        $iterations = 999; //same as js encrypting 
        $cypherkey = hash_pbkdf2("sha512", $key, $salt, $iterations, 64);

        $a = strlen($iv);
        $b = strlen($cypherkey);
// $enc = openssl_encrypt($str, 'aes-256-cbc', hex2bin($cypherkey), true, $iv);
// $dec = openssl_decrypt($enc, 'aes-256-cbc', hex2bin($cypherkey), true, $iv);
// echo(bin2hex($enc).PHP_EOL);
// var_dump($dec);

        //$ciphertext = base64_decode($jsondata["ciphertext"]);
        
        // $ciphertext = $jsondata["ciphertext"];
        //$ciphertext = $jsondata["ciphertext2"];
        

        

        // $enc = openssl_encrypt($str, 'aes-256-cbc', hex2bin($cypherkey), true, $iv);
        // $dec = openssl_decrypt($enc, 'aes-256-cbc', hex2bin($cypherkey), true, $iv);
        //$key = hash_pbkdf2("sha512", $ret[0]['secret'], $salt, $iterations, 64);

        $decrypted= openssl_decrypt($ciphertext, 'aes-256-cbc', hex2bin($cypherkey), OPENSSL_RAW_DATA, $iv);


// hex2bin($ret[0]['secret'])
        // $keyAndIV = evpKDF($input['password'], $input['salt']);
        // $decrypted = openssl_decrypt($input['password'], 'AES-128-CBC', $keyAndIV["key"], OPENSSL_ZERO_PADDING, $keyAndIV["iv"]);
        /*
        $decryptPassword = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, 
            $keyAndIV["key"], 
            hex2bin($cipherTextHex), 
            MCRYPT_MODE_CBC, 
            $keyAndIV["iv"]);
        */
        $user->password = hash('sha256', $decrypted);
        
        $user->login();

        $ret=array();
    
        if ($user->error['success'] == 0) {
          $ret['authenticate'] = 'true';
          $ret['uid'] = $user->uid;
          $ret['email'] = $user->email;
          $ret['name'] = $user->name;
          $ret['creationdate'] = $user->creationdate;
          $ret['admin'] = $user->admin;

          //Getting Access token
          $data=array(
            'grant_type'    => 'client_credentials',
            'client_id'     => $user->email, 
            'client_secret' => 'thisismysecret'
          );
          $curl = curl_init();
          $url = APIPATH."oauth2/token.php";
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_POST, 1);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $data);       
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          $auth_resp = curl_exec ($curl);
        
          curl_close ($curl);
    
          $auth = json_decode($auth_resp, true); 

          if (isset($auth['access_token'])) {
            $ret['access_token'] = $auth['access_token'];
          } else {
            $ret['success'] = 1;
            $ret['message'] = 'Error while trying to log onto your account.';
          }
        } else {
          $ret['success'] = 1;
          $ret['message'] = 'Estas credenciais não existem nos nossos registos.';
        }

        header('Content-Type: application/json');
        print json_encode($ret);
      break;

      case 'loginfacebook':
      break;

      case 'logingoogle':
      break;

      case 'getUserFromToken':
        $user->token = $input['uid'];
        $ret = $user->getUserFromToken();

        header('Content-Type: application/json');
        print json_encode($ret);
      break;

      default:
        // Invalid Request Method
        $user->error['success'] = 1;
        $user->error['message'] = 'Invalid Transaction';

        header('Content-Type: application/json');
        print json_encode($user->error);
      break;
    }    
  break;

  case 'POST':
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    break;

  case 'PUT':
    // User data
    // print json_encode($input);
    // exit;
    // Put method
    switch ($input['method']) {

      case 'setUser':

        // checking authorization_code
        $auth_code = $input['access_token'];
        $profile = $auth->ValidateAccessToken($auth_code);

        if (isset($profile[0]['email']) && $profile[0]['email']!="") {
            $user->email = filter_var($data['userinfo']['email'], FILTER_VALIDATE_EMAIL);
            $user->taxnumber = filter_var($data['userinfo']['taxnumber'], FILTER_SANITIZE_STRING);
            $user->phonenumber = filter_var($data['userinfo']['phonenumber'], FILTER_SANITIZE_STRING);
            $user->deliveryname = filter_var($data['userinfo']['delivery']['name'], FILTER_SANITIZE_STRING);
            $user->deliverystreet = filter_var($data['userinfo']['delivery']['address'], FILTER_SANITIZE_STRING);
            $user->deliveryzipcode = filter_var($data['userinfo']['delivery']['zip'], FILTER_SANITIZE_STRING);
            $user->deliverycity = filter_var($data['userinfo']['delivery']['city'], FILTER_SANITIZE_STRING);
            $user->invoicename = filter_var($data['userinfo']['invoice']['name'], FILTER_SANITIZE_STRING);
            $user->invoicestreet = filter_var($data['userinfo']['invoice']['address'], FILTER_SANITIZE_STRING);
            $user->invoicezipcode = filter_var($data['userinfo']['invoice']['zip'], FILTER_SANITIZE_STRING);
            $user->invoicecity = filter_var($data['userinfo']['invoice']['city'], FILTER_SANITIZE_STRING);

            $user->setUser();

          } else {
            $user->error['success'] = 1;
            $user->error['message'] = "Input data are not correctly formatted.";
          }
        header('Content-Type: application/json');
        print json_encode($user->error);
      break;

      case 'confirm':
        if (isset($data['password']) && $data['password']!="" &&
            isset($input['uid']) && $input['uid']!=""
            ) {
            $user->token = $input['uid'];
            $user->email = $input['email'];

            $ret = $user->getUser($user->email);

            $key = $ret[0]['secret'];

            $jsondata = json_decode($data['password'], true);
            try {
                $salt = hex2bin($jsondata["salt"]);
                $iv  = hex2bin($jsondata["iv"]);          
            } catch(Exception $e) { return null; }

            $iterations = 999; //same as js encrypting 
            $cypherkey = hash_pbkdf2("sha512", $key, $salt, $iterations, 64);

            $ciphertext = base64_decode($jsondata["ciphertext"]);
            $decrypted= openssl_decrypt($ciphertext, 'aes-256-cbc', hex2bin($cypherkey), OPENSSL_RAW_DATA, $iv);


            $user->password = hash('sha256', $decrypted);
            $user->confirmregistration();

          } else {
            $user->error['success'] = 1;
            $user->error['message'] = "Input data are not correctly formatted.";
          }
        header('Content-Type: application/json');
        print json_encode($user->error);
      break;

      case 'forgetPassword':
        $user->email = $input['email'];	
      
        $user->forgotpassword();

        if (isset($user->error['success']) && $user->error['success'] == 0) {

          $data = $user->getUser($user->email);

          //send email
          if (isset($data[0]['name']) && isset($data[0]['uid']) ) {
            $message = '
<table>
    <tr>
        <td>
            Caro(a) Senhor(a) '.$data[0]['name'].'
            <br/><br/>Este email foi enviado porque pediu a substituição da sua palavra chave. Por favor, faça clique no botão abaixo para reinicializa-la.
            <br/><br/>

            <div>
            <!--[if mso]>
            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://www.whiterabbitcomputers.com/AccountConfirmation/'.$data[0]['uid'].'" style="height:40px;v-text-anchor:middle;width:300px;" arcsize="10%" stroke="f" fillcolor="#E5C41A">
                <w:anchorlock/>
                <center style="color: black;font-family:sans-serif;font-size:16px;font-weight:bold;">
                    Reinicializar Password
                </center>
            </v:roundrect>
            <![endif]-->
            <![if !mso]>
            <table cellspacing="0" cellpadding="0"> <tr> 
            <td align="center" width="300" height="40" bgcolor="#E5C41A" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">
                <a href="https://www.whiterabbitcomputers.com/AccountConfirmation/'.$data[0]['uid'].'" style="font-size:16px; font-weight: bold; font-family:sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block">
                <span style="color: black;">
                    Reinicializar Password
                </span>
                </a>
            </td> 
            </tr> </table> 
            <![endif]>
            </div>
        </td>
    </tr>
</table>';

            //Create a new PHPMailer instance 
            $mail = new PHPMailer();
            $mail->CharSet = 'UTF-8';
            //Set who the message is to be sent from
            $mail->setFrom('account@whiterabbitcomputers.com', 'WhiteRabbitComputers');
            //Set who the message is to be sent to
            $mail->addAddress($data[0]['email'], $data[0]['name']);
            $mail->AddBCC('dadomingues@gmail.com', 'David Domingues');
            //Set the subject line
            $mail->Subject = 'Pedido de substituição da palavra chave';
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            
            $CompleteMessage = $generic->encapsulateMessage($message);

            $mail->MsgHTML($CompleteMessage);
            //Replace the plain text body with one created manually
            $mail->AltBody = 'Link: '.'https://www.whiterabbitcomputers.com/AccountConfirmation/'.$data[0]['uid'];

            //send the message, check for errors
            if (!$mail->send()) {
              $user->error['success'] = 1;
              $user->error['message'] = 'Erro no envio do email.';
            } else {
              $user->error['success'] = 0;
              $user->error['message'] = 'Foram enviadas instruções para a substituição da sua palavra chave para o email indicado.';
            }
          }
        }
        header('Content-Type: application/json');
        print json_encode($user->error);
      break;


      default:
        // Invalid Request Method
        $user->error['success'] = 1;
        $user->error['message'] = 'Invalid Transaction';

        header('Content-Type: application/json');
        print json_encode($user->error);
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