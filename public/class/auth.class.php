<?php
// ************************************************
// This file has been written by David Domingues
// you are free to use it and change it as you need
// but i will ask you to keep this header on the file
// and never remove it.
// auth.class.php downloaded at http://www.webrickco.com
// webrickco@gmail.com
// ************************************************
// PHP Document

class Auth
{
	var $prefix;
	var $con;
	
  //generic
  var $generic;
  var $translation;
	var $access_token;
	var $email;
	var $trans;

	//Company
	var $companyid;
	var $companynumber;
	var $companyaddress;
	var $companyzip;
	var $companycity;
	var $companyname;
	var $taxbehaviour;

	//Translation
	var $lang;
	var $page;
	var $field;
	var $value;

    //error
	var $info;
	var $error;
	
	//debug info
	var $debug = '';

	
	function __construct($connection) 
	{
    $this->con = $connection;

		$this->generic = new Generic();

		return $this->con;
    }
	//--------------
	// Authorization
  //--------------
  /*
	* ValidateAccessToken
	*
	* returns an array with Customer information
	*
	* @access_token (string) Token ID
	* @return (company data/false)
	*/
	public function ValidateAccessToken($access_token) 
	{
    $ret = array();
    require_once 'user.class.php';
    $this->trans['validatetokenexpirederror'] = 'Token has expired';
    $this->trans['validatetokenerror'] = 'Invalid token';
    try {
        if (isset($access_token)) {
            //validate access token
            $query = $this->con->prepare("SELECT access_token, client_id, expires 
                                          FROM oauth_access_tokens 
                                          WHERE access_token = :accesstoken");
            $query->bindParam(':accesstoken', $access_token);
            $query->execute();
  
            $ms = $query->fetch(PDO::FETCH_ASSOC);
            if ($ms) {
                if ($ms['expires'] < date("Y-m-d H:i:s")) {
                    //Expired
                    $this->error['success'] = 1;
                    $this->error['message'] = $this->trans['validatetokenexpirederror']; 
                    $ret = $this->error;
                } else {
                    $ret = (new User($this->con))->getUser($ms['client_id']);
                }
            } else {
                $this->error['success'] = 1;
                $this->error['message'] = $this->trans['validatetokenerror']; 
                $ret = $this->error;
            }
        } else {
          $this->error['success'] = 1;
          $this->error['message'] ='Token não foi enviado.'; 
          $ret = $this->error;
        }
    }
    catch(PDOException $ex) {
        $this->error['success'] = 1;
        $this->error['message'] = $ex->getMessage();
        $ret = $this->error;
    }
    return $ret;
  }

  /*
	* CreateAccessToken
	*
	* returns an array with Token information
	*
	* @access_token (string) Token ID
	* @return (company data/false)
	*/

	public function CreateAccessToken($client_id, $client_secret) 
	{
    require_once '../db/db_config.php';
    try {
      $data=array(
        'grant_type'    => 'client_credentials',
        'client_id'     => $client_id,
        'client_secret' => $client_secret
      );
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, APIPATH."oauth2/token.php");
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);    
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $auth_resp = curl_exec ($curl);

      curl_close ($curl);
      $ret = json_decode($auth_resp, true);  
    }
    catch(PDOException $ex) {
        $this->error['success'] = 1;
        $this->error['message'] = $ex->getMessage();
        $ret = $this->error;
    }
    return $ret;
  }
}

?>