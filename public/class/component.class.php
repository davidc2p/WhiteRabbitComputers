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

class Component
{
  var $hostname;
  var $database;
	var $admin;
	var $password;
	var $prefix;
	var $con;
	
	//generic
	var $id;
	var $type;
	var $description;
	var $cost;
	var $link;
	var $image;
	
    //error
	var $info;
	var $error;
	
	
	//debug info
	var $debug = '';
	
	
	function __construct($connection) 
	{
		$this->con 			= $connection;

		$this->generic = new Generic();

		return $this->con;
    }

	// ----------
	// COMPONENTS
	// ----------
	public function getComponent()
	{
		$ret = array();
		
		try {
			//fetching all component from a single type
			$query=$this->con->prepare("SELECT * FROM component where id = :id");
			$query->bindParam(':id', $this->id);
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
				$this->error["message"] = 'Ocorreu um erro na consulta de componentos.';
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Ocorreu um erro na consulta de componentos.';
			$ret = $this->error;
		}
		
		return $ret;		
	}


	public function getComponents()
	{
		$ret = array();
		
		try {
			//fetching all component from a single type
			if (isset($this->type)) {
				$query=$this->con->prepare("SELECT * FROM component where type = :type");
				$query->bindParam(':type', $this->type);
			} else {
				$query=$this->con->prepare("SELECT * FROM component");
			}
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
				$this->error["message"] = 'Ocorreu um erro na consulta de componentes.';
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Ocorreu um erro na consulta de componentes.';
			$ret = $this->error;
		}
		
		return $ret;		
	}

	public function getComponentsWithPagination($pagenumber, $itemsperpage)
	{
		$ret = array();
		$offset = ($pagenumber - 1) * $itemsperpage;
		$itemsperpage = intval($itemsperpage);
		try {
			//fetching all components
      if (isset($this->type)) {
        $query=$this->con->prepare("SELECT c.*, pcount.totalitems 
                      FROM component c
                      INNER JOIN (SELECT type, count(*) as totalitems FROM component GROUP BY type) pcount
                      ON pcount.type = c.type
                      WHERE c.type = :type
                      ORDER BY c.description
                      limit :offset, :itemsperpage");
        $query->bindParam(':type', $this->type);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->bindParam(':itemsperpage', $itemsperpage, PDO::PARAM_INT);
      } else {
        $query=$this->con->prepare("SELECT c.*, pcount.totalitems 
                      FROM component c
                      INNER JOIN (SELECT count(*) as totalitems FROM component) pcount
                      ON 1=1
                      ORDER BY c.type, c.description
                      limit :offset, :itemsperpage");
          $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->bindParam(':itemsperpage', $itemsperpage, PDO::PARAM_INT);
      }
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
				$this->error["message"] = 'Ocorreu um erro na consulta de componentos.';
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Ocorreu um erro na consulta de componentos.';
			$ret = $this->error;
		}
		
		return $ret;		
	}

	public function parseCost()
	{
		$ret = array();
		
		try {
			//fetching all component from a single type
			$query=$this->con->prepare("SELECT * FROM component where id = :id");
			$query->bindParam(':id', $this->id);
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
				$this->error["message"] = 'Ocorreu um erro na consulta de componentos.';
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Ocorreu um erro na consulta de componentos.';
			$ret = $this->error;
		}
		
		return $ret;		
	}

	public function updateComponent()
   	{
		try{
			if ( 
				isset($this->id) && $this->id!="" &&
				isset($this->type) && $this->type!="" &&
				isset($this->description) && $this->description!="" &&
				isset($this->cost) && $this->cost!="" &&
				isset($this->link) && $this->link!="" &&
				isset($this->image) && $this->image!=""
				) {
				//updating tax data
				$query = $this->con->prepare("UPDATE component SET type = :type, description = :description, cost = :cost, link = :link, image = :image 
											  WHERE id=:id");
				$result = $query->execute(array(
					"type" 						=> $this->type,
					"description" 		=> $this->description,
					"cost" 						=> $this->cost,
					"image" 					=> $this->image,
					"link" 						=> $this->link,
					"id" 							=> $this->id
				));

				if (!$result) {
					$this->error['success'] = 1;
					$this->error['message'] = 'Ocorreu um erro na alteração do componente.';
				} else {
					$this->error['success'] = 0;
					$this->error['message'] = 'Componente alterado com sucesso.'; 
				}
			}
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
    }

	public function deleteComponent()
  {
		try{
			if (
				isset($this->id) && $this->id!=""
				) {
					//delete tax data
					$query = $this->con->prepare("DELETE FROM component 
												WHERE id=:id");
					$result = $query->execute(array(
						"id" 				=> $this->id
					));

					if (!$result) {
						$this->error['success'] = 1;
						$this->error['message'] = 'Ocorreu um erro na supressão do componente.'; 
					} else {
						$this->error['success'] = 0;
						$this->error['message'] = 'Componente suprimido com sucesso.';
					}
				}
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
  }

	public function setComponent()
  {
		try{
			if (
				isset($this->type) && $this->type!="" &&
				isset($this->description) && $this->description!="" &&
				isset($this->cost) && $this->cost!="" &&
				isset($this->link) && $this->link!="" &&
				isset($this->image) && $this->image!=""
				) {
				//inserting tax data
				$query = $this->con->prepare("INSERT INTO component (type, description, cost, link, image) 
											  VALUES (:type, :description, :cost, :link, :image)");
				$result = $query->execute(array(
					"type" 					=> $this->type,
					"description" 	=> $this->description,
					"cost" 					=> $this->cost,
					"link" 					=> $this->link,
					"image" 				=> $this->image
				));

				if (!$result) {
					$this->error['success'] = 1;
					$this->error['message'] = 'Ocorreu um erro na criação do componente.';  
				} else {
					$this->error['success'] = 0;
					$this->error['message'] = 'Componente criado com sucesso.'; 
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