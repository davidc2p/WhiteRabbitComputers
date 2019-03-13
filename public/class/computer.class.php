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

class Computer
{
  	var $hostname;
  	var $database;
	var $admin;
	var $password;
	var $prefix;
	var $con;
	
	//computer
	var $computerid;
	var $description;
	var $cost;

	//error
	var $info;
	var $error;
	
	
	//debug info
	var $debug = '';
	
	
  	function __construct($connection) 
	{
		$this->con		  = $connection;

		return $this->con;
  	}


	//--------
	//Computer
	//--------
	public function getComputer()
	{
		$ret = array();
		
		try {
			//fetching all drivers of a company
			$query=$this->con->prepare("SELECT c.*
                                  FROM computer c
                                  where c.id = :id");
     		$query->bindParam(':id', $this->computerid);
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
				$this->error["message"] = 'Este computador não existe!';
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Ocorreu um erro na pesquisa das informação do computador!';
			$ret = $this->error;
		}
		
		return $ret;		
	}

	public function getComputers()
	{
		$ret = array();
		
		try {
			//fetching all drivers of a company
			$query=$this->con->prepare("SELECT *
                                  FROM computer");
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
				$this->error["message"] = 'Não estão configurados nenhum computadores!';
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Ocorreu um erro na pesquisa das informação do computador!';
			$ret = $this->error;
		}
		
		return $ret;		
	}

	//----------------
	//Computer details
	//----------------
	public function getComputerDetails()
	{
		$ret = array();
		
		try {
			//fetching all drivers of a company
			$query=$this->con->prepare("SELECT c.id as computerid, c.description as computerdescription, c.price, co.*, cc.ordering
                                  FROM computer c
                                  INNER JOIN computercomponents cc
                                  ON cc.computerid = c.id
                                  INNER JOIN component co
                                  ON co.id = cc.componentid
                                  where c.id = :id
                                  order by cc.ordering");
      		$query->bindParam(':id', $this->computerid);
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
				$this->error["message"] = 'Este computador não existe!';
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Ocorreu um erro na pesquisa das informação do computador!';
			$ret = $this->error;
		}
		
		return $ret;		
	}

}

?>