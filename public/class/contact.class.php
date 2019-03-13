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

class Contact
{
  var $hostname;
  var $database;
	var $admin;
	var $password;
	var $prefix;
	var $con;
	
	//generic
	var $id;
  var $email;
  var $name;
  var $subject;
  var $message;

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

	//-------
	//Contact
	//-------
	public function getContact()
	{
		$ret = array();
		
		try {
			//fetching all contacts
			$query=$this->con->prepare("SELECT * FROM contact");
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
				$this->error["message"] = 'Erro na pesquisa dos contactos.';
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Erro na pesquisa dos contactos.';
			$ret = $this->error;
		}
		
		return $ret;		
	}

	public function setContact()
   	{
		try{
			if (isset($this->email) && $this->email!="" &&
			    isset($this->name) && $this->name!="" &&
			    isset($this->subject) && $this->subject!="" &&
			    isset($this->message) && $this->message!=""
      ) {
				
				//inserting a new contact
				$query = $this->con->prepare("INSERT INTO contact (email, name, subject, message) 
											  VALUES (:email, :name, :subject, :message)");
				$result = $query->execute(array(
					"email" 			=> $this->email,
					"name" 		    => $this->name,
					"subject" 	  => $this->subject,
					"message"		 	=> $this->message
				));

				if (!$result) {
					$this->error['success'] = 1;
					$this->error['message'] = 'Ocorreu um erro na inserção do contacto.'; 
				} else {
					$this->error['success'] = 0;
					$this->error['message'] = 'Contacto inserido com sucesso.'; 
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