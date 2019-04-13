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

class OrderInfo
{
  var $hostname;
  var $database;
	var $admin;
	var $password;
	var $prefix;
	var $con;
	
	//computer
	var $computerid;
	var $computerdesc;
	var $computercost;	
	var $computerprice;
	var $computerqtd;
	var $computervatprice;
	var $computertotalprice;

  //Customer
  var $phonenumber;
	var $taxnumber;

  //Component
  var $componentid;

  //Delivery
  var $orderinfoid;
  var $deliveryname;
	var $deliverystreet;
	var $deliveryzipcode;
	var $deliverycity;
  var $invoicename;
	var $invoicestreet;
	var $invoicezipcode;
	var $invoicecity;
  var $status;

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


  //---------
  //OrderInfo
  //---------
  public function getOrderInfo()
	{
		$ret = array();
		
		try {
			//fetching all drivers of a company
			$query=$this->con->prepare("SELECT *
                                  FROM orderinfo 
                                  where id = :orderinfoid");
      $query->bindParam(':orderinfoid', $this->orderinfoid);
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
				$this->error["message"] = 'Esta nota de encomenda não existe!';
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Ocorreu um erro na pesquisa das informação da nota de encomenda!';
			$ret = $this->error;
		}
		
		return $ret;		
	}

  public function getAllOrderInfo($status=false)
	{
		$ret = array();
		
		try {
			//fetching all orderinfo by status
      if ($status) {
        $query=$this->con->prepare("SELECT *
                                  FROM orderinfo 
                                  where status = :status");  
        $query->bindParam(':status', $status);
      } else {
        $query=$this->con->prepare("SELECT *
                                  FROM orderinfo");
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
				$this->error["message"] = 'Esta nota de encomenda não existe!';
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Ocorreu um erro na pesquisa das informação da nota de encomenda!';
			$ret = $this->error;
		}
		
		return $ret;		
	}

	public function getOrderInfoWithPagination($pagenumber, $itemsperpage)
	{
		$ret = array();
		$offset = ($pagenumber - 1) * $itemsperpage;
		$itemsperpage = intval($itemsperpage);
		try {
			//fetching all components
      if (isset($this->status)) {
        $query=$this->con->prepare("SELECT oi.*, oicount.totalitems 
                      FROM orderinfo oi
                      INNER JOIN (SELECT status, count(*) as totalitems FROM orderinfo GROUP BY status) oicount
                      ON oicount.status = oi.status
                      WHERE oi.status = :status
                      ORDER BY oi.creationdate desc
                      limit :offset, :itemsperpage");
        $query->bindParam(':status', $this->status);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->bindParam(':itemsperpage', $itemsperpage, PDO::PARAM_INT);
      } else {
        $query=$this->con->prepare("SELECT oi.*, oicount.totalitems 
                      FROM orderinfo oi
                      INNER JOIN (SELECT count(*) as totalitems FROM orderinfo) oicount
                      ON 1=1
                      ORDER BY oi.status, oi.creationdate desc
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
				$this->error["success"] = 0;
				$this->error["message"] = 'Não devolveu nenhuma encomenda neste estado.';
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Ocorreu um erro na consulta de encomendas.';
			$ret = $this->error;
		}
		
		return $ret;		
	}

  //-----------------
  //Orderinfo details
  //-----------------
  public function getOrderInfoDetails()
	{
		$ret = array();
		
		try {
			//fetching all drivers of a company
			$query=$this->con->prepare("SELECT *
                                  FROM orderinfodetails 
                                  where orderinfoid = :orderinfoid
                                  order by id");
      $query->bindParam(':orderinfoid', $this->orderinfoid);
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
				$this->error["message"] = 'O detalhe desta nota de encomenda não existe!';
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = 'Ocorreu um erro na pesquisa do detalhe da nota de encomenda!';
			$ret = $this->error;
		}
		
		return $ret;		
	}

  public function setOrderInfo()
	{
		try {
			if (isset($this->email) && $this->email!="" &&
			    isset($this->phonenumber) && $this->phonenumber!="" &&
			    isset($this->taxnumber) && $this->taxnumber!="" &&
			    isset($this->computerid) && $this->computerid!="" &&
			    isset($this->computerdesc) && $this->computerdesc!="" &&
			    isset($this->computercost) && $this->computercost!="" &&
			    isset($this->computerprice) && $this->computerprice!="" &&
			    isset($this->computerqtd) && $this->computerqtd!="" &&
			    isset($this->computervatprice) && $this->computervatprice!="" &&
			    isset($this->computertotalprice) && $this->computertotalprice!="" &&
			    isset($this->deliveryname) && $this->deliveryname!="" &&
			    isset($this->deliverystreet) && $this->deliverystreet!="" &&
			    isset($this->deliveryzipcode) && $this->deliveryzipcode!="" &&
			    isset($this->deliverycity) && $this->deliverycity!="" &&
			    isset($this->invoicename) && $this->invoicename!="" &&
			    isset($this->invoicestreet) && $this->invoicestreet!="" &&
			    isset($this->invoicezipcode) && $this->invoicezipcode!="" &&
			    isset($this->invoicecity) && $this->invoicecity!="")
      {

        $this->con->beginTransaction();

				//inserting Order Info data
				$query = $this->con->prepare("INSERT INTO orderinfo (email, phonenumber, taxnumber, computerid, computerdesc, computercost, computerprice, computerqtd, computervatprice, computertotalprice, deliveryname, deliverystreet, 
                        deliveryzipcode, deliverycity, invoicename, invoicestreet, invoicezipcode, invoicecity) 
											  VALUES (:email, :phonenumber, :taxnumber, :computerid, :computerdesc, :computercost, :computerprice, :computerqtd, :computervatprice, :computertotalprice, :deliveryname, :deliverystreet, 
                        :deliveryzipcode, :deliverycity, :invoicename, :invoicestreet, :invoicezipcode, :invoicecity)");
				$result = $query->execute(array(
					"email" 		          => $this->email,
					"phonenumber"		 	    => $this->phonenumber,
					"taxnumber"		        => $this->taxnumber,
					"computerid"  	      => $this->computerid,
					"computerdesc"        => $this->computerdesc,
					"computercost"	      => $this->computercost,
					"computerprice"       => $this->computerprice,
					"computerqtd"         => $this->computerqtd,
          			"computervatprice"    => $this->computervatprice,
          			"computertotalprice"  => $this->computertotalprice,
					"deliveryname"        => $this->deliveryname,
					"deliverystreet"	    => $this->deliverystreet,
					"deliveryzipcode"	    => $this->deliveryzipcode,
					"deliverycity"		    => $this->deliverycity,
          "invoicename"			    => $this->invoicename,
					"invoicestreet"		    => $this->invoicestreet,
					"invoicezipcode"	    => $this->invoicezipcode,
					"invoicecity"			    => $this->invoicecity
				));

				if (!$result) {

          			$this->con->rollBack();

					$this->error['success'] = 1;
					$this->error['message'] = 'Erro na criação da encomenda'; 
				} else {

					$this->orderinfoid = $this->con->lastInsertId();

					if ($this->computerid > 0) {
						//Insert orderinfodetail
						$query = $this->con->prepare("INSERT INTO orderinfodetails (orderinfoid, computerid, componentid, type, description, cost, qtd, link, image) 
										SELECT :orderinfoid, cc.computerid, cc.componentid, c.type, c.description, c.cost, cc.qtd, c.link, c.image
										FROM component c
										INNER JOIN computercomponents cc
										ON cc.componentid = c.id
										WHERE cc.computerid = :computerid");
						$result = $query->execute(array(
						"orderinfoid" 		=> $this->orderinfoid,
						"computerid"  	  => $this->computerid
						));

						if (!$result) {

						$this->con->rollBack();

						$this->error['success'] = 1;
						$this->error['message'] = 'Erro na criação da encomenda'; 
						} else {

						$this->con->commit();

						$this->error['success'] = 0;
						$this->error['message'] = 'A sua encomenda foi criada com sucesso'; 
						$this->error['orderinfoid'] = $this->orderinfoid; 
						}
					} else {
						$this->con->commit();

						$this->error['success'] = 0;
						$this->error['message'] = 'A sua encomenda foi criada com sucesso'; 
						$this->error['orderinfoid'] = $this->orderinfoid; 
					}
				}
			}
      else {
        $this->error['success'] = 1;
				$this->error['message'] = 'Erro na formatação dos dados'; 
      }
		}
		catch(PDOException $ex) {

      $this->con->rollBack();

			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
	}


  public function updOrderInfoStatus()
  {
    try {
			if (isset($this->orderinfoid) && $this->orderinfoid!="" &&
			    isset($this->status) && $this->status!="")
      {

			  //update Order Info status
				$query = $this->con->prepare("UPDATE orderinfo SET status = :status WHERE id = :orderinfoid");
				$result = $query->execute(array(
					"orderinfoid" 		    => $this->orderinfoid,
					"status"		 	        => $this->status
				));

				if (!$result) {
					$this->error['success'] = 1;
					$this->error['message'] = 'Erro na atualização da encomenda'; 
				} else {
          $this->error['success'] = 0;
          $this->error['message'] = 'A encomenda foi atualizada com sucesso'; 
				}
			}
      else {
        $this->error['success'] = 1;
				$this->error['message'] = 'Erro na formatação dos dados'; 
      }
		}
		catch(PDOException $ex) {

      $this->con->rollBack();

			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
  }

  public function setOrderInfoDetails()
	{
		try {
			if (isset($this->orderinfoid) && $this->orderinfoid!="" &&
			    isset($this->componentid) && $this->componentid!="") 
      {

        $this->con->beginTransaction();

        //Insert orderinfodetail
        $query = $this->con->prepare("INSERT INTO orderinfodetails (orderinfoid, computerid, componentid, type, description, cost, qtd, link, image) 
                        SELECT :orderinfoid, 0, c.id, c.type, c.description, c.cost, 1, c.link, c.image
                        FROM component c
                        WHERE c.id = :componentid");
        $result = $query->execute(array(
          "orderinfoid" 		=> $this->orderinfoid,
          "componentid"  	  => $this->componentid
        ));

        if (!$result) {

          $this->con->rollBack();

          $this->error['success'] = 1;
          $this->error['message'] = 'Erro na criação da encomenda'; 
        } else {

          $this->con->commit();

          $this->error['success'] = 0;
          $this->error['message'] = 'A sua encomenda foi criada com sucesso'; 
          }
			}
      else {
        $this->error['success'] = 1;
				$this->error['message'] = 'Erro na formatação dos dados'; 
      }
		}
		catch(PDOException $ex) {

      $this->con->rollBack();

			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
	}
}

?>