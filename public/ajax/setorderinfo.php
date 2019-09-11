<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");

require_once '../class/orderinfo.class.php';
require_once '../class/user.class.php';
require_once '../class/generic.class.php';
require '../assets/PHPMailer/PHPMailerAutoload.php';

// array for JSON response
$response = array();
$ret = array();	

// include db config class
require_once '../db/db_config.php';
require_once '../db/db_connect.php';
$dbh = new DB_CONNECT($dev=1);
$connection = $dbh->getDb();

$orderinfo = new OrderInfo($connection);
$user = new User($connection);
$generic = new Generic();

if(empty($_POST)) {
  $input = json_decode(file_get_contents("php://input"), TRUE);
} else {
  $input = $_POST;
}

//computerid
if (isset($input))
{
	//Dados do computador
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

  $response["success"] = $orderinfo->error['success'];
  $response["message"] = $orderinfo->error['message'];
  if (isset($orderinfo->error['orderinfoid'])) {
    $response["orderinfoid"] = $orderinfo->error['orderinfoid'];
  } else {
    $response["orderinfoid"] = 0;
  }

  if ($response["orderinfoid"] > 0) {

    //When it is a manual configuration components need to be register one by one
    if ($orderinfo->computerid == 0) {
      foreach ($input['orderinfo']['componentid'] as $componentid) {
        $orderinfo->orderinfoid = $orderinfo->error['orderinfoid'];
        $orderinfo->componentid = $componentid;
        $orderinfo->setOrderInfoDetails();
      }
    }

    $user->token            = $generic->generatecodeupperAZ(20);
    $user->email 			      =	$orderinfo->email;
    $user->name 			      =	$orderinfo->deliveryname;
    $user->taxnumber 		    =	$orderinfo->taxnumber;
    $user->phonenumber 		  =	$orderinfo->phonenumber; 
    $user->admin 		        =	0; 
    $user->status 	        =	0; 
    $user->deliveryname 	  =	$orderinfo->deliveryname; 
    $user->deliverystreet 	=	$orderinfo->deliverystreet;
    $user->deliveryzipcode 	=	$orderinfo->deliveryzipcode; 
    $user->deliverycity 	  =	$orderinfo->deliverycity;
    $user->invoicename 		  =	$orderinfo->invoicename;
    $user->invoicestreet 	  =	$orderinfo->invoicestreet;
    $user->invoicezipcode 	=	$orderinfo->invoicezipcode; 
    $user->invoicecity 	  	=	$orderinfo->invoicecity; 

    //Get User information if exists
    $userdata = $user->getUser($orderinfo->email);

    if (isset($userdata['success'])) {
      $user->register();
    }

    $orderinfo->orderinfoid = $response["orderinfoid"];	
    //Get orderinfo
    $oi = $orderinfo->getOrderinfo();
    //Get orderinfodetails
	  $oidetails = $orderinfo->getOrderinfoDetails();

    //Create a new PHPMailer instance
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    //Set who the message is to be sent from
    $mail->setFrom('account@whiterabbitcomputers.com', 'WhiteRabbitComputers');
    //Set who the message is to be sent to
    $mail->addAddress($orderinfo->email, $orderinfo->deliveryname);
    $mail->AddBCC('dadomingues@gmail.com', 'David Domingues');
    //Set the subject line
    $mail->Subject = 'Confirmação de recepção de encomenda';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body

    $messagecomponents = '';
    foreach($oidetails as $item) {
      $messagecomponents .= $item['description'].'<br/>';
    }
    
    $computerwvatprice = round($orderinfo->computertotalprice - $orderinfo->computervatprice, 2);

    if (isset($userdata['success'])) {

      $messageregistration = '
            <br/>Antes de continuarmos, iremos necessitar da confirmação do seu email e da criação da sua conta. Para isto basta fazer clique no botão seguinte e definir uma password para a sua conta.
            <br/><br/>

            <div>
            <!--[if mso]>
            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://www.whiterabbitcomputers.com/AccountConfirmation/'.$user->token.'" style="height:40px;v-text-anchor:middle;width:300px;" arcsize="10%" stroke="f" fillcolor="#E5C41A">
                <w:anchorlock/>
                <center style="color: black;font-family:sans-serif;font-size:16px;font-weight:bold;">
                    Finalizar o registo
                </center>
            </v:roundrect>
            <![endif]-->
            <![if !mso]>
            <table cellspacing="0" cellpadding="0"> <tr> 
            <td align="center" width="300" height="40" bgcolor="#E5C41A" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">
                <a href="https://www.whiterabbitcomputers.com/AccountConfirmation/'.$user->token.'" style="font-size:16px; font-weight: bold; font-family:sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block">
                <span style="color: black;">
                    Finalizar o registo
                </span>
                </a>
            </td> 
            </tr> </table> 
            <![endif]>
            </div>

            <br/><br/>Assim poderá facilmente seguir o estado da sua encomenda.    
      ';
    } else {
      $messageregistration = '';
    }

    $message = '
<table>
    <tr>
        <td>
            Caro(a) Senhor(a) '.$orderinfo->deliveryname.'
            <br/><br/>É com grande satisfação que recebemos a sua encomenda.'
            .$messageregistration.
            '<br/><br/>Iremos confirmar a disponibilidade dos componentos e enviar o nosso IBAN para permitir o pagamento.
            <br/><br/><strong>Resumo do encomenda</strong>
        </td>
    </tr>
</table>

<!-- Informação detalhada -->

<table>
    <colgroup>
        <col style="width: 60%" />
        <col style="width: 20%" />
        <col style="width: 20%" />
    </colgroup>
    <thead>
        <tr>
            <th style="border: 1px dotted #E5C41A;">Descrição</th>
            <th style="border: 1px dotted #E5C41A; text-align: right">Quantidade</th>
            <th style="border: 1px dotted #E5C41A; text-align: right">Preço</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="border: 1px dotted #E5C41A;">'.$orderinfo->computerdesc.'<br/><br/> '.$messagecomponents.'
            </td>
            <td style="border: 1px dotted #E5C41A; vertical-align: top; text-align: right">'.$orderinfo->computerqtd.'</td>
            <td style="border: 1px dotted #E5C41A; vertical-align: top; text-align: right">'.$computerwvatprice.'</td>
        </tr>
        <tr>
            <td colspan="2" style="border: 1px dotted #E5C41A; text-align: right">IVA</td>
            <td style="border: 1px dotted #E5C41A; text-align: right">'.$orderinfo->computervatprice.'</td>
        </tr>
        <tr>
            <td colspan="2" style="border: 1px dotted #E5C41A; text-align: right">Total</td>
            <td style="border: 1px dotted #E5C41A; text-align: right">'.$orderinfo->computertotalprice.'</td>
        </tr>
    </tbody>
</table>


<!-- linha sem nada -->
<table>
    <tr>
        <td colspan="2">
            &nbsp;
        </td>
    </tr>

    <!-- dados pessoais -->
    <tr>
        <td colspan="2">
            <h3 class="panel-title">Dados da entrega</h3>
        </td>
    </tr>

    <tr>
        <td width="40%"><strong>Email</strong></td>
        <td>
            '.$orderinfo->email.'
        </td>
    </tr>
    <tr>
        <td><strong>NIF</strong></td>
        <td>
            '.$orderinfo->taxnumber.'
        </td>
    </tr>
    <tr>
        <td><strong>Telefone</strong></td>
        <td>
            '.$orderinfo->phonenumber.'
        </td>
    </tr>

    <tr>
        <td><strong>Nome</strong></td>
        <td>
            '.$orderinfo->deliveryname.'
        </td>
    </tr>
    <tr>
        <td><strong>Morada</strong></td>
        <td>
            '.$orderinfo->deliverystreet.'
        </td>
    </tr>
    <tr>
        <td><strong>Código postal</strong></td>
        <td>
            '.$orderinfo->deliveryzipcode.'
        </td>
    </tr>
    <tr>
        <td><strong>Localidade</strong></td>
        <td>
            '.$orderinfo->deliverycity.'
        </td>
    </tr>

    <!-- dados de facturação -->
    <tr class="row panel panel-default">
        <td>
            <h3 class="panel-title">Dados da faturação</h3>
        </td>
    </tr>

    <tr>
        <td><strong>Nome</strong></td>
        <td>
            '.$orderinfo->invoicename.'
        </td>
    </tr>
    <tr>
        <td><strong>Morada</strong></td>
        <td>
            '.$orderinfo->invoicestreet.'
        </td>
    </tr>
    <tr>
        <td><strong>Código postal</strong></td>
        <td>
            '.$orderinfo->invoicezipcode.'
        </td>
    </tr>
    <tr>
        <td><strong>Localidade</strong></td>
        <td>
            '.$orderinfo->invoicecity.'
        </td>
    </tr>
</table>
';
    $CompleteMessage = $generic->encapsulateMessage($message);


    $mail->MsgHTML($CompleteMessage);
    //Replace the plain text body with one created manually
    $mail->AltBody = 'Link: '.'https://www.whiterabbitcomputers.com/registerconfirmation.php?code='.$user->token;

    //send the message, check for errors
    if (!$mail->send()) {
        $response["success"] = 1;
        $response["message"] = "Erro no envio do email.";
    } else {
        $response["success"] = 0;
        $response["message"] = "Encomenda registada com sucesso.";
    }

// $response["success"] = 0;
// $response["message"] = "Encomenda registada com sucesso.";


  }
}
else
{
	// Error registered
	$response["success"] = 1;
	$response["message"] = "An error has occurred while creating order.";
}
$result = array(); 
if (!empty($ret))
	$result = $ret;
else
	$result = $response;

print json_encode($result);
?>