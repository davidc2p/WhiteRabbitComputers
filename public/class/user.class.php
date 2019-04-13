<?php
// ************************************************
// This file has been written by David Domingues
// you are free to use it and change it as you need
// but i will ask you to keep this header on the file
// and never remove it.
// model.class.php downloaded at http://www.webrickco.com
// webrickco@gmail.com
// ************************************************
// PHP Document

class User
{
  	var $hostname;
  	var $database;
	var $admin;
	var $password;
	var $con;
	
	//generic
	var $id;
	var $email;
	var $name;
	var $uadmin;
	var $token;
  	var $phonenumber;
  var $deliveryname;
		var $deliverystreet;
	var $deliveryzipcode;
	var $deliverycity;
  var $invoicename;
	var $invoicestreet;
	var $invoicezipcode;
	var $invoicecity;	
  var $creationdate;

	//Authorization
	var $client_id;
	var $client_secret;
	var $redirect_uri;
	var $grant_types;
	var $scope;
	var $user_id;

	//error
	var $info;
	var $error;
	
	//debug info
	var $debug = '';
	
	
	function __construct($connection) 
	{
		$this->con		  = $connection;
		
		$this->generic = new Generic();
		
		return $this->con;
  }

	/* --------------------------------
	Dealing with Users 
	-----------------------------------*/

    /*
	* login
	*
	* Log the user with supplied credencials
	*
	* @email (string) Email of the user 
	* @password (string) Non hashed password
	* @return (array()) error
	*/
	public function login()
	{
		// get a valid login for this user
		try {
			
			//connect as appropriate as above
			$query=$this->con->prepare("SELECT email, name, phonenumber, taxnumber, uid, admin, status, deliveryname, deliverystreet, deliveryzipcode, deliverycity, invoicename, invoicestreet, invoicezipcode, invoicecity, creationdate
										FROM user  
										WHERE email=:param and pass=:param2");
			$query->bindParam(':param', $this->email);
			$query->bindParam(':param2', $this->password );
			$query->execute();

			$result = $query -> fetch(PDO::FETCH_ASSOC);

		} 
		catch(PDOException $ex) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Erro: '.$ex->getMessage(); //user friendly message
		}

		if (!empty($result)) {
			// check for empty result
			if (count($result) > 0) {
				if ($result['status']==1) {
					$this->email            = $result["email"];
					$this->name             = $result["deliveryname"];
					$this->phonenumber      = $result["phonenumber"];
					$this->taxnumber        = $result["taxnumber"];
					$this->uid              = $result["uid"];
					$this->admin            = $result["admin"];
					$this->status           = $result["status"];
					$this->deliveryname     = $result["deliveryname"];
					$this->deliverystreet   = $result["deliverystreet"];
					$this->deliveryzipcode  = $result["deliveryzipcode"];
					$this->deliverycity     = $result["deliverycity"];
					$this->invoicename      = $result["invoicename"];
					$this->invoicestreet    = $result["invoicestreet"];
					$this->invoicezipcode   = $result["invoicezipcode"];
					$this->invoicecity      = $result["invoicecity"];
					$this->creationdate     = $result["creationdate"];
					// success
					$this->error["success"] = 0;
				} else {
					if ($result['status']==0) {
						$this->error["success"] = 1;
						$this->error["message"] = 'A sua conta ainda não foi confirmada.';
          }
				}
			} else {
				// no login found
				$this->error["success"] = 1;
				$this->error["message"] = 'Este email ou password não existem nos nossos registos.';
			}
		} else {
			// no login found
			$this->error["success"] = 1;
			$this->error["message"] = 'Este email ou password não existem nos nossos registos.';
		}
	}

  /*
	* register
	*
	* Register the user with supplied data
	*
	* @email (string) Email of the user 
	* @phonenumber (string) Phone Number
    * @taxnumber (string) NIF
    * @uid (string) 20 caracteres alfa
    * @pass (string) Non hashed password
    * @admin (int) 0: Site user; 1: admin
    * @status (int) 0: inactive; 1: active
    * @deliveryname (string) Delivery customer name
    * @deliverystreet (string) Delivery street
    * @deliveryzipcode (string) Delivery zip code
    * @deliverycity (string) Delivery city
    * @invoicename (string) Invoice customer name
    * @invoicestreet (string) Invoice street
    * @invoicezipcode (string) Invoice zip code
    * @invoicecity (string) Invoice city
	* @return (array()) error
	*/
	public function register()
   	{
		try{
			// Check if exists
			$query=$this->con->prepare("SELECT * FROM user WHERE email=:email");
			$query->bindParam(':email', $this->email);
			$query->execute();
			
			$result = $query -> fetch(PDO::FETCH_ASSOC);

			// check for empty result
			if (isset($result) && isset($result['email'])) {
				// user found - already registered
				$this->error['success'] = 1;
				$this->error['message'] = 'Esta email já se encontra registado.';

			} else {
									
				$this->con->beginTransaction();
// print '<br><br><br><br><br><br><br><br><br>email: '.$this->email;				
// print '<br>name: '.$this->name;				
// print '<br>uid: '.$this->token;				
// print '<br>companyid: '.$this->companyid;				
// print '<br>uadmin: '.$this->uadmin;				
// print '<br>password: '.SHA1($this->password);		

				// inserting new user
				$query = $this->con->prepare("
                INSERT INTO user(email, name, phonenumber, taxnumber, uid, pass, admin, status, deliveryname, deliverystreet, deliveryzipcode, deliverycity, invoicename, invoicestreet, invoicezipcode, invoicecity, creationdate) 
                VALUES (:email, :name, :phonenumber, :taxnumber, :uid, :pass, :admin, :status, :deliveryname, :deliverystreet, :deliveryzipcode, :deliverycity, :invoicename, :invoicestreet, :invoicezipcode, :invoicecity, CURRENT_TIMESTAMP)
                ");

				$result = $query->execute(array(
					"email" 		        => $this->email,
					"name" 		  	        => $this->name,
					"phonenumber" 	        => $this->phonenumber,
					"taxnumber" 	        => $this->taxnumber,
					"uid" 	                => $this->token,
					"pass" 		            => '',
					"admin" 		        => $this->admin,
					"status" 		        => $this->status,
					"deliveryname" 		    => $this->deliveryname,
					"deliverystreet" 		=> $this->deliverystreet,
					"deliveryzipcode" 	    => $this->deliveryzipcode,
					"deliverycity" 		    => $this->deliverycity,
					"invoicename" 		    => $this->invoicename,
					"invoicestreet" 		=> $this->invoicestreet,
					"invoicezipcode" 		=> $this->invoicezipcode,
					"invoicecity" 		    => $this->invoicecity
				));

				if (!$result) {
					$this->error['success'] = 1;
					$this->error['message'] = 'Ocorreu um erro no registo do utilizador.';
					$this->con->rollBack();
				} else {
        
                    //authorization
                    $this->client_id 		= $this->email;
                    $this->client_secret 	= 'thisismysecret';
                    $this->redirect_uri		= 'http://127.0.0.1:8080/my-oauth2-walkthrough/error.php';
                    $this->grant_types		= 'refresh_token password client_credentials';
                    $this->scope			= null;
                    $this->user_id		= null;
                    $ret = $this->registeroauth();

                    $this->error['success'] = 0;
                    $this->error['message'] = 'Criação com sucesso do utilizador';

                    $this->con->commit();
				}
			}
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
			$this->con->rollBack();
		}
  }
	
	public function registeroauth()
	{
	 	try {
			 // inserting authorization
			 $query = $this->con->prepare("INSERT INTO oauth_clients(client_id, client_secret, redirect_uri, grant_types, scope, user_id) VALUES(:client_id, :client_secret, :redirect_uri, :grant_types, :scope, :user_id)");
			 $result = $query->execute(array(
				 "client_id" 		    => $this->client_id,
				 "client_secret" 	    => $this->client_secret,
				 "redirect_uri" 	    => $this->redirect_uri,
				 "grant_types" 		    => $this->grant_types,
				 "scope" 			    => $this->scope,
				 "user_id" 			    => $this->user_id
			 ));

			 if (!$result) {
				 $this->error['success'] = 1;
				 $this->error['message'] = 'Utilizador inválido.';
			 } else {
				 $this->error['success'] = 0;
				 $this->error['message'] = 'Utilizador criado com sucesso.';
			 }
	
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
 	}


    /*
	* forgotpassword
	*
	* Update the old password with a new password
	*
	* @email (string) Email of the user 
	* @password (string) Non hashed password
	* @return (array()) error
	*/
	public function forgotpassword()
    {
		try {
			// Check if exists
			$query=$this->con->prepare("SELECT * FROM user WHERE email=:email");
			$query->bindParam(':email', $this->email);
			$query->execute();
			
			$result = $query -> fetch(PDO::FETCH_ASSOC);

			// check for empty result
			if (!isset($result['email'])) {
		
				// user not found - not registered
				$this->error['success'] = 1;
				$this->error['message'] = 'Este utilizador não existe.';

			} else {
				
				$this->token = $this->generic->generatecodeupperAZ(20);
		
				// UPDATING user token; clearing password
				$query = $this->con->prepare("UPDATE user SET uid=:uid, status = 0 WHERE email = :email");
				$result = $query->execute(array(
					"email" 		=> $this->email,
					"uid" 			=> $this->token
				));

				if (!$result) {
					$this->error['success'] = 1;
					$this->error['message'] = 'Este utilizador é inválido.';
				} else {
					$this->error['success'] = 0;
					$this->error['message'] = 'O utilizador foi actualizado com sucesso.';
				}
			} 
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
    }

    /*
	* confirmregistration
	*
	* Update status from 0 to 1 from token value and register the hashed password
	*
	* @token (string) Token of the user account
	* @password (string) Non hashed password
	* @return (array()) error
	*/
	public function confirmregistration()
	{
		$ret = array();

		try{
			// Check if exists
			$query=$this->con->prepare("SELECT * FROM user WHERE uid=:token");
			$query->bindParam(':token', $this->token);
			$query->execute();
			
			$result = $query -> fetch(PDO::FETCH_ASSOC);
			$this->email = $result['email'];
			
			// check for empty result
			if (empty($result)) {
				// user not found - nothing to confirm
				$this->error['success'] = 1;
				$this->error['message'] = 'Não existe utilizador registado com este token.';
				$ret = $this->error;
				
			} else {
				if (!empty($result) && count($result) > 0 && $result['status'] == 1) {
			
					// user found - but already confirmed
					$this->error['success'] = 1;
					$this->error['message'] = 'Este utilizador já se encontra confirmado.';
					$ret = $this->error;

				} else {
					
					// updating the user
					$query = $this->con->prepare("UPDATE user SET status = 1, pass = :pass WHERE uid = :token");
					$result = $query->execute(array(
						"pass" 			=> $this->password,
						"token" 		=> $this->token
					));

					if (!$result) {
						$this->error['success'] = 1;
						$this->error['message'] = 'Aconteceu um erro na confirmação do registo do utilizador.';  
						$ret = $this->error;

					} else {
						$this->error['success'] = 0;
						$this->error['message'] = 'A conta foi confirmada com sucesso.';
						$ret = $this->error;
					}
				}
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
	* setNewSecret
	*
	* update the secret key with a new hashed value
	*
	* @email (string) Email of the user account
	* @return (array()) error
	*/
	public function setNewSecret()
	{
		$ret = array();

		try{
			// Check if exists
			$query=$this->con->prepare("SELECT * FROM user WHERE email=:email");
			$query->bindParam(':email', $this->email);
			$query->execute();
			
			$result = $query -> fetch(PDO::FETCH_ASSOC);
			
			// check for empty result
			if (empty($result)) {
				// user not found - nothing to confirm
				$this->error['success'] = 1;
				$this->error['message'] = 'Não existe utilizador registado com este email.';
				$ret = $this->error;
				
			} else {
				
				// updating the user
                $this->token = $this->generic->generatecodeupperAZ(20);
                $query = $this->con->prepare("UPDATE user SET secret = :token WHERE email = :email");
                $result = $query->execute(array(
                    "token" 		=> $this->token,
                    "email" 		=> $this->email
                ));

                if (!$result) {
                    $this->error['success'] = 1;
                    $this->error['message'] = 'Aconteceu um erro na tentativa de login do utilizador.';  
                    $ret = $this->error;

                } else {
                    $this->error['success'] = 0;
                    $this->error['message'] = 'Secret gerado com sucesso.';
                    $this->error['secret'] = $this->token;
                    $ret = $this->error;
                }
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
	* passwordregistration
	*
	* Update the hashed password from token value
	*
	* @token (string) Token of the user account
	* @password (string) Non hashed password
	* @return (array()) error
	*/
	public function passwordregistration()
	{
		$ret = array();

		try{
			// Check if exists
			$query=$this->con->prepare("SELECT * FROM user WHERE uid=:token");
			$query->bindParam(':token', $this->token);
			$query->execute();
			
			$result = $query -> fetch(PDO::FETCH_ASSOC);
			$this->email = $result['email'];
			
			// check for empty result
			if (empty($result)) {
				// user not found - nothing to confirm
				$this->error['success'] = 1;
				$this->error['message'] = 'Este utilizador não existe.';
				$ret = $this->error;
				
			} else {
					
				// updating the user
				$query = $this->con->prepare("UPDATE user SET pass = :pass WHERE uid = :token");
				$result = $query->execute(array(
					"pass" 			=> SHA1($this->password),
					"token" 		=> $this->token
				));

				if (!$result) {
					$this->error['success'] = 1;
					$this->error['message'] = 'Aconteceu um erro na actualização do utilizador.';  
					$ret = $this->error;

				} else {
					$this->error['success'] = 0;
					$this->error['message'] = 'A actualização do utilizador foi efectuada com sucesso.';
					$ret = $this->error;
				}

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
	* changeUserStatus
	*
	* set the status information for the user identified by email: 0: disable; 1: enable
	* status of admin cannot be altered
	*
	* @email (string) Email of the user 
	* @status (int) 0: disable; 1: enable
	* @return (array()) error
	*/
	public function changeUserStatus($newstatus) {
		$ret = array();

		try{
			// updating user status
			$query = $this->con->prepare("UPDATE user SET status = :status WHERE email=:email");
			$result = $query->execute(array(
				"email" 		=> $this->email,
				"status" 		=> $newstatus
			));

			if (!$result) {
				$this->error['success'] = 1;
				$this->error['message'] =  $this->trans['changeuserstatuserror'];
				$ret = $this->error;
			} else {
				$this->error['success'] = 0;
				$this->error['message'] = $this->trans['changeuserstatusinfo']; 
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
	
	public function getUser($email) 
	{
		$ret = array();
		
		try {
			//fetching user most basic data
			$query=$this->con->prepare("SELECT email, name, phonenumber, taxnumber, uid, admin, status, deliveryname, deliverystreet, deliveryzipcode, deliverycity, invoicename, invoicestreet, invoicezipcode, invoicecity, creationdate, secret
										FROM user 
										WHERE email = :email");
			$query->bindParam(':email', $email);
			$query->execute();
			
			$ms = $query->fetch(PDO::FETCH_ASSOC);
			if ($ms) {
				while ($ms) {
					array_push($ret, $ms);
					$ms = $query->fetch(PDO::FETCH_ASSOC);
				}
			}
			else {
				$this->error["success"] = 1;
				$this->error["message"] = 'Erro na consulta do utilizador.';
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Erro na consulta do utilizador.';
			$ret = $this->error;
		}
		
		return $ret;
	}

	public function getUserFromToken() 
	{
		$ret = array();
		
		try {
			//fetching user from existing token
			$query=$this->con->prepare("SELECT email, name, phonenumber, taxnumber, uid, pass, admin, status, deliveryname, deliverystreet, deliveryzipcode, deliverycity, invoicename, invoicestreet, invoicezipcode, invoicecity, creationdate
										FROM user
										WHERE uid = :token");
			$query->bindParam(':token', $this->token);
			$query->execute();
			
			$ms = $query->fetch(PDO::FETCH_ASSOC);
			if ($ms) {
				while ($ms) {
					array_push($ret, $ms);
					$ms = $query->fetch(PDO::FETCH_ASSOC);
				}
			}
			else {
				$this->error["success"] = 1;
				$this->error["message"] = 'Aconteceu um erro na consulta do utilizador.';
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Aconteceu um erro na consulta do utilizador.';
			$ret = $this->error;
		}
		
		return $ret;
	}


	public function setUser()
   	{
		try{
			// Check if exists
			$query=$this->con->prepare("SELECT * FROM user WHERE email=:email");
			$query->bindParam(':email', $this->email);
			$query->execute();
			
			$result = $query -> fetch(PDO::FETCH_ASSOC);
			
			// check for empty result
			if (empty($result)) {
		
				// user found - already registered
				$this->error['success'] = 1;
				$this->error['message'] = 'Este utilizador não existe.'; 

			} else {
				
				// updating user
  			$query = $this->con->prepare("UPDATE user 
                                        SET name = :deliveryname, 
                                            phonenumber = :phonenumber, 
                                            taxnumber = :taxnumber, 
                                            deliveryname = :deliveryname, 
                                            deliverystreet = :deliverystreet, 
                                            deliveryzipcode = :deliveryzipcode, 
                                            deliverycity = :deliverycity, 
                                            invoicename = :invoicename, 
                                            invoicestreet = :invoicestreet, 
                                            invoicezipcode = :invoicezipcode, 
                                            invoicecity = :invoicecity
                                      WHERE email = :email");
				$result = $query->execute(array(
					"email" 	          => $this->email,
					"phonenumber" 	    => $this->phonenumber,
					"taxnumber"	        => $this->taxnumber,
					"deliveryname" 	    => $this->deliveryname,
					"deliverystreet" 	  => $this->deliverystreet,
					"deliveryzipcode" 	=> $this->deliveryzipcode,
					"deliverycity" 	    => $this->deliverycity,
					"invoicename" 	    => $this->invoicename,
					"invoicestreet" 	  => $this->invoicestreet,
					"invoicezipcode" 	  => $this->invoicezipcode,
					"invoicecity" 	    => $this->invoicecity
				));

        if (!$result) {
					$this->error['success'] = 1;
					$this->error['message'] = 'Ocorreu um erro na actualização do utilizador.'; 
				} else {
					$this->error['success'] = 0;
					$this->error['message'] = 'Os seus dados foram atualizados com sucesso.'; 
				}
			} 
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
  }
}

?>