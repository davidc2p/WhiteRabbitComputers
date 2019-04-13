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
	var $id;
	var $description;
	var $longdesc;
	var $price;
	var $netprice;
	var $image;
	var $configuration;

	//computercomponents
	var $computerid;
	var $componentid;


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
			//fetching all computers
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

    public function getComputersWithPagination($pagenumber, $itemsperpage)
	{
		$ret = array();
		$offset = ($pagenumber - 1) * $itemsperpage;
		$itemsperpage = intval($itemsperpage);
		try {
			//fetching all computers
            $query=$this->con->prepare("SELECT c.*, pcount.totalitems 
                      FROM computer c
                      INNER JOIN (SELECT count(*) as totalitems FROM computer) pcount
                      ON 1=1
                      ORDER BY c.description
                      limit :offset, :itemsperpage");
            $query->bindParam(':offset', $offset, PDO::PARAM_INT);
            $query->bindParam(':itemsperpage', $itemsperpage, PDO::PARAM_INT);

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
				$this->error["message"] = 'Ocorreu um erro na consulta de computadores.';
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Ocorreu um erro na consulta de computadores.';
			$ret = $this->error;
		}
		
		return $ret;		
	}

	public function updateComputer()
   	{
		try{
			if ( 
				isset($this->id) && $this->id!="" &&
				isset($this->description) && $this->description!="" &&
				isset($this->longdesc) && $this->longdesc!="" &&
				isset($this->price) && $this->price!="" &&
				isset($this->netprice) && $this->netprice!="" &&
				isset($this->image) && $this->image!=""
				) {
				//updating tax data
				$query = $this->con->prepare("UPDATE computer 
												SET description = :description, 
												longdesc = :longdesc, 
												price = :price, 
												netprice = :netprice, 
												image = :image 
											  WHERE id=:id");
				$result = $query->execute(array(
					"description" 			=> $this->description,
					"longdesc" 				=> $this->longdesc,
					"price" 				=> $this->price,
					"image" 				=> $this->image,
					"netprice" 				=> $this->netprice,
					"id" 					=> $this->id
				));

				if (!$result) {
					$this->error['success'] = 1;
					$this->error['message'] = 'Ocorreu um erro na alteração do computador.';
				} else {
					$this->error['success'] = 0;
					$this->error['message'] = 'Computador alterado com sucesso.'; 
				}
			}
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
  }

	public function deleteComputer()
  {
		try{
			if (
				isset($this->id) && $this->id!=""
				) {
					//delete tax data
					$query = $this->con->prepare("DELETE FROM computer 
												WHERE id=:id");
					$result = $query->execute(array(
						"id" 				=> $this->id
					));

					if (!$result) {
						$this->error['success'] = 1;
						$this->error['message'] = 'Ocorreu um erro na supressão do computador.'; 
					} else {
						$this->error['success'] = 0;
						$this->error['message'] = 'Computador suprimido com sucesso.';
					}
				}
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
  }

	public function setComputer()
  	{
		try{
			if (
				isset($this->description) && $this->description!="" &&
				isset($this->longdesc) && $this->longdesc!="" &&
				isset($this->price) && $this->price!="" &&
				isset($this->netprice) && $this->netprice!="" &&
				isset($this->image) && $this->image!=""
				) {
				//inserting tax data
				$query = $this->con->prepare("INSERT INTO computer (description, longdesc, price, netprice, image) 
											  VALUES (:description, :longdesc, :price, :netprice, :image)");
				$result = $query->execute(array(
					"description" 			=> $this->description,
					"longdesc" 				=> $this->longdesc,
					"price" 				=> $this->price,
					"netprice" 				=> $this->netprice,
					"image" 				=> $this->image
				));

				if (!$result) {
					$this->error['success'] = 1;
					$this->error['message'] = 'Ocorreu um erro na criação do computador.';  
				} else {
					$this->computerid = $this->con->lastInsertId();
					$this->error['success'] = 0;
					$this->error['message'] = 'Computador criado com sucesso.'; 
					
					$this->con->beginTransaction();

					if ($this->error['success'] == 0) {

						$this->computerid = $this->computerid;
						$this->deleteComputerDetails();
						
						if ($this->error['success'] == 0) {
							foreach($this->configuration as $item) {
								
								$this->computerid = $this->computerid;
								$this->componentid = $item['id'];
								$this->setComputerDetails();

							}

							$this->con->commit();

						} else {
							$this->con->rollBack();
						}        
					} else {
						$this->con->rollBack();
					}
				}
			}
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
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


	public function deleteComputerDetails()
  	{
		try{
			if (
				isset($this->computerid) && $this->computerid!=""
				) {
					//delete tax data
					$query = $this->con->prepare("DELETE FROM computercomponents 
												WHERE computerid=:computerid");
					$result = $query->execute(array(
						"computerid" 			=> $this->computerid
					));

					if (!$result) {
						$this->error['success'] = 1;
						$this->error['message'] = 'Ocorreu um erro na supressão da configuração.'; 
					} else {
						$this->error['success'] = 0;
						$this->error['message'] = 'Configuração suprimida com sucesso.';
					}
				}
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
  	}

	public function setComputerDetails()
  	{
		try{
			if (
				isset($this->computerid) && $this->computerid!="" &&
				isset($this->componentid) && $this->componentid!="" 
				) {
				//fetching last order info
				$query=$this->con->prepare("SELECT computerid, MAX(IFNULL(ordering, 0) as ordering
									FROM computercomponents 
									where computerid = :computerid
									GROUP BY computerid");
				$query->bindParam(':computerid', $this->computerid);
				$query->execute();
			
				$ms = $query->fetch(PDO::FETCH_ASSOC);


				//inserting tax data
				$query = $this->con->prepare("INSERT INTO computercomponents (computerid, componentid, qtd, ordering) 
											  VALUES (:computerid, :componentid, 1, :ordering)");
				$result = $query->execute(array(
					"computerid" 			=> $this->computerid,
					"componentid" 			=> $this->componentid,
					"ordering" 				=> $ms['ordering'] + 1
				));

				if (!$result) {
					$this->error['success'] = 1;
					$this->error['message'] = 'Ocorreu um erro na criação da configuração.';  
				} else {
					$this->error['success'] = 0;
					$this->error['message'] = 'Configuração criada com sucesso.'; 
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